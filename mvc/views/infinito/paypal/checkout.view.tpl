<section>

  <header>
      <h1 class="center"><span class="ion-card s2"></span>&nbsp; Pago con Paypal</h1>
  </header>

  <br/>
  <section class="row">
    <section class="col-12 col-md-8 col-offset-2">
      <table class="full-width">
        <thead>
          <tr class="doradito">
            <th>Linea</th>
            <th>SKU</th>
            <th>Producto</th>
            <th>Cantidad</th>
            <th>Precio Unitario</th>
            <th>Total</th>
            <th>&nbsp;</th>
          </tr>
        </thead>

        <tbody class="zebra">
          {{foreach products}}
            <tr>
                <td>{{line}}</td>
                <td>{{skuprd}}</td>
                <td>{{dscprd}}</td>
                <td class="right">{{crrctd}}</td>
                <td class="right">{{crrprc}}</td>
                <td class="right">{{total}}</td>
                <!-- Botones para remover una unidad de un producto o añadir una mas -->
                <td class="center">
                    <a href="index.php?page=rmvToCart&codprd={{codprd}}" class="btn s-padding mdftocart"><span class="iconify" data-icon="el:minus" data-inline="false"></span></a>
                    &nbsp;
                    <a href="index.php?page=addToCart&codprd={{codprd}}" class="btn s-padding mdftocart"><span class="iconify" data-icon="el:plus" data-inline="false"></span></a>
                </td>
            </tr>
          {{endfor products}}
        </tbody>

        <tfooter>
          <tr style="border-top:1px solid #333;">
            <!-- Si hay productos en la carretilla que muestre un boton que redirige al controlador para borrarla toda -->
            <td colspan="2" class="center">
              {{if totctd}}
                <a class="btn m-padding bg-red center rmvcart" href="index.php?page=rmvAllCart"> <span class="ion-trash-b s4"></span> &nbsp;Cancelar </a>
              {{endif totctd}}
            </td>
            <td class="right"><strong>Total</strong></td>
            <td class="right">{{totctd}}</td>
            <td></td>
            <td class="right">{{total}}</td>
            <td class="pay">
                <!-- Form con boton para Realizar el Pago con Paypal. SOLO APARECE CUANDO HAY PRODUCTOS EN LA CARRETILLA -->
                {{if totctd}}
                <form action="index.php?page=checkout" method="post">
                  <button type="submit" name="btnSubmit" class="btn btn-primary m-padding bg-blue"><span class="iconify" data-icon="icomoon-free:paypal" data-inline="false"></span>&nbsp;Pagar con Paypal</button>
                </form>
                {{endif totctd}} 
            </td>
          </tr>
        </tfooter>
      </table>
    </section>
  </section>

</section>

<!-- Cada vez que se da click a Remover o Añadir una unidad mas a un producto o a remover todo el carrito -->
<script>
  $().ready(function () 
  {
    $(".mdftocart, .rmvcart").click(function (e)
    {
      e.preventDefault();
      e.stopPropagation();
      
      $.post(
        $(this).attr("href"),
        function (data, success, xqXML) {
          if (data.cartAmount && data.cartAmount > 0) 
          {
            window.location.reload();
          }
        }
      );
    });
  });
</script>

<style>
    .bg-blue {
        background-color: #1e477a;
        justify-content: center;
        text-decoration: none;
    }

    .bg-red {
        text-decoration: none;
    }

    .pay {

        text-align: center;
    }

    .ion-minus-circled {
        width: 50px;
        height: 50px;
    }

    .ion-plus-circled {
        width: 50px;
        height: 50px;
    }

    .doradito {
        background-color: #c18907;
    }
</style>