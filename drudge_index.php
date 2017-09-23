<?php include 'drudge_header.php';?>
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
			<h2><?php echo $links; ?></h2>
			<?php 
			$_GET['page'] = "index.html";
			@include($_SERVER['DOCUMENT_ROOT'] . "/listlink.php");  
			?>
			<h2><?php echo $articles; ?></h2>
			<?php
			$_GET['page'] = "index.html";
			$_GET['style'] = "drudge";
			//@include($_SERVER['DOCUMENT_ROOT'] . "/articlelist.php");
			include 'articlelist.php';
			?>
			<hr>
			<h2><?php echo $add_an_article; ?></h2>
			<iframe src="addarticle.php" width="725" height="950" scrolling="no" align="top"></iframe>
			<hr>
			<?php echo $default_other_page_text ?>
		</td>
		<td valign="top" width="365">
<!-- START OF THIRD COLUMN. -->
<!-- ------------------------------------------------------------------------------- -->
		<?php include 'drudge_sidebar.php';?>
		</td>
	</tr>
</table>

<?php include 'drudge_footer.php';?>