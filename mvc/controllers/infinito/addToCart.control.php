<?php

/**
 * Controlador para la Accion de Agregar un Producto al Carrito
 * 
 * @return void
 */

 require_once "models/mantenimientos/productos.model.php";

 function run()
 {
    $resultArray = array();

    //Verificar si se presiono un boton (Precio en el catalogo o el + en el carrito de compra) y se si se trae un producto en la url
    if($_SERVER["REQUEST_METHOD"] === "POST" && isset($_GET["codprd"]))
    {
        //Variables
        $codprd = intval($_GET["codprd"]);
        $cantidad = 1;

        //Obtener datos del producto seleccionado
        $producto = obtenerUnProducto($codprd);

        //Verificar si existe el producto, sino se manda un mensaje JSON para la consola y se termina el proceso
        if(count($producto) <= 0)
        {
            $resultArray['msg'] = "El Producto seleccionado no existe";
            header('Content-Type: application/json');
            echo json_encode($resultArray);
            die();
        }
        
        //Precio
        $precio = $producto['prcprd'];

        //Si esta logueado va a carretilla autenticada, sino a la anonima. La funcion se trae de controllers/mw/verificar.mw.php
        if(mw_estaLogueado())
        {
            $resultArray['msg'] = "Agregando a la Carretilla Autenticada";
            $usuario = $_SESSION["userCode"]; //Extraemos el usuario logueado desde verificar.mw.php 
            addToAutCart($codprd, $usuario, $cantidad, $precio);
            $resultArray['cartAmount'] = getCantProdAut($usuario); //Cantidad de productos que tiene ese usuario
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

            $resultArray['msg'] = "Agregando a la Carretilla Anónima";
            addToAnonCart($codprd, $cartAnonUID, $cantidad, $precio);
            $resultArray['cartAmount'] = getCantProdAnon($cartAnonUID);
        }
    }
    else
    {
        //Ni POST ni GET
        $resultArray['msg'] = "Acción Incorrecta";
    }

    //Crear json para consola y termina el proceso
    header('Content-Type: application/json');
    echo json_encode($resultArray);
    die();
    
 }

 run();

?>