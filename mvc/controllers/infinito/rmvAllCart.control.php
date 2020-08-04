<?php

/**
 * Controlador de la Accion de Eliminar todo la carretilla de compra anonima o autenticada 
 * 
 * @return void
 */

 require_once "models/mantenimientos/productos.model.php"; 

 function run()
 {
    $resultArray = array();

    //Verificar si se presiono el boton de "Eliminar"
    if($_SERVER["REQUEST_METHOD"] === "POST")
    {
        //Eliminar carretilla autenticada o anonima
        if(mw_estaLogueado())
        {
            $resultArray['msg'] = "Eliminando toda la Carretilla Autenticada";
            $usuario = $_SESSION["userCode"];
            delAllCartAut($usuario);
            $resultArray['cartAmount'] = 1; //Para que se refresque la pagina
        }
        else
        {
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

            $resultArray['msg'] = "Eliminando toda la Carretilla Anónima";
            delAllCartAnon($cartAnonUID);
            $resultArray['cartAmount'] = 1;
        }
    }
    else
    {
        $resultArray['msg'] = "Acción Incorrecta";
    }

    header('Content-Type: application/json');
    echo json_encode($resultArray);
    die();
 }

 run();

?>