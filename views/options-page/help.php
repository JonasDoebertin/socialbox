<?php
/*
 * SocialBox v.1.3.2
 * Copyright by Jonas Doebertin
 * Available at CodeCanyon: http://codecanyon.net/item/socialbox-social-wordpress-widget/627127
 */
?>

<div class="socialbox-wrap">

	<div class="socialbox-help-contents">
			<h4><?php _e('Table of Contents', self::SLUG); ?></h4>
			<ol>
				<li><p><?php _e('Quick Setup', self::SLUG); ?></p></li>
				<li><p><?php _e('General Widget Options', self::SLUG); ?></p></li>
				<li><p><?php _e('General Network Options', self::SLUG); ?></p></li>
				<li><p><?php _e('Additional Widget Options', self::SLUG); ?></p></li>
			</ol>
		</div>

	<p class="socialbox-help-description">
		<?php _e('For all further questions, please open a ticket at my support site: <a href="http://support.jonasdoebertin.net" title="Get support!">support.jonasdoebertin.net</a>', self::SLUG); ?>
	</p>

	<h4 class="socialbox-help-divider-top"><?php _e('Quick Setup', self::SLUG); ?></h4>
	<p><?php _e('There is really not much to it. Just follow these simple steps:', self::SLUG); ?></p>
	<ol>
		<li><p><?php _e('Install and activate the Plugin. (by the time you\'re reading this, you\'ve already completed this step)', self::SLUG); ?></p></li>
		<li><p><?php _e('Head over to the <a href="widgets.php" title="Appearance > Widgets">Appearance > Widgets</a> Page, and drag a SocialBox Widget from the &raquo;Available Widgets&laquo; section to your desired Widget Area / Sidebar.', self::SLUG); ?></p></li>
		<li><p><?php _e('Enter the Usernames / User IDs for the Social Networks you want to show up.', self::SLUG); ?></p></li>
		<li><p><?php _e('And finally, hit &raquo;Save&laquo;. That\'s it!', self::SLUG); ?></p></li>
	</ol>

	<h4 class="socialbox-help-divider-top"><?php _e('General Widget Options', self::SLUG); ?></h4>
	<dl>
		<dt><?php _e('Open Links in new Window/Tab', self::SLUG); ?></dt>
		<dd><?php _e('If checked, the links to the networks profile pages (network icons and &raquo;Follow&laquo; buttons) will be open in a new window or tab.', self::SLUG); ?></dd>

		<dt><?php _e('Show Buttons', self::SLUG); ?></dt>
		<dd><?php _e('If checked, the Widget will show &raquo;Like&laquo; / &raquo;Follow&laquo; / &raquo;Subscribe&laquo; buttons for every listed network. These links will point to the profile pages for the configured User / Channel.', self::SLUG); ?></dd>

		<dt><?php _e('Use Compact Numbers', self::SLUG); ?></dt>
		<dd><?php _e('If checked, the Widget will display the numbers in a compact form. Instead of showing the complete numbers, it will use a shortened syntax using "K" and "M" to indicate "thousands" and "millions". As an example, 12.345 will display as 12K.', self::SLUG); ?></dd>
	</dl>

	<h4 class="socialbox-help-divider-top"><?php _e('General Network Options', self::SLUG); ?></h4>
	<dl>
		<dt><?php _e('Default', self::SLUG); ?></dt>
		<dd><?php _e('This value will be shown if, for some reason, the related API is not reachable or returns unexpected/funky results. It\'s allways a good idea to set these values for each configured network.', self::SLUG); ?></dd>

		<dt><?php _e('Position', self::SLUG); ?></dt>
		<dd><?php _e('The networks will be sorted by this numbers, from small (top) to large (bottom), and will be displayed in this order.', self::SLUG); ?></dd>
	</dl>

	<h4 class="socialbox-help-divider-top"><?php _e('Specific Network Options', self::SLUG); ?></h4>
	<dl>
		<dt><?php echo __('Facebook', self::SLUG) . ' ' . __('Page ID/Name', self::SLUG); ?></dt>
		<dd>
			<?php _e('Please enter your pages "Shortname" (the part of the URL after "facebook.com/".', self::SLUG); ?><br/>
			<img src="<?php $this->url('images/help/facebook-id.jpg'); ?>" /><br/>
			<strong><?php _e('Note:', self::SLUG); ?></strong> <?php _e('SocialBox will only display the "Like" number, if access to your page is not restricted in any way (only certain Countries, etc.)', self::SLUG); ?>
		</dd>

		<dt><?php echo __('Twitter', self::SLUG) . ' ' . __('Username', self::SLUG); ?></dt>
		<dd>
			<?php _e('Please enter your regular Twitter Username (without the @-symbol).', self::SLUG); ?><br/>
			<img src="<?php $this->url('images/help/twitter-id.jpg'); ?>" />
		</dd>

		<!--<dt><?php echo __('Google+', self::SLUG) . ' ' . __('User ID', self::SLUG); ?></dt>
		<dd>
			Please enter your pages "Shortname" (the part of the URL after "facebook.com/".<br/>
			<img src="<?php $this->url('images/help/googleplus-id.jpg'); ?>" /><br/>
			<strong>Note:</strong> SocialBox will only display the "Like" number, if access to your page is not restricted in any way (only certain Countries, etc.)
		</dd>-->

		<dt><?php echo __('Youtube', self::SLUG) . ' ' . __('Channel', self::SLUG); ?></dt>
		<dd>
			<?php _e('Please enter your Channels "Shortname" (as seen in the URL).', self::SLUG); ?><br/>
			<img src="<?php $this->url('images/help/youtube-id.jpg'); ?>" /><br/>
		</dd>

		<dt><?php echo __('Vimeo', self::SLUG) . ' ' . __('Channel', self::SLUG); ?></dt>
		<dd>
			<?php _e('Please enter the Channels "shortname" (as seen in the URL).', self::SLUG); ?><br/>
			<img src="<?php $this->url('images/help/vimeo-id.jpg'); ?>" /><br/>
		</dd>

		<dt><?php echo __('Dribbble', self::SLUG) . ' ' . __('Username', self::SLUG); ?></dt>
		<dd>
			<?php _e('To display this number, please enter your Dribbble Username.', self::SLUG); ?><br/>
			<img src="<?php $this->url('images/help/dribbble-id.jpg'); ?>" /><br/>
		</dd>

		<dt><?php echo __('Forrst', self::SLUG) . ' ' . __('Username', self::SLUG); ?></dt>
		<dd>
			<?php _e('To display this number, please enter your Username (as seen in the URL).', self::SLUG); ?><br/>
			<strong>http://forrst.com/people/&lt;YOUR_USERNAME&gt;</strong>
		</dd>
		
		<dt><?php echo __('GitHub', self::SLUG) . ' ' . __('Username', self::SLUG); ?></dt>
		<dd>
			<?php _e('To display this number, please enter your Username.', self::SLUG); ?><br/>
			<strong>https://github.com/&lt;YOUR_USERNAME&gt;</strong>
		</dd>

	</dl>

	<h4 class="socialbox-help-divider-top"><?php _e('Additional Widget Options', self::SLUG); ?></h4>
	<dl>
		<dt><?php _e('Forced Widget Width', self::SLUG); ?></dt>
		<dd><?php _e('If set to somthing other than "0", this will force the Widget into the specified size. Use this, if your Sidebar / Widget Area is too narrow or too wide.', self::SLUG); ?></dd>

		<dt><?php _e('Forced Button Width', self::SLUG); ?></dt>
		<dd><?php _e('If set to something other than "0", this will force the "Follow" buttons (if enabled) into the specified width. Use this option, if you want to see consistent buttons (the captions will be centered).', self::SLUG); ?></dd>
	</dl>

</div>