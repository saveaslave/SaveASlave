
<?php include 'header.php'; ?>

<div class="col-md-8">
	
          <div class="wrap">
 <div class="media-body">
                        <h3><?php echo $row["name"]; ?></h3>   
<div class="col-md-4 img-responsive margin-bottom-medium margin-top-medium indent-none"><img src="http://testwebpageonline.com/images/countrymap/<?php echo $row["flag_filename"]; ?>"  height="100%" width="100%" /></div><p> <?php echo $row["description"]; ?> </p>   
<div class="col-md-4 img-responsive margin-bottom-medium margin-top-medium indent-none">
<img src="http://testwebpageonline.com/images/countrymap/<?php echo $row["map_filename"]; ?>" /></div>
</div>
 <hr class="style11">  
 <div class="media-body"><h5><?php echo $row["other_page_text"]; ?></h5>
</div> 
<hr class="style11">
 <div class="videoWrapper"><iframe width="100%" height="338" src="https://www.youtube.com/embed/<?php echo $youtube_id; ?>" frameborder="0" allowfullscreen></iframe><p>&nbsp;</p>  
</div>   <hr class="style11">  
<h2>16:9 Responsive Aspect Ratio</h2>
		<?php include 'listlink.php'; ?>	
</div></div>
		<?php include 'sidebar.php'; ?>	 
				 


