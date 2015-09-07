<script type="text/javascript">
  $(document).ready(function(){

    bindCurrency();
    bindPaymentTerm();
    bindAddItem();
    bindLiveSearch();
    bindContact();
    bindAdvances();

    $('select').change(function(){
      console.log('validando elemento en cambio');
      var valid = validateElements();
      if(!valid){
        $('input[type=submit]').attr('disabled', true);
        return false;
      }
      $('input[type=submit]').attr('disabled', false);
    });

     $('input.validate').blur(function(){
      // console.log('validando elemento en cambio');
      var valid = validateElements();
      if(!valid){
        $('input[type=submit]').attr('disabled', true);
        return false;
      }
      $('input[type=submit]').attr('disabled', false);
    });

    $('#ExpenseName').focus(function(){
      $('#ExpenseName').val($('#SearchExpense').val()); 
    });

    $('form').submit(function(){
      if($('#SaleContactId').val().length == 0){
        $('#SaleContactId').select().focus();
        thisInvalid($('#SaleContactId'), '<?php echo __("Please select a Contact", true)?>');
        $('#SaleContactId').parent().find('.form-control-feedback').remove();
        // $.notify('<?php echo __('Please select a Contact');?>');
        return false;
      }

      if($('tr.item').length ==0){        
        thisInvalid($('#SearchExpense'), '<?php echo __('Please insert some items', true);?>');
        // $('#SaleContactId').select().focus();
        return false;
      }


    });

    $('#SaleDocumentId').change(function(){
      console.log($(this).val());
      var id = $(this).val();
      $.ajax({
        type: "GET",
        url: "<?php echo $html->url(array("controller"=>"documents", "action"=>"ajax_last_number")); ?>",
        data: 'id='+id,
        success: function(msg){
          var reply = JSON.parse(msg);

          <?php if(empty($this->data['Sale']['invoice_number'])):?>
          $('#SaleInvoiceNumber').val(reply['number']);
          <?php endif;?>

        }
      });
    });
    $('#SaleDocumentId').trigger('change');

    // $('#livesearch div.option').click(function(){
    //   $('#livesearch').hide();
    //   addItem($(this));
    // });

    // $('form').submit();

    setTimeout('bindFundAccounts()', 2000);

  });

  // busqueda de avances!
  function bindContact(){
      $('#SaleContactId').change(function(){
        $('div#collections').hide();
        var id = $('#SaleContactId').val();
        $.ajax({
          type: "GET",
          url: "<?php echo $html->url(array("controller"=>"collections", "action"=>"ajax_index")); ?>",
          data: 'contact='+id,
          success: function(msg){
            reply = JSON.parse(msg);
            console.log(reply);
            $('div#collections table tr.itemAdded').remove();
            if(reply['msg'] == 'ok'){
              var payables = reply['data'];              
              var tr = '';
              if(payables.length>0){
                for (var i = 0; i <= payables.length - 1; i++) {
                  tr += '<tr class="item itemAdded">';
                    tr += '<td>' + payables[i]['Collection']['number'] + '</td>';
                    tr += '<td class="numeric available">' + (payables[i]['Collection']['amount'] - payables[i]['Collection']['used']) + '</td>';
                    tr += '<td class="numeric">';
                      tr += '<input name="data[SalesAdvance]['+i+'][amount]" class="form-control use" value="' + (payables[i]['Collection']['amount'] - payables[i]['Collection']['used']) + '" type="number"></td>';
                    tr += '<td class="pk">';
                      tr += '<input type="hidden" name="data[SalesAdvance]['+i+'][collection_id]" value="'+payables[i]['Collection']['id']+'"/>';
                      tr += '<input type="checkbox" class="advance"/>';
                    tr += '</td>';
                  tr += '</tr>';
                  $('div#collections table tbody#new_advances').append(tr);
                }
                 $('div#collections').show();
              }else{
                 $('div#collections').hide();
              }
             
            }else{
              tr = '';              
            }

            bindAdvances();
          }
        });

      });
      $('#SaleContactId').trigger('change');
  }

  function bindAdvances(){
      // $('input.use').unbind('click');
      $('input.use').change(function(){

        var value = eval($(this).val());
        var available = eval($(this).parent().parent().find('.available').text());

        console.log('====================');
        console.log("amount:" + value);
        console.log("available:" + available);
        console.log('====================');

        if( value > available){
          $(this).val($(this).parent().parent().find('.available').text());
          thisInvalid($(this),'<?php  echo __("The amount exceeds the available advance amount", true); ?>');
          // $.notify('<?php echo __("The amount exceeds the available advance amount", true)?>');
        }else{
          thisValid($(this));
        }
        if($('input.advance:checked').length>0){
          updateTotal();
        }
      });

      // $('input.use').change(function(){

      //   if($(this).val() > $(this).parent().parent().find('.available').text()){
      //     $(this).val($(this).parent().parent().find('.available').text());
      //     $.notify('<?php echo __("The amount exceeds the available advance amount", true)?>');
      //   }
      //   if($('input.advance:checked').length>0){
      //     updateTotal();
      //   }
      // });

      $('input.advance').unbind('click');
      $('input.advance').click(function(){
        updateTotal();
      });
    }


  function bindFundAccounts(){
    $('#SaleFundAccountId0').change(function(){
      console.log("cambios en cuentas de fondo");
      console.log($(this).val());
      for (var i = data_models['fund_accounts'].length - 1; i >= 0; i--) {
        if(data_models['fund_accounts'][i]['FundAccount']['id'] == $(this).val()) {
          console.log("Currency del Fund account " + data_models['fund_accounts'][i]['Currency']['name'] );
          console.log("Currency del Fund account " + data_models['fund_accounts'][i]['Currency']['id'] );
          $('#SaleExchangeRate0').val(data_models['fund_accounts'][i]['Currency']['buy_price']);
        }
      };
    });

    $('#SaleFundAccountId0').trigger('change');
  }



  
  function bindCurrency(){
    $('#SaleCurrencyId').change(function(){
      var id = $('#SaleCurrencyId').val();
      $.ajax({
        type: "GET",
        url: "<?php echo $html->url(array("controller"=>"currencies", "action"=>"ajax_view")); ?>",
        data: 'id='+id,
        success: function(msg){
          reply = JSON.parse(msg);
          var currency = reply['data']['Currency'];
          if(currency['default']){
            $('#SaleCurrencyPrice').val(1);
            $('#SaleCurrencyPrice').parent().parent().hide();
          }else{
            $('#SaleCurrencyPrice').val(currency['sale_price']);
            $('#SaleCurrencyPrice').parent().parent().show();
          }
          
        }
      });
    });
    $('#SaleCurrencyId').trigger('change');
  }

