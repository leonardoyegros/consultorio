<?php //print_r($this->data); die();?>

<?php echo $this->element('../purchases/_js');?>



<div class="panel panel-default">
	<div class="panel-body">
	<?php echo $this->Form->create('Purchase');?>
  <div class="row">
    <?php 
      // OCULTOS
      echo $form->input('id');
      echo $form->input('Purchase.0.attachment', array('name'=>'data[PurchasesAttachment][0][attachment_id]', 'type'=>'hidden', 'value'=>!empty($_GET['attachment'])?$_GET['attachment']:'')); 

      echo $form->input('invoice_date', array('class'=>'datepicker form-control', 'value'=>(!empty($this->data['Purchase']['invoice_date'])?$this->data['Purchase']['invoice_date']:date('Y-m-d'))));
      echo $this->Form->input('invoice_number', array('class'=>'not-empty', 'placeholder' => __("Please enter the invoice number", true)));
      echo $this->Form->input('payment_term', array('options'=>array('cash'=>__("Cash", true), 'credit'=>__("Credit", true))));
      echo $this->Form->input('fiscal', array('type'=>'checkbox', 'md-cols'=>1, 'checked' => (!empty($this->data['Purchase']['id']) ? ($this->data['Purchase']['fiscal']?"checked":"") : "checked" ) ));
    ?>

  </div>

  <div class="row">
  <?php 
    echo $form->input('contact_id', array('label'=>__('Provider', true), 'model' => 'Contact',  'class'=>'selectpicker show-tick', 'data-live-search'=>"true", 'md-cols'=>6, 'value'=>(!empty($this->data['Purchase']['contact_id'])?$this->data['Purchase']['contact_id']:'')));
    echo $form->input('currency_id', array('class'=>'selectpicker show-tick', 'options'=>$currencies_list));
    echo $this->Form->input('exchange_rate');
  ?>
  </div>

	<div class="row">
  <?php
    echo $this->Form->input('notes', array('type'=>'textarea'));
  ?>
	</div>
	</br>
	<div class="row">
        <div class="col-md-12">
          <h4>Items</h4>
          <table class="table table-responsive table-bordered" data-toggle="tooltip" title="<?php echo __("Enter your Purchase Items here")?>" data-placement="top">
                <thead>
                  <tr>
                    <th class="pk"></th>
                    <th><?php echo __("Item");?></th>
                    <th class="numeric"><?php echo __("No Taxed");?></th>
                    <?php foreach ($taxes as $key => $tax):?>
                    <th class="numeric"><?php echo __($tax, true);?></th>
                    <?php $cols++; endforeach;?>
                    <th class="numeric"><?php echo __("SubTotal");?></th>
                    <th></th>
                  </tr>
                </thead>
                <tbody class="items">
                  <tr class="search">
                    <td class="pk"></td>
                    <td>
                      <div class="input text">
                          <div class="col-md-12">
                            <div class="form-group">
                              <input class="form-control SearchExpense livesearch search" model="Expense" data="expenses" field="name" type="text" cols="12" id="SearchExpense">
                            </div>
                          </div>
                      </div>
                    </td>
                    <td></td>
                    <?php foreach ($taxes as $key => $tax):?>
                    <td></td>
                    <?php endforeach;?>
                    <td></td>
                    <td></td>
                  </tr>
                  <?php 
                    if(!empty($this->data['PurchasesExpense'])){
                    foreach ($this->data['PurchasesExpense'] as $key_pe => $pe):
                      $subtotal = 0;
                  ?>
                  <tr class="item">
                    <td class="pk"><?php echo $key_pe+1;?></td>
                    <td>
                      <input name="data[PurchasesExpense][<?php echo $key_pe;?>][id]" class="no_tax" value="<?php echo $pe['id']?>" type="hidden">
                      <input name="data[PurchasesExpense][<?php echo $key_pe;?>][expense_id]" class="no_tax" value="<?php echo $pe['expense_id']?>" type="hidden">
                      <?php echo $pe['Expense']['name']?>
                    </td>
                    <td>
                      <input name="data[PurchasesExpense][<?php echo $key_pe;?>][PurchasesExpensesPrice][0][id]" class="no_tax" value="<?php echo $pe['PurchasesExpensesPrice'][0]['id']?>" type="hidden">
                      <input name="data[PurchasesExpense][<?php echo $key_pe;?>][PurchasesExpensesPrice][0][tax_id]" class="no_tax" value="" type="hidden">
                      <input step="any" name="data[PurchasesExpense][<?php echo $key_pe;?>][PurchasesExpensesPrice][0][price]" class="amount no_tax_amount" value="<?php echo !empty($pe['PurchasesExpensesPrice'][0]['price'])?$pe['PurchasesExpensesPrice'][0]['price']:0?>" type="number">
                      <?php $subtotal += $pe['PurchasesExpensesPrice'][0]['price'];?>
                    </td>
                    <?php $i = 1;?>
                    <?php foreach ($taxes as $tax_id => $tax):?>
                    <?php foreach ($pe['PurchasesExpensesPrice'] as $pep):?>
                    <?php if($pep['tax_id'] == $tax_id):?>
                    <td>

                      <?php 
                        $disable = 'disabled="disabled"';
                        foreach ($pe['ExpensesTax'] as $expT) {
                          if($expT['tax_id']==$tax_id){
                            $disabled = '';
                          }
                        }
                      ?>


                      <input name="data[PurchasesExpense][<?php echo $key_pe;?>][PurchasesExpensesPrice][<?php echo $i?>][id]" class="taxed" value="<?php echo $pep['id']?>" type="hidden">
                      <input name="data[PurchasesExpense][<?php echo $key_pe;?>][PurchasesExpensesPrice][<?php echo $i?>][tax_id]" class="taxed" value="<?php echo $pep['tax_id']?>" type="hidden">
                      <input <?php echo $disabled;?> step="any" name="data[PurchasesExpense][<?php echo $key_pe;?>][PurchasesExpensesPrice][<?php echo $i?>][price]" class="amount tax_amount" value="<?php echo !empty($pep['price'])?$pep['price']:0?>" type="number">
                      <?php $subtotal += $pep['price'];?>
                    </td>
                    <?php endif;?>
                    <?php endforeach;?>  
                    <?php $i++;?>                 
                    <?php endforeach;?>
                    <td class="numeric subtotal"><?php echo $subtotal; ?></td>
                    <td class="td_close"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></td>
                  </tr>

                  <?php
                    endforeach;
                    }
                  ?>
                </tbody>
                <tfoot>
                  <tr>
                    <td colspan="<?php echo $cols + 3;?>">Total</td>
                    <td id="total" class="numeric"></td>
                    <td></td>
                  </tr>
                </tfoot>
          </table>
        </div>

  </div>

  <div class="row">
  <?php     
    echo $this->Form->input('total', array('readonly'=>'readonly', 'type'=>'hidden'));
  ?>
  </div>


  <div class="row">
    <div class="col-md-6" id="fundAccounts">
      <h4>Fund Accounts</h4>
      <table id="fundAccounts" class="table table-responsive table-bordered">
      <thead>
      <tr>
      <th class="pk"></th>
      <th><?php echo __("Fund Account");?></th>
      <th><?php echo __("Amount");?></th>
      <th><?php echo __("Exchange Rate");?></th>
      </tr>
      </thead>
      <tbody>
      <tr class="sales_fund_accounts" index="0">
      <td>1</td>
      <td>
      <input type="hidden" name="data[PurchasesFundAccount][0][id]"  value="<?php echo (!empty($this->data['PurchasesFundAccount'][0]['id'])?$this->data['PurchasesFundAccount'][0]['id']:'')?>"/>
      <?php  echo $form->input('fund_account_id', array('type'=>'select', 'name'=>'data[PurchasesFundAccount][0][fund_account_id]', 'label'=>'', 'value'=>(!empty($this->data['PurchasesFundAccount'][0]['fund_account_id'])?$this->data['PurchasesFundAccount'][0]['fund_account_id']:''), 'class'=>'selectpicker show-tick form-control', 'md-cols'=>12, 'options'=> $fund_accounts_list)); ?></td>
      <td class="numeric">
      <input name="data[PurchasesFundAccount][0][amount]" readonly="readonly" type="text"  cols="4" class="form-control fund_account_amount not-empty" id="PurchaseFundAccountAmount" value="<?php echo !empty($this->data['PurchasesFundAccount'][0]['amount'])?$this->data['PurchasesFundAccount'][0]['amount']:0 ?>">
      </td>
      <td class="numeric"><input name="data[PurchasesFundAccount][0][exchange_rate]" type="text"  cols="4" class="form-control fund_account_exchange_rate" id="PurchaseFundAccountExchangeRate" value="<?php echo !empty($this->data['PurchasesFundAccount'][0]['exchange_rate'])?$this->data['PurchasesFundAccount'][0]['exchange_rate']:0 ?>"></td>
      </tr>  
      </tbody>
      </table>
    </div>
    <div id="payments" class="col-md-6">
      <h4><?php echo __("Advances")?></h4>
      <table class="table table-responsive table-bordered">
      <thead>
      <th><?php __("Advance")?></th>
      <th><?php __("Available")?></th>
      <th><?php __("Use")?></th>
      <th></th>
      </thead>
      <tbody>
      </tbody>
      </table>
    </div>
  </div>
  <div class="row credit_inputs">
  <?php
  echo $this->Form->input('overdue_date', array('class'=>'datepicker form-control'));
  echo $this->Form->input('overdue_amount');
  ?>
  </div> 

	<?php echo $this->Form->end(__('Save', true));?>
	</div>
