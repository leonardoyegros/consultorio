<div class="panel panel-default">
  <?php echo $this->Form->create('Contact'); ?>
  <div class="panel-body">
  <?php
    echo $this->Form->input('id');
    echo $this->Form->input('name', array('md-cols'=>6, 'class'=>'not-empty'));
    echo $this->Form->input('document_id', array('label'=>__("Contact Id", true), 'class'=>'not-empty' ));
    echo $this->Form->input('country_id', array('options'=>$countries,'class'=>'selectpicker show-tick', 'data-live-search'=>"true"));
    echo $this->Form->input('address');
    echo $this->Form->input('phone', array('class'=>'numeric'));
    echo $this->Form->input('mobile', array('class'=>'numeric'));
    echo $this->Form->input('email' , array('class'=>'email'));
    // echo $this->Form->input('autoinvoice', array('type'=>'checkbox'));
    ?>
  </div>
  <div class="panel-body">
    <div id="autoinvoincing"> <!-- AUTOINVOICING -->
      <h4><?php __("Autoinvoicing")?></h4>
      <?php
        echo $this->Form->input('autoinvoicing_repeat' , array('options'=>array('monthly'=>__("Monthly", true), 'yearly'=>__("Yearly", true))));
        echo $this->Form->input('init_date', array('class'=>'datepicker not-null'));
        echo $this->Form->input('autoinvoicing_currency_id', array('options'=>$currencies,'class'=>'selectpicker show-tick'));
      ?>
      <div class="row"> <!-- ROW -->
        <div class="col-md-6"> <!-- COL6 -->
          <h4><?php echo __("Expenses", true)?></h4>
          <table id="contact_expenses" class="table table-responsive table-bordered" data-toggle="tooltip" title="<?php echo __("Enter the Expense Accounts here")?>" data-placement="top">
            <thead>
              <tr>
                <th><?php echo __("Expense");?></th>
                <th class="numeric"><?php echo __("Price");?></th>
                <th></th>
              </tr>
            </thead>
            <tbody class="items">
              <tr class="search">
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
                <td></td>
              </tr>
              <?php $i=0; foreach ($this->data['ContactsExpense'] as $key => $contact_expense):?>
              <tr class="item">
                <td><?php echo $contact_expense['Expense']['name']?></td>
                <td>
                    <input type="text" class="form-control" value="<?php echo $contact_expense['amount']?>" name="data[ContactsExpense][<?php echo $i;?>][amount]">
                    <input type="hidden" class="form-control" value="<?php echo $contact_expense['id']?>" name="data[ContactsExpense][<?php echo $i;?>][id]">
                    <input type="hidden" class="form-control" value="<?php echo $contact_expense['id']?>" name="data[ContactsExpense][<?php echo $i;?>][id]">
                </td>
                <td class="td_close"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></td>
              </tr>
              <?php $i++; endforeach;?>
            </tbody>
          </table>
        </div><!-- COL6 -->
      </div> <!-- ROW -->
    </div>    <!-- AUTOINVOICING -->
      <?php echo $this->Form->end(__('Submit', true));?>
  <!-- </div> -->
  </div>
</div>

<script type="text/javascript">

  var data_models = new Array;

  $(document).ready(function(){
    bindAutoinvoicing();
    bindLiveSearch();

    $('#ContactAutoinvoicingRepeat').change(function(){
      if($('#ContactAutoinvoicingRepeat').val()=='monthly'){
          $('#ContactAutoinvoicingEvery').removeClass('yearly');
          $('#ContactAutoinvoicingEvery').addClass('day');
        }else{
          $('#ContactAutoinvoicingEvery').removeClass('day');
          $('#ContactAutoinvoicingEvery').addClass('yearly');
        }
    });

  });

  function bindAutoinvoicing(){
    $('#ContactAutoinvoice').unbind('click');
    $('#ContactAutoinvoice').click(function(){
      if($(this).is(':checked')){
        $('#autoinvoincing').show();
        $('#autoinvoincing input').addClass('not-empty');
        $('#autoinvoincing input.SearchExpense').removeClass('not-empty');

        if($('#ContactAutoinvoicingRepeat').val()=='monthly'){
          $('#ContactAutoinvoicingEvery').removeClass('yearly');
          $('#ContactAutoinvoicingEvery').addClass('day');
          // $('.day').ForceNumericOnly();
        }else{
          $('#ContactAutoinvoicingEvery').removeClass('day');
          $('#ContactAutoinvoicingEvery').addClass('yearly');
        }

      }else{
        $('#autoinvoincing').hide();
        $('#autoinvoincing input').removeClass('not-empty');
      }
    });

    if($('#ContactAutoinvoice').is(':checked')){
      $('#autoinvoincing').show();
    }else{
      $('#autoinvoincing').hide();
    }
  }

  function bindLiveSearch(){
    data_models['expenses'] = <?php echo $javascript->object($expenses);?>;
    // console.log("data!");
    // console.log(data_models);

    $('input.livesearch').each(function(){
      livesearch({
        'selector' : '#'+$(this).attr('id'),
        'data' :  data_models[$(this).attr('data')],
        'field' : $(this).attr('field') || 'name',
        'model' : $(this).attr('model'),
        'callback' : $(this).attr('callback') || 'select'+$(this).attr('model')
      });
    });
  }

  function selectExpense(index){
    addItem(data_models['expenses'][index]);
    console.log(data_models['expenses'][index]['Expense']['name']);
    $('#livesearch').hide();
  }

  function addItem(expense){
    // var index = 0;

    var index = $('#contact_expenses .item').length;

    var tr = '';

    tr += '<tr class="item">';
      tr += '<td>' + expense.Expense.name + '</td>';
      tr += '<td>';
        tr += '<input type="hidden" name="data[ContactsExpense]['+index+'][expense_id]" value="'+expense.Expense.id+'"/>';
        tr += '<input type="text" class="form-control" name="data[ContactsExpense]['+index+'][amount]" value="'+(expense.Expense.sell_price||0)+'"/>';
      tr += '</td>';
      tr += '<td class="td_close"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></td>';
    tr += '</tr>';

    $('#contact_expenses tbody').append(tr);
    $('#SearchExpense').val('').focus();

  }

</script>
