<div class="panel panel-default">
	<div class="panel-heading"><?php __('Add Users Assigned User'); ?>	</div>
	<div class="panel-body">
	<?php echo $this->Form->create('UsersAssignedUser');?>
		<?php
		echo $this->Form->input('assigned_user_id');
		echo $this->Form->input('user_id');
	?>
	</br>
	<?php echo $this->Form->end(__('Submit', true));?>
	</div>
</div>
