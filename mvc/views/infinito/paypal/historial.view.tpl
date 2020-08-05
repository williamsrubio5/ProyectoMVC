<section>
    <header>
        <h1 class="center">HISTORIAL DE TRANSACCIONES</h1>
    </header>

    <main class="row">
        <div class="col-12 col-md-10 col-offset-1">
            <table class="full-width">
                <thead>
                    <tr class="verde"> 
                        <th>Factura</th>
                        <th>Fecha</th>
                        <th>Usuario</th>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Precio</th>
                        <th>Total</th>
                    </tr>
                </thead>

                <tbody class="zebra">
                    {{foreach transacciones}}
                    <tr>
                        <td>{{fctcod}}</td>
                        <td>{{Fecha}}</td>
                        <td>{{useremail}}</td>
                        <td>{{fctDsc}}</td> 
                        <td>{{fctCtd}}</td>
                        <td>{{fctPrc}}</td>
                        <td>{{fctTotal}}</td>
                    </tr>
                    {{endfor transacciones}}
                </tbody>
                
                <tfooter> 
                    <tr style="border-top:1px solid #333;">
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td class="right"><strong>Total Global</strong></td>
                        <td>{{total_global}}</td>
                    </tr>
                </tfooter>
            </table>
        </div>
    </main>
</section>

<style>
    .verde {
        background-color: #1b987d;
    }

    .ion-plus-circled {
        width: 50px;
        height: 50px;
        color: #fff;
    }

.center{
    color: rgb(147, 207, 69);
}
</style>