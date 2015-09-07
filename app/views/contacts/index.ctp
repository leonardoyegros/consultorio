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




	<table class="table table-responsive table-bordered" controller="Contact">
		<thead>
			<tr>
				<th><?php echo $this->Paginator->sort('name');?></th>
				<th><?php echo __("Document Id", true);?></th>
				<th><?php echo $this->Paginator->sort('address');?></th>
				<th><?php echo $this->Paginator->sort('mobile');?></th>
				<th><?php echo $this->Paginator->sort('phone');?></th>
				<th><?php echo $this->Paginator->sort('email');?></th>
				<th><?php echo $this->Paginator->sort('country_id');?></th>
				<th class="pk"><input class="form-control select-all" type="checkbox"></th>
			</tr>
		</thead>
		<tbody>
	<?php
	$i = 0;
	foreach ($contacts as $contact):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = 'altrow';
		}
	?>
	<tr  class="item" id="<?php echo $contact['Contact']['id'];?>" name="<?php echo strtoupper($contact['Contact']['name']); ?>" country="<?php echo strtoupper($contact['Country']['name']); ?>">
		<td><?php echo $this->Html->link($contact['Contact']['name']?$contact['Contact']['name']:'ND',array('controller'=>'contacts', 'action'=>'view',$contact['Contact']['id'])); ?></td>
		<td><?php echo strtoupper($contact['Contact']['document_id']); ?>&nbsp;</td>
		<td><?php echo $contact['Contact']['address']; ?>&nbsp;</td>
		<td><?php echo $contact['Contact']['mobile']; ?>&nbsp;</td>
		<td><?php echo $contact['Contact']['phone']; ?>&nbsp;</td>
		<td><?php echo $contact['Contact']['email']; ?>&nbsp;</td>
		<td>
			<?php echo strtoupper($contact['Country']['name']); ?>
		</td>
		<td class="pk"><input id="<?php echo $document['Contact']['id']; ?>" class="form-control delete-index" type="checkbox"></td>
	</tr>
<?php endforeach; ?>
		</tbody>
	</table>
	<!-- <p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
	));
	?>	</p>

	<div class="paging">
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

	$(function(){
		$('table').tablesorter({
			// widgets        : ['zebra', 'columns'],
			usNumberFormat : false,
			sortReset      : true,
			sortRestart    : true
		});
	});



</script>


<script type="text/javascript">
var page = 1;
var loadLock = 0;
$('document').ready(function(){
	

	$('#filters input').keyup(function(){
		$('tr.item').hide();
		$('table tr.item:Contains('+$(this).val().toUpperCase()+')').show();  

	});

	scroll();


});

function scroll(){
	$('div#col-content').scroll(function() {

		// console.log("Scroll");
		console.log($('div#col-content').scrollTop() + ' + ' + $('div#col-content').height() + ' = ' + $(document).height());
	   if($('div#col-content').scrollTop() + $('div#col-content').height() > $('div.products_index').height() - 800) {
	       console.log($('div#col-content').scrollTop() + ' + ' + $('div#col-content').height() + ' = ' + $(document).height());
	       // loadPage(page+1);
	   }
	});
}

function loadPage(p) {
	if (loadLock == 1) {
		return;
	}

	console.log('loadPage()');
	loadLock = 1;

	$.ajax({
		type: "GET",
		url: "<?php echo $html->url(array("controller"=>"contacts", "action"=>"index")); ?>",
		data: "nolayout=1&page="+p+"&<?php echo http_build_query($args); ?>",
		success: function(msg){
			if (msg.trim() != '') {
				console.log("ASDF");
				loadLock = 0;
				$('table#products tbody').append(msg);
				// $('#products_end').before(msg);
				page = p;
				
			}
		}
	});
}




</script>