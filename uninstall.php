<?php if(!defined('ABSPATH')) die('Direct access is not allowed.');


/*
 * SocialBox 1.7.0
 * Copyright by Jonas Döbertin
 * Available only at CodeCanyon: http://codecanyon.net/item/socialbox-social-wordpress-widget/627127
 */


/* Abort if not called during uninstallation process */
if(!defined('WP_UNINSTALL_PLUGIN')) {
	exit;
}


/* Delete our options */
delete_option('socialbox_update');
delete_option('socialbox_options');
delete_option('socialbox_cache');
delete_option('socialbox_log');
