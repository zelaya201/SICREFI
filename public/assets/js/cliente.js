/* Función para validar el monto */

function filterFloat(evt,input){
  var key = window.Event ? evt.which : evt.keyCode;
  var chark = String.fromCharCode(key);
  var tempValue = input.value+chark;

  if(key >= 48 && key <= 57){
    if(patternFloat(tempValue)=== false){
      return false;
    }else{
      return true;
    }
  }else{
    if(key == 8 || key == 13 || key == 46 || key == 0) {
      return true;
    }else{
      return false;
    }
  }
}

function patternFloat(__val__){
  var preg = /^([0-9]+\.?[0-9]{0,2})$/;
  if(preg.test(__val__) === true){
    return true;
  }else{
    return false;
  }
}

function soloNumeros(e){
  var key = window.event ? e.which : e.keyCode;
  if (key < 48 || key > 57) {
    e.preventDefault();
  }
}
