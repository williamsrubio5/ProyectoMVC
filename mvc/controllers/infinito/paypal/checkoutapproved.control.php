<?php

require_once "models/paypal/paypal.model.php";

/**
 * Controlador cuando paypal manda una aprobación del usuario
 * se debe  procesar el pago ejecutandolo y creando la factura
 *
 * @return void
 */


function run()
{
    $viewData = array();
    $usuario = $_SESSION["userCode"];

    //Ejecutar el Pago
    $payment = executePaypal();

    //Si se ejecuto correctamente
    if ($payment) 
    {
        //Si al enviar el usuario y la info del pago se crea la factura correctamente
        if (crearFactura($usuario, $payment->toJSON())) 
        {
            //Se obtiene la factura generada

            //Mostrar Contador del carrito en 0
            addToContext("cartEntries", 0);

            //Se toman lo datos del pago que da Paypal con formato JSON para poder mostrarlos
            $viewData["payment"] = $payment->toJSON();

            //Nombre y Apellido de la persona
            $viewData["checkoutTitle"] = $payment->getPayer()->getPayerInfo()->getFirstName()." ".
                                         $payment->getPayer()->getPayerInfo()->getLastName();

            $viewData["checkoutDescription"] = "";
            $viewData["error"] =  "";

            $viewData["amount"] = $payment->getTransactions()[0]->getAmount()->getTotal();
        }
    }
    else
    {
        $viewData["error"] = "Error al procesar pagos";
    }
    
    renderizar("infinito/paypal/checkoutappr", $viewData);
}

run();

?>
