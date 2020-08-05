<?php
/**
 * PHP Version 5
 * Application Router
 *
 * @category Router
 * @package  Router
 * @author   Orlando J Betancourth <orlando.betancourth@gmail.com>
 * @author   Luis Fernando Gomez Figueroa <lgomezf16@gmail.com>
 * @license  Comercial http://
 *
 * @version 1.0.0
 *
 * @link http://url.com
 */
session_start();

require_once "libs/utilities.php";

$pageRequest = "index";

if (isset($_GET["page"])) {
    $pageRequest = $_GET["page"];
}

//Incorporando los midlewares son codigos que se deben ejecutar
//Siempre
require_once "controllers/mw/verificar.mw.php";
require_once "controllers/mw/site.mw.php";
require_once "controllers/infinito/mw/cart.mw.php";

// aqui no se toca jajaja la funcion de este index es
// llamar al controlador adecuado para manejar el
// index.php?page=modulo

    //Este switch se encarga de todo el enrutamiento público
switch ($pageRequest) {
    //Accesos Publicos
case "home":
    //llamar al controlador
    include_once "controllers/home.control.php";
    die();

case "login":
    include_once "controllers/security/login.control.php";
    die();
 case "donate":
        
        include_once "controllers/donate.control.php";
        die();
case "logout":
    include_once "controllers/security/logout.control.php";
    die();
case "nosotros":
    include_once "controllers/home.control.php";
    die();
case "unete":
        include_once "controllers/unete.control.php";
        die();
case "nuestraH":
        include_once "controllers/nuestraH.control.php";
        die();
case "recreacion":
        include_once "controllers/recreacion.control.php";
        die();
 case "register":
         include_once "controllers/register.control.php";
         die();
case "apadrinar":
        include_once "controllers/apadrinar.control.php";
        die();
case "ayudas":
            include_once "controllers/ayudas.control.php";
            die();
case "ingles":
            include_once "controllers/ingles.control.php";
            die();
 case "computacion":
            include_once "controllers/computacion.control.php";
            die();
case "deportes":
            include_once "controllers/deportes.control.php";
            die();
case "proyectos":
            include_once "controllers/proyectos.control.php";
            die();

/************* CARRETILLA DE COMPRA ***********/
case "addToCart":
    include_once "controllers/infinito/addToCart.control.php";
   die();

   case "rmvToCart":
    include_once "controllers/infinito/rmvToCart.control.php";
   die();

   case "rmvAllCart":
    include_once "controllers/infinito/rmvAllCart.control.php";
   die();

   case "cartAnon":
    include_once "controllers/infinito/cartAnon.control.php";
   die();

  
        
    }


//Este switch se encarga de todo el enrutamiento que ocupa login
$logged = mw_estaLogueado();
if ($logged) {
    addToContext("layoutFile", "verified_layout");
    include_once 'controllers/mw/autorizar.mw.php';
     
    if (!isAuthorized($pageRequest, $_SESSION["userCode"])) {
        include_once"controllers/dashboard.control.php";
    }
    generarMenu($_SESSION["userCode"]);
}

require_once "controllers/mw/support.mw.php";
switch ($pageRequest) {
case "dashboard":
    ($logged)?
      include_once "controllers/dashboard.control.php":
      mw_redirectToLogin($_SERVER["QUERY_STRING"]);
    die();
case "users":
    ($logged)?
      include_once "controllers/security/users.control.php":
      mw_redirectToLogin($_SERVER["QUERY_STRING"]);
    die();
case "user":
    ($logged)?
      include_once "controllers/security/user.control.php":
      mw_redirectToLogin($_SERVER["QUERY_STRING"]);
    die();
case "roles":
    ($logged)?
      include_once "controllers/security/roles.control.php":
      mw_redirectToLogin($_SERVER["QUERY_STRING"]);
    die();
case "rol":
    ($logged)?
      include_once "controllers/security/rol.control.php":
      mw_redirectToLogin($_SERVER["QUERY_STRING"]);
    die();
case "programas":
    ($logged)?
      include_once "controllers/security/programas.control.php":
      mw_redirectToLogin($_SERVER["QUERY_STRING"]);
    die();
case "programa":
    ($logged)?
      include_once "controllers/security/programa.control.php":
      mw_redirectToLogin($_SERVER["QUERY_STRING"]);
    die();

case "checkout":
    ($logged) ?
    include_once "controllers/infinito/paypal/checkout.control.php" :
    mw_redirectToLogin($_SERVER["QUERY_STRING"]);
    die();
case "checkoutapr":
    ($logged) ?
    include_once "controllers/infinito/paypal/checkoutapproved.control.php" :
    mw_redirectToLogin($_SERVER["QUERY_STRING"]);
    die();
case "checkoutcnl":
    ($logged) ?
    include_once "controllers/infinito/paypal/checkoutcancel.control.php" :
    mw_redirectToLogin($_SERVER["QUERY_STRING"]);
    die();






  /************* CARRETILLA DE COMPRA ***********/
  case "addToCart":
    include_once "controllers/infinito/addToCart.control.php";
   die();

   case "rmvToCart":
    include_once "controllers/infinito/rmvToCart.control.php";
   die();

   case "rmvAllCart":
    include_once "controllers/infinito/rmvAllCart.control.php";
   die();

   case "cartAnon":
    include_once "controllers/infinito/cartAnon.control.php";
   die();
}

