<?php
/*
 * SocialBox v.1.3.0
 * Copyright by Jonas Doebertin
 * Available at CodeCanyon: http://codecanyon.net/item/socialbox-social-wordpress-widget/627127
 */

/* Get the log entries */
$log = $this->getLog();



?>

<div class="socialbox-wrap socialbox-log">

	<table class="wp-list-table widefat" cellspacing="0">
		
		<thead>
			<tr>
				<th scope="col" class="socialbox-time-column"><?php _e('Time', self::SLUG); ?></th>
				<th scope="col" class="socialbox-network-column"><?php _e('Network', self::SLUG); ?></th>
				<th scope="col" class="socialbox-user-column"><?php _e('Username/ID', self::SLUG); ?></th>
				<th scope="col" class="socialbox-code-column"><?php _e('Status Code', self::SLUG); ?></th>
				<th scope="col"><?php _e('Message', self::SLUG); ?></th>
			</tr>
		</thead>
		<tfoot>
			<tr>
				<th scope="col"><?php _e('Time', self::SLUG); ?></th>
				<th scope="col"><?php _e('Network', self::SLUG); ?></th>
				<th scope="col"><?php _e('Userame/ID', self::SLUG); ?></th>
				<th scope="col"><?php _e('Status Code', self::SLUG); ?></th>
				<th scope="col"><?php _e('Message', self::SLUG); ?></th>
			</tr>
		</tfoot>
		<tbody>
			
			<?php if( $this->getOption('enable_log') !== '1' ): ?>
				
				<tr>
					<td colspan="5" class="socialbox-disabled-log"><?php _e('The API log is disabled.', self::SLUG); ?></td>
				</tr>

			<?php elseif( (empty($log) or (count($log) == 0)) ): ?>

				<tr>
					<td colspan="5" class="socialbox-empty-log"><?php _e('Nothing found. Seems as if everything\'s running smoothly.', self::SLUG); ?></td>
				</tr>

			<?php else: ?>

				<?php $alternate = true; ?>
				<?php foreach($log as $entry): ?>
					
					<tr <?php if($alternate) echo 'class="alternate"'; ?> >
						<td><?php echo date(__('Y/m/d H:i:s', self::SLUG), $entry['timestamp']); ?></td>
						<td><?php echo $entry['network']; ?></td>
						<td><?php echo $entry['id']; ?></td>
						<td><?php echo $entry['status']; ?></td>
						<td><?php echo $entry['message']; ?></td>
					</tr>

					<?php $alternate = !$alternate; ?>
				<?php endforeach; ?>

			<?php endif; ?>

		</tbody>

	</table>

</div>