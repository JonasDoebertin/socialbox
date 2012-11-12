<?php
/*
Plugin Name: 	SocialBox
Plugin URI: 	http://codecanyon.net/item/socialbox-social-wordpress-widget/627127
Description: 	Adds a super easy Social Box Widget which displays the current numbers of Facebook Page Likes, Twitter, Dribbble, Forrst and Digg Followers and YouTube and Vimeo Channel and Feedburner Feed Subscriptions.
Version: 		1.2.1
Author: 		JonasDoebertin
Author URI: 	http://codecanyon.net/user/JonasDoebertin
License: 		Sold exclusively on CodeCanyon
*/

if(!class_exists('SocialBox') and !class_exists('SocialBoxWidget')){
	
	/* Include SocialBoxConnector class. This will connect to the APIs */
	require_once 'includes/socialbox.connector.php';
	
	class SocialBox{
		
		/**
		 * The plugins slug
		 */
		const SLUG = 'socialbox';
		
		/**
		 * The plugins current version number
		 */
		const VERSION = '1.2.1';
		
		/**
		 * Update check script URL
		 */
		const UPDATE_BASE = "http://updates.jonasdoebertin.net/";
		
		/**
		 * Complete list of supported networks
		 */
		const SUPPORTED_NETWORKS = 'facebook,twitter,youtube,vimeo,feedburner,dribbble,forrst,digg';
		
		/**
		 * Create an instance of the plugin
		 */
		public function __construct(){
			
			/* Inject custom cron schedule */
			add_filter('cron_schedules', array($this, 'addCronSchedule'));
			
			/* Register custom actions */
			add_action(self::SLUG . '_fetch', array($this, 'refreshAll'));
			add_action(self::SLUG . '_update', array($this, 'checkForUpdates'));
			
			/* Register (de)activation hook */
			register_activation_hook(__FILE__, array($this, 'activatePlugin'));
			register_deactivation_hook(__FILE__, array($this, 'deactivatePlugin'));
			
			/* If an update is available, then notify */
			/* TODO: Double check version numbers */
			if(is_admin()){
				$info = get_option(self::SLUG . '_update', null);
				if(is_array($info) and $info['update']){
					add_action('admin_notices', array($this, 'addAdminNotice'));
				}	
			}
			
			/* Register Widget */
			add_action('widgets_init', array($this, 'registerWidget'));
			
			/* Register and load textdomain */
			load_plugin_textdomain(self::SLUG, null, basename(dirname(__FILE__)) . '/languages/');
			
			/* Register Widget Stylesheets */
			if(is_admin()){
				
				/* Register additional styles for "widgets" admin page */
				add_action('admin_print_styles-widgets.php', array($this, 'registerAdminStyle'));
				
			} else if(is_active_widget(false, false, self::SLUG, true)){
				
				/* Register SocialBox widget styles */
				add_action('wp_print_styles', array($this, 'registerStyle'));
				
			}			
			
		}
		
		/**
		 * Inject a custom cron schedule timeframe
		 *
		 * @param Array $schedules Preexisting cron schedule timeframes
		 * @return Array Extended cron schedule timeframes
		 */
		public function addCronSchedule($schedules){
			
			$schedules['threehourly'] = array(
				'interval' => 10800,
				'display' => __('Every Three Hours')
			);
			return $schedules;
			
		}
		
		/**
		 * Fetch update information and store it to the database
		 *
		 * This will be executed as scheduled cron event
		 */
		public function checkForUpdates(){
			
			$query = array(
				'slug' => self::SLUG,
				'version' => self::VERSION
			);
			$url = self::UPDATE_BASE . '?' . http_build_query($query);
			
			$result = wp_remote_get($url);
			
			/* Check for unsuccessful http requests */
			if(is_wp_error($result) or (wp_remote_retrieve_response_code($result) != 200)){
				$info = array(
					'update' => false
				);
			}
							
			/* Check for incorrect data */
			$info = unserialize(wp_remote_retrieve_body($result));
			if(!is_array($info) or isset($info['error']) or !isset($info['update'])){
				$info = array(
					'update' => false
				);
			}
			
			update_option(self::SLUG . '_update', $info);
			
		}
		
		/**
		 * Register options and cron schedules
		 *
		 * Will be run through register_activation_hook()
		 */
		public function activatePlugin(){
			
			/* Add options */
			add_option(self::SLUG . '_update', null);
			add_option(self::SLUG . '_options', null);
			
			/* Register cron events */
			wp_schedule_event(time(), 'threehourly', self::SLUG . '_fetch');
			wp_schedule_event(time(), 'daily', self::SLUG . '_update');
			
		}
		
		/**
		 * Deregister options and cron schedules
		 *
		 * Will be run through register_deactivation_hook
		 */
		public function deactivatePlugin(){
			
			/* Delete options */
			delete_option(self::SLUG . '_update');
			//delete_option(self::SLUG . '_options');
			
			/* Deregister cron events */
			wp_clear_scheduled_hook(self::SLUG . '_fetch');
			wp_clear_scheduled_hook(self::SLUG . '_update');
			
		}
		
		/**
		 * Output an update notice on admin screens
		 *
		 * Will be run within "admin_notices" action
		 */
		public function addAdminNotice(){
			
			$info = get_option(self::SLUG . '_update');
			
			?>
			
			<div id="message" class="updated">
				<p>
					<strong><?php _e('SocialBox update available!', self::SLUG); ?></strong>
					<?php printf(__('New Version: %s (%s). Info and download at the <a href="%s">plugin page</a>.', self::SLUG), $info['version'], $info['date'], $info['link']); ?>
				</p>
			</div>
			
			<?php
			
		}
		
		/**
		 * Register the Widget
		 *
		 * Will be run within "widgets_init" action
		 */
		public function registerWidget(){
			
			register_widget('SocialBoxWidget');
			
		}
		
		/**
		 * Register the widgets admin stylesheet
		 *
		 * Will be run in "admin_print_styles-widgets.php" action and only on widgets admin page
		 */
		public function registerAdminStyle(){
			
			/* register Style */
			wp_register_style(self::SLUG . '-admin', plugins_url('css/socialbox-admin.css', __FILE__), array(), self::VERSION, 'screen');
						
			/* Enqueue Style */
			wp_enqueue_style(self::SLUG . '-admin');
			
		}
		
		/**
		 * Register the widgets stylesheet
		 *
		 * Will be run in "wp_print_styles" action and only on frontend pages and if widget is actually used
		 */
		public function registerStyle(){
			
			/* Register style */
			wp_register_style(self::SLUG, plugins_url('css/socialbox.css', __FILE__), array(), self::VERSION, 'screen');
			
			/* Enqueue style */
			wp_enqueue_style(self::SLUG);
			
		}
		
		/**
		 * Refresh the social data for each SocialBox widget
		 *
		 * This will be executed as scheduled cron event
		 */
		public function refreshAll(){
			
			/* Abort if no widget has been set up */
			$opts = get_option(self::SLUG . '_options', null);
			if(!is_array($opts)){
				return;
			}
			
			/* Call static refresh function for each widget */
			foreach($opts as $widgetId => $widget){
				SocialBox::refresh($widgetId);
			}
			
		}

		/**
		 * Refresh data for given Widget
		 *
		 * Will be called after updating a Widgets settings or by "SocialBox::doFetch()"
		 */
		public static function refresh($widgetId){
			
			/* Get options if available or cancel*/
			$opts = get_option(SocialBox::SLUG . '_options', null);
			if(is_array($opts) and isset($opts[$widgetId])){
				
				$widget = $opts[$widgetId];
				
			} else{
				
				return;
				
			}

			/* Loop through supported networks and update data */
			foreach(self::getSupportedNetworks() as $network){
				
				if(isset($widget[$network . '_id']) and !empty($widget[$network . '_id'])){
					
					$newCount = SocialBoxConnector::getData($network, $widget[$network . '_id']);
					$widget[$network . '_count'] = ((is_numeric($newCount)) ? $newCount : $widget[$network . '_default']);

				}

			}

			/* FIX: Feedburner sometimes returns 0 instead of actual value. Let's compensate that! */
			if(isset($widget['feedburner_id']) and !empty($widget['feedburner_id']) and( $widget['feedburner_count'] == 0) and ($widget['feedburner_default'] != 0)){
				$widget['feedburner_count']	= $widget['feedburner_default'];
			}
			
			/* Save new data */
			$opts[$widgetId] = $widget;
			update_option(SocialBox::SLUG . '_options', $opts);
			
		}
		
		public static function getSupportedNetworks(){
			return explode(',', self::SUPPORTED_NETWORKS);
		}
		
	}
	
	class SocialBoxWidget extends WP_Widget{
		
		/**
		 * The Widgets slug
		 */
		const SLUG = 'socialbox';
		
		/**
		 * Create a widget instance and set the base infos
		 */
		public function __construct(){
			
			/* Widget settings */
			$widgetOpts = array(
				'classname' => self::SLUG,
				'description' => __('Displays the numbers of Twitter Followers, Facebook Fans and Youtube Channel and Feedburner Feed Subscribers', self::SLUG)
			);
			
			/* Widget control settings */
			$controlOpts = array(
				'id_base' => self::SLUG,
				'width' => 280
			);
			
			/* Create the widget */
			parent::__construct(self::SLUG, 'SocialBox', $widgetOpts, $controlOpts);
			
		}
		
		/**
		 * Display the actual Widget
		 *
		 * @param Array $args
		 * @param Array $instance
		 */
		public function widget($args, $instance){
			
			extract($args);
			
			/* Get data of main plugin option */
			$opts = get_option(self::SLUG . '_options', null);
			
			/* Build up network data array */
			$networks = array();
			foreach(SocialBox::getSupportedNetworks() as $network){
				
				if(isset($instance[$network . '_id']) and !empty($instance[$network . '_id'])){
					$networks[] = array(
						'type' 			=> $network,
						'id' 			=> $instance[$network . '_id'],
						'position' 		=> $instance[$network . '_position'],
						'count' 		=> (isset($opts[$this->id][$network . '_count']) ? $opts[$this->id][$network . '_count'] : 0),
						'link' 			=> $this->getNetworkLink($network, $instance[$network . '_id']),
						'name' 			=> $this->getNetworkName($network),
						'metric' 		=> $this->getNetworkMetric($network),
						'buttonText' 	=> $this->getNetworkButtonText($network),
						'buttonHint' 	=> $this->getNetworkButtonHint($network)
					);
				}
				
			}
			usort($networks, array($this, 'sortByPosition'));
			
			/* Get additional options */
			$newWindow = $instance['new_window'];
			$showButtons = $instance['show_buttons'];
			
			//print_r($networks);
			
			/* Before Widget HTML */
			echo $before_widget;
				
			/* Social Box */
			include 'includes/widget.php';
			
			/* After Widget HTML */
			echo $after_widget;
			
			
		}
		
		/**
		 * Update Widget settings and refresh data for this Widget
		 *
		 * @param Array $newInstance
		 * @param Array $oldInstance
		 * @return Array
		 */
		public function update($newInstance, $oldInstance){
			
			/* Update widget settings */
			$instance = $oldInstance;
			$instance['new_window'] = $newInstance['new_window'];
			$instance['show_buttons'] = $newInstance['show_buttons'];
			$instance['facebook_id'] = trim(strip_tags($newInstance['facebook_id']));
			$instance['facebook_default'] = ((is_numeric($newInstance['facebook_default'])) ? trim($newInstance['facebook_default']) : 0);
			$instance['facebook_position'] = ((is_numeric($newInstance['facebook_position'])) ? trim($newInstance['facebook_position']) : 1);
			$instance['twitter_id'] = trim(strip_tags($newInstance['twitter_id']));
			$instance['twitter_default'] = ((is_numeric($newInstance['twitter_default'])) ? trim($newInstance['twitter_default']) : 0);
			$instance['twitter_position'] = ((is_numeric($newInstance['twitter_position'])) ? trim($newInstance['twitter_position']) : 1);
			$instance['youtube_id'] = trim(strip_tags($newInstance['youtube_id']));
			$instance['youtube_default'] = ((is_numeric($newInstance['youtube_default'])) ? trim($newInstance['youtube_default']) : 0);
			$instance['youtube_position'] = ((is_numeric($newInstance['youtube_position'])) ? trim($newInstance['youtube_position']) : 1);
			$instance['vimeo_id'] = trim(strip_tags($newInstance['vimeo_id']));
			$instance['vimeo_default'] = ((is_numeric($newInstance['vimeo_default'])) ? trim($newInstance['vimeo_default']) : 0);
			$instance['vimeo_position'] = ((is_numeric($newInstance['vimeo_position'])) ? trim($newInstance['vimeo_position']) : 1);
			$instance['feedburner_id'] = trim(strip_tags($newInstance['feedburner_id']));
			$instance['feedburner_default'] = ((is_numeric($newInstance['feedburner_default'])) ? trim($newInstance['feedburner_default']) : 0);
			$instance['feedburner_position'] = ((is_numeric($newInstance['feedburner_position'])) ? trim($newInstance['feedburner_position']) : 1);
			$instance['dribbble_id'] = trim(strip_tags($newInstance['dribbble_id']));
			$instance['dribbble_default'] = ((is_numeric($newInstance['dribbble_default'])) ? trim($newInstance['dribbble_default']) : 0);
			$instance['dribbble_position'] = ((is_numeric($newInstance['dribbble_position'])) ? trim($newInstance['dribbble_position']) : 1);
			$instance['forrst_id'] = trim(strip_tags($newInstance['forrst_id']));
			$instance['forrst_default'] = ((is_numeric($newInstance['forrst_default'])) ? trim($newInstance['forrst_default']) : 0);
			$instance['forrst_position'] = ((is_numeric($newInstance['forrst_position'])) ? trim($newInstance['forrst_position']) : 1);
			$instance['digg_id'] = trim(strip_tags($newInstance['digg_id']));
			$instance['digg_default'] = ((is_numeric($newInstance['digg_default'])) ? trim($newInstance['digg_default']) : 0);
			$instance['digg_position'] = ((is_numeric($newInstance['digg_position'])) ? trim($newInstance['digg_position']) : 1);
			
			/* Save changes to global plugin options */
			$opts = get_option(self::SLUG . '_options', null);
			if(!is_array($opts)){
				$opts = array();
			}
			$opts[$this->id] = array(
				'facebook_id' => $instance['facebook_id'],
				'facebook_default' => $instance['facebook_default'],
				'twitter_id' => $instance['twitter_id'],
				'twitter_default' => $instance['twitter_default'],
				'youtube_id' => $instance['youtube_id'],
				'youtube_default' => $instance['youtube_default'],
				'vimeo_id' => $instance['vimeo_id'],
				'vimeo_default' => $instance['vimeo_default'],
				'feedburner_id' => $instance['feedburner_id'],
				'feedburner_default' => $instance['feedburner_default'],
				'dribbble_id' => $instance['dribbble_id'],
				'dribbble_default' => $instance['dribbble_default'],
				'forrst_id' => $instance['forrst_id'],
				'forrst_default' => $instance['forrst_default'],
				'digg_id' => $instance['digg_id'],
				'digg_default' => $instance['digg_default']
			);
			update_option(self::SLUG . '_options', $opts);
			
			/* Force data refresh */
			SocialBox::refresh($this->id);
			
			return $instance;
			
		}
		
		/**
		 * Show the Widgets settings form
		 *
		 * @param Array $instance
		 */
		public function form($instance){
			
			/* Apply default values */
			$defaults = array(
				'facebook_id' => 			'',
				'facebook_default' => 		0,
				'facebook_position' =>		1,
				'twitter_id' => 			'',
				'twitter_default' => 		0,
				'twitter_position' =>		2,
				'youtube_id' => 			'',
				'youtube_default' => 		0,
				'youtube_position' =>		3,
				'vimeo_id' => 				'',
				'vimeo_default' => 			0,
				'vimeo_position' =>			4,
				'feedburner_id' => 			'',
				'feedburner_default' => 	0,
				'feedburner_position' =>	5,
				'dribbble_id' => 			'',
				'dribbble_default' => 		0,
				'dribbble_position' =>		6,
				'forrst_id' => 				'',
				'forrst_default' => 		0,
				'forrst_position' =>		7,
				'digg_id' => 				'',
				'digg_default' => 			0,
				'digg_position' =>			8,
				'new_window' => 			false,
				'show_buttons' => 			true
			);
			$instance = wp_parse_args((array) $instance, $defaults);
			
			/* Show Widget Options */
			include 'includes/form.php';
			
		}
		
		private function sortByPosition($a, $b){
		
			return $a['position'] - $b['position'];
		
		}
		
		/**
		 * Helper - Returns a link to the network specific user account
		 *
		 * @param String $network
		 * @param String $id
		 * @return String
		 */
		private function getNetworkLink($network, $id){
			
			switch($network){
				
				case 'facebook':
					return "http://www.facebook.com/" . ((is_numeric($id)) ? "profile.php?id={$id}" : $id);
				case 'twitter':
					return "http://twitter.com/{$id}";
				case 'youtube':
					return "http://www.youtube.com/user/{$id}";
				case 'vimeo':
					return "http://vimeo.com/channels/{$id}";
				case 'feedburner':
					return "http://feeds.feedburner.com/{$id}";
				case 'dribbble':
					return "http://dribbble.com/{$id}";
				case 'forrst':
					return "http://forrst.com/people/{$id}";
				case 'digg':
					return "http://digg.com/{$id}";			
			}
			
		}

		private function getNetworkName($network){
			
			switch($network){
				
				case 'facebook':
					return __('Facebook', self::SLUG);
				case 'twitter':
					return __('Twitter', self::SLUG);
				case 'youtube':
					return __('YouTube', self::SLUG);
				case 'vimeo':
					return __('Vimeo', self::SLUG);
				case 'feedburner':
					return __('Feedburner', self::SLUG);
				case 'dribbble':
					return __('Dribbble', self::SLUG);
				case 'forrst':
					return __('Forrst', self::SLUG);
				case 'digg':
					return __('Digg', self::SLUG);		
			}

		}

		private function getNetworkMetric($network){
			
			switch($network){
				
				case 'facebook':
					return __('Fans', self::SLUG);
				case 'twitter':
					return __('Followers', self::SLUG);
				case 'youtube':
					return __('Subscribers', self::SLUG);
				case 'vimeo':
					return __('Subscribers', self::SLUG);
				case 'feedburner':
					return __('Subscribers', self::SLUG);
				case 'dribbble':
					return __('Followers', self::SLUG);
				case 'forrst':
					return __('Followers', self::SLUG);
				case 'digg':
					return __('Followers', self::SLUG);		
			}
			
		}
		
		private function getNetworkButtonText($network){
			
			switch($network){
				
				case 'facebook':
					return __('Like', self::SLUG);
				case 'twitter':
					return __('Follow', self::SLUG);
				case 'youtube':
					return __('Subscribe', self::SLUG);
				case 'vimeo':
					return __('Subscribe', self::SLUG);
				case 'feedburner':
					return __('Subscribe', self::SLUG);
				case 'dribbble':
					return __('Follow', self::SLUG);
				case 'forrst':
					return __('Follow', self::SLUG);
				case 'digg':
					return __('Follow', self::SLUG);		
			}
			
		}

		private function getNetworkButtonHint($network){
			
			switch($network){
				
				case 'facebook':
					return __('Like on Facebook', self::SLUG);
				case 'twitter':
					return __('Follow on Twitter', self::SLUG);
				case 'youtube':
					return __('Subscribe to Youtube Channel', self::SLUG);
				case 'vimeo':
					return __('Subscribe to Vimeo Channel', self::SLUG);
				case 'feedburner':
					return __('Subscribe to Feed', self::SLUG);
				case 'dribbble':
					return __('Follow on Dribbble', self::SLUG);
				case 'forrst':
					return __('Follow on Forrst', self::SLUG);
				case 'digg':
					return __('Follow on Digg', self::SLUG);		
			}
			
		}
		
		/**
		 * Helper - Get absolute URL for $path
		 *
		 * @param String $path
		 * @return String
		 */
		private function getUrl($path){
			
			return plugins_url($path, __FILE__);
			
		}
		
		/**
		 * Helper - Echo absolute URL for $path
		 *
		 * @param String $path
		 */
		private function url($path){
			
			echo $this->getUrl($path);
			
		}
		
	}
	
}

/* Create instance of SocialBox*/
if(class_exists('SocialBox')){
	$SocialBox = new SocialBox();
}