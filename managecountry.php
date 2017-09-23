<?php include("/password_protect.php"); ?>
<?php include 'drudge_header.php'; ?>
<?php include("/printCountryList.php"); ?>

<?php 
if ($_SERVER["REQUEST_METHOD"] == "POST") { 
  // The form was filled out.  
  $id = $_POST["id"];
  $name = $_POST["name"];
  if ($name == '' || $language == '') {
    echo "Cannot create a country without a name or language.</br><a href='/managecountry.php'>New Country Page</a> or <a href='/password_protect.php?logout=1'>Logout</a></br></br>";
  echo "View Country:";
  printCountryList('view','all');
  echo "&nbsp;&nbsp;&nbsp;&nbsp;Manage Country:";
  printCountryList('manage','all');
  break 1;
  }

  // Check if the Country/Language already exists in the database
  if ($id == '') {
    $sql = "SELECT `id` FROM `countries` WHERE `removed`='0' AND `language`='$language' AND `name`='$name'";
    $result = $conn->query($sql);
    if (mysqli_num_rows($result) > 0) { 
      echo "Country: '".$name."' in Language: ".$language." already exists.</br><a href='country.php?name=".$name."&lang=".$language."'>View ".$name." Page</a> or <a href='managecountry.php?name=".$name."&lang=".$language."'>Edit ".$name." Page</a> or <a href='managecountry.php'>New Country Page</a> or <a href='password_protect.php?logout=1'>Logout</a></br></br>";
    echo "View Country:";
    printCountryList('view','all');
    echo "&nbsp;&nbsp;&nbsp;&nbsp;Manage Country:";
    printCountryList('manage','all');
    break;
    }
  }

  $flag_filename = "blank.jpg";
  $imagedir = "/images/countrymap/";
  // Add the data to the database.
  if ($_POST["flag_filename"]) {
    $flag_filename = $_POST["flag_filename"];
  } else {
     $pathname = $imagedir . str_replace("-", " ", strtolower($name)) . "-flag.gif";
     if (file_exists($pathname)) {
        $flag_filename = str_replace("-", " ", strtolower($name)) . "-flag.gif";
     } 
     $pathname = $imagedir . str_replace("-", " ", strtolower($name)) . "-flag.jpg";
     if (file_exists($pathname)) {
        $flag_filename = str_replace("-", " ", strtolower($name)) . "-flag.jpg";
     } 
     $pathname = $imagedir . str_replace("-", " ", strtolower($name)) . "-flag.png";
     if (file_exists($pathname)) {
        $flag_filename = str_replace("-", " ", strtolower($name)) . "-flag.png";
     } 
  }
  $map_filename = "blank.jpg";
  if ($_POST["map_filename"]) {
     $map_filename = $_POST["map_filename"];
  } else {
          $pathname = $imagedir . str_replace("-", " ", strtolower($name)) . ".gif";
     if (file_exists($pathname)) {
        $map_filename = str_replace("-", " ", strtolower($name)) . ".gif";
     } 
     $pathname = $imagedir . str_replace("-", " ", strtolower($name)) . ".jpg";
     if (file_exists($pathname)) {
        $map_filename = str_replace("-", " ", strtolower($name)) . ".jpg";
     } 
     $pathname = $imagedir . str_replace("-", " ", strtolower($name)) . ".png";
     if (file_exists($pathname)) {
        $map_filename = str_replace("-", " ", strtolower($name)) . ".png";
     } 
  }

  if ($_POST["picture_1_filename"]) {
     $picture_1_filename = $_POST["picture_1_filename"];
  } else {
     $picture_1_filename = "blank.jpg";
  }
  if ($_POST["picture_2_filename"]) {
     $picture_2_filename = $_POST["picture_2_filename"];
  } else {
     $picture_2_filename = "blank.jpg";
  }
  $description = $_POST["description"];
  $other_page_text = $_POST["other_page_text"];
  $world_factbook_link = $_POST["world_factbook_link"];
  $newsfeed = $_POST["newsfeed"];
  $ad = $_POST["ad"];

  // Process the uploaded files
  $target_dir = "/images/countrymap/";
  $target_file = $target_dir . basename($_FILES["flag_filename"]["name"]);
  // Check if image file is a actual image or fake image
  if(getimagesize($_FILES["flag_filename"]["tmp_name"])) {
   //echo "File is an image - " . $check["mime"] . ".";
   if (move_uploaded_file($_FILES["flag_filename"]["tmp_name"], $target_file)) {
      if ($flag_filename !== "blank.jpg"){
         //Delete the former image file
         $oldfile = $target_dir.$flag_filename;
         //unlink($oldfile);
      }
      $flag_filename = $_FILES["flag_filename"]["name"];
      //echo "File ".$flag_filename." moved";
   }
  }
  $target_file = $target_dir . basename($_FILES["map_filename"]["name"]);
  if(getimagesize($_FILES["map_filename"]["tmp_name"])) {
   if (move_uploaded_file($_FILES["map_filename"]["tmp_name"], $target_file)) {
      if ($map_filename !== "blank.jpg"){
         $oldfile = $target_dir.$map_filename;
         //unlink($oldfile);
      }
      $map_filename = $_FILES["map_filename"]["name"];
   }
  }
  $target_file = $target_dir . basename($_FILES["picture_1_filename"]["name"]);
  if(getimagesize($_FILES["picture_1_filename"]["tmp_name"])) {
   if (move_uploaded_file($_FILES["picture_1_filename"]["tmp_name"], $target_file)) {
      if ($picture_1_filename !== "blank.jpg"){
         $oldfile = $target_dir.$picture_1_filename;
         //unlink($oldfile);
      }
      $picture_1_filename = $_FILES["picture_1_filename"]["name"];
   }
  }
  $target_file = $target_dir . basename($_FILES["picture_2_filename"]["name"]);
  if(getimagesize($_FILES["picture_2_filename"]["tmp_name"])) {
   if (move_uploaded_file($_FILES["picture_2_filename"]["tmp_name"], $target_file)) {
      if ($picture_2_filename !== "blank.jpg"){
         $oldfile = $target_dir.$picture_2_filename;
         //unlink($oldfile);
      }
      $picture_2_filename = $_FILES["picture_2_filename"]["name"];
   }
  }

  // Validate description
  if ($description == '') {
     $description = mysqli_real_escape_string($conn, $default_description);
  }  
  // Validate description
  if ($other_page_text == '') {
     $other_page_text = mysqli_real_escape_string($conn, $default_other_page_text);
  }
  // Validate Newsfeed
  if ($newsfeed == '') {
     $newsfeed = mysqli_real_escape_string($conn, $default_newsfeed);
  }
  // Remove all illegal characters from url
  $world_factbook_link = filter_var($world_factbook_link, FILTER_SANITIZE_URL);
  // Validate url
  if (filter_var($world_factbook_link, FILTER_VALIDATE_URL) === false) {
      $url = "http://".$world_factbook_link;       //add the http prefix
      if (filter_var($world_factbook_link, FILTER_VALIDATE_URL) === false) {
         $world_factbook_link = "https://www.cia.gov/library/publications/the-world-factbook/index.html";
      }
  }
  // Get the user
  $user_id = substr($_COOKIE['verify'],0,3);
  //Insert into the database
  $sql = "INSERT INTO  `saveaslave`.`countries` (
`id` ,
`language` ,
`name` ,
`flag_filename` ,
`map_filename` ,
`picture_1_filename` ,
`picture_2_filename` ,
`description` ,
`other_page_text` ,
`world_factbook_link` ,
`newsfeed` ,
`ad` ,
`created_by` ,
`created_date` ,
`removed` ,
`removed_date` ,
`removed_by`
)
VALUES (
NULL ,  '$language',  '$name',  '$flag_filename',  '$map_filename',  '$picture_1_filename',  '$picture_2_filename',  '$description',  '$other_page_text',  '$world_factbook_link',  '$newsfeed',  '$ad',  '$user_id', NOW( ) , '0', NULL , NULL
);
";
  if ($conn->query($sql) === TRUE) {
     // If editing, remove the previous record with ID of $id
     if ($id > 0) {
        $sql = "UPDATE `saveaslave`.`countries` SET `removed` = '1',
`removed_date` = NOW( ), `removed_by` =  '$user_id' WHERE  `countries`.`id` =$id LIMIT 1";
        $conn->query($sql);
     }
     echo "Country: '".$name."' in Language: ".$language." has been added/updated.</br><a href='country.php?name=".$name."&lang=".$language."'>View ".$name." Page</a> or <a href='managecountry.php?name=".$name."&lang=".$language."'>Edit ".$name." Page</a> or <a href='managecountry.php'>New Country Page</a> or <a href='password_protect.php?logout=1'>Logout</a> </br></br>";
     echo "View Country:";
     printCountryList('view','all');
     echo "&nbsp;&nbsp;&nbsp;&nbsp;Manage Country:";
     printCountryList('manage','all');
     break;
  } else {
    echo "Database Error: " . $sql . "<br>" . $conn->error;
    exit;
  }
