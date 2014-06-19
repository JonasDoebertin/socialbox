<?php if(!defined('ABSPATH')) die('Direct access is not allowed.');


/*
    The PHP version is too old. We will add a notice to the plugins.php page
    (stating that SocialBox requires PHP 5.3.0 or newer) and register a
    stylesheet for this notification.
 */


/*
    We want to show the message only on the "Installed Plugins" page
 */
if($pagenow == 'plugins.php')
{


    /*
        Register notice and the related stylesheet
     */
    add_action('admin_notices', 'socialbox_legacy_add_admin_notice');
    add_action('admin_enqueue_scripts', 'socialbox_legacy_register_admin_notice_style');

    /**
     * [socialbox_legacy_add_admin_notice description]
     */
    function socialbox_legacy_add_admin_notice()
    {
        include JD_SOCIALBOX_PATH . 'views/notices/legacy.php';
    }

    function socialbox_legacy_register_admin_notice_style()
    {
        wp_enqueue_style('socialbox-legacy', JD_SOCIALBOX_URL . '/assets/css/notices.css', array(), JD_SOCIALBOX_VERSION, 'all');
    }
}
