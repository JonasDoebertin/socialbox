<?php if(!defined('ABSPATH')) die('Direct access is not allowed.');


/*
 * SocialBox 1.4.1
 * Copyright by Jonas Döbertin
 * Available only at CodeCanyon: http://codecanyon.net/item/socialbox-social-wordpress-widget/627127
 */


?>

<div class="socialbox-help-header">
	<div class="socialbox-help-title">
		<h3>Welcome to SocialBox!</h3>
		<p>Here you can find some help to get you started:</p>
	</div>
	<div class="socialbox-help-column-container">
		<div class="socialbox-help-column">
			<h4>Covered Topics</h4>
			<ol>
				<li><a href="#socialbox-quick-setup">Quick Setup</a></li>
				<li><a href="#socialbox-widget-options">Widget Options</a></li>
				<li><a href="#">Social Network Setup</a></li>
			</ol>
		</div>
		<div class="socialbox-help-column">
			<h4>Additional Tools</h4>
		</div>
		<div class="socialbox-help-column">
			<h4>Further Help</h4>
			<ul>
				<li>Visit the <a href="#">knowledge base</a></li>
				<li>Send a <a href="https://twitter.com/intent/tweet?text=@DieserJonas">Tweet</a></li>
				<li>Open a <a href="http://codecanyon.net/user/jdpowered#contact">support ticket</a></li>
			</ul>
		</div>
	</div>
</div>

<div class="socialbox-help-section--quick" id="socialbox-quick-setup">
	<h3>Quick Setup</h3>
	
	<p>There is really not much to it. Just follow these simple steps:</p>
	<ol>
		<li><p>Install and activate the SocialBox plugin (by the time you're reading this, you've already completed this step).</p></li>
		<li><p>Head over to <a href="widgets.php">Appearance &raquo; Widgets</a> and drag a SocialBox widget from the »Available Widgets« section to your desired widget area or sidebar.</p></li>
		<li><p>Enter the usernames and credentials for the social networks you want to show up.</p></li>
		<li><p>Finally, hit »Save«. That's about it!</p></li>
	</ol>
</div>

<div class="socialbox-help-section--widget" id="socialbox-widget-options">
	<h3>Widget Options</h3>
	
	<img class="socialbox-help-image--center" src="<?php echo JD_SOCIALBOX_URL ?>/assets/img/help/general-settings.png" alt="General Settings" />
	
	<h4>Open Links in new Window/Tab</h4>
	<p>This option adds <code>target="_blank"</code> to all links within SocialBox. This forces the browser to open them in a new window or tab. This way, a user doesn't have to leave your page when clicking on a &raquo;Follow&laquo; or &raquo;Subscribe&laquo; button.</p>

	<h4>Show Buttons</h4>
	<p>Choose if you want to display the &raquo;Follow&laquo; or &raquo;Subscribe&laquo; buttons within SocialBox. Please note that some of the styles don't include buttons. In case you selected one of these styles, this option has no effect.</p>

	<h4>Use Compact Numbers</h4>
	<p>When this option has been activated, the numbers within SocialBox will be dispay in a compact form. For example, the value <code>35.442</code> will be displayed as <code>35K</code>.</p>

	<img class="socialbox-help-image--center" src="<?php echo JD_SOCIALBOX_URL ?>/assets/img/help/additional-settings.png" alt="Additional Settings" />

	<h4>Forced Widget Width</h4>
	<p>If you set this something other than <code>0</code>, the SocialBox widget will be forced into the specified size. This is useful if your sidebar or widget area is too narrow or too wide.</p>

	<h4>Forced Button Width</h4>
	<p>If set to something other than <code>0</code>, all &raquo;Follow&laquo; and &raquo;Subscribe&laquo; buttons will be forced to be of this size. Use this option if you want to see consistent buttons (the captions will be centered).</p>
</div>






<div class="socialbox-wrap">

	

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

		<dt><?php echo __('Instagram', 'socialbox'); ?></dt>
		<dd>
			<?php _e('Please enter your regular Instagram username as the username.', 'socialbox'); ?><br/>
			<?php _e('To get your User ID visit: ', 'socialbox') ?><a href="http://jelled.com/instagram/lookup-user-id">Instagram User Id Lookup Tool</a><br/>
			<?php _e('To maintain your Client ID, follow these steps:', 'socialbox') ?>
			<ol>
				<li><p><?php _e('Visit <a href="http://instagram.com/developer/clients/register/">Register new Client ID</a> at Instagram and sign in with your Instagram account.', 'socialbox'); ?></p></li>
				<li><p><?php _e('Enter a random application name, a brief description and your website (also as OAuth redirect URI). Then click "Register". ', 'socialbox'); ?></p></li>
				<li><p><?php _e('Copy the "Client ID" and enter it in the respective field.', 'socialbox'); ?></p></li>
			</ol>
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