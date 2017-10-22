<?php 

// Get language from client
$language = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
if (isset($_GET['lang'])) {
   // Set language from URL if manually specified
   $language = $_GET['lang'];
}

switch ($language) {
    case 'fr':
        include("/messages_fr.php");
        break;
    case 'es':
        include("/messages_es.php");
        break;
    case 'ru':
        include("/messages_ru.php");
        break;
    case 'pt':
        include("/messages_pt.php");
        break;
    default:
        include("/messages_en.php");
        $language = "en";
}

// Connect to the database
include("/database.php");


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="UTF-8">

<title><?php echo $add_a_link; ?></title>

 <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style-pages.css" rel="stylesheet">
    <link href="css/elements.css" rel="stylesheet">
<style type="text/css">
body { font-family: sans-serif; font-size: 0.8em; padding: 20px; }
#result { border: 1px solid green; width: 300px; margin: 0 0 35px 0; padding: 10px 20px; font-weight: bold; }
#change-image { font-size: 0.8em; }
</style>
<script src='https://www.google.com/recaptcha/api.js'></script>
</head>

<body>

<?php

/* gets the data from a URL */
function get_data($url) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.2; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/27.0.1453.94 Safari/537.36');
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); 
    curl_setopt($ch,CURLOPT_URL,$url); 
    curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,2);
    $data = curl_exec($ch);
    curl_close($ch);
    return $data;
}

function get_title_curl($url) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.2; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/27.0.1453.94 Safari/537.36');
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); 
    curl_setopt($ch,CURLOPT_URL,$url); 
    curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,2);
    $data = curl_exec($ch);
    curl_close($ch);

    //parsing begins here:
    $doc = new DOMDocument();
    @$doc->loadHTML($data);
    $nodes = $doc->getElementsByTagName('title');
    $title = $nodes->item(0)->nodeValue;
    $title = utf8_decode($title);
    return $title;
  }

