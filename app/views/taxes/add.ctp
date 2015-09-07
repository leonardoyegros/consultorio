<div class="panel panel-default">
	<div class="panel-body">
	<?php echo $this->Form->create('Tax');?>
		<?php
		echo $this->Form->input('name', array('class'=>'not-empty'));
		echo $this->Form->input('rate', array('class'=>'not-empty numeric'));
		echo $this->Form->input('active', array('type'=>'checkbox'));
	?>
	<div class="clear"></div>
	<?php echo $this->Form->end(__('Submit', true));?>
	</div>
</div>
