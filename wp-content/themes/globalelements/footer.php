<div class="donateFooter">
	<div class="container">
		<img src="<?php echo bloginfo('template_directory'); ?>/images/donate-footer.png" width="208" alt="Donate to vision">
		<p>Over 70% of our income is from the freewill gifts of wonderful people just like you.<br/>
			<strong>So thank you for helping.</strong> Your generous support is 'Connecting Faith to Life'.</p>
	</div>
</div><!-- end donateFooter -->

<?php include('footer-nav.php'); ?>

<?php wp_footer(); ?>
<script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
<script>
	jQuery(document).ready(function($){
		$.mobile.ajaxEnabled = false;
		$('div.navWrapper').on('swipeleft', function(){
			$(this).animate({
				left: "-100%"
			}, 500, function(){
				$('div.mobileNavIcon').removeClass('active');
			});
		});
		
		var algolia = algoliasearch('NROWAPEEW3', '672ba316261228943befbd38bf86d583');
		var index = algolia.initIndex('VisionDevIndex');

	    $('#user-search').typeahead({hint: false, zIndex:'10000'}, {
	      source: index.ttAdapter({hitsPerPage: 5}),
	      displayKey: 'post_title',
	      templates: {
	        suggestion: function(hit) {
	          // render the hit
	          return '<div class="hit">' +
	            '<div class="name">' +
	              hit._highlightResult.post_title.value + ' ' +
	            '</div>' +
	          '</div>';
	        }
	      }
    	});
    	
    	$('div.accordianHeading').on('click', function(){
	    	$(this).next('div.accordianContent').slideToggle();
	    	$(this).parent('div.accordianItem').siblings('div.accordianItem').find('div.accordianContent').slideUp();
    	});
    	
    	var mp3Url = $('p:contains(.mp3)').text();
    	console.log(mp3Url);
    	$('p:contains(.mp3)').replaceWith('<audio controls src="'+mp3Url+'" type="audio/mpeg" preload="none"></audio>');
    	
    	$('div.navWrapper ul.180 li a').each(function(){
			console.log($(this).height());
			if($(this).height() == '19') {
				$(this).css({
					'padding':'15px 0 13px'
				});
			}
		});
	});
</script>
</body>
</html>