<?php include 'drudge_header.php'; ?>
<table style="width: 100%">
	<tr>
		<td valign="top" width="150">
<!-- START OF FIRST COLUMN. -->
<!-- ------------------------------------------------------------------------------- -->
		<h2><?php echo $countries; ?></h2>
		<?php include("/printCountryTable.php"); printCountryTable('drudge_view', $language) ?>
		</td>
		<td valign="top">
<!-- START OF SECOND COLUMN. -->
<!-- ------------------------------------------------------------------------------- -->
<div class="col-md-8">
<div class="wrap">
<div class="media">
<?php
$_GET['page'] = "drudge_our-news.php";
$_GET['count'] = "100";
$_GET['style'] = "drudge";

@include($_SERVER['DOCUMENT_ROOT'] . "/articlelist.php");
//@include($_SERVER['DOCUMENT_ROOT'] . "/addarticle.php");  
?>
<h2><?php echo $add_an_article; ?></h2>
<iframe src="addarticle.php" width="725" height="950" scrolling="no" align="top"></iframe>
</div>																										
</div>     
</div>
		</td>
		<td valign="top" width="365">
<!-- START OF THIRD COLUMN. -->
<!-- ------------------------------------------------------------------------------- -->
		<?php include 'drudge_sidebar.php';?>
		</td>
	</tr>
</table>

<?php include 'drudge_footer.php'; ?>

