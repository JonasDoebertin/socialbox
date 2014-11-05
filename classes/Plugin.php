<?php
namespace jdpowered\SocialBox;

use jdpowered\SocialBox\Connectors\Factory as ConnectorFactory;
use jdpowered\SocialBox\Helpers\Helper;
use jdpowered\SocialBox\Helpers\Updater;
use jdpowered\SocialBox\Helpers\Upgrader;
use jdpowered\SocialBox\Logging\Factory as LogFactory;

class Plugin{

	/**
	 * Complete list of supported networks
	 */
	const SUPPORTED_NETWORKS = 'facebook,twitter,googleplus,youtube,vimeo,instagram,pinterest,soundcloud,dribbble,forrst,github,mailchimp';

	/**
	 * Holds the slug of the settings page, once it has been registered
	 */
	protected $settingsPageSlug;

	/**
	 * Instance of the logging class
	 *
	 * @type jdpowered\SocialBox\Logging\LogInterface
	 */
	protected $log;

	/**
	* Instance of the updater class
	*
	* @type jdpowered\SocialBox\Helpers\Updater
	*/
	protected $updater;

	/**
	 * Create an instance of the plugin
	 */
	public function __construct(){

		global $pagenow;

		/*
			Create log instance
		 */
		$this->log = LogFactory::make();

		/* Inject custom cron schedule */
		add_filter('cron_schedules', array($this, 'addCronSchedule'));

		/* Register custom actions */
		add_action('socialbox_update_cache', array($this, 'updateCache'));
		// add_action('socialbox_update_plugin', array($this, 'updatePlugin'));

		/* Register Widget */
		add_action('widgets_init', array($this, 'registerWidget'));

		/* Register and load textdomain */
		load_plugin_textdomain('socialbox', null, dirname(JD_SOCIALBOX_BASENAME) . '/languages/');

		/*
			Initialize Updater
		 */
		$this->updater = new Updater('http://wp-updates.com/api/2/plugin', JD_SOCIALBOX_BASENAME, HELPER::getOption('purchase_code'));

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
			//add_action('admin_print_styles-settings_page_socialbox', array($this, 'registerOptionsPageStyle'));
			add_action('admin_enqueue_scripts', array($this, 'registerOptionsPageScripts'));

			/* Register custum actions for options page */
			add_action('wp_ajax_socialbox_show_cache', array($this, 'ajaxShowCache'));
			add_action('wp_ajax_socialbox_clear_cache', array($this, 'ajaxClearCache'));
			add_action('wp_ajax_socialbox_refresh_cache', array($this, 'ajaxRefreshCache'));

		/* Fronted only stuff */
		} else if(is_active_widget(false, false, 'socialbox', true)){

			/* Register SocialBox widget styles */
			add_action('wp_enqueue_scripts', array($this, 'registerStyle'));
		}
	}





    /**************************************************************************\
    *                             PLUGIN INTERNALS                             *
    \**************************************************************************/

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
			'display'  => __('Every Ten Minutes', 'socialbox')
		);
		return $schedules;
	}

	/**
	 * Register options and cron schedules
	 *
	 * Will be run through register_activation_hook()
	 */
	public static function activatePlugin()
	{
		/* Prepare for updated version */
		$upgrader = new Upgrader();
		$upgrader->run();

		/* Add options */
		add_option('socialbox_options', array());
		add_option('socialbox_cache', array());
		add_option('socialbox_log', array());

		/* Register cron events */
		wp_schedule_event(time(), 'everytenminutes', 'socialbox_update_cache');
	}

	/**
	 * Deregister options and cron schedules
	 *
	 * Will be run through register_deactivation_hook
	 */
	public static function deactivatePlugin()
	{
		/* Deregister cron events */
		wp_clear_scheduled_hook('socialbox_update_cache');
	}

	public function addPluginActionLink($actionLinks){

		$html = '<a href="options-general.php?page=socialbox&tab=settings" title="' . __('SocialBox Settings', 'socialbox') . '">' . __('Settings', 'socialbox') . '</a>';

		array_unshift($actionLinks, $html);
		return $actionLinks;
	}





    /**************************************************************************\
    *                                  WIDGET                                  *
    \**************************************************************************/

    /**
     * Register the Widget
     *
     * Will be run within "widgets_init" action
     */
    public function registerWidget()
	{
        register_widget('jdpowered\SocialBox\Widgets\Widget');
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





	/**************************************************************************\
	*                                  ADDONS                                  *
	\**************************************************************************/

	public function detectAddons()
	{
		return array(
			'flat-styles'   => (defined('JD_SOCIALBOXADDON_FLATSTYLES_VERSION')) ? JD_SOCIALBOXADDON_FLATSTYLES_VERSION : false,
			'bubble-styles' => (defined('JD_SOCIALBOXADDON_BUBBLESTYLES_VERSION')) ? JD_SOCIALBOXADDON_BUBBLESTYLES_VERSION : false,
			'custom-styles' => (defined('JD_SOCIALBOXADDON_CUSTOMSTYLES_VERSION')) ? JD_SOCIALBOXADDON_CUSTOMSTYLES_VERSION : false,
		);
	}





    /**************************************************************************\
    *                                  THEMES                                  *
    \**************************************************************************/

    public function getThemes($mode = 'grouped') {

        if($mode === 'grouped') {
            return array(
                'core'   => self::getCoreThemes(),
                'plain'  => self::getPlainThemes(),
                'addon' => self::getAddonThemes(),
            );
        }

        return array_merge($this->getCoreThemes(), $this->getPlainThemes(), $this->getAddonThemes());
    }

    protected function getCoreThemes() {

        return array(
            'classic' => array(
                'slug'         => 'classic',
                'name'         => __('Classic (default)', 'socialbox'),
                'iconSize'     => 16,
                'allowButtons' => true,
                'template'     => JD_SOCIALBOX_PATH . '/views/widget/widget.php',
            ),
            'modern' => array(
                'slug'         => 'modern',
                'name'         => __('Modern', 'socialbox'),
                'iconSize'     => 32,
                'allowButtons' => false,
                'template'     => JD_SOCIALBOX_PATH . '/views/widget/widget.php',
            ),
            'tutsflavor' => array(
                'slug'         => 'tutsflavor',
                'name'         => __('Tuts+ Flavor', 'socialbox'),
                'iconSize'     => 32,
                'allowButtons' => true,
                'template'     => JD_SOCIALBOX_PATH . '/views/widget/widget.php',
            ),
            'dark' => array(
                'slug'         => 'dark',
                'name'         => __('Dark', 'socialbox'),
                'iconSize'     => 16,
                'allowButtons' => true,
                'template'     => JD_SOCIALBOX_PATH . '/views/widget/widget.php',
            ),
            'colorful' => array(
                'slug'         => 'colorful',
                'name'         => __('Colorful', 'socialbox'),
                'iconSize'     => 32,
                'allowButtons' => true,
                'template'     => JD_SOCIALBOX_PATH . '/views/widget/widget.php',
            ),
        );
    }

    protected function getPlainThemes() {

        return array(
            'plainsmall' => array(
                'slug'         => 'plainsmall',
                'name'         => __('Plain (small icons)', 'socialbox'),
                'iconSize'     => 16,
                'allowButtons' => true,
                'template'     => JD_SOCIALBOX_PATH . '/views/widget/widget.php',
            ),
            'plainlarge' => array(
                'slug'         => 'plainlarge',
                'name'         => __('Plain (large icons)', 'socialbox'),
                'iconSize'     => 32,
                'allowButtons' => true,
                'template'     => JD_SOCIALBOX_PATH . '/views/widget/widget.php',
            ),
        );
    }

    protected function getAddonThemes() {

        $themes = array();
        return apply_filters('socialbox_addon_themes', $themes);
    }

    public function getThemeBySlug($slug) {

        /* Walk through all theme categories */
        foreach($this->getThemes() as $themes) {

            /* Walk through each theme */
            foreach($themes as $key => $theme) {

                /* Return theme info if array key and slug match */
                if($key == $slug)
                    return $theme;
            }
        }

        return false;
    }

    public function getThemeTexts($slug) {

        /* Get theme by slug */
        $theme = $this->getThemeBySlug($slug);

        /* Return texts if available */
        if(isset($theme['texts']) and is_array($theme['texts']))
            return $theme['texts'];

        /* Return fallback */
        return array();
    }





    /**************************************************************************\
    *                                 SETTINGS                                 *
    \**************************************************************************/

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

		/*
			Register "License" section and fields
		 */
		add_settings_section(
			'socialbox_license',
			__('License', 'socialbox'),
			null,
			'socialbox'
		);

		add_settings_field(
			'purchase_code',
			__('Purchase Code', 'socialbox'),
			array($this, 'printPurchaseCodeSettingsField'),
			'socialbox',
			'socialbox_license',
			array('label_for' => 'socialbox_purchase_code')
		);

		/* Register settings section for "Advanced Settings" */
		add_settings_section(
			'socialbox_advanced',
			__('Advanced Settings', 'socialbox'),
			null,
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
	}

	/**
	 * Output the "Purchase Code" settings field
	 *
	 * @since 1.8.0
	 *
	 * @param array $args
	 */
	public function printPurchaseCodeSettingsField($args)
	{
		$html = '<input type="text" id="' . $args['label_for'] . '" name="socialbox_options[purchase_code]" value="' . Helper::getOption('purchase_code') . '" />';
		$html .= '<p class="description">' . __('Please enter your CodeCanyon purchase code.', 'socialbox') . '</p>';
		echo $html;
	}

	public function printUpdateIntervalSettingsField($args){

		$html = '<input type="text" id="' . $args['label_for'] . '" name="socialbox_options[update_interval]" value="' . Helper::getOption('update_interval') . '" />';
		$html .= '<p class="description">' . __('The time (in minutes) that SocialBox waits before refreshing it\'s data. (Default: 180 = 3 hours)', 'socialbox') . '</p>';

		echo $html;
	}

	public function printDisableSslSettingsField($args){

	    $html = '<input type="checkbox" id="' . $args['label_for'] . '" name="socialbox_options[disable_ssl]" value="1" ' . checked(1, Helper::getOption('disable_ssl'), false) . '/>';
	    $html .= ' <label for="' . $args['label_for'] . '">' . __('Disable SSL-Verification on API requests.', 'socialbox') . '</label>';
	    $html .= '<p class="description">' . __('This can be useful on most "local servers" like MAMP or XAMPP.', 'socialbox') . '</p>';

	    echo $html;
	}





    /**************************************************************************\
    *                               OPTIONS PAGE                               *
    \**************************************************************************/

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
	 * Register & enqueue styles for the options page
	 *
	 * Will be run in "admin_print_styles-settings_page_socialbox" action
	 */
	public function registerOptionsPageStyle(){

		// wp_register_style('socialbox-options', JD_SOCIALBOX_URL . '/assets/css/options-page.css', array(), JD_SOCIALBOX_VERSION, 'screen');
		// wp_enqueue_style('socialbox-options');
	}

	/**
	 * Register & enqueue scripts for the options page
	 *
	 * Will be run in "admin_enqueue_scripts-settings_page_socialbox" action
	 */
	public function registerOptionsPageScripts($hook)
	{

		/* Only on our own options page */
		if($hook == 'settings_page_socialbox') {

			/* Register vendor scripts & styles */
			wp_register_script('tooltipster', JD_SOCIALBOX_URL . '/assets/vendor/tooltipster/js/jquery.tooltipster.min.js', array('jquery'), '3.2.6', true);
			wp_register_style('tooltipster', JD_SOCIALBOX_URL . '/assets/vendor/tooltipster/css/tooltipster.css', array(), '3.2.6', 'all');

			/* Register the scripts & styles */
			wp_register_script('socialbox-options', JD_SOCIALBOX_URL . '/assets/js/options-page.js', array('jquery', 'tooltipster'), JD_SOCIALBOX_VERSION, true);
			wp_register_style('socialbox-options', JD_SOCIALBOX_URL . '/assets/css/options-page.css', array('tooltipster'), JD_SOCIALBOX_VERSION, 'all');

			/* Add data object */
			wp_localize_script('socialbox-options', 'Socialbox', array(
					'action' => array(
							'show'    => 'socialbox_show_cache',
							'clear'   => 'socialbox_clear_cache',
							'refresh' => 'socialbox_refresh_cache',
						),
					'nonce'  => array(
							'show'    => wp_create_nonce('socialbox_show_cache'),
							'clear'   => wp_create_nonce('socialbox_clear_cache'),
							'refresh' => wp_create_nonce('socialbox_refresh_cache'),
						),
				));

			/* Enqueue scripts & styles */
			wp_enqueue_script('socialbox-options');
			wp_enqueue_style('socialbox-options');
		}
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





    /**************************************************************************\
    *                                   AJAX                                   *
    \**************************************************************************/

	/**
	 * Return formatted cache content
	 *
	 * Will be run through an AJAX call in "wp_ajax_socialbox_show_cache" action
	 */
	public function ajaxShowCache() {

		/* Security check */
		if(!wp_verify_nonce($_POST['nonce'], $_POST['action'])) {
			die(__('Security check failed!', 'socialbox'));
		}

		/* Return formatted cache content */
		die(print_r($this->getCache(), true));
	}

	/**
	 * Clear cache content
	 *
	 * Will be run through an AJAX call in "wp_ajax_socialbox_clear_cache" action
	 */
	public function ajaxClearCache() {

		/* Security check */
		if(!wp_verify_nonce($_POST['nonce'], $_POST['action'])) {
			die(__('Security check failed!', 'socialbox'));
		}

		/* Clear cache */
		$this->clearCache();

		/* Return message */
		die(__('Cache cleared!', 'socialbox'));
	}

	/**
	 * Refresh cache content
	 *
	 * Will be run through an AJAX call in "wp_ajax_socialbox_refresh_cache" action
	 */
	public function ajaxRefreshCache() {

		/* Security check */
		if(!wp_verify_nonce($_POST['nonce'], $_POST['action'])) {
			die(__('Security check failed!', 'socialbox'));
		}

        /* Rebuild cache structure */
        self::rebuildCache();

		/* Force cache refresh */
		$this->updateCache(true);

		/* Return message */
		die(__('Cache refreshed!', 'socialbox'));
	}





    /**************************************************************************\
    *                                  CACHE                                   *
    \**************************************************************************/

	/**
	 * Refresh the cache
	 *
	 * This will be executed as scheduled cron event or when updating a widgets settings
	 *
	 * @param boolean $forced Force a complete refresh
	 */
	public function updateCache($forced = false)
	{
		/* Rebuild cache structure */
        if(!$forced) {
            $this->rebuildCache();
        }

        /* Abort if no widget has been set up */
		$cache = get_option('socialbox_cache', null);
		if( !is_array($cache) ){
			return;
		}

		/* Get refresh interval */
		$updateInterval = Helper::getOption('update_interval');

		/* Call update function for each cache element that needs to be updated */
		foreach($cache as $item) {

			/* Calculate cache element age (in minutes) */
			$elemAge = (time() - $item['lastUpdated']) / 60;

			/* Calculate max cache item age */
			$maxElemAge = $updateInterval - mt_rand(0, round($updateInterval / 5));

			if($forced or ($elemAge >= $maxElemAge)) {

				//self::updateCacheElement($item);
				$this->updateCacheItem($item);
			}
		}
	}

	/**
	 * Update a single cache item
	 * @param  array $item
	 */
	public function updateCacheItem($item) {

		/*
			Try to fetch the new value from connector, store and log the result
		 */
		try {

			/*
				Create connector object and fire it
			 */
			$connector = ConnectorFactory::create($item);
			$result = $connector->fire();

			/*
				Set new value and log success message
			 */
			$value = $result;
			$this->logApiSuccess($item);


		} catch (\Exception $e) {

			/*
				Set 0 as value and log error message with the exception
			 */
			$value = 0;
			$this->logApiFailure($item, $e);

		}

		/* TODO: Clear log on upgrade */

		/* Update cache item */
		$item['value']       = $value;
		$item['lastUpdated'] = time();

		/* Save updated cache item */
		$cache = get_option('socialbox_cache', array());
		$cache[$item['network'] . '||' . $item['id']] = $item;
		update_option('socialbox_cache', $cache);
	}

    /**
     * Removes all unused items from the cache
     *
     * Will be called right before updating the cache
     */
    public static function rebuildCache() {

        /* Get all SocialBox widget instances */
        $widgets = get_option('widget_socialbox', array());
        if(!is_array($widgets))
            $widgets = array();

        /* Make a list of all used networks */
        $items = array();
        foreach($widgets as $widget) {

            /* Skip configuration values */
            if(!is_array($widget) or !array_key_exists('new_window', $widget)) {
                continue;
            }

            foreach(Helper::getSupportedNetworks() as $network) {
                if(!empty($widget[$network . '_id'])) {
                    $items[] = $network . '||' . $widget[$network . '_id'];
                }
            }
        }

        /* Remove all cache items that are not on the list */
        $cache = get_option('socialbox_cache', array());
        foreach($cache as $key => $value) {
            if(!in_array($key, $items)) {
                unset($cache[$key]);
            }
        }
        update_option('socialbox_cache', $cache);
    }

	/**
	 * Return raw cache contents
	 * @return array
	 */
	public function getCache() {

		return get_option('socialbox_cache', array());
	}

	/**
	 * Clear cache
	 */
	public function clearCache() {

		update_option('socialbox_cache', array());
	}





    /**************************************************************************\
    *                                   LOG                                    *
    \**************************************************************************/

	public function logApiSuccess($item)
	{
		/*
			Prepopulate context with item
		*/
		$context = array(
			'item' => $item
		);

		$message = __('Fetched new data from {item.network} for {item.id}', 'socialbox');
		$this->log->success($message, $context);
	}

	public function logApiFailure($item, $exception = null)
	{
		/*
			Prepopulate context with item
		 */
		$context = array(
			'item' => $item
		);

		if( ! is_null($exception)) {
			$context['exception'] = array(
				'type' => get_class($exception),
				'message' => $exception->getMessage(),
			);
		}

		$message = __('Could not fetched new data from {item.network} for {item.id}', 'socialbox');
		$this->log->error($message, $context);
	}

	/**
	 * Get all entries from log
	 *
	 * @return array
	 */
	public function getLog()
	{
		return $this->log->get(20);
	}
}
