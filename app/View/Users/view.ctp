<div class="users view">
<h2><?php  echo __('User'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($user['User']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Merchant'); ?></dt>
		<dd>
			<?php echo $this->Html->link($user['Merchant']['name'], array('controller' => 'merchants', 'action' => 'view', $user['Merchant']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Username'); ?></dt>
		<dd>
			<?php echo h($user['User']['username']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Password'); ?></dt>
		<dd>
			<?php echo h($user['User']['password']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($user['User']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($user['User']['modified']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Fullname'); ?></dt>
		<dd>
			<?php echo h($user['User']['fullname']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Signupsource'); ?></dt>
		<dd>
			<?php echo h($user['User']['signupsource']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Fbid'); ?></dt>
		<dd>
			<?php echo h($user['User']['fbid']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit User'), array('action' => 'edit', $user['User']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete User'), array('action' => 'delete', $user['User']['id']), null, __('Are you sure you want to delete # %s?', $user['User']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Merchants'), array('controller' => 'merchants', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Merchant'), array('controller' => 'merchants', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Queues'), array('controller' => 'queues', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Queue'), array('controller' => 'queues', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Queues'); ?></h3>
	<?php if (!empty($user['Queue'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Merchant Id'); ?></th>
		<th><?php echo __('Seats'); ?></th>
		<th><?php echo __('Optiontags'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th><?php echo __('Estimatedwaitsecs'); ?></th>
		<th><?php echo __('Cancelled'); ?></th>
		<th><?php echo __('Pinged'); ?></th>
		<th><?php echo __('Fulfilled'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($user['Queue'] as $queue): ?>
		<tr>
			<td><?php echo $queue['id']; ?></td>
			<td><?php echo $queue['user_id']; ?></td>
			<td><?php echo $queue['merchant_id']; ?></td>
			<td><?php echo $queue['seats']; ?></td>
			<td><?php echo $queue['optiontags']; ?></td>
			<td><?php echo $queue['created']; ?></td>
			<td><?php echo $queue['modified']; ?></td>
			<td><?php echo $queue['estimatedwaitsecs']; ?></td>
			<td><?php echo $queue['cancelled']; ?></td>
			<td><?php echo $queue['pinged']; ?></td>
			<td><?php echo $queue['fulfilled']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'queues', 'action' => 'view', $queue['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'queues', 'action' => 'edit', $queue['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'queues', 'action' => 'delete', $queue['id']), null, __('Are you sure you want to delete # %s?', $queue['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Queue'), array('controller' => 'queues', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
