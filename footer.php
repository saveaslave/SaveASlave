 <footer>
        <div class="container"> <hr class="style5"> <div class="col-md-8"> <span class="copyright">Copyright &copy; 2015 SaveAslave <br/> Designed by <a href="http://www.designpandorabox.eu/">Pandora Web Box</a></span> <br/> PHP Programmer James Arbaugh  </div>
      <div class="col-md-4"><?php echo $last_updated.$row["created_date"].$by.$creator;?>| <a href="mailto:saveaslave@aol.com?Subject=Contact%20from%20saveaslave.com"><?php echo $contact; ?></a> | <a href="index.php"><?php echo $home; ?></a> | <a href="disclaimer.php"><?php echo $disclaimer; ?></a> | <a href="help.php"><?php echo $help; ?></a></div></div>
      </footer>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
      <script src="assets/js/ie10-viewport-bug-workaround.js"></script>
		<script>
		$('#nav').affix({
  offset: { top: $('#nav').offset().top }
});


$(function() {
  $('a[href*=#]:not([href=#])').click(function() {
    if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
      var target = $(this.hash);
      target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
      if (target.length) {
        $('html,body').animate({
          scrollTop: target.offset().top
        }, 1000);
        return false;
      }
    }
  });
});
</script>
 
  </body>
</html>
