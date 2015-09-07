var baseURL = window.location.pathname;



$(function () {
	$('[data-toggle="tooltip"]').tooltip()
});

$(document).ready(function () {

  bindTopMenu();
  bindSearchElements();
  bindUploadFile();
  bindForm();
  bindHelp();
  bindFilters();
  bindTopBar();
  bindToolTips();
  bindIndexTables();

  jQuery.fn.ForceNumericOnly =
  function()
  {
      return this.each(function()
      {
          $(this).keydown(function(e)
          {
              var key = e.charCode || e.keyCode || 0;
              // allow backspace, tab, delete, enter, arrows, numbers and keypad numbers ONLY
              // home, end, period, and numpad decimal
              return (
                  key == 8 || 
                  key == 9 ||
                  key == 13 ||
                  key == 46 ||
                  key == 110 ||
                  key == 190 ||
                  (key >= 35 && key <= 40) ||
                  (key >= 48 && key <= 57) ||
                  (key >= 96 && key <= 105));
          });
      });
  };

  $(function () {
    $('[data-toggle="popover"]').popover()
  })

  

  $('th.tablesorter-header').click(function(){ 
    bindIndexTables()
  });



  // var defaults = $.fn.datepicker.defaults = {
  //     autoclose: true,
  //     beforeShowDay: $.noop,
  //     calendarWeeks: false,
  //     clearBtn: false,
  //     daysOfWeekDisabled: [],
  //     endDate: Infinity,
  //     forceParse: true,
  //     // format: 'mm/dd/yyyy',
  //     keyboardNavigation: true,
  //     language: 'en',
  //     minViewMode: 0,
  //     orientation: "auto",
  //     rtl: false,
  //     startDate: -Infinity,
  //     startView: 2,
  //     todayBtn: false,
  //     todayHighlight: false,
  //     weekStart: 0
  // };




  // $.notifyDefaults(
  //   {
  //     type: 'danger',
  //     allow_dismiss: false,
  //     placement: {
  //       from: "bottom",
  //       align: "right"
  //     },
  //     animate: {
  //       enter: 'animated fadeInDown',
  //       exit: 'animated fadeOutUp'
  //     }
  //   }
  // );


  setTimeout(function(){ $('#flashMessage').fadeOut('fast'); }, 3000);

  var mySelect = $('#first-disabled2');

  $('#special').on('click', function () {
    mySelect.find('option:selected').attr('disabled', 'disabled');
    mySelect.selectpicker('refresh');
  });

  $('.datepicker').datepicker({
    // startView: 1,
    // minViewMode: 2
    format: 'yyyy-mm-dd',
    position: 'top '
    //,
    // startDate: '-3d',

  });

  var $basic2 = $('#basic2').selectpicker({
    liveSearch: true,
    maxOptions: 1
  });

  // FILTERS
  $('a.filter-button').unbind('click');
  $('a.filter-button').click(function(){
    console.log('sidebar-filter toggle');
    $('.sidebar-filters').toggle('slow');
  });


  $('.sidebar-filters input').change(function(){
    $('.sidebar-filters form').submit();
  });

  // $('.nav-tabs a').click(function (e) {
  //   console.log('click .nav-tabs');
  //   e.preventDefault()
  //   $(this).tab('show')
  // })


  $('.view .panel:first').show();
  $('.nav-tabs a').unbind('click');
  $('.nav-tabs a').click(function(){
    $('.nav-tabs li').removeClass('active');
    $(this).parent().addClass('active');
    $('.view .panel').hide();
    $('div.panel[role='+$(this).parent().attr('role')+']').show();
  });

  // $('#sidebar').height(eval(innerHeight) - eval(57) - eval(15));
  $('#sidebar').height(eval(innerHeight));

  $(window).resize(function(){
    $('#sidebar').height(eval(innerHeight) + eval(window.scrollY) - eval(57) - eval(15));
  });

  $(window).scroll(function(){
    $('#sidebar').height(eval(innerHeight) + eval(window.scrollY) - eval(57) - eval(15));
  });
 


});

jQuery.expr[':'].Contains = function(a,i,m){
     return jQuery(a).text().toUpperCase().indexOf(m[3].toUpperCase())>=0;
};

