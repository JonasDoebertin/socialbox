<?php if(!defined('ABSPATH')) die('Direct access is not allowed.');


/*
	Get log entries
 */
$log = $this->getLog();


?>

<div class="socialbox-log  socialbox-options">

	<!-- Heading -->
	<div class="socialbox-options__section socialbox-options__section--header">
		<h3><?php _e('Debug Tools', 'socialbox') ?></h3>
		<p class="socialbox-options__section__description"><?php _e('See what\'s going on under the hood!', 'socialbox') ?></p>
	</div>

	<!-- Log -->
	<div class="socialbox-options__section  socialbox-log__lines">
		<h3><?php _e('API Log', 'socialbox') ?></h3>
		<p class="socialbox-options__section__description"><?php _e('Just like you\'d propably guessed, green means everything went well while red indicates that some kind of error occured while fetching the value.', 'socialbox') ?></p>
		<?php $alternate = false; ?>
		<?php foreach($log as $entry): ?>
			<p class="socialbox-log__line <?php echo $entry->level ?> <?php if($alternate) echo 'alternate' ?>">
				<span>[<?php echo date('d-M-Y H:i:s T', $entry->timestamp) ?>]</span>
				<?php echo $entry->message ?>
				<?php if(isset($entry->context['exception'])): ?>
					<span class="socialbox-log__line__context  js-socialbox-context  dashicons  dashicons-info" data-type="<?php echo $entry->context['exception']['type'] ?>" data-message="<?php echo htmlspecialchars($entry->context['exception']['message']) ?>"></span>
				<?php endif ?>
			</p>
			<?php $alternate = !$alternate; ?>
		<?php endforeach ?>
	</div>

</div>
