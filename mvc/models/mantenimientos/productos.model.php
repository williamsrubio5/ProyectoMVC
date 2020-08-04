<?php

require_once "libs/dao.php";

//******************************************************* MANTENIMIENTO ********************************************************************/

function todosLosProductos()
{
    $sqlSelect = "SELECT * FROM productos;";

    return obtenerRegistros($sqlSelect);
}


//Obtener datos de un Producto
function obtenerUnProducto($codprd)
{
    $sqlSelect = "SELECT * FROM productos WHERE codprd = %d;";

    return obtenerUnRegistro(
            sprintf($sqlSelect, $codprd)
        );
}

//Insertar Nuevo Producto
function insertProducto($dscprd, $sdscprd, $ldscprd, $skuprd, $catprd, $prcprd, $urlprd, $urlthbprd, $estprd) 
{
    $sqlInsert = "INSERT INTO productos (dscprd, sdscprd, ldscprd, skuprd, catprd, prcprd, urlprd, urlthbprd, estprd)
                  VALUES ('%s', '%s', '%s', '%s', '%s', %lf, '%s', '%s', '%s');";

    $isOk = ejecutarNonQuery(
        sprintf(
            $sqlInsert,
            $dscprd,
            $sdscprd,
            $ldscprd,
            $skuprd,
            $catprd,
            $prcprd,
            '',
            '',
            $estprd
        )
    );

    return getLastInserId();
}

//Actualizar Producto
function updateProducto($dscprd, $sdscprd, $ldscprd, $skuprd, $catprd, $prcprd, $urlprd, $urlthbprd, $estprd, $codprd) 
{
    $sqlUpdate = "UPDATE productos SET dscprd = '%s', sdscprd = '%s',
                  ldscprd = '%s', skuprd = '%s', catprd = '%s', prcprd = %lf, 
                  estprd = '%s' WHERE codprd = %d;";

    return ejecutarNonQuery(
        sprintf(
            $sqlUpdate,
            $dscprd,
            $sdscprd,
            $ldscprd,
            $skuprd,
            $catprd,
            $prcprd,
            $estprd,
            $codprd
        )
    );
}

//Borrar un Producto
function deleteProducto($codprd)
{
    $sqlDelete = "DELETE FROM productos WHERE codprd = %d;";

    return ejecutarNonQuery(
        sprintf($sqlDelete, $codprd)
    );
}

  //Guardar Imagen para el Producto (Ambas Imagenes)
 function setImageProducto($url, $codprd, $type="PRT")
 {
    $sqlUpdatePRT = "UPDATE productos SET urlprd = '%s' WHERE codprd = %d;";
    $sqlUpdateTHB = "UPDATE productos SET urlthbprd = '%s' WHERE codprd = %d;";

    $sqlUpdate = ($type === "PRT")? $sqlUpdatePRT : $sqlUpdateTHB;

    return ejecutarNonQuery(
        sprintf($sqlUpdate, $url, $codprd)
    );
 }


//******************************************************* CATALOGO ************************************************************************/

//Productos disponibles para la Venta
function productoCatalogo()
{
    $sqlSelect = "SELECT codprd, dscprd, skuprd, urlthbprd, prcprd
                  from productos where estprd in('ACT','DSC');";

    $tmpProducto =  obtenerRegistros($sqlSelect);    
    $assocProducto = array();

    foreach ($tmpProducto as $producto) 
    {
        //Imagen predeterminada si no hay imagen
        $assocProducto[$producto["codprd"]] = $producto;

        if (preg_match('/^\s*$/', $producto["urlthbprd"])) 
        {
            $assocProducto[$producto["codprd"]]["urlthbprd"] = "public/imgs/noprodthb.png"; //Insertar la direccion de la imagen------------
        }
    }
  
    return $assocProducto;
}