function bindIndexTables(){

  $('table th a').attr('href', '#');


  $('input.select-all').unbind('click');
    $('input.select-all').click(function(){
      if ($(this).is(':checked')) {
            //$("input[type=checkbox]").prop('checked', true); //todos los check
            $("input.delete-index").prop('checked', true); //solo los del objeto #diasHabilitados
        } else {
            //$("input[type=checkbox]").prop('checked', false);//todos los check
            $("input.delete-index").prop('checked', false);//solo los del objeto #diasHabilitados
        }     
    });

    $('input.delete-index').unbind('click');
    $('input.delete-index').click(function(){
      $("input.select-all").prop('checked', false);
    });

    $('.delete-multiple-index').unbind('click');
    $('.delete-multiple-index').click(function(){

      if($('input:checkbox:checked').size()==0){
        return 0;
      }

      if(confirm("Do you want to remove this items?")){ 

           $("input.delete-index").each(function(){

            if ($(this).is(':checked')) {
              var document_ = $(this).parent().parent().parent().parent().attr('controller');
              var id = $(this).parent().parent().attr('id');

              console.log('id='+id+'&controller='+document_);
              console.log(baseURL+'/../ajax_delete');

              $.ajax({
                    type: "GET",
                    url: baseURL+'/../ajax_delete',
                    data: 'controller='+document_+'&id='+id,
                    success: function(msg){
                      reply = JSON.parse(msg);
                      if(reply['status']=='ok'){
                        $('tr.item[id='+id+']').remove();
                      }else{
                        $.notify('This cannot be removed');
                      }
                      // console.log(reply);
                      
                    }
              });
            }
          });
           return false;

       }
    });
}


function bindToolTips(){
  // $('tile')
}

function bindTopBar(){
  $('a[icon=remove]').unbind('click');
  $('a[icon=remove]').click(function(){
    if(!confirm('Do you really want to remove this?')){
      return false;
    }
  });
}


function bindFilters(){

  $('#table_options a[icon=search]').click(function(){
    $('#filters').toggle();
  });


  // $('#filters input').change(function(){
    
    
  // });

  
}

function bindHelp(){

  // $('a.help').attr('href','http://www.getsiso.com/knowledge-base/');
  $('a.help').attr('target','_blank');

  $('a.help').unbind('click');
  $('a.help').click(function(){
    
    // url = $(this).attr('url');
    // window.open(url,'siso_help',"width=300;height=600");
    // e.preventDefault();
    // return false;

    // $('[data-toggle=tooltip]').tooltip("toggle");
  });

  // $('a.help.active').click(function(){
  //   // $(this).removeClass('active');
  // });


}

function bindForm(){
  $('input[type=submit]').attr('disabled', true);
  $('input[type=text]').attr('autocomplete', false);
  $('input[type=text]').parent().addClass('has-feedback');

  $('.bs-checkbox').unbind('click');
  $('.bs-checkbox').click(function(){
    if($(this).hasClass('active')){
      $(this).removeClass('active');
    }else{
      $(this).addClass('active');
    }
  });
   

  $('input.search').keypress(function(event){
    switch(event.keyCode){
      case 13: 
              // prevenir envio de formulario con enter
              event.preventDefault();
              return false;
              break;

    }
  });

  $('input[type=submit]').unbind('click');
  $('input[type=submit]').click(function(){
    // $('form').submit();
    // $(this).attr('disabled', true);
  });

}

function bindSearchElements(){
  // console.log("Eventos sobre liveSearch");
  $('input.search').attr('autocomplete',"off");
}


function setTopbar(){

};

function bindUploadFile(){
  console.log("bindUploadFile();");
  $('.file_button').unbind('click');
  $('.file_button').click(function(){
    $('input[type=file]').click();
  });
}

function bindTopMenu(){
  console.log("Eventos sobre el TopMenu"); 
  $('#top-menu a.dropdown-toggle').on( "mouseover", function(){
    console.log("My Account Click:");
    $(this).trigger('click');
    $(this).attr('aria-expanded', true);
  }); 

  //  $('#top-menu a.dropdown-toggle').on( "mouse", function(){
  //   console.log("My Account Click:");
  //   $(this).trigger('click');
  //   $(this).attr('aria-expanded', true);
  // }); 


}


function ChangeUrl(url) {
    var title = "URL";

    if (typeof (history.pushState) != "undefined") {
        var obj = { Title: title, Url: url };
        history.pushState(obj, obj.Title, obj.Url);
    } else {
        alert("Browser does not support HTML5.");
    }
}

function deleteItem(url){

  console.log(table);
    // url = pages_contr


    $.ajax({
      type: "GET",
      url: url,
      // data: 'id='+id,
      success: function(msg){
        var reply = JSON.parse(msg);
        console.log(reply);
      }
    });
}

function displayAlert(msg, type){
  if(type == 'error'){
    type = 'alert-danger';
  }else{
    type = 'alert-success';
  }

  var tr  = '<div class=""><div id="flashMessage" class="alert message msg alert '+type+'"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+msg+'</div></div>';
  $('#topmessage').html(tr);
  $('#flashMessage').show();
  // setTimeout($('#flashMessage').hide(), 4000);
}

