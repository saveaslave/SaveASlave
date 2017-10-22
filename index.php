<?php include 'header-home.php'; ?>



<div class="col-md-8">

<div class="wrap">

					

<span class="text-top">Information and education about modern day slavery.



Millions of men, women, and even children are forced into debt bondage, bonded labor, attached labor, restack, forced labor, indentured servitude, and human trafficking each year. They used for work or sex without pay with threats and even brain washed into loving their pimps today.



<br/>You are somebody that can do something to help.



<br/>Send content; forward this. Tell somebody. This website was incorporated in Texas and needs the help of free people just like you from all over the world.</span>   

 <hr class="style13">	

<?php $_GET['page'] = "index.html";

@include($_SERVER['DOCUMENT_ROOT'] . "/listlink.php");  ?>

<hr class="style11">

<?php 

$_GET['page'] = "index.html";

@include($_SERVER['DOCUMENT_ROOT'] . "/articlelist.php"); 

?>

<h2><?php echo $add_an_article; ?></h2>

<iframe src="addarticle.php" width="725" height="950" scrolling="no" align="top"></iframe>



</div>     

</div>



<?php include 'sidebar-home.php'; ?>	 

<?php include 'footer.php'; ?>