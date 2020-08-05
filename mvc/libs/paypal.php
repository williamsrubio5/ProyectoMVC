<?php

/**
 * PHP Version 7
 * Controlador de Paypal
 *
 * @category Controllers_Paypal
 * @package  Controllers\Paypal
 * @author   Orlando J Betancourth <orlando.betancourth@gmail.com>
 * @license  Comercial http://
 *
 * @version CVS:1.0.0
 *
 * @link http://url.com
 */
 // Sección de requires
require_once 'vendor/autoload.php';


/**
 * Retorna el Api Context de Paypal
 *
 * @return void
 */
function getApiContext()
{
    $apiContext = new \PayPal\Rest\ApiContext(
        new \PayPal\Auth\OAuthTokenCredential(
            'Ab5scWettLZDlCXy8gw8e1T915-_d7QNVMqZ1ev3EWINpcliGK0fc4x-R0wRZncaZ7ieF1GZ190rP8HY', //ClientID
            'EABoOXrOoLcQ2jH5WyJ6z3dAO2tEuqXOxNZAduLURw3XTRMmogIGIPN3JIA6tcuXKjBKBAzhnqfkAIYw'  //ClientSecret
        )
    );
    return $apiContext;
}

?>

