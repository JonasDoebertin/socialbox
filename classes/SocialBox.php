<?php if(!defined('ABSPATH')) die('Direct access is not allowed.');


/*
 * SocialBox 1.4.0
 * Copyright by Jonas Döbertin
 * Available only at CodeCanyon: http://codecanyon.net/item/socialbox-social-wordpress-widget/627127
 */
	

class JD_SocialBox{
	
	/**
	 * Update check script URL
	 */
	const UPDATE_BASE = "http://updates.jonasdoebertin.net/";
	
	/**
	 * Complete list of supported networks
	 */
	const SUPPORTED_NETWORKS = 'facebook,twitter,youtube,vimeo,dribbble,forrst,github';

	/**
	 * This will be appended to the API call urls to identify SocialBoxes http requests
	 */
	const URL_IDENTIFIER = '#socialbox';

	/**
	 * Holds the slug of the settings page, once it has been registered
	 */
	protected $settingsPageSlug;
	
	/**
	 * Create an instance of the plugin
	 */
	public function __construct(){

		// /* Disable SSL-Verification when corresponding settings is enabled */
		// if( JD_SocialBoxHelper::getOption('disable_ssl') === '1' ){
		// 	add_filter('http_request_args', array($this, 'disableSslVerify'), 10, 2);
		// }
		
		/* Inject custom cron schedule */
		add_filter('cron_schedules', array($this, 'addCronSchedule'));
		
		/* Register custom actions */
		add_action('socialbox_update_cache', array($this, 'updateCache'));
		add_action('socialbox_check_for_update', array($this, 'checkForUpdate'));
		
		/* If an update is available, then notify */
		/* TODO: Double check version numbers */
		if(is_admin()){
			$info = get_option('socialbox_updateinfo', null);
			if(is_array($info) and $info['update']){
				add_action('admin_notices', array($this, 'addAdminNotice'));
			}	
		}
		
		/* Register Widget */
		add_action('widgets_init', array($this, 'registerWidget'));
		
		/* Register and load textdomain */
		load_plugin_textdomain('socialbox', null, dirname(JD_SOCIALBOX_BASENAME) . '/languages/');
		
		/* Backend only stuff */
		if(is_admin()){
			
			/* Add custom "Settings" link to plugin actions */
			add_action('plugin_action_links_' . JD_SOCIALBOX_BASENAME, array($this, 'addPluginActionLink'));

			/* Register additional styles for "widgets.php" admin page */
			add_action('admin_print_styles-widgets.php', array($this, 'registerWidgetsPageStyle'));

			/* Register Options Page */
			add_action('admin_menu', array($this, 'registerOptionsPage'));

			/* Register Settings */
			add_action('admin_init', array($this, 'registerSettings'));

			/* Register styles for options page */
			add_action('admin_print_styles-settings_page_socialbox', array($this, 'registerOptionsPageStyle'));
		
		/* Fronted only stuff */
		} else if(is_active_widget(false, false, 'socialbox', true)){
			
			/* Register SocialBox widget styles */
			add_action('wp_enqueue_scripts', array($this, 'registerStyle'));
			
		}
		
	}

	/**
	 * Disable the SSL certificate validation for a given http request
	 *
	 * @param Array $args
	 * @param String $url
	 * @return Array
	 */
	public function disableSslVerify($args, $url){

		/* Check if this http request belongs to SocialBox */
		if( substr($url, -1 * strlen(self::URL_IDENTIFIER)) === self::URL_IDENTIFIER ){

			/* Disable SSL verification flag */
			$args['sslverify'] = false;

			/* Remove identifier from url */
			$url = substr($url, 0, strlen($url) - strlen(self::URL_IDENTIFIER));

		}

		return $args;

	}
	
	/**
	 * Inject a custom cron schedule timeframe
	 *
	 * @param Array $schedules Preexisting cron schedule timeframes
	 * @return Array Extended cron schedule timeframes
	 */
	public function addCronSchedule($schedules) {

		/* Add "Every Ten Minutes" for cache updates */
		$schedules['everytenminutes'] = array(
			'interval' => 600,
			'display' => __('Every Ten Minutes')
		);
		return $schedules;

	}
	
