<?php

/**
 * Controlador de la Accion de Remover un producto de la carretilla anonima o autenticada
 * 
 * @return void
 */

 require_once "models/mantenimientos/productos.model.php";  

 function run()
 {
    $resultArray = array();

    //Verificar si se dio clic al boton - y se trae un producto en la URL
    if($_SERVER["REQUEST_METHOD"] === "POST" && isset($_GET['codprd']))
    {
        //Datos
        $codprd = intval($_GET['codprd']);
        $cantidad = 1;
        $producto = obtenerUnProducto($codprd);

        //Verificar si existe el producto, sino msg json y se termina
        if(count($producto) <= 0)
        {
            $resultArray['msg'] = "El Producto seleccionado no existe";
            header('Content-Type: application/json');
            echo json_encode($resultArray);
            die();
        }

        $precio = $producto['prcprd'];

        //Si esta logueado o es anonimo
        if(mw_estaLogueado())
        {
            $usuario = $_SESSION["userCode"];
            $resultArray['msg'] = "Eliminando Producto de Carretilla Autenticada";
            delProdCartAut($codprd, $usuario, $cantidad);
            $resultArray['cartAmount'] = 1; //1 porque la pagina no va a recargar cuando se elimine el ultimo producto, solo cuando sea > 0
        }
        else
        {
            //Obtencion o creacion del Unique ID del usuario anonimo. $_SESSION["cart_anon_UID"] esta en verificar.mw.php
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

            $resultArray['msg'] = "Eliminando Producto de Carretilla Anónima";
            delProdCartAnon($codprd, $cartAnonUID, $cantidad);
            $resultArray['cartAmount'] = 1;
        }
    }
    else
    {
        //Ni POST ni GET
        $resultArray['msg'] = "Acción Incorrecta";
    }

    //Crear json para consola
    header('Content-Type: application/json');
    echo json_encode($resultArray);
    die();
 }

 run();

?>