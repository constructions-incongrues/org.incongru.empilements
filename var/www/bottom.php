	<hr style="clear:both;" />
	<p>N'hésitez surtout pas à nous <a href="mailto:empilements@incongru.org">soumettre</a> vos compilations !</p>
	<p class="credits">Ce projet est <a href="https://github.com/contructions-incongrues/empilements">développé</a> par <a href="http://www.constructions-incongrues.net">Constructions Incongrues</a> et hébergé par <a href="http://www.pastis-hosting.net">Pastis Hosting</a> | <a href="http://feeds.feedburner.com/empilements-incongrus">RSS</a></p>
	<br /><br /><br /><br /><br /><br />
	
	</div>
  <!-- JavaScript at the bottom for fast page loading -->

  <!-- Grab Google CDN's jQuery, with a protocol relative URL; fall back to local if offline -->
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
  <script>window.jQuery || document.write('<script src="js/libs/jquery-1.6.2.min.js"><\/script>')</script>


  <!-- scripts concatenated and minified via ant build script-->
  <script defer src="js/plugins.js"></script>
  <script defer src="js/script.js"></script>
<?php if (isset($compilation)): ?>
  <script type="text/javascript" src="http://o.aolcdn.com/os_merge/?file=/streampad/sp-player.js&file=/streampad/sp-player-other.js&expsec=86400&ver=11"></script>
<?php endif; ?>
  <!-- end scripts-->

	
  <!-- Change UA-XXXXX-X to be your site's ID -->
  <script>
    window._gaq = [['_setAccount','UA-26294503-1'],['_trackPageview'],['_trackPageLoadTime']];
    Modernizr.load({
      load: ('https:' == location.protocol ? '//ssl' : '//www') + '.google-analytics.com/ga.js'
    });
  </script>


  <!-- Prompt IE 6 users to install Chrome Frame. Remove this if you want to support IE 6.
       chromium.org/developers/how-tos/chrome-frame-getting-started -->
  <!--[if lt IE 7 ]>
    <script src="//ajax.googleapis.com/ajax/libs/chrome-frame/1.0.3/CFInstall.min.js"></script>
    <script>window.attachEvent('onload',function(){CFInstall.check({mode:'overlay'})})</script>
  <![endif]-->
  
</body>
</html>
