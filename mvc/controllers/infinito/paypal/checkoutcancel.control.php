<?php

/**
 * Controlador Paypal Envia una alerta de cancelación.
 *
 * @return void
 */

function run()
{
    $arrViewData = array();

    renderizar("infinito/paypal/checkoutcancel", $arrViewData);
}

run();

?>
