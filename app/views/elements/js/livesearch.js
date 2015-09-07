function livesearch(options){
	var livesearch_div = '<div id="livesearch" class=""></div>';
	var selector = $(options['selector']);
	$('#livesearch').remove();
	selector.after(livesearch_div);

	selector.keyup(function(e){
		if(e.keyCode != 38 && e.keyCode != 40 && e.keyCode != 13){
			$('#livesearch div.option').remove();
			var v = selector.val();
			if (v == '') {
				$('#livesearch').hide();
				return;
			}
			
			var re = new RegExp(v, 'i');
			var data = options['data'];
			for (var i = 0; i < data.length; i++) {
				if (data[i]['Expense']['name'].match(re)) {
					tr =  '<div index="'+i+'" class="option row" onclick="'+options['callback']+'();">';
					tr += 	'<a href="javascript:void();"   index="'+i+'" >';
					tr +=  data[i][options['model']][options['field']]
					tr +=	'</a>';
					tr += '</div>';
					$('#livesearch').append(tr);
				}
			}
			$('#livesearch').width(selector.width()-5);
			$('#livesearch div.option:first').addClass('active');
			$('#livesearch').show();
		}

		if($('#livesearch .option').length == 0){

			$('#livesearch').append('<div class="option row"><a href="#" style="display:inherit; width:100%; padding:15px 10px;" data-toggle="modal" data-target="#create'+options['model']+'"><?php echo __("Add New", true)?></a></div>');
		}

		keyCodes(e, options['callback']);
	});

}

function keyCodes(e, callback){
	switch (e.keyCode) {
		case 13: 
			//ENTER
			e.preventDefault();
			eval(callback+'('+$('#livesearch .active').attr('index')+')');
			$('#livesearch').hide();
			break;

		case 38:
			//UP
			// e.preventDefault();
			$('#livesearch .active').addClass('preselected');
			$('#livesearch div').removeClass('active');
			$('#livesearch .preselected').prev().addClass('active');
			$('#livesearch div').removeClass('preselected');
			$('#livesearch div.option').show();
			break;

		case 40:
			//down
			// e.preventDefault();
			$('#livesearch .active').addClass('preselected');
			$('#livesearch div').removeClass('active');
			$('#livesearch .preselected').next().addClass('active');
			$('#livesearch div').removeClass('preselected');
			$('#livesearch div.option').show();
			break;
	}
}