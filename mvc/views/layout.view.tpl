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
            <script src="public/js/jquery.min.js"></script>
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
                        <li class="active"><a href="index.php?page=index" class="{{index}}">INICIO</a></li>
                        <li><a href="index.php?page=index" class="{{index}}">NUESTRA HISTORIA</a></li>
                        <li><a href="index.php?page=index" class="{{index}}">FORMA PARTE DE LA FAMILIA</a></li>
                        <li><a href="index.php?page=index" class="{{index}}">APADRINA</a></li>
                        <li><a href="index.php?page=index" class="{{index}}">MVC</a></li>
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
