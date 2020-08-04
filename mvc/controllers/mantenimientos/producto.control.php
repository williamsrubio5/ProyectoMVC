<?php

/**
 * Controlador de Acciones del Formulario del producto
 *
 * @return void
 */

require_once "models/mantenimientos/productos.model.php";


function run()
{
    $arrViewData = array();

    $arrModeDsc = array(
        'INS' => "Nuevo Producto",
        'UPD' => "Editando a %s",
        'DEL' => "Eliminando a %s",
        'DSP' => "Datos de %s"
    );

    $arrViewData['codprd'] = 0;
    $arrViewData['dscprd'] = '';
    $arrViewData['sdscprd'] = '';
    $arrViewData['ldscprd'] = '';
    $arrViewData['skuprd'] = '';

    $arrViewData['catprd'] = '';
    $arrViewData['catLBATrue'] = '';
    $arrViewData['catCOMTrue'] = '';
    $arrViewData['catCLNTrue'] = '';
    $arrViewData['catOBSTrue'] = '';
    $arrViewData['catREMTrue'] = '';
    $arrViewData['catESCTrue'] = '';

    $arrViewData['prcprd'] = 0;
    $arrViewData['urlprd'] = '';
    $arrViewData['urlthbprd'] = '';

    $arrViewData['estprd'] = '';
    $arrViewData['estACTTrue'] = '';
    $arrViewData['estINATrue'] = '';
    $arrViewData['estPLNTrue'] = '';
    $arrViewData['estRETTrue'] = '';
    $arrViewData['estDSCTrue'] = '';

    $arrViewData['mode'] = 'INS';
    $arrViewData['modedsc'] = '';

    //GET
    if ($_SERVER["REQUEST_METHOD"] === "GET") 
    {
        if (isset($_GET['mode'])) 
        {
            $arrViewData['codprd'] = $_GET['codprd'];
            $arrViewData['mode'] = $_GET['mode'];

            if ($arrViewData['mode'] !== 'INS') 
            {
                $arrTemp = obtenerUnProducto($arrViewData['codprd']);
                mergeFullArrayTo($arrTemp, $arrViewData);
            }
        }
    }

    //POST
    if ($_SERVER["REQUEST_METHOD"] === "POST") 
    {

        if (isset($_POST['token']) && isset($_SESSION['token_productos']) && $_POST['token'] === $_SESSION['token_productos'])
        {
            $arrViewData['codprd'] = intval($_POST['codprd']);
            $arrViewData['dscprd'] = $_POST['dscprd'];
            $arrViewData['sdscprd'] = $_POST['sdscprd'];
            $arrViewData['ldscprd'] = $_POST['ldscprd'];
            $arrViewData['skuprd'] = $_POST['skuprd'];
            $arrViewData['catprd'] = $_POST['catprd'];
            $arrViewData['prcprd'] = floatval($_POST['prcprd']);
            $arrViewData['urlprd'] = $_POST['urlprd'];
            $arrViewData['urlthbprd'] = $_POST['urlthbprd'];
            $arrViewData['estprd'] = $_POST['estprd'];
            $arrViewData['mode'] = $_POST['mode'];


            switch($arrViewData['mode']) 
            {
                case 'INS':
                    insertProducto($arrViewData['dscprd'], $arrViewData['sdscprd'], $arrViewData['ldscprd'], $arrViewData['skuprd'],
                                   $arrViewData['catprd'], $arrViewData['prcprd'],  $arrViewData['urlprd'], $arrViewData['urlthbprd'],
                                   $arrViewData['estprd']);

                    redirectWithMessage("Producto agregado exitosamente", "index.php?page=productos");
                die();

                case 'UPD':
                    updateProducto($arrViewData['dscprd'], $arrViewData['sdscprd'], $arrViewData['ldscprd'], $arrViewData['skuprd'],
                                   $arrViewData['catprd'], $arrViewData['prcprd'],  $arrViewData['urlprd'], $arrViewData['urlthbprd'],
                                   $arrViewData['estprd'], $arrViewData['codprd']
                    );

                    redirectWithMessage("Producto editado exitosamente", "index.php?page=productos");
                die();

                case 'DEL':
                    deleteProducto($arrViewData['codprd']);
                    redirectWithMessage("Producto eliminado exitosamente", "index.php?page=productos");
                die();
            }
        }
        else
        {
            error_log("INTENTO DE ATAQUE XRS DE ". $_SERVER["REMOTE_ADDR"]);
        }
    }


    $xrsToken = md5(time() . random_int(0, 10000) . "prod");
    $arrViewData['token'] = $xrsToken;
    $_SESSION['token_productos'] = $xrsToken;

    $arrViewData['modedsc'] = sprintf($arrModeDsc[$arrViewData['mode']], $arrViewData['dscprd']);

    $arrViewData['catLBATrue'] = ($arrViewData['catprd'] === "VRS")? "selected" : "";
    $arrViewData['catREMTrue'] = ($arrViewData['catprd'] === "REM")? "selected" : "";
    $arrViewData['catESCTrue'] = ($arrViewData['catprd'] === "ESC")? "selected" : "";

    $arrViewData['estACTTrue'] = ($arrViewData['estprd'] === "ACT")? "selected" : "";
    $arrViewData['estINATrue'] = ($arrViewData['estprd'] === "INA")? "selected" : "";
    $arrViewData['estPLNTrue'] = ($arrViewData['estprd'] === "PLN")? "selected" : "";
    $arrViewData['estRETTrue'] = ($arrViewData['estprd'] === "RET")? "selected" : "";
    $arrViewData['estDSCTrue'] = ($arrViewData['estprd'] === "DSC")? "selected" : "";


    $arrViewData['isReadOnly'] = false;

    if ($arrViewData['mode'] === "DSP" || $arrViewData['mode'] === "DEL") 
    {
        $arrViewData['isReadOnly'] = true;
    }

    $arrViewData['hasAction'] = true;

    if ($arrViewData['mode'] === "DSP") 
    {
        $arrViewData['hasAction'] = false;
    }

    renderizar("mantenimientos/producto", $arrViewData); 
}

run();

?>