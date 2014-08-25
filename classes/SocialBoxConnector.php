<?php if(!defined('ABSPATH')) die('Direct access is not allowed.');


/*
 * SocialBox 1.7.1
 * Copyright by Jonas Döbertin
 * Available only at CodeCanyon: http://codecanyon.net/item/socialbox-social-wordpress-widget/627127
 */


class JD_SocialBoxConnector{

	public static function get($item) {

        /* Abort if the network is unknown */
        if(!method_exists('JD_SocialBoxConnector', $item['network'])) {
            return array('successful' => false);
        }

		return call_user_func_array(array('JD_SocialBoxConnector', $item['network']), array($item));
	}

	protected static function facebook($item)
	{
		/*
			Check if an App ID and an App Secret are set
		 */
		if(isset($item['app_id']) and ! empty($item['app_id']) and
		   isset($item['app_secret']) and ! empty($item['app_secret']))
		{
			/*
				If yes, use Facebook API v2.0
			 */
			$result = self::remoteGet(sprintf('https://graph.facebook.com/v2.1/%s?access_token=%s|%s', $item['id'], $item['app_id'], $item['app_secret']));
		}
		else
		{
			/*
				If no, use Facebook API v1.0
			*/
			$result = self::remoteGet('https://graph.facebook.com/' . $item['id']);
		}

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
		if($Twitter->getLastStatusCode() != 200) {
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

    protected static function googleplus($item) {

        /* Fetch data from Google+ API */
        $result = self::remoteGet(sprintf('https://www.googleapis.com/plus/v1/people/%s?key=%s', $item['id'], $item['api_key']));

        /* Check for common errors */
        if(self::wasCommonError($result)) {
            return array('successful' => false);
        }

        /* Decode response */
        $data = json_decode(wp_remote_retrieve_body($result));

        /* Check for incorrect data */
        if(is_null($data) or isset($data->error) or !isset($data->circledByCount)){
            return array('successful' => false);
        }

        /* Return value */
        return array(
            'successful' => true,
            'value'      => $data->circledByCount,
        );
    }

	protected static function youtube($item) {
		/* Fetch data from Youtube API */
		$result = self::remoteGet('http://gdata.youtube.com/feeds/api/users/' . $item['id']);

		/* Check for common errors */
		if(self::wasCommonError($result)) {
			return array('successful' => false);
		}

		/* Decode response */
		$data = simplexml_load_string(wp_remote_retrieve_body($result));

		/* Check for incorrect data */
		if(!$data or isset($data->err) or !isset($data->children('http://gdata.youtube.com/schemas/2007')->statistics->attributes()->{$item['metric']})){
			return array('successful' => false);
		}

		/* Return value */
		return array(
			'successful' => true,
			'value'      => (int) $data->children('http://gdata.youtube.com/schemas/2007')->statistics->attributes()->{$item['metric']},
		);
	}

	protected static function vimeo($item) {
		/* Fetch data from Vimeo API */
		$result = self::remoteGet(sprintf('http://vimeo.com/api/v2/channel/%s/info.json', $item['id']));

		/* Check for common errors */
		if(self::wasCommonError($result)) {
			return array('successful' => false);
		}

		/* Decode response */
		$data = json_decode(wp_remote_retrieve_body($result), true);

		/* Check for incorrect data */
		if(!is_array($data) or !isset($data[$item['metric']])){
			return array('successful' => false);
		}

		/* Return value */
		return array(
			'successful' => true,
			'value'      => $data[$item['metric']]
		);
	}

	protected static function instagram($item) {

		/* Fetch data from Graph API */
		$result = self::remoteGet(sprintf('https://api.instagram.com/v1/users/%s?client_id=%s', $item['user_id'], $item['client_id']));

		/* Check for common errors */
		if(self::wasCommonError($result)) {
			return array('successful' => false);
		}

		/* Decode response */
		$data = json_decode(wp_remote_retrieve_body($result), true);

		/* Check for incorrect data */
		if(!is_array($data) or !isset($data['data']) or !isset($data['data']['counts'][$item['metric']])){
			return array('successful' => false);
		}

		/* Return value */
		return array(
			'successful' => true,
			'value'      => $data['data']['counts'][$item['metric']]
		);
	}

    protected static function pinterest($item) {

        /* Fetch profile page */
        $result = self::remoteGet('https://pinterest.com/' . $item['id']);

        /* Check for common errors */
        if(self::wasCommonError($result)) {
            return array('successful' => false);
        }

        /* Prepare regular expression and result body */
        $regex = '/<meta[^>]*?property="pinterestapp:' . $item['metric'] . '"[^>]*?content="(\d+)"/i';
        $html  = wp_remote_retrieve_body($result);

        /* Check for incorrect data */
        if(preg_match($regex, $html, $matches) !== 1) {
            return array('successful' => false);
        }

        /* Return value */
        return array(
            'successful' => true,
            'value'      => intval($matches[1])
        );
    }

	protected static function soundcloud($item)
	{

		/* Fetch data from Dribbble API */
		$result = self::remoteGet(sprintf('http://api.soundcloud.com/users/%s.json?client_id=%s', $item['id'], $item['client_id']));

		/* Check for common errors */
		if(self::wasCommonError($result))
		{
			return array('successful' => false);
		}

		/* Decode response */
		$data = json_decode(wp_remote_retrieve_body($result));

		/* Check for incorrect data */
		if(is_null($data) or isset($data->errors) or ! isset($data->{$item['metric']}))
		{
			return array('successful' => false);
		}

		/* Return value */
		return array(
			'successful' => true,
			'value'      => $data->{$item['metric']}
		);

	}

	protected static function dribbble($item) {

		/* Fetch data from Dribbble API */
		$result = self::remoteGet('http://api.dribbble.com/players/' . $item['id']);

		/* Check for common errors */
		if(self::wasCommonError($result)) {
			return array('successful' => false);
		}

		/* Decode response */
		$data = json_decode(wp_remote_retrieve_body($result), true);

		/* Check for incorrect data */
		if(!is_array($data) or !isset($data[$item['metric']])){
			return array('successful' => false);
		}

		/* Return value */
		return array(
			'successful' => true,
			'value'      => $data[$item['metric']]
		);
	}

	protected static function forrst($item) {

		/* Fetch data from Forrst API */
		$result = self::remoteGet('https://forrst.com/api/v2/users/info?username=' . $item['id']);

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
		$result = self::remoteGet('https://api.github.com/users/' . $item['id']);

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

    protected static function mailchimp($item) {

        /* Extract data center from api key */
        $datacenter = 'us1';
        if(strstr($item['api_key'], '-')) {
            list($key, $datacenter) = explode('-', $item['api_key'], 2);
            if(!$datacenter) $datacenter = 'us1';
        }

        /* Build data object */
        $data = array(
            'apikey' => $item['api_key'],
            'filters' => array(
                'list_id' => $item['id'],
            ),
            'limit' => 1,
        );

        /* Fetch data from MailChimp API v2.0 */
        $result = self::remotePost(sprintf('https://%s.api.mailchimp.com/2.0/lists/list.json', $datacenter), $data);

        /* Check for common errors */
        if(self::wasCommonError($result)) {
            return array('successful' => false);
        }

        /* Decode response */
        $data = json_decode(wp_remote_retrieve_body($result), true);

        /* Check for incorrect data */
        if(!is_array($data) or !isset($data['data'][0]['stats']['member_count'])){
            return array('successful' => false);
        }

        /* Return value */
        return array(
            'successful' => true,
            'value'      => $data['data'][0]['stats']['member_count'],
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

    /**
     * Builds an argument array for use with the wp_remote_* functions
     *
     * @param  mixed $body
     * @return array
     */
    protected static function getRequestArgs($body = null) {

        return array(
            'sslverify'  => !JD_SocialBoxHelper::getOption('disable_ssl'),
            'user-agent' => sprintf('WordPress/%s; SocialBox/%s; %s', get_bloginfo('version'), JD_SOCIALBOX_VERSION, get_bloginfo('url')),
            'body'       => $body,
        );
    }

    protected static function remoteGet($url) {
        return wp_remote_get($url, self::getRequestArgs());
    }

    protected static function remotePost($url, $body) {
        return wp_remote_post($url, self::getRequestArgs($body));
    }
}
