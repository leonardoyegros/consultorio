<script type="text/javascript">
	var documents = <?php echo $javascript->object($documents); ?>;
	$(function(){
		$('table').tablesorter({
			// widgets        : ['zebra', 'columns'],
			usNumberFormat : false,
			sortReset      : true,
			sortRestart    : true
		});
	});


</script>



<div id="filters">
	<form>
	<div class="row">
		<div class="col-md-2">
			<div class="form-group">
				<select name="data[Filter][type]" class=" form-control" id="DocumentType">
					<option value=""><?php echo __("All", true)?></option>
					<option value="invoice">Invoice</option>
					<option value="receipt">Receipt</option>
				</select>
			</div>
		</div>
	</div>
	</form>
</div>	


	<table class="table table-responsive table-bordered" controller="Document">
		<thead>
			<tr>
				<th><?php echo $this->Paginator->sort('type');?></th>
				<th><?php echo $this->Paginator->sort('code');?></th>
				<th><?php echo $this->Paginator->sort('starts_in');?></th>
				<th><?php echo $this->Paginator->sort('ends_in');?></th>
				<th><?php echo $this->Paginator->sort('expires_in');?></th>
				<th class="pk"><input class="form-control select-all" type="checkbox"></th>
			</tr>
		</thead>
		<tbody>
	<?php
	$i = 0;
	foreach ($documents as $document):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr class="item" <?php echo $class;?> type="<?php echo $types[$document['Document']['type']]; ?>" id="<?php echo $document['Document']['id']; ?>">
		<td class="pk"><?php echo $this->Html->link($types[$document['Document']['type']],array('controller'=>'documents', 'action'=>'view',$document['Document']['id'])); ?></td>
		<td><?php echo $document['Document']['code']; ?>&nbsp;</td>
		<td><?php echo $document['Document']['starts_in']; ?>&nbsp;</td>
		<td><?php echo $document['Document']['ends_in']; ?>&nbsp;</td>
		<td><?php echo $document['Document']['expires_in']; ?>&nbsp;</td>
		<td class="pk"><input id="<?php echo $document['Document']['id']; ?>" class="form-control delete-index" type="checkbox"></td>
	</tr>
<?php endforeach; ?>
		</tbody>
	</table>
	<p>
	<?php
	//echo $this->Paginator->counter(array('format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
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
	$(document).ready(function(){
		$('#DocumentType').change(function(){
			if($(this).val().length > 0){
				$('table tr.item').hide();
				$('table tr[type='+$(this).val()+']').show();
			}else{
				$('table tr.item').show();
			}
		});
	});

</script>