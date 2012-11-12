<?php

if(!class_exists('SocialBoxConnector')){
	
	class SocialBoxConnector{
		
		/**
		 * Facebook API Base URL
		 */
		const FACEBOOK_API_BASE = "https://graph.facebook.com/";
		
		/**
		 * Twitter API Base URL
		 */
		const TWITTER_API_BASE = "https://api.twitter.com/1/users/show.json?skip_status=true&screen_name=";
		
		/**
		 * YouTube API Base URL
		 */
		const YOUTUBE_API_BASE ="http://gdata.youtube.com/feeds/api/users/";
		
		/**
		 * Vimeo API Base URL
		 */
		const VIMEO_API_BASE = "http://vimeo.com/api/v2/channel/%s/info.json";
		
		/**
		 * Feedburner API Base URL
		 */
		const FEEDBURNER_API_BASE = "http://feedburner.google.com/api/awareness/1.0/GetFeedData?uri=";
		
		/**
		 * Dribbble API Base URL
		 */
		const DRIBBBLE_API_BASE = "http://api.dribbble.com/players/";
		
		/**
		 * Forrst API Base URL
		 */
		const FORRST_API_BASE = "https://forrst.com/api/v2/users/info?username=";
		
		/**
		 * Digg API Base URL
		 */
		const DIGG_API_BASE = "http://services.digg.com/2.0/user.getInfo?usernames=";
		
		/**
		 * Get data for given network and account/ID
		 *
		 * Will be called by "SocialBox::refresh()"
		 */
		public static function getData($network, $id){
			
			switch($network){
				case 'facebook':
					return self::getFacebookData($id);
				case 'twitter':
					return self::getTwitterData($id);
				case 'youtube':
					return self::getYoutubeData($id);
				case 'vimeo':
					return self::getVimeoData($id);
				case 'feedburner':
					return self::getFeedburnerData($id);
				case 'dribbble':
					return self::getDribbbleData($id);
				case 'forrst':
					return self::getForrstData($id);
				case 'digg':
					return self::getDiggData($id);
				default:
					return false;
			}
			
		}
		
		/**
		 * Get Facebook likes for given account
		 *
		 * Will be called by "SocialBox::refresh()"
		 */
		public static function getFacebookData($facebookId){
			
			/* Fetch data */
			$result = wp_remote_get(self::FACEBOOK_API_BASE . $facebookId);
			
			/* Check for unsuccessful http requests */
			if(is_wp_error($result) or (wp_remote_retrieve_response_code($result) != 200)){
				return false;
			}
			
			/* Check for incorrect data */
			$data = json_decode(wp_remote_retrieve_body($result), true);
			if(!is_array($data) or isset($data['error']) or !isset($data['likes'])){
				return false;
			}
			
			/* Return like count */
			return $data['likes'];
			
		}
		
		/**
		 * Get Twitter followers for given account
		 *
		 * Will be called by "SocialBox::refresh()"
		 */
		public static function getTwitterData($twitterId){
			
			/* Fetch data */
			$result = wp_remote_get(self::TWITTER_API_BASE . $twitterId);
			
			/* Check for unsuccessful http requests */
			if(is_wp_error($result) or (wp_remote_retrieve_response_code($result) != 200)){
				return false;
			}
			
			/* Check for incorrect data */
			$data = json_decode(wp_remote_retrieve_body($result), true);
			if(!is_array($data) or !isset($data['followers_count'])){
				return false;
			}
			
			/* Return followers count */
			return $data['followers_count'];
			
		}
		
		/**
		 * Get YouTube channel subscriptions for given account
		 *
		 * Will be called by "SocialBox::refresh()"
		 */
		public static function getYoutubeData($youtubeId){
			
			/* Fetch data */
			$result = wp_remote_get(self::YOUTUBE_API_BASE . $youtubeId);
			
			/* check for unseccessful http requests */
			if(is_wp_error($result) or (wp_remote_retrieve_response_code($result) != 200)){
				return false;
			}
			
			/* Check for incorrect data */
			$data = simplexml_load_string(wp_remote_retrieve_body($result));
			if(!$data or isset($data->err) or !isset($data->children('http://gdata.youtube.com/schemas/2007')->statistics->attributes()->subscriberCount)){
				return false;
			}
			
			/* Return subscribers count */
			return (int) $data->children('http://gdata.youtube.com/schemas/2007')->statistics->attributes()->subscriberCount;
			
		}
		
		public static function getVimeoData($vimeoId){
			
			/* Fetch data */
			$result = wp_remote_get(sprintf(self::VIMEO_API_BASE, $vimeoId));
			
			/* Check for unsuccessful http requests */
			if(is_wp_error($result) or (wp_remote_retrieve_response_code($result) != 200)){
				return false;
			}
			
			/* Check for incorrect data */
			$data = json_decode(wp_remote_retrieve_body($result), true);
			if(!is_array($data) or !isset($data['total_subscribers'])){
				return false;
			}
			
			/* Return followers count */
			return $data['total_subscribers'];
			
		}
		
		/**
		 * Get Feedburner subscriptions for given feed
		 *
		 * Will be called by "SocialBox::refresh()"
		 */
		public static function getFeedburnerData($feedburnerId){
			
			/* Fetch data */
			$result = wp_remote_get(self::FEEDBURNER_API_BASE . $feedburnerId);
			
			/* Check for unsuccessful http requests */
			if(is_wp_error($result) or (wp_remote_retrieve_response_code($result) != 200)){
				return false;
			}
			
			/* Check for incorrect data */
			$data = simplexml_load_string(wp_remote_retrieve_body($result));
			if(!$data or isset($data->err) or !isset($data->feed->entry['circulation'])){
				return false;
			}
			
			/* Return subscribers count */
			return (int) $data->feed->entry['circulation'];
			
		}
		
		/**
		 * Get Dribble followers for given account
		 *
		 * Will be called by "SocialBox::refresh()"
		 */
		public static function getDribbbleData($dribbbleId){
			
			/* Fetch data */
			$result = wp_remote_get(self::DRIBBBLE_API_BASE . $dribbbleId);
			
			/* Check for unsuccessful http requests */
			if(is_wp_error($result) or (wp_remote_retrieve_response_code($result) != 200)){
				return false;
			}
			
			/* Check for incorrect data */
			$data = json_decode(wp_remote_retrieve_body($result), true);
			if(!is_array($data) or !isset($data['followers_count'])){
				return false;
			}
			
			/* Return followers count */
			return $data['followers_count'];
			
		}
		
		/**
		 * Get Forrst followers for given account
		 *
		 * Will be called by "SocialBox::refresh()"
		 */
		public static function getForrstData($forrstId){
			
			/* Fix: Forrst requires SSL encrypted requests. This could lead to error on Servers like MAMP/XAMPP,
			   so let's simply disable the server-side SSL validation completely. */
			$args = array(
				'method' => 'GET',
				'timeout' => 5,
				'redirection' => 5,
				'httpversion' => '1.0',
				'blocking' => true,
				'headers' => array(),
				'body' => null,
				'cookies' => array(),
				'sslverify' => false /* <- This is the important part! */
			);

			/* Fetch data */
			$result = wp_remote_get(self::FORRST_API_BASE . $forrstId, $args);
			
			/* Check for unsuccessful http requests */
			if(is_wp_error($result) or (wp_remote_retrieve_response_code($result) != 200)){
				return false;
			}
			
			/* Check for incorrect data */
			$data = json_decode(wp_remote_retrieve_body($result), true);
			if(!is_array($data) or !isset($data['resp']['typecast_followers'])){
				return false;
			}

			/* Return followers count */
			return $data['resp']['typecast_followers'];
			
		}
		
		/**
		 * Get Digg followers for given account
		 *
		 * Will be called by "SocialBox::refresh()"
		 */
		public static function getDiggData($diggId){
			
			/* Fetch data */
			$result = wp_remote_get(self::DIGG_API_BASE . $diggId);
			
			/* Check for unsuccessful http requests */
			if(is_wp_error($result) or (wp_remote_retrieve_response_code($result) != 200)){
				return false;
			}
			
			/* Check for incorrect data */
			$data = json_decode(wp_remote_retrieve_body($result), true);
			if(!is_array($data) or !isset($data['users'][$diggId]['followers'])){
				return false;
			}
			
			/* Return followers count */
			return $data['users'][$diggId]['followers'];
			
		}
		
	}
	
}