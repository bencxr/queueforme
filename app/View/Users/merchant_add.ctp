<div class="users form">
<?php echo $this->Form->create('User',  array('type' => 'file')); ?>
	<fieldset>
		<legend><?php echo __('Add Merchant'); ?></legend>
	<?php
		echo $this->Form->input('username');
		echo $this->Form->input('password');
		echo $this->Form->input('fullname');
		echo $this->Form->input('Merchant.name');
		echo $this->Form->input('Merchant.shortname');
		echo $this->Form->input('Merchant.address');
		echo $this->Form->input('Merchant.phonenumber');
		echo $this->Form->input('Merchant.tableoptions');
		echo $this->Form->input('Merchant.imageurl', array('type' => 'file'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
