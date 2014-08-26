<?php
namespace jdpowered\SocialBox\Helpers;

use jdpowered\SocialBox\Plugin;

class Helper{

    /**
     * Return an array of all supported networks
     *
     * @return Array
     */
    public static function getSupportedNetworks() {
        return explode(',', Plugin::SUPPORTED_NETWORKS);
    }

    /**
     * Get a specific option value
     *
     * @param String $key
     * @return Mixed
     */
    public static function getOption($key) {

        /* Set up default values */
        $defaults = array(
            'update_interval' => 180,
            'disable_ssl'     => 0,
            'enable_log'      => 0,
            'log_entries'     => 20,
            'purchase_code'   => '',
        );

        /* Load existing values */
        $options = get_option('socialbox_options', array());

        /* Combine default and existing values */
        $options = array_merge($defaults, $options);

        /* Return requested option value */
        return $options[$key];
    }
}
