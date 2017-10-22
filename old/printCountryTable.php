<?php
// Display Country Menu ($mode = manage or view or drudge_view when clicked)
function printCountryTable($mode, $lang) {
  switch ($mode) {
    case "manage":
    	$page = "managecountry.php";
        break;
    case "drudge_view":
 	   $page = "drudge_country.php";
        break;
    default:
   		$page = "country.php";
}

  //Connect to the database
  include("/database.php");
  if (isset($lang) && $lang <> '') {
    $sql = "SELECT `language`, `name` FROM `countries` WHERE `removed`='0' AND `language` = '".$lang."' ORDER BY name";
  } else {
    $sql = "SELECT `language`, `name` FROM `countries` WHERE `removed`='0' ORDER BY name";
  }
  $countries = $conn->query($sql);

  ?>
<table id="table_<?php echo $page."_".$lang; ?>">

<?php 
  while($row = $countries->fetch_assoc()) {
    if (isset($lang) && $lang <> '') {
       echo "<tr><td><a href=".$page."?name=".urlencode($row["name"])."&lang=".$row["language"].">".strtoupper($row["name"])."</a></td></tr>";
    } 
}
?>
</table>
<?php
}
?>