//Este switch se encarga de todo el enrutamiento que ocupa login
$logged = mw_estaLogueado();
if ($logged) {
    addToContext("layoutFile", "verified_layout");
    include_once 'controllers/mw/autorizar.mw.php';
    if (!isAuthorized($pageRequest, $_SESSION["userCode"])) {
        include_once"controllers/notauth.control.php";
        die();
    }
    generarMenu($_SESSION["userCode"]);
}

require_once "controllers/mw/support.mw.php";
switch ($pageRequest) {
case "dashboard":
    ($logged)?
      include_once "controllers/dashboard.control.php":
      mw_redirectToLogin($_SERVER["QUERY_STRING"]);
    die();
case "users":
    ($logged)?
      include_once "controllers/security/users.control.php":
      mw_redirectToLogin($_SERVER["QUERY_STRING"]);
    die();
case "user":
    ($logged)?
      include_once "controllers/security/user.control.php":
      mw_redirectToLogin($_SERVER["QUERY_STRING"]);
    die();
case "roles":
    ($logged)?
      include_once "controllers/security/roles.control.php":
      mw_redirectToLogin($_SERVER["QUERY_STRING"]);
    die();
case "rol":
    ($logged)?
      include_once "controllers/security/rol.control.php":
      mw_redirectToLogin($_SERVER["QUERY_STRING"]);
    die();
case "programas":
    ($logged)?
      include_once "controllers/security/programas.control.php":
      mw_redirectToLogin($_SERVER["QUERY_STRING"]);
    die();
case "programa":
    ($logged)?
      include_once "controllers/security/programa.control.php":
      mw_redirectToLogin($_SERVER["QUERY_STRING"]);
    die();

 //*Seguridad
 case "security":
    ($logged)?
      include_once "controllers/security/security.control.php":
      mw_redirectToLogin($_SERVER["QUERY_STRING"]);
 die();

 //*Mantenimientos
 case "parametros":
    ($logged)?
      include_once "controllers/mantenimientos/mantenimientos.control.php":
      mw_redirectToLogin($_SERVER["QUERY_STRING"]);
 die();

 //*Productos
 case "productos":
      ($logged)?
      include_once "controllers/mantenimientos/productos.control.php":
      mw_redirectToLogin($_SERVER["QUERY_STRING"]);
 die();

  case "producto":
      ($logged)?
      include_once "controllers/mantenimientos/producto.control.php":
      mw_redirectToLogin($_SERVER["QUERY_STRING"]);
 die();

  case "productoimg":
      ($logged)?
      include_once "controllers/mantenimientos/productoimg.control.php":
      mw_redirectToLogin($_SERVER["QUERY_STRING"]);
 die();

 //*Carretilla
  case "cartAut":
    
    include_once "controllers/infinito/cartAut.control.php";
  die();

 //*Checkout
 case "checkout":
    ($logged)?
    include_once "controllers/infinito/paypal/checkout.control.php":
    mw_redirectToLogin($_SERVER["QUERY_STRING"]); 
  die();

 case "checkoutappr":
    ($logged)?
    include_once "controllers/infinito/paypal/checkoutapproved.control.php":
    mw_redirectToLogin($_SERVER["QUERY_STRING"]);
  die();  

 case "checkoutcancel":
    ($logged)?
    include_once "controllers/infinito/paypal/checkoutcancel.control.php":
    mw_redirectToLogin($_SERVER["QUERY_STRING"]);
  die();

  //*Album
  case "album":
    ($logged)?
        include_once "controllers/infinito/album.control.php":
        mw_redirectToLogin($_SERVER["QUERY_STRING"]);
  die();

  //*Historial de Transacciones
  case "historial":
    ($logged)?
        include_once "controllers/infinito/paypal/historial.control.php":
        mw_redirectToLogin($_SERVER["QUERY_STRING"]);
  die();

}





addToContext("pageRequest", $pageRequest);
require_once "controllers/error.control.php";
