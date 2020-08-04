<?php

/**
 * Controlador para pasar una carretilla anonima a una autenticada cuando se loguee
 * y controlar el contador de productos para que aparezca en la imagen del carrito
 * 
 * @return void
 */

 require_once "models/mantenimientos/productos.model.php"; 

 function runCartMW()
 {
    $cartEntries = 0; //Contador de productos
    $cartAnonUID = '';

    $isOk = cleanTimeOutCart(); //Eliminar las carretillas fuera de tiempo

    if(isset($_SESSION["cart_anon_UID"]))
    {
        $cartAnonUID = $_SESSION["cart_anon_UID"];
    }

    if(mw_estaLogueado())
    {
        //Se obtiene el usuario logueado
        $usuario = $_SESSION["userCode"];

        //Si no trajo vacio de la sesion
        if($cartAnonUID !== '')
        {
            //Si hay sesion anonima y se loguea, se verifica que tenga productos en la carretilla anonima
            $tempCantProd = getCantProdAnon($cartAnonUID);

            if($tempCantProd > 0)
            {
                //Se pasa de la anonima a la autenticada
                passAnonToAutCart($cartAnonUID, $usuario);

                //Se elimina la sesion anonima
                unset($_SESSION["cart_anon_UID"]);
            }
        }

        //Se actualiza la cantidad de productos de la autenticada para el contador
        $cartEntries = getCantProdAut($usuario);
    }
    else
    {
        //Si no esta logueado, sigue siendo anonimo, entonces solo se verifica que exista esa sesion 
        //y se trae la cantidad de productos de la carretilla anonima para el contador
        if($cartAnonUID !== '')
        {
            $cartEntries = getCantProdAnon($cartAnonUID); 
        }   
    }

    //Actualizar y mostrar contador
    addToContext("cartEntries", $cartEntries); 
 }

 runCartMW();

?>