function bindPaymentTerm(){
  $('select#SalePaymentTerm').change(function(){
      if($(this).val() == 'credit'){
        console.log("Venta a Credito");
        $('.SaleCreditDependent').show();
        $('#fundAccounts').hide();
        $('#SaleOverdueDate').val('');
        $('#SaleOverdueDate').addClass('not-empty');
        $('#SaleOverdueDate').addClass('validate');

      }else{
        console.log("Venta al contado");
        $('.SaleCreditDependent').hide();
        $('#fundAccounts').show();
        $('#SaleOverdueDate').removeClass('not-empty');
        $('#SaleOverdueDate').removeClass('validate');
      }

      bindInputs();
      $('#SaleOverdueDate').trigger('change');

    });
    $('select#SalePaymentTerm').change();



    updateTotal();
}  


  function addItem(data){
    console.log("addItem();");

    var index = 0;
    $('.item').each(function(){
      index++;
    });

    var expense = data;

    console.log("expense");
    console.log(expense);

    var tr = '<tr class="item" index="'+index+'">';
      tr += '<td class="pk">';
        tr += eval(index)+1;
      tr += '</td>';
      tr += '<td>';
        tr += '<input name="data[SalesExpense]['+index+'][expense_id]" class="expense_id" value="'+expense.Expense.id+'" type="hidden" />';
        tr += expense.Expense.name;
      tr += '</td>';
      // tr += '<td class="quantity numeric">';
      //   tr += '1'
      // tr += '</td>';
      // tr += '<td class="numeric">';
      //   tr += expense.Expense.sell_price || 0;
      // tr += '</td>';
      
      //NO TAX
      tr += '<td>';
        tr += '<input name="data[SalesExpense]['+index+'][SalesExpensesPrice][0][tax_id]" class="no_tax" value="" type="hidden" />';
        tr += '<input step="any" name="data[SalesExpense]['+index+'][SalesExpensesPrice][0][price]" class="amount no_tax_amount numeric" value="0" type="number" />';
      tr += '</td>';
      // taxes
       var j = 1;
      <?php foreach ($taxes as $key => $tax):?>
      tr += '<td>';
        tr += '<input name="data[SalesExpense]['+index+'][SalesExpensesPrice]['+j+'][tax_id]" value="'+<?php echo $key;?>+'" type="hidden" />';
        tr += '<input step="any" name="data[SalesExpense]['+index+'][SalesExpensesPrice]['+j+'][price]" class="numeric amount tax_amount tax_amount_'+<?php echo $key;?>+' tax_id_'+<?php echo $key;?>+'" value="0" type="number" />';
      tr += '</td>';
      j++;
      <?php endforeach;?>
     
      tr += '<td class="numeric subtotal">';

      tr += '</td>';
      tr += '<td class="td_close">';
      tr += '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
      // tr += '<a href="#" class="delete">x</a>';      
      tr += '</td>';
    tr += '</tr>';

    // console.log(tr);
    

    $('tbody.items').append(tr);
    $('#SearchExpense').val('');
    $('#SearchExpense').focus();


    //anular los impuestos no habilitados.
    $('.item[index='+index+'] .tax_amount').attr('disabled', true);
    for (var i = expense['ExpensesTax'].length - 1; i >= 0; i--) {
      // $('.item[index='+index+'] .no_tax_amount').attr('disabled', true);
      $('.item[index='+index+'] .tax_amount_'+expense['ExpensesTax'][i]['tax_id']).attr('disabled', false);
      $('.item[index='+index+'] .tax_amount_'+expense['ExpensesTax'][i]['tax_id']).addClass('not-empty');
      $('.item[index='+index+'] .tax_amount_'+expense['ExpensesTax'][i]['tax_id']).addClass('validate');
    };



    bindAddItem();
    updateTotal();
    bindInputs();
  }

  function bindAddItem(){

    $('.amount').unbind('change');
    $('.amount').change(function(){
      console.log(".amount:change;");
      updateTotal();
    });

    $('button.close').click(function(){
      if(confirm('<?php echo __("Do you really want to delete this?", true)?>')){
        $(this).parent().parent().find('.expense_id').val('');
        $(this).parent().parent().remove();
        updateTotal();
      }
    });


  }

  function updateTotal(){
    console.log("updateTotal();");
    var total = 0;
    $('.items tr.item').each(function(){
      var subtotal = 0;
      $(this).find('.amount').each(function(){
        subtotal += eval($(this).val());
      });
      $(this).find('.subtotal').text(subtotal);
      total += subtotal;  
    });
    
    console.log("Total: "+total);

    totaladvances = setAdvances();

    total -= totaladvances;

    $('#total').text(total);
    $('#SaleAmount').val(total);
    $('#SaleOverdueAmount').val(total);
    $('.fund_account_amount:first').val(total);

    // $('.sales_fund_accounts input:first').val(total);

    $('#SaleAmount').trigger('change');
  }


  function setAdvances(){
    var total = 0;

    $('input.advance:checked').each(function(){
      total += eval($(this).parent().parent().find('input.use').val());
    });

    return total;
  }

  var data_models = new Array;
  function bindLiveSearch(){
    data_models['expenses'] = <?php echo $javascript->object($expenses);?>;
    data_models['fund_accounts'] = <?php echo $javascript->object($fund_accounts);?>;
    console.log("data!");
    console.log(data_models);

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

  $(document).ready(function(){
    $('#saveExpense').unbind('click');
    $('#saveExpense').click(function(){
      var formData = $('#ExpenseAddForm').serialize();
      $.ajax({
        type: "GET",
            url: "<?php echo $html->url(array("controller"=>"expenses", "action"=>"ajax_add")); ?>",
            data: formData,
            success: function(msg){
              var reply = JSON.parse(msg);
              if(reply['status'] == 'ok'){
                data_models['expenses'].push(reply['data']);
                // console.log(reply['data']);
              }else{
                console.log("No se guardo el expense");
              }
                $('#ExpenseAddForm input').val('');
          $('#createExpense').modal('hide');
          $('#SearchExpense').keyup();
              // console.log(reply);            
            }
          });
    });



  });

</script>