<div id="filters">
	<form>
	<div class="row">
		<?php echo $this->Form->input('contact_id', array('options'=>$contacts,'class'=>'selectpicker show-tick', 'data-live-search'=>"true",'md-cols'=>2)); ?>
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
	</div>
	</form>
</div>

	<table controller="Collection" class="table table-responsive table-bordered">
		<thead>
			<tr>
				<th><?php echo __('Issue Date', true);?></th>
				<th><?php echo __('Receipt Number', true);?></th>
				<th><?php echo __('Client', true);?></th>
				<th><?php echo __('Amount', true);?></th>
				<th class="pk"><input class="form-control select-all" type="checkbox"></th>
			</tr>
		</thead>
		<tbody>
	<?php
	$i = 0;
	foreach ($collections as $collection):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr id="<?php echo $collection['Collection']['id']?>" 
		class="
			item 
			<?php echo $collection['Collection']['number']?>
			<?php echo $collection['Collection']['void']?'warning':''?>
			contact_id_<?php echo $collection['Collection']['contact_id']?>
		"
		amount = "<?php echo $collection['Collection']['amount']?>"
		date = "<?php echo $collection['Collection']['issue_date']?>"

	>
		<td><?php echo $collection['Collection']['issue_date']; ?>&nbsp;</td>
		<td><?php echo $this->Html->link(!empty($collection['Collection']['number'])?$collection['Collection']['number']:__("Not Defined", true),array('controller'=>'collections', 'action'=>'view',$collection['Collection']['id'])); ?></td>
		<td>
			<?php echo $this->Html->link($collection['Contact']['name'], array('controller' => 'contacts', 'action' => 'view', $collection['Contact']['id'])); ?>
		</td>
		<td class="numeric"><?php echo $this->Format->number($collection['Collection']['amount'],'money', array('symbol' => '') + $collection['Currency']);?>&nbsp;</td>
		<td class="pk"><input id="<?php echo $document['Contact']['id']; ?>" class="form-control delete-index" type="checkbox"></td>
	</tr>
<?php endforeach; ?>
		</tbody>
	</table>

</div>


<script type="text/javascript">

	$(document).ready(function(){

		$('#filters select,#filters input').change(function(){
			console.log('FILTER');

			var selector_class = '';
			$('tr.item').hide();		

			if($('#filters #contact_id').val().length>0){
				selector_class += '.contact_id_'+$('#filters #contact_id').val();
			}

			// if($('#filters #currency_id').val().length>0){
			// 	selector_class += '.currency_id_'+$('#filters #currency_id').val();
			// }

			if($('#filters #InvoiceNumber').val().length>0){
				selector_class += '.'+$('#filters #InvoiceNumber').val();
			}

			// if($('#filters #void').val().length>0){
			// 	// console.log();
			// 	selector_class += '.'+$('#filters #void').val();
			// }

			selector_class = 'tr.item'+selector_class;

			console.log(selector_class);

			$(selector_class).show();

			if($('#filters #startDate').val().length>0){
				var startDate = $('#filters #startDate').val();
				console.log('start date:'+startDate);
				startDate = startDate.replace(/-/g,"");

				$('tr.item').each(function(){

					console.log(eval($(this).attr('date').replace(/-/g,"")));
					console.log(eval(startDate));

					if (eval($(this).attr('date').replace(/-/g,"")) < eval(startDate)) {
						$(this).hide('fast');
					};
				});
			}

			if($('#filters #endDate').val().length>0){
				var endDate = $('#filters #endDate').val();
				console.log('end date:'+endDate);
				endDate = endDate.replace(/-/g,"");
				$('tr.item').each(function(){
					if (eval($(this).attr('date').replace(/-/g,"")) > eval(endDate)) {
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

			// setTimeout('updateTotal()', 1000);

		});


	// $('#filters input').keyup(function(){
	// 	$('tr.item').hide();
	// 	console.log('table tr.item:Contains('+$(this).val().toUpperCase()+')');
	// 	$('table tr.item:Contains('+$(this).val().toUpperCase()+')').show();  

	// });

	
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