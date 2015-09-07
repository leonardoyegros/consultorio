	<table class="table table-responsive table-bordered" controller="Currency">
		<thead>
			<tr>
							<th><?php echo $this->Paginator->sort('name');?></th>
							<th><?php echo $this->Paginator->sort('symbol');?></th>
							<th><?php echo $this->Paginator->sort('ask');?></th>
							<th><?php echo $this->Paginator->sort('bid');?></th>
							<!-- <th><?php echo $this->Paginator->sort('default');?></th> -->
							<th><?php echo $this->Paginator->sort('decimals');?></th>
							<th><?php echo $this->Paginator->sort('main');?></th>
							<th class="pk"><input class="form-control select-all" type="checkbox"></th>
						</tr>
		</thead>
		<tbody>
	<?php
	$i = 0;
	foreach ($currencies as $currency):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr class="item">
		<td ><?php echo $this->Html->link($currency['Currency']['name'],array('controller'=>'currencies', 'action'=>'view',$currency['Currency']['id'])); ?></td>
		<td><?php echo $currency['Currency']['symbol']; ?>&nbsp;</td>
		<td><?php echo $currency['Currency']['buy_price']; ?>&nbsp;</td>
		<td><?php echo $currency['Currency']['sale_price']; ?>&nbsp;</td>
		<!-- <td><?php echo $currency['Currency']['default']; ?>&nbsp;</td> -->
		<td><?php echo $currency['Currency']['decimals']; ?>&nbsp;</td>
		<td class="pk"><?php echo $currency['Currency']['main']?'<span class="glyphicon glyphicon-check"></span>':''; ?>&nbsp;</td>
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