<?php if(!defined('ABSPATH')) die('Direct access is not allowed.');


/*
Plugin Name:   SocialBox
Plugin URI:    http://codecanyon.net/item/socialbox-social-wordpress-widget/627127?ref=jdpowered
Description:   Adds a super easy SocialBox widget which displays various statistics from Facebook, Twitter, Google+, Youtube, Vimeo, Instagram, Pinterest, SoundCloud, Dribbble, Forrst, GitHub and MailChimp.
Version:       1.7.0
Author:        Jonas Döbertin
Author URI:    http://codecanyon.net/user/jdpowered?ref=jdpowered
*/


/*
	Define some constants, including the current plugin version, it's basename,
	the full path and the url to the plugin files.
 */
define('JD_SOCIALBOX_BASENAME', plugin_basename(__FILE__));
define('JD_SOCIALBOX_MAINFILE', __FILE__);
define('JD_SOCIALBOX_PATH', plugin_dir_path(__FILE__));
define('JD_SOCIALBOX_URL', plugins_url('', __FILE__));
define('JD_SOCIALBOX_VERSION', '1.6.0');


/*
	Check for a compatible version of PHP
 */
if(version_compare(PHP_VERSION, '5.3.0', '<'))
{
	/*
		If the PHP version is too old, we'll import our legacy code. This will
		add a notice to the plugins.php page (stating that SocialBox requires
		PHP 5.3.0 or newer) and register a stylesheet for this notification.
		THE MAIN PLUGIN WILL NOT BE LOADED
	 */
	require JD_SOCIALBOX_PATH . 'legacy.php';
}
else
{
	/*
		We do have a version of PHP that matches our criteria. To avoid any
		syntax errors thrown by PHP < 5.3.0 when using namespaces, we'll load
		our bootstrap file that will handle loading the plugin core.
	 */
	require JD_SOCIALBOX_PATH . 'bootstrap.php';
}