function categoriaCatalogo($catprd)
{
    $sqlSelect = "SELECT codprd, dscprd, skuprd, urlthbprd, prcprd
                  from productos where catprd = '%s' and estprd in('ACT','DSC');";

    $tmpProducto =  obtenerRegistros(
        sprintf($sqlSelect, $catprd)
    );    
    
    $assocProducto = array();

    foreach ($tmpProducto as $producto) 
    {
        //Imagen predeterminada si no hay imagen
        $assocProducto[$producto["codprd"]] = $producto;

        if (preg_match('/^\s*$/', $producto["urlthbprd"])) 
        {
            $assocProducto[$producto["codprd"]]["urlthbprd"] = "public/imgs/noprodthb.png"; //Insertar la direccion de la imagen------------
        }
    }
  
    return $assocProducto;
}

//Obtener los datos de un producto del Catalogo
function getOneProductoCatalogo($codprd)
{
    $sqlSelect = "SELECT codprd, dscprd, skuprd, urlthbprd, prcprd
                  from productos where  codprd=%d;";

    $tmpProducto =  obtenerRegistros(
        sprintf($sqlSelect, $codprd)
    );

    $assocProducto = array();

    foreach ($tmpProducto as $producto) 
    {
        //Si no hay imagen, se coloca la de "No hay imagen disponible"
        $assocProducto[$producto["codprd"]] = $producto;

        if (preg_match('/^\s*$/', $producto["urlthbprd"])) 
        {
            $assocProducto[$producto["codprd"]]["urlthbprd"] = "public/imgs/noprodthb.png";
        }
    }

    //Si existe el registro se devuelve, sino se manda un arreglo vacio
    if (count($assocProducto)) 
    {
        return $assocProducto[$codprd];
    }
    else 
    {
        return array();
    }
}


//******************************************************* CARRETILLAS *********************************************************************/

//Tiempo que puede permanecer un producto en la carretilla Autenticada
function getAuthTimeDelta()
{
    return 21600; //6 Horas // 6 * 60 * 60; // horas * minutos * segundo
}

//Tiempo que puede permanecer un producto en la carretilla anonima 
function getUnAuthTimeDelta()
{
    return 1200; //20 minutos // 20 * 60; //h , m, s 
}


//Agregar producto a carretilla anonima.
function addToAnonCart($codprod, $uniqueUser, $cantidad, $precio)
{
    $productoCart = getOneProductoCatalogo($codprod);

    if (count($productoCart)) 
    {
        $sqlins = "INSERT INTO `carretillaanon`
        (`anoncod`, `codprd`, `crrctd`, `crrprc`, `crrfching`)
        VALUES ('%s', %d, %d, %f, now())
        ON DUPLICATE KEY UPDATE crrctd = crrctd + VALUES(crrctd),
        crrfching = now();";

        return ejecutarNonQuery(
            sprintf($sqlins, $uniqueUser, $codprod, $cantidad, $precio)
        );
    }

    return 0;
}

//Agregar un producto a la carretilla autenticada
function addToAutCart($codprod, $usuario, $cantidad, $precio)
{
    $productoCart = getOneProductoCatalogo($codprod); 
    error_log(json_encode($productoCart)); //Log de compra autorizada

    if (count($productoCart)) 
    {
        $sqlins = "INSERT INTO `carretilla`
        (`usercod`, `codprd`, `crrctd`, `crrprc`, `crrfching`)
        VALUES (%d, %d, %d, %f, now())
        ON DUPLICATE KEY UPDATE crrctd = crrctd + VALUES(crrctd),
        crrfching = now();";

        return ejecutarNonQuery(
            sprintf($sqlins, $usuario, $codprod, $cantidad, $precio)
        );
    }

    return 0;
}



