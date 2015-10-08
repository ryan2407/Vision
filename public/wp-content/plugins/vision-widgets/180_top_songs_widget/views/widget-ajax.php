<div class="wrapper">
	<?php foreach($topSongs as $song): ?>
		<div class="song">
			<div class="artwork">
				<img src="<?php echo $song['cover']; ?>" width="150">
			</div>
			<div class="songInfo">
				<h3>Ranking: <?php echo $song['ranking']; ?></h3>
				<h4>Song: <?php echo $song['song']; ?></h4>
				<p>Artist: <?php echo $song['artist']; ?><br>
				Album: <?php echo $song['album']; ?></p>
			</div>
			<div style="clear:both;"></div>
		</div>
	<?php endforeach; ?>
</div>