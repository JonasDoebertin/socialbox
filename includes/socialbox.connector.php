<?php
/*
 * SocialBox v.1.3.2
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
		const TWITTER_API_BASE = "http://twitcher.steer.me/user/";

		// /**
		// * Google Plus Base URL
		// */
		// const GOOGLEPLUS_API_BASE = "https://plus.google.com/";
		
		/**
		 * YouTube API Base URL
		 */
		const YOUTUBE_API_BASE ="http://gdata.youtube.com/feeds/api/users/";
		
		/**
		 * Vimeo API Base URL
		 */
		const VIMEO_API_BASE = "http://vimeo.com/api/v2/channel/%s/info.json";
		
		/**
		 * Dribbble API Base URL
		 */
		const DRIBBBLE_API_BASE = "http://api.dribbble.com/players/";
		
		/**
		 * Forrst API Base URL
		 */
		const FORRST_API_BASE = "https://forrst.com/api/v2/users/info?username=";

		/**
		 * GitHub API Base URL
		 */
		const GITHUB_API_BASE = "https://api.github.com/users/";
		
		/**
		 * Get data for given network and account/ID
		 *
		 * Will be called by "SocialBox::refresh()"
		 */
		public static function getData($network, $id, $disableSslVerify){
			
			/* If SSL verification is disabled, set the corresponding identifier */
			$urlIdentifier = ( $disableSslVerify ) ? SocialBox::URL_IDENTIFIER : '';

			switch($network){
				case 'facebook':
					return self::getFacebookData($id, $urlIdentifier);
				case 'twitter':
					return self::getTwitterData($id, $urlIdentifier);
				// case 'googleplus':
				// 	return self::getGooglePlusData($id, $urlIdentifier);
				case 'youtube':
					return self::getYoutubeData($id, $urlIdentifier);
				case 'vimeo':
					return self::getVimeoData($id, $urlIdentifier);
				case 'dribbble':
					return self::getDribbbleData($id, $urlIdentifier);
				case 'forrst':
					return self::getForrstData($id, $urlIdentifier);
				case 'github':
					return self::getGitHubData($id, $urlIdentifier);
				default:
					return array(
							'success'      => false,
							'errorMessage' => "Could not connect to unknown network \"{$network}\""
						);
			}
			
		}
		
		/**
		 * Get Facebook likes for given account
		 *
		 * Will be called by "SocialBox::refresh()"
		 */
		public static function getFacebookData($facebookId, $urlIdentifier){

			/* Fetch data */
			$result = wp_remote_get(self::FACEBOOK_API_BASE . $facebookId . $urlIdentifier);
			
			/* Check for WordPress errors */
			if(is_wp_error($result)){
				return array(
						'success'      => false,
						'errorMessage' => $result->get_error_message()
					);
			}

			/* Check for unsuccessful http requests */
			if(wp_remote_retrieve_response_code($result) != 200){
				return array(
						'success'      => false,
						'errorMessage' => wp_remote_retrieve_response_message($result),
						'errorCode'    => wp_remote_retrieve_response_code($result)
					);
			}
			
			/* Check for incorrect data */
			$data = json_decode(wp_remote_retrieve_body($result), true);
			if(!is_array($data) or isset($data['error']) or !isset($data['likes'])){
				return array(
						'success'      => false,
						'errorMessage' => 'Got an unexpected result from the Facebook Graph API. Make sure to double check the username!'
					);
			}
			
			/* Return like count */
			return array(
					'success' => true,
					'value'   => $data['likes']
				);
			
		}
		
		/**
		 * Get Twitter followers for given account
		 *
		 * Will be called by "SocialBox::refresh()"
		 */
		public static function getTwitterData($twitterId, $urlIdentifier){

			/* Fetch data */
			$result = wp_remote_get(self::TWITTER_API_BASE . $twitterId . $urlIdentifier);
			
			/* Check for WordPress errors */
			if(is_wp_error($result)){
				return array(
						'success'      => false,
						'errorMessage' => $result->get_error_message()
					);
			}

			/* Check for unsuccessful http requests */
			if(wp_remote_retrieve_response_code($result) != 200){
				return array(
						'success'      => false,
						'errorMessage' => wp_remote_retrieve_response_message($result),
						'errorCode'    => wp_remote_retrieve_response_code($result)
					);
			}
			
			/* Check for incorrect data */
			$data = json_decode(wp_remote_retrieve_body($result), true);
			if(!is_array($data) or isset($data['error']) or !isset($data['followers_count'])){
				return array(
						'success'      => false,
						'errorMessage' => 'Got an unexpected result from the Twitter API (or Twitcher). Make sure to double check the username!'
					);
			}
			
			/* Return like count */
			return array(
					'success' => true,
					'value'   => $data['followers_count']
				);
			
		}

		// /**
		//  * Get number of circles a user is in
		//  *
		//  * Will be called by "SocialBox::refresh()"
		//  */
		// public static function getGooglePlusData($googlePlusId, $urlIdentifier){
			
		// 	/* Fetch data */
		// 	$result = wp_remote_get(self::GOOGLEPLUS_API_BASE . $googlePlusId . $urlIdentifier);

		// 	/* Check for WordPress errors */
		// 	if(is_wp_error($result)){
		// 		return array(
		// 				'success'      => false,
		// 				'errorMessage' => $result->get_error_message()
		// 			);
		// 	}

		// 	/* Check for unsuccessful http requests */
		// 	if(wp_remote_retrieve_response_code($result) != 200){
		// 		return array(
		// 				'success'      => false,
		// 				'errorMessage' => wp_remote_retrieve_response_message($result),
		// 				'errorCode'    => wp_remote_retrieve_response_code($result)
		// 			);
		// 	}
			
		// 	/* Extract HTML from response */
		// 	$html = wp_remote_retrieve_body($result);

		// 	/* Check for empty responses */
		// 	if(empty($html)){
		// 		return array(
		// 				'success'      => false,
		// 				'errorMessage' => 'Got an unexpected result from scraping the Google+ page. Make sure to double check the username!'
		// 			);
		// 	}

		// 	/* Extract the numbers */
		// 	preg_match('/<h4 class="nPQ0Mb pD8zNd">[^\(]+\((\d+)\)<\/h4>/i', $html, $matches);

		// 	/* Check for incorrect or missing data */
		// 	if(!isset($matches) or empty($matches) or !isset($matches[1]) or empty($matches[1])){
		// 		return array(
		// 				'success'      => false,
		// 				'errorMessage' => 'Got an unexpected result from scraping the Google+ page. Maybe the markup structure changed?!'
		// 			);
		// 	}
			
		// 	/* Return followers count */
		// 	return array(
		// 			'success' => true,
		// 			'value'   => $matches[1]
		// 		);

		// }
		
		/**
		 * Get YouTube channel subscriptions for given account
		 *
		 * Will be called by "SocialBox::refresh()"
		 */
		public static function getYoutubeData($youtubeId, $urlIdentifier){
			
			/* Fetch data */
			$result = wp_remote_get(self::YOUTUBE_API_BASE . $youtubeId . $urlIdentifier);
			
			/* Check for WordPress errors */
			if(is_wp_error($result)){
				return array(
						'success'      => false,
						'errorMessage' => $result->get_error_message()
					);
			}

			/* Check for unsuccessful http requests */
			if(wp_remote_retrieve_response_code($result) != 200){
				return array(
						'success'      => false,
						'errorMessage' => wp_remote_retrieve_response_message($result),
						'errorCode'    => wp_remote_retrieve_response_code($result)
					);
			}
			
			/* Check for incorrect data */
			$data = simplexml_load_string(wp_remote_retrieve_body($result));
			if(!$data or isset($data->err) or !isset($data->children('http://gdata.youtube.com/schemas/2007')->statistics->attributes()->subscriberCount)){
				return array(
						'success'      => false,
						'errorMessage' => 'Got an unexpected result from the YouTube API. Make sure to double check the username!'
					);
			}
			
			/* Return subscribers count */
			return array(
					'success' => true,
					'value'   => (int) $data->children('http://gdata.youtube.com/schemas/2007')->statistics->attributes()->subscriberCount
				);
			
		}
		
		public static function getVimeoData($vimeoId, $urlIdentifier){
			
			/* Fetch data */
			$result = wp_remote_get(sprintf(self::VIMEO_API_BASE, $vimeoId . $urlIdentifier));
			
			/* Check for WordPress errors */
			if(is_wp_error($result)){
				return array(
						'success'      => false,
						'errorMessage' => $result->get_error_message()
					);
			}

			/* Check for unsuccessful http requests */
			if(wp_remote_retrieve_response_code($result) != 200){
				return array(
						'success'      => false,
						'errorMessage' => wp_remote_retrieve_response_message($result),
						'errorCode'    => wp_remote_retrieve_response_code($result)
					);
			}
			
			/* Check for incorrect data */
			$data = json_decode(wp_remote_retrieve_body($result), true);
			if(!is_array($data) or !isset($data['total_subscribers'])){
				return array(
						'success'      => false,
						'errorMessage' => 'Got an unexpected result from the Vimeo API. Make sure to double check the username!'
					);
			}
			
			/* Return followers count */
			return array(
					'success' => true,
					'value'   => $data['total_subscribers']
				);
			
		}
		
		/**
		 * Get Dribble followers for given account
		 *
		 * Will be called by "SocialBox::refresh()"
		 */
		public static function getDribbbleData($dribbbleId, $urlIdentifier){
			
			/* Fetch data */
			$result = wp_remote_get(self::DRIBBBLE_API_BASE . $dribbbleId . $urlIdentifier);
			
			/* Check for WordPress errors */
			if(is_wp_error($result)){
				return array(
						'success'      => false,
						'errorMessage' => $result->get_error_message()
					);
			}

			/* Check for unsuccessful http requests */
			if(wp_remote_retrieve_response_code($result) != 200){
				return array(
						'success'      => false,
						'errorMessage' => wp_remote_retrieve_response_message($result),
						'errorCode'    => wp_remote_retrieve_response_code($result)
					);
			}
			
			/* Check for incorrect data */
			$data = json_decode(wp_remote_retrieve_body($result), true);
			if(!is_array($data) or !isset($data['followers_count'])){
				return array(
						'success'      => false,
						'errorMessage' => 'Got an unexpected result from the Dribbble API. Make sure to double check the username!'
					);
			}
			
			/* Return followers count */
			return array(
					'success' => true,
					'value'   => $data['followers_count']
				);
			
		}
		
		/**
		 * Get Forrst followers for given account
		 *
		 * Will be called by "SocialBox::refresh()"
		 */
		public static function getForrstData($forrstId, $urlIdentifier){

			/* Fetch data */
			$result = wp_remote_get(self::FORRST_API_BASE . $forrstId . $urlIdentifier);

			/* Check for WordPress errors */
			if(is_wp_error($result)){
				return array(
						'success'      => false,
						'errorMessage' => $result->get_error_message()
					);
			}
			
			/* Check for unsuccessful http requests */
			if(wp_remote_retrieve_response_code($result) != 200){
				return array(
						'success'      => false,
						'errorMessage' => wp_remote_retrieve_response_message($result),
						'errorCode'    => wp_remote_retrieve_response_code($result)
					);
			}
			
			/* Check for incorrect data */
			$data = json_decode(wp_remote_retrieve_body($result), true);
			if(!is_array($data) or !isset($data['resp']['typecast_followers'])){
				return array(
						'success'      => false,
						'errorMessage' => 'Got an unexpected result from the Forrst API. Make sure to double check the username!'
					);
			}

			/* Return followers count */
			return array(
					'success' => true,
					'value'   => $data['resp']['typecast_followers']
				);
			
		}
		
		/**
		 * Get GitHub followers for given account
		 *
		 * Will be called by "SocialBox::refresh()"
		 */
		public static function getGitHubData($gitHubId, $urlIdentifier){
			
			/* Fetch data */
			$result = wp_remote_get(self::GITHUB_API_BASE . $gitHubId . $urlIdentifier);
			
			/* Check for WordPress errors */
			if(is_wp_error($result)){
				return array(
						'success'      => false,
						'errorMessage' => $result->get_error_message()
					);
			}

			/* Check for unsuccessful http requests */
			if(wp_remote_retrieve_response_code($result) != 200){
				return array(
						'success'      => false,
						'errorMessage' => wp_remote_retrieve_response_message($result),
						'errorCode'    => wp_remote_retrieve_response_code($result)
					);
			}
			
			/* Check for incorrect data */
			$data = json_decode(wp_remote_retrieve_body($result), true);
			if(!is_array($data) or !isset($data['followers'])){
				return array(
						'success'      => false,
						'errorMessage' => 'Got an unexpected result from the GitHub API. Make sure to double check the username!'
					);
			}
			
			/* Return followers count */
			return array(
					'success' => true,
					'value'   => $data['followers']
				);
			
		}
		
	}
	
}