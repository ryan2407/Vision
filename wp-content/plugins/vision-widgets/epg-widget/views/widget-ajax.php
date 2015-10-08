<div class="searchEpg" style="margin-bottom: 20px;">
	<p>Your current timezone is <?php echo $timezone; ?> - <a href="#" class="tzToggle">change</a></p>
	<select name="tz" class="tzSelect">
		<option value="">Please select</option>
		<option value="Australia/Brisbane">Eastern Australia Standard Time</option>
		<option value="Australia/Sydney">Eastern Australia Daylight Saving Time</option>
		<option value="Australia/Adelaide">Central Australia Dayliight Saving Time</option>
		<option value="Australia/Darwin">Central Australia Standard Time</option>
		<option value="Australia/Perth">Western Australia Time</option>
	</select>
</div>

<div class="epg">
	<?php foreach($epg as $epg): ?>
	
		<h3><?php echo $epg['day']; ?> <?php echo $epg['date']; ?></h3>
		
		<?php foreach($epg['data'] as $data): ?>
			<div style="margin: 10px 0;">
				
				<?php if(!isset($data['shows'])): ?>
					<h3>
						<?php echo $data['start_time']; ?>
						<?php if(isset($data['show_block_name'])): ?>
							<?php echo $data['show_block_name']; ?>
						<?php endif; ?>
					</h3>
						<?php if($data['show_artwork']): ?>
							<img src="<?php echo $data['show_artwork']; ?>" width="20%" style="float:left;margin-bottom: 20px;">
						<?php endif; ?>
				<?php endif; ?>
				
					<?php if(isset($data['show_name'])): ?>
						<div class="show" style="padding: 10px 0;border-bottom: 1px solid #444;">
							<a href="<?php echo isset($data['show_link']) ? $data['show_link'] : '#'; ?>">
							<?php if($data['show_artwork']): ?>
								<img src="<?php echo $data['show_artwork']; ?>" width="20%" style="float:left;margin-bottom: 20px;">
							<?php else: ?>
								<div style="width: 20%;height:150px;background: #ccc;float: left;"></div>
							<?php endif; ?>
							</a>
							<div class="showData" style="width: 77%;float: right;">
								<h4><?php echo $data['start_time']; ?></h4>
								
								<?php if(isset($data['show_name'])): ?>
								<h4>
									<a href="<?php echo isset($data['show_link']) ? $data['show_link'] : '#'; ?>">
										<?php echo $data['show_name']; ?>
									</a>
								</h4>
								<?php endif; ?>
								<?php if(isset($data['show_description'])): ?>
									<p><?php echo $data['show_description']; ?></p>
								<?php endif; ?>
								
								<?php if(isset($data['episodes'])): ?>
									<?php foreach($data['episodes'] as $episode): ?>
											<?php if(isset($episode['episode_topic'])): ?>
												<h5><?php echo $episode['episode_topic']; ?></h5>
											<?php endif; ?>
											<?php if(isset($episode['episode_description'])): ?>
												<p><?php echo $episode['episode_description']; ?></p>
											<?php endif; ?>
									<?php endforeach; ?>
								<?php endif; ?>
							</div><!-- end showData -->
							<div style="clear:both;"></div>
						</div>
					<?php endif; ?>	
				
				<?php if($data['show_banner']): ?>
					<img src="<?php echo $data['show_banner']; ?>" width="100%">
				<?php endif; ?>
				
				<?php if(isset($data['shows'])): ?>
					<?php foreach($data['shows'] as $show): ?>
						<div class="show" style="padding: 10px 0;border-bottom: 1px solid #444;">
							<a href="<?php echo isset($show['show_link']) ? $show['show_link'] : '#'; ?>">
							<?php if($show['show_artwork']): ?>
								<img src="<?php echo $show['show_artwork']; ?>" width="20%" style="float:left;margin-bottom: 20px;">
							<?php else: ?>
								<div style="width: 20%;height:150px;background: #ccc;float: left;"></div>
							<?php endif; ?>
							</a>
							<div class="showData" style="width: 77%;float: right;">
								<h4><?php echo $show['start_time']; ?></h4>
								
								<h4>
									<a href="<?php echo isset($show['show_link']) ? $show['show_link'] : '#'; ?>">
										<?php echo $show['show_name']; ?>
									</a>
								</h4>
								<p><?php echo $show['show_description']; ?></p>
								<?php if(isset($show['episodes'])): ?>
									<?php foreach($show['episodes'] as $episode): ?>
											<?php if(isset($episode['episode_topic'])): ?>
												<h5><?php echo $episode['episode_topic']; ?></h5>
											<?php endif; ?>
											<?php if(isset($episode['episode_description'])): ?>
												<p><?php echo $episode['episode_description']; ?></p>
											<?php endif; ?>
									<?php endforeach; ?>
								<?php endif; ?>
							</div><!-- end showData -->
							<div style="clear:both;"></div>
						</div>
					<?php endforeach; ?>
				<?php endif; ?>
			</div>	
		<?php endforeach; ?>
	
	<?php endforeach; ?>
</div>