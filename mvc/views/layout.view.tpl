<!DOCTYPE html>
    <html>
        <head>
            <meta charset="utf-8" />
            <title>{{page_title}}</title>
            <meta name="viewport" content="width=device-width, initial-scale=1"/>
            <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
            <link rel="stylesheet" href="//code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
            <link rel="stylesheet" href="public/css/papier.css" />
            <link rel="stylesheet" href="public/css/estilo.css" />
            <link rel="stylesheet" href="public/css/layout.css">

           <!-- <script src="public/js/jquery.min.js"></script> -->
            <script src="public/js/layout.js"></script>
            {{foreach css_ref}}
                <link rel="stylesheet" href="{{uri}}" />
            {{endfor css_ref}}
        </head>
        
          <!-- Inicia el Menu -->
          
            <header>
                  <nav>
                    <div class="dot"></div>
                    <ul>
                        <li class="active"><a href="index.php?page=home" class="{{index}}">INICIO</a></li>
                        <li><a href="index.php?page=nuestraH" class="{{index}}">NUESTRA HISTORIA</a></li>
                        <li><a href="index.php?page=donate" class="{{index}}">DONATIVOS</a></li>
                        <li><a href="index.php?page=unete" class="{{index}}">FORMA PARTE DE LA FAMILIA</a></li>
                        <li><a href="index.php?page=" class="{{index}}">APADRINA</a></li>
                        <li><a href="index.php?page=recreacion" class="{{index}}">MVC</a></li>
                        <li><a href="index.php?page=apadrinar" class="{{index}}">APADRINA</a></li>
                        <li><a href="index.php?page=login" class="{{index}}">INICIA SESSION</a></li>
                        
                        {{if cartEntries}}
                           <li> <a href="index.php?page=cartAnon" class="{{cart}}"><span class="ion-ios-cart"></span> <span id="cartcounter">{{cartEntries}}</span></a></li>
                        {{endif cartEntries}}
                    </ul>
                </nav>

            </header>
            <body>
         
           <!-- termina el Menu -->


             <!-- contenido -->

            <div class="contenido">
                {{{page_content}}}
            </div>
            <!-- contenido -->

           <!-- footer -->
           
 <footer>
       
        <div class="container-footer-all">
         
             <div class="container-body">
 
                 <div class="colum1">
                     <h1>Descripcion del proyecto</h1>
 
                     <p>Ante los altos niveles de pobreza, inseguridad  y falta de oportunidades laborales, nos encontramos en una población en alto riesgo sobre todo la niñez y la juventud, es en estos grupos poblacionales es donde se puede mejorar sus habilidades motrices y conductuales. 
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

          <!-- footer -->
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
            <!-- footer -->
        </body>
    </html>