function get_client_ip() {
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if(getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if(getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if(getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if(getenv('HTTP_FORWARDED'))
       $ipaddress = getenv('HTTP_FORWARDED');
    else if(getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}

// define variables and set to empty values
$url = "";
$page = "";
$name = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") { 
  // The form was filled out. Add the data to the database.
  $url = $_POST["url"];
  $page = $_POST["page"];
  $ip = $_SERVER['REMOTE_ADDR']?:($_SERVER['HTTP_X_FORWARDED_FOR']?:$_SERVER['HTTP_CLIENT_IP']);
  // Check reCaptcha
  $captcha;
  if(isset($_POST['g-recaptcha-response'])){
          $captcha=$_POST['g-recaptcha-response'];
        }
        if(!$captcha){
          echo $check_captcha;
          exit;
        }
        $secretKey = "6LfjChoTAAAAALDQspZSl63ykqwxiUhleZ5CjTVq";
        $captcha_url = "https://www.google.com/recaptcha/api/siteverify?secret=".$secretKey."&response=".$captcha."&remoteip=".$ip;
        $response=get_data($captcha_url);
        $responseKeys = json_decode($response,true);
        if(intval($responseKeys["success"]) !== 1) {
          echo "You are a spammer!";
          exit;
        }
  // Remove all illegal characters from url
  $url = filter_var($url, FILTER_SANITIZE_URL);

  // Validate url
  if (filter_var($url, FILTER_VALIDATE_URL) === false) {
      $url = "http://".$url;       //add the http prefix
      if (filter_var($url, FILTER_VALIDATE_URL) === false) {
         echo $invalid_url;
         exit;
      }
  }

  // Determine if it's a video
  $video = 0;
  if(preg_match('/(http|https):\/\/www\.youtube\.com\/watch\?v=[^&]+/', $url)) {
     $video = 1;
     } elseif(preg_match('/(http|https):\/\/\youtu\.be\/[^&]+/', $url)) {
     $video = 1;
     } elseif(preg_match('/(http|https):\/\/vimeo\.com\/[^&]+/', $url)) {
     $video = 1;
      } elseif(preg_match('/(http|https):\/\/(.*?)blip\.tv\/file\/[0-9]+/', $url)) {
     $video = 1;
      } elseif(preg_match('/(http|https):\/\/(.*?)break\.com\/(.*?)\/(.*?)\.html/', $url)) {
     $video = 1;
      } elseif(preg_match('/http:\/\/www\.metacafe\.com\/watch\/(.*?)\/(.*?)\//', $url)) {
     $video = 1;
      } elseif(preg_match('/(http|https):\/\/video\.google\.com\/videoplay\?docid=[^&]+/', $url)) {
     $video = 1;
      } elseif(preg_match('/(http|https):\/\/www\.dailymotion\.com\/video\/+/', $url)) {
     $video = 1;
  }
  // Get title for URL
  $name = get_title_curl($url);
  if ($name == '') {
    if ($video == 0) {
      echo $url.$is_invalid_or_title_error;
      exit;
    } else {
      $name = $unknown_video;
    }
  }
  //insert the link into the database
  $sql = "INSERT INTO  `saveaslave`.`links` (
`id` ,
`url` ,
`name` ,
`page` ,
`video` ,
`visible` ,
`date_added` ,
`added_by_ip` ,
`removed` ,
`date_removed` ,
`removed_by_ip`
) VALUES (NULL , '".$url."',  '".addslashes($name)."',  '".$page."',  '".$video."',  '1', NOW( ) ,  '".get_client_ip()."',  '0', NULL , NULL)";
  if ($conn->query($sql) === TRUE) {
    if ($video == 0) {
     echo $text_page." ".$name." ".$at_url." ".$url.", ".$submitted_from." ".$ip.", ".$has_been_added_to." ".$page.".</br>";
    } else {
     echo $video." ".$name." ".$at_url." ".$url.", ".$submitted_from." ".$ip.", ".$has_been_added_to." ".$page.".</br>";
    }
  } else {
      echo $database_error. $sql . "<br>" . $conn->error;
      exit;
  }
}
?>
<h2><?php echo $add_a_link; ?></h2>
		<form id="addlink" method="post" action="" accept-charset="utf-8" class="basic-grey">			
		<label class="description" for="element_1"><?php echo $text_url; ?> </label>
		<input id="url" name="url" class="element text large" type="text" maxlength="255" value="" required/> 
	<p class="guidelines" id="guide_1"><small><?php echo $please_enter_valid_url; ?></small></p> 
		<label class="description" for="element_2"><?php echo $page_subject; ?> </label>
		<select class="element select medium" id="page" name="page"> 
<?php	
$files = glob("*.{html,php}", GLOB_BRACE);
$serverpage = basename($_SERVER['HTTP_REFERER']);
if ($serverpage == 'addlink.php') {
  $serverpage = $page;
}
if ($serverpage == '' || $serverpage == 'saveaslave.com') {
         echo "<option value=\"\" selected> </option>";

}

if ($_GET['page']){
   	$serverpage = $_GET['page'];
   	if ($serverpage == "SaveAslave") {
   		echo "<option value=\"index.html\">Main Page</option>";
	} else {
   		echo "<option value=\"$serverpage\" selected>$serverpage</option>";
   	}
} 

/*
foreach ($files as $page) {
   if ($serverpage == $page) {
      echo "<option value=\"$page\">$page</option>";
    } 
}
*/

// always include the main page.
echo "<option value=\"index.html\">Main Page</option>";
  $sql = "SELECT DISTINCT `name` FROM `countries` WHERE `removed` = 0 GROUP BY `name` ORDER BY `name`";
  $result = $conn->query($sql);
while($row = $result->fetch_assoc()) {
     $countryname = $row["name"];
     $filename = strtolower($countryname).".html";
     echo "<option value=\"$filename\">$countryname</option>";
}

?>
	</select>
	<p class="guidelines" id="guide_2"><small><?php echo $please_select_valid_page; ?></small></p> 
<div class="g-recaptcha" data-sitekey="6LfjChoTAAAAAK-LhoddQXVgp058bM4incpvUnVc" id="link-captcha"> </div>
	            <input type="hidden" name="form_id" value="addlink.php" />
		    <input id="saveForm" class="button_text" type="submit" name="submit" value="<?php echo $submit; ?>" />
		</form>	
<p class="text-link"><?php echo $excited_text; ?></p>
<p class="text-link"><?php echo $accept_disclaimer_text; ?></p>
	</body>
</html>

<?php
// close the database connection
$conn->close();
?>