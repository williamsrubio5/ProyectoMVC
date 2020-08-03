<!DOCTYPE html>
    <html>
        <head>
            <meta charset="utf-8" />
            <title>ASOCIACION "PAN,TECHO Y TRABAJO"</title>
            <meta name="viewport" content="width=device-width, initial-scale=1"/>
            <link rel="stylesheet" href="//code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
            <link rel="stylesheet" href="public/css/papier.css" />
            <link rel="stylesheet" href="public/css/estilo.css" />
            <link rel="stylesheet" href="public/css/verified.css" />
            <link rel="stylesheet" href="public/css/layout.css" />
            <script src="public/js/jquery.min.js"></script>
            {{foreach css_ref}}
                <link rel="stylesheet" href="{{uri}}" />
            {{endfor css_ref}}
        </head>



        <body>
         


            <div>
                <div class="brand"></div>
                <div id="cssmenu">
                <ul>
                    {{if notifnum}}
                    <li><a href="index.php?page=notificacion">
                      <span class="ion-android-notifications">&nbsp;{{notifnum}}</span></a>
                    </li>
                    {{endif notifnum}}
                    {{foreach appmenu}}
                      <li><a href="index.php?page={{mdlprg}}">{{mdldsc}}</a></li>
                    {{endfor appmenu}}
                    <li><a href="index.php?page=logout">Cerrar Sesión</a></li>
                    <li><a href="#">administrador</a></li>
                </ul>
                </div>
                <div class="hbtn"> <div>&nbsp;</div><div>&nbsp;</div><div>&nbsp;</div></div>
            </div>




            <div class="contenido">
                {{{page_content}}}
            </div>







            <footer>
       
        <div class="container-footer-all">
         
             <div class="container-body">
 
                 <div class="colum1">
                     <h1>Descripcion del proyecto</h1>
 
                     <p>Ante los  altos niveles de pobreza, inseguridad  y falta de oportunidades laborales, nos encontramos en una población en alto riesgo sobre todo la niñez y la juventud, es en estos grupos poblacionales es donde se puede mejorar sus habilidades motrices y conductuales. 
                    </p>
 
                 </div>
 
                 <div class="colum2">
                    <h1>Redes Sociales</h1>
 
                    <div class="row">
                        <img src="public/img/facebook.png" >
                        <p><a href="https://www.facebook.com/Asociaci%C3%B3n-Pan-Techo-y-Trabajo-628759953891790/">Siguenos en Facebook</a></p>
                    </div>
                    <div class="row">
                      <img src="public/img/apadrinamineto.png" >
                      <p><a href="apadrinar.html">Apadrinamiento</a></p>
                  </div>
                      
                 </div>
                    
 
                 </div>
                <div>
                  <table class="tb">
                    <h1>Informacion Contactos</h1>
 
                    <tr>
                      <td>
                        <img src="public/img/house.png">
                        <label>Col. Miramontes, calle principal, Avenida Altiplano entre mercadito D. Paso y Típicos de la Capital.
                           Tegucigalpa</label>
                      </td>
                      <td class=>
                        <img src="public/img/smartphone.png">
                        <label>José Abel Recarte  (504)-98650486 oficina (504)-22130145 </label>
                      </td>

                      <td class=>
                        <img src="public/img/contact.png">
                         <label>asociacionpantechoy trabajo@yahoo.com</label>
                      </td>
                    </tr>
                    </table>
                </div>
             </div>
         
         </div>
         
         <div class="container-footer">
                <div class="footer">
                     <div class="copyright">
                         <p>© Derechos Reservados 2020</p>
                     </div>
                 </div>
 
             </div>
         
     </footer>




            {{foreach js_ref}}
                <script src="{{uri}}"></script>
            {{endfor js_ref}}
            <script>
              $().ready(function(e){
                $(".hbtn").click(function(e){
                  e.preventDefault();
                  e.stopPropagation();
                  $(".menu").toggleClass('open');
                  });
              });
            </script>
        </body>
    </html>
