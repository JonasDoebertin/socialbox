<?php
/*
 * SocialBox v.1.3.2
 * Copyright by Jonas Doebertin
 * Available at CodeCanyon: http://codecanyon.net/item/socialbox-social-wordpress-widget/627127
 */
?>

<!-- SocialBox Widget -->
<div class="socialbox-widget socialbox-style-<?php echo $style; ?>" <?php if($forcedWidgetWidth) echo "style=\"width: {$forcedWidgetWidth}px !important\""; ?>>
	
	<ul>
		
		<?php foreach($networks as $network): ?>
			
			<li>
				
				<a href="<?php echo $network['link']; ?>" title="<?php echo $network['buttonHint']; ?>" <?php if($newWindow) echo 'target="_blank"'; ?>>
					<img src="<?php $this->url('images/icons/' . $network['type'] . '_' . $iconSize . '.png'); ?>" alt="<?php echo $network['name']; ?>" />
				</a>

				<p>
					<span><?php echo $this->formatNumber($network['count'], $compactNumbers); ?></span> <?php echo $network['metric']; ?>
				</p>

				<?php if($allowButtons and $showButtons): ?>
					<a href="<?php echo $network['link']; ?>" class="socialbox-button" title="<?php echo $network['buttonHint']; ?>" <?php if($newWindow) echo 'target="_blank"'; ?> <?php if($forcedButtonWidth) echo "style=\"width: {$forcedButtonWidth}px !important\""; ?>>
						<?php echo $network['buttonText']; ?>
					</a>
				<?php endif; ?>
				
			</li>
			
		<?php endforeach; ?>
		
	</ul>
	
</div>
<!-- End SocialBox Widget -->