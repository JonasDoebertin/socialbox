<?php if(!defined('ABSPATH')) die('Direct access is not allowed.');


/*
 * SocialBox 1.4.1
 * Copyright by Jonas Döbertin
 * Available only at CodeCanyon: http://codecanyon.net/item/socialbox-social-wordpress-widget/627127
 */


?>

<div class="socialbox-help-header">
	<div class="socialbox-help-title">
		<h3>Welcome to SocialBox <?php echo JD_SOCIALBOX_VERSION ?>!</h3>
		<p>Here you can find some help to get you started:</p>
	</div>
	<div class="socialbox-help-column-container">
		<div class="socialbox-help-column">
			<h4>Covered Topics</h4>
			<ol>
				<li><a href="#socialbox-quick-setup">Quick Setup</a></li>
				<li><a href="#socialbox-widget-options">Widget Options</a></li>
				<li><a href="#socialbox-network-options">Social Network Options</a></li>
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

<div class="socialbox-help-section--networks" id="socialbox-network-options">
	<h3>Social Network Options</h3>

	<img class="socialbox-help-image--center" src="<?php echo JD_SOCIALBOX_URL ?>/assets/img/help/generic-network.png" alt="Generic Network Settings" />
	<p>For most of the networks available within SocialBox, the plugin only needs the username of the account that shall be showcased. However, some networks connections do require some more bits and pieces. You'll learn about these in the following sections.</p>

	<h4>Default</h4>
	<p>For each network you have the option to set a default value. If the related API is not reachable temporarely or if SocialBox is unable to pull in the numbers for any other reason, this default value will be displayed. We suggest to always set a reasonable default slightly less than your actual value.</p>

	<h4>Position</h4>
	<p>Of course you want to be able to change the order of the social networks within the SocialBox widget. Well, this option let's you do so. The social networks will be order by this number from small (top) to large (bottom).</p>

	<img class="socialbox-help-image--center" src="<?php echo JD_SOCIALBOX_URL ?>/assets/img/help/facebook-settings.png" alt="Facebook Settings" />
	<h4>Page ID or Shortname</h4>
	<p>In order to pull in Facebook statistics, the only thing you need to enter is your pages shortname or id. If your page has an url like <code>https://www.facebook.com/envato</code>, then <code>envato</code>is the shortname you'd want to enter.</p>

	<h4>Metric</h4>
	<p>Typically, you'd want to display the number of &raquo;Likes&laquo; your page collected. But, if your page belongs to a place (a restaurant, a retail store, a club, etc.) you can choose to display the number of &raquo;Checkins&laquo; instead.</p>

	<img class="socialbox-help-image--center" src="<?php echo JD_SOCIALBOX_URL ?>/assets/img/help/twitter-settings.png" alt="Twitter Settings" />
	<h4>Username</h4>
	<p>Please enter the username of the account you want to showcase (without the &raquo;@&laquo;). This does not have to be your own account; any public account goes.</p>

	<h4>API Key &amp; Secret, Access Token &amp; Secret</h4>
	<p>Pulling in the numbers from Twitter is a little more work than for the other social networks. Since Twitter doesn't allow public access to it's API, you have to set up your application with the Twitter API. To do so, just follow these simple steps:</p>
	<ol>
		<li><p>Visit <a href="https://dev.twitter.com/">Twitter Developers</a> and sign in with your Twitter account.</p></li>
		<li><p>Go to <a href="https://apps.twitter.com/">My Applications</a> and click &raquo;Create a new Application&laquo;.</p></li>
		<li><p>Enter any value for &raquo;Name&laquo;, &raquo;Description&laquo; and &raquo;Website&laquo;, agree to the &raquo;Developer Rules&laquo; and click &raquo;Create your Twitter application&laquo;.</p></li>
		<li><p>At the top of the apps overview page navigate to the &raquo;API Keys&laquo; tab.</p></li>
		<li><p>At the bottom of the page click &raquo;Create my access token&laquo;.</p></li>
		<li><p>Copy the &raquo;API Key&laquo;, &raquo;API Secret&laquo;, &raquo;Access Token&laquo; and &raquo;Access Token Secret&laquo; values and enter them in the respective fields within SocialBox.</p></li>
	</ol>

	<img class="socialbox-help-image--center" src="<?php echo JD_SOCIALBOX_URL ?>/assets/img/help/youtube-settings.png" alt="Youtube Settings" />
	<h4>Channel</h4>
	<p>Please enter the name of the channel you want to showcase. If your channels url was like <code>https://www.youtube.com/user/envato</code>, then <code>envato</code>is the name you'd have to enter.</p>

</div>






<div class="socialbox-wrap">

	

	
	<h4 class="socialbox-help-divider-top"><?php _e('Specific Network Options', 'socialbox'); ?></h4>
	<dl>

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