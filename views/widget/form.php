<?php if(!defined('ABSPATH')) die('Direct access is not allowed.');


/*
 * SocialBox 1.4.0
 * Copyright by Jonas Döbertin
 * Available only at CodeCanyon: http://codecanyon.net/item/socialbox-social-wordpress-widget/627127
 */


?>

<div class="socialbox-options">

	<!-- General Settings -->
	<h5><?php _e('General Settings', 'socialbox'); ?></h5>

	<fieldset class="socialbox-general">
		
		<p>
			<!-- Open New Window -->
			<input type="checkbox" id="<?php echo $this->get_field_id('new_window'); ?>" name="<?php echo $this->get_field_name('new_window'); ?>" <?php if ($instance['new_window']) echo 'checked="checked"'; ?> class="checkbox" />
			<label for="<?php echo $this->get_field_id('new_window'); ?>"><?php _e('Open Links in new Window/Tab', 'socialbox'); ?></label>
			<br /><small><?php _e('Forces Links to be opened in a new window/tab', 'socialbox'); ?></small>
		</p>
		
		<p>
			<!-- Show Buttons -->
			<input type="checkbox" id="<?php echo $this->get_field_id('show_buttons'); ?>" name="<?php echo $this->get_field_name('show_buttons'); ?>" <?php if ($instance['show_buttons']) echo 'checked="checked"'; ?> class="checkbox" />
			<label for="<?php echo $this->get_field_id('show_buttons'); ?>"><?php _e('Show Buttons', 'socialbox'); ?></label>
			<br /><small><?php _e('Display Follow/Subscribe buttons', 'socialbox'); ?></small>
		</p>

		<p>
			<!-- Select Style -->
			<select id="<?php echo $this->get_field_id('style'); ?>" name="<?php echo $this->get_field_name('style'); ?>">
				<optgroup label="Regular Styles">
					<option <?php if($instance['style'] == 'classic' ) echo 'selected="selected"'; ?> value="classic">Classic (default)</option>
					<option <?php if($instance['style'] == 'modern' ) echo 'selected="selected"'; ?> value="modern">Modern</option>
					<option <?php if($instance['style'] == 'tutsflavor' ) echo 'selected="selected"'; ?> value="tutsflavor">Tuts+ Flavor</option>
					<option <?php if($instance['style'] == 'dark' ) echo 'selected="selected"'; ?> value="dark">Dark</option>
					<option <?php if($instance['style'] == 'colorful' ) echo 'selected="selected"'; ?> value="colorful">Colorful</option>
				</optgroup>
				<optgroup label="Plain Styles">
					<option <?php if($instance['style'] == 'plainsmall' ) echo 'selected="selected"'; ?> value="plainsmall">Plain (small icons)</option>
					<option <?php if($instance['style'] == 'plainlarge' ) echo 'selected="selected"'; ?> value="plainlarge">Plain (large icons)</option>
				</optgroup>
			</select>
			<br /><small><?php _e('Choose the widgets display style', 'socialbox'); ?></small>
		</p>

		<p>
			<!-- Compact numbers -->
			<input type="checkbox" id="<?php echo $this->get_field_id('compact_numbers'); ?>" name="<?php echo $this->get_field_name('compact_numbers'); ?>" <?php if ($instance['compact_numbers']) echo 'checked="checked"'; ?> class="checkbox" />
			<label for="<?php echo $this->get_field_id('compact_numbers'); ?>"><?php _e('Use Compact Numbers', 'socialbox'); ?></label>
			<br /><small><?php _e('Show 12K instead of 12.300', 'socialbox'); ?></small>
		</p>
		
	</fieldset>
	
	<!-- Facebook -->
	<h5><?php _e('Facebook', 'socialbox'); ?></h5>

	<fieldset>

		<!-- Page ID -->
		<p>
			<label for="<?php echo $this->get_field_id('facebook_id'); ?>" title="<?php _e('Your Pages ID or Shortname (e.g. envato)', 'socialbox'); ?>"><?php _e('Page ID or Shortname', 'socialbox'); ?>:</label><br/>
			<input type="text" id="<?php echo $this->get_field_id('facebook_id'); ?>" name="<?php echo $this->get_field_name('facebook_id'); ?>" value="<?php echo $instance['facebook_id']; ?>" class="widefat" />
		</p>

		<!-- Metric -->
		<p>
			<label for="<?php echo $this->get_field_id('facebook_metric'); ?>" title="<?php _e('What metric shall be displayed', 'socialbox'); ?>"><?php _e('Metric', 'socialbox'); ?>:</label>
			<select id="<?php echo $this->get_field_id('facebook_metric'); ?>" name="<?php echo $this->get_field_name('facebook_metric'); ?>" class="widefat">
				<option <?php if($instance['facebook_metric'] == 'likes' ) echo 'selected="selected"'; ?> value="likes">Likes</option>
				<option <?php if($instance['facebook_metric'] == 'checkins' ) echo 'selected="selected"'; ?> value="checkins">Checkins</option>
				<option <?php if($instance['facebook_metric'] == 'talking_about_count' ) echo 'selected="selected"'; ?> value="talking_about_count">Talking About</option>
				<option <?php if($instance['facebook_metric'] == 'were_here_count' ) echo 'selected="selected"'; ?> value="were_here_count">Were Here</option>
			</select>
		</p>
		
		<!-- Default -->
		<div class="socialbox-default">
			<label for="<?php echo $this->get_field_id('facebook_default'); ?>" title="<?php _e('Your fallback like count', 'socialbox'); ?>"><?php _e('Default:', 'socialbox'); ?></label>
			<input type="text" id="<?php echo $this->get_field_id('facebook_default'); ?>" name="<?php echo $this->get_field_name('facebook_default'); ?>" value="<?php echo $instance['facebook_default']; ?>" size="6" class="widefat" />
		</div>
		
		<!-- Position -->
		<div class="socialbox-position">
			<label for="<?php echo $this->get_field_id('facebook_position'); ?>" title="<?php _e('Display position within SocialBox', 'socialbox'); ?>"><?php _e('Position:', 'socialbox'); ?></label>
			<input type="text" id="<?php echo $this->get_field_id('facebook_position'); ?>" name="<?php echo $this->get_field_name('facebook_position'); ?>" value="<?php echo $instance['facebook_position']; ?>" size="2" class="widefat" />
		</div>
		
	</fieldset>
	
	<!-- Twitter -->
	<h5><?php _e('Twitter', 'socialbox'); ?></h5>

	<fieldset>
		
		<!-- ID -->
		<p>
			<label for="<?php echo $this->get_field_id('twitter_id'); ?>" title="<?php _e('Your Twitter screenname (e.g. envatowebdev)', 'socialbox'); ?>"><?php _e('Username', 'socialbox'); ?>:</label>
			<input type="text" id="<?php echo $this->get_field_id('twitter_id'); ?>" name="<?php echo $this->get_field_name('twitter_id'); ?>" value="<?php echo $instance['twitter_id']; ?>" class="widefat" />
		</p>
		
		<!-- Default -->
		<div class="socialbox-default">
			<label for="<?php echo $this->get_field_id('twitter_default'); ?>" title="<?php _e('Your fallback follower count', 'socialbox'); ?>"><?php _e('Default:', 'socialbox'); ?></label>
			<input type="text" id="<?php echo $this->get_field_id('twitter_default'); ?>" name="<?php echo $this->get_field_name('twitter_default'); ?>" value="<?php echo $instance['twitter_default']; ?>" size="6" class="widefat" />
		</div>
		
		<!-- Position -->
		<div class="socialbox-position">
			<label for="<?php echo $this->get_field_id('twitter_position'); ?>" title="<?php _e('Display position within SocialBox', 'socialbox'); ?>"><?php _e('Position:', 'socialbox'); ?></label>
			<input type="text" id="<?php echo $this->get_field_id('twitter_position'); ?>" name="<?php echo $this->get_field_name('twitter_position'); ?>" value="<?php echo $instance['twitter_position']; ?>" size="2" class="widefat" />
		</div>
		
	</fieldset>
	
	<!-- YouTube -->
	<h5><?php _e('YouTube', 'socialbox'); ?></h5>

	<fieldset>
		
		<!-- ID -->
		<p>
			<label for="<?php echo $this->get_field_id('youtube_id'); ?>" title="<?php _e('Your YouTube Channel (e.g. nettutsplus)', 'socialbox'); ?>"><?php _e('Channel', 'socialbox'); ?>:</label>
			<input type="text" id="<?php echo $this->get_field_id('youtube_id'); ?>" name="<?php echo $this->get_field_name('youtube_id'); ?>" value="<?php echo $instance['youtube_id']; ?>" class="widefat" />
		</p>
		
		<!-- Default -->
		<div class="socialbox-default">
			<label for="<?php echo $this->get_field_id('youtube_default'); ?>" title="<?php _e('Your fallback subscriber count', 'socialbox'); ?>"><?php _e('Default:', 'socialbox'); ?></label>
			<input type="text" id="<?php echo $this->get_field_id('youtube_default'); ?>" name="<?php echo $this->get_field_name('youtube_default'); ?>" value="<?php echo $instance['youtube_default']; ?>" size="6" class="widefat" />
		</div>
		
		<!-- Position -->
		<div class="socialbox-position">
			<label for="<?php echo $this->get_field_id('youtube_position'); ?>" title="<?php _e('Display position within SocialBox', 'socialbox'); ?>"><?php _e('Position:', 'socialbox'); ?></label>
			<input type="text" id="<?php echo $this->get_field_id('youtube_position'); ?>" name="<?php echo $this->get_field_name('youtube_position'); ?>" value="<?php echo $instance['youtube_position']; ?>" size="2" class="widefat" />
		</div>
		
	</fieldset>
	
	<!-- Vimeo -->
	<h5><?php _e('Vimeo', 'socialbox'); ?></h5>

	<fieldset>

		<!-- ID -->
		<p>
			<label for="<?php echo $this->get_field_id('vimeo_id'); ?>" title="<?php _e('Your Vimeo Channel', 'socialbox'); ?>"><?php _e('Channel', 'socialbox'); ?>:</label>
			<input type="text" id="<?php echo $this->get_field_id('vimeo_id'); ?>" name="<?php echo $this->get_field_name('vimeo_id'); ?>" value="<?php echo $instance['vimeo_id']; ?>" class="widefat" />
		</p>
		
		<!-- Default -->
		<div class="socialbox-default">
			<label for="<?php echo $this->get_field_id('vimeo_default'); ?>" title="<?php _e('Your fallback subscriber count', 'socialbox'); ?>"><?php _e('Default:', 'socialbox'); ?></label>
			<input type="text" id="<?php echo $this->get_field_id('vimeo_default'); ?>" name="<?php echo $this->get_field_name('vimeo_default'); ?>" value="<?php echo $instance['vimeo_default']; ?>" size="6" class="widefat" />
		</div>
		
		<!-- Position -->
		<div class="socialbox-position">
			<label for="<?php echo $this->get_field_id('vimeo_position'); ?>" title="<?php _e('Display position within SocialBox', 'socialbox'); ?>"><?php _e('Position:', 'socialbox'); ?></label>
			<input type="text" id="<?php echo $this->get_field_id('vimeo_position'); ?>" name="<?php echo $this->get_field_name('vimeo_position'); ?>" value="<?php echo $instance['vimeo_position']; ?>" size="2" class="widefat" />
		</div>
		
	</fieldset>
	
	<!-- Dribbble -->
	<h5><?php _e('Dribbble', 'socialbox'); ?></h5>

	<fieldset>
		
		<!-- ID -->
		<p>
			<label for="<?php echo $this->get_field_id('dribbble_id'); ?>" title="<?php _e('Your Dribbble username (e.g. envato)', 'socialbox'); ?>"><?php _e('Username', 'socialbox'); ?>:</label>
			<input type="text" id="<?php echo $this->get_field_id('dribbble_id'); ?>" name="<?php echo $this->get_field_name('dribbble_id'); ?>" value="<?php echo $instance['dribbble_id']; ?>" class="widefat" />
		</p>
		
		<!-- Default -->
		<div class="socialbox-default">
			<label for="<?php echo $this->get_field_id('dribbble_default'); ?>" title="<?php _e('Your fallback follower count', 'socialbox'); ?>"><?php _e('Default:', 'socialbox'); ?></label>
			<input type="text" id="<?php echo $this->get_field_id('dribbble_default'); ?>" name="<?php echo $this->get_field_name('dribbble_default'); ?>" value="<?php echo $instance['dribbble_default']; ?>" size="6" class="widefat" />
		</div>
		
		<!-- Position -->
		<div class="socialbox-position">
			<label for="<?php echo $this->get_field_id('dribbble_position'); ?>" title="<?php _e('Display position within SocialBox', 'socialbox'); ?>"><?php _e('Position:', 'socialbox'); ?></label>
			<input type="text" id="<?php echo $this->get_field_id('dribbble_position'); ?>" name="<?php echo $this->get_field_name('dribbble_position'); ?>" value="<?php echo $instance['dribbble_position']; ?>" size="2" class="widefat" />
		</div>
		
	</fieldset>
	
	<!-- Forrst -->
	<h5><?php _e('Forrst', 'socialbox'); ?></h5>

	<fieldset>

		<!-- ID -->
		<p>
			<label for="<?php echo $this->get_field_id('forrst_id'); ?>" title="<?php _e('Your Forrst username', 'socialbox'); ?>"><?php _e('Username', 'socialbox'); ?>:</label>
			<input type="text" id="<?php echo $this->get_field_id('forrst_id'); ?>" name="<?php echo $this->get_field_name('forrst_id'); ?>" value="<?php echo $instance['forrst_id']; ?>" class="widefat" />
		</p>
		
		<!-- Default -->
		<div class="socialbox-default">
			<label for="<?php echo $this->get_field_id('forrst_default'); ?>" title="<?php _e('Your fallback follower count', 'socialbox'); ?>"><?php _e('Default:', 'socialbox'); ?></label>
			<input type="text" id="<?php echo $this->get_field_id('forrst_default'); ?>" name="<?php echo $this->get_field_name('forrst_default'); ?>" value="<?php echo $instance['forrst_default']; ?>" size="6" class="widefat" />
		</div>
		
		<!-- Position -->
		<div class="socialbox-position">
			<label for="<?php echo $this->get_field_id('forrst_position'); ?>" title="<?php _e('Display position within SocialBox', 'socialbox'); ?>"><?php _e('Position:', 'socialbox'); ?></label>
			<input type="text" id="<?php echo $this->get_field_id('forrst_position'); ?>" name="<?php echo $this->get_field_name('forrst_position'); ?>" value="<?php echo $instance['forrst_position']; ?>" size="2" class="widefat" />
		</div>
		
	</fieldset>

	<!-- GitHub -->
	<h5><?php _e('GitHub', 'socialbox'); ?></h5>

	<fieldset>

		<!-- ID -->
		<p>
			<label for="<?php echo $this->get_field_id('github_id'); ?>" title="<?php _e('Your gitHub username', 'socialbox'); ?>"><?php _e('Username', 'socialbox'); ?>:</label>
			<input type="text" id="<?php echo $this->get_field_id('github_id'); ?>" name="<?php echo $this->get_field_name('github_id'); ?>" value="<?php echo $instance['github_id']; ?>" class="widefat"  />
		</p>
		
		<!-- Default -->
		<div class="socialbox-default">
			<label for="<?php echo $this->get_field_id('github_default'); ?>" title="<?php _e('Your fallback follower count', 'socialbox'); ?>"><?php _e('Default:', 'socialbox'); ?></label>
			<input type="text" id="<?php echo $this->get_field_id('github_default'); ?>" name="<?php echo $this->get_field_name('github_default'); ?>" value="<?php echo $instance['github_default']; ?>" size="6" class="widefat" />
		</div>
		
		<!-- Position -->
		<div class="socialbox-position">
			<label for="<?php echo $this->get_field_id('github_position'); ?>" title="<?php _e('Display position within SocialBox', 'socialbox'); ?>"><?php _e('Position:', 'socialbox'); ?></label>
			<input type="text" id="<?php echo $this->get_field_id('github_position'); ?>" name="<?php echo $this->get_field_name('github_position'); ?>" value="<?php echo $instance['github_position']; ?>" size="2" class="widefat" />
		</div>
		
	</fieldset>

	<!-- Additional Settings -->
	<h5><?php _e('Additional Settings', 'socialbox'); ?></h5>

	<fieldset class="socialbox-additional">

		<p>
			<!-- Fixed Widget Width -->
			<label for="<?php echo $this->get_field_id('forced_widget_width'); ?>"><?php _e('Forced Widget Width:', 'socialbox'); ?></label>
			<input type="text" id="<?php echo $this->get_field_id('forced_widget_width'); ?>" name="<?php echo $this->get_field_name('forced_widget_width'); ?>" value="<?php echo $instance['forced_widget_width']; ?>" size="2" /> px
			<br/><small><?php _e('Force Widget to have a specific width (0 to disable)', 'socialbox'); ?></small>
		</p>

		<p>
			<!-- Fixed Button Width -->
			<label for="<?php echo $this->get_field_id('forced_button_width'); ?>"><?php _e('Forced Button Width:', 'socialbox'); ?></label>
			<input type="text" id="<?php echo $this->get_field_id('forced_button_width'); ?>" name="<?php echo $this->get_field_name('forced_button_width'); ?>" value="<?php echo $instance['forced_button_width']; ?>" size="2" /> px
			<br/><small><?php _e('Force Buttons to have a specific width (0 to disable)', 'socialbox'); ?></small>
		</p>

	</fieldset>

	<!-- Support Note -->
	<fieldset class="socialbox-support">
		
		<p>
			<small>
				<?php _e('Need help?', 'socialbox') ?> <a href="http://support.jonasdoebertin.net/" title="<?php _e('Visit the support page!', 'socialbox') ?>"><?php _e('Get some!', 'socialbox'); ?></a>
			</small>
		</p>

	</fieldset>

</div>