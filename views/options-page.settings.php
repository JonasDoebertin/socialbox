<?php
/*
 * SocialBox v.1.3.1
 * Copyright by Jonas Doebertin
 * Available only at CodeCanyon: http://codecanyon.net/item/socialbox-social-wordpress-widget/627127
 */
?>

<div class="socialbox-settings">

	<?php settings_errors(); ?>  

	<form method="post" action="options.php">
		<?php
			settings_fields(self::SLUG . '_options');
			do_settings_sections(self::SLUG);
			submit_button();
		?>
	</form>

</div> 