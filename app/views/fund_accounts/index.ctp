<div id="filters">
	<form>
	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
				<input type="text" id="ContactName" class="form-control" placeholder="<?php echo __("Search By", true)?> ">
			</div>
		</div>
		<!-- <div class="col-md-2">
			<div class="form-group">
				<input type="text" id="ContactDocuementId" class="form-control" placeholder="<?php echo __("Name")?>">
			</div>
		</div> -->
	</div>
	</form>
</div>


	<table controller="FundAccount" class="table table-responsive table-bordered">
		<thead>
			<tr>
							<th><?php echo $this->Paginator->sort('name');?></th>
							<th><?php echo $this->Paginator->sort('currency_id');?></th>
							<th><?php echo $this->Paginator->sort('category');?></th>
							<th><?php echo $this->Paginator->sort('active');?></th>
							<th class="pk"><input class="form-control select-all" type="checkbox"></th>
						</tr>
		</thead>
		<tbody>
	<?php
	$i = 0;
	foreach ($fundAccounts as $fundAccount):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr class="item" id="<?php echo $fundAccount['FundAccount']['id']?>">
		<td><?php echo $this->Html->link($fundAccount['FundAccount']['name'],array('controller'=>'fund_accounts', 'action'=>'view',$fundAccount['FundAccount']['id'])); ?></td>
		<td>
			<?php echo $this->Html->link($fundAccount['Currency']['name'], array('controller' => 'currencies', 'action' => 'view', $fundAccount['Currency']['id'])); ?>
		</td>
		<td><?php echo __($types[$fundAccount['FundAccount']['category']], true); ?>&nbsp;</td>
		<td><?php echo __($fundAccount['FundAccount']['active']?"Yes":"No"); ?>&nbsp;</td>
		<td class="pk"><input id="<?php echo $expenses['Expense']['id']; ?>" class="form-control delete-index" type="checkbox"></td>
	</tr>
<?php endforeach; ?>
		</tbody>
	</table>
	

	
</div>

<script type="text/javascript">
	$(document).ready(function(){
		$(function(){
			$('table').tablesorter({
				// widgets        : ['zebra', 'columns'],
				usNumberFormat : false,
				sortReset      : true,
				sortRestart    : true
			});
		});
	})
</script>


<script type="text/javascript">

$('document').ready(function(){
	

	$('#filters input').keyup(function(){
		$('tr.item').hide();
		$('table tr.item:Contains('+$(this).val().toUpperCase()+')').show();  

	});


});

</script>
