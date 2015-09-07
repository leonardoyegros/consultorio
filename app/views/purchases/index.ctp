<?php //print_r($purchases); die();?>
<div id="filters">
	<form>
	<div class="row">
		<?php echo $this->Form->input('contact_id', array('options'=>$contacts,'class'=>'selectpicker show-tick', 'data-live-search'=>"true",'md-cols'=>2)); ?>
		<?php echo $this->Form->input('currency_id', array('options'=>$currencies,'class'=>'selectpicker show-tick', 'data-live-search'=>"true",'md-cols'=>2)); ?>
		<div class="col-md-2">
			<div class="form-group">
				<label for="IssueDate"><?php __("Issue Date");?></label>
				<input type="text" id="IssueDate" class="datepicker form-control" placeholder="<?php echo __("Issue Date", true)?>">
			</div>
		</div>
		<div class="col-md-2">
			<div class="form-group">
				<label for="InvoiceNumber"><?php __("Invoice Number");?></label>
				<input type="text" id="InvoiceNumber" class="form-control" placeholder="<?php echo __("Invoice Number", true)?>">
			</div>
		</div>
		<?php echo $this->Form->input('payment_term', array('options'=>$payment_terms,'md-cols'=>2)); ?>
		<?php echo $this->Form->input('expense_id', array('options'=>$expenses,'class'=>'selectpicker show-tick', 'data-live-search'=>"true",'md-cols'=>2)); ?>
	</div>
	</form>
</div>


<table class="table table-responsive table-bordered" controller="Purchase">
	<thead>
		<tr>
			<th><?php echo __("Invoice Number", true)?></th>
			<th><?php echo __("Invoice Date", true)?></th>
			<th><?php echo __("Provider", true)?></th>
			<?php foreach ($taxes as $key => $tax): ?>
			<th><?php echo __("Taxable", true)?> <?php echo $tax['Tax']['rate'];?>%</th>
			<th><?php echo __("Rate", true)?> <?php echo $tax['Tax']['rate'];?>%</th>
			<?php endforeach;?>
			<th><?php echo __("Payment Term", true)?></th>
			<th><?php echo __("Total", true)?></th>
			<th><?php echo __("Currency", true)?></th>
			<th class="pk"><input class="form-control select-all" type="checkbox"></th>
		</tr>
	</thead>
	<tbody>
		<?php
		$i = 0;
		$total = 0;
		foreach ($purchases as $purchase):

			$expenses = ''; 
			foreach ($purchase['PurchasesExpense'] as $pe) {
				$expenses[] = 'expense_id_'.$pe['expense_id'];
			}

			$expenses = implode(' ', $expenses);

			$class = null;

			if ($i++ % 2 == 0) {
				$class = '';
			}
		?>
		<tr id="<?php echo $purchase['Purchase']['id']?>" class="item 
			contact_id_<?php echo $purchase['Purchase']['contact_id']?>
			billed_<?php echo $purchase['Purchase']['billed']?1:0?> 
			<?php echo $expenses?> 
			invoice_<?php echo $purchase['Purchase']['invoice_number']?> 
			currency_id_<?php echo $purchase['Purchase']['currency_id']?> 
			<?php echo $purchase['Purchase']['payment_term']?> 
			<?php echo $purchase['Purchase']['issue_date']?> 
		">
			<td><?php echo $this->Html->link(!empty($purchase['Purchase']['invoice_number'])?$purchase['Purchase']['invoice_number'] : __("Not Defined", true),array('controller'=>'purchases', 'action'=>'view',$purchase['Purchase']['id'])); ?></td>
			<td><?php echo $purchase['Purchase']['invoice_date']; ?>&nbsp;</td>
			<td><?php echo $this->Html->link($purchase['Contact']['name'], array('controller' => 'contacts', 'action' => 'view', $purchase['Contact']['id'])); ?></td>

			<?php foreach ($taxes as $tax): ?>

			<?php

				$base_imponible = 0;
				$rate = 0;

				$val = (100 + $tax['Tax']['rate'])/$tax['Tax']['rate'];

				if(!empty($purchase['Purchase']['taxes']['tax_'.$tax['Tax']['id']])){
					$base_imponible = $purchase['Purchase']['taxes']['tax_'.$tax['Tax']['id']] - ($purchase['Purchase']['taxes']['tax_'.$tax['Tax']['id']] / $val);
					$rate = $purchase['Purchase']['taxes']['tax_'.$tax['Tax']['id']] - $base_imponible;
				}

				 
			?>

			<td class="numeric"><?php echo $base_imponible>0 ? $this->Format->number($base_imponible,'money', array('symbol' => '') + $purchase['Currency']) : 0?></td>
			<td class="numeric"><?php echo $rate>0 ? $this->Format->number($rate,'money', array('symbol' => '') + $purchase['Currency']) : 0?></td>
			<?php endforeach;?>
			<td><?php echo $purchase['Purchase']['payment_term']=='cash'? __("Cash", true) : __("Credit", true)?></td>
			<td class="numeric"><?php echo $this->Format->number($purchase['Purchase']['total'],'money', array('symbol' => '') + $purchase['Currency']);?>&nbsp;</td>
			<td><?php echo $this->Html->link($purchase['Currency']['symbol'], array('controller' => 'currencies', 'action' => 'view', $purchase['Currency']['id'])); ?></td>
			<td class="pk"><input id="<?php echo $document['Contact']['id']; ?>" class="form-control delete-index" type="checkbox"></td>
		</tr>
		<?php endforeach; ?>
	</tbody>
</table>


<script type="text/javascript">
	$(document).ready(function(){
		$('#filters select,#filters input').change(function(){
			$('tr.item').hide();

			var selector_class = '';

			if($('#filters #contact_id').val().length>0){
				selector_class += '.contact_id_'+$('#filters #contact_id').val();
			}

			if($('#filters #currency_id').val().length>0){
				selector_class += '.currency_id_'+$('#filters #currency_id').val();
			}

			if($('#filters #IssueDate').val().length>0){
				selector_class += '.'+$('#filters #IssueDate').val();
			}

			if($('#filters #InvoiceNumber').val().length>0){
				selector_class += '.invoice_'+$('#filters #InvoiceNumber').val();
			}

			if($('#filters #payment_term').val().length>0){
				selector_class += '.'+$('#filters #payment_term').val();
			}

			if($('#filters #expense_id').val().length>0){
				selector_class += '.expense_id_'+$('#filters #expense_id').val();
			}

			selector_class = 'tr.item'+selector_class;

			console.log(selector_class);

			$(selector_class).show();
		});

		$(function(){
			$('table').tablesorter({
				// widgets        : ['zebra', 'columns'],
				usNumberFormat : false,
				sortReset      : true,
				sortRestart    : true
			});
		});

	});

	
</script>