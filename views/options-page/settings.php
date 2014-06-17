<?php if(!defined('ABSPATH')) die('Direct access is not allowed.');


/*
 * SocialBox 1.7.0
 * Copyright by Jonas Döbertin
 * Available only at CodeCanyon: http://codecanyon.net/item/socialbox-social-wordpress-widget/627127
 */


?>

<div class="socialbox-settings">

	<?php settings_errors(); ?>

	<form method="post" action="options.php">
		<?php
			settings_fields('socialbox_options');
			do_settings_sections('socialbox');
			submit_button();
		?>
	</form>

</div>
