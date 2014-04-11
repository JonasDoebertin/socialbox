<?php if(!defined('ABSPATH')) die('Direct access is not allowed.');


/*
 * SocialBox 1.6.0
 * Copyright by Jonas Döbertin
 * Available only at CodeCanyon: http://codecanyon.net/item/socialbox-social-wordpress-widget/627127
 */


?>

<!-- Start SocialBox Options Page -->
<div class="wrap socialbox-wrap">

	<?php screen_icon(); ?>
	<h2 class="nav-tab-wrapper">
		<?php _e('SocialBox', 'socialbox'); ?>
		<a class="nav-tab <?php if($tab == 'settings') echo 'nav-tab-active'; ?>" href="?page=socialbox&amp;tab=settings"><?php _e('Settings', 'socialbox'); ?></a>
		<a class="nav-tab <?php if($tab == 'help') echo 'nav-tab-active'; ?>" href="?page=socialbox&amp;tab=help"><?php _e('Help', 'socialbox'); ?></a>
		<a class="nav-tab <?php if($tab == 'log') echo 'nav-tab-active'; ?>" href="?page=socialbox&amp;tab=log"><?php _e('Log', 'socialbox'); ?></a>
	</h2>

	<?php
		switch($tab){
			case 'settings':
				include JD_SOCIALBOX_PATH . '/views/options-page/settings.php';
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
