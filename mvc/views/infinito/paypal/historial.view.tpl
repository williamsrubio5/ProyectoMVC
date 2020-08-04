<section>
    <header>
        <h1 class="center">Historial de Transacciones</h1>
    </header>

    <main class="row">
        <div class="col-12 col-md-10 col-offset-1">
            <table class="full-width">
                <thead>
                    <tr class="doradito"> 
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
    .doradito {
        background-color: #c18907;
    }

    .ion-plus-circled {
        width: 50px;
        height: 50px;
        color: #fff;
    }

</style>