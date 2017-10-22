<?php 
$language = $_GET['lang'];
$selected_en = "";
$selected_fr = "";
$selected_es = "";
$selected_ru = "";
$selected_pt = "";

switch ($language) {
    case 'fr':
        include("/messages_fr.php");
        $selected_fr = "selected";
        break;
    case 'es':
        include("/messages_es.php");
        $selected_es = "selected";
        break;
    case 'ru':
        include("/messages_ru.php");
        $selected_ru = "selected";
        break;
    case 'pt':
        include("/messages_pt.php");
        $selected_pt = "selected";
        break;
    default:
        include("/messages_en.php");
        $selected_en = "selected";
        $language = "en";
}

// Connect to the database
include("/database.php");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf8">
<title><?php echo $add_an_article; ?></title>
 <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!--<link href="css/style-pages.css" rel="stylesheet"> -->
 <link href="css/elements.css" rel="stylesheet">
 <script src='https://www.google.com/recaptcha/api.js'></script>
</head>
<body>
<?php
function get_ip() {
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

// define variables and set to empty values
$url = "";
$page = "";
$name = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") { 
  // The form was filled out. Add the data to the database.

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


  $url = $_POST["url"];
  if (isset($_POST["page"]) && $_POST["page"] <> ''){
     $page = $_POST["page"];
  } else {
     $page = "index.html";
  }

  // Remove all illegal characters from url
  $url = filter_var($url, FILTER_SANITIZE_URL);

  // Validate url
  if (filter_var($url, FILTER_VALIDATE_URL) === false) {
      $url = "http://".$url;       //add the http prefix
      if (filter_var($url, FILTER_VALIDATE_URL) === false) {
          $url = '';
      }
  }
  // Get the Client IP
  $ip = get_ip();

  // Process the uploaded files
  $target_dir = "/images/article/";

  if(getimagesize($_FILES["picture_1_filename"]["tmp_name"])) {
     $picture_1_filename = $_POST["picture_1_filename"];
     $target_file = $target_dir . basename($_FILES["picture_1_filename"]["name"]);
     if (move_uploaded_file($_FILES["picture_1_filename"]["tmp_name"], $target_file)) {
        $picture_1_filename = $_FILES["picture_1_filename"]["name"];
     } else {
     $picture_1_filename = "";
     echo $error_uploading_photo . " 1: ".$_FILES["picture_1_filename"]["error"]."<br>";
     }
  }

  if(getimagesize($_FILES["picture_2_filename"]["tmp_name"])) {
     $picture_2_filename = $_POST["picture_2_filename"];
     $target_file = $target_dir . basename($_FILES["picture_2_filename"]["name"]);
     if (move_uploaded_file($_FILES["picture_2_filename"]["tmp_name"], $target_file)) {
        $picture_2_filename = $_FILES["picture_2_filename"]["name"];
     } else {
     $picture_2_filename = "";
     echo $error_uploading_photo . " 2: ".$_FILES["picture_2_filename"]["error"]."<br>";
     }
  }

  if(getimagesize($_FILES["picture_3_filename"]["tmp_name"])) {
     $picture_3_filename = $_POST["picture_3_filename"];
     $target_file = $target_dir . basename($_FILES["picture_3_filename"]["name"]);
     if (move_uploaded_file($_FILES["picture_3_filename"]["tmp_name"], $target_file)) {
        $picture_3_filename = $_FILES["picture_3_filename"]["name"];
     } else {
     $picture_3_filename = "";
     echo $error_uploading_photo . " 3: ".$_FILES["picture_3_filename"]["error"]."<br>";
     }
  }

  //insert the article into the database
  $sql = "INSERT INTO  `saveaslave`.`articles` (
`id` ,
`language` ,
`url` ,
`name` ,
`full_text` ,
`picture_1_filename` ,
`picture_2_filename` ,
`picture_3_filename` ,
`page` ,
`visible` ,
`date_added` ,
`added_by_ip` ,
`removed` ,
`date_removed` ,
`removed_by_ip`
) VALUES (NULL , '".$_POST["language"]."', '".$url."',  '".addslashes($_POST["name"])."',  '".addslashes($_POST["full_text"])."',  '".$picture_1_filename."', '".$picture_2_filename."', '".$picture_3_filename."', '".$page."', '1', NOW( ) ,  '".$ip."',  '0', NULL , NULL)";
  if ($conn->query($sql) === TRUE) {
     echo $article." <a href='article.php?id=".$conn->insert_id."'>".$_POST["name"]."</a> ".$submitted_from." ".$ip.", ".$has_been_added_to." ".$page.".<br></br>";
  } else {
      echo $database_error. $sql . "<br>" . $conn->error . "<br>";
      exit;
  }
}

