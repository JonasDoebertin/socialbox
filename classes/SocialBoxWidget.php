<?php if(!defined('ABSPATH')) die('Direct access is not allowed.');


/*
 * SocialBox 1.4.0
 * Copyright by Jonas Döbertin
 * Available only at CodeCanyon: http://codecanyon.net/item/socialbox-social-wordpress-widget/627127
 */


class JD_SocialBoxWidget extends WP_Widget{
		
	/**
	 * The widgets slug
	 */
	const SLUG = 'socialbox';
	
	/**
	 * Create a widget instance and set the base infos
	 */
	public function __construct(){
		
		/* Widget settings */
		$widgetOpts = array(
			'classname' => self::SLUG,
			'description' => __('Adds a super easy SocialBox Widget which displays the current numbers of Facebook Page Likes, Google+, Twitter, Dribbble and Forrst Followers and YouTube and Vimeo Channel Subscriptions.', self::SLUG)
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
	 * Display the actual widget
	 *
	 * @param Array $args
	 * @param Array $instance
	 */
	public function widget($args, $instance){
		
		extract($args);
		
		/* Get cache */
		$cache = get_option(self::SLUG . '_cache', array());
		
		/* Build up network data array */
		$networks = array();
		foreach(SocialBox::getSupportedNetworks() as $network){
			
			if( array_key_exists($network . '_id', $instance) and !empty($instance[$network . '_id']) ){
				
				$networks[] = array(
					'type' 				=> $network,
					'id' 				=> $instance[$network . '_id'],
					'position' 			=> $instance[$network . '_position'],
					'count' 			=> ( $cache[$network . '||' . $instance[$network . '_id']] !== null )? $cache[$network . '||' . $instance[$network . '_id']]['value'] : 0,
					'link' 				=> $this->getNetworkLink($network, $instance[$network . '_id']),
					'name' 				=> $this->getNetworkName($network),
					'metric' 			=> $this->getNetworkMetric($network),
					'buttonText' 		=> $this->getNetworkButtonText($network),
					'buttonHint' 		=> $this->getNetworkButtonHint($network)
				);

			}
			
		}
		usort($networks, array($this, 'sortByPosition'));
		
		/* Get additional options */
		$style             = $instance['style'];
		$newWindow         = $instance['new_window'];
		$showButtons       = $instance['show_buttons'];
		$compactNumbers    = $instance['compact_numbers'];
		$forcedWidgetWidth = ($instance['forced_widget_width'] > 0) ? $instance['forced_widget_width'] : false;
		$forcedButtonWidth = ($instance['forced_button_width'] > 0) ? $instance['forced_button_width'] : false;
		$allowButtons      = $this->getAllowButtons($style);
		$iconSize          = $this->getIconSize($style);
		
		/* Before Widget HTML */
		echo $before_widget;
			
		/* Social Box */
		include SOCIALBOX_PATH . '/views/widget.widget.php';
		
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
		
		/* Update general widget settings */
		$instance = $oldInstance;
		$instance['new_window']          = $newInstance['new_window'];
		$instance['show_buttons']        = $newInstance['show_buttons'];
		$instance['style']               = $newInstance['style'];
		$instance['compact_numbers']     = $newInstance['compact_numbers'];
		$instance['forced_widget_width'] = ((is_numeric($newInstance['forced_widget_width'])) ? trim($newInstance['forced_widget_width']) : 0);
		$instance['forced_button_width'] = ((is_numeric($newInstance['forced_button_width'])) ? trim($newInstance['forced_button_width']) : 0);
		
		$cache = get_option(self::SLUG . '_cache', array());

		foreach(SocialBox::getSupportedNetworks() as $network){

			/* Update network related widget settings */
			$instance[$network . '_id']         = trim(strip_tags($newInstance[$network . '_id']));
			$instance[$network . '_default']    = ((is_numeric($newInstance[$network . '_default'])) ? trim($newInstance[$network . '_default']) : 0);
			$instance[$network . '_position']   = ((is_numeric($newInstance[$network . '_position'])) ? trim($newInstance[$network . '_position']) : 1);

			/* Add cache elements for this network if it doesn't exist already */
			if( !empty($instance[$network . '_id']) ){

				if( !array_key_exists($network . '||' . $instance[$network . '_id'], $cache) ){

					$cache[$network . '||' . $instance[$network . '_id']] = array(
						'network' =>		$network,
						'id' =>				$instance[$network . '_id'],
						'lastUpdated' =>	0,
						'value' =>			null,
						'default' =>		$instance[$network . '_default']
					);

				} else{

					$cache[$network . '||' . $instance[$network . '_id']]['lastUpdated'] = null;

				}

			}

		}

		update_option(self::SLUG . '_cache', $cache);
		
		/* Force cache refresh */
		SocialBox::updateCache();
		
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
			'new_window'          => true,
			'show_buttons'        => true,
			'style'               => 'classic',
			'compact_numbers'     => false,
			'forced_widget_width' => 0,
			'forced_button_width' => 0
		);

		$pos = 1;

		foreach(SocialBox::getSupportedNetworks() as $network){

			$defaults[$network . '_id'] = '';
			$defaults[$network . '_default'] = 0;
			$defaults[$network . '_position'] = $pos++;

		}

		$instance = wp_parse_args((array) $instance, $defaults);
		
		/* Show Widget Options */
		include SOCIALBOX_PATH . '/views/widget.form.php';
		
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
			// case 'googleplus':
			// 	return "https://plus.google.com/{$id}";
			case 'youtube':
				return "http://www.youtube.com/user/{$id}";
			case 'vimeo':
				return "http://vimeo.com/channels/{$id}";
			case 'dribbble':
				return "http://dribbble.com/{$id}";
			case 'forrst':
				return "http://forrst.com/people/{$id}";
			case 'github':
				return "https://github.com/{$id}";	
		}
		
	}

