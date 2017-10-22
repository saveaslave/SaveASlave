<?php 

// Display the error messages. To be removed when pages go live
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Set the characterset
ini_set( 'default_charset', 'UTF-8' );

// Set default values
$creator = "SaveAslave";
if (!isset($_GET['name'])) {
	$name = "SaveAslave";
}

// Get language from client
$language = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
if (isset($_GET['lang'])) {
   // Set language from URL if manually specified
   $language = $_GET['lang'];
}

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

// Get the video links
if (isset($_SERVER['HTTP_REFERER'])) {
   $page = basename($_SERVER['HTTP_REFERER']);
}

if (isset($_GET['page'])) {
	$page = $_GET['page'];
} else {
	$page = "index.html";
}
//echo "Page: ".$page;
$sql = "SELECT  `id`,  `url`,  `name` 
FROM  `links` 
WHERE `video` ='1'
AND `page` = '".$page."'
AND `visible` ='1' 
AND `removed` ='0' 
AND `name` LIKE '% - YouTube%'
ORDER BY `date_added` DESC LIMIT 3";
$top_videos = $conn->query($sql);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta charset="UTF-8">
<meta http-equiv="refresh" content="300"/> <!–– Reload page automatically every 5-minutes for latest content. -->
<meta name="description" content="Learn about the forms of modern-day slavery or human trafficking: domestic servitude, child labor, bonded labor, sex trafficking and forced labor."/>
<meta property="og:title" content="Slavery Today | Different Types of Human Trafficking - End Slavery Now" />
<meta property="og:url" content="http://www.saveaslave.com" />
<meta property="og:type" content="website" />
<meta property="og:description" content="Learn about the forms of modern-day slavery or human trafficking: domestic servitude, child labor, bonded labor, sex trafficking and forced labor." />
<meta name="keywords" content="modern, slave, awareness,Free slaves, Rescue slaves, End slavery, child slave, child labor, save a slave, human trafficking, anti-slavery, modern day salvery, debt bondage, bonded labor, servitude, slave, forced labor, prostitution, pornography
"/>
<title>SaveAslave - Information and Education About Modern Day Slavery</title>
<style type="text/css">
.title-style {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 500%;
	text-align: center;
    text-shadow: -6px -0px #A9A9A9;
    font-style: italic;
}
a:link {
	font-family: courier;
    color: black;
}
a:visited {
	font-family: courier;
    color: black;
}

.tg  {border-collapse:collapse;border-spacing:1;border: 1px solid black}
.tg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-  style:solid;border-width:1px;border: 1px solid black;overflow:hidden;word-break:normal;}
.tg th{font-family:Arial, sans-serif;font-size:14px;font-  weight:normal;padding:10px 5px;border-style:solid;border-  width:1px;overflow:hidden;word-break:normal;}
.tg .tg-ug4v{font-weight:bold;background-color:#cbcefb;text-align:center}
.tg .tg-shown{text-align:left}
.tg .tg-deleted{background-color:#F0F0F0;text-align:left}

</style>

</head>
<body id="main_body">
<basefont face = "courier">
<div class="title-style">SaveAslave</div>


