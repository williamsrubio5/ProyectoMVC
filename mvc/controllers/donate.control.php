<?php



require_once "models/mantenimientos/productos.model.php";

function run()
{
    $arrDataView = array();

    //Tomar productos de cada categoria
    $arrDataView["varios"] = categoriaCatalogo("VRS");
 
    $arrDataView["remodelacion"] = categoriaCatalogo("REM");
    $arrDataView["apadrinar"] = categoriaCatalogo("ESC");
    
    addToContext("donate","active");
    renderizar("donate", $arrDataView); 
}

run();

?>
