<div class="panel panel-default">
	<div class="panel-body">
		<?php echo $this->Form->input('id', array('md-cols'=>3, 'type'=>'hidden', 'value'=>(!empty($this->data['InvoiceTemplate']['id'])?$this->data['InvoiceTemplate']['id']:'')));	?>
		<?php echo $this->Form->input('invoice_id', array('md-cols'=>3, 'type'=>'hidden', 'value'=>(!empty($this->data['InvoiceTemplate']['id'])?$this->data['InvoiceTemplate']['id']:'')));	?>
		<?php echo $this->Form->input('document_type', array('md-cols'=>3, 'options'=>$document_types, 'value'=>(!empty($this->data['InvoiceTemplate']['document_type'])?$this->data['InvoiceTemplate']['document_type']:'')));	?>
		<?php echo $this->Form->input('name', array('md-cols'=>3, 'value'=>(!empty($this->data['InvoiceTemplate']['name'])?$this->data['InvoiceTemplate']['name']:'')));	?>
		<div class="col-md-3">
		<div class="form-group">
			<label for="document_type"></label>
			<a id="saveTemplate" href="#" title="<?php  echo __("Save", true)?>" data-toggle="tooltip" class="btn btn-info" data-original-title="Agregar"><span class="glyphicon glyphicon-floppy-disk"></span></a>
			<!-- <input name="data[document_type]" type="button" md-cols="3" class="btn btn-info form-control" id="saveTemplate"> -->
		</div>
		</div>
	</div>


	<div class="panel-body">
		<div class="col-md-3">

			<!-- ELEMENTOS DE UNA VENTA -->

			<?php foreach ($structure['Sale'] as $part => $components):?>
			<div id="<?php echo str_replace(' ', '', $part);?>">
			<h4><?php echo __($part, true)?></h4>
			<ul class="nav nav-pills nav-stacked">
				<?php $i = 0; foreach ($components as $key => $component):?>
				<li role="presentation">
					<a href="#" class="component">
						<?php echo $component?>
						<div class="input" name="<?php echo $component?>">
							<input class="<?php echo $key ?>" name="data[InvoiceTemplateElement][<?php echo $i;?>][name]" value="<?php echo $key ?>" type="hidden">
							<input class="p_top" name="data[InvoiceTemplateElement][<?php echo $i;?>][p_top]" type="hidden">
							<input class="p_left" name="data[InvoiceTemplateElement][<?php echo $i;?>][p_left]" type="hidden">
							<input class="width" name="data[InvoiceTemplateElement][<?php echo $i;?>][width]" type="hidden">
							<input class="height" name="data[InvoiceTemplateElement][<?php echo $i;?>][height]" type="hidden">
						</div>
					</a>

				</li>
				<?php $i++; endforeach;?>				
			</ul>
			</div>
			<?php endforeach;?>

			<!-- ELEMENTOS DE UNA VENTA -->

			<?php foreach ($structure['Contact'] as $part => $components):?>
			<h4><?php echo __($part, true)?></h4>
			<ul class="nav nav-pills nav-stacked">
				<?php foreach ($components as $key => $component):?>
				<li role="presentation">
					<a href="#" class="component">
						<?php echo $component?>
						<div class="input" name="<?php echo $component?>">
							<input class="<?php echo $key ?>" name="data[InvoiceTemplateElement][<?php echo $i;?>][name]" value="<?php echo $key ?>" type="hidden">
							<input class="p_top" name="data[InvoiceTemplateElement][<?php echo $i;?>][p_top]" type="hidden">
							<input class="p_left" name="data[InvoiceTemplateElement][<?php echo $i;?>][p_left]" type="hidden">
							<input class="width" name="data[InvoiceTemplateElement][<?php echo $i;?>][width]" type="hidden">
							<input class="height" name="data[InvoiceTemplateElement][<?php echo $i;?>][height]" type="hidden">
						</div>
					</a>

				</li>
				<?php $i++; endforeach;?>				
			</ul>
			<?php endforeach;?>
			  
	
			
		</div>

		<div class="col-md-9">
			<!-- <p class="bs-callout bs-callout-info">
				<h4>Dealing with specificity</h4>
				<p>Sometimes emphasis classes cannot be applied due to the specificity of another selector. In most cases, a sufficient workaround is to wrap your text in a <span> with the class.</p> -->
			<?php echo $this->Form->create('InvoiceTemplate');?>
			<div id="invoice_body">
				<div class="grid-container">
					<?php 
						for ($i=0; $i < 3000; $i++) { 
							echo '<div class="grid"></div>';
						}
					?>

					<?php 
					$i = 0;
					foreach ($this->data['InvoiceTemplateElement'] as $key => $element):
					?>
					<div class="input resizeDiv ui-resizable ui-draggable ui-draggable-handle" name="Issue Date" style="height: <?php echo $element['height']?>px; left: <?php echo $element['p_left']?>px; top: <?php echo $element['p_top']?>px; width: <?php echo $element['width'];?>px">
						<input class="issue_date" name="data[InvoiceTemplateElement][<?php echo $i;?>][id]" value="<?php echo $element['id']?>" type="hidden">
						<input class="issue_date" name="data[InvoiceTemplateElement][<?php echo $i;?>][name]" value="<?php echo $element['name']?>" type="hidden">
						<input class="p_top" name="data[InvoiceTemplateElement][<?php echo $i;?>][p_top]" type="hidden" value="<?php echo $element['p_top']?>">
						<input class="p_left" name="data[InvoiceTemplateElement][<?php echo $i;?>][p_left]" type="hidden" value="<?php echo $element['p_left']?>">
						<input class="width" name="data[InvoiceTemplateElement][<?php echo $i;?>][width]" type="hidden" value="<?php echo $element['width']?>">
						<input class="height" name="data[InvoiceTemplateElement][<?php echo $i;?>][height]" type="hidden" value="<?php echo $element['height']?>">
						<p><?php echo $element['name']?></p>
