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
            'AXcXzHlv0KsF1mH0UXm2IAZnC6uqAE0Jt99uvvVkZYyt9RC6KsQy0W1mX3hn9OJuwWlDpPWfFeipA08A', //ClientID
            'EJBJvgDAGamZP0csmPMpaYcpC-TyLXIBmc70oJtsAKyKI0DYQn1mUUrTXvHIh7-ozdknq_0ZpkKQ9ngR'  //ClientSecret
        )
    );
    return $apiContext;
}
