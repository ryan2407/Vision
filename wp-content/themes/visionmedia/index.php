<?php include_once('header.php'); ?>

<?php include_once(get_theme_root().'/globalelements/slideshow.php'); ?>

<div class="mainWidgetArea">
	<div class="container">
		<div class="widgetWrapper">
			<div class="columnOne columns">
				<?php dynamic_sidebar('left-column'); ?>
			</div><!-- end column-one -->
			<div class="columnTwo columns">
				<?php dynamic_sidebar('middle-column'); ?>
			</div><!-- end columnTwo -->
			<div class="columnThree columns">
				<?php dynamic_sidebar('right-column'); ?>
			</div><!-- end columnTwo -->
		</div><!-- end widgetWrapper -->

		<div style="clear:both;"></div>
	</div>
</div>

<?php include_once(get_theme_root().'/globalelements/footer.php'); ?>