$conn->close();
}

// Check if we're editing a country, and if so, populate the default values
if (isset($_GET['name'])) {
	$name = $_GET['name'];
	$language = $_GET['lang'];
	$sql = "SELECT `id`,`language`,`name`,`flag_filename`,`map_filename`,`picture_1_filename`,`picture_2_filename`,`description`,`other_page_text`,`world_factbook_link`,`newsfeed`,`ad`,`created_by`,`created_date` FROM `countries` WHERE `removed`='0' AND `language`='$language' AND `name`='$name'";
	$result = $conn->query($sql);
	$editing = 0;
	if (mysqli_num_rows($result) == 0) { 
  	  echo "The country page in that language doesn't exist yet. Create a new page.";
	}
	$row = $result->fetch_assoc();
	$conn->close();
} else {
   $language = "en";
   $editing = 1;
}
?>
	<div id="form_container">
		<h1><a>Add/Manage Country</a></h1>
		<form id="form_1039394" class="appnitro" enctype="multipart/form-data" method="post" enctype="multipart/form-data" action="">
					<div class="form_description">
                        <h4>View Country:<?php printCountryList('view','all'); ?>&nbsp;&nbsp;&nbsp;&nbsp;Manage Country:<?php printCountryList('manage','all'); ?> </h4>
		</div>						
			<ul >
			  <li id="li_1" >
		<label class="description" for="element_1">ID </label>
		<div>
			<input id="id" name="id" class="element text small" type="text" maxlength="255" value="<?php echo $row["id"]; ?>" readonly/> 
		</div> 
		</li>		<li id="li_2" >
		<label class="description" for="element_2">Language </label>
		<div>
			<input id="language" name="language" class="element text small" type="text" maxlength="255" value="<?php echo $language;?>" 
