<?php
/*
 * SocialBox v.1.3.1
 * Copyright by Jonas Doebertin
 * Available only at CodeCanyon: http://codecanyon.net/item/socialbox-social-wordpress-widget/627127
 */
?>

<div class="socialbox-options">

	<!-- General Settings -->
	<fieldset class="widefat socialbox-general">
		
		<legend><?php _e('General Settings', self::SLUG); ?></legend>
		
		<p>
			<!-- Open New Window -->
			<input type="checkbox" id="<?php echo $this->get_field_id('new_window'); ?>" name="<?php echo $this->get_field_name('new_window'); ?>" <?php if ($instance['new_window']) echo 'checked="checked"'; ?> class="checkbox" />
			<label for="<?php echo $this->get_field_id('new_window'); ?>"><?php _e('Open Links in new Window/Tab', self::SLUG); ?></label>
			<br /><small><?php _e('Forces Links to be opened in a new window/tab', self::SLUG); ?></small>
		</p>
		
		<p>
			<!-- Show Buttons -->
			<input type="checkbox" id="<?php echo $this->get_field_id('show_buttons'); ?>" name="<?php echo $this->get_field_name('show_buttons'); ?>" <?php if ($instance['show_buttons']) echo 'checked="checked"'; ?> class="checkbox" />
			<label for="<?php echo $this->get_field_id('show_buttons'); ?>"><?php _e('Show Buttons', self::SLUG); ?></label>
			<br /><small><?php _e('Display Follow/Subscribe buttons', self::SLUG); ?></small>
		</p>

		<p>
			<!-- Select Style -->
			<select id="<?php echo $this->get_field_id('style'); ?>" name="<?php echo $this->get_field_name('style'); ?>">
				<optgroup label="Regular Styles">
					<option <?php if($instance['style'] == 'classic' ) echo 'selected="selected"'; ?> value="classic">Classic (default)</option>
					<option <?php if($instance['style'] == 'modern' ) echo 'selected="selected"'; ?> value="modern">Modern</option>
					<option <?php if($instance['style'] == 'tutsflavor' ) echo 'selected="selected"'; ?> value="tutsflavor">Tuts+ Flavor</option>
					<option <?php if($instance['style'] == 'dark' ) echo 'selected="selected"'; ?> value="dark">Dark</option>
				</optgroup>
				<optgroup label="Plain Styles">
					<option <?php if($instance['style'] == 'plainsmall' ) echo 'selected="selected"'; ?> value="plainsmall">Plain (small icons)</option>
					<option <?php if($instance['style'] == 'plainlarge' ) echo 'selected="selected"'; ?> value="plainlarge">Plain (large icons)</option>
				</optgroup>
			</select>
			<br /><small><?php _e('Choose the widgets display style', self::SLUG); ?></small>
		</p>

		<p>
			<!-- Compact numbers -->
			<input type="checkbox" id="<?php echo $this->get_field_id('compact_numbers'); ?>" name="<?php echo $this->get_field_name('compact_numbers'); ?>" <?php if ($instance['compact_numbers']) echo 'checked="checked"'; ?> class="checkbox" />
			<label for="<?php echo $this->get_field_id('compact_numbers'); ?>"><?php _e('Use Compact Numbers', self::SLUG); ?></label>
			<br /><small><?php _e('Show 12K instead of 12.300', self::SLUG); ?></small>
		</p>
		
	</fieldset>
	
	<!-- Facebook -->
	<fieldset class="widefat">
		
		<legend><?php _e('Facebook', self::SLUG); ?></legend>
		
		<!-- ID -->
		<div class="socialbox-id">
			<label for="<?php echo $this->get_field_id('facebook_id'); ?>" title="<?php _e('Your Pages ID or Shortname (e.g. nettutsplus)', self::SLUG); ?>"><?php _e('Page ID/Name', self::SLUG); ?>:</label>
			<input type="text" id="<?php echo $this->get_field_id('facebook_id'); ?>" name="<?php echo $this->get_field_name('facebook_id'); ?>" value="<?php echo $instance['facebook_id']; ?>" class="widefat"  />
		</div>
		
		<!-- Default -->
		<div class="socialbox-default">
			<label for="<?php echo $this->get_field_id('facebook_default'); ?>" title="<?php _e('Your fallback like count', self::SLUG); ?>"><?php _e('Default:', self::SLUG); ?></label>
			<input type="text" id="<?php echo $this->get_field_id('facebook_default'); ?>" name="<?php echo $this->get_field_name('facebook_default'); ?>" value="<?php echo $instance['facebook_default']; ?>" size="6" class="widefat" />
		</div>
		
		<!-- Position -->
		<div class="socialbox-position">
			<label for="<?php echo $this->get_field_id('facebook_position'); ?>" title="<?php _e('Display position within SocialBox', self::SLUG); ?>"><?php _e('Position:', self::SLUG); ?></label>
			<input type="text" id="<?php echo $this->get_field_id('facebook_position'); ?>" name="<?php echo $this->get_field_name('facebook_position'); ?>" value="<?php echo $instance['facebook_position']; ?>" size="2" class="widefat" />
		</div>
		
	</fieldset>
	
	<!-- Twitter -->
	<fieldset class="widefat">
		
		<legend><?php _e('Twitter', self::SLUG); ?></legend>
		
		<!-- ID -->
		<div class="socialbox-id">
			<label for="<?php echo $this->get_field_id('twitter_id'); ?>" title="<?php _e('Your Twitter screenname (e.g. envatowebdev)', self::SLUG); ?>"><?php _e('Username', self::SLUG); ?>:</label>
			<input type="text" id="<?php echo $this->get_field_id('twitter_id'); ?>" name="<?php echo $this->get_field_name('twitter_id'); ?>" value="<?php echo $instance['twitter_id']; ?>" class="widefat"  />
		</div>
		
		<!-- Default -->
		<div class="socialbox-default">
			<label for="<?php echo $this->get_field_id('twitter_default'); ?>" title="<?php _e('Your fallback follower count', self::SLUG); ?>"><?php _e('Default:', self::SLUG); ?></label>
			<input type="text" id="<?php echo $this->get_field_id('twitter_default'); ?>" name="<?php echo $this->get_field_name('twitter_default'); ?>" value="<?php echo $instance['twitter_default']; ?>" size="6" class="widefat" />
		</div>
		
		<!-- Position -->
		<div class="socialbox-position">
			<label for="<?php echo $this->get_field_id('twitter_position'); ?>" title="<?php _e('Display position within SocialBox', self::SLUG); ?>"><?php _e('Position:', self::SLUG); ?></label>
			<input type="text" id="<?php echo $this->get_field_id('twitter_position'); ?>" name="<?php echo $this->get_field_name('twitter_position'); ?>" value="<?php echo $instance['twitter_position']; ?>" size="2" class="widefat" />
		</div>
		
	</fieldset>

	<?php /*
	<!-- Google+ -->
	<fieldset class="widefat">
		
		<legend><?php _e('Google+', self::SLUG); ?></legend>
		
		<!-- ID -->
		<div class="socialbox-id">
			<label for="<?php echo $this->get_field_id('googleplus_id'); ?>" title="<?php _e('Your Google+ ID (e.g. 104560124403688998123)', self::SLUG); ?>"><?php _e('User ID', self::SLUG); ?>:</label>
			<input type="text" id="<?php echo $this->get_field_id('googleplus_id'); ?>" name="<?php echo $this->get_field_name('googleplus_id'); ?>" value="<?php echo $instance['googleplus_id']; ?>" class="widefat"  />
		</div>
		
		<!-- Default -->
		<div class="socialbox-default">
			<label for="<?php echo $this->get_field_id('googleplus_default'); ?>" title="<?php _e('Your fallback count', self::SLUG); ?>"><?php _e('Default:', self::SLUG); ?></label>
			<input type="text" id="<?php echo $this->get_field_id('googleplus_default'); ?>" name="<?php echo $this->get_field_name('googleplus_default'); ?>" value="<?php echo $instance['googleplus_default']; ?>" size="6" class="widefat" />
		</div>
		
		<!-- Position -->
		<div class="socialbox-position">
			<label for="<?php echo $this->get_field_id('googleplus_position'); ?>" title="<?php _e('Display position within SocialBox', self::SLUG); ?>"><?php _e('Position:', self::SLUG); ?></label>
			<input type="text" id="<?php echo $this->get_field_id('googleplus_position'); ?>" name="<?php echo $this->get_field_name('googleplus_position'); ?>" value="<?php echo $instance['googleplus_position']; ?>" size="2" class="widefat" />
		</div>
		
	</fieldset>
	*/
	?>
	
	<!-- YouTube -->
	<fieldset class="widefat">
		
		<legend><?php _e('YouTube', self::SLUG); ?></legend>
		
		<!-- ID -->
		<div class="socialbox-id">
			<label for="<?php echo $this->get_field_id('youtube_id'); ?>" title="<?php _e('Your YouTube Channel (e.g. nettutsplus)', self::SLUG); ?>"><?php _e('Channel', self::SLUG); ?>:</label>
			<input type="text" id="<?php echo $this->get_field_id('youtube_id'); ?>" name="<?php echo $this->get_field_name('youtube_id'); ?>" value="<?php echo $instance['youtube_id']; ?>" class="widefat"  />
		</div>
		
		<!-- Default -->
		<div class="socialbox-default">
			<label for="<?php echo $this->get_field_id('youtube_default'); ?>" title="<?php _e('Your fallback subscriber count', self::SLUG); ?>"><?php _e('Default:', self::SLUG); ?></label>
			<input type="text" id="<?php echo $this->get_field_id('youtube_default'); ?>" name="<?php echo $this->get_field_name('youtube_default'); ?>" value="<?php echo $instance['youtube_default']; ?>" size="6" class="widefat" />
		</div>
		
		<!-- Position -->
		<div class="socialbox-position">
			<label for="<?php echo $this->get_field_id('youtube_position'); ?>" title="<?php _e('Display position within SocialBox', self::SLUG); ?>"><?php _e('Position:', self::SLUG); ?></label>
			<input type="text" id="<?php echo $this->get_field_id('youtube_position'); ?>" name="<?php echo $this->get_field_name('youtube_position'); ?>" value="<?php echo $instance['youtube_position']; ?>" size="2" class="widefat" />
		</div>
		
	</fieldset>
	
	<!-- Vimeo -->
	<fieldset class="widefat">
		
		<legend><?php _e('Vimeo', self::SLUG); ?></legend>
		
		<!-- ID -->
		<div class="socialbox-id">
			<label for="<?php echo $this->get_field_id('vimeo_id'); ?>" title="<?php _e('Your Vimeo Channel', self::SLUG); ?>"><?php _e('Channel', self::SLUG); ?>:</label>
			<input type="text" id="<?php echo $this->get_field_id('vimeo_id'); ?>" name="<?php echo $this->get_field_name('vimeo_id'); ?>" value="<?php echo $instance['vimeo_id']; ?>" class="widefat"  />
		</div>
		
		<!-- Default -->
		<div class="socialbox-default">
			<label for="<?php echo $this->get_field_id('vimeo_default'); ?>" title="<?php _e('Your fallback subscriber count', self::SLUG); ?>"><?php _e('Default:', self::SLUG); ?></label>
			<input type="text" id="<?php echo $this->get_field_id('vimeo_default'); ?>" name="<?php echo $this->get_field_name('vimeo_default'); ?>" value="<?php echo $instance['vimeo_default']; ?>" size="6" class="widefat" />
		</div>
		
		<!-- Position -->
		<div class="socialbox-position">
			<label for="<?php echo $this->get_field_id('vimeo_position'); ?>" title="<?php _e('Display position within SocialBox', self::SLUG); ?>"><?php _e('Position:', self::SLUG); ?></label>
			<input type="text" id="<?php echo $this->get_field_id('vimeo_position'); ?>" name="<?php echo $this->get_field_name('vimeo_position'); ?>" value="<?php echo $instance['vimeo_position']; ?>" size="2" class="widefat" />
		</div>
		
	</fieldset>
	
	<!-- Dribbble -->
	<fieldset class="widefat">
		
		<legend><?php _e('Dribbble', self::SLUG); ?></legend>
		
		<!-- ID -->
		<div class="socialbox-id">
			<label for="<?php echo $this->get_field_id('dribbble_id'); ?>" title="<?php _e('Your Dribbble username (e.g. envato)', self::SLUG); ?>"><?php _e('Username', self::SLUG); ?>:</label>
			<input type="text" id="<?php echo $this->get_field_id('dribbble_id'); ?>" name="<?php echo $this->get_field_name('dribbble_id'); ?>" value="<?php echo $instance['dribbble_id']; ?>" class="widefat"  />
		</div>
		
		<!-- Default -->
		<div class="socialbox-default">
			<label for="<?php echo $this->get_field_id('dribbble_default'); ?>" title="<?php _e('Your fallback follower count', self::SLUG); ?>"><?php _e('Default:', self::SLUG); ?></label>
			<input type="text" id="<?php echo $this->get_field_id('dribbble_default'); ?>" name="<?php echo $this->get_field_name('dribbble_default'); ?>" value="<?php echo $instance['dribbble_default']; ?>" size="6" class="widefat" />
		</div>
		
		<!-- Position -->
		<div class="socialbox-position">
			<label for="<?php echo $this->get_field_id('dribbble_position'); ?>" title="<?php _e('Display position within SocialBox', self::SLUG); ?>"><?php _e('Position:', self::SLUG); ?></label>
			<input type="text" id="<?php echo $this->get_field_id('dribbble_position'); ?>" name="<?php echo $this->get_field_name('dribbble_position'); ?>" value="<?php echo $instance['dribbble_position']; ?>" size="2" class="widefat" />
		</div>
		
	</fieldset>
	
	<!-- Forrst -->
	<fieldset class="widefat">
		
		<legend><?php _e('Forrst', self::SLUG); ?></legend>
		
		<!-- ID -->
		<div class="socialbox-id">
			<label for="<?php echo $this->get_field_id('forrst_id'); ?>" title="<?php _e('Your Forrst username', self::SLUG); ?>"><?php _e('Username', self::SLUG); ?>:</label>
			<input type="text" id="<?php echo $this->get_field_id('forrst_id'); ?>" name="<?php echo $this->get_field_name('forrst_id'); ?>" value="<?php echo $instance['forrst_id']; ?>" class="widefat"  />
		</div>
		
		<!-- Default -->
		<div class="socialbox-default">
			<label for="<?php echo $this->get_field_id('forrst_default'); ?>" title="<?php _e('Your fallback follower count', self::SLUG); ?>"><?php _e('Default:', self::SLUG); ?></label>
			<input type="text" id="<?php echo $this->get_field_id('forrst_default'); ?>" name="<?php echo $this->get_field_name('forrst_default'); ?>" value="<?php echo $instance['forrst_default']; ?>" size="6" class="widefat" />
		</div>
		
		<!-- Position -->
		<div class="socialbox-position">
			<label for="<?php echo $this->get_field_id('forrst_position'); ?>" title="<?php _e('Display position within SocialBox', self::SLUG); ?>"><?php _e('Position:', self::SLUG); ?></label>
			<input type="text" id="<?php echo $this->get_field_id('forrst_position'); ?>" name="<?php echo $this->get_field_name('forrst_position'); ?>" value="<?php echo $instance['forrst_position']; ?>" size="2" class="widefat" />
		</div>
		
	</fieldset>
	
	<!-- Digg -->
	<fieldset class="widefat">
		
		<legend><?php _e('Digg', self::SLUG); ?></legend>
		
		<!-- ID -->
		<div class="socialbox-id">
			<label for="<?php echo $this->get_field_id('digg_id'); ?>" title="<?php _e('Your Digg username', self::SLUG); ?>"><?php _e('Username', self::SLUG); ?>:</label>
			<input type="text" id="<?php echo $this->get_field_id('digg_id'); ?>" name="<?php echo $this->get_field_name('digg_id'); ?>" value="<?php echo $instance['digg_id']; ?>" class="widefat"  />
		</div>
		
		<!-- Default -->
		<div class="socialbox-default">
			<label for="<?php echo $this->get_field_id('digg_default'); ?>" title="<?php _e('Your fallback follower count', self::SLUG); ?>"><?php _e('Default:', self::SLUG); ?></label>
			<input type="text" id="<?php echo $this->get_field_id('digg_default'); ?>" name="<?php echo $this->get_field_name('digg_default'); ?>" value="<?php echo $instance['digg_default']; ?>" size="6" class="widefat" />
		</div>
		
		<!-- Position -->
		<div class="socialbox-position">
			<label for="<?php echo $this->get_field_id('digg_position'); ?>" title="<?php _e('Display position within SocialBox', self::SLUG); ?>"><?php _e('Position:', self::SLUG); ?></label>
			<input type="text" id="<?php echo $this->get_field_id('digg_position'); ?>" name="<?php echo $this->get_field_name('digg_position'); ?>" value="<?php echo $instance['digg_position']; ?>" size="2" class="widefat" />
		</div>
		
	</fieldset>

	<!-- GitHub -->
	<fieldset class="widefat">
		
		<legend><?php _e('GitHub', self::SLUG); ?></legend>
		
		<!-- ID -->
		<div class="socialbox-id">
			<label for="<?php echo $this->get_field_id('github_id'); ?>" title="<?php _e('Your gitHub username', self::SLUG); ?>"><?php _e('Username', self::SLUG); ?>:</label>
			<input type="text" id="<?php echo $this->get_field_id('github_id'); ?>" name="<?php echo $this->get_field_name('github_id'); ?>" value="<?php echo $instance['github_id']; ?>" class="widefat"  />
		</div>
		
		<!-- Default -->
		<div class="socialbox-default">
			<label for="<?php echo $this->get_field_id('github_default'); ?>" title="<?php _e('Your fallback follower count', self::SLUG); ?>"><?php _e('Default:', self::SLUG); ?></label>
			<input type="text" id="<?php echo $this->get_field_id('github_default'); ?>" name="<?php echo $this->get_field_name('github_default'); ?>" value="<?php echo $instance['github_default']; ?>" size="6" class="widefat" />
		</div>
		
		<!-- Position -->
		<div class="socialbox-position">
			<label for="<?php echo $this->get_field_id('github_position'); ?>" title="<?php _e('Display position within SocialBox', self::SLUG); ?>"><?php _e('Position:', self::SLUG); ?></label>
			<input type="text" id="<?php echo $this->get_field_id('github_position'); ?>" name="<?php echo $this->get_field_name('github_position'); ?>" value="<?php echo $instance['github_position']; ?>" size="2" class="widefat" />
		</div>
		
	</fieldset>

	<!-- Additional Settings -->
	<fieldset class="widefat">
		
		<legend><?php _e('Additional Settings', self::SLUG); ?></legend>

		<p>
			<!-- Fixed Widget Width -->
			<label for="<?php echo $this->get_field_id('forced_widget_width'); ?>"><?php _e('Forced Widget Width:', self::SLUG); ?></label>
			<input type="text" id="<?php echo $this->get_field_id('forced_widget_width'); ?>" name="<?php echo $this->get_field_name('forced_widget_width'); ?>" value="<?php echo $instance['forced_widget_width']; ?>" size="2" /> px
			<br/><small><?php _e('Force Widget to have a specific width (0 to disable)', self::SLUG); ?></small>
		</p>

		<p>
			<!-- Fixed Button Width -->
			<label for="<?php echo $this->get_field_id('forced_button_width'); ?>"><?php _e('Forced Button Width:', self::SLUG); ?></label>
			<input type="text" id="<?php echo $this->get_field_id('forced_button_width'); ?>" name="<?php echo $this->get_field_name('forced_button_width'); ?>" value="<?php echo $instance['forced_button_width']; ?>" size="2" /> px
			<br/><small><?php _e('Force Buttons to have a specific width (0 to disable)', self::SLUG); ?></small>
		</p>

	</fieldset>

	<!-- Support Note -->
	<fieldset class="widefat socialbox-support">
		
		<p>
			<small>
				<?php _e('Need support? <a href="http://support.jonasdoebertin.net/" title="Get support!">Get some!</a>', self::SLUG); ?>
			</small>
		</p>

	</fieldset>

</div>