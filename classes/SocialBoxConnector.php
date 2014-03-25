<?php if(!defined('ABSPATH')) die('Direct access is not allowed.');


/*
 * SocialBox 1.4.0
 * Copyright by Jonas Döbertin
 * Available only at CodeCanyon: http://codecanyon.net/item/socialbox-social-wordpress-widget/627127
 */


class JD_SocialBoxConnector{
	
	public static function get($item) {
		
		return self::{$item['network']}($item);
	}
	
	protected static function facebook($item) {

		/* Fetch data from Graph API */
		$result = wp_remote_get('https://graph.facebook.com/' . $item['id'], array('sslverify' => false));

		/* Check for common errors */
		if(self::wasCommonError($result)) {
			return array('successful' => false);
		}

		/* Decode response */
		$data = json_decode(wp_remote_retrieve_body($result), true);

		/* Check for incorrect data */
		if(!is_array($data) or isset($data['error']) or !isset($data[$item['metric']])){
			return array('successful' => false);
		}

		/* Return value */
		return array(
			'successful' => true,
			'value'      => $data[$item['metric']]
		);
	}

	protected static function twitter($item) {

		/* Build new Twitter API Connector object */
		$Twitter = new TwitterOAuth($item['api_key'], $item['api_secret'], $item['access_token'], $item['access_token_secret']);

		/* Fetch data from API */
		$result = $Twitter->get('users/show', array('screen_name' => $item['id'], 'include_entities' => false));

		/* Check for http errors */
		if($Twitter->lastStatusCode() != 200) {
			return array('successful' => false);
		}

		/* Check for incorrect data */
		if(is_null($result) or !isset($result->followers_count)){
			return array('successful' => false);
		}

		/* Return value */
		return array(
			'successful' => true,
			'value'      => $result->followers_count
		);

	}

	protected static function youtube($item) {
		/* Fetch data from Youtube API */
		$result = wp_remote_get('http://gdata.youtube.com/feeds/api/users/' . $item['id']);

		/* Check for common errors */
		if(self::wasCommonError($result)) {
			return array('successful' => false);
		}

		/* Decode response */
		$data = simplexml_load_string(wp_remote_retrieve_body($result));

		/* Check for incorrect data */
		if(!$data or isset($data->err) or !isset($data->children('http://gdata.youtube.com/schemas/2007')->statistics->attributes()->subscriberCount)){
			return array('successful' => false);
		}

		/* Return value */
		return array(
			'successful' => true,
			'value'      => (int) $data->children('http://gdata.youtube.com/schemas/2007')->statistics->attributes()->subscriberCount
		);
	}

	protected static function vimeo($item) {
		/* Fetch data from Vimeo API */
		$result = wp_remote_get(sprintf('http://vimeo.com/api/v2/channel/%s/info.json', $item['id']));

		/* Check for common errors */
		if(self::wasCommonError($result)) {
			return array('successful' => false);
		}

		/* Decode response */
		$data = json_decode(wp_remote_retrieve_body($result), true);

		/* Check for incorrect data */
		if(!is_array($data) or !isset($data['total_subscribers'])){
			return array('successful' => false);
		}

		/* Return value */
		return array(
			'successful' => true,
			'value'      => $data['total_subscribers']
		);
	}

	protected static function dribbble($item) {

		/* Fetch data from Dribbble API */
		$result = wp_remote_get('http://api.dribbble.com/players/' . $item['id']);

		/* Check for common errors */
		if(self::wasCommonError($result)) {
			return array('successful' => false);
		}

		/* Decode response */
		$data = json_decode(wp_remote_retrieve_body($result), true);

		/* Check for incorrect data */
		if(!is_array($data) or !isset($data['followers_count'])){
			return array('successful' => false);
		}

		/* Return value */
		return array(
			'successful' => true,
			'value'      => $data['followers_count']
		);
	}

	protected static function forrst($item) {

		/* Fetch data from Forrst API */
		$result = wp_remote_get('https://forrst.com/api/v2/users/info?username=' . $item['id'], array('sslverify' => false));

		/* Check for common errors */
		if(self::wasCommonError($result)) {
			return array('successful' => false);
		}

		/* Decode response */
		$data = json_decode(wp_remote_retrieve_body($result), true);

		/* Check for incorrect data */
		if(!is_array($data) or !isset($data['resp']['typecast_followers'])){
			return array('successful' => false);
		}

		/* Return value */
		return array(
			'successful' => true,
			'value'      => $data['resp']['typecast_followers']
		);
	}

	protected static function github($item) {

		/* Fetch data from GitHub API */
		$result = wp_remote_get('https://api.github.com/users/' . $item['id'], array('sslverify' => false));

		/* Check for common errors */
		if(self::wasCommonError($result)) {
			return array('successful' => false);
		}

		/* Decode response */
		$data = json_decode(wp_remote_retrieve_body($result), true);

		/* Check for incorrect data */
		if(!is_array($data) or !isset($data['followers'])){
			return array('successful' => false);
		}

		/* Return value */
		return array(
			'successful' => true,
			'value'      => $data['followers']
		);
	}

	/**
	 * Checks for unseccessful WP Remote requests
	 * @param  Mixed $result
	 * @return Bool
	 */
	protected static function wasCommonError($result) {
		return is_wp_error($result) or (wp_remote_retrieve_response_code($result) != 200);
	}
}