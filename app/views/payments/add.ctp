<?php //print_r($this->data); die();?>

<div class="panel panel-default">
	<div class="panel-body">
	<?php echo $this->Form->create('Payment');?>
	<div class="row">
		<?php
		echo $form->input('id', array('type'=>'hidden'));
		echo $form->input('Payment.0.attachment', array('name'=>'data[PaymentsAttachment][0][attachment_id]', 'type'=>'hidden', 'value'=>!empty($_GET['attachment'])?$_GET['attachment']:'')); 
		echo $form->input('contact_id', array('class'=>'selectpicker show-tick', 'data-live-search'=>"true", 'md-cols'=>6, 'value'=>(!empty($this->data['Payment']['contact_id'])?$this->data['Payment']['contact_id']:'')));
		echo $form->input('issue_date', array('class'=>'datepicker form-control', 'value'=>(!empty($this->data['Payment']['issue_date'])?$this->data['Payment']['issue_date']:date('Y-m-d'))));
		
		echo $this->Form->input('advance', array('type'=>'checkbox', 'data-toggle'=>'tooltip', 'title'=>__("Mark this options for make an advace payment", true)));
		
		echo $this->Form->input('number');
		echo $this->Form->input('notes', array('type'=>'textarea'));
		echo $this->Form->input('amount', array('type'=>'hidden'));
		echo $this->Form->input('currency_id', array('type'=>'hidden'));
		echo $this->Form->input('exchange_rate');
	?>
	</div>
	<div class="row" id="fundAccounts">
	      <div class="col-md-6">
	        <h4><?php __('Payables') ?></h4>
	        <div id="payables">
	          <span class=""><?php __("No data to display");?></span>
	        </div>
	      </div>
	      <div class="col-md-6">
	        <h4>Fund Accounts</h4>
	        <table class="table table-responsive table-bordered">
	            <thead>
	              <tr>
	                <th class="pk"></th>
	                <th><?php echo __("Fund Account");?></th>
	                <th><?php echo __("Amount");?></th>
	                <th class="pk"></th>
	              </tr>
	            </thead>
	            <tbody>
	              <tr class="payments_fund_accounts">
	                <td>1</td>
	                <td>
	                  <?php  echo $form->input('fund_account_id', array('type'=>'select', 'md-cols'=>12, 'name'=>'data[PaymentsFundAccount][0][fund_account_id]', 'label'=>'', 'value'=>(!empty($this->data['PaymentsFundAccount'][0]['id'])?$this->data['PaymentsFundAccount'][0]['fund_account_id']:''), 'class'=>'selectpicker show-tick form-control', 'options'=> $fundAccounts)); ?></td>
	                <td class="numeric">
	                	<?php if(!empty($this->data['PaymentsFundAccount'][0]['id'])):?>
	                	<input name="data[PaymentsFundAccount][0][id]" type="hidden" value="<?php echo !empty($this->data['PaymentsFundAccount'][0]['id'])?$this->data['PaymentsFundAccount'][0]['id']:'' ?>">
		                <?php endif;?>
	                  	<input name="data[PaymentsFundAccount][0][amount]" type="number" step="any" cols="4" class="form-control fund_account_amount" id="PaymentAmount0" value="<?php echo !empty($this->data['PaymentsFundAccount'][0]['amount'])?$this->data['PaymentsFundAccount'][0]['amount']:0 ?>">
	                </td>
	                <td class="td_close"></td>
	              </tr>  
	            </tbody>
	        </table>
	      </div>
	    </div>
	</br>
	<?php echo $this->Form->end(__('Submit', true));?>
	</div>
</div>



<?php echo $this->element('../payments/_js');?>