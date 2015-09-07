<?php echo $this->element('../sales/_js');?>
<div class="panel panel-default">
  <div class="panel-body">
    
  	<?php echo $form->create('Sale', array('url'=>$this->passedArgs + array("?"=>$_GET))); ?>
      <?php
        echo $form->input('id');
      ?>
      <div class="row">
      <?php 
        echo $form->input('issue_date', array('class'=>'datepicker form-control not-empty', 'value'=>(!empty($this->data['Sale']['issue_date'])?$this->data['Sale']['issue_date']:date('Y-m-d'))));       
        echo $form->input('bill', array('md-cols'=>3, 'type'=>'select', 'label'=>'Fiscal','class'=>'selectpicker show-tick','options'=>array(true=>__('Yes', true), false=>__('No',true))));
        echo $form->input('document_id', array('md-cols'=>3, 'type'=>'select', 'label'=>__('Document',true),'class'=>'selectpicker show-tick','options'=>$documents));
        echo $form->input('invoice_number', array('class'=>'not-empty')); 
      ?>
      </div>
      <div class="row">
      <?php
        echo $form->input('contact_id', array('class'=>'selectpicker show-tick', 'data-live-search'=>"true", 'md-cols'=>6, 'value'=>(!empty($this->data['Sale']['contact_id'])?$this->data['Sale']['contact_id']:'')));
        echo $form->input('currency_id', array('class'=>'selectpicker show-tick'));
        echo $form->input('currency_price', array('step'=>'any', 'class'=>'not-empty'));    
      ?>
      </div>
      <div class="row">
      <?php
        echo $form->input('notes', array('md-cols'=>12));
      ?>
      </div>
      <!-- <input id="SaleAmount" value="0" name="data[Sale][amount]" type="hidden">  -->
      <?php $cols = 3; ?>
      <div class="row">
         <div class="col-md-12">
          <h4><?php __("Items") ?></h4>
          <table class="table table-responsive table-bordered">
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
                    <!-- <td></td> -->
                    <td></td>
                    <?php foreach ($taxes as $key => $tax):?>
                    <td></td>
                    <?php endforeach;?>
                    <td></td>
                    <td></td>
                  </tr>
                  <?php $index_se = 0;?>
                  <?php 
                    if(!empty($this->data['SalesExpense'])){
                    foreach ($this->data['SalesExpense'] as $key_se => $se):
                  ?>
                  
                  <tr class="item">
                    <?php 
                      $subtotal = 0;
                    ?>
                    <td class="pk"><?php echo $key_se+1;?></td>
                    <td>
                      <input class="sales_expense_id" type="hidden" name="data[SalesExpense][<?php echo $index_se?>][id]" value="<?php echo $se['id'];?>"> 
                      <?php echo $se['Expense']['name']; ?></td>
                    <td><?php echo $se['Expense']['sell_price']; ?></td>
                    
                    <?php foreach ($se['SalesExpensesPrice'] as $sep):?>

                      <?php $index_sep = 0;?>
                      <?php if(empty($sep['tax_id'])):?>
                      <input type="hidden" name="data[SalesExpense][<?php echo $index_se?>][SalesExpensesPrice][<?php echo $index_sep?>][id]" value="<?php echo $sep['id'];?>"> 
                      <?php endif;?>
                      <?php $index_sep++;?>
                      <?php foreach ($taxes as $tax_id => $tax):?>
                        <?php if($sep['tax_id'] == $tax_id):?>
                        <td>
                          <input type="hidden" name="data[SalesExpense][<?php echo $index_se?>][SalesExpensesPrice][<?php echo $index_sep?>][id]" value="<?php echo $sep['id'];?>"> 
                          <input type="number" name="data[SalesExpense][<?php echo $index_se?>][SalesExpensesPrice][<?php echo $index_sep?>][price]" class="amount tax_amount tax_amount_<?php echo $sep['tax_id'];?>" value="<?php echo !empty($sep['price'])?$sep['price']:0;?>" /><?php $subtotal += $sep['price'];?></td>
                        <?php endif;?>
                        <?php $index_sep++;?>
                      <?php endforeach;?> 
                      
                    <?php endforeach;?>

                    <td class="numeric subtotal"><?php echo $subtotal;?></td>
                    <td class="td_close"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></td>
                  </tr>
                  <?php $index_se++;?>
                  <?php
                    endforeach;
                    }
                  ?>
                </tbody>
                <tfoot>
                  <tr>
                    <td colspan="<?php echo $cols;?>">Total</td>
                    <td id="total" class="numeric"></td>
                    <td></td>
                  </tr>
                </tfoot>
              </table>
            </div>

      </div>

      <div class="row">
        <?php
          echo $form->input('payment_term', array('type'=>'select', 'md-cols'=>2, 'options'=>array('cash'=>'Cash', 'credit'=>'Credit'), 'class'=>'selectpicker show-tick'));
        ?>
      </div>  

      <div class="row" id="salesAdvance">
        <div id="collections" class="col-md-6">
          <h4><?php echo __("Advances", true)?></h4>
          <table class="table table-responsive table-bordered">
            <thead>
              <th><?php __("Advance")?></th>
              <th><?php __("Available")?></th>
              <th><?php __("Use")?></th>
              <th></th>
            </thead>
            <tbody id="advaces_used">
            <?php foreach($sale['SalesAdvance'] as $advance):?>
            <tr class="item itemAdded">
              <td><?php echo $advance['Collection']['number']?></td>
              <td class="numeric available"><?php echo $advance['amount']?></td>
              <td class="numeric">
                <input name="data[SalesAdvance][0][amount]" class="form-control use" value="770000" type="number">
              </td>
              <td class="pk">
                <input type="hidden" name="data[SalesAdvance][0][collection_id]" value="43">
                <input type="checkbox" class="advance">
              </td>
            </tr>
            <?php endforeach;?>
            </tbody>
            <tbody id="new_advances"></tbody>
          </table>
        </div>

         <div class="col-md-6" id="fundAccounts">
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
                      <input name="data[SalesFundAccount][0][id]" type="hidden" id="SaleFundAccountId0_" value="<?php echo !empty($this->data['SalesFundAccount'][0]['id'])?$this->data['SalesFundAccount'][0]['id']: '' ?>">
                      <?php  echo $form->input('fund_account_id_0', array('type'=>'select', 'name'=>'data[SalesFundAccount][0][fund_account_id]', 'md-cols' => 12, 'label'=>'', 'value'=>(!empty($this->data['SalesFundAccount'][0]['id'])?$this->data['SalesFundAccount'][0]['fund_account_id']:''), 'class'=>'selectpicker show-tick form-control', 'options'=> $fundAccounts)); ?></td>
                    <td class="numeric">
                      <input name="data[SalesFundAccount][0][amount]" readonly="readonly" type="number" step="any" cols="4" class="form-control fund_account_amount not-empty numeric" id="SaleAmount0" value="<?php echo !empty($this->data['SalesFundAccount'][0]['amount'])?$this->data['SalesFundAccount'][0]['amount']:0 ?>">
                    </td>
                    <td class="numeric">
                      <input name="data[SalesFundAccount][0][exchange_rate]" type="number" step="any" cols="4" class="form-control fund_account_amount not-empty numeric" id="SaleExchangeRate0" value="<?php echo !empty($this->data['SalesFundAccount'][0]['exchange_rate'])?$this->data['SalesFundAccount'][0]['exchange_rate']:0 ?>">
                    </td>
                    <td class="td_close"></td>
                  </tr>  
                </tbody>
              </table>
        </div>
      </div>
          
      <div class="row">
        <div class="SaleCreditDependent">  
        <?php  
          echo $form->input('overdue_date',array('class'=>'datepicker form-control'));
          echo $form->input('overdue_amount', array('step'=>'any', 'readonly'=>'readonly', 'class'=>'numeric not-empty', 'value'=>(!empty($this->data['Sale']['overdue_amount'])) ?$this->data['Sale']['overdue_amount']:0 ));
        ?>
        </div> 

        <?php
          echo $form->input('Sale.0.attachment', array('name'=>'data[SalesAttachment][0][attachment_id]', 'type'=>'hidden', 'value'=>!empty($_GET['attachment'])?$_GET['attachment']:'')); 
        ?>
      </div>


     <br/> 
     <?php echo $form->end(empty($this->data['Sale']['id']) ? __('Save', true) : __('Edit', true)); ?>
  </div>
</div>


<?php 
  $model = 'Sale'; 
  $this->set(compact('model')); 
  echo $this->element('create');
?>

<div class="modal fade" id="createExpense" tabindex="-1" role="dialog" aria-labelledby="createExpense" aria-hidden="true">
    <div class="modal-dialog modal-lm">
      <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
            <h4 class="modal-title" id="myModalLabel"><?php __("Add New Expense")?></h4>
          </div>

          <form id="ExpenseAddForm">
            <div class="panel-body">
              <div class="row">
                <div class="col-md-9">
                  <div class="form-group">
                    <label for="ExpenseName"><?php echo __("Name", true)?></label>
                    <input name="data[Expense][name]" type="text" placeholder="<?php echo __("Name of the expense account", true);?>" class=" form-control" id="ExpenseName">
                    <!-- <input name="data[Expense][purchase_enabled]" value="1" type="hidden" class=" form-control" id="ExpensePurchaseEnabeld"> -->
                  </div>
                </div>
                <?php echo $form->input('tax_id', array('id'=>'ExpenseTaxId', 'name'=>'data[ExpensesTax][0][tax_id]', 'options'=>array(''=>__("No Taxes", true)) + $taxes, 'class'=>'selectpicker show-tick')); ?>
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
