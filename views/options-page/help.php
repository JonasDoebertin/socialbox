<?php if(!defined('ABSPATH')) die('Direct access is not allowed.');


/*
 * SocialBox 1.6.3
 * Copyright by Jonas Döbertin
 * Available only at CodeCanyon: http://codecanyon.net/item/socialbox-social-wordpress-widget/627127
 */


?>

<div class="socialbox-help-header">
	<div class="socialbox-help-title">
		<h3><?php _e('Welcome to SocialBox', 'socialbox'); ?> <?php echo JD_SOCIALBOX_VERSION ?>!</h3>
		<p><?php _e('Here you can find some help to get you started:', 'socialbox'); ?></p>
	</div>
	<div class="socialbox-help-column-container">
		<div class="socialbox-help-column">
			<h4><?php _e('Covered Topics', 'socialbox'); ?></h4>
			<ol>
				<li><a href="#socialbox-quick-setup" data-scroll><?php _e('Quick Setup', 'socialbox'); ?></a></li>
				<li><a href="#socialbox-widget-options" data-scroll><?php _e('Widget Options', 'socialbox'); ?></a></li>
				<li><a href="#socialbox-network-options" data-scroll><?php _e('Social Network Options', 'socialbox'); ?></a></li>
			</ol>
		</div>
		<div class="socialbox-help-column">
			<h4><?php _e('Additional Cache Tools', 'socialbox'); ?></h4>
			<ul>
				<li><i class="socialbox-icon-refresh"></i> <a href="#" class="js-socialbox-cache-refresh"><?php _e('Update cache', 'socialbox'); ?></a></li>
				<li><i class="socialbox-icon-contents"></i> <a href="#" class="js-socialbox-cache-show"><?php _e('Show contents', 'socialbox'); ?></a></li>
				<li><i class="socialbox-icon-clear"></i> <a href="#" class="js-socialbox-cache-clear"><?php _e('Clear cache', 'socialbox'); ?></a></li>
			</ul>
		</div>
		<div class="socialbox-help-column">
			<h4><?php _e('Further Help', 'socialbox'); ?></h4>
			<ul>
				<!--<li><i class="socialbox-icon-knowledge"></i> Visit the <a href="#">knowledge base</a></li>-->
				<li><i class="socialbox-icon-tweet"></i> <?php printf(__('Send a %s tweet %s', 'socialbox'), '<a href="https://twitter.com/intent/tweet?text=@DieserJonas">', '</a>'); ?></li>
				<li><i class="socialbox-icon-ticket"></i> <?php printf(__('Open a %s support ticket %s', 'socialbox'), '<a href="http://codecanyon.net/user/jdpowered#contact">', '</a>'); ?></li>
			</ul>
		</div>
	</div>
</div>

<div class="socialbox-help-section--quick" id="socialbox-quick-setup">
	<h3><?php _e('Quick Setup', 'socialbox'); ?></h3>

	<p><?php _e('There is really not much to it. Just follow these simple steps:', 'socialbox'); ?></p>
	<ol>
		<li><p><?php _e('Install and activate the SocialBox plugin (by the time you\'re reading this, you\'ve already completed this step).', 'socialbox'); ?></p></li>
		<li><p><?php printf(__('Head over to %s Appearance &raquo; Widgets %s and drag a SocialBox widget from the &raquo;Available Widgets&laquo; section to your desired widget area or sidebar.', 'socialbox'), '<a href="widgets.php">', '</a>'); ?></p></li>
		<li><p><?php _e('Enter the usernames and credentials for the social networks you want to show up.', 'socialbox'); ?></p></li>
		<li><p><?php _e('Finally, hit &raquo;Save&laquo;. That\'s about it!', 'socialbox'); ?></p></li>
	</ol>
</div>

