<?php

/**
 * Modelo para las Transacciones con Paypal
 * 
 */

require_once 'libs/paypal.php';

//use para que no de error en clase Payment
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;


//Crear la Transaccion del Pago a realizar
function createPaypalTransaction( $_amount , $_items )
{
    $apiContext = getApiContext(); //credenciales
    $payer = new \PayPal\Api\Payer();
    $payer->setPaymentMethod('paypal');

    $items = new \PayPal\Api\ItemList();
    $_amount = 0;

    //Se crea una lista con los productos
    foreach ($_items as $_item) 
    {
        $item = new \PayPal\Api\Item();
        $item->setSku($_item["skuprd"]);
        $item->setName($_item["dscprd"]);
        $item->setQuantity($_item["crrctd"]);
        $item->setPrice($_item["crrprc"]);
        $_amount += floatval($_item["total"]); //Se va acumulando el total
        $item->setCurrency('USD'); //Moneda es dolar, porque Paypal no tiene Lempiras
        $items->addItem($item);
    }

    //Se coloca el total a pagar
    $amount = new \PayPal\Api\Amount();
    $amount->setTotal(strval($_amount));
    $amount->setCurrency('USD');

    //Se añaden los datos de la transaccion
    $transaction = new \PayPal\Api\Transaction();
    $transaction->setAmount($amount);
    $transaction->setNoteToPayee("Orden de Compra");
    $transaction->setItemList($items);

    //Se colocan los URL a redirigir si se aprueba o se cancela la transaccion
    $redirectUrls = new \PayPal\Api\RedirectUrls();

    //CAMBIAR ESTA DIRECCION URL------------------------------------------------------------------
    $redirectUrls
        ->setReturnUrl("http://localhost/ProyectoMVC/mvc/index.php?page=checkoutappr")
        ->setCancelUrl("http://localhost/ProyectoMVC/mvc/index.php?page=checkoutcancel");

    //Se mandan todos los datos
    $payment = new \PayPal\Api\Payment();
    $payment->setIntent('sale')
        ->setPayer($payer)
        ->setTransactions(array($transaction))
        ->setRedirectUrls($redirectUrls);

    //Se crea el Pago, en nuestro caso creandolo en el SandBox con nuestras credenciales
    try 
    {
        $payment->create($apiContext);

        //Importante para saber que trasacción y guardarlo en la base de datos
        $_SESSION["paypalTrans"] = $payment;

        return $payment->getApprovalLink();
    }
    catch (\PayPal\Exception\PayPalConnectionException $ex) 
    {
        error_log($ex->getData());
        return false;
    }
}

//Ejecutar el Pago cuando este se aprueba
function executePaypal()
{
    //Si existe el Pagador
    if (isset($_GET['PayerID'])) 
    {
        $apiContext = getApiContext();

        //Informacion del Pago
        $paymentId = $_GET['paymentId'];
        $payment = Payment::get($paymentId, $apiContext);

        $execution = new PaymentExecution();
        $execution->setPayerId($_GET['PayerID']);

        try 
        {       
            $result = $payment->execute($execution, $apiContext);
                 
            try
            {
                $payment = Payment::get($paymentId, $apiContext);
            }
            catch (Exception $ex)
            {
                error_log($ex);
                return false;
            }
        }
        catch (Exception $ex)
        {
            error_log($ex);
        }

        return $payment; //Retorna info de Pago

    }
    else
    {
        error_log("Usuario canceló transacción o no es una petición adecuada");
        return false;
    }
}

?>