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

$mapfilename = $row["map_filename"];

$newsfeed = $row["newsfeed"];





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

<?php include 'header.php'; ?>



<div class="col-sm-8 col-md-8 col-lg-8">

	

          <div class="wrap">

 <div class="media-body">

                        <h3><?php echo $row["name"]; ?></h3>   

<div class="col-md-4 img-responsive margin-bottom-medium margin-top-medium indent-none"><img src="http://testwebpageonline.com/images/countrymap/<?php echo $row["flag_filename"]; ?>"  height="100%" width="100%" /></div>
<p> <?php echo $row["description"]; ?> </p>   

<div class="col-md-4 img-responsive margin-bottom-medium margin-top-medium indent-none"><img src="http://testwebpageonline.com/images/countrymap/<?php echo $mapfilename;?>"  height="100%" width="100%" /></div>

</div>

 <hr class="style11">  

 <div class="media-body">
 <h5><?php echo $row["other_page_text"]; ?></h5>

</div> 

<hr class="style11">


 <div class="row row-centered"><div class="col-md-8 col-centered"> <div class="videoWrapper"><iframe width="100%" height="338" src="https://www.youtube.com/embed/<?php echo $youtube_id; ?>" frameborder="0" allowfullscreen></iframe><p>&nbsp;</p>  

</div></div></div>

<hr class="style11">  

<h2>Website Links</h2>

		<?php include 'listlink.php'; ?>	

</div></div>
		<?php include 'sidebar.php'; ?>	 
				 

<?php include 'footer.php'; ?>
