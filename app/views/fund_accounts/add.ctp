<div class="panel panel-default">
	<div class="panel-body">
	<?php echo $this->Form->create('FundAccount');?>
		<?php
		echo $this->Form->input('name', array('class'=>'not-empty'));
		echo $this->Form->input('currency_id', array('options'=>$currencies));
		echo $this->Form->input('category', array('options'=>$types));
		echo $this->Form->input('active', array('type'=>'checkbox'));
	?>
	</br>
	<?php echo $this->Form->end(__('Submit', true));?>
	</div>
</div>
