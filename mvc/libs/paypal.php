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

die(
    "<h1>Revisar el archivo libs/paypal.php</h1>
    <h1>Comentar o eliminar linea 4 despues de agregar los datos
    de autenticación solicitados</h1>
    <h2><a href=\"index.php?page=dashboard\">Regresar</a></h2>"
);
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
