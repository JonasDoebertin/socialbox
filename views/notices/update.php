<?php if(!defined('ABSPATH')) die('Direct access is not allowed.');


/*
 * SocialBox 1.7.0
 * Copyright by Jonas Döbertin
 * Available only at CodeCanyon: http://codecanyon.net/item/socialbox-social-wordpress-widget/627127
 */


?>

<div class="updated socialbox-update-available">
	<div class="socialbox-logo">
		<i class="socialbox-icon"></i>
		<p class="socialbox-title"><?php _e('SocialBox') ?>
	</div>
	<p class="socialbox-message">
		<?php printf(__('An updated version of SocialBox (%s) is available. <a href="%s">Go get it now!</a>', 'socialbox'), $info['latest_version'], $info['download_url']) ?>
	</p>
</div>
