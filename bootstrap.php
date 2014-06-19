<?php if(!defined('ABSPATH')) die('Direct access is not allowed.');

/*
    We do have a version of PHP that fits our needs. So let's go ahead and
    register the autoloader for our plugin and vendor classes.
 */
require JD_SOCIALBOX_PATH . 'vendor/autoload.php';


/*
    Register activation and deactivation hooks
*/
register_activation_hook(__FILE__, array('jdpowered\SocialBox\Plugin', 'activatePlugin'));
register_deactivation_hook(__FILE__, array('jdpowered\SocialBox\Plugin', 'deactivatePlugin'));


/*
    Finally, get things rolling by instanciating the core plugin class
*/
$JD_SocialBox = new jdpowered\SocialBox\Plugin();
