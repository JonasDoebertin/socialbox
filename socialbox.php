<?php if(!defined('ABSPATH')) die('Direct access is not allowed.');


/*
Plugin Name:   SocialBox
Plugin URI:    http://codecanyon.net/item/socialbox-social-wordpress-widget/627127?ref=jdpowered
Description:   Adds a super easy SocialBox widget which displays various statistics from Facebook, Twitter, Google+, Youtube, Vimeo, Instagram, Pinterest, SoundCloud, Dribbble, Forrst, GitHub and MailChimp.
Version:       1.7.3
Author:        Jonas Döbertin
Author URI:    http://codecanyon.net/user/jdpowered?ref=jdpowered
*/


/**
 * Check for incompatible plugins
 */
if(class_exists('JD_SocialBox') or class_exists('JD_SocialBoxWidget') or class_exists('JD_SocialBoxConnector') or class_exists('JD_SocialBoxHelper'))
{
	wp_die('Plugin incompatibility detected.');
}


/**
 * Define path and url constants
 */
define('JD_SOCIALBOX_BASENAME', plugin_basename(__FILE__));
define('JD_SOCIALBOX_PATH', plugin_dir_path(__FILE__));
define('JD_SOCIALBOX_URL', plugins_url('', __FILE__));
define('JD_SOCIALBOX_VERSION', '1.7.3');


/**
 * Load classes
 */
require_once JD_SOCIALBOX_PATH . '/classes/SocialBox.php';
require_once JD_SOCIALBOX_PATH . '/classes/SocialBoxWidget.php';
require_once JD_SOCIALBOX_PATH . '/classes/SocialBoxConnector.php';
require_once JD_SOCIALBOX_PATH . '/classes/SocialBoxHelper.php';
require_once JD_SOCIALBOX_PATH . '/classes/SocialBoxUpgrader.php';
require_once JD_SOCIALBOX_PATH . '/classes/SocialBoxUpdater.php';
require_once JD_SOCIALBOX_PATH . '/classes/SocialBoxTranslator.php';


/**
 * Load vendor classes
 */
require JD_SOCIALBOX_PATH . 'vendor/jdpowered/twitteroauth/loader.php';


/**
 * Register activation and deactivation hooks
 */
register_activation_hook(__FILE__, array('JD_SocialBox', 'activatePlugin'));
register_deactivation_hook(__FILE__, array('JD_SocialBox', 'deactivatePlugin'));


/**
 * Finally get things rolling
 */
$JD_SocialBox = new JD_SocialBox();
