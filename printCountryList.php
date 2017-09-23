<?php
// Display Country Menu ($mode = manage, view or drudge_view when clicked) and ($lang = language code or 'all')
function printCountryList($mode, $lang) {
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
  if (isset($lang) && $lang <> '' && $lang <> 'all') {
    $sql = "SELECT `language`,`name` FROM `countries` WHERE `removed`='0' AND `language` = '".$lang."' ORDER BY name";
  } else {
    $sql = "SELECT `language`,`name` FROM `countries` WHERE `removed`='0' ORDER BY name";
  }
  $result = $conn->query($sql);
  ?>
<select name="menu_<?php echo $page; ?>" id="menu_<?php echo $page."_".$lang; ?>">
<option value=""> </option>
<?php 
  while($row = $result->fetch_assoc()) {
    if (isset($lang) && $lang <> '' && $lang <> 'all') {
       echo "<option value='".$page."?name=".$row["name"]."&lang=".$row["language"]."'>".$row["name"]."</option>";
    } else {
       echo "<option value='".$page."?name=".$row["name"]."&lang=".$row["language"]."'>".$row["name"]."&nbsp;[".$row["language"]."]</option>";
    }
}
?>
</select>
<script type="text/javascript">
 var urlmenu = document.getElementById( 'menu_<?php echo $page."_".$lang; ?>' );
 urlmenu.onchange = function() {
      window.open( this.options[ this.selectedIndex ].value , "_self");
 };
</script>
  <?php
}
?>


