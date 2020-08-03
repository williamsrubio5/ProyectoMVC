<head>

    <meta charset="utf-8">
    <title>Crear Nueva Cuenta</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- CSS -->
    <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=PT+Sans:400,700'>
    <link rel="stylesheet" href="public/css/register.css">
    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
        <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

</head>

<body>
 
  <form action="index.php?page=register" method="post" id="formRegister">
    <input type="hidden" name="token" value="{{token}}" />
    {{if hasErrors}}
        <div class="alert alert-danger">
            <ul>
                {{foreach errors}}
                    <li>{{this}}</li>
                {{endfor errors}}
            </ul>
        </div>
    {{endif hasErrors}}

    <div class="page-container">
        <div class="cont">
        <h1 class="h1"><font color="white">Crear Nueva Cuenta</font></h1>
            <input type="text" name="userName" value="{{userName}}" placeholder="Nombre Completo" id="userName"><br><br>
            <input type="text" name="userEmail" value="{{userEmail}}" placeholder="Correo Electronico" id="userEmail"><br><br>
            <input type="password" name="password" value="{{password}}" placeholder="Contraseña" id="password" ><br><br>
            <input type="password" name="passwordCnf" value="{{passwordCnf}}" placeholder="Confirmar Contraseña" id="passwordCnf" ><br>
            <button id="btnNuevaCuenta" class="col-md-12">&nbsp; Nueva Cuenta</button>
       </div>
   </form>

    </div>

    <!-- Javascript -->
    <script src="public/js/jquery-1.8.2.min.js"></script>
    <script src="public/js/supersized.3.2.7.min.js"></script>
    <script src="public/js/supersized-init.js"></script>
    <script src="public/js/scripts.js"></script>

</body>

<script>
    var btnNuevaCuenta = document.getElementById("btnNuevaCuenta");
    btnNuevaCuenta.addEventListener("click", function(e)
    {
        e.preventDefault();
        e.stopPropagation();

        /* VALIDACIONES A NIVEL DE CLIENTE

           Cuando se da clic al boton se verifican cada uno de los campos ingresados.

           En la carpeta Public / js / Se crea un js validators.js QUE SE LLAMA EN EL CONTROLADOR PARA PODER USAR SUS FUNCIONES AQUI
        */

        /*
            - Se guardan los valores de cada campo.
            - Se remueve estilo al error de cada campo.
        */

        email = $("#userEmail").val();
        $("#userEmailError").html('').removeClass("error col-8 col-offset-4");

        password = $("#password").val();
        $("#passwordError").html('').removeClass("error col-8 col-offset-4");

        passwordCnf = $("#passwordCnf").val();
        $("#passwordCnfError").html('').removeClass("error col-8 col-offset-4");

        /* Al inicio NO hay ningun error */
        errors = false;

        /*
            - Se verifica si hay error en cada campo con las funciones de validators.js
            - Si hay un error, se pone true y se agrega la descripcion con estilo al error PARA QUE SEA MOSTRADA.
        */

        if(!isEmailOk(email))
        {
            errors = true;
            $("#userEmailError").html('Correo en formato incorrecto').addClass("error col-8 col-offset-4");
        }

        if(!isNotEmpty(email))
        {
            errors = true;
            $("#userEmailError").html('Correo vacío').addClass("error col-8 col-offset-4");
        }

        /*if (!isPasswordOk(password))
        {
            errors = true;
            $("#passwordError").html('Contraseña en formato incorrecto').addClass("error col-8 col-offset-4");
        }*/

        if(!isNotEmpty(password))
        {
            errors = true;
            $("#passwordError").html('Contraseña vacía').addClass("error col-8 col-offset-4");
        }

        if(password !== passwordCnf) /* Si la contraseña esta vacia para que no tome como que ambas vacias son iguales */
        {
            errors = true;
            $("#passwordCnfError").html('Las contraseñas no coinciden').addClass("error col-8 col-offset-4");
        }


        /* SI NO HAY ERRORES, SE MANDA EL FORMULARIO */
        if(!errors)
        {
            $("#formRegister").submit();
        }
        else
        {
            alert("Tiene errores. Intente de nuevo");
        }

    });
</script>

<style>

#password, #userName, #userEmail, #passwordCnf{
  background-color: white;
}


.col-md-12{
  background-color: #07c126;
}

</style>
