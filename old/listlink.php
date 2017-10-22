<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="UTF-8">
<title><?php echo $website_links; ?></title>
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
AND `removed` ='0' ORDER BY `date_added` DESC";

$result = $conn->query($sql);
if ( $result->num_rows <> 0 ) {
?>

<div>
              <table class="gridtable">
                   <tr>
	<th> <?php echo $report; ?></th><th><?php echo $website_links; ?></th>
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
}

$sql = "SELECT  `id`,  `url`,  `name` 
FROM  `links` 
WHERE `video` ='0'
AND `page` = '".$page."'
AND `visible` ='-1' 
AND `removed` ='0' ORDER BY `date_added` DESC";

$result = $conn->query($sql);
if ( $result->num_rows <> 0 ) {
?>

<div>
              <table class="gridtable">
                   <tr>
	<th> <?php echo $report; ?></th><th><?php echo $permanent_links; ?></th>
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
}

$sql = "SELECT  `id`,  `url`,  `name` 
FROM  `links` 
WHERE `video` ='1' 
AND `page` = '".$page."'
AND `visible` ='1' 
AND `removed` ='0' ORDER BY `date_added` DESC LIMIT 100";

$result = $conn->query($sql);
if ( $result->num_rows <> 0 ) {

?>
<div>
<table class="gridtable">
  <tr>
   <th> <?php echo $report; ?></th><th><?php echo $video_links; ?></th>
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
}$conn->close();
?>

</body>
</html>