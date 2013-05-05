<div class="merchants form">
<?php echo $this->Form->create('Merchant', array('type' => 'file')); ?>
	<fieldset>
		<legend><?php echo __('Edit Merchant'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('shortname');
		echo $this->Form->input('address');
		echo $this->Form->input('phonenumber');
		echo $this->Form->input('website');
		echo $this->Form->input('tableoptions');
        echo $this->Form->input('estimatedwaitpertablesecs', array('default' => '5'));
        echo $this->data["Merchant"]["imageurl"];
        echo $this->Form->input('imageurl', array('type' => 'file'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