</div>

<?php
  $currencies = $currencies_list; 
  $model = 'Purchase'; 
  $this->set(compact('model')); 
  // echo $this->element('create');
?>

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
            echo $this->Form->input('country_id', array('options'=>$countries,'class'=>'selectpicker show-tick', 'data-live-search'=>"true"));
            echo $this->Form->input('city_id', array('options'=>$cities,'class'=>'selectpicker show-tick', 'data-live-search'=>"true"));
            echo $this->Form->input('document_id');
            echo $this->Form->input('address');
            echo $this->Form->input('mobile');
            echo $this->Form->input('phone');
            echo $this->Form->input('email');
          ?>
        </div>
      <!-- </div> -->
        <div class="panel-body">
          <h4><?php __("Autoinvoicing")?></h4>
          <?php
            echo $this->Form->input('autoinvoicing_repeat' , array('options'=>array('' => __('Select', true)) + array('monthly'=>__("Monthly", true), 'yearly'=>__("Yearly", true))));
            echo $this->Form->input('autoinvoicing_every');
            
            echo $this->Form->input('expense_id', array('options'=>$expenses,'class'=>'selectpicker show-tick', 'data-live-search'=>"true"));
            echo $this->Form->input('autoinvoicing_pricing');
            echo $this->Form->input('autoinvoicing_currency_id', array('options'=>array('' => __('Select', true)) + $currencies_list,'class'=>'selectpicker show-tick'));
          ?>
          </br>
        </div>
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
      var data = $('#Contact<?php echo !empty($this->data['Purchase']['id']) ? "Edit" : "Add" ?>Form').serialize();
      console.log("Guardando Contacto");
      console.log(data);
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


<div class="modal fade" id="createExpense" tabindex="-1" role="dialog" aria-labelledby="createExpense" aria-hidden="true">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
            <h4 class="modal-title" id="myModalLabel"><?php __("Add New Expense")?></h4>
          </div>

          <form id="ExpenseAddForm">
            <div class="panel-body">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="ExpenseName"><?php echo __("Name", true)?></label>
                    <input name="data[Expense][name]" type="text" placeholder="<?php echo __("Name of the expense account", true);?>" class=" form-control" id="ExpenseName">
                    <!-- <input name="data[Expense][purchase_enabled]" value="1" type="hidden" class=" form-control" id="ExpensePurchaseEnabeld"> -->
                  </div>
                </div>
              </div>
            </div>
          </form>

         <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal"><?php __("Cancel")?></button>
              <button type="button" class="btn btn-primary" id="saveExpense"><?php __("Save")?></button>
          </div> 


      </div>
    </div>
  </div>