//Obtener cantidad de productos que hay en la carretilla anonima de ese usuario que no han vencido
function getCantProdAnon($uniqueUser)
{
    //Cantidad de productos que hay en la carretilla aninoma que no han vencido
    $sqlstr = "SELECT count(*) AS productos FROM `carretillaanon`
               WHERE anoncod = '%s' AND TIME_TO_SEC(TIMEDIFF(now(), crrfching)) <= %d;";

    $data = obtenerUnRegistro(
        sprintf($sqlstr, $uniqueUser, getUnAuthTimeDelta())
    );

    if (count($data) > 0)
    {
        return $data["productos"];
    }

    return 0;
}

//Obtener cantidad de productos que hay en la carretilla autenticada de ese usuario que no han vencido
function getCantProdAut($usercod)
{
    $sqlstr = "select count(*) as productos from `carretilla`
              where usercod = %d and TIME_TO_SEC(TIMEDIFF(now(), crrfching)) <= %d;";

    $data =  obtenerUnRegistro(
        sprintf($sqlstr, $usercod, getAuthTimeDelta()
        )
    );

    if (count($data) > 0) 
    {
        return $data["productos"]; 
    }

    return 0;
}


//Eliminar un producto de la carretilla anonima.
function delProdCartAnon($codprod, $uniqueUser, $cantidad)
{
    $productoCart = array();

    $sqlSel = "select * from carretillaanon where anoncod='%s' and codprd=%d;";

    $productoCart = obtenerUnRegistro(
        sprintf($sqlSel, $uniqueUser, $codprod)
    );

    if (count($productoCart)) 
    {
        $newCantidad = $productoCart["crrctd"] - $cantidad;

        if ($productoCart["crrctd"] - $cantidad > 0) 
        {

            $sqlupd = "UPDATE carretillaanon set crrctd = %d, crrfching = now()
                      where anoncod='%s' and codprd=%d;";

            return ejecutarNonQuery(
                sprintf($sqlupd, $newCantidad, $uniqueUser, $codprod)
            );
        }
        else
        {
            $sqldel = "DELETE from carretillaanon where anoncod='%s' and codprd=%d;";

            return ejecutarNonQuery(
                sprintf($sqldel, $uniqueUser, $codprod)
            );
        }
    }

    return 0;
}

//Eliminar un producto de la carretilla autenticada.
function delProdCartAut($codprod, $usuario, $cantidad)
{
    $productoCart = array();

    //Se obtiene todo lo que hay en la carretilla de ese producto para ese usuario
    $sqlSel = "select * from carretilla where usercod=%d and codprd=%d;";

    $productoCart = obtenerUnRegistro(
        sprintf($sqlSel, $usuario, $codprod)
    );

    if (count($productoCart)) 
    {
        //Se guarda la nueva cantidad
        $newCantidad = $productoCart["crrctd"] - $cantidad;

        //Si queda todavia cantidad de ese producto en la carretilla
        if ($newCantidad > 0) 
        {
            //Solo se actualiza
            $sqlupd = "UPDATE carretilla set crrctd = %d, crrfching = now()
                where usercod=%d and codprd=%d;";

            return ejecutarNonQuery(
                sprintf($sqlupd, $newCantidad, $usuario, $codprod)
            );
        }
        else
        {
            //Sino se elimina el registro del producto
            $sqldel = "DELETE from carretilla where usercod=%d and codprd=%d;";

            return ejecutarNonQuery(
                sprintf($sqldel, $usuario, $codprod)
            );
        }
    }

    return 0;
}


//Eliminar toda la carretilla autenticada.
function delAllCartAut($usuario)
{
    $sqlDel = "DELETE from carretilla where usercod=%d;";

    return ejecutarNonQuery(
        sprintf($sqlDel,$usuario)
    );
}

//Eliminar toda la carretilla anonima.
function delAllCartAnon($uniqueUser)
{
    $sqlDel = "DELETE from carretillaanon where anoncod='%s';";

    return ejecutarNonQuery(
        sprintf($sqlDel, $uniqueUser)
    );
}



