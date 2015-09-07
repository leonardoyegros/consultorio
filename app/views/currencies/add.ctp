<div class="panel panel-default">
	<div class="panel-body">
	<?php echo $this->Form->create('Currency');?>
		<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name', array('class'=>'not-null'));
		echo $this->Form->input('buy_price', array('class'=>'not-null numeric','label'=>__("Ask", true)));
		echo $this->Form->input('sale_price', array('class'=>'not-null numeric','label'=>__("Bid", true)));
		// echo $this->Form->input('default');
		echo $this->Form->input('symbol', array('class'=>'not-null'));
		echo $this->Form->input('decimals', array('class'=>'not-null numeric'));
		echo $this->Form->input('main', array('type'=>'checkbox'));
	?>
	</br>
	<?php echo $this->Form->end(__('Submit', true));?>
	</div>
</div>
