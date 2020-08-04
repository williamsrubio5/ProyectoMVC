<?php

/**
 * Controlador de la Carretilla Anonima
 * 
 * @return void
 */

 require_once "models/mantenimientos/productos.model.php";

 function run()
 {
    $arrViewData = array();

    $cartAnonUID = '';
    
    if(isset($_SESSION["cart_anon_UID"]))
    {
        $cartAnonUID = $_SESSION["cart_anon_UID"];
    }

    if($cartAnonUID === '')
    {
        $cartAnonUID = time() . random_int(1000, 9999);
    }

    $_SESSION["cart_anon_UID"] = $cartAnonUID; 

    $arrViewData = getDetailCartAnon($cartAnonUID); //La funcion trae un array con los datos y el nombre del atributo que se llama en el view para mostrar

    addToContext("index","");
    addToContext("home","");
    addToContext("login","");
    addToContext("register","");
    addToContext("cart","active");
    
    renderizar("infinito/cartAnon", $arrViewData);
 }

 run();

?>