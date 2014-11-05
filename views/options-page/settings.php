<?php if(!defined('ABSPATH')) die('Direct access is not allowed.');


/*
 * SocialBox 1.7.0
 * Copyright by Jonas Döbertin
 * Available only at CodeCanyon: http://codecanyon.net/item/socialbox-social-wordpress-widget/627127
 */


?>

<div class="socialbox-settings  socialbox-options">

	<form method="post" action="options.php">
		<?php settings_fields('socialbox_options') ?>

		<!-- Heading -->
		<div class="socialbox-options__section socialbox-options__section--header">
			<h3><?php _e('Settings', 'socialbox') ?></h3>
			<p class="socialbox-options__section__description"><?php _e('This is the place, this is the time. Go ahead! Configure this!', 'socialbox') ?></p>
		</div>

		<!-- License -->
		<div class="socialbox-options__section">
			<h3><?php _e('License', 'socialbox') ?></h3>
			<p class="socialbox-options__section__description"><?php _e('Enter valid license information to enable automatic updates for SocialBox.', 'socialbox') ?></p>
			<table class="form-table">
				<?php do_settings_fields('socialbox', 'socialbox_license') ?>
			</table>
		</div>

		<!-- Advanced Settings -->
		<div class="socialbox-options__section">
			<h3><?php _e('Advanced Settings', 'socialbox') ?></h3>
			<p class="socialbox-options__section__description"><?php _e('With this set of options, you are able to tweak / modify some of the internals of SocialBox. Please use with care!', 'socialbox') ?></p>
			<table class="form-table">
				<?php do_settings_fields('socialbox', 'socialbox_advanced') ?>
			</table>
		</div>

		<?php submit_button() ?>

	</form>

</div>