	/**
	 * Fetch update information and store it to the database
	 *
	 * This will be executed as scheduled cron event
	 */
	public function checkForUpdate() {
		
		$query = array(
			'slug' => 'socialbox',
			'version' => JD_SOCIALBOX_VERSION
		);
		$url = self::UPDATE_BASE . '?' . http_build_query($query);
		
		$result = wp_remote_get($url);
		
		/* Check for unsuccessful http requests */
		if( is_wp_error($result) or (wp_remote_retrieve_response_code($result) != 200) ){
			
			$updateinfo = array(
				'update' => false
			);

		} else{

			/* Check for incorrect data */
			$updateinfo = unserialize(wp_remote_retrieve_body($result));
			if( !is_array($updateinfo) or isset($updateinfo['error']) or !isset($updateinfo['update'])){
				
				$updateinfo = array(
					'update' => false
				);

			}

		}
						
		update_option('socialbox_updateinfo', $info);
		
	}
	
	/**
	 * Register options and cron schedules
	 *
	 * Will be run through register_activation_hook()
	 */
	public function activatePlugin(){

		/* Add options */
		add_option('socialbox_updateinfo', array());
		add_option('socialbox_options', array());
		add_option('socialbox_cache', array());
		
		/* Register cron events */
		wp_schedule_event(time(), 'everytenminutes', 'socialbox_update_cache');
		wp_schedule_event(time(), 'daily', 'socialbox_check_for_update');
		
		/*
			Save last version used.
			By doing this, we can perform upgrade routines
			based on the previously installed versions
			in the future.
		 */
		add_option('socialbox_last_version', JD_SOCIALBOX_VERSION);

	}
	
	/**
	 * Deregister options and cron schedules
	 *
	 * Will be run through register_deactivation_hook
	 */
	public function deactivatePlugin(){

		/* Delete options */
		delete_option('socialbox_updateinfo');
		delete_option('socialbox_cache');
		
		/* Deregister cron events */
		wp_clear_scheduled_hook('socialbox_update_cache');
		wp_clear_scheduled_hook('socialbox_check_for_update');
		
	}
	
	/**
	 * Output an update notice on admin screens
	 *
	 * Will be run within "admin_notices" action
	 */
	public function addAdminNotice(){
		
		$info = get_option('socialbox_update');
		
		?>
		
		<div id="message" class="updated">
			<p>
				<strong><?php _e('SocialBox update available!', 'socialbox'); ?></strong>
				<?php printf(__('New Version: %s (%s). Info and download at the <a href="%s">plugin page</a>.', 'socialbox'), $info['version'], $info['date'], $info['link']); ?>
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
		
		register_widget('JD_SocialBoxWidget');
		
	}

	public function addPluginActionLink($actionLinks){

		$html = '<a href="options-general.php?page=socialbox&tab=settings" title="' . __('SocialBox Settings', 'socialbox') . '">' . __('Settings', 'socialbox') . '</a>';
		
		array_unshift($actionLinks, $html);
		return $actionLinks;

	}
	
	/**
	 * Register the widgets admin stylesheet
	 *
	 * Will be run in "admin_print_styles-widgets.php" action and only on widgets admin page
	 */
	public function registerWidgetsPageStyle(){
		
		/* register Style */
		wp_register_style('socialbox-widgets-page', JD_SOCIALBOX_URL . '/assets/css/widgets-page.css', array(), JD_SOCIALBOX_VERSION, 'screen');
					
		/* Enqueue Style */
		wp_enqueue_style('socialbox-widgets-page');
		
	}
	
	/**
	 * Register & enqueue the widgets stylesheet
	 *
	 * Will be run in "wp_print_styles" action and only on frontend pages and if widget is actually used
	 */
	public function registerStyle(){
		
		/* Register style */
		wp_register_style('socialbox', JD_SOCIALBOX_URL . '/assets/css/socialbox.css', array(), JD_SOCIALBOX_VERSION, 'screen');
		
		/* Enqueue style */
		wp_enqueue_style('socialbox');
		
	}

