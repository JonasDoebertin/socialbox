<?php
/*
 * SocialBox v.1.3.0
 * Copyright by Jonas Doebertin
 * Available at CodeCanyon: http://codecanyon.net/item/socialbox-social-wordpress-widget/627127
 */
?>

<div class="socialbox-wrap">

	<div class="socialbox-help-contents">
			<h4>Table of Contents</h4>
			<ol>
				<li><p>Quick Setup</p></li>
				<li><p>General Widget Options</p></li>
				<li><p>General Network Options</p></li>
				<li><p>Additional Widget Options</p></li>
			</ol>
		</div>

	<p class="socialbox-help-description">
		For all further questions, please open a ticket at my support site: <a href="http://support.jonasdoebertin.net" title="Get support!">support.jonasdoebertin.net</a>
	</p>

	<h4 class="socialbox-help-divider-top">Quick Setup</h4>
	<p>There is really not much to it. Just follow these simple steps:</p>
	<ol>
		<li><p>Install and activate the Plugin. (by the time you're reading this, you've already completed this step)</p></li>
		<li><p>Head over to the <a href="widgets.php" title="Appearance > Widgets">Appearance > Widgets</a> Page, and drag a SocialBox Widget from the &raquo;Available Widgets&laquo; section to your desired Widget Area / Sidebar.</p></li>
		<li><p>Enter the Usernames / User IDs for the Social Networks you want to show up.</p></li>
		<li><p>And finally, hit &raquo;Save&laquo;. That's it!</p></li>
	</ol>

	<h4 class="socialbox-help-divider-top">General Widget Options</h4>
	<dl>
		<dt>Open Links in new Window/Tab </dt>
		<dd>If checked, the links to the networks profile pages (network icons and &raquo;Follow&laquo; buttons) will be open in a new window or tab.</dd>

		<dt>Show Buttons</dt>
		<dd>If checked, the Widget will show &raquo;Like&laquo; / &raquo;Follow&laquo; / &raquo;Subscribe&laquo; buttons for every listed network. These links will point to the profile pages for the configured User / Channel.</dd>

		<dt>Use Compact Numbers</dt>
		<dd>If checked, the Widget will display the numbers in a compact form. Instead of showing the complete numbers, it will use a shortened syntax using "K" and "M" to indicate "thousands" and "millions". As an example, 12.345 will display as 12K.</dd>
	</dl>

	<h4 class="socialbox-help-divider-top">General Network Options</h4>
	<dl>
		<dt>Default</dt>
		<dd>This value will be shown if, for some reason, the related API is not reachable or returns unexpected/funky results. It's allways a good idea to set these values for each configured network.</dd>

		<dt>Position</dt>
		<dd>The networks will be sorted by this numbers, from small (top) to large (bottom), and will be displayed in this order.</dd>
	</dl>

	<h4 class="socialbox-help-divider-top">Specific Network Options</h4>
	<dl>
		<dt><?php echo __('Facebook', self::SLUG) . ' ' . __('Page ID/Name', self::SLUG); ?></dt>
		<dd>
			Please enter your pages "Shortname" (the part of the URL after "facebook.com/".<br/>
			<img src="<?php $this->url('images/help/facebook-id.jpg'); ?>" /><br/>
			<strong>Note:</strong> SocialBox will only display the "Like" number, if access to your page is not restricted in any way (only certain Countries, etc.)
		</dd>

		<dt><?php echo __('Twitter', self::SLUG) . ' ' . __('Username', self::SLUG); ?></dt>
		<dd>
			Please enter your regular Twitter Username (without the @-symbol).<br/>
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
			Please enter your Channels "Shortname" (as seen in the URL).<br/>
			<img src="<?php $this->url('images/help/youtube-id.jpg'); ?>" /><br/>
		</dd>

		<dt><?php echo __('Vimeo', self::SLUG) . ' ' . __('Channel', self::SLUG); ?></dt>
		<dd>
			Please enter the Channels "shortname" (as seen in the URL).<br/>
			<img src="<?php $this->url('images/help/vimeo-id.jpg'); ?>" /><br/>
		</dd>

		<dt><?php echo __('Dribbble', self::SLUG) . ' ' . __('Username', self::SLUG); ?></dt>
		<dd>
			To display this number, please enter your Dribbble Username.<br/>
			<img src="<?php $this->url('images/help/dribbble-id.jpg'); ?>" /><br/>
		</dd>

		<dt><?php echo __('Forrst', self::SLUG) . ' ' . __('Username', self::SLUG); ?></dt>
		<dd>
			To display this number, please enter your Username (as seen in the URL).<br/>
			<strong>http://forrst.com/people/&lt;YOUR_USERNAME&gt;</strong>
		</dd>

		<dt><?php echo __('Digg', self::SLUG) . ' ' . __('Username', self::SLUG); ?></dt>
		<dd>
			To display this number, please enter your Shortname.<br/>
			<img src="<?php $this->url('images/help/digg-id.jpg'); ?>" /><br/>
		</dd>
		
		<dt><?php echo __('GitHub', self::SLUG) . ' ' . __('Username', self::SLUG); ?></dt>
		<dd>
			To display this number, please enter your Username.<br/>
			<strong>https://github.com/&lt;YOUR_USERNAME&gt;</strong>
		</dd>

	</dl>

	<h4 class="socialbox-help-divider-top">Additional Widget Options</h4>
	<dl>
		<dt>Forced Widget Width</dt>
		<dd>If set to somthing other than "0", this will force the Widget into the specified size. Use this, if your Sidebar / Widget Area is too narrow or too wide.</dd>

		<dt>Forced Button Width</dt>
		<dd>If set to something other than "0", this will force the "Follow" buttons (if enabled) into the specified width. Use this option, if you want to see consistent buttons (the captions will be centered).</dd>
	</dl>

</div>