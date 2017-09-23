<?php
/*Do not modify this PHP code when editing the page design.

The following fields are available from the database, and can be accessed as variables using...

<?php echo $row["name"]; ?>
<?php echo $row["flag_filename"]; ?>
<?php echo $row["map_filename"]; ?>
<?php echo $row["picture_1_filename"]; ?>
<?php echo $row["picture_2_filename"]; ?>
<?php echo $row["description"]; ?>
<?php echo $row["other_page_text"]; ?>
<?php echo $row["world_factbook_link"]; ?>
<?php echo $row["newsfeed"]; ?>
<?php echo $row["ad"]; ?>
<?php echo $last_updated.$row["created_date"].$by.$creator; ?>
<?php echo $youtube_id; ?>
<?php echo $page; ?>
<?php echo $creator; ?>
<?php printCountryList('view') ?>

// Multi-lingual text from variables
<?php echo $title; ?>
<?php echo $meta_description; ?>
<?php echo $meta_keywords; ?>
<?php echo $select_another_country; ?>
<?php echo $last_updated; ?>
<?php echo $by; ?>
<?php echo $unknown_country; ?>
<?php echo $unknown_country_text; ?>
<?php echo $contact; ?>
<?php echo $home; ?>
<?php echo $disclaimer; ?>
*/

ini_set( 'default_charset', 'UTF-8' );

//Connect to the database
include("/database.php");

$name = $_GET['name'];
$language = $_GET['lang'];
switch ($language) {
    case 'en':
        include("/messages_en.php");
        break;
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

include("/printCountryList.php");

$sql = "SELECT `language`,`name`,`flag_filename`,`map_filename`,`picture_1_filename`,`picture_2_filename`,`description`,`other_page_text`,`world_factbook_link`,`newsfeed`,`ad`,`created_by`,`created_date` FROM `countries` WHERE `removed`='0' AND `language`='$language' AND `name`='$name'";

$result = $conn->query($sql);
if (mysqli_num_rows($result) == 0) { 
  //echo 'Unknown Country or Language trying for that country in English'; 
  $sql = "SELECT `language`,`name`,`flag_filename`,`map_filename`,`picture_1_filename`,`picture_2_filename`,`description`,`other_page_text`,`world_factbook_link`,`newsfeed`,`ad`,`created_by`,`created_date` FROM `countries` WHERE `removed`='0' AND `language`='en' AND `name`='$name'";
  $result = $conn->query($sql);
  if (mysqli_num_rows($result) == 0) { 
    ?>
    <html>
      <head>
        <title><?php echo $unknown_country; ?></title>
        <META http-equiv="refresh" content="5;URL=http://www.saveaslave.com">
      </head>
      <body bgcolor="#ffffff">
        <center><?php echo $unknown_country_text; ?>
        </center>
      </body>
    </html>
    <?php
    break;
  }
}

$row = $result->fetch_assoc();

// Get the latest video
$page = strtolower($name).".html";
$sql = "SELECT `url` FROM `links` WHERE `url` LIKE '%youtu%' AND `page` LIKE '%$page%' AND `video` = '1' AND `visible` = '1' AND `removed` = '0' ORDER BY date_added DESC LIMIT 1";

$result_youtube = $conn->query($sql);

if (mysqli_num_rows($result_youtube) == 0) { 
  //echo 'No video for that country'; 
  $sql = "SELECT `url` FROM `links` WHERE `url` LIKE '%youtu%' AND `page` = 'index.html' AND `video` = '1' AND `visible` = '1' AND `removed` = '0' ORDER BY date_added DESC LIMIT 1";
  $result_youtube = $conn->query($sql);
}

$row_youtube = $result_youtube->fetch_assoc();
// strip the url to get the YouTube video ID
if ($location = strpos($row_youtube["url"],"v=")) {
  $youtube_id = substr($row_youtube["url"], $location+2);
} else {
  $location = strpos($row_youtube["url"],"youtu.be/");
  $youtube_id = substr($row_youtube["url"], $location+9);
}

// Get the name of the person who last edited the page
$created_by_id = $row["created_by"];
$sql = "SELECT `name` FROM `volunteers` WHERE `give_credit` = '1' AND `id` = '$created_by_id'";
$result_credit = $conn->query($sql);
if (mysqli_num_rows($result_credit) == 0) {
  $creator = "Hidden";
} else {
  $row_credit = $result_credit->fetch_assoc();
  $creator = $row_credit["name"];
}

$conn->close();
?>

<!-- -----------It is safe to change the code below this line.-------------- -->

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf8" />
  <title><?php echo $title; ?> <?php echo $row["name"]; ?></title>
  <link href="css/style.css" media="screen" rel="stylesheet" type="text/css" />
  <meta name="description" content="<?php echo $meta_description; ?>" />
  <meta name="keywords" content="saveaslave, <?php echo $meta_keywords; ?>" />
</head>
<body>
<div align="center">
  <div id="content">
	<img src="images/header.png" /><br />
<div id="arttext">
<hr  />

<table width="100%" cellpadding="5px"><tr><td width="40%" align="left" valign="top">
<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="HD9MBDFHBLNFA">
<input type="image" src="images/sas_button.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
</form><br />

<?php echo $select_another_country; ?> <?php printCountryList('view',$language) ?>
<br /><br />
<br />
<?php echo $row["newsfeed"]; ?><br />
<br />
<br />

<iframe width="600" height="338" src="https://www.youtube.com/embed/<?php echo $youtube_id; ?>" frameborder="0" allowfullscreen></iframe>
<p>&nbsp;</p></td>
<td width="60%" align="left" valign="top">
     <h1><?php echo $row["name"]; ?><img src="images/countrymap/<?php echo $row["flag_filename"]; ?>" align="right" height="72" width="100" /></h1>
    <?php echo $row["description"]; ?>
    <p><img src="images/countrymap/<?php echo $row["map_filename"]; ?>" align="right"/></p></td>
</tr>
<tr>
  <td colspan="2"><table style="width:100%">
  <tr>
    <td valign="top">
      <iframe src="/listlink.php?page=<?php echo $page; ?>&lang=<?php echo $language; ?>" width="600" height="480">
        <p>Your browser does not support iframes.</p>
      </iframe>
    </td>
    <td width="300" valign="top">
      <iframe src="/addlink.php?page=<?php echo $page; ?>&lang=<?php echo $language; ?>" width="300" height="480">
         <p>Your browser does not support iframes.</p>
      </iframe>
    </td>
  </tr>
</table>
</br>
<?php echo $row["other_page_text"]; ?></td></tr>
</table>
</div>

<div id="footer"><hr /><?php echo $last_updated.$row["created_date"].$by.$creator; ?> 

&copy; 2015 SaveAslave | <a href="mailto:saveaslave@aol.com?Subject=Contact%20from%20saveaslave.com"><?php echo $contact; ?></a> | <a href="index.html"><?php echo $home; ?></a> | <a href="disclaimer.html"><?php echo $disclaimer; ?></a> </div>

</div>
</body>
</html>