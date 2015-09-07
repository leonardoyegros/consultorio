	<div id="filters" style="display: none;">
	<form>
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<input type="text" id="ExpenseName" class="form-control" placeholder="<?php echo __("Search By Name", true);?>">
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

	<table class="table table-responsive table-bordered" controller="InvoiceTemplate">
		<thead>
			<tr>
				<th><?php echo $this->Paginator->sort('name');?></th>
				<th class="pk"><input class="form-control select-all" type="checkbox"></th>

			</tr>
		</thead>
		<tbody>
	<?php
	$i = 0;
	foreach ($invoiceTemplates as $template):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr class="item" id="<?php echo $template['InvoiceTemplate']['id']?>" name="<?php echo strtoupper($template['InvoiceTemplate']['name'])?>">
		<td><?php echo $this->Html->link($template['InvoiceTemplate']['name'],array('controller'=>'invoice_templates', 'action'=>'add',$template['InvoiceTemplate']['id'])); ?></td>
		<td class="pk"><input id="<?php echo $template['InvoiceTemplate']['id']; ?>" class="form-control delete-index" type="checkbox"></td>
	</tr>
<?php endforeach; ?>
		</tbody>
	</table>
	
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
