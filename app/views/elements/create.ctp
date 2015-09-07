<?php 
	$expenses_ = $expenses;
	$expenses = array(''=>__("Select", true));
	foreach ($expenses_ as $key => $value) {
		$expenses[$key] = $value['Expense']['name'];
	}
	
?>



<div class="modal fade" id="createContact" tabindex="-1" role="dialog" aria-labelledby="createContact" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
          <h4 class="modal-title" id="myModalLabel"><?php __("Add New Contact")?></h4>
        </div>
        <div class="modal-body">
        	<?php echo $this->Form->create('Contact'); ?>
        	<!-- <div class="panel panel-default"> -->
				<div class="panel-body">
					<?php
						echo $this->Form->input('name', array('md-cols'=>6));
						// echo $this->Form->input('country_id', array('options'=>$countries,'class'=>'selectpicker show-tick', 'data-live-search'=>"true"));
						// echo $this->Form->input('city_id', array('options'=>$cities,'class'=>'selectpicker show-tick', 'data-live-search'=>"true"));
						echo $this->Form->input('document_id');
						// echo $this->Form->input('address');
						// echo $this->Form->input('mobile');
						// echo $this->Form->input('phone');
						// echo $this->Form->input('email');
					?>
				</div>
			<!-- </div> -->
			  <!-- <div class="panel-body">
				  <h4><?php __("Autoinvoicing")?></h4>
				  <?php
				    echo $this->Form->input('autoinvoicing_repeat' , array('options'=>array('monthly'=>__("Monthly", true), 'yearly'=>__("Yearly", true))));
				    echo $this->Form->input('autoinvoicing_every');
				    
				    echo $this->Form->input('expense_id', array('options'=>$expenses,'class'=>'selectpicker show-tick', 'data-live-search'=>"true"));
				    echo $this->Form->input('autoinvoicing_pricing');
				    echo $this->Form->input('autoinvoicing_currency_id', array('options'=>$currencies,'class'=>'selectpicker show-tick'));
				  ?>
				  </br>
			  </div> -->
			</form>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal"><?php __("Cancel")?></button>
            <button type="button" class="btn btn-primary" id="saveContact"><?php __("Save")?></button>
        </div>  
    </div>
  </div>
</div>

<script type="text/javascript">
	$(document).ready(function(){
		$('#saveContact').unbind('click');
		$('#saveContact').click(function(){
			var data = $('#ContactAddForm').serialize();
			$.ajax({
				type: "GET",
		        url: "<?php echo $html->url(array("controller"=>"contacts", "action"=>"ajax_add")); ?>",
		        data: data,
		        success: function(msg){
		          var reply = JSON.parse(msg);
		          if(reply['status'] == 'ok'){
		          	var tr = '';
		          	tr += '<option value="'+reply['data']['Contact']['id']+'">'+reply['data']['Contact']['name']+'</option>';
		          	console.log('#<?php echo $model;?>ContactId');
		          	console.log(tr);
					$('#<?php echo $model;?>ContactId').append(tr);
		          	$('#<?php echo $model;?>ContactId').val(reply['data']['Contact']['id']);
		          	$('#ContactAddForm input').val('');
		          	$('.modal').modal('hide');
		          	$('#<?php echo $model;?>ContactId').trigger('change');
		          }else{
		          	console.log("No se guardo el contacto");
		          }
		          console.log(reply);	          
		        }
		      });
		});

		// var tr = '<a href="#" class="btn btn-success" data-toggle="modal" data-target="#createContact"><?php __("Create Contact")?></a>';
		// $('#table_options').append(tr);

	});

</script>



<style type="text/css">
	.modal-header h4{
		border-bottom: none !important;
		padding-bottom: 0px !important;
	}

</style>