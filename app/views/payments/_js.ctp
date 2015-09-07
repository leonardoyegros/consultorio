<script type="text/javascript">

	

	$(document).ready(function(){
		bindFundAccount();
		bindContacts();
		updateTotal();
		bindPaymentForm();
	});



	function bindFundAccount(){
	    $('#PaymentFundAccountId').change(function(){
	      var id = $('#PaymentFundAccountId').val();
	      $.ajax({
	        type: "GET",
	        url: "<?php echo $html->url(array("controller"=>"fund_accounts", "action"=>"ajax_view_currency")); ?>",
	        data: 'id='+id,
	        success: function(msg){
	          reply = JSON.parse(msg);
	          console.log(reply);
	          var currency = reply['data']['Currency'];
	          if(currency['default']){
	            $('#PaymentExchangeRate').val(1);
	            $('#PaymentExchangeRate').parent().parent().hide();
	          }else{
	            $('#PaymentExchangeRate').val(currency['sale_price']);
	            $('#PaymentExchangeRate').parent().parent().show();
	          }
	          $('#PaymentCurrencyId').val(currency['id']);
	        }
	      });
	    });
	    $('#PaymentFundAccountId').trigger('change');
	  }

	  function bindContacts(){
	  	$('#PaymentContactId').change(function(){

	  		if($('#PaymentAdvance:checked').length==1){
	  			var tr = '<span class=""><?php __("No data to display");?></span>';
				$('div#payables').html(tr);
	  			return false;
	  		}


			var id = $('#PaymentContactId').val();
			$.ajax({
				type: "GET",
				url: "<?php echo $html->url(array("controller"=>"payables", "action"=>"ajax_index")); ?>",
				data: 'contact='+id,
				success: function(msg){
					reply = JSON.parse(msg);
					console.log(reply);

					$('div#payables').html('');

					if(reply['msg'] == 'ok'){
						var payables = reply['data'];
						
						var tr = '';
						tr += '<table class="table table-responsive table-bordered">';
						tr += '<thead><th><?php __("Purchase")?></th><th><?php __("Amount")?></th><th><?php __("Pay")?></th><th></th></thead>';
						tr += '<tbody>';
						for (var i = payables.length - 1; i >= 0; i--) {
							console.log(payables[i]);
							tr += '<tr class="item">';
								tr += '<td>' + payables[i]['Payable']['invoice_number'] + '</td>';
								tr += '<td class="numeric">' + (payables[i]['Payable']['total'] - payables[i]['Payable']['paid']) + '</td>';
								tr += '<td class="numeric"><input name="data[PurchasesPayment]['+i+'][amount]" class="form-control fund_account_amount" value="' + (payables[i]['Payable']['total'] - payables[i]['Payable']['paid']) + '" type="number"></td>';
								tr += '<td class="pk">';
									tr += '<input type="hidden" name="data[PurchasesPayment]['+i+'][purchase_id]" value="'+payables[i]['Payable']['purchase_id']+'"/>';
									tr += '<input type="checkbox"/>';
								tr += '</td>';
							tr += '</tr>';
						};
						tr += '</tbody>';
						tr += '</table>';					
						$('div#payables').append(tr);
					}else{
						tr = '<span class=""><?php __("No data to display");?></span>';
						$('div#payables').html(tr);
					}

					bindpayables();
					bindPaymentForm();
				}
			});

	  	});
	  	$('#PaymentContactId').trigger('change');

	  }

	  function bindpayables(){
	  	$('#payables .item input[type=checkbox]').click(function(){
	  		if($(this)[0].checked){
	  			$(this).parent().parent().addClass('checked active');
	  			$(this).parent().parent().find('input[type=number]').focus();
	  		}else{
	  			$(this).parent().parent().removeClass('checked active');
	  		}
	  		updateTotal();
	  	});

	  	$('#payables .item input[type=number]').change(function(){
	  		updateTotal();
	  	});
	  }

	  function updateTotal(){
	  	// solo si no es avance se calcula el total con los payables.
	  	if($('#PaymentAdvance:checked').length==0){
  			var total = 0;
		  	$('#payables .item.active').each(function(){
		  		total += eval($(this).find('input[type=number]').val());
		  	});
		  	$('#PaymentAmount').val(total);
		  	$('#PaymentAmount0').val(total);
  		}
	  }

	  function bindPaymentForm(){

	  	$('#PaymentAdvance').unbind('click');
	  	$('#PaymentAdvance').click(function(){
	  		if($('#PaymentAdvance:checked').length==1){
	  			var tr = '<span class=""><?php __("No data to display");?></span>';
				$('div#payables').html(tr);
	  		}else{
	  			$('#PaymentContactId').trigger('');
	  		}
	  	});
	  	// return true;

	  	$('input[type=submit]').unbind('click');
	  	$('input[type=submit]').click(function(){
	  		if(!validateForm()){
	  			return false;
	  		}

	  		
	  	});

	  	// $('form').submit(function(){
	  	// 	return false;
	  	// });
	  }

	  function validateForm(){
	  	return true;
	  }

</script>