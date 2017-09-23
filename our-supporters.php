
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
World Vision is a Christian humanitarian organization dedicated to working with children, families, and their communities worldwide. <br/>   <a href="http://www.worldvision.org/" target="_blank">  World Vision</a></p>
</div></div>


 

                </div>																										

 <hr class="style11">				
								
  <div class="media-body">

                     <div class="col-xs-10 col-sm-6 col-md-4">  <div class="wrap1">
  <span class="horiz-flag noise "> <h4>International COCOA</h4></span>
   <img src="images/supporters/cocoa.png">
   <p>
 Established in 2002, the International Cocoa Initiative (ICI) is the leading organisation promoting child protection in cocoa-growing communities.<br/>
    <a href="http://www.cocoainitiative.org/" target="_blank"> INTERNATIONAL COCOA</a></p>
</div></div>
<div class="col-xs-10 col-sm-6 col-md-4"><div class="wrap1">
  <span class="horiz-flag noise "> <h4>Shared Hope International </h4></span>
   <img src="images/supporters/sharehope.png">
   <p>
Shared Hope International is dedicated to bringing an end to sex trafficking through our three-prong approach – prevent, restore, and bring justice. <br/>
   <a href="http://sharedhope.org/" target="_blank">Shared Hope International </a></p>
</div></div>
<div class="col-xs-10 col-sm-6 col-md-4"><div class="wrap1">
  <span class="horiz-flag noise "> <h4>Restore NYC</h4></span>
   <img src="images/supporters/fpo-logo.gif" class="img-responsive">
   <p>
Restore NYC's mission is to end sex trafficking in New York and restore the well-being and independence of foreign national survivors. <br/>   <a href="http://restorenyc.org/" target="_blank">  Restore NYC</a></p>
</div></div>


 

                </div>	
								
	 <hr class="style11">				
								
  <div class="media-body">

                     <div class="col-xs-10 col-sm-6 col-md-4">  <div class="wrap1">
  <span class="horiz-flag noise "> <h4>Children on the Edge</h4></span>
   <img src="images/supporters/children-on-the edge.png">
   <p>
Children on the Edge exist to help marginalised and forgotten children, who are living on the edge of their societies.<br/>
    <a href="http://www.childrenontheedge.org/" target="_blank"> Children on the Edge</a></p>
</div></div>
<div class="col-xs-10 col-sm-6 col-md-4"><div class="wrap1">
  <span class="horiz-flag noise "> <h4>Rescue Foundation </h4></span>
   <img src="images/supporters/rescue-foundation.jpg">
   <p>
Over a period of last eight years, we have achieved the organizational capabilities and experience to fulfill our duties to this most neglected segment of our society.  <br/>
   <a href="http://www.rescuefoundation.net/" target="_blank">Rescue Foundation</a></p>
</div></div>
<div class="col-xs-10 col-sm-6 col-md-4"><div class="wrap1">
  <span class="horiz-flag noise "> <h4> Child Wise</h4></span>
   <img src="images/supporters/child-wise.jpg" class="img-responsive">
   <p>
Established in 1991, Child Wise is one of Australia's leading not-for-profit child abuse prevention organisations. <br/>   <a href="http://www.childwise.org.au/" target="_blank">   Child Wise</a></p>
</div></div>


 

                </div>								
<hr class="style11">				
								
  <div class="media-body">

                     <div class="col-xs-10 col-sm-6 col-md-4">  <div class="wrap1">
  <span class="horiz-flag noise "> <h4>VITAL VOICES</h4></span>
   <img src="images/supporters/logo_header.jpg">
   <p>
Our mission is to invest in women leaders who improve the world.We search the world for a woman leader with a daring vision. <br/>
    <a href="http://www.vitalvoices.org/" target="_blank"> VITAL VOICES</a></p>
</div></div>
<div class="col-xs-10 col-sm-6 col-md-4"><div class="wrap1">
  <span class="horiz-flag noise "> <h4>MIAFW  </h4></span>
   <img src="images/supporters/made-free.png">
   <p>
We built Slavery Footprint to help understand how slavery touches our lives and connect concerned citizens. <br/>
   <a href="http://www.rescuefoundation.net/" target="_blank">MIAFW </a></p>
