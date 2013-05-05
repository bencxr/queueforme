<div class="merchants view">
<h2><?php  echo __('Merchant'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($merchant['Merchant']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($merchant['Merchant']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Shortname'); ?></dt>
		<dd>
			<?php echo h($merchant['Merchant']['shortname']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Address'); ?></dt>
		<dd>
			<?php echo h($merchant['Merchant']['address']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Phonenumber'); ?></dt>
		<dd>
			<?php echo h($merchant['Merchant']['phonenumber']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Website'); ?></dt>
		<dd>
			<?php echo h($merchant['Merchant']['website']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Tableoptions'); ?></dt>
		<dd>
			<?php echo h($merchant['Merchant']['tableoptions']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Imageurl'); ?></dt>
		<dd>
			<?php echo h($merchant['Merchant']['imageurl']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Facebookid'); ?></dt>
		<dd>
			<?php echo h($merchant['Merchant']['facebookid']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($merchant['Merchant']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($merchant['Merchant']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Merchant'), array('action' => 'edit', $merchant['Merchant']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Merchant'), array('action' => 'delete', $merchant['Merchant']['id']), null, __('Are you sure you want to delete # %s?', $merchant['Merchant']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Merchants'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Merchant'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Queues'), array('controller' => 'queues', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Queue'), array('controller' => 'queues', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Queues'); ?></h3>
	<?php if (!empty($merchant['Queue'])): ?>
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
		foreach ($merchant['Queue'] as $queue): ?>
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
<div class="related">
	<h3><?php echo __('Related Users'); ?></h3>
	<?php if (!empty($merchant['User'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Merchant Id'); ?></th>
		<th><?php echo __('Username'); ?></th>
		<th><?php echo __('Password'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th><?php echo __('Fullname'); ?></th>
		<th><?php echo __('Signupsource'); ?></th>
		<th><?php echo __('Fbid'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($merchant['User'] as $user): ?>
		<tr>
			<td><?php echo $user['id']; ?></td>
			<td><?php echo $user['merchant_id']; ?></td>
			<td><?php echo $user['username']; ?></td>
			<td><?php echo $user['password']; ?></td>
			<td><?php echo $user['created']; ?></td>
			<td><?php echo $user['modified']; ?></td>
			<td><?php echo $user['fullname']; ?></td>
			<td><?php echo $user['signupsource']; ?></td>
			<td><?php echo $user['fbid']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'users', 'action' => 'view', $user['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'users', 'action' => 'edit', $user['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'users', 'action' => 'delete', $user['id']), null, __('Are you sure you want to delete # %s?', $user['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
