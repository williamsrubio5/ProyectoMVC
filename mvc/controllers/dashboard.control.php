<?php

require_once "models/mantenimientos/productos.model.php";
function run(){
  addCssRef("public/css/dashboard.css");

  $arrDataView = array();
  $arrDataView["varios"] = categoriaCatalogo("VRS");
  $arrDataView["donacion"] = categoriaCatalogo("REM");
  $arrDataView["apadrinar"] = categoriaCatalogo("ESC");

  renderizar("dashboard", $arrDataView);



}

run();
?>