<div class="socialbox-help-section--widget" id="socialbox-widget-options">
	<h3><?php _e('Widget Options', 'socialbox'); ?></h3>

	<img class="socialbox-help-image--center" src="<?php echo JD_SOCIALBOX_URL ?>/assets/img/help/general-settings.png" alt="General Settings" />

	<h4><?php _e('Open Links in new Window/Tab', 'socialbox'); ?></h4>
	<p><?php _e('This option adds <code>target="_blank"</code> to all links within SocialBox. This forces the browser to open them in a new window or tab. This way, a user doesn\'t have to leave your page when clicking on a &raquo;Follow&laquo; or &raquo;Subscribe&laquo; button.', 'socialbox'); ?></p>

	<h4><?php _e('Show Buttons', 'socialbox'); ?></h4>
	<p><?php _e('Choose if you want to display the &raquo;Follow&laquo; or &raquo;Subscribe&laquo; buttons within SocialBox. Please note that some of the styles don\'t include buttons. In case you selected one of these styles, this option has no effect.', 'socialbox'); ?></p>

	<h4><?php _e('Use Compact Numbers', 'socialbox'); ?></h4>
	<p><?php _e('When this option has been activated, the numbers within SocialBox will be dispay in a compact form. For example, the value <code>35.442</code> will be displayed as <code>35K</code>.', 'socialbox'); ?></p>

	<img class="socialbox-help-image--center" src="<?php echo JD_SOCIALBOX_URL ?>/assets/img/help/additional-settings.png" alt="Additional Settings" />

	<h4><?php _e('Forced Widget Width', 'socialbox'); ?></h4>
	<p><?php _e('If you set this something other than <code>0</code>, the SocialBox widget will be forced into the specified size. This is useful if your sidebar or widget area is too narrow or too wide.', 'socialbox'); ?></p>

	<h4><?php _e('Forced Button Width', 'socialbox'); ?></h4>
	<p><?php _e('If set to something other than <code>0</code>, all &raquo;Follow&laquo; and &raquo;Subscribe&laquo; buttons will be forced to be of this size. Use this option if you want to see consistent buttons (the captions will be centered).', 'socialbox'); ?></p>
</div>

