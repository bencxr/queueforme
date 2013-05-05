<div class="merchants form">
<?php echo $this->Form->create('Merchant'); ?>
	<fieldset>
		<legend><?php echo __('Add Merchant'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('shortname');
		echo $this->Form->input('address');
		echo $this->Form->input('phonenumber');
		echo $this->Form->input('website');
		echo $this->Form->input('tableoptions');
		echo $this->Form->input('imageurl');
		echo $this->Form->input('facebookid');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Merchants'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Queues'), array('controller' => 'queues', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Queue'), array('controller' => 'queues', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
