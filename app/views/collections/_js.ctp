<script type="text/javascript">
	var fund_accounts = <?php echo $javascript->object($fundAccount);?>;
	var sales_collections = <?php echo $javascript->object($this->data['SalesCollection']);?>;

	$(document).ready(function(){
		bindFundAccount();
		bindContacts();
		updateTotal();
		bindCollectionForm();
		bindAdvances();
	});

	function bindAdvances(){
		if($('#CollectionAdvance:checked').length==0){
			$('#receivables_div').show();
		}else{
			$('#receivables_div').hide();
		}

		$('#CollectionAdvance').click(function(){
			if($('#CollectionAdvance:checked').length==0){
				$('#receivables_div').show();
			}else{
				$('#receivables_div').hide();
			}
		});
	}



	function bindFundAccount(){
	    $('#CollectionFundAccountId').change(function(){
	      var id = $('#CollectionFundAccountId').val();
	      $.ajax({
	        type: "GET",
	        url: "<?php echo $html->url(array("controller"=>"fund_accounts", "action"=>"ajax_view_currency")); ?>",
	        data: 'id='+id,
	        success: function(msg){
	          reply = JSON.parse(msg);
	          console.log(reply);
	          var currency = reply['data']['Currency'];
	          if(currency['default']){
	            $('#CollectionCurrencyPrice0').val(1);
	            // $('#CollectionCurrencyPrice0').parent().parent().hide();
	          }else{
	            $('#CollectionCurrencyPrice0').val(currency['sale_price']);
	            // $('#CollectionCurrencyPrice0').parent().parent().show();
	          }
	          $('#CollectionCurrencyId').val(currency['id']);
	        }
	      });
	    });
	    $('#CollectionFundAccountId').trigger('change');
	  }
 
	  function bindContacts(){
	  	$('#CollectionContactId').change(function(){

	  		// if($('#CollectionAdvance:checked').length==0){
	  		// 	return false;
	  		// }

			var id = $('#CollectionContactId').val();
			$.ajax({
				type: "GET",
				url: "<?php echo $html->url(array("controller"=>"receivables", "action"=>"ajax_index")); ?>",
				data: 'contact='+id,
				success: function(msg){
					reply = JSON.parse(msg);
					console.log(reply);

					$('div#receivables').html('');

					if(reply['msg'] == 'ok'){
						var receivables = reply['data'];
						
						var tr = '';
						tr += '<table class="table table-responsive table-bordered">';
						tr += '<thead><th><?php __("Overdue Date")?><th><?php __("Sale")?></th><th><?php __("Amount")?></th><th><?php __("Pay")?></th><th></th></thead>';
						tr += '<tbody>';

						for (var i = 0; i <= receivables.length - 1; i++) {
							console.log(receivables[i]);
							tr += '<tr class="item">';
								tr += '<td class="numeric">' + (receivables[i]['Receivable']['overdue_date']) + '</td>';
								tr += '<td>' + receivables[i]['Receivable']['invoice_number'] + '</td>';
								tr += '<td class="numeric">' + (receivables[i]['Receivable']['amount'] - receivables[i]['Receivable']['paid']) + '</td>';

								tr += '<td class="numeric"><input name="data[SalesCollection]['+i+'][amount]" class="form-control fund_account_amount" value="' + (receivables[i]['Receivable']['amount'] - receivables[i]['Receivable']['paid']) + '" type="number"></td>';
								tr += '<td class="pk">';
									tr += '<input type="checkbox" name="data[SalesCollection]['+i+'][sale_id]" value="'+receivables[i]['Receivable']['sale_id']+'"/>';
									// tr += '<input type="checkbox"/>';
								tr += '</td>';
							tr += '</tr>';
						};

						if(sales_collections!=null){
							for (var j = 0; j <= sales_collections.length - 1; j++) {
								console.log(sales_collections[j]);
								tr += '<tr class="item sales_collections">';
									tr += '<td class="numeric">' + (sales_collections[j]['Sale']['overdue_date']) + '</td>';
									tr += '<td>' + sales_collections[j]['Sale']['invoice_number'] + '</td>';
									tr += '<td class="numeric">' + (sales_collections[j]['amount']) + '</td>';
									tr += '<td class="numeric">';
									tr += '<input name="data[SalesCollection]['+eval((eval(j)+eval(i)))	+'][amount]" class="form-control fund_account_amount" value="' + (sales_collections[j]['amount']) + '" type="number"></td>';
									tr += '<input name="data[SalesCollection]['+eval((eval(j)+eval(i)))	+'][id]" class="form-control fund_account_amount" value="' + (sales_collections[j]['id']) + '" type="hidden"></td>';
									tr += '<td class="pk">';
										tr += '<input type="checkbox" name="data[SalesCollection]['+eval((eval(j)+eval(i))) +'][sale_id]" value="'+sales_collections[j]['Sale']['id']+'"/>';
										// tr += '<input type="checkbox" name="data[SalesCollection]['+eval((eval(j)+eval(i))) +'][sale_id]" />';
									tr += '</td>';
								tr += '</tr>';
							};
						}


						tr += '</tbody>';
						tr += '</table>';					
						$('div#receivables').append(tr);



					}else{
						tr = '<span class=""><?php __("No data to display");?></span>';
						$('div#receivables').append(tr);
					}
					bindReceivables();
					bindCollectionForm();

					$('.sales_collections input[type=checkbox]').click();
				}
			});

	  	});
	  	$('#CollectionContactId').trigger('change');

	  }

	  function bindReceivables(){
	  	$('#receivables .item input[type=checkbox]').click(function(){
	  		if($(this)[0].checked){
	  			$(this).parent().parent().addClass('checked active');
	  			$(this).parent().parent().find('input[type=number]').focus();
	  		}else{
	  			$(this).parent().parent().removeClass('checked active');
	  		}
	  		updateTotal();
	  	});

	  	$('#receivables .item input[type=number]').change(function(){
	  		updateTotal();
	  	});
	  }

	  function updateTotal(){
	  	var total = 0;
	  	$('#receivables .active').each(function(){
	  		console.log($(this));
	  		console.log($(this).find('input[type=number]').val());
	  		total += eval($(this).find('input[type=number]').val());
	  	});
	  	// $('#CollectionAmount').val(total);
	  	$('#CollectionAmount0').val(total);

	  }

	  function bindCollectionForm(){
	  	// return true;

	  	// $('input[type=submit]').unbind('click');
	  	// $('input[type=submit]').click(function(){
	  	// 	if(validateForm()){
	  	// 		var Formdata = $('form').serialize();
	  	// 		$.ajax({
			 //        type: "POST",
			 //        url: "<?php echo $html->url(array("controller"=>"collections", "action"=>"ajax_edit")); ?>",
			 //        data: Formdata,
			 //        success: function(msg){
			 //          var reply = JSON.parse(msg);
			 //          window.location.href = "../collections/";
			 //        }
			 //      });
	  	// 	}

	  	// 	return false;
	  	// });

	  	// $('form').submit(function(){
	  	// 	return false;
	  	// });
	  }

	  function validateForm(){
	  	return true;
	  }

</script>