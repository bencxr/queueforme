<div class="queues view">
<h2><?php  echo __('Queue'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($queue['Queue']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($queue['User']['id'], array('controller' => 'users', 'action' => 'view', $queue['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Merchant'); ?></dt>
		<dd>
			<?php echo $this->Html->link($queue['Merchant']['name'], array('controller' => 'merchants', 'action' => 'view', $queue['Merchant']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Seats'); ?></dt>
		<dd>
			<?php echo h($queue['Queue']['seats']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Optiontags'); ?></dt>
		<dd>
			<?php echo h($queue['Queue']['optiontags']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($queue['Queue']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($queue['Queue']['modified']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Estimatedwaitsecs'); ?></dt>
		<dd>
			<?php echo h($queue['Queue']['estimatedwaitsecs']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Cancelled'); ?></dt>
		<dd>
			<?php echo h($queue['Queue']['cancelled']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Pinged'); ?></dt>
		<dd>
			<?php echo h($queue['Queue']['pinged']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Fulfilled'); ?></dt>
		<dd>
			<?php echo h($queue['Queue']['fulfilled']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Queue'), array('action' => 'edit', $queue['Queue']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Queue'), array('action' => 'delete', $queue['Queue']['id']), null, __('Are you sure you want to delete # %s?', $queue['Queue']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Queues'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Queue'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Merchants'), array('controller' => 'merchants', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Merchant'), array('controller' => 'merchants', 'action' => 'add')); ?> </li>
	</ul>
</div>
