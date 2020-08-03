<?php
/* Home Controller
 * 2014-10-14
 * Created By OJBA
 * Last Modification 2014-10-14 20:04
 */

  function run(){
    addCssRef("public/css/unete.css");
    addCssRef("public/css/forms.css");
    addCssRef("public/css/contruccion.css");

    renderizar("proyectos",Array());
  }
  run();
?>