<div class="socialbox-help-section--networks" id="socialbox-network-options">
	<h3><?php _e('Social Network Options', 'socialbox'); ?></h3>

	<img class="socialbox-help-image--center" src="<?php echo JD_SOCIALBOX_URL ?>/assets/img/help/generic-network.png" alt="Generic Network Settings" />
	<p><?php _e('For most of the networks available within SocialBox, the plugin only needs the username of the account that shall be showcased. However, some networks connections do require some more bits and pieces. You\'ll learn about these in the following sections.', 'socialbox'); ?></p>

	<h4><?php _e('Default', 'socialbox'); ?></h4>
	<p><?php _e('For each network you have the option to set a default value. If the related API is not reachable temporarely or if SocialBox is unable to pull in the numbers for any other reason, this default value will be displayed. We suggest to always set a reasonable default slightly less than your actual value.', 'socialbox'); ?></p>

	<h4><?php _e('Position', 'socialbox'); ?></h4>
	<p><?php _e('Of course you want to be able to change the order of the social networks within the SocialBox widget. Well, this option let\'s you do so. The social networks will be order by this number from small (top) to large (bottom).', 'socialbox'); ?></p>

	<img class="socialbox-help-image--center" src="<?php echo JD_SOCIALBOX_URL ?>/assets/img/help/facebook-settings.png" alt="Facebook Settings" />
	<h4><?php _e('Page ID or Shortname', 'socialbox'); ?></h4>
	<p><?php _e('In order to pull in Facebook statistics, the only thing you need to enter is your pages shortname or id. If your page has an url like <code>https://www.facebook.com/envato</code>, then <code>envato</code>is the shortname you\'d want to enter.', 'socialbox'); ?></p>

	<h4><?php _e('Metric', 'socialbox'); ?></h4>
	<p><?php _e('Typically, you\'d want to display the number of &raquo;Likes&laquo; your page collected. But, if your page belongs to a place (a restaurant, a retail store, a club, etc.) you can choose to display the number of &raquo;Checkins&laquo; instead.', 'socialbox'); ?></p>

	<img class="socialbox-help-image--center" src="<?php echo JD_SOCIALBOX_URL ?>/assets/img/help/twitter-settings.png" alt="Twitter Settings" />
	<h4><?php _e('Username', 'socialbox'); ?></h4>
	<p><?php _e('Please enter the username of the account you want to showcase (without the &raquo;@&laquo;). This does not have to be your own account; any public account goes.', 'socialbox'); ?></p>

	<h4><?php _e('API Key &amp; Secret, Access Token &amp; Secret', 'socialbox'); ?></h4>
	<p><?php _e('Pulling in the numbers from Twitter is a little more work than for the other social networks. Since Twitter doesn\'t allow public access to it\'s API, you have to set up your own application to use with the Twitter API. To do so, just follow these simple steps:', 'socialbox'); ?></p>
	<ol>
		<li><p><?php printf(__('Visit %s Twitter Developers %s and sign in with your Twitter account.', 'socialbox'), '<a href="https://dev.twitter.com/">', '</a>'); ?></p></li>
		<li><p><?php printf(__('Go to %s My Applications %s and click &raquo;Create a new Application&laquo;.', 'socialbox'), '<a href="https://apps.twitter.com/">', '</a>'); ?></p></li>
		<li><p><?php _e('Enter any value for &raquo;Name&laquo;, &raquo;Description&laquo; and &raquo;Website&laquo;, agree to the &raquo;Developer Rules&laquo; and click &raquo;Create your Twitter application&laquo;.', 'socialbox'); ?></p></li>
		<li><p><?php _e('At the top of the apps overview page navigate to the &raquo;API Keys&laquo; tab.', 'socialbox'); ?></p></li>
		<li><p><?php _e('At the bottom of the page click &raquo;Create my access token&laquo;.', 'socialbox'); ?></p></li>
		<li><p><?php _e('Copy the &raquo;API Key&laquo;, &raquo;API Secret&laquo;, &raquo;Access Token&laquo; and &raquo;Access Token Secret&laquo; values and enter them in the respective fields within SocialBox.', 'socialbox'); ?></p></li>
	</ol>

	<img class="socialbox-help-image--center" src="<?php echo JD_SOCIALBOX_URL ?>/assets/img/help/youtube-settings.png" alt="Youtube Settings" />
	<h4><?php _e('Channel', 'socialbox'); ?></h4>
	<p><?php _e('Please enter the name of the channel you want to showcase. If your channels url was like <code>https://www.youtube.com/user/envato</code>, then <code>envato</code>is the name you\'d have to enter.', 'socialbox'); ?></p>

	<img class="socialbox-help-image--center" src="<?php echo JD_SOCIALBOX_URL ?>/assets/img/help/vimeo-settings.png" alt="Vimeo Settings" />
	<h4><?php _e('Channel', 'socialbox'); ?></h4>
	<p><?php _e('Again, please enter the name of the <strong>channel</strong> you want to showcase. If your channels url was <code>http://vimeo.com/channels/vimeohq/</code>, then please enter <code>vimeohq</code>.', 'socialbox'); ?></p>
    <h4><?php _e('Metric', 'socialbox'); ?></h4>
    <p><?php _e('Maybe you don\'t want to show how many followers your channel has but how many videos where posted to it? Well, you can choose here.', 'socialbox'); ?></p>

	<img class="socialbox-help-image--center" src="<?php echo JD_SOCIALBOX_URL ?>/assets/img/help/instagram-settings.png" alt="Instagram Settings" />
	<h4><?php _e('Username', 'socialbox'); ?></h4>
	<p><?php _e('Please enter the username of the account you want to showcase. This does not have to be your own account; any public account goes.', 'socialbox'); ?></p>

	<h4><?php _e('User ID', 'socialbox'); ?></h4>
	<p><?php printf(__('In order to function correctly, SocialBox needs both your username <strong>and</strong> your user id. You can use this helpful tool, if you don\'t know your user id yet: %s Instagram User Id Lookup Tool %s.', 'socialbox'), '<a href="http://jelled.com/instagram/lookup-user-id">', '</a>'); ?></p>

	<h4><?php _e('Client ID', 'socialbox'); ?></h4>
	<p><?php _e('Like with Twitter, pulling in the numbers from Instagram is a little more complex. Since Instagram doesn\'t allow public access to their API, you have to set up your own application to use with the Instagram API. To do so, just follow these simple steps:', 'socialbox'); ?></p>
	<ol>
		<li><p><?php printf(__('Visit %s Instagram Developer %s and log in with your Instagram account.', 'socialbox'), '<a href="http://instagram.com/developer/">', '</a>'); ?></p></li>
		<li><p><?php printf(__('Go to %s Register new Client ID %s, enter any value for &raquo;Name&laquo;, &raquo;Description&laquo;, &raquo;Website&laquo; and &raquo;OAuth Redirect URI&laquo; and click &raquo;Register&laquo;.', 'socialbox'), '<a href="http://instagram.com/developer/clients/register/">', '</a>'); ?></p></li>
		<li><p><?php _e('Copy the &raquo;Client ID&laquo; value and paste it in the respective field within SocialBox.', 'socialbox'); ?></p></li>
	</ol>

    <img class="socialbox-help-image--center" src="<?php echo JD_SOCIALBOX_URL ?>/assets/img/help/pinterest-settings.png" alt="Pinterest Settings" />
    <h4><?php _e('Username', 'socialbox'); ?></h4>
    <p><?php _e('Please enter the username of the account you want to showcase.', 'socialbox'); ?></p>

    <h4><?php _e('Metric', 'socialbox'); ?></h4>
    <p><?php _e('You can choose to display your number of followers, pins or boards.', 'socialbox'); ?></p>

	<img class="socialbox-help-image--center" src="<?php echo JD_SOCIALBOX_URL ?>/assets/img/help/dribbble-settings.png" alt="Dribbble Settings" />
	<h4><?php _e('Username', 'socialbox'); ?></h4>
	<p><?php _e('Please enter the username of the account you want to showcase.', 'socialbox'); ?></p>

    <h4><?php _e('Metric', 'socialbox'); ?></h4>
    <p><?php _e('Not only can you display the number of followers you have. You can also choose to display the number of Shots you posted or how many Likes, Comments & Rebounds you received.', 'socialbox'); ?></p>

	<img class="socialbox-help-image--center" src="<?php echo JD_SOCIALBOX_URL ?>/assets/img/help/forrst-settings.png" alt="Forrst Settings" />
	<h4><?php _e('Username', 'socialbox'); ?></h4>
	<p><?php _e('Please enter the username of the account you want to showcase.', 'socialbox'); ?></p>

	<img class="socialbox-help-image--center" src="<?php echo JD_SOCIALBOX_URL ?>/assets/img/help/github-settings.png" alt="GitHub Settings" />
	<h4><?php _e('Username', 'socialbox'); ?></h4>
	<p><?php _e('Please enter the username of the account you want to showcase.', 'socialbox'); ?></p>

    <img class="socialbox-help-image--center" src="<?php echo JD_SOCIALBOX_URL ?>/assets/img/help/mailchimp-settings.png" alt="MailChimp Settings" />
    <h4><?php _e('List ID', 'socialbox'); ?></h4>
    <p><?php _e('Please enter the ID of the list you want to showcase. You can find the List ID on the this page: Lists &raquo; <strong>Your List</strong> &raquo; Settings &raquo; List name & defaults&laquo;', 'socialbox'); ?></p>

    <h4><?php _e('API Key', 'socialbox'); ?></h4>
    <p><?php _e('Pulling in the numbers from MailChimp needs some more steps than simply entering your List ID. Since MailChimp doesn\'t allow public access to it\'s lists, you need to set up an API Key first.', 'socialbox'); ?></p>
    <ol>
        <li><p><?php printf(__('Visit %s MailChimp %s and log in with your account credentials.', 'socialbox'), '<a href="https://admin.mailchimp.com.com/">', '</a>'); ?></p></li>
        <li><p><?php printf(__('Go to %s Your Account &raquo; Extras &raquo; API keys %s and click &raquo;Create A Key&laquo;. A new API Key will be generated and added to the list.', 'socialbox'), '<a href="https://admin.mailchimp.com/account/api/">', '</a>'); ?></p></li>
    </ol>

    <h4><?php _e('Subscription Form URL', 'socialbox'); ?></h4>
    <p><?php _e('Enter the URL of your subscription form or any other website. The email icon and the &raquo;Subscribe&laquo; button will link here.', 'socialbox'); ?></p>

</div>
