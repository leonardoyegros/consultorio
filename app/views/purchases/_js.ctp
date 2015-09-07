<?php //print_r($expenses); die();?>

<script type="text/javascript">
	var currencies = <?php echo $javascript->object($currencies);?>;
	var fund_accounts = <?php echo $javascript->object($fund_accounts);?>;


	$(document).ready(function(){
		bindCurrency();
		binPaymentTerm();
		bindSearch();
		bindAddItem();
		bindLiveSearch();
		bindFundAccounts();
		bindSubmitForm();
		bindContact();
		
		$('#ExpenseName').focus(function(){
			$('#ExpenseName').val($('#SearchExpense').val());	
			// $('#SearchExpense').val('');
		});
		


	});

	// busqueda de avances!
	function bindContact(){
	  	$('#PurchaseContactId').change(function(){
	  		$('div#payments').hide();
			var id = $('#PurchaseContactId').val();
			$.ajax({
				type: "GET",
				url: "<?php echo $html->url(array("controller"=>"payments", "action"=>"ajax_index")); ?>",
				data: 'contact='+id,
				success: function(msg){
					reply = JSON.parse(msg);
					console.log(reply);

					$('div#payments table tr.itemAdded').remove();

					if(reply['msg'] == 'ok'){
						var payables = reply['data'];
						
						var tr = '';
						// tr += '<h4><?php echo __("Advances");?></h4>';
						// tr += '<table class="table table-responsive table-bordered">';
						// tr += '<thead>';
						// 	tr += '<th><?php __("Payment")?></th>';
						// 	tr += '<th><?php __("Available")?></th>';
						// 	tr += '<th><?php __("Use")?></th>'; 
						// 	tr += '<th></th>';
						// tr += '</thead>';
						// tr += '<tbody>';
						if(payables.length>0){
							for (var i = 0; i <= payables.length - 1; i++) {
								// console.log(payables[i]);
								tr += '<tr class="item itemAdded">';
									tr += '<td>' + payables[i]['Payment']['number'] + '</td>';
									tr += '<td class="numeric available">' + (payables[i]['Payment']['amount'] - payables[i]['Payment']['used']) + '</td>';
									tr += '<td class="numeric">';
										tr += '<input name="data[PurchasesAdvance]['+i+'][amount]" class="form-control use" value="' + (payables[i]['Payment']['amount'] - payables[i]['Payment']['used']) + '" type="number"></td>';
									tr += '<td class="pk">';
										tr += '<input type="hidden" name="data[PurchasesAdvance]['+i+'][payment_id]" value="'+payables[i]['Payment']['id']+'"/>';
										tr += '<input type="checkbox" class="advance"/>';
									tr += '</td>';
								tr += '</tr>';
								$('div#payments table tbody').append(tr);
							}
						}
						$('div#payments').show();
						// tr += '</tbody>';
						// tr += '</table>';					
						// $('div#payments').append(tr);
					}else{
						tr = '';
						
						// $('div#payments').html(tr);
					}

					bindAdvances();
				}
			});

	  	});
	  	$('#PurchaseContactId').trigger('change');

  	}


  	function bindAdvances(){
  		// $('input.use').unbind('click');
  		$('input.use').keyup(function(){

  			if($(this).val() > $(this).parent().parent().find('.available').text()){
  				$(this).val($(this).parent().parent().find('.available').text());
  				$.notify('<?php echo __("The amount exceeds the available advance amount", true)?>');
  			}
  			if($('input.advance:checked').length>0){
	  			updateTotal();
	  		}
  		});

  		$('input.use').change(function(){

  			if($(this).val() > $(this).parent().parent().find('.available').text()){
  				$(this).val($(this).parent().parent().find('.available').text());
  				$.notify('<?php echo __("The amount exceeds the available advance amount", true)?>');
  			}
  			if($('input.advance:checked').length>0){
	  			updateTotal();
	  		}
  		});

  		$('input.advance').unbind('click');
  		$('input.advance').click(function(){
  			updateTotal();
  		});
  	}


	function bindSubmitForm(){
		$('form').submit(function(){
			// alert("asd");
			// console.log($(this).serialize());
			// return false;
		});	

		// $('form').submit(function(){
		// 	if(!validateForm()){
		// 		console.log
		// 		return false;
		// 	}
		// });
	}

	function validateForm(){
		

		if($('#PurchaseInvoiceNumber').val().length == 0){
			$.notify('<?php echo __("The invoice Number cannot be null", true)?>');
			$('#PurchaseInvoiceNumber').focus();
			return false;
		}

		if($('#PurchaseContactId').val().length == 0 || $('#PurchaseContactId').val() == 0){
			$.notify('<?php echo __("Please select a Provider", true)?>');
			$('#PurchaseContactId').focus();
			return false;
		}


		//items
		if($('.item').length == 0){
			$.notify('<?php echo __("Add some items to the Purchase", true)?>');
			$('#SearchExpense').focus();
			console.log('items = 0');
			return false;
		}

		if($('#PurchaseTotal').val() == 0){
			$.notify('<?php echo __("Check the price of your purchase Items", true)?>');
			console.log('items = sin precio');
			return false;
		}

		if($('#PurchasePaymentTerm').val() == 'credit' && $('#PurchaseOverdueDate').val().length ==0){
			$.notify('<?php echo __("Please select an Overdue Date", true)?>');
			$('#PurchaseOverdueDate').focus();
			return false;
		}

		$.notify('<?php echo __("Nice, saving the Purchase", true)?>',{
			type: 'info'
		});


		return true;
	}


	function bindSearch(){
		$('#SearchExpense').keyup(function(){
		$('#livesearch').show();

		$('#livesearch div.option').hide();
			if($(this).val().length > 0){
				$('#livesearch div.option:Contains('+$(this).val().toUpperCase()+')').show();  
			}else{
			 	$('#livesearch').hide();
			}
		});

		$('#livesearch div.option').click(function(){
	      $('#livesearch').hide();
	      addItem($(this));
	    });
	}

	function addItem(data){
	    console.log("addItem();");
	    var index = 0;
	    $('.item').each(function(){
	      index++;
	    });
	    var expense = data;
	    console.log(expense);

	    var tr = '<tr class="item" index="'+index+'">';
	      tr += '<td class="pk">';
	        tr += eval(index)+1;
	      tr += '</td>';
	      tr += '<td>';
	        tr += '<input name="data[PurchasesExpense]['+index+'][expense_id]" class="expense_id" value="'+expense.Expense.id+'" type="hidden" />';
	        tr += expense.Expense.name;
	      tr += '</td>';
	      
	      //NO TAX
	      tr += '<td>';
	        tr += '<input name="data[PurchasesExpense]['+index+'][PurchasesExpensesPrice][0][tax_id]" class="no_tax" value="" type="hidden" />';
	        tr += '<input step="any" name="data[PurchasesExpense]['+index+'][PurchasesExpensesPrice][0][price]" class="amount no_tax_amount" value="0" type="number" />';
	      tr += '</td>';
	      // taxes
	       var j = 1;
	      <?php foreach ($taxes as $key => $tax):?>
	      tr += '<td>';
	        tr += '<input name="data[PurchasesExpense]['+index+'][PurchasesExpensesPrice]['+j+'][tax_id]" class="tax_id_'+<?php echo $key;?>+'" value="'+<?php echo $key;?>+'" type="hidden" />';
	        tr += '<input step="any" name="data[PurchasesExpense]['+index+'][PurchasesExpensesPrice]['+j+'][price]" class="amount tax_amount tax_amount_'+<?php echo $key;?>+'" value="0" type="number" />';
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
	    // $('.item[index='+index+'] .tax_amount').attr('disabled', true);
	    for (var i = expense['ExpensesTax'].length - 1; i >= 0; i--) {
	    	$('.item[index='+index+'] .no_tax_amount').attr('disabled', true);
	      	$('.item[index='+index+'] .tax_amount_'+expense['ExpensesTax'][i]['tax_id']).attr('disabled', false);
	    };

	    bindAddItem();
	    updateTotal();
    }

    function bindAddItem(){

		$('.amount').unbind('change');
		$('.amount').change(function(){
		  console.log(".amount:change;");
		  updateTotal();
		});

		$('button.close').unbind('click');
		$('button.close').click(function(){
		  if(confirm('<?php echo __("Do you really want to delete this?", true)?>')){
		    $(this).parent().parent().find('.expense_id').val('');
		    $(this).parent().parent().find('.amount').val(0);
		    $(this).parent().parent().remove();
		    updateTotal();
		  }
		});
	}

	function bindFundAccounts(){
		$('#PurchaseFundAccountId').change(function(){
			$('#PurchaseFundAccountExchangeRate').val(setPaymentDataCurrency());
			updateTotal();
		});
		$('#PurchaseFundAccountId').trigger('change');
	}	

	function setPaymentDataCurrency(){
		if(fund_accounts.length == 0){
			alert("<?php __("Please create a fund account")?>");
			document.location = "<?php echo $html->url(array("controller"=>"fund_accounts", "action"=>"add")); ?>";
		}
		// console.log("Cuentas de fondo: "+fund_accounts.length);
		// console.log('setPaymentDataCurrency()');
		var fund_account_id = $('#PurchaseFundAccountId').val();
		var currencyPrice;
		for (var i = fund_accounts.length - 1; i >= 0; i--) {
			// console.log(fund_accounts[i]['FundAccount']['id']);
			// console.log(fund_account_id);
			if(fund_accounts[i]['FundAccount']['id'] == fund_account_id){
				
				currencyPrice = fund_accounts[i]['Currency']['sale_price'];

				// console.log(fund_account_id);
				// console.log(currencyPrice);

			}
		};

		return currencyPrice;
	}

	function setAdvances(){
		var total = 0;

		$('input.advance:checked').each(function(){
			total += eval($(this).parent().parent().find('input.use').val());
		});

		return total;
	}

	function updateTotal(){
	    console.log("updateTotal();");
	    var total = 0;
	    $('.items tr.item').each(function(){
	      var subtotal = 0;
	      $(this).find('.amount').each(function(){
	        subtotal += eval($(this).val());
	      });

	      $(this).find('.subtotal').text(eval(subtotal));
	      total += subtotal;  
	    });	  

	    //total de expenses
	    $('#total').text(eval(total));
	    $('#PurchaseTotal').val(eval(total));

	    totalAdvances = setAdvances() || 0;
	    total -= totalAdvances;

	    console.log("Adelanto: " +totalAdvances);
	    console.log("1.Total: " +total);

	    //calculo del monto de la factura.
	    if($('#PurchasePaymentTerm').val() == 'credit'){
	    	$('#PurchaseOverdueAmount').val(eval(total));
	    }else{
	    	$('#PurchaseOverdueAmount').val(0);
	    }	   
	    
	    //PAYMENT DATA
	    var exchange_rate = $('#PurchaseFundAccountExchangeRate').val();
	    console.log("exchange_rate: " + exchange_rate); 
	    total = Number(total * $('#PurchaseExchangeRate').val() / exchange_rate);
	    console.log("total: " + total); 


	    console.log("Total payment_data: "+eval(total));	    
	    $('.fund_account_amount:first').val(eval(total));

	    // $('.fund_account_amount input:first').val(eval(total));
	}

	function binPaymentTerm(){
		$('select#PurchasePaymentTerm').change(function(){
			if($(this).val() == 'credit'){
			console.log("Venta a Credito");
			$('.credit_inputs').show();
			$('#fundAccounts').hide();
			updateTotal();
			}else{
			console.log("Venta al contado");
			$('.credit_inputs').hide();
			$('#fundAccounts').show();

			}
	    });
	    $('select#PurchasePaymentTerm').trigger('change');

	   
	}

	function bindCurrency(){
		$('#PurchaseCurrencyId').change(function(){
			var id = $('#PurchaseCurrencyId').val();
			$.ajax({
				type: "GET",
				url: "<?php echo $html->url(array("controller"=>"currencies", "action"=>"ajax_view")); ?>",
				data: 'id='+id,
				success: function(msg){
					reply = JSON.parse(msg);
					var currency = reply['data']['Currency'];
					// console.log("Currency:");
					console.log(currency);
					if(currency['default']){
						console.log("Moneda por defecto, ocultando");
						$('#PurchaseExchangeRate').val(1);
						$('#PurchaseExchangeRate').parent().parent().hide();
					}else{
						$('#PurchaseExchangeRate').val(currency['sale_price']);
						$('#PurchaseExchangeRate').parent().parent().show();
					}
					updateTotal();
				}
			});
		});
		$('#PurchaseCurrencyId').trigger('change');
	}

	var data_models = new Array;
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