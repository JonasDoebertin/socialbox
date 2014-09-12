<?php if(!defined('ABSPATH')) die('Direct access is not allowed.');


/*
 * SocialBox 1.7.2
 * Copyright by Jonas Döbertin
 * Available only at CodeCanyon: http://codecanyon.net/item/socialbox-social-wordpress-widget/627127
 */


class JD_SocialBoxHelper{

	/**
	 * Return an array of all supported networks
	 *
	 * @return Array
	 */
	public static function getSupportedNetworks() {
		return explode(',', JD_SocialBox::SUPPORTED_NETWORKS);
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
			'purchase_code'   => '',
			'update_interval' => 180,
			'disable_ssl'     => 0,
			'enable_log'      => 0,
			'log_entries'     => 20
		);

		/* Load existing values */
		$options = get_option('socialbox_options', array());

		/* Combine default and existing values */
		$options = array_merge($defaults, $options);

		/* Return requested option value */
		return $options[$key];
	}
}
