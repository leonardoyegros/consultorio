<?php //print_r($sales); die();?>
<div id="filters">
	<form>
	<div class="row">
		<?php echo $this->Form->input('contact_id', array('options'=>$contacts,'class'=>'selectpicker show-tick', 'data-live-search'=>"true",'md-cols'=>2)); ?>
		<?php echo $this->Form->input('currency_id', array('options'=>$currencies,'class'=>'selectpicker show-tick', 'data-live-search'=>"true",'md-cols'=>2)); ?>
		<div class="col-md-2">
			<div class="form-group">
				<label for="IssueDate"><?php __("Start Date");?></label>
				<input type="text" id="startDate" class="datepicker form-control" placeholder="<?php echo __("Issue Date", true)?>">
			</div>
		</div>
		<div class="col-md-2">
			<div class="form-group">
				<label for="IssueDate"><?php __("End Date");?></label>
				<input type="text" id="endDate" class="datepicker form-control" placeholder="<?php echo __("Issue Date", true)?>">
			</div>
		</div>
		<div class="col-md-2">
			<div class="form-group">
				<label for="InvoiceNumber"><?php __("Invoice Number");?></label>
				<input type="text" id="InvoiceNumber" class="form-control" placeholder="<?php echo __("Invoice Number", true)?>">
			</div>
		</div>
		<?php echo $this->Form->input('start_amount', array('md-cols'=>2, 'class'=>'numeric', 'id'=>'startAmount')); ?>
		<?php echo $this->Form->input('end_amount', array('md-cols'=>2, 'class'=>'numeric', 'id'=>'endAmount')); ?>
		<?php echo $this->Form->input('payment_term', array('options'=>$payment_terms,'md-cols'=>2)); ?>
		<?php 
			$fiscals = array(
				'' => __("All", true),
				'fiscal' => __("Yes", true),
				'no_fiscal' => __("No", true),
			);
		?>
		<?php echo $this->Form->input('fiscal', array('options'=>$fiscals,'md-cols'=>2)); ?>
		<?php 
			$void = array(
				'' => __("All", true),
				'void' => __("Yes", true),
				'no_void' => __("No", true),
			);
		?>
		<?php echo $this->Form->input('void', array('options'=>$void,'md-cols'=>2)); ?>
		<div class="col-md-4">
			<div class="form-group">
			<label for="expense_id"><?php __("Expense")?></label>
			<select name="data[expense_id]" class="selectpicker show-tick form-control" data-live-search="true" md-cols="2" id="expense_id" style="display: none;" multiple>
				<?php foreach($expenses as $key => $expense):?>
				<option value="<?php echo $key?>"><?php echo $expense?></option>
				<?php endforeach;?>
			</select>
			</div>
		</div>
	</div>
	</form>
</div>

<table controller="Sale" class="table table-responsive table-bordered">
<thead>
<tr>
	<th><?php __("Invoice Number")?></th>
	<th><?php __("Client")?></th>
	<th><?php __("Issue Date")?></th>
	<th><?php __("Payment Term")?></th>
	<th><?php __("Currency")?></th>
	<th><?php __("Total")?></th>
	<?php foreach ($taxes as $key => $tax): ?>
	<th><?php echo __("Taxable", true)?> <?php echo $tax['Tax']['rate'];?>%</th>
	<th><?php echo __("Rate", true)?> <?php echo $tax['Tax']['rate'];?>%</th>
	<?php endforeach;?>
	<th><?php __("Local Amount")?></th>	
	<th class="pk"><input class="form-control select-all" type="checkbox"></th>
</tr>
</thead>
<tbody>
<?php foreach ($sales as $sale): ?>
<?php 
	$expenses = ''; 
	foreach ($sale['SalesExpense'] as $se) {
		$expenses[] = 'expense_id_'.$se['expense_id'];
	}
	$expenses = implode(' ', $expenses);
?>

<tr id="<?php echo $sale['Sale']['id']?>" class="
	item
	billed_<?php echo $sale['Sale']['billed']?1:0?> 
	<?php echo $expenses?>
	contact_id_<?php echo $sale['Sale']['contact_id']?> 
	invoice_<?php echo $sale['Sale']['invoice_number']?> 
	currency_id_<?php echo $sale['Sale']['currency_id']?> 
	<?php echo $sale['Sale']['payment_term']?> 
	<?php echo $sale['Sale']['issue_date']?>
	<?php echo $sale['Sale']['bill']?'fiscal':'no_fiscal'?>
	<?php echo $sale['Sale']['void']?'void':'no_void'?> 
	"

	date = "<?php echo date('Ymd', strtotime($sale['Sale']['issue_date']))?>"
	amount = "<?php echo (!empty($sale['Sale']['overdue_amount'])?$sale['Sale']['overdue_amount']:$sale['Sale']['amount']) * $sale['Sale']['currency_price'];?>"
