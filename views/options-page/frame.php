<?php
/*
 * SocialBox v.1.3.2
 * Copyright by Jonas Doebertin
 * Available at CodeCanyon: http://codecanyon.net/item/socialbox-social-wordpress-widget/627127
 */
?>

<!-- Start SocialBox Options Page -->
<div class="wrap">
	
	<?php screen_icon(); ?>
	<h2 class="nav-tab-wrapper">
		<?php _e('SocialBox', self::SLUG); ?>
		<a class="nav-tab <?php if($tab == 'settings') echo 'nav-tab-active'; ?>" href="?page=<?php echo self::SLUG; ?>&amp;tab=settings"><?php _e('Settings', self::SLUG); ?></a>
		<a class="nav-tab <?php if($tab == 'about') echo 'nav-tab-active'; ?>" href="?page=<?php echo self::SLUG; ?>&amp;tab=about"><?php _e('About', self::SLUG); ?></a>
		<a class="nav-tab <?php if($tab == 'help') echo 'nav-tab-active'; ?>" href="?page=<?php echo self::SLUG; ?>&amp;tab=help"><?php _e('Help', self::SLUG); ?></a>
		<a class="nav-tab <?php if($tab == 'log') echo 'nav-tab-active'; ?>" href="?page=<?php echo self::SLUG; ?>&amp;tab=log"><?php _e('API Log', self::SLUG); ?></a>
	</h2>

	<?php 
		switch($tab){
			case 'settings':
				include JD_SOCIALBOX_PATH . '/views/options-page/settings.php';
				break;
			case 'about':
				include JD_SOCIALBOX_PATH . '/views/options-page/about.php';
				break;
			case 'log':
				include JD_SOCIALBOX_PATH . '/views/options-page/log.php';
				break;
			case 'help':
			default:
				include JD_SOCIALBOX_PATH . '/views/options-page/help.php';
				break;
		}
	?>

</div>
<!-- End SocialBox Options Page -->