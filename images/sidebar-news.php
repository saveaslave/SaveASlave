<?php

// Get dynamic video URLs

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

WHERE `video` ='1'

AND `visible` ='1' 

AND `removed` ='0' 

AND `name` LIKE '% - YouTube%'

ORDER BY `date_added` DESC LIMIT 3";



$result = $conn->query($sql);



?>

<div class="col-sm-4 col-md-4">

 <ol class="breadcrumb">

           <li><a href=""><img src="images/social1.png" class="img-responaive" alt="social1 (1K)" /></a> 

					 </li><li><a href="#"><img src="images/social2.png" class="img-responaive" alt="social1 (1K)" /></a> </li><li><a href="#"><img src="images/social3.png" class="img-responaive" alt="social1 (1K)" /></a></li>
           <!-- Added TripIt Icon by James Arbaugh on December 22, 2016 by request of Marty -->
           <li><a href="https://www.tripit.com/"><img src="images/tripit_icon_thumb_flat.png" class="img-responaive" alt="social4 (1K)" /></a>
					 </li>
					 <li>
					    <div id="TA_socialButtonIcon198" class="TA_socialButtonIcon"><ul id="1ZQZFtMfz" class="TA_links fMYtY6p6Nv4j"><li id="EXCbzZzbK" class="pU5tSr"><a target="_blank" href="https:/www.tripadvisor.com/Tourism-g54470-Travelers_Rest_South_Carolina-Vacations.html"><img src="https:/www.tripadvisor.com/img/cdsi/img2/branding/socialWidget/20x20_green-21690-2.png"/></a></li></ul></div><script src="https:/www.jscache.com/wejs?wtype=socialButtonIcon&uniq=198&locationId=54470&color=green&size=sm&lang=en_US&display_version=2"></script>
					 </li>
       </ol>	

         

<!-- Removed by James Arbaugh on January 12, 2016 by request of Marty          

  <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">

<input type="hidden" name="cmd" value="_s-xclick"><input type="hidden" name="hosted_button_id" value="HD9MBDFHBLNFA">

<input type="image" src="images/gift_button.png" class="btn btn-primary btn-lg img-responsive" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">

<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1"></form> 

-->

<div class="wrap">

<h3>The New York Times<br/>HUMAN TRAFFICKING</h3>



<script type="text/javascript">



var newsfeed=new gfeedpausescroller("example3", "example3class", 2500, "_new")

newsfeed.addFeed("nytimes", "http://topics.nytimes.com/top/reference/timestopics/subjects/h/human_trafficking/index.html?rss=1") //Specify "label" plus URL to RSS feed

newsfeed.displayoptions("datetime snippet") //show the specified additional fields

newsfeed.setentrycontainer("p") //Display each entry as a paragraph

newsfeed.filterfeed(8, "date") //Show 8 entries, sort by date

newsfeed.entries_per_page(5)

newsfeed.init() //Always call this last



</script>

</div>

<div class="wrap">

<?php while($row = $result->fetch_assoc()) { 

   $other_url = 1;

   if ( strrpos($row["url"], '_')  ) {

      $video_url = "https://www.youtube.com/embed/".substr($row["url"],strrpos($row["url"], '_'));

      $other_url = 0;

   } 

   if ( strrpos($row["url"], '=')  ) {

      $video_url = "https://www.youtube.com/embed/".substr($row["url"],strrpos($row["url"], '=')+1);

      $other_url = 0;

   }

   if ( $other_url == 1 ) {

      $video_url = "https://www.youtube.com/embed/".substr($row["url"],strrpos($row["url"], '/')+1);

   }

   ?>

   <h5><?php echo substr($row["name"], 0, strrpos($row["name"], ' - YouTube' ));?></h5>

   <iframe width="100%" src="<?php echo $video_url;?>" frameborder="0" allowfullscreen></iframe>

<?php } ?>

</div>

 <div class="wrap">





<?php include 'addlink.php'; ?>	   </div> 

</div></div>





	





	