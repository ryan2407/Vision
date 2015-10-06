<div class="announcerImage" style="overflow: hidden;float:left;">
	<img style="margin-left: 0px;" src="<?php echo $nowPlaying['announcer_img']; ?>">
</div>

<div class="albumArt" style="overflow: hidden;float:left;display: none;">
	<img src="<?php echo $nowPlaying['now_playing_img']; ?>">
</div>

<div class="details">
	<h3 class="widgetHeading">Now playing</h3>
	<h4><?php echo $nowPlaying['current_program']; ?></h4>
	<p><?php echo $nowPlaying['current_play']; ?></p>
</div>

<div style="clear:both;"></div>