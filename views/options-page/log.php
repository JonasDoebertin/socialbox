<?php if(!defined('ABSPATH')) die('Direct access is not allowed.');


/*
	Get log entries
 */
$log = $this->getLog();


?>

<div class="socialbox-log">

	<?php $alternate = false; ?>
	<?php foreach($log as $entry): ?>
		<p class="socialbox-log__line <?php echo $entry->level ?> <?php if($alternate) echo 'alternate' ?>">
			<span>[<?php echo date('d-M-Y H:i:s T') ?>]</span>
			<?php echo $entry->message ?>
		</p>
		<?php $alternate = !$alternate; ?>
	<?php endforeach ?>

</div>
