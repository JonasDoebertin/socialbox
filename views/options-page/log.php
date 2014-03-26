<?php if(!defined('ABSPATH')) die('Direct access is not allowed.');


/*
 * SocialBox 1.4.0
 * Copyright by Jonas Döbertin
 * Available only at CodeCanyon: http://codecanyon.net/item/socialbox-social-wordpress-widget/627127
 */


/* Get the log entries */
$log = $this->getLog();


?>

<div class="socialbox-wrap socialbox-log">
	<table class="wp-list-table widefat" cellspacing="0">
		<thead>
			<tr>
				<th scope="col" class="socialbox-time-column"><?php _e('Time', 'socialbox'); ?></th>
				<th scope="col" class="socialbox-network-column"><?php _e('Network', 'socialbox'); ?></th>
				<th scope="col" class="socialbox-user-column"><?php _e('Username/ID', 'socialbox'); ?></th>
			</tr>
		</thead>
		<tfoot>
			<tr>
				<th scope="col"><?php _e('Time', 'socialbox'); ?></th>
				<th scope="col"><?php _e('Network', 'socialbox'); ?></th>
				<th scope="col"><?php _e('Userame/ID', 'socialbox'); ?></th>
			</tr>
		</tfoot>
		<tbody>

			<?php if( (empty($log) or (count($log) == 0)) ): ?>

				<tr>
					<td colspan="3" class="empty-log"><?php _e('Set up or resave a SocialBox widget first...', 'socialbox'); ?></td>
				</tr>

			<?php else: ?>

				<?php $alternate = true; ?>
				<?php foreach($log as $entry): ?>
					
					<tr class="<?php echo ($entry['successful']) ? 'success' : 'failed'; if($alternate) echo ' alternate'; ?>" >
						<td><?php echo date(__('Y/m/d H:i:s', 'socialbox'), $entry['timestamp']); ?></td>
						<td><?php echo $entry['network']; ?></td>
						<td><?php echo $entry['id']; ?></td>
					</tr>

					<?php $alternate = !$alternate; ?>
				<?php endforeach; ?>

			<?php endif; ?>

		</tbody>
	</table>
</div>