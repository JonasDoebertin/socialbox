<?php if(!defined('ABSPATH')) die('Direct access is not allowed.');


/*
 * SocialBox 1.7.0
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

                <optgroup label="<?php _e('Regular Styles', 'socialbox') ?>">
                    <?php foreach($themes['core'] as $theme): ?>
                        <option value="<?php echo $theme['slug'] ?>" <?php if($instance['style'] == $theme['slug']) echo 'selected="selected"' ?>>
                            <?php echo $theme['name'] ?>
                        </option>
                    <?php endforeach; ?>
				</optgroup>

                <?php if(count($themes['addon']) > 0): ?>
                    <optgroup label="<?php _e('Addon Styles', 'socialbox') ?>">
                        <?php foreach($themes['addon'] as $theme): ?>
                            <option value="<?php echo $theme['slug'] ?>" <?php if($instance['style'] == $theme['slug']) echo 'selected="selected"' ?>>
                                <?php echo $theme['name'] ?>
                            </option>
                        <?php endforeach; ?>
                    </optgroup>
                <?php endif ?>

				<optgroup label="<?php _e('Plain Styles', 'socialbox') ?>">
					<?php foreach($themes['plain'] as $theme): ?>
                         <option value="<?php echo $theme['slug'] ?>" <?php if($instance['style'] == $theme['slug']) echo 'selected="selected"' ?>>
                             <?php echo $theme['name'] ?>
                         </option>
                     <?php endforeach; ?>
				</optgroup>
			</select>
			<br /><small><?php _e('Choose the widgets display theme', 'socialbox'); ?></small>
		</p>

		<p>
			<!-- Compact numbers -->
			<input type="checkbox" id="<?php echo $this->get_field_id('compact_numbers'); ?>" name="<?php echo $this->get_field_name('compact_numbers'); ?>" <?php if ($instance['compact_numbers']) echo 'checked="checked"'; ?> class="checkbox" />
			<label for="<?php echo $this->get_field_id('compact_numbers'); ?>"><?php _e('Use Compact Numbers', 'socialbox'); ?></label>
			<br /><small><?php _e('Show 12K instead of 12.300', 'socialbox'); ?></small>
		</p>

	</fieldset>

    <?php if(count($activeThemeTexts) >= 1): ?>

        <h5><?php echo $activeTheme['name'] ?> <?php _e('Style Settings', 'socialbox'); ?></h5>

        <fieldset>
            <?php foreach($activeThemeTexts as $text): ?>

                <p>
                    <label for="<?php echo $this->get_field_id($activeTheme['slug'] . '_' . $text['slug']) ?>" title="<?php echo $text['description'] ?>"><?php echo $text['title'] ?>:</label><br/>
                    <input type="text" id="<?php echo $this->get_field_id($activeTheme['slug'] . '_' . $text['slug']); ?>" name="<?php echo $this->get_field_name($activeTheme['slug'] . '_' . $text['slug']) ?>" value="<?php echo $instance[$activeTheme['slug'] . '_' . $text['slug']] ?>" class="widefat" />
                    <br /><small><?php echo $text['description'] ?></small>
                </p>

            <?php endforeach ?>
        </fieldset>

    <?php endif ?>

	<!-- Facebook -->
	<h5><?php $this->translator->network('facebook') ?></h5>

	<fieldset>

		<!-- Page ID -->
		<p>
			<label for="<?php echo $this->get_field_id('facebook_id'); ?>" title="<?php _e('Your Pages ID or Shortname (e.g. envato)', 'socialbox'); ?>"><?php _e('Page ID or Shortname', 'socialbox'); ?>:</label><br/>
			<input type="text" id="<?php echo $this->get_field_id('facebook_id'); ?>" name="<?php echo $this->get_field_name('facebook_id'); ?>" value="<?php echo $instance['facebook_id']; ?>" class="widefat" />
		</p>

		<!-- App ID -->
		<p>
			<label for="<?php echo $this->get_field_id('facebook_app_id'); ?>" title="<?php _e('Your App ID', 'socialbox'); ?>"><?php _e('App ID', 'socialbox'); ?>:</label><br/>
			<input type="text" id="<?php echo $this->get_field_id('facebook_app_id'); ?>" name="<?php echo $this->get_field_name('facebook_app_id'); ?>" value="<?php echo $instance['facebook_app_id']; ?>" class="widefat" />
		</p>

		<!-- App Secret -->
		<p>
			<label for="<?php echo $this->get_field_id('facebook_app_secret'); ?>" title="<?php _e('Your App Secret', 'socialbox'); ?>"><?php _e('App Secret', 'socialbox'); ?>:</label><br/>
			<input type="text" id="<?php echo $this->get_field_id('facebook_app_secret'); ?>" name="<?php echo $this->get_field_name('facebook_app_secret'); ?>" value="<?php echo $instance['facebook_app_secret']; ?>" class="widefat" />
		</p>

		<!-- Metric -->
		<p>
			<label for="<?php echo $this->get_field_id('facebook_metric'); ?>" title="<?php _e('What metric shall be displayed', 'socialbox'); ?>"><?php _e('Metric', 'socialbox'); ?>:</label>
			<select id="<?php echo $this->get_field_id('facebook_metric'); ?>" name="<?php echo $this->get_field_name('facebook_metric'); ?>" class="widefat">
				<option <?php if($instance['facebook_metric'] == 'likes' ) echo 'selected="selected"'; ?> value="likes">
					<?php $this->translator->metric('facebook', 'likes') ?>
				</option>
				<option <?php if($instance['facebook_metric'] == 'checkins' ) echo 'selected="selected"'; ?> value="checkins">
					<?php $this->translator->metric('facebook', 'checkins') ?>
				</option>
				<option <?php if($instance['facebook_metric'] == 'talking_about_count' ) echo 'selected="selected"'; ?> value="talking_about_count">
					<?php $this->translator->metric('facebook', 'talking_about_count') ?>
				</option>
				<option <?php if($instance['facebook_metric'] == 'were_here_count' ) echo 'selected="selected"'; ?> value="were_here_count">
					<?php $this->translator->metric('facebook', 'were_here_count') ?>
				</option>
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
	<h5><?php $this->translator->network('twitter') ?></h5>

	<fieldset>

		<!-- Username -->
		<p>
			<label for="<?php echo $this->get_field_id('twitter_id'); ?>" title="<?php _e('Your Twitter screenname (e.g. envatowebdev)', 'socialbox'); ?>"><?php _e('Username', 'socialbox'); ?>:</label>
			<input type="text" id="<?php echo $this->get_field_id('twitter_id'); ?>" name="<?php echo $this->get_field_name('twitter_id'); ?>" value="<?php echo $instance['twitter_id']; ?>" class="widefat" />
		</p>

		<!-- API Key -->
		<p>
			<label for="<?php echo $this->get_field_id('twitter_api_key'); ?>" title="<?php _e('Your Twitter application API key', 'socialbox'); ?>"><?php _e('API Key', 'socialbox'); ?>:</label>
			<input type="text" id="<?php echo $this->get_field_id('twitter_api_key'); ?>" name="<?php echo $this->get_field_name('twitter_api_key'); ?>" value="<?php echo $instance['twitter_api_key']; ?>" class="widefat" />
		</p>

		<!-- API Secret -->
		<p>
			<label for="<?php echo $this->get_field_id('twitter_api_secret'); ?>" title="<?php _e('Your Twitter application API secret', 'socialbox'); ?>"><?php _e('API Secret', 'socialbox'); ?>:</label>
			<input type="text" id="<?php echo $this->get_field_id('twitter_api_secret'); ?>" name="<?php echo $this->get_field_name('twitter_api_secret'); ?>" value="<?php echo $instance['twitter_api_secret']; ?>" class="widefat" />
		</p>

		<!-- Access Token -->
		<p>
			<label for="<?php echo $this->get_field_id('twitter_access_token'); ?>" title="<?php _e('Your Twitter application access token', 'socialbox'); ?>"><?php _e('Access Token', 'socialbox'); ?>:</label>
			<input type="text" id="<?php echo $this->get_field_id('twitter_access_token'); ?>" name="<?php echo $this->get_field_name('twitter_access_token'); ?>" value="<?php echo $instance['twitter_access_token']; ?>" class="widefat" />
		</p>

		<!-- Access Token Secret -->
		<p>
			<label for="<?php echo $this->get_field_id('twitter_access_token_secret'); ?>" title="<?php _e('Your Twitter application access token secret', 'socialbox'); ?>"><?php _e('Access Token Secret', 'socialbox'); ?>:</label>
			<input type="text" id="<?php echo $this->get_field_id('twitter_access_token_secret'); ?>" name="<?php echo $this->get_field_name('twitter_access_token_secret'); ?>" value="<?php echo $instance['twitter_access_token_secret']; ?>" class="widefat" />
		</p>

		<!-- Metric -->
		<p>
			<label for="<?php echo $this->get_field_id('twitter_metric'); ?>" title="<?php _e('What metric shall be displayed', 'socialbox'); ?>"><?php _e('Metric', 'socialbox'); ?>:</label>
			<select id="<?php echo $this->get_field_id('twitter_metric'); ?>" name="<?php echo $this->get_field_name('twitter_metric'); ?>" class="widefat">
				<option <?php if($instance['twitter_metric'] == 'followers_count' ) echo 'selected="selected"'; ?> value="followers_count">
					<?php $this->translator->metric('twitter', 'followers_count') ?>
				</option>
				<option <?php if($instance['twitter_metric'] == 'friends_count' ) echo 'selected="selected"'; ?> value="friends_count">
					<?php $this->translator->metric('twitter', 'friends_count') ?>
				</option>
				<option <?php if($instance['twitter_metric'] == 'statuses_count' ) echo 'selected="selected"'; ?> value="statuses_count">
					<?php $this->translator->metric('twitter', 'statuses_count') ?>
				</option>
				<option <?php if($instance['twitter_metric'] == 'favourites_count' ) echo 'selected="selected"'; ?> value="favourites_count">
					<?php $this->translator->metric('twitter', 'favourites_count') ?>
				</option>
				<option <?php if($instance['twitter_metric'] == 'listed_count' ) echo 'selected="selected"'; ?> value="listed_count">
					<?php $this->translator->metric('twitter', 'listed_count') ?>
				</option>
			</select>
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

    <!-- Google+ -->
    <h5><?php $this->translator->network('googleplus') ?></h5>

    <fieldset>

        <!-- ID -->
        <p>
            <label for="<?php echo $this->get_field_id('googleplus_id'); ?>" title="<?php _e('Your numeric Google+ User ID (eg. 117923080797643373311)', 'socialbox'); ?>"><?php _e('User ID', 'socialbox'); ?>:</label>
            <input type="text" id="<?php echo $this->get_field_id('googleplus_id'); ?>" name="<?php echo $this->get_field_name('googleplus_id'); ?>" value="<?php echo $instance['googleplus_id']; ?>" class="widefat" />
        </p>

        <!-- API Key -->
        <p>
            <label for="<?php echo $this->get_field_id('googleplus_api_key'); ?>" title="<?php _e('Your Google+ API Key', 'socialbox'); ?>"><?php _e('API Key', 'socialbox'); ?>:</label>
            <input type="text" id="<?php echo $this->get_field_id('googleplus_api_key'); ?>" name="<?php echo $this->get_field_name('googleplus_api_key'); ?>" value="<?php echo $instance['googleplus_api_key']; ?>" class="widefat" />
        </p>

        <!-- Default -->
        <div class="socialbox-default">
            <label for="<?php echo $this->get_field_id('googleplus_default'); ?>" title="<?php _e('Your fallback "In Others Circles" count', 'socialbox'); ?>"><?php _e('Default:', 'socialbox'); ?></label>
            <input type="text" id="<?php echo $this->get_field_id('googleplus_default'); ?>" name="<?php echo $this->get_field_name('googleplus_default'); ?>" value="<?php echo $instance['googleplus_default']; ?>" size="6" class="widefat" />
        </div>

        <!-- Position -->
        <div class="socialbox-position">
            <label for="<?php echo $this->get_field_id('googleplus_position'); ?>" title="<?php _e('Display position within SocialBox', 'socialbox'); ?>"><?php _e('Position:', 'socialbox'); ?></label>
            <input type="text" id="<?php echo $this->get_field_id('googleplus_position'); ?>" name="<?php echo $this->get_field_name('googleplus_position'); ?>" value="<?php echo $instance['googleplus_position']; ?>" size="2" class="widefat" />
        </div>

    </fieldset>

	<!-- YouTube -->
	<h5><?php $this->translator->network('youtube') ?></h5>

	<fieldset>

		<!-- ID -->
		<p>
			<label for="<?php echo $this->get_field_id('youtube_id'); ?>" title="<?php _e('Your YouTube Channel (e.g. nettutsplus)', 'socialbox'); ?>"><?php _e('Channel', 'socialbox'); ?>:</label>
			<input type="text" id="<?php echo $this->get_field_id('youtube_id'); ?>" name="<?php echo $this->get_field_name('youtube_id'); ?>" value="<?php echo $instance['youtube_id']; ?>" class="widefat" />
		</p>

		<!-- Metric -->
		<p>
			<label for="<?php echo $this->get_field_id('youtube_metric'); ?>" title="<?php _e('What metric shall be displayed', 'socialbox'); ?>"><?php _e('Metric', 'socialbox'); ?>:</label>
			<select id="<?php echo $this->get_field_id('youtube_metric'); ?>" name="<?php echo $this->get_field_name('youtube_metric'); ?>" class="widefat">
				<option <?php if($instance['youtube_metric'] == 'subscriberCount' ) echo 'selected="selected"'; ?> value="subscriberCount">
					<?php $this->translator->metric('youtube', 'subscriberCount') ?>
				</option>
				<option <?php if($instance['youtube_metric'] == 'totalUploadViews' ) echo 'selected="selected"'; ?> value="totalUploadViews">
					<?php $this->translator->metric('youtube', 'totalUploadViews') ?>
				</option>
			</select>
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
	<h5><?php $this->translator->network('vimeo') ?></h5>

	<fieldset>

		<!-- ID -->
		<p>
			<label for="<?php echo $this->get_field_id('vimeo_id'); ?>" title="<?php _e('Your Vimeo Channel', 'socialbox'); ?>"><?php _e('Channel', 'socialbox'); ?>:</label>
			<input type="text" id="<?php echo $this->get_field_id('vimeo_id'); ?>" name="<?php echo $this->get_field_name('vimeo_id'); ?>" value="<?php echo $instance['vimeo_id']; ?>" class="widefat" />
		</p>

        <!-- Metric -->
        <p>
            <label for="<?php echo $this->get_field_id('vimeo_metric'); ?>" title="<?php _e('What metric shall be displayed', 'socialbox'); ?>"><?php _e('Metric', 'socialbox'); ?>:</label>
            <select id="<?php echo $this->get_field_id('vimeo_metric'); ?>" name="<?php echo $this->get_field_name('vimeo_metric'); ?>" class="widefat">
                <option <?php if($instance['vimeo_metric'] == 'total_subscribers' ) echo 'selected="selected"'; ?> value="total_subscribers">
					<?php $this->translator->metric('vimeo', 'total_subscribers') ?>
				</option>
                <option <?php if($instance['vimeo_metric'] == 'total_videos' ) echo 'selected="selected"'; ?> value="total_videos">
					<?php $this->translator->metric('vimeo', 'total_videos') ?>
				</option>
            </select>
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

	<!-- Instagram -->
	<h5><?php $this->translator->network('instagram') ?></h5>

	<fieldset>

		<!-- ID -->
		<p>
			<label for="<?php echo $this->get_field_id('instagram_id'); ?>" title="<?php _e('Your Dribbble username (e.g. envato)', 'socialbox'); ?>"><?php _e('Username', 'socialbox'); ?>:</label>
			<input type="text" id="<?php echo $this->get_field_id('instagram_id'); ?>" name="<?php echo $this->get_field_name('instagram_id'); ?>" value="<?php echo $instance['instagram_id']; ?>" class="widefat" />
		</p>

		<!-- User ID -->
		<p>
			<label for="<?php echo $this->get_field_id('instagram_user_id'); ?>" title="<?php _e('Your Instagram user ID', 'socialbox'); ?>"><?php _e('User ID', 'socialbox'); ?>:</label>
			<input type="text" id="<?php echo $this->get_field_id('instagram_user_id'); ?>" name="<?php echo $this->get_field_name('instagram_user_id'); ?>" value="<?php echo $instance['instagram_user_id']; ?>" class="widefat" />
		</p>

		<!-- Client ID -->
		<p>
			<label for="<?php echo $this->get_field_id('instagram_client_id'); ?>" title="<?php _e('Your Instagram application client ID', 'socialbox'); ?>"><?php _e('Client ID', 'socialbox'); ?>:</label>
			<input type="text" id="<?php echo $this->get_field_id('instagram_client_id'); ?>" name="<?php echo $this->get_field_name('instagram_client_id'); ?>" value="<?php echo $instance['instagram_client_id']; ?>" class="widefat" />
		</p>

		<!-- Metric -->
		<p>
			<label for="<?php echo $this->get_field_id('instagram_metric'); ?>" title="<?php _e('What metric shall be displayed', 'socialbox'); ?>"><?php _e('Metric', 'socialbox'); ?>:</label>
			<select id="<?php echo $this->get_field_id('instagram_metric'); ?>" name="<?php echo $this->get_field_name('instagram_metric'); ?>" class="widefat">
				<option <?php if($instance['instagram_metric'] == 'media' ) echo 'selected="selected"'; ?> value="media">
					<?php $this->translator->metric('instagram', 'media') ?>
				</option>
				<option <?php if($instance['instagram_metric'] == 'followed_by' ) echo 'selected="selected"'; ?> value="followed_by">
					<?php $this->translator->metric('instagram', 'followed_by') ?>
				</option>
				<option <?php if($instance['instagram_metric'] == 'follows' ) echo 'selected="selected"'; ?> value="follows">
					<?php $this->translator->metric('instagram', 'follows') ?>
				</option>
			</select>
		</p>

		<!-- Default -->
		<div class="socialbox-default">
			<label for="<?php echo $this->get_field_id('instagram_default'); ?>" title="<?php _e('Your fallback follower count', 'socialbox'); ?>"><?php _e('Default:', 'socialbox'); ?></label>
			<input type="text" id="<?php echo $this->get_field_id('instagram_default'); ?>" name="<?php echo $this->get_field_name('instagram_default'); ?>" value="<?php echo $instance['instagram_default']; ?>" size="6" class="widefat" />
		</div>

		<!-- Position -->
		<div class="socialbox-position">
			<label for="<?php echo $this->get_field_id('instagram_position'); ?>" title="<?php _e('Display position within SocialBox', 'socialbox'); ?>"><?php _e('Position:', 'socialbox'); ?></label>
			<input type="text" id="<?php echo $this->get_field_id('instagram_position'); ?>" name="<?php echo $this->get_field_name('instagram_position'); ?>" value="<?php echo $instance['instagram_position']; ?>" size="2" class="widefat" />
		</div>

	</fieldset>

    <!-- Pinterest -->
    <h5><?php $this->translator->network('pinterest') ?></h5>

    <fieldset>

        <!-- ID -->
        <p>
            <label for="<?php echo $this->get_field_id('pinterest_id'); ?>" title="<?php _e('Your Pinterest username (e.g. envato)', 'socialbox'); ?>"><?php _e('Username', 'socialbox'); ?>:</label>
            <input type="text" id="<?php echo $this->get_field_id('pinterest_id'); ?>" name="<?php echo $this->get_field_name('pinterest_id'); ?>" value="<?php echo $instance['pinterest_id']; ?>" class="widefat" />
        </p>

        <!-- Metric -->
        <p>
            <label for="<?php echo $this->get_field_id('pinterest_metric'); ?>" title="<?php _e('What metric shall be displayed', 'socialbox'); ?>"><?php _e('Metric', 'socialbox'); ?>:</label>
            <select id="<?php echo $this->get_field_id('pinterest_metric'); ?>" name="<?php echo $this->get_field_name('pinterest_metric'); ?>" class="widefat">
                <option <?php if($instance['pinterest_metric'] == 'followers' ) echo 'selected="selected"'; ?> value="followers">
					<?php $this->translator->metric('pinterest', 'followers') ?>
				</option>
                <option <?php if($instance['pinterest_metric'] == 'pins' ) echo 'selected="selected"'; ?> value="pins">
					<?php $this->translator->metric('pinterest', 'pins') ?>
				</option>
                <option <?php if($instance['pinterest_metric'] == 'boards' ) echo 'selected="selected"'; ?> value="boards">
					<?php $this->translator->metric('pinterest', 'boards') ?>
				</option>
            </select>
        </p>

        <!-- Default -->
        <div class="socialbox-default">
            <label for="<?php echo $this->get_field_id('pinterest_default'); ?>" title="<?php _e('Your fallback follower count', 'socialbox'); ?>"><?php _e('Default:', 'socialbox'); ?></label>
            <input type="text" id="<?php echo $this->get_field_id('pinterest_default'); ?>" name="<?php echo $this->get_field_name('pinterest_default'); ?>" value="<?php echo $instance['pinterest_default']; ?>" size="6" class="widefat" />
        </div>

        <!-- Position -->
        <div class="socialbox-position">
            <label for="<?php echo $this->get_field_id('pinterest_position'); ?>" title="<?php _e('Display position within SocialBox', 'socialbox'); ?>"><?php _e('Position:', 'socialbox'); ?></label>
            <input type="text" id="<?php echo $this->get_field_id('pinterest_position'); ?>" name="<?php echo $this->get_field_name('pinterest_position'); ?>" value="<?php echo $instance['pinterest_position']; ?>" size="2" class="widefat" />
        </div>

    </fieldset>

	<!-- SoundCloud -->
	<h5><?php $this->translator->network('soundcloud') ?></h5>

	<fieldset>

		<!-- ID -->
		<p>
			<label for="<?php echo $this->get_field_id('soundcloud_id'); ?>" title="<?php _e('Your SoundCloud permalink (e.g. your-name)', 'socialbox'); ?>"><?php _e('Permalink', 'socialbox'); ?>:</label>
			<input type="text" id="<?php echo $this->get_field_id('soundcloud_id'); ?>" name="<?php echo $this->get_field_name('soundcloud_id'); ?>" value="<?php echo $instance['soundcloud_id']; ?>" class="widefat" />
		</p>

		<!-- Client ID -->
		<p>
			<label for="<?php echo $this->get_field_id('soundcloud_client_id'); ?>" title="<?php _e('Your SoundCloud application client id.', 'socialbox'); ?>"><?php _e('Client ID', 'socialbox'); ?>:</label>
			<input type="text" id="<?php echo $this->get_field_id('soundcloud_client_id'); ?>" name="<?php echo $this->get_field_name('soundcloud_client_id'); ?>" value="<?php echo $instance['soundcloud_client_id']; ?>" class="widefat" />
		</p>

		<!-- Metric -->
		<p>
			<label for="<?php echo $this->get_field_id('soundcloud_metric'); ?>" title="<?php _e('What metric shall be displayed', 'socialbox'); ?>"><?php _e('Metric', 'socialbox'); ?>:</label>
			<select id="<?php echo $this->get_field_id('soundcloud_metric'); ?>" name="<?php echo $this->get_field_name('soundcloud_metric'); ?>" class="widefat">
				<option <?php if($instance['soundcloud_metric'] == 'followers_count' ) echo 'selected="selected"'; ?> value="followers_count">
					<?php $this->translator->metric('soundcloud', 'followers_count') ?>
				</option>
				<option <?php if($instance['soundcloud_metric'] == 'followings_count' ) echo 'selected="selected"'; ?> value="followings_count">
					<?php $this->translator->metric('soundcloud', 'followings_count') ?>
				</option>
				<option <?php if($instance['soundcloud_metric'] == 'public_favorites_count' ) echo 'selected="selected"'; ?> value="public_favorites_count">
					<?php $this->translator->metric('soundcloud', 'public_favorites_count') ?>
				</option>
				<option <?php if($instance['soundcloud_metric'] == 'playlist_count' ) echo 'selected="selected"'; ?> value="playlist_count">
					<?php $this->translator->metric('soundcloud', 'playlist_count') ?>
				</option>
				<option <?php if($instance['soundcloud_metric'] == 'track_count' ) echo 'selected="selected"'; ?> value="track_count">
					<?php $this->translator->metric('soundcloud', 'track_count') ?>
				</option>
			</select>
		</p>

		<!-- Default -->
		<div class="socialbox-default">
			<label for="<?php echo $this->get_field_id('soundcloud_default'); ?>" title="<?php _e('Your fallback follower count', 'socialbox'); ?>"><?php _e('Default:', 'socialbox'); ?></label>
			<input type="text" id="<?php echo $this->get_field_id('soundcloud_default'); ?>" name="<?php echo $this->get_field_name('soundcloud_default'); ?>" value="<?php echo $instance['soundcloud_default']; ?>" size="6" class="widefat" />
		</div>

		<!-- Position -->
		<div class="socialbox-position">
			<label for="<?php echo $this->get_field_id('soundcloud_position'); ?>" title="<?php _e('Display position within SocialBox', 'socialbox'); ?>"><?php _e('Position:', 'socialbox'); ?></label>
			<input type="text" id="<?php echo $this->get_field_id('soundcloud_position'); ?>" name="<?php echo $this->get_field_name('soundcloud_position'); ?>" value="<?php echo $instance['soundcloud_position']; ?>" size="2" class="widefat" />
		</div>

	</fieldset>

	<!-- Dribbble -->
	<h5><?php $this->translator->network('dribbble') ?></h5>

	<fieldset>

		<!-- ID -->
		<p>
			<label for="<?php echo $this->get_field_id('dribbble_id'); ?>" title="<?php _e('Your Dribbble username (e.g. envato)', 'socialbox'); ?>"><?php _e('Username', 'socialbox'); ?>:</label>
			<input type="text" id="<?php echo $this->get_field_id('dribbble_id'); ?>" name="<?php echo $this->get_field_name('dribbble_id'); ?>" value="<?php echo $instance['dribbble_id']; ?>" class="widefat" />
		</p>

        <!-- Metric -->
        <p>
            <label for="<?php echo $this->get_field_id('dribbble_metric'); ?>" title="<?php _e('What metric shall be displayed', 'socialbox'); ?>"><?php _e('Metric', 'socialbox'); ?>:</label>
            <select id="<?php echo $this->get_field_id('dribbble_metric'); ?>" name="<?php echo $this->get_field_name('dribbble_metric'); ?>" class="widefat">
                <option <?php if($instance['dribbble_metric'] == 'followers_count' ) echo 'selected="selected"'; ?> value="followers_count">
					<?php $this->translator->metric('dribbble', 'followers_count') ?>
				</option>
                <option <?php if($instance['dribbble_metric'] == 'shots_count' ) echo 'selected="selected"'; ?> value="shots_count">
					<?php $this->translator->metric('dribbble', 'shots_count') ?>
				</option>
                <option <?php if($instance['dribbble_metric'] == 'likes_received_count' ) echo 'selected="selected"'; ?> value="likes_received_count">
					<?php $this->translator->metric('dribbble', 'likes_received_count') ?>
				</option>
                <option <?php if($instance['dribbble_metric'] == 'comments_received_count' ) echo 'selected="selected"'; ?> value="comments_received_count">
					<?php $this->translator->metric('dribbble', 'comments_received_count') ?>
				</option>
                <option <?php if($instance['dribbble_metric'] == 'rebounds_received_count' ) echo 'selected="selected"'; ?> value="rebounds_received_count">
					<?php $this->translator->metric('dribbble', 'rebounds_received_count') ?>
				</option>
            </select>
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
	<h5><?php $this->translator->network('forrst') ?></h5>

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
	<h5><?php $this->translator->network('github') ?></h5>

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

    <!-- MailChimp -->
    <h5><?php _e('MailChimp', 'socialbox'); ?></h5>

    <fieldset>

        <!-- ID -->
        <p>
            <label for="<?php echo $this->get_field_id('mailchimp_id'); ?>" title="<?php _e('Your MailChimp List ID', 'socialbox'); ?>"><?php _e('List ID', 'socialbox'); ?>:</label>
            <input type="text" id="<?php echo $this->get_field_id('mailchimp_id'); ?>" name="<?php echo $this->get_field_name('mailchimp_id'); ?>" value="<?php echo $instance['mailchimp_id']; ?>" class="widefat" />
        </p>

        <!-- API Key -->
        <p>
            <label for="<?php echo $this->get_field_id('mailchimp_api_key'); ?>" title="<?php _e('Your MailChimp API Key', 'socialbox'); ?>"><?php _e('API Key', 'socialbox'); ?>:</label>
            <input type="text" id="<?php echo $this->get_field_id('mailchimp_api_key'); ?>" name="<?php echo $this->get_field_name('mailchimp_api_key'); ?>" value="<?php echo $instance['mailchimp_api_key']; ?>" class="widefat" />
        </p>

        <!-- Subscription Form Url -->
        <p>
            <label for="<?php echo $this->get_field_id('mailchimp_form_url'); ?>" title="<?php _e('Your Subscribtion form URL', 'socialbox'); ?>"><?php _e('Subscription Form URL', 'socialbox'); ?>:</label>
            <input type="text" id="<?php echo $this->get_field_id('mailchimp_form_url'); ?>" name="<?php echo $this->get_field_name('mailchimp_form_url'); ?>" value="<?php echo $instance['mailchimp_form_url']; ?>" class="widefat" />
        </p>

        <!-- Default -->
        <div class="socialbox-default">
            <label for="<?php echo $this->get_field_id('mailchimp_default'); ?>" title="<?php _e('Your fallback subscribers count', 'socialbox'); ?>"><?php _e('Default:', 'socialbox'); ?></label>
            <input type="text" id="<?php echo $this->get_field_id('mailchimp_default'); ?>" name="<?php echo $this->get_field_name('mailchimp_default'); ?>" value="<?php echo $instance['mailchimp_default']; ?>" size="6" class="widefat" />
        </div>

        <!-- Position -->
        <div class="socialbox-position">
            <label for="<?php echo $this->get_field_id('mailchimp_position'); ?>" title="<?php _e('Display position within SocialBox', 'socialbox'); ?>"><?php _e('Position:', 'socialbox'); ?></label>
            <input type="text" id="<?php echo $this->get_field_id('mailchimp_position'); ?>" name="<?php echo $this->get_field_name('mailchimp_position'); ?>" value="<?php echo $instance['mailchimp_position']; ?>" size="2" class="widefat" />
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
				<?php _e('Need help configuring this widget?', 'socialbox') ?> <a href="http://codecanyon.net/user/jdpowered#contact" title="<?php _e('Send a message!', 'socialbox') ?>"><?php _e('Get some!', 'socialbox'); ?></a>
			</small>
		</p>

	</fieldset>

</div>