</div></div>
<div class="col-xs-10 col-sm-6 col-md-4"><div class="wrap1">
  <span class="horiz-flag noise "> <h4> ASSET</h4></span>
   <img src="images/supporters/Asset-Logo.jpg" class="img-responsive">
   <p>
ASSET is dedicated to the eradication of slavery through amplifying the victims voice and supporting systemic solutions. 
<br/>   <a href="http://assetcampaign.org/" target="_blank">   ASSET</a></p>
</div></div>


 

                </div>	
<hr class="style11">				
								
  <div class="media-body">

                     <div class="col-xs-10 col-sm-6 col-md-4">  <div class="wrap1">
  <span class="horiz-flag noise "> <h4>LOVE146</h4></span>
   <img src="images/supporters/love-logo.png">
   <p>
Love146 is an international human rights organisation working to end child trafficking and exploitation through survivor care and prevention.  <br/>
    <a href="https://love146.org/" target="_blank"> LOVE146</a></p>
</div></div>
<div class="col-xs-10 col-sm-6 col-md-4"><div class="wrap1">
  <span class="horiz-flag noise "> <h4>Solidarity Center  </h4></span>
   <img src="images/supporters/Solidarity_Center.png">
   <p>
stands with workers as they defend their right to freedom of association, supporting them as they organize, advocate and build worker voice. <br/>
   <a href="http://www.solidaritycenter.org/" target="_blank">Solidarity Center </a></p>
</div></div>
<div class="col-xs-10 col-sm-6 col-md-4"><div class="wrap1">
  <span class="horiz-flag noise "> <h4> Apne Aap Women </h4></span>
   <img src="images/supporters/ApneAap_logo.png" class="img-responsive">
   <p>
Apne Aap helps marginalized women and girls work collectively to lift themselves out of the sex industry.
<br/>   <a href="http://apneaap.org/" target="_blank">   Apne Aap Women </a></p>
</div></div>


 

                </div>									
<hr class="style11">				
								
  <div class="media-body">

                     <div class="col-xs-10 col-sm-6 col-md-4">  <div class="wrap1">
  <span class="horiz-flag noise "> <h4>Safe Horizon</h4></span>
   <img src="images/supporters/safe-horizon.png">
   <p>
Established in 1978, Safe Horizon is the largest non-profit victim services agency in the United States<br/>
    <a href="http://www.safehorizon.org/" target="_blank"> Safe Horizon</a></p>
</div></div>
<div class="col-xs-10 col-sm-6 col-md-4"><div class="wrap1">
  <span class="horiz-flag noise "> <h4>End Slavery Now </h4></span>
   <img src="images/supporters/logo_endslaverynow.png">
   <p>
To challenge and inspire everyone to take courageous steps against slavery today.  <br/>
   <a href="http://endslaverynow.org/" target="_blank">End Slavery Now </a></p>
</div></div>
<div class="col-xs-10 col-sm-6 col-md-4"><div class="wrap1">
  <span class="horiz-flag noise "> <h4>  Maiti Nepal </h4></span>
   <img src="images/supporters/maitilogo.png" class="img-responsive">
   <p>
Maiti's focus has always been on prevention of girl trafficking, a burning issue for Nepal. 
<br/>   <a href="http://www.maitinepal.org/" target="_blank">  Maiti Nepal </a></p>
</div></div>


 

                </div>									
<hr/>		
<hr class="style11">				
								
  <div class="media-body">

                     <div class="col-xs-10 col-sm-6 col-md-4">  <div class="wrap1">
  <span class="horiz-flag noise "> <h4>Movements</h4></span>
   <img src="images/supporters/movements-logo-large.png">
   <p>
<a href="http://www.movements.org/" target="_blank">Movements.org</a> is a new platform that allows people everywhere to help protect basic freedoms.<br>
<a href="http://www.movements.org/" target="_blank">Movements</a>
</p>
</div></div>


                </div>									
<hr/>							
									
</div>	

</div>     

</div>

<?php include 'sidebar-supporters.php'; ?>	 

				 



<?php include 'footer1.php'; ?>