//Mostrar el detalle de la carretilla anonima.
function getDetailCartAnon($usuario)
{
    $sqlstr = "SELECT a.codprd, b.skuprd, b.dscprd, a.crrctd, a.crrprc
               from `carretillaanon` a inner join `productos` b on a.codprd = b.codprd
               where a.anoncod = '%s' and TIME_TO_SEC(TIMEDIFF(now(), a.crrfching)) <= %d;";

    $arrProductos = obtenerRegistros(
        sprintf($sqlstr, $usuario, getUnAuthTimeDelta())
    );

    $arrProductosFinal = array();
    $arrProductosFinal["products"] = array();
    $arrProductosFinal["totctd"] = 0; //Para acumular cantidad de cada producto
    $arrProductosFinal["total"] = 0; //Para acumular el total por producto y mostrar total final
    $counter = 1;

    foreach ($arrProductos as $producto) 
    {
        $producto["line"] = $counter;
        $producto["total"] = number_format($producto["crrctd"] * $producto["crrprc"], 2);
        $arrProductosFinal["totctd"] += $producto["crrctd"];
        $arrProductosFinal["total"] += ($producto["crrctd"] * $producto["crrprc"]);
        $arrProductosFinal["products"][] = $producto; //Todo se guarda aqui
        $counter++;
    }

    $arrProductosFinal["total"] = number_format($arrProductosFinal["total"], 2);

    return $arrProductosFinal;
}

//Mostrar el detalle de la carretilla autenticada
function getDetailCartAut($usuario)
{
    $sqlstr = "SELECT a.codprd, b.skuprd, b.dscprd, a.crrctd, a.crrprc
               from `carretilla` a inner join `productos` b on a.codprd = b.codprd
               where a.usercod = %d and TIME_TO_SEC(TIMEDIFF(now(), a.crrfching)) <= %d;";

    $arrProductos = obtenerRegistros(
        sprintf(
            $sqlstr,
            $usuario,
            getAuthTimeDelta()
        )
    );
    
    $arrProductosFinal = array();
    $arrProductosFinal["products"] = array();
    $arrProductosFinal["totctd"] = 0;
    $arrProductosFinal["total"] = 0;
    $counter = 1;

    foreach ($arrProductos as $producto) 
    {
        $producto["line"] = $counter;
        $producto["total"] = number_format($producto["crrctd"] * $producto["crrprc"],2);
        $arrProductosFinal["totctd"] += $producto["crrctd"];
        $arrProductosFinal["total"] += ($producto["crrctd"] * $producto["crrprc"]);
        $arrProductosFinal["products"][] = $producto;
        $counter++;
    }

    $arrProductosFinal["total"] = number_format($arrProductosFinal["total"], 2);

    return $arrProductosFinal;
}





//Pasa los productos de la carretilla anonima a la carretilla autenticada
function passAnonToAutCart($uniqueUser, $user)
{
    // Iniciamos Transacción para realizar varias sentencias (ES COMO UN PROCEDIMIENTO ALMACENADO. //BEGIN)
    // Y confirmar al final del Ciclo si no hay algun error
    iniciarTransaccion();

    $sqlins = "INSERT INTO `carretilla`
        (`usercod`, `codprd`, `crrctd`, `crrprc`, `crrfching`)
      SELECT %d as `usercodt`, `codprd` as codprdt,
        `crrctd` as crrctdt, `crrprc` as crrprct, `crrfching` as crrfchingt
         FROM `carretillaanon`
      where `anoncod` = '%s'
      ON DUPLICATE KEY UPDATE
        `carretilla`.`crrctd` = `carretilla`.crrctd + VALUES(`carretilla`.`crrctd`),
         crrfching = now();";

    ejecutarNonQuery(
        sprintf($sqlins, $user, $uniqueUser)
    );

    //Se borra la carretilla anonima del unique user
    $sqldel = "DELETE FROM `carretillaanon` where anoncod = '%s';";

    ejecutarNonQuery(
        sprintf($sqldel, $uniqueUser)
    );

    terminarTransaccion();

    //Se retorna cantidad de productos que hay en la carretilla autenticada
    return getCantProdAut($user);
}

