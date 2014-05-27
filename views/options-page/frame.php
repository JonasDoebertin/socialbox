<?php if(!defined('ABSPATH')) die('Direct access is not allowed.');


/*
 * SocialBox 1.6.3
 * Copyright by Jonas Döbertin
 * Available only at CodeCanyon: http://codecanyon.net/item/socialbox-social-wordpress-widget/627127
 */


?>

<!-- Start SocialBox Options Page -->
<div class="socialbox-content">

    <div class="socialbox-header">
        <nav role="navigation" class="socialbox-nav-wrap">
            <ul class="socialbox-nav">
                <li class="socialbox-nav-item  socialbox-logo"><?php _e('SocialBox', 'socialbox') ?></li>
                <li class="socialbox-nav-item  socialbox-page">
                    <a href="?page=socialbox&amp;tab=home"<? if($tab == 'home') echo ' class="current"' ?>><?php _e('Home', 'socialbox') ?></a>
                </li>
                <li class="socialbox-nav-item  socialbox-page">
                    <a href="?page=socialbox&amp;tab=settings"<? if($tab == 'settings') echo ' class="current"' ?>><?php _e('Settings', 'socialbox') ?></a>
                </li>
                <li class="socialbox-nav-item  socialbox-page">
                    <a href="?page=socialbox&amp;tab=help"<? if($tab == 'help') echo ' class="current"' ?>><?php _e('Help', 'socialbox') ?></a>
                </li>
            </ul>
        </nav>
    </div>

	<?php
		switch($tab)
        {
			case 'settings':
				include JD_SOCIALBOX_PATH . '/views/options-page/settings.php';
				break;

			case 'debug':
				include JD_SOCIALBOX_PATH . '/views/options-page/debug.php';
				break;

			case 'help':
				include JD_SOCIALBOX_PATH . '/views/options-page/help.php';
				break;
                
            default:
                include JD_SOCIALBOX_PATH . '/views/options-page/home.php';
                break;
		}
	?>

</div>
<!-- End SocialBox Options Page -->
