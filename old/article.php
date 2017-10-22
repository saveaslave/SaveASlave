<?php
/*Do not modify this PHP code when editing the page design.
The following fields are available from the database, and can be accessed as variables using...
<?php echo $row["name"]; ?>
<?php echo $row["url"]; ?>
<?php echo $row["full_text"]; ?>
<?php echo $row["picture_1_filename"]; ?>
<?php echo $row["picture_2_filename"]; ?>
<?php echo $row["picture_3_filename"]; ?>
<?php echo $row["page"]; ?>
<?php echo $row["counter"]; ?>
<?php echo $row["date_added"]; ?>
<?php echo $row["added_by_ip"]; ?>

// Multi-lingual text from variables
<?php echo $our_news; ?>
<?php echo $unknown_article; ?>
<?php echo $unknown_article_text; ?>
<?php echo $article_link; ?>
*/

ini_set( 'default_charset', 'UTF-8' );

//Connect to the database
include("/database.php");
$id = $_GET['id'];
$language = $_GET['lang'];
switch ($language) {
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

$sql = "SELECT `url`,`name`,`full_text`,`picture_1_filename`,`picture_2_filename`,`picture_3_filename`,`page`,`counter`,`added_by_ip`,`date_added` FROM `articles` WHERE `removed`='0' AND `visible`='1' AND `language`='$language' AND `id`='$id'";
$result = $conn->query($sql);
if (mysqli_num_rows($result) == 0 ) { 
  //echo 'Unknown Article or Language trying for that article in English'; 
$sql = "SELECT `url`,`name`,`full_text`,`picture_1_filename`,`picture_2_filename`,`picture_3_filename`,`page`,`added_by_ip`,`date_added` FROM `articles` WHERE `removed`='0' AND `visible`='1' AND `id`='$id'";
  $result = $conn->query($sql);
  if (mysqli_num_rows($result) == 0 ) { 
    ?>
    <html>
      <head>
        <title><?php echo $unknown_article; ?></title>
        <META http-equiv="refresh" content="5;URL=http://www.saveaslave.com">
      </head>
      <body bgcolor="#ffffff">
        <center><?php echo $unknown_article_text; ?>
        </center>
      </body>
    </html>
    <?php
    die();
  }
}

$row = $result->fetch_assoc();
?>

<?php include 'header.php'; ?>
<div class="col-md-8">
<div class="onlycssmenu-paging clearfix">
<a href="our-news.php">&#10094;&#10094; <?php echo $our_news; ?></a>
<span class="active"><?php echo $row["name"]; ?></span>
</div>
<div class="wrap">
<div class="media">
<div class="media-body">
<h3><?php echo $row["name"]; ?></h3>
<?php
if (isset($row["picture_1_filename"]) && $row["picture_1_filename"] <> '') {
?>										 <div class="col-md-4 img-responsive margin-bottom-medium margin-top-medium indent-none">
   <img class="media-object" src="images/article/<?php echo $row["picture_1_filename"]; ?>" alt="">
</div>
<?php
}
?>
 
<p>
<?php echo stripslashes($row["full_text"]); ?>
</p>              
</div>
</div>	
<hr class="style11">	
<div class="media">
<div class="media-body">
<?php
if (isset($row["picture_2_filename"]) && $row["picture_2_filename"] <> '') {
?>
<div class="col-md-10 col-centered">
   <img src="images/article/<?php echo $row["picture_2_filename"]; ?>" class="img-responsive" alt="<?php echo $row["picture_2_filename"]; ?>" />
</div><br/> 
<?php
}
if (isset($row["picture_3_filename"]) && $row["picture_3_filename"] <> '') {
?>
<div class="col-md-10 col-centered">
   <img src="images/article/<?php echo $row["picture_3_filename"]; ?>" class="img-responsive" alt="<?php echo $row["picture_3_filename"]; ?>" />
</div>
<?php
}
?>
</div>
<br><span class="label label-danger"><a href="mailto:saveaslave@aol.com?subject=Inappropriate%20Article&amp;body=Article%20is...%0A<?php echo $row["name"];?>%0A%0ATo%20disable...%0Ahttp%3A%2F%2Fsaveaslave.com%2Fmanagearticle.php%3Fid_to_edit=<?php echo $id;?>%26action%3D0"><?php echo $report; ?></a></span>

<?php 
if (isset($row["url"]) && $row["url"] <> '') {
?>
<span class="label label-danger"><a href="<?php echo $row["url"]; ?>" target="_blank"><?php echo $article_link; ?></span></a>
<?php
}
?>
</div>	
<?php
// Update Hit Counter
$newhits=$row["counter"]+1;
$sql = "UPDATE articles SET counter='".$newhits."' WHERE id=".$id;
if ($conn->query($sql) === TRUE) {
    //echo "Counter increased.";
}
//echo "Counter=".$row["counter"];
?>

<hr class="style13">	
<?php $_GET['page'] = "article.php";
//@include($_SERVER['DOCUMENT_ROOT'] . "/addarticle.php");  ?>	 
<h2><?php echo $add_an_article; ?></h2>
<iframe src="addarticle.php" width="725" height="950" scrolling="no" align="top"></iframe>	
</div>    
</div> 
<?php include 'sidebar-news.php'; ?>	 
 
<?php include 'footer.php'; ?>