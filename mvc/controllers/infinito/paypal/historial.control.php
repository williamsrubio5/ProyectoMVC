<?php

/**
 * Controlador para el Historial de las Transacciones (Ventas) realizadas
 * 
 * @return void
 */

require_once "models/mantenimientos/productos.model.php";

function run()
{
    $arrViewData = array();

    $arrViewData = MostrarTransacciones();

    renderizar("infinito/paypal/historial", $arrViewData);
}

run();

?>