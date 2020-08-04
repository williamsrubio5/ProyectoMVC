<?php

/**
 * Controlador de  carretilla de compra autenticada
 * 
 * @return void
 */

require_once "models/mantenimientos/productos.model.php";

function run()
{
    $usuario = $_SESSION["userCode"];

    $arrDataView = array();
    $arrDataView = getDetailCartAut($usuario);

    renderizar("infinito/cartAut", $arrDataView);
}

run();

?>