	


	<div id="filters" style="display: none;">
	<form>
		<div class="row">

			<div class="col-md-3">
				<label><?php __("Name")?></label>
				<div class="form-group">
					<input type="text" id="ExpenseName" class="form-control" placeholder="<?php echo __("Search By Name", true);?>">
				</div>
			</div>

			<div class="col-md-3">
				<label><?php __("Sales Enabled")?></label>
				<div class="form-group">
					<input type="checkbox" id="ExpenseSalesEnabled" class="form-control" placeholder="<?php echo __("Sales Enabled", true);?>">
				</div>
			</div>

			<div class="col-md-3">
				<label><?php __("Purchases Enabled")?></label>
				<div class="form-group">
					<input type="checkbox" id="ExpensePurchasesEnabled" class="form-control" placeholder="<?php echo __("Purchases Enabled", true);?>">
				</div>
			</div>
			<!-- <div class="col-md-2">
				<div class="form-group">
					<input type="text" id="ContactDocuementId" class="form-control" placeholder="Nombre">
				</div>
			</div> -->
		</div>
		</form>
	</div>

	<table class="table table-responsive table-bordered" controller="Expense">
		<thead>
			<tr>
				<th><?php echo $this->Paginator->sort('name');?></th>
				<th><?php echo $this->Paginator->sort('sales_enabled');?></th>
				<th><?php echo $this->Paginator->sort('purchases_enabled');?></th>
				<!-- <th><?php echo $this->Paginator->sort('buy_price');?></th> -->
				<!-- <th><?php echo $this->Paginator->sort('sell_price');?></th> -->
				<th class="pk"><input class="form-control select-all" type="checkbox"></th>

			</tr>
		</thead>
		<tbody>
	<?php
	$i = 0;
	foreach ($expenses as $expense):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr class="item <?php echo $expense['Expense']['sales_enabled'] ? 'sales_enabled' : '';?> <?php echo $expense['Expense']['purchases_enabled'] ? 'purchases_enabled' : '';?>" id="<?php echo $expense['Expense']['id']?>" name="<?php echo strtoupper($expense['Expense']['name'])?>">
		<td><?php echo $this->Html->link($expense['Expense']['name'],array('controller'=>'expenses', 'action'=>'view',$expense['Expense']['id'])); ?></td>
		<td><?php echo __($expense['Expense']['sales_enabled']?"Yes": "No", true); ?>&nbsp;</td>
		<td><?php echo __($expense['Expense']['purchases_enabled']?"Yes": "No", true);; ?>&nbsp;</td>
		<!-- <td class="center"><?php echo $expense['Expense']['buy_price']; ?>&nbsp;</td> -->
		<!-- <td><?php echo $expense['Expense']['sell_price']; ?>&nbsp;</td> -->
		<td class="pk"><input id="<?php echo $expenses['Expense']['id']; ?>" class="form-control delete-index" type="checkbox"></td>
	</tr>
<?php endforeach; ?>
		</tbody>
	</table>
	<!-- <p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
	));
	?>	</p> -->

	<!-- <div class="paging">
		<?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $this->Paginator->numbers();?>
 |
		<?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
	</div> -->
</div>

<script type="text/javascript">
	$(document).ready(function(){
		bindScroll();
	});

	function bindScroll(){
		
	}


</script>


<script type="text/javascript">
var page = 1;
var loadLock = 0;
$('document').ready(function(){
	// scroll();

	$('#filters input').keyup(function(){
		$('tr.item').hide();
		console.log('table tr.item:Contains('+$(this).val().toUpperCase()+')');
		$('table tr.item:Contains('+$(this).val().toUpperCase()+')').show();  

	});

	$(document).ready(function(){
		$('#filters input').change(function(){
			console.log('FILTER');

			$('tr.item').hide();

			var selector_class = '';

			if($('#ExpenseSalesEnabled:checked').length>0){
				selector_class += '.sales_enabled';
			}

			if($('#ExpensePurchasesEnabled:checked').length>0){
				selector_class += '.purchases_enabled';
			}

			selector_class = 'tr.item'+selector_class;

			console.log(selector_class);

			$(selector_class).show();
		});

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
