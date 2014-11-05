<?php if(!defined('ABSPATH')) die('Direct access is not allowed.');


/*
 * SocialBox 1.7.0
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
		<a class="nav-tab <?php if($tab == 'addons') echo 'nav-tab-active'; ?>" href="?page=socialbox&amp;tab=addons"><?php _e('Addons', 'socialbox'); ?></a>
		<a class="nav-tab <?php if($tab == 'debug') echo 'nav-tab-active'; ?>" href="?page=socialbox&amp;tab=debug"><?php _e('Debug', 'socialbox'); ?></a>
	</h2>

	<?php
		switch($tab){
			case 'addons':
				include JD_SOCIALBOX_PATH . '/views/options-page/addons.php';
				break;
			case 'debug':
				include JD_SOCIALBOX_PATH . '/views/options-page/debug.php';
				break;
			case 'help':
				include JD_SOCIALBOX_PATH . '/views/options-page/help.php';
				break;
			case 'settings':
			default:
				include JD_SOCIALBOX_PATH . '/views/options-page/settings.php';
				break;
		}
	?>

</div>
<!-- End SocialBox Options Page -->
