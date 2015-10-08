<?php $date = new DateTime($lastPlayed[0]['date']); ?>
	
	<h4><?php echo $date->format('d M, Y'); ?></h4>
	<h5>Your current timezone is <?php echo $timezone; ?> - <a href="#" class="tzToggle">change</a></h5>
	<select name="tz" class="tzSelect">
		<option value="">Please select</option>
		<option value="Australia/Brisbane">Eastern Australia Standard Time</option>
		<option value="Australia/Sydney">Eastern Australia Daylight Saving Time</option>
		<option value="Australia/Adelaide">Central Australia Dayliight Saving Time</option>
		<option value="Australia/Darwin">Central Australia Standard Time</option>
		<option value="Australia/Perth">Western Australia Time</option>
	</select>

<div class="lastPlayedWrapper">
	<div class="inner">
		<?php foreach($lastPlayed as $played): ?>

			<div class="lastPlayedEntry" style="padding-bottom:5px;margin-bottom:10px;border-bottom: 1px solid #ccc;">

				<div class="image" style="float: left;width: 12%;">
					<img src="<?php echo $played['image']; ?>" style="width: 100%;">
				</div>
				<div class="lastPlayedMeta" style="float: right;width: 85%;">
					<p><?php echo $played['time']; ?></p>
					<p>
						<?php if(isset($played['song'])): ?>
								<?php echo $played['song']; ?> -
						<?php endif; ?>
						<?php if(isset($played['artist'])): ?>
							<?php echo $played['artist']; ?>
						<?php endif; ?>
					</p>
				    <p>
						<?php if(isset($played['show_name'])): ?>
							<a href="<?php echo $played['show_link']; ?>">
							<?php echo $played['show_name']; ?></a> -
						<?php endif; ?>
						<?php if(isset($played['topic'])): ?>
							<?php echo $played['topic']; ?>
						<?php endif; ?>
					</p>
				</div>

				<div style="clear:both"></div>
			</div>
		<?php endforeach; ?>
	</div>
</div>