>
	<td><?php echo $this->Html->link(!empty($sale['Sale']['invoice_number'])?$sale['Sale']['invoice_number']:__("Not Defined", true),array('controller'=>'sales', 'action'=>'view',$sale['Sale']['id'])); ?></td>
	<td><?php echo $this->Html->link($sale['Contact']['name'], array('controller' => 'contacts', 'action' => 'view', $sale['Contact']['id'])); ?></td>
	<td><?php echo h($sale['Sale']['issue_date']); ?>&nbsp;</td>	
	<td><?php echo h(__(ucfirst($sale['Sale']['payment_term']), true)); ?>&nbsp;</td>
	<td>
		<?php echo $this->Html->link($sale['Currency']['name'], array('controller' => 'currencies', 'action' => 'view', $sale['Currency']['id'])); ?>
	</td>
	<td class="numeric"><?php echo $this->Format->number($sale['Sale']['amount'], 'money', array('symbol' => '') + $sale['Currency']); ?>&nbsp;</td>
	<?php foreach ($taxes as $tax): ?>
	<?php
		$base_imponible = 0;
		$rate = 0;
		$val = (100 + $tax['Tax']['rate'])/$tax['Tax']['rate'];
		if(!empty($sale['Sale']['taxes']['tax_'.$tax['Tax']['id']])){
			$price = $sale['Sale']['taxes']['tax_'.$tax['Tax']['id']]."\n";
			$tax_amount = ($sale['Sale']['taxes']['tax_'.$tax['Tax']['id']] / $val)."\n";
			$base_imponible =  $price - $tax_amount;
			$rate = $sale['Sale']['taxes']['tax_'.$tax['Tax']['id']] - $base_imponible;
			// $total_taxes["total_".$tax['Tax']['id']]['total'] += $rate;
		}
	?>
	<td class="numeric taxable_<?php echo $tax['Tax']['id'];?>_amount" value="<?php echo $base_imponible>0 ? $base_imponible*$sale['Sale']['currency_price'] : 0?>"><?php echo $base_imponible>0 ? $this->Format->number($base_imponible*$sale['Sale']['currency_price'],'money', array('symbol' => '') + $currency['Currency']) : 0?></td>
	<td class="numeric tax_<?php echo $tax['Tax']['id'];?>_amount" value="<?php echo $rate>0?$rate*$sale['Sale']['currency_price']:0?>"><?php echo $rate>0 ? $this->Format->number($rate*$sale['Sale']['currency_price'],'money', array('symbol' => '') + $currency['Currency']) : 0?></td>
	<?php endforeach;?>
	<td class="numeric local_amount" value="<?php echo $sale['Sale']['amount'] * $sale['Sale']['currency_price'];?>"><?php echo $this->Format->number( $sale['Sale']['amount'] * $sale['Sale']['currency_price'], 'money', array('symbol' => '') + $currency['Currency']); ?>&nbsp;</td>
	<td class="pk"><input id="<?php echo $document['Contact']['id']; ?>" class="form-control delete-index" type="checkbox"></td>
</tr>
<?php endforeach; ?>
</tbody>
<tfoot>
<tr class="totals">
	<td colspan="6"><?php __("Totals")?></td>
	<?php foreach ($taxes as $key => $tax):?>
	<td class="numeric total_taxable_<?php echo $tax['Tax']['id']?>">-</td>
	<td class="numeric total_tax_<?php echo $tax['Tax']['id']?>"></td>
	<?php endforeach;?>	
	<td class="numeric" id="total_sales"></td>
	<td></td>
</tr>
</tfoot>
</table>