	/**
	 * Add the options page
	 *
	 * Will be run in "admin_menu" action
	 */
	public function registerOptionsPage(){

		$this->settingsPageSlug = add_options_page(
			__('SocialBox', 'socialbox'),
			__('SocialBox', 'socialbox'),
			'manage_options',
			'socialbox',
			array($this, 'renderOptionsPage')
		);

	}

	/**
	 * Register all setting sections and fields
	 */
	public function registerSettings(){

		/* Register setting */
		register_setting(
			'socialbox_options',
			'socialbox_options',
			null
		);

		/* Register settings section for "Advanced Settings" */
		add_settings_section(
			'socialbox_advanced',
			__('Advanced Settings', 'socialbox'),
			array($this, 'printAdvancedSettingsSection'),
			'socialbox'
		);

		add_settings_field(
			'update_interval',
			__('Update Interval', 'socialbox'),
			array($this, 'printUpdateIntervalSettingsField'),
			'socialbox',
			'socialbox' . '_advanced',
			array('label_for' => 'socialbox_update_interval')
		);

		add_settings_field(
			'disable_ssl',
			__('SSL-Verification', 'socialbox'),
			array($this, 'printDisableSslSettingsField'),
			'socialbox',
			'socialbox' . '_advanced',
			array('label_for' => 'socialbox_disable_ssl')
		);

		/* Register settings section for "Debugging Settings" */
		add_settings_section(
			'socialbox_debugging',
			__('Debugging', 'socialbox'),
			array($this, 'printDebuggingSettingsSection'),
			'socialbox'
		);

		add_settings_field(
			'enable_log',
			__('API Log', 'socialbox'),
			array($this, 'printEnableLogSettingsField'),
			'socialbox',
			'socialbox_debugging',
			array('label_for' => 'socialbox_enable_log')
		);

		add_settings_field(
			'log_entries',
			__('API Log Entries', 'socialbox'),
			array($this, 'printLogEntriesSettingsField'),
			'socialbox',
			'socialbox_debugging',
			array('label_for' => 'socialbox_log_entries')
		);

	}

	public function printAdvancedSettingsSection(){

		echo '<p>' . __('Some advanced options to tweak SocialBox\'s internals', 'socialbox') . '</p>';

	}

	public function printUpdateIntervalSettingsField($args){

		$html = '<input type="text" id="' . $args['label_for'] . '" name="socialbox_options[update_interval]" value="' . JD_SocialBoxHelper::getOption('update_interval') . '" />';
		$html .= '<p class="description">' . __('The time (in minutes) that SocialBox waits before refreshing it\'s data. (Default: 180 = 3 hours)', 'socialbox') . '</p>';

		echo $html;

	}

	public function printDisableSslSettingsField($args){

	    $html = '<input type="checkbox" id="' . $args['label_for'] . '" name="socialbox_options[disable_ssl]" value="1" ' . checked(1, JD_SocialBoxHelper::getOption('disable_ssl'), false) . '/>';    
	    $html .= ' <label for="' . $args['label_for'] . '">' . __('Disable SSL-Verification on API requests.', 'socialbox') . '</label>';
	    $html .= '<p class="description">' . __('This can be useful on most "local servers" like MAMP or XAMPP.', 'socialbox') . '</p>';
	  
	    echo $html;

	}

	public function printDebuggingSettingsSection(){

		echo '<p>' . __('Debugging should help you when SocialBox doesn\'t work as expected.', 'socialbox') . '</p>';

	}

	public function printEnableLogSettingsField($args){

	    $html = '<input type="checkbox" id="' . $args['label_for'] . '" name="socialbox_options[enable_log]" value="1" ' . checked(1, JD_SocialBoxHelper::getOption('enable_log'), false) . '/>';    
	    $html .= ' <label for="' . $args['label_for'] . '">' . __('Enable the API log', 'socialbox') . '</label>';
	    $html .= '<p class="description">' . __('This should help you, if you\'re receiving no data for your networks', 'socialbox') . '</p>';
	  
	    echo $html;

	}

	public function printLogEntriesSettingsField($args){

		$html = '<input type="text" id="' . $args['label_for'] . '" name="socialbox_options[log_entries]" value="' . JD_SocialBoxHelper::getOption('log_entries') . '" />';
		$html .= '<p class="description">' . __('Number of log entries to keep', 'socialbox') . '</p>';

		echo $html;

	}

