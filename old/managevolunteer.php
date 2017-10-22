<?php include("/password_protect.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>     
 <title>Volunteers</title>
<link rel="stylesheet" type="text/css" href="/css/managecountry.css" media="all">
</head>
<body id="main_body" >
<h3>Fill out the empty form to create a <a href="managevolunteer.php">New User</a>. Click on the user ID to edit a user.  Click <a href="password_protect.php?logout=1">Logout</a> when finished.</h3>
<?
//Connect to the database
include("/database.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["username"] <> '') { 
  // The form was filled out. Add/update the data 
  $id = $_POST["id"];
  // Get the user
  $user_id = (int) substr($_COOKIE['verify'],0,3);  
  $username = $_POST["username"];
  $password = $_POST["password"];
  if ($password == '') {
    $password = rand(99999,999999999);
  } 
  $name = $_POST['name'];
  $email = $_POST['email'];
  $give_credit = $_POST['give_credit'];
  foreach($_POST['page_permissions'] as $selected) {
    $page_permissions = $page_permissions.$selected.",";
  }
  $removed = $_POST["removed"];
  
  if ($id <> '') {
    // It's an update
    if ($_POST["password"] <> '') {
      // update the password
      $sql_pw = "UPDATE  `saveaslave`.`volunteers` SET  `password` = MD5(  '$password' ) WHERE  `volunteers`.`id` ='$id' LIMIT 1 ";
      $conn->query($sql_pw);
    }
    $sql = "UPDATE  `saveaslave`.`volunteers` SET  `username` =  '$username',
`name` =  '$name',
`email` =  '$email',
`give_credit` =  '$give_credit',
`page_permissions` =  '$page_permissions', ";
    if ($removed == "1") {
      $sql = $sql."`removed` =  '1', `removed_date` = NOW( ) , `removed_by` = '$user_id' "; 
    } else {
      $sql = $sql."`removed` =  '0', `removed_date` =  NULL  , `removed_by` = NULL "; 
    }
    $sql = $sql."WHERE `volunteers`.`id` ='$id' LIMIT 1";  
  } else {
    // It's a new volunteer
    $sql = "INSERT INTO  `saveaslave`.`volunteers` (
`id` ,
`username` ,
`password` ,
`name` ,
`email` ,
`give_credit` ,
`page_permissions` ,
`created_by` ,
`created_date` ,
`removed` ,
`removed_date` ,
`removed_by`
)
VALUES (
NULL ,  '$username', MD5('$password') , '$name', '$email', '$give_credit',  '$page_permissions',  '$user_id', NOW() , '0', NULL , NULL)";
    }
    if ($conn->query($sql) === TRUE) {
      echo "Volunteer ".$name." Added/Updated.";
    }
}

// Populate the table for editing
$id = $_GET['id'];
if ($id <> '') {

$sql = "SELECT `id`, `username`, `name`, `email`, `give_credit`, `page_permissions`, `removed` FROM `volunteers` WHERE `id`='".$id."'";

$result = $conn->query($sql);
if (mysqli_num_rows($result) == 0) { 
    echo "<h3>User doesn't exist.</h3>";
}
$row = $result->fetch_assoc();
} else {
$row["give_credit"] = 1;
$row["removed"] = 0;
}

?>
</br>
	<div id="form_container">
		<h1><a>Add/Manage Volunteers</a></h1>
		<form id="form_1039394" class="appnitro"  method="post" action="">
					<div class="form_description">
			<p>Form for Adding/Managing Volunteers</p>
		</div>						
			<ul >
	<li id="li_1" >
		<label class="description" for="id">ID </label>
		<div>
			<input id="id" name="id" class="element text small" type="text" maxlength="255" value="<?php echo $row["id"]; ?>" readonly/> 
		</div> 
		</li>		<li id="li_2" >
		<label class="description" for="username">Username </label>
		<div>
			<input id="username" name="username" class="element text small" type="text" maxlength="255" value="<?php echo $row["username"]; ?>" required /> 
		</div> 
		</li>
                         <li id="li_3" >
		<label class="description" for="password">Password </label>
		<div>
			<input id="password" name="password" class="element text medium" type="text" maxlength="255" value=""/> 
		</div> 
		</li>		<li id="li_4" >
		<label class="description" for="name">Name </label>
		<div>
			<input id="name" name="name" class="element text medium" type="text" maxlength="255" value="<?php echo $row["name"]; ?>" required/> 
		</div> 
		</li>		<li id="li_5" >
		<label class="description" for="email">Email </label>
		<div>
			<input id="email" name="email" class="element text medium" type="text" maxlength="255" value="<?php echo $row["email"]; ?>"/> 
		</div> 
		</li>		<li id="li_6" >
		<label class="description" for="give_credit">Give Credit </label>
		<div>
		<select class="element select small" id="give_credit" name="give_credit"> 
			
