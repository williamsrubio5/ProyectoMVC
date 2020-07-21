let formItem = null;
let txtNombreInput = null;
let txtNombreError = null;
let txtCorreoInput = null;
let txtCorreoError = null;
let txttelefonoInput = null;
let txttelefonoError = null;

let btnGuardar = null;
document.addEventListener("DOMContentLoaded",
  function(){
    formItem = document.getElementById("formToValidate");
    txtNombreInput = document.getElementById("txtNombre");
    txtNombreError = document.getElementById("txtNombreError");
    txtCorreoInput = document.getElementById("txtCorreo");
    txtCorreoError = document.getElementById("txtCorreoError");
    txttelefonoInput = document.getElementById("txttelefono");
    txttelefonoError = document.getElementById("txttelefonoError");

    btnGuardar = document.getElementById("btnGuardar");

    btnGuardar.addEventListener("click", function(e){
      e.preventDefault();
      e.stopPropagation();
      let txtNombreRE = (/^\s*$/);
      let txtCorreoRE = (/^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/);
      let txttelefonoRE = (/^[0-9]{8,}$/);
      let isTextRegex = (/^[\w\s][a-zA-Z\s]*$/);
      let errors = {
        "txtNombreError":'',
        "txtCorreoError": '',
        "txttelefonoError": '',
        "hasErrors":false
      };

      if( isTextRegex.test(txtNombreInput.value)!== true ){
        errors.txtNombreError = "El nombre no puede contener valores incorrectos";
        errors.hasErrors = true;
      }

      if( txtNombreRE.test(txtNombreInput.value) ){
        errors.txtNombreError = "Nombre no Puede ir vacio";
        errors.hasErrors = true;
      }
    
      
      
      if (!txtCorreoRE.test(txtCorreoInput.value)){
        errors.txtCorreoError = "Correo Electrónico no Tiene el Formato Correcto";
        errors.hasErrors = true;
      }
      if(!txttelefonoRE.test(txttelefonoInput.value)){
        errors.txttelefonoError = "el telefono tiene que ser de  8 caracteres como minimo";
        errors.hasErrors = true;
      }

      if(errors.hasErrors){
          txtNombreError.innerHTML = errors.txtNombreError;
          txtCorreoError.innerHTML = errors.txtCorreoError;
          txttelefonoError.innerHTML = errors.txttelefonoError;
      }else{
          alert("¡Gracias por su apoyo!")
          
      }
    });
  }
<<<<<<< Updated upstream
);
=======
);
>>>>>>> Stashed changes