?>
<form id="addarticle" method="post" action="" accept-charset="utf-8" enctype="multipart/form-data">			

<label class="description" for="element_1"><?php echo $article_name; ?> (<?php echo $required; ?>)</label>
<br><input id="name" name="name" class="element text large" type="text" maxlength="2082" size="96" value="" required/> 

<br><label class="description" for="element_2"><?php echo $article_text; ?> (<?php echo $required; ?>)</label>
<br><textarea rows="15" cols="98" name="full_text" form="addarticle" required></textarea>

<br><label class="description" for="element_3"><?php echo $photo; ?> 1</label>
<input id="picture_1_filename" name="picture_1_filename" class="element file" type="file"/> 

<br><label class="description" for="element_4"><?php echo $photo; ?> 2</label>
<input id="picture_2_filename" name="picture_2_filename" class="element file" type="file"/> 

<br><label class="description" for="element_5"><?php echo $photo; ?> 3</label>
<input id="picture_3_filename" name="picture_3_filename" class="element file" type="file"/> 

<br><label class="description" for="element_6"><?php echo $text_url; ?> </label>
<br><input id="url" name="url" class="element text large" type="text" maxlength="2082" size="96" value=""/> 

<br><label class="description" for="element_7"><?php echo $language_text; ?> </label>
<br><select class="element select medium" id="language" name="language" for="element_7">
  <option value="en" <?php echo $selected_en; ?>>English</option>
  <option value="fr" <?php echo $selected_fr; ?>>French</option>
  <option value="pt" <?php echo $selected_pt; ?>>Portuguese</option>
  <option value="ru" <?php echo $selected_ru; ?>>Russian</option>
  <option value="es" <?php echo $selected_es; ?>>Spanish</option>
</select>

<br><label class="description" for="element_8"><?php echo $page_subject; ?> </label>
<br><select class="element select medium" id="page" name="page"> 
<?php

//$files = glob("*.{html,php}", GLOB_BRACE);
$serverpage = basename($_SERVER['HTTP_REFERER']);
if ($serverpage == 'addarticle.php') {
  $serverpage = $page;
}

if ($serverpage == '' || $serverpage == 'saveaslave.com') {
         echo "<option value=\"\" selected> </option>";
}

if ($_GET['page']){
   $serverpage = $_GET['page'];
   echo "<option value=\"$serverpage\" selected>$serverpage</option>";
} 

foreach ($files as $page) {
   if ($serverpage == $page) {
      echo "<option value=\"$page\" selected>$page</option>";
    } else {
      //echo "<option value=\"$page\">$page</option>";
    }
}
// always include the main page and news page.
echo "<option value=\"index.html\">Main Page</option>";
echo "<option value=\"our-news.php\">News</option>";

// lookup countries
$sql = "SELECT DISTINCT `name` FROM `countries` WHERE `removed` = 0 GROUP BY `name` ORDER BY `name`";
$result = $conn->query($sql);

while($row = $result->fetch_assoc()) {
     $countryname = $row["name"];
     $filename = strtolower($countryname).".html";
     echo "<option value=\"$filename\">$countryname</option>";
}

?>
</select>
<p>
   <div class="g-recaptcha" data-sitekey="6LfjChoTAAAAAK-LhoddQXVgp058bM4incpvUnVc" id="article-captcha"> </div>
</p>
<input type="hidden" name="form_id" value="addarticle.php" />
<p><input id="saveForm" class="button_text" type="submit" name="submit" value="<?php echo $submit; ?>" />
</p>
</form>	
<p class="text-link"><?php echo $excited_text; ?></p>
<p class="text-link"><?php echo $accept_disclaimer_text; ?></p>
</body>
</html>

<?php
// close the database connection
$conn->close();
//include 'footer.php';
?>