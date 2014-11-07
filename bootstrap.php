<?php if(!defined('ABSPATH')) die('Direct access is not allowed.');

/*
    We do have a version of PHP that fits our needs. So let's go ahead and
    register the autoloader for our plugin and vendor classes.
 */
require JD_SOCIALBOX_PATH . 'vendor/autoload.php';


/*
    Register activation and deactivation hooks
 */
register_activation_hook(JD_SOCIALBOX_MAINFILE, array('jdpowered\SocialBox\Plugin', 'activatePlugin'));
register_deactivation_hook(JD_SOCIALBOX_MAINFILE, array('jdpowered\SocialBox\Plugin', 'deactivatePlugin'));


/*
    Finally, get things rolling by instanciating the core plugin class within
    the "plugins_loaded" hook.
 */
add_action('plugins_loaded', function()
{
    global $JD_SocialBox;
    $JD_SocialBox = new jdpowered\SocialBox\Plugin();
}, 10);