//Eliminar las carretillas fuera de tiempo
function cleanTimeOutCart()
{
    $contador = 0;

    iniciarTransaccion();

    //CARRETILLA ANONIMA
    $sqlDel = "DELETE from carretillaanon
               where TIME_TO_SEC(TIMEDIFF(now(), crrfching)) > %d";

    $contador += ejecutarNonQuery(
        sprintf(
            $sqlDel,
            getUnAuthTimeDelta()
        )
    );

    // CARRETILLA AUTENTICADA
    $sqlDel = "DELETE from carretilla
               where TIME_TO_SEC(TIMEDIFF(now(), crrfching)) > %d";

    $contador += ejecutarNonQuery(
        sprintf(
            $sqlDel,
            getAuthTimeDelta()
        )
    );

    terminarTransaccion();

    return $contador;
}


//******************************************************* CHECKOUT *********************************************************************/

//Resetea el tiempo de la carretilla con la fecha de hoy cuando va a checkout
function resetCartTime($usuario)
{
    $sqlUpd = "UPDATE carretilla set crrfching = now() where usercod=%d;";

    return ejecutarNonQuery(
        sprintf($sqlUpd, $usuario)
    );
}

//Crear Factura y Factura_Detalle y Factura_FormaPago
function crearFactura($usuario, $jsonPayment)
{
    $fctcod = false;

    iniciarTransaccion();

    //Crear la factura
    $sqlins = "INSERT INTO `factura`
    ( `fctfch`, `userCode`, `fctEst`, `fctMonto`,
      `fctShip`, `fctTotal`, `fctPayRef`, `fctShpAddr`)
    VALUES ( now(), %d, 'APR', 0, 0, 0, '', '');";

//Se ejecuta el insert
    if (ejecutarNonQuery(sprintf($sqlins, $usuario))) 
    {
        //Crear detalle de factura
        $fctcod = getLastInserId(); //Se toma el ultimo ID insertado
        $carretilla = getDetailCartAut($usuario)["products"]; //Detalle de la carretilla autenticada que se pago
        $subtotal = 0;
        $total = 0;

        //query para insertar el detalle de la factura
        $sqldetins = "INSERT INTO `factura_detalle`
            (`fctcod`, `codprd`, `fctDsc`, `fctCtd`, `fctPrc`)
            VALUES
            (%d, %d, '%s', %d, %f);";
     
        //Por cada producto de la carretilla se inserta en el detalle y se disminuye el stock
        foreach ($carretilla as $producto) 
        {
            //Vamos obteniendo el Total y Subtotal para la Factura
            $subtotal += ($producto["crrctd"] * $producto["crrprc"]);
            $total += ($producto["crrctd"] * $producto["crrprc"]);
            ejecutarNonQuery(
                sprintf(
                    $sqldetins,
                    $fctcod,
                    $producto["codprd"],
                    $producto["dscprd"],
                    $producto["crrctd"],
                    $producto["crrprc"]
                )
            );
        }

        //Actualizar los totales de la factura
        $sqlUpdtotal = "UPDATE `factura` set
            `fctMonto` = %f, `fctShip`=%f, `fctTotal`=%f
            where `fctcod` = %d;";

        ejecutarNonQuery(
            sprintf(
                $sqlUpdtotal,
                $subtotal,
                0,
                $total,
                $fctcod
            )
        );

        //Forma de pago de la factura
        $sqlInsFrmPago = "INSERT INTO `factura_forma_pago`
            (`fctcod`, `fctfrmpago`, `fctfrmdata`)
            VALUES
            (%d, 'PAYPAL', '%s');";

        ejecutarNonQuery(
            sprintf(
                $sqlInsFrmPago,
                $fctcod,
                $jsonPayment //Respuesta de Pasarela de Pago
            )
        );

        //Eliminar carretilla del usuario. 
        delAllCartAut($usuario);

    }
    else
    {
        terminarTransaccion(false);
        return false;
    }

    terminarTransaccion(true);

    //Retornar codigo de factura que se acaba de crear
    return $fctcod;
}

