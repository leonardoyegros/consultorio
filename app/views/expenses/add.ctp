<div class="panel panel-default">
	<div class="panel-body">
	<?php echo $this->Form->create('Expense');?>
		<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name', array('class'=>'not-empty'));	
		// echo $this->Form->input('buy_price', array('class'=>'numeric'));
		// echo $this->Form->input('sell_price', array('class'=>'numeric'));
		echo $this->Form->input('sales_enabled', array('md-cols'=>2,'type'=>'checkbox'));
		echo $this->Form->input('purchases_enabled', array('md-cols'=>2,'type'=>'checkbox'));
	?>

     <?php echo $this->Form->input('notes', array('md-cols'=>3, 'type'=>'textarea'));  ?>

	<div class="col-md-3" style="margin-bottom:40px;">
		<label for="ExpenseName"><?php echo __("Tax", true)?></label>
		<div class="form-group has-feedback">
		<div class="btn-group" data-toggle="buttons">
			<?php foreach ($taxes as $key => $tax):?>
				<label id="tax<?php echo $key;?>" class="btn btn-primary bs-checkbox">
			    <input name="data[ExpensesTax][<?php echo $i;?>][tax_id]" value="<?php echo $key;?>"  type="checkbox" autocomplete="off"><?php echo $tax?>
			  	</label>
			<?php endforeach;?>
		</div>
		</div>
	</div>

    <div class="clear"></div>
    </br>


	<!-- <div class="col-md-3">
		<label for="ExpenseName"><?php echo __("Tax", true)?></label>
		<div class="form-group has-feedback">
			<select data="data[ExpensesTax]" data-placeholder="<?php echo __("Select Taxes", true)?>" class="chosen-select" multiple style="width:350px;" tabindex="4">
				<?php foreach ($taxes as $key => $tax):?>
				<option value="<?php echo $key;?>"><?php echo $tax?></option>
				<?php endforeach;?>
			</select>
		</div>
	</div>
 -->

	</br>
	<?php echo $this->Form->end(__('Submit', true));?>
	</div>
</div>

<script type="text/javascript">
$(document).ready(function(){
	var config = {
      '.chosen-select'           : {},
      '.chosen-select-deselect'  : {allow_single_deselect:true},
      '.chosen-select-no-single' : {disable_search_threshold:10},
      '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
      '.chosen-select-width'     : {width:"100%"}
    }
    for (var selector in config) {
      $(selector).chosen(config[selector]);
    }

    <?php if (!empty($this->data['ExpensesTax'])):?>
    <?php foreach ($this->data['ExpensesTax'] as $key => $tax):?>
    if($('#tax<?php echo $tax['tax_id']?>').length == 1){
    	$('#tax<?php echo $tax['tax_id']?>').click();
    }
    <?php endforeach;?>
    <?php endif;?>

});
</script>
