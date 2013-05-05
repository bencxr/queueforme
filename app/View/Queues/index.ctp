<div class="queues index">
	<h2><?php echo __('Queues'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('user_id'); ?></th>
			<th><?php echo $this->Paginator->sort('merchant_id'); ?></th>
			<th><?php echo $this->Paginator->sort('seats'); ?></th>
			<th><?php echo $this->Paginator->sort('optiontags'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th><?php echo $this->Paginator->sort('estimatedwaitsecs'); ?></th>
			<th><?php echo $this->Paginator->sort('cancelled'); ?></th>
			<th><?php echo $this->Paginator->sort('pinged'); ?></th>
			<th><?php echo $this->Paginator->sort('fulfilled'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($queues as $queue): ?>
	<tr>
		<td><?php echo h($queue['Queue']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($queue['User']['id'], array('controller' => 'users', 'action' => 'view', $queue['User']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($queue['Merchant']['name'], array('controller' => 'merchants', 'action' => 'view', $queue['Merchant']['id'])); ?>
		</td>
		<td><?php echo h($queue['Queue']['seats']); ?>&nbsp;</td>
		<td><?php echo h($queue['Queue']['optiontags']); ?>&nbsp;</td>
		<td><?php echo h($queue['Queue']['created']); ?>&nbsp;</td>
		<td><?php echo h($queue['Queue']['modified']); ?>&nbsp;</td>
		<td><?php echo h($queue['Queue']['estimatedwaitsecs']); ?>&nbsp;</td>
		<td><?php echo h($queue['Queue']['cancelled']); ?>&nbsp;</td>
		<td><?php echo h($queue['Queue']['pinged']); ?>&nbsp;</td>
		<td><?php echo h($queue['Queue']['fulfilled']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $queue['Queue']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $queue['Queue']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $queue['Queue']['id']), null, __('Are you sure you want to delete # %s?', $queue['Queue']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Queue'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Merchants'), array('controller' => 'merchants', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Merchant'), array('controller' => 'merchants', 'action' => 'add')); ?> </li>
	</ul>
</div>
