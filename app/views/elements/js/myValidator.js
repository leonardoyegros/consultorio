$(document).ready(function(){
  $('form').submit(function(){

    console.log("validando elementos");
    
    $('input.not-empty').each(function(){
      vNotEmpty($(this));
    });

    return false;
  });
});



function vNotEmpty(element){
  var string = $(element).val();
  console.log(string);
  if(string.length == 0){
    $(element).focus();
    $.notify('<?php echo __("This can\'t be empty", true)?>');
    return false;
  }
  return true;
}

//valida longitudes
function vLength(element, min, max){
  var string = $(element).val();
  if(string.length < min){
    // console.log("valor:"+string);
    // console.log("min:"+min);
    $(element).focus();
    return false;
  }

  if(string.length > max){
    // console.log("string:"+string);
    // console.log("max:"+max);
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