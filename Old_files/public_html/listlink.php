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

$sql = "SELECT  `id`,  `url`,  `name` 

FROM  `links` 

WHERE `video` ='1' 

AND `page` = '".$page."'

AND `visible` ='1' 

AND `removed` ='0'";



$result = $conn->query($sql);



?>

<div>

               <table class="gridtable">

                   <tr>
	<th> <?php echo $report; ?></th><th><?php echo $website_links; ?></th>
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