<?php
if ($row["give_credit"] == 1 ) {
  echo "<option value='1' selected='selected'>Yes</option>";
  echo "<option value='0'>No</option>";
}
if ($row["give_credit"] == 0) {
  echo "<option value='0' selected='selected'>No</option>";
  echo "<option value='1'>Yes</option>";
}
?>
		</select>
		</div><p class="guidelines" id="guide_6"><small>Do you want site visitors to see that you were a volunteer, or that you added/edited pages?</small></p> 
		</li>		<li id="li_7" >
		<label class="description" for="page_permissions_1">Page Permissions </label>
		<span>
<input id="page_permissions_1" name="page_permissions[]" class="element checkbox" type="checkbox" value="managearticle.php" <?php
if (strpos($row["page_permissions"], "anagearticle.php")) {
  echo " checked";
}
?>>
<label class="choice" for="page_permissions_1">Manage Articles</label>

<input id="page_permissions_2" name="page_permissions[]" class="element checkbox" type="checkbox" value="managecountry.php" <?php
if (strpos($row["page_permissions"], "anagecountry.php")) {
  echo " checked";
}
?>>

<label class="choice" for="page_permissions_2">Manage Countries</label>

<input id="page_permissions_3" name="page_permissions[]" class="element checkbox" type="checkbox" value="managelink.php" <?php
if (strpos($row["page_permissions"], "anagelink.php")) {
  echo " checked";
}
?>>
<label class="choice" for="page_permissions_3">Manage Links</label>

<input id="page_permissions_4" name="page_permissions[]" class="element checkbox" type="checkbox" value="managevolunteer.php" <?php
if (strpos($row["page_permissions"], "anagevolunteer.php")) {
  echo " checked";
}?>>
<label class="choice" for="page_permissions_4">Manage Volunteers</label>

		</span> 
		</li>		<li id="li_8" >
		<label class="description" for="country_permissions">Country Permissions </label>
		<span>
			<input id="country_permissions_1" name="country_permissions_1" class="element checkbox" type="checkbox" value="Haiti" />
<label class="choice" for="country_permissions_1">Not Yet Implemented</label>
		</span> 
		</li>		<li id="li_9" >
		<label class="description" for="removed">Removed </label>
		<div>
		<select class="element select medium" id="removed" name="removed"> 
<?php
if ($row["removed"] == '1' ) {
  echo "<option value='1' selected='selected'>Yes</option>";
  echo "<option value='0'>No</option>";
}
if ($row["removed"] == '0') {
  echo "<option value='0' selected='selected'>No</option>";
  echo "<option value='1'>Yes</option>";
}
?>
		</select>
		</div><p class="guidelines" id="guide_9"><small>To "delete" a user's access, set this field to "Yes".</small></p> 
		</li>
			<li class="buttons">
	    <input type="hidden" name="form_id" value="1039394" />
       	<input id="saveForm" class="button_text" type="submit" name="submit" value="Submit" />
		</li>
			</ul>
		</form>	
		</div>
<?php

// Show the table of volunteers
$sql = "SELECT `id`,`username`,`name`,`email`,`give_credit`,`page_permissions`,`created_by`,`created_date`,`removed`,`removed_date`,`removed_by` FROM `volunteers` ORDER BY `name`";
  $result = $conn->query($sql);
  ?>

<style type="text/css">
.tg  {border-collapse:collapse;border-spacing:0;}
.tg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
.tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
.tg .tg-031e{background-color:#ffffff}
.tg .tg-du3h{background-color:#003399;color:#ffffff}
</style>
</br>
<center><table class="tg">
  <tr>
    <th class="tg-du3h" colspan="11">SaveAslave Volunteers</th>
  </tr>
  <tr>
    <td class="tg-du3h">ID</td>
    <td class="tg-du3h">Username</td>
    <td class="tg-du3h">Name</td>
    <td class="tg-du3h">Email</td>
    <td class="tg-du3h">Give Credit</td>
    <td class="tg-du3h">Page Permissions</td>
    <td class="tg-du3h">Created By</td>
    <td class="tg-du3h">Created Date</td>
    <td class="tg-du3h">Removed</td>
    <td class="tg-du3h">Removed Date</td>
    <td class="tg-du3h">Removed By</td>
  </tr>

<?php 
  while($row = $result->fetch_assoc()) { 
  echo "<tr>";
    echo "<td class='tg-031e'><a href='managevolunteer.php?id=".$row["id"]."'>".$row["id"]."</a></td>";
    echo "<td class='tg-031e'>".$row["username"]."</td>";
    echo "<td class='tg-031e'>".$row["name"]."</td>";
    echo "<td class='tg-031e'><a href='mailto:".$row["email"]."'>".$row["email"]."</a></td>";
    echo "<td class='tg-031e'>".$row["give_credit"]."</td>";
    echo "<td class='tg-031e'>".$row["page_permissions"]."</td>";
    echo "<td class='tg-031e'>".$row["created_by"]."</td>";
    echo "<td class='tg-031e'>".$row["created_date"]."</td>";
    echo "<td class='tg-031e'>".$row["removed"]."</td>";
    echo "<td class='tg-031e'>".$row["removed_date"]."</td>";
    echo "<td class='tg-031e'>".$row["removed_by"]."</td>";
  echo "</tr>";
}

echo "</table></center>";
$conn->close();
?>
</body>
</html>