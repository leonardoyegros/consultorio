<div class="panel panel-default">
	<div class="panel-heading"><?php __('Edit Payable'); ?>	</div>
	<div class="panel-body">
	<?php echo $this->Form->create('Payable');?>
		<?php
		echo $this->Form->input('id');
		echo $this->Form->input('purchase_id');
		echo $this->Form->input('contact_id');
		echo $this->Form->input('invoice_number');
		echo $this->Form->input('overdue_date');
		echo $this->Form->input('total');
		echo $this->Form->input('paid');
	?>
	</br>
	<?php echo $this->Form->end(__('Submit', true));?>
	</div>
</div>
