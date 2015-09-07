<div class="panel panel-default">
	<div class="panel-heading"><?php __('Add Ticket'); ?>	</div>
	<div class="panel-body">
	<?php echo $this->Form->create('Ticket');?>
		<?php
		echo $this->Form->input('name');
		echo $this->Form->input('notes');
		echo $this->Form->input('module');
		echo $this->Form->input('status');
		echo $this->Form->input('user_id');
		echo $this->Form->input('created_user_id');
	?>
	</br>
	<?php echo $this->Form->end(__('Submit', true));?>
	</div>
</div>
