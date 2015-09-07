<!-- <div class="page-header"> -->
  <!-- <h1><?php __("Document")?> <small><?php __("Add");?></small></h1> -->
<!-- </div> -->
<div class="panel panel-default">
	<!-- <div class="panel-heading"><?php __('Add Document'); ?>	</div> -->
	<div class="panel-body">
	<?php echo $this->Form->create('Document');?>
		<?php
		echo $this->Form->input('type', array('class'=>'not-empty', 'options'=>$types));
		echo $this->Form->input('code', array('label'=>'id', 'class'=>'not-empty numeric'));
		echo $this->Form->input('starts_in', array('md-cols'=>2,'class'=>'not-empty'));
		echo $this->Form->input('ends_in', array('md-cols'=>2,'class'=>'not-empty'));
		
		// echo $this->Form->input('expires_in', array('label'=>__("Expires On", true), 'autocomplete'=>false, 'class'=>'datepicker', 'md-cols'=>3));
	?>

	<div class='col-md-2'>
        <div class="form-group">
        	<label><?php __("Expires On")?></label>
            <div class='input-group date' id='datetimepicker6'>
                <input id="DocumentEndsIn" name="data[Document][expires_in]" value="<?php echo !empty($this->data['Document']['expires_in'])?$this->data['Document']['expires_in']:'';?>" autocomplete="false" type='text' class="form-control datepicker not-empty" />
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
            </div>
        </div>
    </div>
	</br>

	<?php 
		echo $this->Form->input('template_id', array('md-cols'=>2, 'options'=>$templates));
	?>

	<?php echo $this->Form->end(__('Submit', true));?>
	</div>
</div>


<script type="text/javascript">
	$(document).ready(function(){
		$('input').change(function(){
			documentValidations();
		});

	});


	function documentValidations () {

		var start = $('#DocumentStartsIn').val();
		var end = $('#DocumentEndsIn').val();

		start = start.replace(/-/g,"");
		end = end.replace(/-/g,"");

		console.log(start);
		console.log(end);

		if(eval(start) >= eval(end)){
			thisInvalid($('#DocumentStartsIn'), '<?php echo __("Starts in number must me minor than Ends in number")?>');
			$('input[type=submit]').attr('disabled', true);
			return false;
		}

		
		return true;
	}

</script>


<style type="text/css">
	input[type=submit]{
		margin-top: 100px !important;
	}

</style>

<script type="text/javascript">
	$(document).ready(function(){
		//$('input').trigger('change');
	});
</script>