<!-- 						<div class="ui-resizable-handle ui-resizable-e" style="z-index: 90;"></div>
						<div class="ui-resizable-handle ui-resizable-s" style="z-index: 90;"></div>
						<div class="ui-resizable-handle ui-resizable-se ui-icon ui-icon-gripsmall-diagonal-se" style="z-index: 90;"></div> -->
					</div>
					<?php 
					$i++;
					endforeach;
					?>

				</div>

			</div>
			<!-- <h4>Elementos</h4> -->

		</div>
	</div>
</div>

<style type="text/css">
	#invoice_body{
		border: 1px solid #ddd;	
		width: 100%;
		height: 30cm;
	}


	#invoice_body div.grid-container {
	    width: auto;
	    /*height: 600px;*/
	}

	#invoice_body div.grid-container div.grid {
	    width: 1cm;
	    height: 1cm;
	    outline: 1px dotted #E2E2E2;
	    float: left;
	}

	#invoice_body div.input{
		position: absolute;
		top: 0;
		left: 0;
		border: 1px solid #E2E2E2;
		background: #E2E2E2;
		height: 1cm;
		width: auto;

	}
</style>

<script type="text/javascript">
	$(document).ready(function(){

		bindElements();

		$('a.component').unbind('click');
		$('a.component').click(function(){
			tr = $(this).find('div.input');
			tr.append('<p>'+$(tr).attr('name')+'</p>');
			$(tr).addClass('resizeDiv');
			console.log(tr);
			$('#invoice_body').append(tr);


			bindElements();

			

		});

		$('#saveTemplate').unbind('click');
		$('#saveTemplate').click(function(){

			var data = $('form').serialize();

			data += '&data[InvoiceTemplate][name]=' + $('#name').val();
			data += '&data[InvoiceTemplate][document_type]=' + $('#document_type').val();

			if($('#invoice_id').val().length>0){
				data += '&&data[InvoiceTemplate][id]='+$('#invoice_id').val();
			}

			$.ajax({
		        type: "GET",
		        url: "<?php echo $html->url(array("controller"=>"invoice_templates", "action"=>"ajax_save")); ?>",
		        data: data,
		        success: function(msg){
		          reply = JSON.parse(msg);
		          console.log(reply);
		          $('#invoice_id').val(reply['data']['id']);
		        }
		      });
		});

	});

	function bindElements(){

		$('.input.resizeDiv').dblclick(function(){
			$(this).remove();
		}); 

			$('.resizeDiv').resizable({
				containment: "#invoice_body",
				grid: 20
			});

			$('.resizeDiv').draggable({
				containment: "#invoice_body",
				ghost: true,
				start: function(){
					console.log("start");
				},
				stop: function(){
					console.log($(this));
					setSettings($(this));
				},
			});
	}

	function setSettings(element){
		var position = $(element).position();
		// var top = $(element).

		console.log($(element));

		$(element).find('.p_top').val(position['top']);
		$(element).find('.p_left').val(position['left']);
		$(element).find('.width').val($(element).width());
		$(element).find('.height').val($(element).height());
		// console.log($(element).position());
	}


</script>


  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <!-- <link rel="stylesheet" href="/resources/demos/style.css"> -->