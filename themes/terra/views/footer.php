			</div>
		</div>
		<!-- / main body -->

	</div>
	<!-- / wrapper -->
	
	<!-- footer -->
	<div id="footer" class="clearingfix">
 
		<div id="underfooter"></div>
				
		<!-- footer content -->
		<div class="rapidxwpr floatholder">
 
			<!-- footer credits -->
			<div class="footer-credits">
				Powered by the &nbsp;<a href="http://www.ushahidi.com/"><img src="<?php echo url::file_loc('img'); ?>media/img/footer-logo.png" alt="Ushahidi" style="vertical-align:middle" /></a>&nbsp; Platform
			</div>
			<!-- / footer credits -->
		
			<!-- footer menu -->
			<div class="footermenu">
				<ul class="clearingfix">
					<li><a class="item1" href="<?php echo url::site(); ?>"><?php echo Kohana::lang('ui_main.home'); ?></a></li>
					<li><a href="<?php echo url::site()."reports/submit"; ?>"><?php echo Kohana::lang('ui_main.submit'); ?></a></li>
					<li><a href="<?php echo url::site()."alerts"; ?>"><?php echo Kohana::lang('ui_main.alerts'); ?></a></li>
					<li><a href="<?php echo url::site()."contact"; ?>"><?php echo Kohana::lang('ui_main.contact'); ?></a></li>
					<?php
					// Action::nav_main_bottom - Add items to the bottom links
					Event::run('ushahidi_action.nav_main_bottom');
					?>
				</ul>
				<?php if($site_copyright_statement != '') { ?>
      		<p><?php echo $site_copyright_statement; ?></p>
      	<?php } ?>
			</div>
			<!-- / footer menu -->

			<!-- Disclaimer -->
			<p style="clear:both;padding: 10px;"><em>Ushahidi,Inc. or volunteers engaged int his effort take no responsibliity for the accuracy or content of reports submitted by citizens.</em></p>

      
			<h2 class="feedback_title" style="clear:both">
				<a href="http://feedback.ushahidi.com/fillsurvey.php?sid=2"><?php echo Kohana::lang('ui_main.feedback'); ?></a>
			</h2>

 
		</div>
		<!-- / footer content -->
 
	</div>
	<!-- / footer -->
 
	<?php echo $ushahidi_stats; ?>
	<?php echo $google_analytics; ?>
	
	<!-- Task Scheduler --><script type="text/javascript">$(document).ready(function(){$('#schedulerholder').html('<img src="<?php echo url::base(); ?>scheduler" />');});</script><div id="schedulerholder"></div><!-- End Task Scheduler -->
 
	<?php
	// Action::main_footer - Add items before the </body> tag
	Event::run('ushahidi_action.main_footer');
	?>
<script type="text/javascript">
var _sf_async_config={uid:28105,domain:"irenerecoverymap.com"};
(function(){
  function loadChartbeat() {
    window._sf_endpt=(new Date()).getTime();
    var e = document.createElement('script');
    e.setAttribute('language', 'javascript');
    e.setAttribute('type', 'text/javascript');
    e.setAttribute('src',
       (("https:" == document.location.protocol) ? "https://a248.e.akamai.net/chartbeat.download.akamai.com/102508/" : "http://static.chartbeat.com/") +
       "js/chartbeat.js");
    document.body.appendChild(e);
  }
  var oldonload = window.onload;
  window.onload = (typeof window.onload != 'function') ?
     loadChartbeat : function() { oldonload(); loadChartbeat(); };
})();

</script>
</body>
</html>
