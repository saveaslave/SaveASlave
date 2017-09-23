<?php 
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

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf8">
<title>List of Links</title>
<style>
.LinksTable {
	margin:0px;padding:0px;
	width:100%;
	border:1px solid #000000;
	
	-moz-border-radius-bottomleft:0px;
	-webkit-border-bottom-left-radius:0px;
	border-bottom-left-radius:0px;
	
	-moz-border-radius-bottomright:0px;
	-webkit-border-bottom-right-radius:0px;
	border-bottom-right-radius:0px;
	
	-moz-border-radius-topright:0px;
	-webkit-border-top-right-radius:0px;
	border-top-right-radius:0px;
	
	-moz-border-radius-topleft:0px;
	-webkit-border-top-left-radius:0px;
	border-top-left-radius:0px;
}.LinksTable table{
    border-collapse: collapse;
        border-spacing: 0;
	width:100%;
	height:100%;
	margin:0px;padding:0px;
}.LinksTable tr:last-child td:last-child {
	-moz-border-radius-bottomright:0px;
	-webkit-border-bottom-right-radius:0px;
	border-bottom-right-radius:0px;
}
.LinksTable table tr:first-child td:first-child {
	-moz-border-radius-topleft:0px;
	-webkit-border-top-left-radius:0px;
	border-top-left-radius:0px;
}
.LinksTable table tr:first-child td:last-child {
	-moz-border-radius-topright:0px;
	-webkit-border-top-right-radius:0px;
	border-top-right-radius:0px;
}.LinksTable tr:last-child td:first-child{
	-moz-border-radius-bottomleft:0px;
	-webkit-border-bottom-left-radius:0px;
	border-bottom-left-radius:0px;
}.LinksTable tr:hover td{
	
}
.LinksTable tr:nth-child(odd){ background-color:#e5e5e5; }
.LinksTable tr:nth-child(even)    { background-color:#ffffff; }.LinksTable td{
	vertical-align:middle;
	border:1px solid #000000;
	border-width:0px 1px 1px 0px;
	text-align:left;
	padding:7px;
	font-size:10px;
	font-family:Arial;
	font-weight:normal;
	color:#000000;
}.LinksTable tr:last-child td{
	border-width:0px 1px 0px 0px;
}.LinksTable tr td:last-child{
	border-width:0px 0px 1px 0px;
}.LinksTable tr:last-child td:last-child{
	border-width:0px 0px 0px 0px;
}
.LinksTable tr:first-child td{
		background:-o-linear-gradient(bottom, #000000 5%, #ffffff 100%);	background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #000000), color-stop(1, #ffffff) );
	background:-moz-linear-gradient( center top, #000000 5%, #ffffff 100% );
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr="#000000", endColorstr="#ffffff");	
        background: -o-linear-gradient(top,#000000,ffffff);
	background-color:#000000;
	border:0px solid #000000;
	text-align:center;
	border-width:0px 0px 1px 1px;
	font-size:14px;
	font-family:Arial;
	font-weight:bold;
	color:#ffffff;
}
.LinksTable tr:first-child:hover td{
	background:-o-linear-gradient(bottom, #000000 5%, #ffffff 100%);	background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #000000), color-stop(1, #ffffff) );
	background:-moz-linear-gradient( center top, #000000 5%, #ffffff 100% );
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr="#000000", endColorstr="#ffffff");	background: -o-linear-gradient(top,#000000,ffffff);

	background-color:#000000;
}
.LinksTable tr:first-child td:first-child{
	border-width:0px 0px 1px 0px;
}
.LinksTable tr:first-child td:last-child{
	border-width:0px 0px 1px 1px;
}
</style>
</head>
<body id="main_body" >
<?php

//Connect to the database
include("/database.php");

$page = basename($_SERVER['HTTP_REFERER']);
if ($page == '') {
   $page = "index.html";
}
if ($_GET['page']){
   $page = $_GET['page'];
}
//echo "Page: ".$page;

$sql = "SELECT  `id`,  `url`,  `name` 
FROM  `links` 
WHERE `video` ='0'
AND `page` = '".$page."'
AND `visible` ='1' 
AND `removed` ='0'";

$result = $conn->query($sql);

?>
<div class="LinksTable" >
                <table >
                    <tr>
                        <td width="60">
                            <?php echo $report; ?>
                        </td>
                        <td >
                            <?php echo $website_links; ?>
                        </td>
                    </tr>
<?php while($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <td width="60">
<a href="mailto:saveaslave@aol.com?subject=Inappropriate%20Link%20on%20<?php echo $page;?>&amp;body=Link%20is...%0A<?php echo $row["url"];?>%0A%0ATo%20disable...%0Ahttp%3A%2F%2Fsaveaslave.com%2Fmanagelink.php%3Fid_to_edit%3D<?php echo $row["id"];?>%26action%3D0"><?php echo $report; ?></a>
                        </td>
                        <td>
                            <a href="<?php echo $row["url"];?>" target="_blank"><?php echo $row["name"];?></a>
                        </td>
                    </tr>
<?php } ?>
                </table>
            </div>
<?php  
$sql = "SELECT  `id`,  `url`,  `name` 
FROM  `links` 
WHERE `video` ='1' 
AND `page` = '".$page."'
AND `visible` ='1' 
AND `removed` ='0'";

$result = $conn->query($sql);

?>
<div class="LinksTable" >
                <table >
                    <tr>
                        <td width="60">
                            <?php echo $report; ?>
                        </td>
                        <td >
                            <?php echo $video_links; ?>
                        </td>
                    </tr>
<?php while($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <td width="60">
<a href="mailto:saveaslave@aol.com?subject=Inappropriate%20Video%20Link%20on%20<?php echo $page;?>&amp;body=Link%20is...%0A<?php echo $row["url"];?>%0A%0ATo%20disable...%0Ahttp%3A%2F%2Fsaveaslave.com%2Fmanagelink.php%3Fid_to_edit%3D<?php echo $row["id"];?>%26action%3D0"><?php echo $report; ?></a>
                        </td>
                        <td>
                            <a href="<?php echo $row["url"];?>" target="_blank"><?php echo $row["name"];?></a>
                        </td>
                    </tr>
<?php } ?>
                </table>
            </div>
<?php  

$conn->close();

?>
</body>
</html>