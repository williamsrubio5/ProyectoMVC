<?php

/** 
 * Controlador para la Accion de Agregar imagenes a los productos
 *  
 * @return void 
 */ 

require_once "models/mantenimientos/productos.model.php";

function run()
{
    $arrViewData = array();

    //TODOS LOS DATOS DEL PRODUCTO, PORQUE SE MANDA A LLAMAR UNO DE LA BASE 
    $arrViewData['codprd'] = 0;
    $arrViewData['dscprd'] = '';
    $arrViewData['sdscprd'] = '';
    $arrViewData['ldscprd'] = '';
    $arrViewData['skuprd'] = '';
    $arrViewData['catprd'] = '';
    $arrViewData['prcprd'] = 0;
    $arrViewData['urlprd'] = '';
    $arrViewData['urlthbprd'] = '';
    $arrViewData['estprd'] = '';

    if ($_SERVER["REQUEST_METHOD"] === "GET") 
    {
        //Si se recibe el codigo del producto
        if (isset($_GET['codprd'])) 
        {
            $arrViewData['codprd'] = intval($_GET['codprd']);

            if ($arrViewData['codprd'] !== 0) 
            {
                $arrTemp = obtenerUnProducto($arrViewData['codprd']);
                mergeFullArrayTo($arrTemp, $arrViewData);
            }
        }
    }


    if ($_SERVER["REQUEST_METHOD"] === "POST") 
    {
        if (isset($_POST['token']) && isset($_SESSION['token_productosimg']) && $_POST['token'] === $_SESSION['token_productosimg']) 
        {
            $arrViewData['codprd'] = intval($_POST['codprd']);

            //var_dump($_FILES); 
            //die();

//             echo "<pre>"; 
//    print_r($_FILES); 
//    echo "</pre>";
//    die();
            //Imagen de Portada (480x480)
            //Si se subio un archivo y se dio clic en Guardar
            if (isset($_FILES["uploadUrlPrd"]) && isset($_POST["btnGuardarUrlPrd"])) 
            {
                //Obtenemos los datos necesarios para generar el registro
                $udir = "public/produc/"; // directorio a donde guardaremos el documento
                $fname = basename($_FILES["uploadUrlPrd"]["name"]); //El nombre del archivo
                $fsize = $_FILES["uploadUrlPrd"]["size"]; //tamaño en bytes
                //Se puede validar el tamano del archivo
                $tfil =  $udir . $arrViewData['codprd']."_".preg_replace('/(?:[^\w|\.])/m', '_', $fname);
                //guardamos el archivo sin letras especiales para evitar cortes de url directas
                move_uploaded_file($_FILES["uploadUrlPrd"]["tmp_name"], $tfil); //movemos el archivo para guardar en la carpeta
                setImageProducto($tfil, $arrViewData["codprd"], "PRT");
                redirectWithMessage("Imagen de Portada Actualizada", "index.php?page=productos");
                die();
            }

            //Imagen de Catalogo (115x115)
            //Si se subio un archivo y se dio clic en Guardar
            if (isset($_FILES["uploadUrlThbPrd"]) && isset($_POST["btnGuardarUrlThbPrd"])) 
            {
                //Obtenemos los datos necesarios para generar el registro
                $udir = "public/produc/"; // directorio a donde guardaremos el documento
                $fname = basename($_FILES["uploadUrlThbPrd"]["name"]); //El nombre del archivo
                $fsize = $_FILES["uploadUrlThbPrd"]["size"]; //tamaño en bytes
                //Se puede validar el tamano del archivo
                $tfil =  $udir . $arrViewData['codprd'] . "_" . preg_replace('/(?:[^\w|\.])/m', '_', $fname);
                //guardamos el archivo sin letras especiales para evitar cortes de url directas
                move_uploaded_file($_FILES["uploadUrlThbPrd"]["tmp_name"], $tfil); //movemos el archivo para guardar en la carpeta
                setImageProducto($tfil, $arrViewData["codprd"], "THB");
                redirectWithMessage("Imagen de Catálogo Actualizada", "index.php?page=productos");
                die();
            }

        } 
        else 
        {
            error_log("INTENTO DE ATAQUE XRS DE ". $_SERVER["REMOTE_ADDR"]);
        }
    }

    $xrsToken = md5(time() . random_int(0, 10000) . "prodimg");
    $arrViewData['token'] = $xrsToken;
    $_SESSION['token_productosimg'] = $xrsToken;

    //Titulo
    $arrViewData['titulo_img'] = "Imágenes de ".$arrViewData['dscprd'];

    $arrViewData['hasAction'] = true;

    renderizar("mantenimientos/productoimg", $arrViewData);
}

run();

?>