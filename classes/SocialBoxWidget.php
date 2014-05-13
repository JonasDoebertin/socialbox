<?php if(!defined('ABSPATH')) die('Direct access is not allowed.');


/*
 * SocialBox 1.6.2
 * Copyright by Jonas Döbertin
 * Available only at CodeCanyon: http://codecanyon.net/item/socialbox-social-wordpress-widget/627127
 */


class JD_SocialBoxWidget extends WP_Widget{

	/**
	 * Create a widget instance and set the base infos
	 */
	public function __construct() {

		/* Widget settings */
		$widgetOpts = array(
			'classname' => 'socialbox',
			'description' => __('Adds a super easy SocialBox widget which displays various statistics from Facebook, Twitter, Youtube, Vimeo, Instagram, Pinterest, GitHub and MailChimp.', 'socialbox')
		);

		/* Widget control settings */
		$controlOpts = array(
			'id_base' => 'socialbox'
		);

		/* Create the widget */
		parent::__construct('socialbox', 'SocialBox', $widgetOpts, $controlOpts);

	}

	/**
	 * Display the actual widget
	 *
	 * @param Array $args
	 * @param Array $instance
	 */
	public function widget($args, $instance) {

        /* Import plugin instance */
        global $JD_SocialBox;

		extract($args);

		/* Get cache */
		$cache = get_option('socialbox_cache', array());

		/* Build up network data array */
		$networks = array();
		foreach(JD_SocialBoxHelper::getSupportedNetworks() as $network) {

			if( array_key_exists($network . '_id', $instance) and !empty($instance[$network . '_id']) ) {

               /* Skip if cache item doesn't exist */
               if(!isset($cache[$network . '||' . $instance[$network . '_id']])) {
                   continue;
               }

               /* Get cache item */
               $cacheItem = $cache[$network . '||' . $instance[$network . '_id']];

               /* Build data object */
               $new = array(
                   'type'       => $network,
                   'id'         => $instance[$network . '_id'],
                   'position'   => $instance[$network . '_position'],
                   'count'      => ($cacheItem['value'] !== null) ? $cacheItem['value'] : $instance[$network . '_default'],
                   'link'       => $this->getNetworkLink($cacheItem),
                   'name'       => $this->getNetworkName($cacheItem),
                   'buttonText' => $this->getNetworkButtonText($cacheItem),
                   'buttonHint' => $this->getNetworkButtonHint($cacheItem),
                   'metric'     => $this->getNetworkMetric($cacheItem),
               );

               /* Add network to list */
               $networks[] = $new;
           }
		}
		usort($networks, array($this, 'sortByPosition'));

		/* Get additional options */
		$theme             = $JD_SocialBox->getThemeBySlug($instance['style']);
        $texts             = $this->getTexts($instance, $theme);
		$newWindow         = $instance['new_window'];
		$showButtons       = $instance['show_buttons'];
		$compactNumbers    = $instance['compact_numbers'];
		$forcedWidgetWidth = ($instance['forced_widget_width'] > 0) ? $instance['forced_widget_width'] : false;
		$forcedButtonWidth = ($instance['forced_button_width'] > 0) ? $instance['forced_button_width'] : false;

		/* Before Widget HTML */
		echo $before_widget;

		/* Social Box */
		include $theme['template'];

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
	public function update($newInstance, $oldInstance) {

        /* Import plugin instance */
        global $JD_SocialBox;

		/* Update general widget options */
		$instance = $oldInstance;
		$instance['new_window']          = $newInstance['new_window'];
		$instance['show_buttons']        = $newInstance['show_buttons'];
		$instance['style']               = $newInstance['style'];
		$instance['compact_numbers']     = $newInstance['compact_numbers'];
		$instance['forced_widget_width'] = ((is_numeric($newInstance['forced_widget_width'])) ? trim($newInstance['forced_widget_width']) : 0);
		$instance['forced_button_width'] = ((is_numeric($newInstance['forced_button_width'])) ? trim($newInstance['forced_button_width']) : 0);

		/* Update values for common options for each network */
		foreach(JD_SocialBoxHelper::getSupportedNetworks() as $network) {
			$instance[$network . '_id']       = trim(strip_tags($newInstance[$network . '_id']));
			$instance[$network . '_default']  = ((is_numeric($newInstance[$network . '_default'])) ? trim($newInstance[$network . '_default']) : 0);
			$instance[$network . '_position'] = ((is_numeric($newInstance[$network . '_position'])) ? trim($newInstance[$network . '_position']) : 1);
		}

		/* Update values for uncommon/special options */
		$instance['facebook_metric']             = $newInstance['facebook_metric'];
		$instance['twitter_api_key']             = $newInstance['twitter_api_key'];
		$instance['twitter_api_secret']          = $newInstance['twitter_api_secret'];
		$instance['twitter_access_token']        = $newInstance['twitter_access_token'];
		$instance['twitter_access_token_secret'] = $newInstance['twitter_access_token_secret'];
        $instance['vimeo_metric']                = $newInstance['vimeo_metric'];
		$instance['instagram_user_id']           = $newInstance['instagram_user_id'];
		$instance['instagram_client_id']         = $newInstance['instagram_client_id'];
		$instance['instagram_metric']            = $newInstance['instagram_metric'];
        $instance['pinterest_metric']            = $newInstance['pinterest_metric'];
        $instance['dribbble_metric']             = $newInstance['dribbble_metric'];
        $instance['mailchimp_api_key']           = $newInstance['mailchimp_api_key'];
        $instance['mailchimp_form_url']          = $newInstance['mailchimp_form_url'];

        /* Update values for theme specific options */
        foreach($JD_SocialBox->getThemes('ungrouped') as $theme) {
            foreach($JD_SocialBox->getThemeTexts($theme['slug']) as $text) {

                /* Update value only if it is set */
                if(isset($newInstance[$instance['style'] . '_' . $text['slug']])) {

                    $instance[$instance['style'] . '_' . $text['slug']] = $newInstance[$instance['style'] . '_' . $text['slug']];
                }
            }
        }

		/* Update cache elements */
		$cache = get_option('socialbox_cache', array());
		foreach(JD_SocialBoxHelper::getSupportedNetworks() as $network) {

			/* Only if the ID is not blank */
			if(!empty($instance[$network . '_id'])) {

				/* Create cache element if it doesn't exists */
				if(!array_key_exists($network . '||' . $instance[$network . '_id'], $cache)) {

					/* Add common attributes */
					$cache[$network . '||' . $instance[$network . '_id']] = array(
						'network'     => $network,
						'id'          => $instance[$network . '_id'],
						'lastUpdated' => 0,
						'value'       => null
					);

                /* Update cache element if it exists */
                } else {

                    /* Update common attributes */
                    $cache[$network . '||' . $instance[$network . '_id']]['lastUpdated'] = 0;
                }

                /* Save/update uncommon/special attributes */
                switch($network) {
                    case 'facebook':
                        $cache['facebook||' . $instance['facebook_id']]['metric']            = $instance['facebook_metric'];
                        break;
                    case 'twitter':
                        $cache['twitter||' . $instance['twitter_id']]['api_key']             = $instance['twitter_api_key'];
                        $cache['twitter||' . $instance['twitter_id']]['api_secret']          = $instance['twitter_api_secret'];
                        $cache['twitter||' . $instance['twitter_id']]['access_token']        = $instance['twitter_access_token'];
                        $cache['twitter||' . $instance['twitter_id']]['access_token_secret'] = $instance['twitter_access_token_secret'];
                        break;
                    case 'vimeo':
                        $cache['vimeo||' . $instance['vimeo_id']]['metric']                  = $instance['vimeo_metric'];
                        break;
                    case 'instagram':
                        $cache['instagram||' . $instance['instagram_id']]['metric']          = $instance['instagram_metric'];
                        $cache['instagram||' . $instance['instagram_id']]['client_id']       = $instance['instagram_client_id'];
                        $cache['instagram||' . $instance['instagram_id']]['user_id']         = $instance['instagram_user_id'];
                        break;
                    case 'pinterest':
                        $cache['pinterest||' . $instance['pinterest_id']]['metric']          = $instance['pinterest_metric'];
                        break;
                    case 'dribbble':
                        $cache['dribbble||' . $instance['dribbble_id']]['metric']            = $instance['dribbble_metric'];
                        break;
                    case 'mailchimp':
                        $cache['mailchimp||' . $instance['mailchimp_id']]['api_key']         = $instance['mailchimp_api_key'];
                        $cache['mailchimp||' . $instance['mailchimp_id']]['form_url']        = $instance['mailchimp_form_url'];
                        break;
                }
			}
		}
		update_option('socialbox_cache', $cache);

		/* Force cache refresh */
		JD_SocialBox::updateCache(true);

		return $instance;
	}

	/**
	 * Show the Widgets settings form
	 *
	 * @param Array $instance
	 */
	public function form($instance) {

        /* Import plugin instance */
        global $JD_SocialBox;

        /* Get available themes */
        $themes = $JD_SocialBox->getThemes();

		/* Apply general default values */
		$defaults = array(
			'new_window'          => true,
			'show_buttons'        => true,
			'style'               => 'classic',
			'compact_numbers'     => false,
			'forced_widget_width' => 0,
			'forced_button_width' => 0
		);

		/* Set default values for common options of each network */
		$pos = 1;
		foreach(JD_SocialBoxHelper::getSupportedNetworks() as $network) {
			$defaults[$network . '_id']       = '';
			$defaults[$network . '_default']  = 0;
			$defaults[$network . '_position'] = $pos++;
		}

		/* Set default values for uncommon/special options */
		$defaults['facebook_metric']             = 'likes';
		$defaults['twitter_api_key']             = '';
		$defaults['twitter_api_secret']          = '';
		$defaults['twitter_access_token']        = '';
		$defaults['twitter_access_token_secret'] = '';
        $defaults['vimeo_metric']                = 'total_subscribers';
		$defaults['instagram_metric']            = 'followed_by';
		$defaults['instagram_client_id']         = '';
		$defaults['instagram_user_id']           = '';
        $defaults['instagram_user_id']           = '';
        $defaults['pinterest_metric']            = 'followers';
        $defaults['dribbble_metric']             = 'followers_count';
        $defaults['mailchimp_api_key']           = '';
        $defaults['mailchimp_form_url']          = '';

        /* Set default values for theme specific options */
        foreach($JD_SocialBox->getThemes('ungrouped') as $theme) {
            foreach($JD_SocialBox->getThemeTexts($theme['slug']) as $text) {
                $defaults[$theme['slug'] . '_' . $text['slug']] = $text['default'];
            }
        }

		/* Merge defaults and actual option values */
		$instance = wp_parse_args((array) $instance, $defaults);

        /* Get theme info and options */
        $activeTheme  = $JD_SocialBox->getThemeBySlug($instance['style']);
        $activeThemeTexts  = $JD_SocialBox->getThemeTexts($instance['style']);

		/* Include corresponding view */
		include JD_SOCIALBOX_PATH . '/views/widget/form.php';
	}

	private function sortByPosition($a, $b) {

		return $a['position'] - $b['position'];

	}

    private function getTexts($instance, $theme) {

        /* Import global plugin instance */
        global $JD_SocialBox;

        /* Get all available text for the current theme */
        $availableTexts = $JD_SocialBox->getThemeTexts($instance['style']);

        /* Loop through texts and get value or default value */
        $texts = array();
        foreach($availableTexts as $text) {

            /* Check if text is set in widget instance */
            if(isset($instance[$instance['style'] . '_' . $text['slug']])) {

                /* Set text value to value from widget instance */
                $texts[$text['slug']] = $instance[$instance['style'] . '_' . $text['slug']];
            } else {

                /* Set text value to default value */
                $texts[$text['slug']] = $text['default'];
            }
        }

        return $texts;
    }

	/**
	 * Helper - Returns a link to the network specific user account
	 *
	 * @param String $network
	 * @param String $id
	 * @return String
	 */
	private function getNetworkLink($item) {

		switch($item['network']) {

			case 'facebook':
				return "http://www.facebook.com/" . ((is_numeric($item['id'])) ? "profile.php?id=" . $item['id'] : $item['id']);
			case 'twitter':
				return "http://twitter.com/{$item['id']}";
			case 'youtube':
				return "http://www.youtube.com/user/{$item['id']}";
			case 'vimeo':
				return "http://vimeo.com/channels/{$item['id']}";
			case 'instagram':
				return "http://instagram.com/{$item['id']}";
            case 'pinterest':
                return "http://pinterest.com/{$item['id']}";
			case 'dribbble':
				return "http://dribbble.com/{$item['id']}";
			case 'forrst':
				return "http://forrst.com/people/{$item['id']}";
			case 'github':
				return "https://github.com/{$item['id']}";
            case 'mailchimp':
                return $item['form_url'];
		}

	}

	private function getNetworkName($item) {

		switch($item['network']) {
			case 'facebook':
				return __('Facebook', 'socialbox');
			case 'twitter':
				return __('Twitter', 'socialbox');
			case 'youtube':
				return __('YouTube', 'socialbox');
			case 'vimeo':
				return __('Vimeo', 'socialbox');
			case 'instagram':
				return __('Instagram', 'socialbox');
            case 'pinterest':
                return __('Pinterest', 'socialbox');
			case 'dribbble':
				return __('Dribbble', 'socialbox');
			case 'forrst':
				return __('Forrst', 'socialbox');
			case 'github':
				return __('GitHub', 'socialbox');
            case 'mailchimp':
                return __('Newsletter', 'socialbox');
		}
	}

	private function getNetworkMetric($item) {

		switch($item['network']) {
			case 'twitter':
				return __('Followers', 'socialbox');
			case 'youtube':
				return __('Subscribers', 'socialbox');
			case 'forrst':
				return __('Followers', 'socialbox');
			case 'github':
				return __('Followers', 'socialbox');
            case 'mailchimp':
                return __('Subscribers', 'socialbox');
            case 'facebook':
                switch($item['metric']) {
                    case 'likes':
                        return __('Likes', 'socialbox');
                    case 'checkins':
                        return __('Checkins', 'socialbox');
                    case 'were_here_count':
                        return __('Were Here', 'socialbox');
                    case 'talking_about_count':
                        return __('Talking About', 'socialbox');
                }
                break;
            case 'instagram':
                switch($item['metric']) {
                    case 'media':
                        return __('Posts', 'socialbox');
                    case 'followed_by':
                        return __('Followers', 'socialbox');
                    case 'follows':
                        return __('Following', 'socialbox');
                }
                break;
            case 'vimeo':
                switch($item['metric']) {
                    case 'total_subscribers':
                        return __('Subscribers', 'socialbox');
                    case 'total_videos':
                        return __('Videos', 'socialbox');
                }
                break;
            case 'dribbble':
                switch($item['metric']) {
                    case 'followers_count':
                        return __('Followers', 'socialbox');
                    case 'likes_received_count':
                        return __('Likes', 'socialbox');
                    case 'comments_received_count':
                        return __('Comments', 'socialbox');
                    case 'rebounds_received_count':
                        return __('Rebounds', 'socialbox');
                    case 'shots_count':
                        return __('Shots', 'socialbox');
                }
                break;
            case 'pinterest':
                switch($item['metric']) {
                    case 'followers':
                        return __('Followers', 'socialbox');
                    case 'pins':
                        return __('Pins', 'socialbox');
                    case 'boards':
                        return __('Boards', 'socialbox');
                }
                break;
		}
	}

	private function getNetworkButtonText($item) {

		switch($item['network']) {
			case 'facebook':
				return __('Like', 'socialbox');
			case 'twitter':
				return __('Follow', 'socialbox');
			case 'youtube':
				return __('Subscribe', 'socialbox');
			case 'vimeo':
				return __('Subscribe', 'socialbox');
			case 'instagram':
				return __('Follow', 'socialbox');
            case 'pinterest':
                return __('Follow', 'socialbox');
			case 'dribbble':
				return __('Follow', 'socialbox');
			case 'forrst':
				return __('Follow', 'socialbox');
			case 'github':
				return __('Follow', 'socialbox');
            case 'mailchimp':
                return __('Subscribe', 'socialbox');
		}
	}

	private function getNetworkButtonHint($item) {

		switch($item['network']) {
			case 'facebook':
				return __('Like on Facebook', 'socialbox');
			case 'twitter':
				return __('Follow on Twitter', 'socialbox');
			case 'youtube':
				return __('Subscribe to Youtube Channel', 'socialbox');
			case 'vimeo':
				return __('Subscribe to Vimeo Channel', 'socialbox');
			case 'instagram':
				return __('Follow on Instagram', 'socialbox');
            case 'pinterest':
                return __('Follow on Pinterest', 'socialbox');
			case 'dribbble':
				return __('Follow on Dribbble', 'socialbox');
			case 'forrst':
				return __('Follow on Forrst', 'socialbox');
			case 'github':
				return __('Follow on GitHub', 'socialbox');
            case 'mailchimp':
                return __('Subscribe to newsletter', 'socialbox');
		}
	}

	/**
	 * Returns whether a style allows buttons to be displayed
	 *
	 * @param String $style
	 * @return Bool
	 */
	private function getAllowButtons($style = 'classic') {

		switch($style) {
			case 'modern':
				return false;
			case 'classic':
			case 'tutsflavor':
			case 'dark':
			case 'colorful':
			case 'plainlarge':
			case 'plainsmall':
			default:
				return true;
		}
	}

	private function formatNumber($number, $useCompactNumbers) {

		if($useCompactNumbers) {
			return $this->getCompactNumber($number);
		} else {
			return number_format($number);
		}
	}

	/**
	 * Convert a number to a shorter (rounded) representation
	 *
	 * @param Int $number
	 * @return String
	 */
	private function getCompactNumber($number) {

		switch(true) {
			case $number < 1000:
				return $number;

			case $number < 10000:
				return floor($number / 100) / 10 . 'K';

			case $number < 1000000:
				return floor($number / 1000) . 'K';

			case $number < 100000000:
				return floor($number / 100000) / 10 . 'M';

			default:
				return floor($number / 1000000) . 'M';
		}
	}
}