<script type="text/javascript">
	$(document).ready(function(){

		$('#filters select,#filters input').change(function(){
			console.log('FILTER');

			var selector_class = '';
			$('tr.item').hide();

			//<--expenses
			if($('#filters #expense_id').val()!=null){
				console.log("click");
				var expenses_id = $('#filters #expense_id').val();
				for (var i = expenses_id.length - 1; i >= 0; i--) {
					selector_class += '.expense_id_'+expenses_id[i];
				};
				console.log(selector_class);
			}
			//expenses-->			

			if($('#filters #contact_id').val().length>0){
				selector_class += '.contact_id_'+$('#filters #contact_id').val();
			}

			if($('#filters #currency_id').val().length>0){
				selector_class += '.currency_id_'+$('#filters #currency_id').val();
			}

			if($('#filters #InvoiceNumber').val().length>0){
				selector_class += '.invoice_'+$('#filters #InvoiceNumber').val();
			}

			if($('#filters #fiscal').val().length>0){
				// console.log();
				selector_class += '.'+$('#filters #fiscal').val();
			}

			if($('#filters #void').val().length>0){
				// console.log();
				selector_class += '.'+$('#filters #void').val();
			}

			if($('#filters #payment_term').val().length>0){
				selector_class += '.'+$('#filters #payment_term').val();
			}

			selector_class = 'tr.item'+selector_class;

			console.log(selector_class);

			$(selector_class).show();

			if($('#filters #startDate').val().length>0){
				var startDate = $('#filters #startDate').val();
				console.log('date:'+startDate);
				startDate = startDate.replace('-', '');
				startDate = startDate.replace('-', '');

				console.log('date:'+startDate);

				$('tr.item').each(function(){

					console.log(eval($(this).attr('date')));
					console.log(eval(startDate));

					if (eval($(this).attr('date')) < eval(startDate)) {
						$(this).hide('fast');
					};
				});
			}

			if($('#filters #endDate').val().length>0){
				var endDate = $('#filters #endDate').val();
				console.log('date:'+endDate);
				endDate = endDate.replace('-', '');
				endDate = endDate.replace('-', '');
				$('tr.item').each(function(){
					if (eval($(this).attr('date')) > eval(endDate)) {
						$(this).hide('fast');
					};
				});
			}

			if($('#filters #startAmount').val().length>0){
				var startAmount = $('#filters #startAmount').val();
				console.log('startAmount:'+startAmount);
				startAmount = eval(startAmount); 
				$('tr.item').each(function(){
					thisAmount = eval($(this).attr('amount'))
					if ( thisAmount < startAmount) {
						console.log(thisAmount + "<" + startAmount);
						console.log("hidding");
						$(this).hide('fast');
					}else{
						console.log(thisAmount + ">" + startAmount);
					}
				});
			}

			if($('#filters #endAmount').val().length>0){
				var endAmount = $('#filters #endAmount').val();
				console.log('date:'+endAmount);
				console.log('endAmount:'+endAmount);

				$('tr.item').each(function(){

					console.log(eval($(this).attr('amount')));
					console.log(eval(endAmount));

					if (eval($(this).attr('amount')) > eval(endAmount)) {
						$(this).hide('fast');
					};
				});
			}

			// updateTotal();

			setTimeout('updateTotal()', 1000);

		});

		$(function(){
			$('table').tablesorter({
				// widgets        : ['zebra', 'columns'],
				usNumberFormat : false,
				sortReset      : true,
				sortRestart    : true
			});
		});

		updateTotal();
	});

	function updateTotal(){
		console.log("updateTotal");
		var total = 0;
		$('.item:visible .local_amount').each(function(){
			total += eval($(this).attr('value'));
		});

		var total_taxable = 0;
		$('.item:visible .taxable_amount').each(function(){
			total_taxable += eval($(this).attr('value'));
		});

		var total_tax_amount = 0;
		$('.item:visible .tax_amount').each(function(){
			total_tax_amount += eval($(this).attr('value'));
		});

		<?php foreach ($taxes as $key => $tax):?>
		total_tax_<?php echo $tax['Tax']['id']?> = 0;
		// console.log("total_tax_<?php echo $tax['Tax']['id']?>");
		var total_tax_<?php echo $tax['Tax']['id']?> = 0;
		$('.item:visible .tax_<?php echo $tax['Tax']['id']?>_amount').each(function(){
			total_tax_<?php echo $tax['Tax']['id']?> += eval($(this).attr('value'));
		});
		// console.log(total_tax_<?php echo $tax['Tax']['id']?>);
		// console.log('#total_tax_<?php echo $tax['Tax']['id']?>');
		$('.total_tax_<?php echo $tax['Tax']['id']?>').text(numeral(total_tax_<?php echo $tax['Tax']['id']?>).format('0,0'));
		<?php endforeach;?>

		<?php foreach ($taxes as $key => $tax):?>
		total_tax_<?php echo $tax['Tax']['id']?> = 0;
		// console.log("total_taxable_<?php echo $tax['Tax']['id']?>");
		var total_tax_<?php echo $tax['Tax']['id']?> = 0;
		$('.item:visible .taxable_<?php echo $tax['Tax']['id']?>_amount').each(function(){
			total_tax_<?php echo $tax['Tax']['id']?> += eval($(this).attr('value'));
		});
		// console.log(total_tax_<?php echo $tax['Tax']['id']?>);
		// console.log('#total_taxable_<?php echo $tax['Tax']['id']?>');
		$('.total_taxable_<?php echo $tax['Tax']['id']?>').text(numeral(total_tax_<?php echo $tax['Tax']['id']?>).format('0,0'));
		<?php endforeach;?>



		$('#total_sales').text(numeral(total).format('0,0'));
		$('#total_taxable').text(numeral(total_taxable).format('0,0'));
		$('#total_tax_amount').text(numeral(total_tax_amount).format('0,0'));
	}

	
</script>

