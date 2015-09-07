<div id="filters">
	<form>
	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
				<input type="text" id="TaxName" class="form-control" >
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



	<table class="table table-responsive table-bordered" controller="Tax">
		<thead>
			<tr>
				<th><?php echo $this->Paginator->sort('name');?></th>
				<th><?php echo $this->Paginator->sort('rate');?></th>
				<th><?php echo $this->Paginator->sort('active');?></th>
				<th class="pk"><input class="form-control select-all" type="checkbox"></th>
			</tr>
		</thead>
		<tbody>
	<?php
	$i = 0;
	foreach ($taxes as $tax):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr id="<?php echo $tax['Tax']['id']?>"  class="item <?php echo $tax['Tax']['name']?>">
		<td><?php echo $this->Html->link($tax['Tax']['name'],array('controller'=>'taxes', 'action'=>'view',$tax['Tax']['id'])); ?></td>
		<td class="numeric"><?php echo $tax['Tax']['rate']; ?>&nbsp;</td>
		<td><?php echo __($tax['Tax']['active']?'Yes':'No', true); ?></td>
		<td class="pk"><input id="<?php echo $tax['Tax']['id']; ?>" class="form-control delete-index" type="checkbox"></td>


	</tr>
<?php endforeach; ?>
		</tbody>
	</table>
	<p>
	<?php
	// echo $this->Paginator->counter(array(
	// 'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
	// ));
	?>	</p>

	<!-- <div class="paging">
		<?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $this->Paginator->numbers();?>
 |
		<?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
	</div> -->
</div>

<script type="text/javascript">
	$(function(){
		$('table').tablesorter({
			// widgets        : ['zebra', 'columns'],
			usNumberFormat : false,
			sortReset      : true,
			sortRestart    : true
		});
	});
</script>