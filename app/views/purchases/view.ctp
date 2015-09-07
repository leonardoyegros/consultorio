<div class="purchases view">
	<div class="col-md-12">
		<ul class="nav nav-tabs">
		  <li role="contact-data" class="active"><a href="#">Purchase Data</a></li>
		  <li role="files"><a href="#"><?php echo __('Files', true)?></a></li>
		  <li role="audit-data"><a href="#">Audit Data</a></li>
		</ul>
		<div class="panel panel-default" role="contact-data">
			<dl><?php $i = 0; $class = ' class="altrow"';?>
				<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
				<dd<?php if ($i++ % 2 == 0) echo $class;?>>
					<?php echo $purchase['Purchase']['id']; ?>
					&nbsp;
				</dd>
				<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Invoice Date'); ?></dt>
				<dd<?php if ($i++ % 2 == 0) echo $class;?>>
					<?php echo $purchase['Purchase']['invoice_date']; ?>
					&nbsp;
				</dd>
				<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Contact'); ?></dt>
				<dd<?php if ($i++ % 2 == 0) echo $class;?>>
					<?php echo $this->Html->link($purchase['Contact']['name'], array('controller' => 'contacts', 'action' => 'view', $purchase['Contact']['id'])); ?>
					&nbsp;
				</dd>
				<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Fiscal'); ?></dt>
				<dd<?php if ($i++ % 2 == 0) echo $class;?>>
					<?php echo $purchase['Purchase']['fiscal'] ?  __("Yes", true) : __("No", true); ?>
					&nbsp;
				</dd>
				<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Invoice Number'); ?></dt>
				<dd<?php if ($i++ % 2 == 0) echo $class;?>>
					<?php echo $purchase['Purchase']['invoice_number']; ?>
					&nbsp;
				</dd>
				<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Currency'); ?></dt>
				<dd<?php if ($i++ % 2 == 0) echo $class;?>>
					<?php echo $this->Html->link($purchase['Currency']['name'], array('controller' => 'currencies', 'action' => 'view', $purchase['Currency']['id'])); ?>
					&nbsp;
				</dd>
				<?php if($purchase['Purchase']['exchange_rate']!=1):?>
				<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Exchange Rate'); ?></dt>
				<dd<?php if ($i++ % 2 == 0) echo $class;?>>
					<?php echo $purchase['Purchase']['exchange_rate']; ?>
					&nbsp;
				</dd>
				<?php endif;?>
				<!-- <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Total'); ?></dt>
				<dd<?php if ($i++ % 2 == 0) echo $class;?>>
					<?php echo $this->Format->number($purchase['Purchase']['total'],'money', array('symbol'=>'') + $purchase['Currency']);?>
					&nbsp;
				</dd> -->
				<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Payment Term'); ?></dt>
				<dd<?php if ($i++ % 2 == 0) echo $class;?>>
					<?php echo __(ucfirst($purchase['Purchase']['payment_term']), true); ?>
					&nbsp;
				</dd>
				<?php if($purchase['Purchase']['payment_term'] == 'credit'):?>
				<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Overdue Date'); ?></dt>
				<dd<?php if ($i++ % 2 == 0) echo $class;?>>
					<?php echo $purchase['Purchase']['overdue_date']; ?>
					&nbsp;
				</dd>
				<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Overdue Amount'); ?></dt>
				<dd<?php if ($i++ % 2 == 0) echo $class;?>>
					<?php echo $this->Format->number($purchase['Purchase']['overdue_amount'],'money', array('symbol'=>'') + $purchase['Currency']); ?>
					&nbsp;
				</dd>
				<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Paid'); ?></dt>
				<dd<?php if ($i++ % 2 == 0) echo $class;?>>
					<?php echo $this->Format->number($purchase['Purchase']['paid'],'money', array('symbol'=>'') + $purchase['Currency']); ?>
					&nbsp;
				</dd>
				<?php endif;?>
				<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Notes'); ?></dt>
				<dd<?php if ($i++ % 2 == 0) echo $class;?>>
					<?php echo $purchase['Purchase']['notes']; ?>
					&nbsp;
				</dd>
			</dl>
			<div class="row">
				<div class="col-md-12">
					<h4>Items</h4>
					<table class="table table-responsive table-bordered">
					    <thead>
					      <tr>
					        <th class="pk"></th>
					        <th><?php echo __("Item");?></th>
					        <th><?php echo __("Quantity");?></th>
					        <th class="numeric"><?php echo __("No Taxed");?></th>
					        <?php foreach ($taxes as $key => $tax):?>
					        <th class="numeric"><?php echo __($tax, true);?></th>
					        <?php $cols++; endforeach;?>
					        <th class="numeric"><?php echo __("SubTotal");?></th>
					      </tr>
					    </thead>
					    <tbody class="items">
					    	<?php 
					    		$total = 0;
					    		$i = 0;
					    	?>
					    	<?php foreach ($purchase['PurchasesExpense'] as $key => $purchase_expense):?>
					    	<tr>
					    		<td><?php echo $i+1;?></td>
					    		<td><?php echo $purchase_expense['Expense']['name'];?></td>
					    		<td class="numeric">1</td>
					    		<?php $subtotal = 0; $cols=0;?>
					    		<?php foreach ($purchase_expense['PurchasesExpensesPrice'] as $key2 => $tax):?>
						        <td class="numeric"><?php echo $this->Format->number($tax['price'],'money', array('symbol'=>'') + $purchase['Currency']);?></td>
						        <?php $cols++; $subtotal+=$tax['price']; endforeach;?>
						        <?php $total += $subtotal;?>
						        <td class="numeric"><?php echo $this->Format->number($subtotal,'money', array('symbol'=>'') + $purchase['Currency']);?></td>
					    	</tr>
					    	<?php $i++;endforeach;?>
					    	<tr>
					    		<th class="left" colspan="<?php echo $cols+3; ?>"><?php __("Total")?></th>
					    		<td class="numeric"><?php echo $this->Format->number($total,'money', array('symbol'=>'') + $purchase['Currency']);?></td>
					    	</tr>
					    </tbody>
					   </table>	
					</div>
				</div>

				<?php if($purchase['Purchase']['payment_term'] == 'cash'):?>
				<div class="row">
					<div class="col-md-6">
						<h4><?php __("Fund Accounts")?></h4>
						<table class="table table-responsive table-bordered">
						    <thead>
						      <tr>
						        <th class="pk"></th>
						        <th><?php echo __("Fund Account");?></th>
						        <!-- <th><?php echo __("Currency");?></th> -->
						        <th><?php echo __("Amount");?></th>	
						        <th><?php echo __("Exchange Rate");?></th>
						      </tr>
						    </thead>
						    <tbody class="items">
						    	<?php 
						    		$i = 0;
						    	?>
						    	<?php foreach ($purchase['PurchasesFundAccount'] as $key => $purchases_fund_account):?>
						    	<tr>
						    		<td><?php echo $i+1;?></td>
						    		<td><?php echo $purchases_fund_account['FundAccount']['name'];?></td>
						    		<!-- <td><?php echo $purchases_fund_account['FundAccount']['Currency']['name'];?></td> -->
							        <td class="numeric"><?php echo $this->Format->number($purchases_fund_account['amount'],'money', array('symbol'=>'') + $purchases_fund_account['FundAccount']['Currency']);?></td>
							        <td class="numeric"><?php echo $this->Format->number($purchases_fund_account['exchange_rate'],'money', array('symbol'=>'') + $purchases_fund_account['FundAccount']['Currency']);?></td>
						    	</tr>
						    	<?php $i++;endforeach;?>
						    </tbody>
						   </table>	
					</div>
				<?php endif;?>

				<?php if(!empty($purchase['PurchasesAdvance'])):?>
					<div class="col-md-6">
						<h4><?php __("Advances")?></h4>
						<table class="table table-responsive table-bordered">
						    <thead>
						      <tr>
						        <th class="pk"></th>
						        <th><?php echo __("Payment");?></th>
						        <th><?php echo __("Issue Date");?></th>	
						        <th><?php echo __("Amount");?></th>	
						      </tr>
						    </thead>
						    <tbody class="items">
						    	<?php 
						    		$i = 0;
						    	?>
						    	<?php foreach ($purchase['PurchasesAdvance'] as $key => $advance):?>
						    	<tr>
						    		<td><?php echo $i+1;?></td>
						    		<td><?php echo $this->Html->link($advance['Payment']['number'], array('controller' => 'payments', 'action' => 'view', $advance['Payment']['id'])); ?></td>
						    		<td><?php echo $advance['Payment']['issue_date'];?></td>
						    		<td class="numeric"><?php echo $this->Format->number($advance['amount'],'money', array('symbol'=>''));?></td>
						    	</tr>
						    	<?php $i++;endforeach;?>
						    </tbody>
						   </table>	
					</div>
				<?php endif;?>
				</div>

				<?php if(!empty($purchase['PurchasesPayment'])):?>
				<div class="row">
					<div class="col-md-12">
						<h4><?php __("Payments")?></h4>
						<table class="table table-responsive table-bordered">
						    <thead>
						      <tr>
						        <th class="pk"></th>
						        <th><?php echo __("Payment");?></th>
						         <th><?php echo __("Issue Date");?></th>	
						        <th><?php echo __("Amount");?></th>	
						      </tr>
						    </thead>
						    <tbody class="items">
						    	<?php 
						    		$i = 0;
						    	?>
						    	<?php foreach ($purchase['PurchasesPayment'] as $key => $payment):?>
						    	<tr>
						    		<td><?php echo $i+1;?></td>
						    		<td><?php echo $this->Html->link($payment['Payment']['number'], array('controller' => 'payments', 'action' => 'view', $payment['Payment']['id'])); ?></td>
						    		<td><?php echo $advance['Payment']['issue_date'];?></td>
						    		<td class="numeric"><?php echo $this->Format->number($payment['amount'],'money', array('symbol'=>''));?></td>
						    	</tr>
						    	<?php $i++;endforeach;?>
						    </tbody>
						   </table>	
					</div>
				</div>
				<?php endif;?>

		</div>
		<div class="panel panel-default" role="audit-data">
			<dl>
				<dt><?php echo __('Created'); ?></dt>
				<dd>
					<?php echo h($purchase['Purchase']['created']); ?>
					&nbsp;
				</dd>
				<dt><?php echo __('Modified'); ?></dt>
				<dd>
					<?php echo h($purchase['Purchase']['modified']); ?>
					&nbsp;
				</dd>
				
			</dl>
		</div>

		<div class="panel panel-default" role="files">
			<div class="row file_thumbs">
		      <?php 
		        $i = 0;
		        foreach ($purchase['PurchasesAttachment'] as $key => $attachment):?>

		        <?php 
		          $name = explode('.', $attachment['Attachment']['name']);
		        ?>

		        <div attachment_id="<?php echo $attachment['Attachment']['id']?>" id="file_<?php echo $attachment['Attachment']['id']?>" class="col-md-2 file">

		          <div class="file_thumb">
		            <span class="glyphicon glyphicon-file"></span>
		            <!-- <span class="extension"><?php echo !empty($name[1])?$name[1]:''?></span> -->
		          </div>
		          <div class="description">
		            <h5><?php echo $attachment['Attachment']['name']?></h5>

		          </div>
		          <div class="dropdown">
		            <button class="btn btn-default dropdown-toggle" type="button" id="file_action_<?php echo $i?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
		              Dropdown
		              <span class="caret"></span>
		            </button>
		            <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
		              <li><a target="_blank" href="<?php echo $this->Html->url('/')."upload/".$attachment['Attachment']['name']?>"><?php echo __("Preview", true)?></a></li>
		              <li><a attachment_id="<?php echo $attachment['Attachment']['id']?>" class="delete_item" href="<?php echo $this->Html->url(array('controller'=>'purchases','action'=>'attachment_delete', $attachment['id']))?>"><?php echo __("Delete", true)?></a></li>
		            </ul>
		          </div>
		        </div>
		        <?php $i++;endforeach;?>
		    </div>

		    <div class="row">
	          <div class="col-md-12 picture_column">
	            <div class="form-group">
	              <input type="button" class="btn btn-primary file_button" value="<?php echo __("Upload", true);?>">
	              <div class="file_input">
	               <input style="display:none;" type="file" id="exampleInputFile">
	              </div>
	            </div>              
	          </div>
	        </div>
		   


		</div>

	</div>
