<script type="text/javascript">

  var success_icon = '<span class="glyphicon glyphicon-ok form-control-feedback" aria-hidden="true"></span>';
  var success_class = "has-success";

  var error_icon = '<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>';
  var error_class = "has-error";

  var helpblock = '<span id="inputSuccess2Status" class="help-block"></span>';

  $(document).ready(function(){

   

    $('.help-block').hide();
    
    bindInputs();

    $('form').submit(function(){
      var valid = validateElements();
      if(!valid){
        $('input[type=submit]').attr('disabled', true);
        return false;
      }

      $('input[type=submit]').attr('disabled', false);
      console.log("ok");
      return true;
    });

    // $('.day').ForceNumericOnly();
    $('.numeric').ForceNumericOnly();

  });

  function bindInputs(){
    $('.not-empty, .numeric, .email').addClass('validate');

    $('input, select').change(function(){
      // console.log('validando elemento en cambio');
      var valid = validateElements();
      if(!valid){
        $('input[type=submit]').attr('disabled', true);
        return false;
      }
      $('input[type=submit]').attr('disabled', false);
    });

     $('input.validate').change(function(){
      // console.log('validando elemento en cambio');
      var valid = validateElements();
      if(!valid){
        $('input[type=submit]').attr('disabled', true);
        return false;
      }
      $('input[type=submit]').attr('disabled', false);
    });
  }

  function thisValid(element){
    $(element).parent().addClass(success_class);
    $(element).parent().append(success_icon);
    $(element).parent().find('.help-block').hide();
  }

   function thisInvalid(element, msg){
    console.log($(element));
    console.log($(element).attr('id') + ' no paso la validacion');
    $(element).parent().addClass(error_class);
    //tratamiento especial a los datepickers
    if(!$(element).hasClass('datepicker') && $(this).attr('type')!='select'){
      $(element).parent().append(error_icon);
      $(element).parent().find('.help-block').remove();
      $(element).parent().append(helpblock);
      $(element).parent().find('.help-block').text(msg);
    }else{
      $(element).parent().parent().find('.help-block').remove();
      $(element).parent().parent().append(helpblock);
      $(element).parent().parent().find('.help-block').text(msg);
    }
    // $(element).parent().find('.help-block').show();
    $('.help-block').show();
  }

function validateElements(){
  var valid = true;
  // console.log("validando elementos");
  $('form').find('.form-control-feedback').remove();
  $('.has-feedback').removeClass('has-error');
  $('.has-feedback').removeClass('has-success');
  $('.help-block').hide();
    
  // console.log("not-empty");
  $('.not-empty').each(function(){
    if(!vNotEmpty($(this))){
      thisInvalid($(this), '<?php echo __("This can not be null", true)?>');
      valid = false;
      return false;
    }else{
      thisValid($(this));
    }
  });

  $('input.numeric').each(function(){
    if(!vOnlyNumbers($(this))){
      thisInvalid($(this), '<?php echo __("This only can have numbers", true)?>');
      valid = false;
      return false;
    }else{
      thisValid($(this));
    }
  });

  $('input.email').each(function(){
    if(!validateEmail($(this))){
      thisInvalid($(this), '<?php echo __("Enter a valid E-mail", true)?>');
      valid = false;
      return false;
    }else{
      thisValid($(this));
    }
  });

  $('input.confirm').each(function(){

    var confirm = $(this).val();
    var pass = $('.password').val();
    if(confirm.length>0){
      if(confirm != pass){
        thisInvalid($(this), '<?php echo __("The passwords do not match", true)?>');
        valid = false;
      return false;
      }else{
        thisValid($(this));
      }
    }
  });

  $('input.day').each(function(){
    if(!validateDay($(this))){
      thisInvalid($(this), '<?php echo __("Enter a valid day", true)?>');
      valid = false;
      return false;
    }else{
      thisValid($(this));
    }
  });



  $('input.password').each(function(){
    var min = $(this).attr('min');
    var max = $(this).attr('max');
    if($(this).val().length > 0){
      if(!validateaa($(this))){
        thisInvalid($(this), '<?php echo __("Password must contain at least one lowercase letter", true)?>');
        $('.help-block').show();
        valid = false;
      return false;
      }else if(!validateAA($(this))){
        thisInvalid($(this), '<?php echo __("Password must contain at least one uppercase letter", true)?>');
        valid = false;
      return false;
      }else if(!vLength($(this),min,max)){
        thisInvalid($(this), '<?php echo __("Min of 8 digits", true)?>');
        valid = false;
      return false;
      }else{
          thisValid($(this));
        }
      }

    // 
  });

  //remover los iconos sobre selects
  $('select').parent().find('.form-control-feedback').remove();


  return valid;
}

function validateDay(element) {
  var string = $(element).val();
  if(!vOnlyNumbers(element) || string > 31 || string == 0){
    return false;
  }

  

  return true;
}


function vNotEmpty(element){
  var string = $(element).val();
  if(string.length == 0){
    $(element).select().focus();  
    return false;   
  }
  return true;
}

//valida longitudes
function vLength(element, min, max){
  if($(element).val().length > 0){
    var string = $(element).val();
    if(string.length < min){
      $(element).focus();
      return false;
    }

    if(string.length > max){
      $(element).focus();
      return false;
    }
  }

  return true;
}

function validateddmm(element){
  var string = $(element).val();
  re = /^(0?[1-9]|[12][0-9]|3[01])[\/](0?[1-9]|1[012])/;
  if(!re.test(string)) {
    $(element).focus();
    return false;
  }
  return true;
}


function vOnlyNumbers(element){
  var string = $(element).val();
  if(string.length==0){
    return true;
  }
  re = /[0-9]/;
  if(!re.test(string)) {
    $(element).focus();
    return false;
  }
  return true;
}

function vOnlyLetters(element){
  var string = $(element).val();
  if(string.length==0){
    return true;
  }
  re = /[a-z]/;
  if(!re.test(string)) {
    $(element).focus();
    return false;
  }
  return true;
}

function vDate(element){
  var date = $(element).val();
  if(date.length==0){
    return true;
  }
  re = /[0-9][0-9][0-9][0-9]-[0-9][0-9]-[0-9][0-9]/;
  if(!re.test(date)) {
    $(element).focus();
    return false;
  }
  return true;
}

function validateEmail(element) {
    var email = $(element).val();
    if(email.length==0){
      return true;
    }
    var re = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
    return re.test(email);
}

function validateaa(element){
  var text = $(element).val();
  console.log()
  re = /[a-z]/;
  if(!re.test(text)) {
    return false;
  }
  return true;
}

function validateAA(element){
  var text = $(element).val();
  re = /[A-Z]/;
  if(!re.test(text)) {
    return false;
  }
  return true;
}




</script>