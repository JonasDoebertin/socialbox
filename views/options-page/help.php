<?php if(!defined('ABSPATH')) die('Direct access is not allowed.');


/*
 * SocialBox 1.4.1
 * Copyright by Jonas Döbertin
 * Available only at CodeCanyon: http://codecanyon.net/item/socialbox-social-wordpress-widget/627127
 */


?>

<div class="socialbox-wrap">

	<div class="socialbox-help-contents">
			<h4><?php _e('Table of Contents', 'socialbox'); ?></h4>
			<ol>
				<li><p><?php _e('Quick Setup', 'socialbox'); ?></p></li>
				<li><p><?php _e('General Widget Options', 'socialbox'); ?></p></li>
				<li><p><?php _e('General Network Options', 'socialbox'); ?></p></li>
				<li><p><?php _e('Additional Widget Options', 'socialbox'); ?></p></li>
			</ol>
		</div>

	<p class="socialbox-help-description">
		<?php _e('For all further questions, please open a ticket at my support site: <a href="http://support.jonasdoebertin.net" title="Get support!">support.jonasdoebertin.net</a>', 'socialbox'); ?>
	</p>

	<h4 class="socialbox-help-divider-top"><?php _e('Quick Setup', 'socialbox'); ?></h4>
	<p><?php _e('There is really not much to it. Just follow these simple steps:', 'socialbox'); ?></p>
	<ol>
		<li><p><?php _e('Install and activate the plugin. (by the time you\'re reading this, you\'ve already completed this step)', 'socialbox'); ?></p></li>
		<li><p><?php _e('Head over to the <a href="widgets.php" title="Appearance > Widgets">Appearance > Widgets</a> Page and drag a SocialBox Widget from the &raquo;Available Widgets&laquo; section to your desired Widget Area or Sidebar.', 'socialbox'); ?></p></li>
		<li><p><?php _e('Enter the Usernames / User IDs for the Social Networks you want to show up.', 'socialbox'); ?></p></li>
		<li><p><?php _e('And finally, hit &raquo;Save&laquo;. That\'s it!', 'socialbox'); ?></p></li>
	</ol>

	<h4 class="socialbox-help-divider-top"><?php _e('General Widget Options', 'socialbox'); ?></h4>
	<dl>
		<dt><?php _e('Open Links in new Window/Tab', 'socialbox'); ?></dt>
		<dd><?php _e('If checked, the links to the networks profile pages (network icons and &raquo;Follow&laquo; buttons) will be open in a new window or tab.', 'socialbox'); ?></dd>

		<dt><?php _e('Show Buttons', 'socialbox'); ?></dt>
		<dd><?php _e('If checked, the Widget will show &raquo;Like&laquo; / &raquo;Follow&laquo; / &raquo;Subscribe&laquo; buttons for every listed network. These links will point to the profile pages for the configured User / Channel.', 'socialbox'); ?></dd>

		<dt><?php _e('Use Compact Numbers', 'socialbox'); ?></dt>
		<dd><?php _e('If checked, the Widget will display the numbers in a compact form. Instead of showing the complete numbers, it will use a shortened syntax using "K" and "M" to indicate "thousands" and "millions". As an example, 12.345 will display as 12K.', 'socialbox'); ?></dd>
	</dl>

	<h4 class="socialbox-help-divider-top"><?php _e('General Network Options', 'socialbox'); ?></h4>
	<dl>
		<dt><?php _e('Default', 'socialbox'); ?></dt>
		<dd><?php _e('This value will be shown if, for some reason, the related API is not reachable or returns unexpected/funky results. It\'s allways a good idea to set these values for each configured network.', 'socialbox'); ?></dd>

		<dt><?php _e('Position', 'socialbox'); ?></dt>
		<dd><?php _e('The networks will be sorted by this numbers, from small (top) to large (bottom), and will be displayed in this order.', 'socialbox'); ?></dd>
	</dl>

	<h4 class="socialbox-help-divider-top"><?php _e('Specific Network Options', 'socialbox'); ?></h4>
	<dl>
		<dt><?php echo __('Facebook', 'socialbox') . ' ' . __('Page ID/Name', 'socialbox'); ?></dt>
		<dd>
			<?php _e('Please enter your pages "Shortname" (the part of the URL after "facebook.com/".', 'socialbox'); ?><br/>
			<img src="<?php echo JD_SOCIALBOX_URL . '/assets/img/help/facebook-id.jpg' ?>" /><br/>
			<strong><?php _e('Note:', 'socialbox'); ?></strong> <?php _e('SocialBox will only display the "Like" number, if access to your page is not restricted in any way (only certain Countries, etc.)', 'socialbox'); ?>
		</dd>

		<dt><?php echo __('Twitter', 'socialbox') . ' ' . __('Username', 'socialbox'); ?></dt>
		<dd>
			<?php _e('Please enter your regular Twitter Username (without the @-symbol) as the username.', 'socialbox'); ?><br/>
			<?php _e('To maintain your API key and your access token, follow these steps:', 'socialbox') ?>
			<ol>
				<li><p><?php _e('Visit <a href="https://dev.twitter.com/">Twitter Developers</a> and sign in with your Twitter account.', 'socialbox'); ?></p></li>
				<li><p><?php _e('Go to <a href="https://apps.twitter.com/">My Applications</a> and click "Create a new Application".', 'socialbox'); ?></p></li>
				<li><p><?php _e('Enter any value for "Name", "Description" and "Website", agree to the "Developer Rules" and click "Create your Twitter application".', 'socialbox'); ?></p></li>
				<li><p><?php _e('At the top of the newly created apps overview page click on the "API Keys" tab.', 'socialbox'); ?></p></li>
				<li><p><?php _e('At the bottom of the page click "Create my access token".', 'socialbox'); ?></p></li>
				<li><p><?php _e('Copy the "API Key", "API Secret", "Access Token" and "Access Token Secret" and enter them in the respective fields.', 'socialbox'); ?></p></li>
			</ol>
			<img src="<?php echo JD_SOCIALBOX_URL . '/assets/img/help/twitter-id.jpg' ?>" />
		</dd>

		<dt><?php echo __('Youtube', 'socialbox') . ' ' . __('Channel', 'socialbox'); ?></dt>
		<dd>
			<?php _e('Please enter your Channels "Shortname" (as seen in the URL).', 'socialbox'); ?><br/>
			<img src="<?php echo JD_SOCIALBOX_URL . '/assets/img/help/youtube-id.jpg' ?>" /><br/>
		</dd>

		<dt><?php echo __('Vimeo', 'socialbox') . ' ' . __('Channel', 'socialbox'); ?></dt>
		<dd>
			<?php _e('Please enter the Channels "shortname" (as seen in the URL).', 'socialbox'); ?><br/>
			<img src="<?php echo JD_SOCIALBOX_URL . '/assets/img/help/vimeo-id.jpg' ?>" /><br/>
		</dd>

		<dt><?php echo __('Dribbble', 'socialbox') . ' ' . __('Username', 'socialbox'); ?></dt>
		<dd>
			<?php _e('To display this number, please enter your Dribbble Username.', 'socialbox'); ?><br/>
			<img src="<?php echo JD_SOCIALBOX_URL . '/assets/img/help/dribbble-id.jpg' ?>" /><br/>
		</dd>

		<dt><?php echo __('Forrst', 'socialbox') . ' ' . __('Username', 'socialbox'); ?></dt>
		<dd>
			<?php _e('To display this number, please enter your Username (as seen in the URL).', 'socialbox'); ?><br/>
			<strong>http://forrst.com/people/&lt;YOUR_USERNAME&gt;</strong>
		</dd>
		
		<dt><?php echo __('GitHub', 'socialbox') . ' ' . __('Username', 'socialbox'); ?></dt>
		<dd>
			<?php _e('To display this number, please enter your Username.', 'socialbox'); ?><br/>
			<strong>https://github.com/&lt;YOUR_USERNAME&gt;</strong>
		</dd>

	</dl>

	<h4 class="socialbox-help-divider-top"><?php _e('Additional Widget Options', 'socialbox'); ?></h4>
	<dl>
		<dt><?php _e('Forced Widget Width', 'socialbox'); ?></dt>
		<dd><?php _e('If set to somthing other than "0", this will force the Widget into the specified size. Use this, if your Sidebar / Widget Area is too narrow or too wide.', 'socialbox'); ?></dd>

		<dt><?php _e('Forced Button Width', 'socialbox'); ?></dt>
		<dd><?php _e('If set to something other than "0", this will force the "Follow" buttons (if enabled) into the specified width. Use this option, if you want to see consistent buttons (the captions will be centered).', 'socialbox'); ?></dd>
	</dl>

	<h4 class="socialbox-help-divider-top">License</h4>
	<p><strong>This WordPress Plugin is comprised of two parts:</strong></p>
	<ol>
		<li>
			<p>The PHP code is licensed under the GPL license as is WordPress itself: <a href="http://wordpress.org/about/gpl/" title="GNU General Public License">http://wordpress.org/about/gpl</a></p>
		</li>
		<li>
			<p>All other parts of the plugin including, but not limited to, the CSS code, images, language files and design are licensed according to the license purchased at CodeCanyon: <a href="http://codecanyon.net/licenses/regular_extended" title="Regular &amp; Extended License | CodeCanyon">http://codecanyon.net/licenses/regular_extended</a></p>
		</li>
	</ol>

	<h4 class="socialbox-help-divider-top">Third-Party Components</h4>

	<p><strong>This WordPress plugin makes use of Third-Party work:</strong></p>
	<ol>
		<li>
			<p><strong>Social Media Icons</strong><br/>
			By <a href="http://komodomedia.com">Rogie King</a>. Licensed under a <a href="http://www.wtfpl.net/">WTFPL License</a>.</p>
		</li>
	</ol>

	<h4 class="socialbox-help-divider-top">Copyright</h4>
	<p>
		<strong>SocialBox - Social WordPress Widget</strong><br/>
		Version 1.4.1<br/>
		&copy; 2011 - 2014 by <a href="http://codecanyon.net/user/jdpowered?ref=jdpowered" title="jdpowered on CodeCanyon">Jonas Döbertin</a>
	</p>

</div>