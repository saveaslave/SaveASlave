<?php 

if (isset($_GET['page'])) {
	$page = $_GET['page'];
}
if (isset($_GET['style'])) {
	$style = $_GET['style']."_";
} else {
	$style = '';
}
if (isset($_GET['count']) && $_GET['count'] <> '') {
   $count = $_GET['count'];
} else {
   $count = 5;
}  
//ini_set( 'default_charset', 'UTF-8' );
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf8">
<title><?php echo $article ?></title>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>
<body id="main_body" >
<div class="container">
<div class="row media">
<?php 
//Connect to the database
include("/database.php");
$sql = "SELECT `id`,`url`,`name`,LEFT(`full_text`,750) as full_text,`picture_1_filename` FROM `articles` WHERE `removed`='0' AND `visible`='1' AND `language`='$language' AND `page`='$page' ORDER BY `date_added` DESC LIMIT $count";
$result = $conn->query($sql);
if (mysqli_num_rows($result) == 0 ) { 
  //echo 'No results from previous query, from any page'; 
  $sql = "SELECT `id`,`url`,`name`,LEFT(`full_text`,750) as full_text,`picture_1_filename` FROM `articles` WHERE `removed`='0' AND `visible`='1' AND `language`='$language'  ORDER BY `date_added` DESC LIMIT $count";
}
$result = $conn->query($sql);

if (mysqli_num_rows($result) == 0 ) { 
  //echo 'No results from previous query, try in English from any page'; 
  $sql = "SELECT `id`,`url`,`name`,LEFT(`full_text`,750) as full_text,`picture_1_filename` FROM `articles` WHERE `removed`='0' AND `visible`='1' AND `language`='en' ORDER BY `date_added` DESC LIMIT $count";
}
$result = $conn->query($sql);
while($row = $result->fetch_assoc()) { 
?>


<?php

if (isset($row["picture_1_filename"]) && $row["picture_1_filename"] <> '') {
	list($width, $height, $type, $attr)  = getimagesize("/images/article/".$row["picture_1_filename"]);
	if ($width > 250) {
   		$width = 250;
	}

?>
<div class="col-xs-12 col-sm-3 col-md-3">
<a class="pull-left" href="<?php echo $style;?>article.php?id=<?php echo $row["id"]; ?>">
<img class="media-object" src="images/article/<?php echo $row["picture_1_filename"]; ?>" alt="" width="<?php echo $width; ?>">
</a>
<?php
}
?>
<div class="media-body">
<h3><?php echo $row["name"]; ?></h3>
<?php echo stripslashes($row["full_text"]); ?>
<span class="label label-danger">
<!--
<a href="mailto:saveaslave@aol.com?subject=Inappropriate%20Article&amp;body=Article%20is...%0A<?php echo $row["name"];?>%0A%0ATo%20disable...%0Ahttp%3A%2F%2Fsaveaslave.com%2Fmanagearticle.php%3Fid_to_edit=<?php $row["id"];?>%26action%3D0"><?php echo $report; ?></a>
-->
&nbsp;&nbsp;
<a href="<?php echo $style;?>article.php?id=<?php echo $row["id"]; ?>"><?php echo $read_more; ?></a></span>
</div>
</div> <!-- end .col-sm-3 -->
</div> <!-- end .row -->
</div> <!-- end .container -->
<hr class="style11">	
<?php 
} 
$conn->close();
?>
</body>
</html>