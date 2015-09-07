<div class="panel panel-default">
	<div class="panel-heading"><?php __('Edit Receivable'); ?>	</div>
	<div class="panel-body">
	<?php echo $this->Form->create('Receivable');?>
		<?php
		echo $this->Form->input('id');
		echo $this->Form->input('sale_id');
		echo $this->Form->input('contact_id');
		echo $this->Form->input('invoice_number');
		echo $this->Form->input('overdue_date');
		echo $this->Form->input('amount');
		echo $this->Form->input('paid');
		echo $this->Form->input('user_id');
		echo $this->Form->input('currency_id');
	?>
	</br>
	<?php echo $this->Form->end(__('Submit', true));?>
	</div>
</div>
