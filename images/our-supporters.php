
 <?php
/*Do not modify this PHP code when editing the page design.

<?php echo $last_updated.$row["created_date"].$by.$creator; ?>
<?php printCountryList('view') ?>



// Multi-lingual text from variables



<?php echo $disclaimer; ?>

*/
//Connect to the database 
include("/database.php");


// Get the name of the person who last edited the page

$created_by_id = $row["created_by"];

$sql = "SELECT 'name' FROM 'volunteers' WHERE 'give_credit' = '1' AND 'id' = '$created_by_id'";

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



 <div class="col-sm-8 col-md-8">

	

          <div class="wrap">

					

      



 <div class="media">

                    

                    <div class="media-body">

                     <div class="col-xs-10 col-sm-6 col-md-4">  <div class="wrap1">
  <span class="horiz-flag noise "> <h4>Anti-Slavery International</h4></span>
   <img src="images/supporters/anti-slavery.gif">
   <p>
  Anti-Slavery International works at local, national and international levels to eliminate all forms of slavery around the world. Read about our current projects.    
   <br />
   <a href="http://www.antislavery.org/" target="_blank">  Anti-Slavery International </a></p>
</div></div>
<div class="col-xs-10 col-sm-6 col-md-4"><div class="wrap1">
  <span class="horiz-flag noise "> <h4>Humanity United</h4></span>
   <img src="images/supporters/hulogo.png">
   <p>
 Established in 2005, Humanity United is a U.S.-based foundation dedicated to building peace and advancing human freedom.   <br />
   <a href="https://humanityunited.org/" target="_blank">  Anti-Slavery International </a></p>
</div></div>
<div class="col-xs-10 col-sm-6 col-md-4"><div class="wrap1">
  <span class="horiz-flag noise "> <h4>Free the Slaves</h4></span>
   <img src="images/supporters/Free-the-Slaves.png" class="img-responsive">
   <p>
 Free the Slaves exists to help finish the work that earlier generations of abolitionists started. <br/>   <a href="http://www.freetheslaves.net/" target="_blank">  Free the Slaves</a></p>
</div></div>


 

                </div>																										


 <hr class="style11">

<div class="media-body">

                     <div class="col-xs-10 col-sm-6 col-md-4">  <div class="wrap1">
  <span class="horiz-flag noise "> <h4> ECPAT  International</h4></span>
   <img src="images/supporters/END.png">
   <p>
 ECPAT is a global network of organisations working together for the elimination of child prostitution, child pornography and the trafficking of children   <br />
   <a href="http://www.ecpat.net/" target="_blank">   ECPAT  International </a></p>
</div></div>
<div class="col-xs-10 col-sm-6 col-md-4"><div class="wrap1">
  <span class="horiz-flag noise "> <h4>ATEST</h4></span>
   <img src="images/supporters/logo_atest.png">
   <p>
 ATEST is a U.S. based coalition that advocates for solutions to prevent and end all forms of human trafficking and modern slavery around the world.   <a href="https://endslaveryandtrafficking.org/" target="_blank">  ATEST </a></p>
</div></div>
<div class="col-xs-10 col-sm-6 col-md-4"><div class="wrap1">
  <span class="horiz-flag noise "> <h4>International Rescue </h4></span>
   <img src="images/supporters/rescue.png">
   <p>
 The International Rescue Committee helps people whose lives and livelihoods are shattered by conflict and disaster. <a href="http://www.rescue.org/" target="_blank">  International Rescue </a></p>
</div></div>


 

                </div>	
		 <hr class="style11">				
								
  <div class="media-body">

                     <div class="col-xs-10 col-sm-6 col-md-4">  <div class="wrap1">
  <span class="horiz-flag noise "> <h4>Women's Interlink Foundation</h4></span>
   <img src="images/supporters/wif_logo.jpg">
   <p>
 WIF aims to bring about mainstreaming and self reliance among vulnerable women and children who are under-privileged and are victims of social injustice and sexual exploitation.   <br />
   <a href="http://www.antislavery.org/" target="_blank"> Women's Interlink Foundation</a></p>
</div></div>
<div class="col-xs-10 col-sm-6 col-md-4"><div class="wrap1">
  <span class="horiz-flag noise "> <h4> A21</h4></span>
   <img src="images/supporters/a21-logo.png">
   <p>
We work to stop individuals from becoming victims of human trafficking by providing awareness, education to the next generation, and interrupting the demand.   <a href="http://www.a21.org/" target="_blank">  A21</a></p>
</div></div>
<div class="col-xs-10 col-sm-6 col-md-4"><div class="wrap1">
  <span class="horiz-flag noise "> <h4>World Vision</h4></span>
   <img src="images/supporters/world-vision.jpg" class="img-responsive">
   <p>
World Vision is a Christian humanitarian organization dedicated to working with children, families, and their communities worldwide to reach their full potential by tackling the causes of poverty and injustice. - See more at: http://www.worldvision.org/#sthash.rYE7srJ7.dpuf <br/>   <a href="http://www.worldvision.org/" target="_blank">  World Vision</a></p>
</div></div>


 

                </div>																										


<hr/>								
									
</div>	

</div>     

</div>

<?php include 'sidebar-who.php'; ?>	 

				 



<?php include 'footer.php'; ?>

