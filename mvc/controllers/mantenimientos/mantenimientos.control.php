<?php

/**
 * Menu de Mantenimientos
 * 
 * @return void
 */

 function run()
 {
    $arrDataView = array();
    $arrMantenimientos = array();

    //Para Obtener el usuario logueado
     $usuario = $_SESSION["userCode"];


   if (isAuthorized('productos', $usuario)) 
   {
        $arrMantenimientos[] = array(
            "page" => "productos",
            "pageDsc"=>"Productos",
            "ionicon"=> "cube"
        );
   }

    $arrDataView["mantenimientos"] = $arrMantenimientos;
    
    renderizar("mantenimientos/mantenimientos", $arrDataView);
 }

 run();


?>