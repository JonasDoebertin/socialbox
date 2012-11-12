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
		
	</fieldset>
	
	<!-- Facebook -->
	<fieldset class="widefat">
		
		<legend><?php _e('Facebook', self::SLUG); ?></legend>
		
		<!-- ID -->
		<div class="socialbox-id">
			<label for="<?php echo $this->get_field_id('facebook_id'); ?>" title="<?php _e('Your Pages ID or Shortname (e.g. nettutsplus)', self::SLUG); ?>"><?php _e('Page ID/Name:', self::SLUG); ?></label>
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
			<label for="<?php echo $this->get_field_id('twitter_id'); ?>" title="<?php _e('Your Twitter screenname (e.g. envatowebdev)', self::SLUG); ?>"><?php _e('Username:', self::SLUG); ?></label>
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
	
	<!-- YouTube -->
	<fieldset class="widefat">
		
		<legend><?php _e('YouTube', self::SLUG); ?></legend>
		
		<!-- ID -->
		<div class="socialbox-id">
			<label for="<?php echo $this->get_field_id('youtube_id'); ?>" title="<?php _e('Your YouTube Channel (e.g. nettutsplus)', self::SLUG); ?>"><?php _e('Channel:', self::SLUG); ?></label>
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
			<label for="<?php echo $this->get_field_id('vimeo_id'); ?>" title="<?php _e('Your Vimeo Channel', self::SLUG); ?>"><?php _e('Channel:', self::SLUG); ?></label>
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
	
	<!-- Feedburner -->
	<fieldset class="widefat">
		
		<legend><?php _e('Feedburner', self::SLUG); ?></legend>
		
		<!-- ID -->
		<div class="socialbox-id">
			<label for="<?php echo $this->get_field_id('feedburner_id'); ?>" title="<?php _e('Your Feeds Feedburner name (e.g. nettuts or psdtuts)', self::SLUG); ?>"><?php _e('Feedname:', self::SLUG); ?></label>
			<input type="text" id="<?php echo $this->get_field_id('feedburner_id'); ?>" name="<?php echo $this->get_field_name('feedburner_id'); ?>" value="<?php echo $instance['feedburner_id']; ?>" class="widefat"  />
		</div>
		
		<!-- Default -->
		<div class="socialbox-default">
			<label for="<?php echo $this->get_field_id('feedburner_default'); ?>" title="<?php _e('Your fallback subscriber count', self::SLUG); ?>"><?php _e('Default:', self::SLUG); ?></label>
			<input type="text" id="<?php echo $this->get_field_id('feedburner_default'); ?>" name="<?php echo $this->get_field_name('feedburner_default'); ?>" value="<?php echo $instance['feedburner_default']; ?>" size="6" class="widefat" />
		</div>
		
		<!-- Position -->
		<div class="socialbox-position">
			<label for="<?php echo $this->get_field_id('feedburner_position'); ?>" title="<?php _e('Display position within SocialBox', self::SLUG); ?>"><?php _e('Position:', self::SLUG); ?></label>
			<input type="text" id="<?php echo $this->get_field_id('feedburner_position'); ?>" name="<?php echo $this->get_field_name('feedburner_position'); ?>" value="<?php echo $instance['feedburner_position']; ?>" size="2" class="widefat" />
		</div>
		
	</fieldset>
	
	<!-- Dribbble -->
	<fieldset class="widefat">
		
		<legend><?php _e('Dribbble', self::SLUG); ?></legend>
		
		<!-- ID -->
		<div class="socialbox-id">
			<label for="<?php echo $this->get_field_id('dribbble_id'); ?>" title="<?php _e('Your Dribbble username (e.g. envato)', self::SLUG); ?>"><?php _e('Username:', self::SLUG); ?></label>
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
			<label for="<?php echo $this->get_field_id('forrst_id'); ?>" title="<?php _e('Your Forrst username', self::SLUG); ?>"><?php _e('Username:', self::SLUG); ?></label>
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
			<label for="<?php echo $this->get_field_id('digg_id'); ?>" title="<?php _e('Your Digg username', self::SLUG); ?>"><?php _e('Username:', self::SLUG); ?></label>
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

</div>