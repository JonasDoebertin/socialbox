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