<?php
/*
 * SocialBox v.1.3.0
 * Copyright by Jonas Doebertin
 * Available at CodeCanyon: http://codecanyon.net/item/socialbox-social-wordpress-widget/627127
 */

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
		* Google Plus Base URL
		*/
		const GOOGLEPLUS_API_BASE = "https://plus.google.com/";
		
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
		 * GitHub API Base URL
		 */
		const GITHUB_API_BASE = "https://api.github.com/users/";
		
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
				case 'googleplus':
					return self::getGooglePlusData($id);
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
					SocialBox::log($network, $id, '---', "Could not connect to unknown network \"{$network}\"");
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
			
			/* Check for WordPress errors */
			if(is_wp_error($result)){
				SocialBox::log('facebook', $facebookId, '---', $result->get_error_message());
				return false;
			}

			/* Check for unsuccessful http requests */
			if(wp_remote_retrieve_response_code($result) != 200){
				SocialBox::log('facebook', $facebookId, wp_remote_retrieve_response_code($result), wp_remote_retrieve_response_message($result));
				return false;
			}
			
			/* Check for incorrect data */
			$data = json_decode(wp_remote_retrieve_body($result), true);
			if(!is_array($data) or isset($data['error']) or !isset($data['likes'])){
				SocialBox::log('facebook', $facebookId, '---', 'Got an unexpected result from the Facebook Graph API. Make sure to double check the username!');
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
			
			/* Check for WordPress errors */
			if(is_wp_error($result)){
				SocialBox::log('twitter', $twitterId, '---', $result->get_error_message());
				return false;
			}

			/* Check for unsuccessful http requests */
			if(wp_remote_retrieve_response_code($result) != 200){
				SocialBox::log('twitter', $twitterId, wp_remote_retrieve_response_code($result), wp_remote_retrieve_response_message($result));
				return false;
			}
			
			/* Check for incorrect data */
			$data = json_decode(wp_remote_retrieve_body($result), true);
			if(!is_array($data) or !isset($data['followers_count'])){
				SocialBox::log('twitter', $twitterId, '---', 'Got an unexpected result from the Twitter API. Make sure to double check the username!');
				return false;

			}
			
			/* Return followers count */
			return $data['followers_count'];
			
		}

		/**
		 * Get number of circles a user is in
		 *
		 * Will be called by "SocialBox::refresh()"
		 */
		public static function getGooglePlusData($googlePlusId){
			
			/* Fetch data */
			$result = wp_remote_get(self::GOOGLEPLUS_API_BASE . $googlePlusId);

			/* Check for WordPress errors */
			if(is_wp_error($result)){
				SocialBox::log('googleplus', $googlePlusId, '---', $result->get_error_message());
				return false;
			}

			/* Check for unsuccessful http requests */
			if(wp_remote_retrieve_response_code($result) != 200){
				SocialBox::log('googleplus', $googlePlusId, wp_remote_retrieve_response_code($result), wp_remote_retrieve_response_message($result));
				return false;
			}
			
			/* Extract HTML from response */
			$html = wp_remote_retrieve_body($result);

			/* Check for empty responses */
			if(empty($html)){
				SocialBox::log('googleplus', $googlePlusId, '---', 'Got an unexpected result from scraping the Google+ page. Make sure to double check the username!');
				return false;
			}

			/* Extract the numbers */
			preg_match('/<h4 class="nPQ0Mb pD8zNd">[^\(]+\((\d+)\)<\/h4>/i', $html, $matches);

			/* Check for incorrect or missing data */
			if(!isset($matches) or empty($matches) or !isset($matches[1]) or empty($matches[1])){
				SocialBox::log('googleplus', $googlePlusId, '---', 'Got an unexpected result from scraping the Google+ page. Make sure to double check the username!');
				return false;
			}
			
			/* Return followers count */
			return $matches[1];

		}
		
		/**
		 * Get YouTube channel subscriptions for given account
		 *
		 * Will be called by "SocialBox::refresh()"
		 */
		public static function getYoutubeData($youtubeId){
			
			/* Fetch data */
			$result = wp_remote_get(self::YOUTUBE_API_BASE . $youtubeId);
			
			/* Check for WordPress errors */
			if(is_wp_error($result)){
				SocialBox::log('youtube', $youtubeId, '---', $result->get_error_message());
				return false;
			}

			/* Check for unsuccessful http requests */
			if(wp_remote_retrieve_response_code($result) != 200){
				SocialBox::log('youtube', $youtubeId, wp_remote_retrieve_response_code($result), wp_remote_retrieve_response_message($result));
				return false;
			}
			
			/* Check for incorrect data */
			$data = simplexml_load_string(wp_remote_retrieve_body($result));
			if(!$data or isset($data->err) or !isset($data->children('http://gdata.youtube.com/schemas/2007')->statistics->attributes()->subscriberCount)){
				SocialBox::log('youtube', $youtubeId, '---', 'Got an unexpected result from the YouTube API. Make sure to double check the username!');
				return false;
			}
			
			/* Return subscribers count */
			return (int) $data->children('http://gdata.youtube.com/schemas/2007')->statistics->attributes()->subscriberCount;
			
		}
		
		public static function getVimeoData($vimeoId){
			
			/* Fetch data */
			$result = wp_remote_get(sprintf(self::VIMEO_API_BASE, $vimeoId));
			
			/* Check for WordPress errors */
			if(is_wp_error($result)){
				SocialBox::log('vimeo', $vimeoId, '---', $result->get_error_message());
				return false;
			}

			/* Check for unsuccessful http requests */
			if(wp_remote_retrieve_response_code($result) != 200){
				SocialBox::log('vimeo', $vimeoId, wp_remote_retrieve_response_code($result), wp_remote_retrieve_response_message($result));
				return false;
			}
			
			/* Check for incorrect data */
			$data = json_decode(wp_remote_retrieve_body($result), true);
			if(!is_array($data) or !isset($data['total_subscribers'])){
				SocialBox::log('vimeo', $vimeoId, '---', 'Got an unexpected result from the Vimeo API. Make sure to double check the username!');
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
			
			/* Check for WordPress errors */
			if(is_wp_error($result)){
				SocialBox::log('feedburner', $feedburnerId, '---', $result->get_error_message());
				return false;
			}

			/* Check for unsuccessful http requests */
			if(wp_remote_retrieve_response_code($result) != 200){
				SocialBox::log('feedburner', $feedburnerId, wp_remote_retrieve_response_code($result), wp_remote_retrieve_response_message($result));
				return false;
			}
			
			/* Check for incorrect data */
			$data = simplexml_load_string(wp_remote_retrieve_body($result));
			if(!$data or isset($data->err) or !isset($data->feed->entry['circulation'])){
				SocialBox::log('feedburner', $feedburnerId, '---', 'Got an unexpected result from the Feedburner Awareness API. Make sure to double check the feed name!');
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
			
			/* Check for WordPress errors */
			if(is_wp_error($result)){
				SocialBox::log('dribbble', $dribbbleId, '---', $result->get_error_message());
				return false;
			}

			/* Check for unsuccessful http requests */
			if(wp_remote_retrieve_response_code($result) != 200){
				SocialBox::log('dribbble', $dribbbleId, wp_remote_retrieve_response_code($result), wp_remote_retrieve_response_message($result));
				return false;
			}
			
			/* Check for incorrect data */
			$data = json_decode(wp_remote_retrieve_body($result), true);
			if(!is_array($data) or !isset($data['followers_count'])){
				SocialBox::log('dribbble', $dibbbleId, '---', 'Got an unexpected result from the Dribbble API. Make sure to double check the username!');
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

			/* Fetch data */
			$result = wp_remote_get(self::FORRST_API_BASE . $forrstId, $args);

			/* Check for WordPress errors */
			if(is_wp_error($result)){
				SocialBox::log('forrst', $forrstId, '---', $result->get_error_message());
				return false;
			}
			
			/* Check for unsuccessful http requests */
			if(wp_remote_retrieve_response_code($result) != 200){
				SocialBox::log('forrst', $forrstId, wp_remote_retrieve_response_code($result), wp_remote_retrieve_response_message($result));
				return false;
			}
			
			/* Check for incorrect data */
			$data = json_decode(wp_remote_retrieve_body($result), true);
			if(!is_array($data) or !isset($data['resp']['typecast_followers'])){
				SocialBox::log('forrst', $forrstId, '---', 'Got an unexpected result from the Forrst API. Make sure to double check the username!');
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
			
			/* Check for WordPress errors */
			if(is_wp_error($result)){
				SocialBox::log('digg', $diggId, '---', $result->get_error_message());
				return false;
			}

			/* Check for unsuccessful http requests */
			if(wp_remote_retrieve_response_code($result) != 200){
				SocialBox::log('digg', $diggId, wp_remote_retrieve_response_code($result), wp_remote_retrieve_response_message($result));
				return false;
			}
			
			/* Check for incorrect data */
			$data = json_decode(wp_remote_retrieve_body($result), true);
			if(!is_array($data) or !isset($data['users'][$diggId]['followers'])){
				SocialBox::log('digg', $diggId, '---', 'Got an unexpected result from the Digg API. Make sure to double check the username!');
				return false;
			}
			
			/* Return followers count */
			return $data['users'][$diggId]['followers'];
			
		}
		
	}
	
}