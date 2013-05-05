<div class="queues form">
<?php echo $this->Form->create('Queue'); ?>
	<fieldset>
		<legend><?php echo __('Edit Queue'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('user_id');
		echo $this->Form->input('merchant_id');
		echo $this->Form->input('seats');
		echo $this->Form->input('optiontags');
		echo $this->Form->input('estimatedwaitsecs');
		echo $this->Form->input('cancelled');
		echo $this->Form->input('pinged');
		echo $this->Form->input('fulfilled');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Queue.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Queue.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Queues'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Merchants'), array('controller' => 'merchants', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Merchant'), array('controller' => 'merchants', 'action' => 'add')); ?> </li>
	</ul>
</div>
