<div class="panel panel-default">
	<div class="panel-body">

    
    <?php echo $this->Form->create('Collection');?>
    <div class="row">
    		<?php
    		echo $form->input('id', array('type'=>'hidden'));
        echo $form->input('Collection.0.attachment', array('name'=>'data[CollectionsAttachment][0][attachment_id]', 'type'=>'hidden', 'value'=>!empty($_GET['attachment'])?$_GET['attachment']:'')); 

        echo $form->input('issue_date', array('class'=>'datepicker form-control', 'value'=>(!empty($this->data['Collection']['issue_date'])?$this->data['Collection']['issue_date']:date('Y-m-d'))));        
    		echo $form->input('contact_id', array('class'=>'selectpicker show-tick', 'data-live-search'=>"true", 'md-cols'=>6, 'value'=>(!empty($this->data['Collection']['contact_id'])?$this->data['Collection']['contact_id']:'')));
    		echo $this->Form->input('number', array('class'=>'not-empty'));
        echo $this->Form->input('advance', array('type'=>'checkbox'));    		
    	?>
    </div>



    <div class="row" id="fundAccounts">
      <div class="col-md-6" id="receivables_div">
        <h4><?php __('Receivables') ?></h4>
        <div id="receivables">
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
                <th><?php echo __("Exchange Rate");?></th>
                <th class="pk"></th>
              </tr>
            </thead>
            <tbody>
              <tr class="sales_fund_accounts">
                <td>1</td>
                <td>
                  <?php 
                    foreach ($fundAccounts as $key => $fa) {
                        $fundAccounts_list[$fa['FundAccount']['id']] = $fa['FundAccount']['name'];
                    }
                  ?>
                  <?php  echo $form->input('fund_account_id', array('type'=>'select', 'md-cols'=>12, 'name'=>'data[CollectionsFundAccount][0][fund_account_id]', 'label'=>'', 'value'=>(!empty($this->data['CollectionsFundAccount'][0]['id'])?$this->data['CollectionsFundAccount'][0]['fund_account_id']:''), 'class'=>'selectpicker show-tick form-control', 'options'=> $fundAccounts_list)); ?></td>
                <td class="numeric">
                  <input name="data[CollectionsFundAccount][0][id]" type="hidden" step="any" cols="4" class="form-control fund_account_amount" id="CollectionId" value="<?php echo !empty($this->data['CollectionsFundAccount'][0]['id'])?$this->data['CollectionsFundAccount'][0]['id']:0 ?>">
                  <input name="data[CollectionsFundAccount][0][amount]" type="number" step="any" cols="4" class="not-empty form-control fund_account_amount" id="CollectionAmount0" value="<?php echo !empty($this->data['CollectionsFundAccount'][0]['amount'])?$this->data['CollectionsFundAccount'][0]['amount']:0 ?>">
                </td>
                <td class="numeric">
                  <input name="data[CollectionsFundAccount][0][currency_price]" type="number" step="any" cols="4" class="not-empty form-control fund_account_amount" id="CollectionCurrencyPrice0" value="<?php echo !empty($this->data['CollectionsFundAccount'][0]['currency_price'])?$this->data['CollectionsFundAccount'][0]['currency_price']:0 ?>">
                </td>
                <td class="td_close"></td>
              </tr>  
            </tbody>
        </table>
      </div>
    </div>

    <div class="row">
      <?php 
        echo $this->Form->input('amount', array('type'=>'hidden'));
        echo $this->Form->input('currency_id', array('type'=>'hidden'));
        echo $this->Form->input('notes', array('type'=>'textarea'));
        // echo $this->Form->input('exchange_rate', array('class'=>'not-empty'));
      ?>
    </div>


	</br>
	<?php echo $this->Form->end(__('Submit', true));?>
	</div>
</div>



<?php echo $this->element('../collections/_js');?>