	private function getNetworkName($network){
		
		switch($network){
			
			case 'facebook':
				return __('Facebook', self::SLUG);
			case 'twitter':
				return __('Twitter', self::SLUG);
			// case 'googleplus':
			// 	return __('Google+', self::SLUG);
			case 'youtube':
				return __('YouTube', self::SLUG);
			case 'vimeo':
				return __('Vimeo', self::SLUG);
			case 'dribbble':
				return __('Dribbble', self::SLUG);
			case 'forrst':
				return __('Forrst', self::SLUG);
			case 'github':
				return __('GitHub', self::SLUG);
		}

	}

	private function getNetworkMetric($network){
		
		switch($network){
			
			case 'facebook':
				return __('Fans', self::SLUG);
			case 'twitter':
				return __('Followers', self::SLUG);
			// case 'googleplus':
			// 	return __('Followers', self::SLUG);
			case 'youtube':
				return __('Subscribers', self::SLUG);
			case 'vimeo':
				return __('Subscribers', self::SLUG);
			case 'dribbble':
				return __('Followers', self::SLUG);
			case 'forrst':
				return __('Followers', self::SLUG);
			case 'github':
				return __('Followers', self::SLUG);		
		}
		
	}
	
	private function getNetworkButtonText($network){
		
		switch($network){
			
			case 'facebook':
				return __('Like', self::SLUG);
			case 'twitter':
				return __('Follow', self::SLUG);
			// case 'googleplus':
			// 	return __('Follow', self::SLUG);
			case 'youtube':
				return __('Subscribe', self::SLUG);
			case 'vimeo':
				return __('Subscribe', self::SLUG);
			case 'dribbble':
				return __('Follow', self::SLUG);
			case 'forrst':
				return __('Follow', self::SLUG);
			case 'github':
				return __('Follow', self::SLUG);
		}
		
	}

	private function getNetworkButtonHint($network){
		
		switch($network){
			
			case 'facebook':
				return __('Like on Facebook', self::SLUG);
			case 'twitter':
				return __('Follow on Twitter', self::SLUG);
			// case 'googleplus':
			// 	return __('Add to Circles on Google+', self::SLUG);
			case 'youtube':
				return __('Subscribe to Youtube Channel', self::SLUG);
			case 'vimeo':
				return __('Subscribe to Vimeo Channel', self::SLUG);
			case 'dribbble':
				return __('Follow on Dribbble', self::SLUG);
			case 'forrst':
				return __('Follow on Forrst', self::SLUG);
			case 'github':
				return __('Follow on GitHub', self::SLUG);
		}
		
	}

	/**
	 * Returns whether a style allows buttons to be displayed
	 *
	 * @param String $style
	 * @return Bool
	 */
	private function getAllowButtons($style = 'classic'){
		
		switch($style){

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

	/**
	 * Returns the required icon size for a specific style
	 *
	 * @param String $style
	 * @return Bool
	 */
	private function getIconSize($style = 'classic'){
		
		switch($style){

			case 'modern':
			case 'tutsflavor':
			case 'colorful':
			case 'plainlarge':
				return '32';
			
			case 'classic':
			case 'plainsmall':
			case 'dark':
			default:
				return '16';
		}

	}

	private function formatNumber($number, $useCompactNumbers){
		
		if($useCompactNumbers){
			
			return $this->getCompactNumber($number);

		} else{
			
			return number_format($number);

		}

	}

	/**
	 * Convert a number to a shorter (rounded) representation
	 *
	 * @param Int $number
	 * @return String
	 */
	private function getCompactNumber($number){

		switch(true){
			
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
	
	/**
	 * Get absolute URL for $path
	 *
	 * @param String $path
	 * @return String
	 */
	private function getUrl($path){
		
		return SOCIALBOX_URL . '/' . $path;
		
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