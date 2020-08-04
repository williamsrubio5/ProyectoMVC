<?php

/**
 * Menu de Seguridad
 * 
 * @return void
 */

 function run()
 {
    $arrDataView = array();
    $arrSecurity = array();

    //Para Obtener el usuario logueado
    $usuario = $_SESSION["userCode"];

    if (isAuthorized('users', $usuario)) 
    {
        $arrSecurity[] = array(
            "page" => "users",
            "pageDsc"=>"Usuarios",
            "ionicon"=> "person-stalker"
        );
    }

    if (isAuthorized('roles', $usuario)) 
    {
        $arrSecurity[] = array(
            "page" => "roles",
            "pageDsc"=>"Roles",
            "ionicon"=> "cash"
        );
    }

    if (isAuthorized('programas', $usuario)) 
    {
        $arrSecurity[] = array(
            "page" => "programas",
            "pageDsc"=>"Programas y Funciones",
            "ionicon"=> "ios-cog"
        );
    }

    $arrDataView["security"] = $arrSecurity;

    renderizar("security/security", $arrDataView);
 }

 run();

 

?>