//Historial de Transacciones
function MostrarTransacciones()
{
    $sqlSel = "SELECT fd.fctcod, DATE(f.fctfch) as Fecha, u.useremail, fd.fctDsc, fd.fctCtd,
    fd.fctPrc, f.fctTotal FROM factura_detalle fd
    inner join factura f on fd.fctcod = f.fctcod
	inner join usuario u on f.userCode = u.usercod;"; 

    $tempArray =  obtenerRegistros($sqlSel);

    $transacciones = array();
    $transacciones["total_global"] = 0;

    foreach($tempArray as $venta)
    {
        $transacciones["total_global"] += $venta["fctTotal"];
        $transacciones["transacciones"][] = $venta; //Todo se guarda aqui
    }

    return $transacciones;
}

//***************************************************** ALBUM DE INSIGNIAS ***************************************************************/

/**
 * Obtiene las insignias que se pueden vender (Activos y Descontinuados) por categoria
 * y las insignias que ha comprado el usuario por categoria 
 * para mostrarlas en el Album como compradas o no y la cantidad de cada una 
 *
 *
 */
function getInsigniasAlbum($usuario, $catprd)
{
    //Obtener los datos a mostrar de los productos disponibles para vender
     $sqlSelect = "SELECT codprd, dscprd, skuprd, prcprd, urlthbprd FROM productos WHERE estprd in('ACT', 'DSC') AND catprd='%s';";
     $tempProducto = obtenerRegistros( sprintf($sqlSelect, $catprd) ); 

     //Establecer en $assocProducto la llave primaria codprd para cada registro, asi se accede a cada uno por su llave sin tener que estar recorriendo el arreglo
     $assocProducto = array();

     foreach($tempProducto as $producto)
     {
         $assocProducto[$producto['codprd']] = $producto;

         //Si no hay imagen, se coloca la de "No hay imagen disponible"
         if(preg_match('/^\s*$/', $producto["urlthbprd"]))
         {
             $assocProducto[$producto['codprd']['urlthbprd']] = "public/imgs/noprodthb.png";
         }

         //Cambiar cantidad de productos disponibles por 0 asumiendo que no ha comprado ninguna  
         //porque despues se actualizara la cantidad solo de las que si estan compradas.
         //De igual forma se coloca que no tiene esa insignia y despues se actualiza.
         $assocProducto[$producto['codprd']]['cantprd'] = 0;
         $assocProducto[$producto['codprd']]['hasInsignia'] = false;
     }

     //Obtener Insignias que ha comprado el usuario logueado
     $sqlSelect = "SELECT p.codprd, p.skuprd, p.dscprd, fd.fctCtd as 'cantidad'
                FROM productos p 
                INNER JOIN factura_detalle fd ON p.codprd = fd.codprd
                INNER JOIN factura f ON f.fctcod = fd.fctcod
                INNER JOIN usuario u ON u.usercod = f.userCode
                WHERE u.usercod = %d AND p.catprd = '%s'
                GROUP BY p.codprd;";

     $tempInsignia = obtenerRegistros(
         sprintf($sqlSelect, $usuario, $catprd)
     );

     //Recorrer insignias compradas para ver si estan en el catalogo y mostrarlas
     foreach($tempInsignia as $insignia)
     { 
         if(isset($assocProducto[$insignia['codprd']]))
         {
             //Agrego a cada fila donde hay una coincidencia que si tiene esa insignia
             $assocProducto[$insignia['codprd']]['hasInsignia'] = true;

             //Cambiar cantidad de productos disponibles por cantidad comprada
             $assocProducto[$insignia['codprd']]['cantprd'] = $insignia['cantidad'];
         }
     }

     return $assocProducto;
}

?>