	/**
	 * Register & enqueue styles for the options page
	 *
	 * Will be run in "admin_print_styles-settings_page_socialbox" action
	 */
	public function registerOptionsPageStyle(){
		
		wp_register_style('socialbox-options', JD_SOCIALBOX_URL . '/assets/css/options-page.css', array(), JD_SOCIALBOX_VERSION, 'screen');
		wp_enqueue_style('socialbox-options');

	}

	/**
	 * Render the options page
	 *
	 * This will make sure, that at least the default tab is active
	 */
	public function renderOptionsPage(){
		
		$tab = (isset($_GET['tab']) and !empty($_GET['tab'])) ? $_GET['tab'] : 'settings';
		include JD_SOCIALBOX_PATH . '/views/options-page/frame.php';

	}
	
	/**
	 * Refresh the cache
	 *
	 * This will be executed as scheduled cron event or when updating a widgets settings
	 */
	public static function updateCache($forced = false) {
		
		/* Abort if no widget has been set up */
		$cache = get_option('socialbox_cache', null);
		if( !is_array($cache) ){
			return;
		}

		/* Get refresh interval */
		$updateInterval = JD_SocialBoxHelper::getOption('update_interval');
		
		/* Call update function for each cache element that needs to be updated */
		foreach($cache as $item){

			/* Calculate cache element age (in minutes) */
			$elemAge = (time() - $item['lastUpdated']) / 60;

			/* Calculate max cache item age */
			$maxElemAge = $updateInterval - mt_rand(0, round($updateInterval / 5));

			if($forced or ($elemAge >= $maxElemAge)) {

				//self::updateCacheElement($item);
				self::updateCacheItem($item);
			}

		}
		
	}

	public static function updateCacheItem($item){

		/* Fetch new value from connector */
		$result = JD_SocialBoxConnector::get($item);

		/* Set new value if fetch was successful */
		if($result['successful']) {
			$newValue = $result['value'];

		/* Indicate that fetch was unseccessful */
		} else {
			$newValue = null;

			/* TODO */
			//$errorCode = isset($result['errorCode'])? $result['errorCode'] : '---';
			//SocialBox::addLogEntry($elem['network'], $elem['id'], $errorCode, $result['errorMessage']);
		}

		/* Update cache item */
		$item['value']       = ((!is_null($newValue)) ? $newValue : (int)$item['default']);
		$item['lastUpdated'] = time();
		
		/* Save updated cache item */
		$cache = get_option('socialbox_cache', array());
		$cache[$item['network'] . '||' . $item['id']] = $item;
		update_option('socialbox_cache', $cache);
	}

	/**
	 * Add an entry to the API Log
	 *
	 * @param String $network The slug of the related network
	 * @param String $id The username/id for the related network
	 * @param String $status A status flag
	 * @param String $msg The actual error message
	 */
	public static function addLogEntry($network, $id, $status, $msg){
		
		/* Proceed when the log is enabled only */
		if( JD_SocialBoxHelper::getOption('enable_log') === '1' ){

			/* Get existing log entries */
			$log = get_option('socialbox_log', array());

			/* Check size of log */
			if( count($log) >= JD_SocialBoxHelper::getOption('log_entries') ){
				
				array_shift($log);

			}

			$log[] = array(
				'timestamp' => time(),
				'network'   => $network,
				'id'        => $id,
				'status'    => $status,
				'message'   => $msg
			);

			update_option('socialbox_log', $log);

		}			

	}

	/**
	 * Get an array with all entries from the API log
	 *
	 * @return Array
	 */
	public static function getLog(){
		
		/* If log is enabled, return its content */
		if( JD_SocialBoxHelper::getOption('enable_log') === '1' ){

			return get_option('socialbox_log', array());

		}

		return false;			

	}

	/**
	 * Get absolute URL for $path
	 *
	 * @param String $path
	 * @return String
	 */
	private function getUrl($path){
		
		return JD_SOCIALBOX_URL . '/' . $path;
		
	}
	
	/**
	 * Echo absolute URL for $path
	 *
	 * @param String $path
	 */
	private function url($path){
		
		echo $this->getUrl($path);
		
	}
	
}