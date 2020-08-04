<section>
    <header>
        <h1 class="center">Productos</h1>
    </header>

    <main class="row">
        <div class="col-12 col-md-10 col-offset-1">
            <table class="full-width">
                <thead>
                    <tr class="doradito"> 
                        <th>Código</th>
                        <th>Descripción</th>
                        <th>Código Interno</th>
                        <th>Categoría</th>
                        <th>Precio</th>
                        <th class="center">Imagen</th>
                        <th>Estado</th>
                        <th> <a href="" id="botAddNew" class="btn depth-1 s-margin"><span class="ion-plus-circled"></span></a> </th>
                    </tr>
                </thead>

                <tbody class="zebra">
                    {{foreach productos}}
                    <tr>
                        <td>{{codprd}}</td>
                        <td>{{dscprd}}</td>
                        <td>{{skuprd}}</td>
                        <td>{{catprd}}</td>
                        <td>{{prcprd}}</td>

                        <td>
                            <!-- Si no hay imagen pequeña, se coloca el icono de agregar una a ese producto -->
                            {{ifnot urlthbprd}}
                                <a href="index.php?page=productoimg&codprd={{codprd}}" class="btn depth-1 s-margin"> <span class="ion-upload"></span> </a>
                            {{endifnot urlthbprd}}

                            <!-- Si ya hay una imagen pequeña para el producto, se muestra (se le da la url como source src en la img) y se le puede dar clic para modificarla -->
                            {{if urlthbprd}}
                                <a href="index.php?page=productoimg&codprd={{codprd}}" class="depth-1 s-margin"> <img src="{{urlthbprd}}" alt="{{codprd}} {{dscprd}}"/> </a>
                            {{endif urlthbprd}}
                        </td>

                        <td>{{estprd}}</td>
                        
                        <td>
                            <a href="index.php?page=producto&mode=UPD&codprd={{codprd}}" class="btn depth-1 s-margin"> <span class="ion-edit"></span> </a> <br/>
                            <a href="index.php?page=producto&mode=DSP&codprd={{codprd}}" class="btn depth-1 s-margin"> <span class="ion-eye"></span> </a> <br/>
                        </td>
                    </tr>
                    {{endfor productos}}
                </tbody>
            </table>
        </div>
    </main>
</section>

<script>
    var botAddNew = document.getElementById("botAddNew");

    botAddNew.addEventListener("click", function(e)
    {
        e.preventDefault();
        e.stopPropagation();

        window.location.assign("index.php?page=producto&mode=INS&codprd=0");
    });
</script>

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