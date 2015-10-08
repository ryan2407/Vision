<div class="footer">
	<div class="container">
		<div class="footerLogo">
			<img src="<?php echo bloginfo('template_directory'); ?>/images/vision-footer-logo.png" width="100%">
		</div><!-- end footerLogo -->

			<?php wp_nav_menu( array( 'theme_location' => 'footer-menu') ); ?>
				
			<div style="clear: both;"></div>
			<div class="footerForm">
				<h3>SIGNUP FOR UPDATES</h3>
				<form>
					<input name="first_name" type="text" value="" placeholder="First Name">
					<input name="last_name" type="text" value="" placeholder="Last Name">
					<input name="email" type="email" value="" placeholder="Email Address">
					<input name="country" type="text" value="" placeholder="Country">
					<input name="postcode" type="text" value="" placeholder="Postcode">
				</form>
			</div>

		<hr>

		<p style="float: left;">&copy; 2015 Vision Christian Media (United Christian Broadcasters Australia Limited) Locked Bag 3 Springwood QLD 4127</p>
		<p style="float: right;">ABN 15 051 984 402</p>

		<div style="clear:both;"></div>
	</div><!-- end container -->
</div><!-- end footer -->