<!-- SocialBox Widget -->
<div id="socialbox">
	
	<ul>
		
		<?php foreach($networks as $network): ?>
			
		<li>
			
			<p>
				<a href="<?php echo $network['link']; ?>" title="<?php echo $network['buttonHint']; ?>" <?php if($newWindow) echo 'target="_blank"'; ?>><img src="<?php $this->url('images/icons/' . $network['type'] . '_16.png'); ?>" alt="<?php echo $network['name']; ?>" /></a><span><?php echo number_format($network['count']); ?></span> <?php echo $network['metric']; ?>
				<?php if($showButtons): ?>
					<a href="<?php echo $network['link']; ?>" class="socialbox-button" title="<?php echo $network['buttonHint']; ?>" <?php if($newWindow) echo 'target="_blank"'; ?>><?php echo $network['buttonText']; ?></a>
				<?php endif; ?>
			</p>
			
		</li>
			
		<?php endforeach; ?>
		
	</ul>
	
</div>
<!-- End SocialBox Widget -->