<?php
if ($editing == 1) {
  echo " required";
} else {
  echo " readonly";
}
?>/> 
		</div> 
		</li>		<li id="li_3" >
		<label class="description" for="element_3">Country Name </label>
		<div>
			<input id="name" name="name" class="element text medium" type="text" maxlength="255" value="<?php echo $name; ?>" required/> 
		</div><p class="guidelines" id="guide_3"><small>Country Name</small></p> 
		</li>		<li id="li_4" >
		<label class="description" for="element_4">Flag Image </label>
		<div>
			<input id="flag_filename" name="flag_filename" class="element text small" type="text" maxlength="255" value="<?php echo $row["flag_filename"]; ?>" readonly/><input id="flag_filename" name="flag_filename" class="element file" type="file"/> 
		</div>  
		</li>		<li id="li_5" >
		<label class="description" for="element_5">Map Image </label>
		<div>
			<input id="map_filename" name="map_filename" class="element text small" type="text" maxlength="255" value="<?php echo $row["map_filename"]; ?>" readonly/><input id="map_filename" name="map_filename" class="element file" type="file"/> 
		</div>  
		</li>		<li id="li_6" >
		<label class="description" for="element_6">Picture 1 </label>
		<div>
			<input id="picture_1_filename" name="picture_1_filename" class="element text small" type="text" maxlength="255" value="<?php echo $row["picture_1_filename"]; ?>" readonly/><input id="picture_1_filename" name="picture_1_filename" class="element file" type="file"/> 
		</div>  
		</li>		<li id="li_7" >
		<label class="description" for="element_7">Picture 2 </label>
		<div>
			<input id="picture_2_filename" name="picture_2_filename" class="element text small" type="text" maxlength="255" value="<?php echo $row["picture_2_filename"]; ?>" readonly/><input id="picture_2_filename" name="picture_2_filename" class="element file" type="file"/> 
		</div>  
		</li>		<li id="li_8" >
		<label class="description" for="element_8">Country Description </label>
		<div>
			<textarea id="description" name="description" class="element textarea medium"><?php echo $row["description"]; ?></textarea> 
		</div><p class="guidelines" id="guide_8"><small>Leave blank for default text.</small></p> 
		</li>		<li id="li_9" >
		<label class="description" for="element_9">Other Page Text </label>
		<div>
			<textarea id="other_page_text" name="other_page_text" class="element textarea medium"><?php echo $row["other_page_text"]; ?></textarea> 
		</div><p class="guidelines" id="guide_9"><small>Leave blank for default text.</small></p>  
		</li>		<li id="li_10" >
		<label class="description" for="element_10">World Factbook Link </label>
		<div>
			<input id="world_factbook_link" name="world_factbook_link" class="element text medium" type="text" maxlength="255" value="<?php echo $row["world_factbook_link"]; ?>"/> 
		</div><p class="guidelines" id="guide_10"><small>Leave blank for default.</small></p>  
		</li>		<li id="li_11" >
		<label class="description" for="element_11">News-feed </label>
		<div>
			<textarea id="newsfeed" name="newsfeed" class="element textarea medium"><?php echo $row["newsfeed"]; ?></textarea> 
		</div><p class="guidelines" id="guide_11"><small>Leave blank for default.</small></p>  
		</li>		<li id="li_12" >
		<label class="description" for="element_12">Advertisement </label>
		<div>
			<textarea id="ad" name="ad" class="element textarea medium"><?php echo $row["ad"]; ?></textarea> 
		</div> 
		</li>
					<li class="buttons">
			    <input type="hidden" name="form_id" value="1039394" />
    			<input id="saveForm" class="button_text" type="submit" name="submit" value="Submit" />
		</li>
			</ul>
		</form>	
<a href="password_protect.php?logout=1">Logout</a>
	</div>

<?php include 'drudge_footer.php';?>