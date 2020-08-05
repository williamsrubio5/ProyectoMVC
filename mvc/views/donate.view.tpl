
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


<!-- Por cada producto se mostrara una cartita en el inicio de la pagina -->
<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
<section class="sec_galeria">
  <h2>¡Aporta tu granito de arena !</h2>
</section>

<section class="infod">
  <p>Al comprar un producto estaras ayudando para la educacion de cada niño</p>
  <p id="p2"> Puedes elegir apadrinar a un niño y el monto que dones sera para apoyar el futuro de nuestros chicos </p>
</section>


<section class="cont1">
<section class="row"> 
  <section class="textobasico">
    <h3><b class="tt" >PRODUCTOS</b></h3> 
  </section>
  {{foreach varios}}
    <section class="col-sm-6 col-md-3 m-padding">
      <div class="card col-13 depth-2 m-padding">

        <span class="col-sm-12 center depth-1">
          <!-- Si existe imagen pequeña la muestra -->
          {{if urlthbprd}}
            <img src="public/produc/prd.png" alt="{{codprd}} {{dscprd}}" class="imgthumb center"/>
          {{endif urlthbprd}}
        </span>


        <!-- Mostrando codigo interno y descripcion del producto -->
        <span class="col-112 col-12 center depth-1 m-padding card-desc">
          <span class="card-side">{{skuprd}}</span>
          <span class="col-12">{{dscprd}}</span>
        </span>

          <!-- Boton para añadir a la carretilla -->
          <span class="col-12 bold center m-padding">
            <a href="index.php?page=addToCart&codprd={{codprd}}" class="l-padding btn btn-primary col-12 sendToCart"> L {{prcprd}}</a>
          </span>
        </span>

      </div>
    </section>
  {{endfor varios}} 
</section>
</br>
</br>
</section>


<section class="cont1">
<section class="row">
        <section class="textobasico">
          <h3><b class="tt">APADRINAMIENTO DE NIÑOS</b>
          </h3>
        </section>
  {{foreach apadrinar}}
  <section class="col-sm-6 col-md-3 m-padding">
    <div class="card col-13 depth-2 m-padding">

      <span class="col-sm-12 center depth-1">
        <!-- Si existe imagen pequeña la muestra -->
        {{if urlthbprd}}
        <img src="public/produc/apd.png" alt="{{codprd}} {{dscprd}}" class="imgthumb center" />
        {{endif urlthbprd}}
      </span>


      <!-- Mostrando codigo interno y descripcion del producto -->
      <span class="col-112 col-12 center depth-1 m-padding card-desc">
        <span class="card-side">{{skuprd}}</span>
        <span class="col-12">{{dscprd}}</span>
      </span>

      <!-- Boton para añadir a la carretilla -->
      <span class="col-12 bold center m-padding">
        <a href="index.php?page=addToCart&codprd={{codprd}}" class="l-padding btn btn-primary col-12 sendToCart"> L
          {{prcprd}}</a>
      </span>
      </span>

    </div>
  </section>
  {{endfor apadrinar}}
</section>
</br>
</section>


<section class="cont1">
<section class="row">
      <section class="textobasico">
        <h3><b class="tt">DONACION</b></h3>
      </section>
  {{foreach donacion}}
  <section class="col-sm-6 col-md-3 m-padding">
    <div class="card col-13 depth-2 m-padding">

      <span class="col-sm-12 center depth-1">
        <!-- Si existe imagen pequeña la muestra -->
        {{if urlthbprd}}
        <img src="public/produc/dnt.png" alt="{{codprd}} {{dscprd}}" class="imgthumb center" height="100px" width="100px"/>
        {{endif urlthbprd}}
      </span>


      <!-- Mostrando codigo interno y descripcion del producto -->
      <span class="col-112 col-12 center depth-1 m-padding card-desc">
        <span class="card-side">{{skuprd}}</span>
        <span class="col-12">{{dscprd}}</span>
      </span>

      <!-- Boton para añadir a la carretilla -->
      <span class="col-12 bold center m-padding">
        <a href="index.php?page=addToCart&codprd={{codprd}}" class="l-padding btn btn-primary col-12 sendToCart"> L
          {{prcprd}}</a>
      </span>
      </span>

    </div>
  </section>
  {{endfor donacion}}
</section>
</section>
<script>

  /* Ruta que devuelva un archivo JSON al dar clic en sendToCart.
     Se manda por post el hipervinculo y en console sale lo que devuelve.
  */

  $().ready(function()
  {
    $(".sendToCart").click(function(e)
    {
      e.preventDefault();
      e.stopPropagation();

      $.post(
        $(this).attr("href"),
        function(data, success, xqXML)
        {
          console.log(data);

          /* Si cartAmount existe y es mayor que 0 */
          if(data.cartAmount && data.cartAmount > 0)
          {
            window.location.reload();
          }
        }
      )
    });

  });

</script>

<style>
  .sec_galeria h2{
  text-align: center;
  font-size: 1.7rem;
	margin: 1em 1em;
	padding: 8px;
	background-color: #FFC300;
	box-shadow: -5px 5px 1px #1b987d;
  border-radius: 60%;
}

.tt{
text-align: center;
  font-size: 1.7rem;
	margin: 1em 1em;
	padding: 40px;
	background-color: #FFC300;
  width: 400px;

}

.cont1{
height: 450px;
background-color: #1b987d;
box-shadow: -5px 5px 1px #ecf1f0;
margin-bottom: 80px;
}

.infod{
	max-width: 1280px; /*1350*/
	margin: 0px auto;
}

  .infod p{
    padding-top: 1rem;
    padding-bottom: 1rem;
    font-size: 1.5rem; 
  }

  .infod p#p2{
    padding-top: 0rem;
    margin-bottom: 1.5rem;
  }

  .textobasico{
    font-size: 0.9rem;
  }

  .card{
    position: relative;
  }

  .card-desc{
    height: 4em;
    overflow: hidden; /*scroll*/
  }

  .card-side{
      position: absolute;
      top:6em;
      left:1em;
      transform-origin: left top;
      transform: rotate(-90deg);
  }

  .l-padding{
    background-color: #E7D1BC;
    color: black;
  }

  .col-13{
    background-color: #c18907;
  }

  .l-padding:hover{
    background-color: white;
    color: gold;
  }

  .col-sm-12{
    background-color: white;
  }

  .col-112{
    background-color: white;
  }

  .sendToCart{
    text-decoration: none;
  }


</style>


