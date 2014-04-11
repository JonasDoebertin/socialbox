<?php if(!defined('ABSPATH')) die('Direct access is not allowed.');


/*
 * SocialBox 1.6.1
 * Copyright by Jonas Döbertin
 * Available only at CodeCanyon: http://codecanyon.net/item/socialbox-social-wordpress-widget/627127
 */


?>

<!-- SocialBox Widget -->
<div class="socialbox-widget socialbox-style-<?php echo $style; ?>" <?php if($forcedWidgetWidth) echo "style=\"width: {$forcedWidgetWidth}px !important\"" ?>>
	<ul>

		<?php foreach($networks as $network): ?>

			<li class="socialbox-network-<?php echo $network['type']; ?>">
				<a href="<?php echo $network['link']; ?>" title="<?php echo $network['buttonHint']; ?>" <?php if($newWindow) echo 'target="_blank"'; ?>>
					<img src="<?php echo JD_SOCIALBOX_URL . '/assets/img/icons/32/' . $network['type'] . '.png' ?>" alt="<?php echo $network['name']; ?>" width="<?php echo $iconSize ?>" height="<?php echo $iconSize ?>"/>
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
