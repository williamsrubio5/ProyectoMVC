<?php

/**
 * Controlador para Pagar el carrito con PayPal
 * 
 * @return void
 */

require_once "models/paypal/paypal.model.php";

function run()
{
    $arrViewData = array();

    //Saca la informacion de la carretilla autenticada del usuario 
    //para mostrarla y que pueda hacer una ultima modificacion si lo desea 
    $usuario = $_SESSION['userCode'];

    $arrViewData = getDetailCartAut($usuario);

    //Si se presiona el boton de "Pagar con Paypal" en el checkout
    if(isset($_POST["btnSubmit"]))
    {
        //Se crea la transaccion en Paypal con los productos a solicitar pago
        $paypalReturn = createPaypalTransaction(0, $arrViewData["products"]);

        if($paypalReturn)
        {
            //Si se completo correctamente redirecciona a checkoutapr
            redirectToUrl($paypalReturn);
        }

        //Se guardan los datos del pago
        $arrViewData['returnData'] = $paypalReturn; 

    }

    //Resetea el tiempo de la carretilla con la fecha de hoy
    resetCartTime($usuario); 

    renderizar("infinito/paypal/checkout", $arrViewData);
}

run();

?>