</div>



<script type="text/javascript">

$(document).ready(function(){
	$('input[type=file]').on('change', prepareUpload);
});


// Grab the files and set them to our variable
  function prepareUpload(event){
    files = event.target.files;
    uploadFiles(event);
  }

  // Catch the form submit and upload the files
  function uploadFiles(event){

    $('.file_button').val('<?php echo __("Uploading....", true)?>');

    event.stopPropagation(); // Stop stuff happening
    event.preventDefault(); // Totally stop stuff happening

    // START A LOADING SPINNER HERE

    // Create a formdata object and add the files
    var data = new FormData();
    $.each(files, function(key, value){
        data.append(key, value);
    });

    $.ajax({
        url: '<?php echo $html->url(array("controller"=>"purchases", "action"=>"ajax_upload", $purchase['Purchase']['id'])); ?>',
        type: 'POST',
        data: data,
        cache: false,
        dataType: 'json',
        processData: false, // Don't process the files
        contentType: false, // Set content type to false as jQuery will tell the server its a query string request
        success: function(msg){
          console.log(msg);
          // var image = '<?php echo $this->Html->url('/')."upload/"; ?>' + msg['name'];
          // $('#my_account_image').attr('src', image);

          $('.file_button').val('<?php echo __("Ok", true)?>');
          $('.file_button').val('<?php echo __("Upload", true)?>');
          document.location.reload();
          // console.log("Archivo agregado");
        } 
    });
}

</script>