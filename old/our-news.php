<?php include 'header.php'; ?>
<div class="col-md-8">
<div class="wrap">
<div class="media">
<?php
$_GET['page'] = "our-news.php";
$_GET['count'] = "100";
@include($_SERVER['DOCUMENT_ROOT'] . "/articlelist.php");
//@include($_SERVER['DOCUMENT_ROOT'] . "/addarticle.php");  
?>
<h2><?php echo $add_an_article; ?></h2>
<iframe src="addarticle.php" width="725" height="950" scrolling="no" align="top"></iframe>
</div>																										
</div>     
</div>

<?php include 'sidebar-news.php'; ?>	 

<?php include 'footer.php'; ?>

