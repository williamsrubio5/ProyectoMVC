<section>
    <header>
        <h1>{{modedsc}}</h1>
    </header>

    <br/>

    <main class="row">
        <form action="index.php?page=producto&mode={{mode}}&codprd={{codprd}}" method="POST"  class="col-12 col-md-8 col-offset-2 formMan">
            <input type="hidden" name="codprd" value="{{codprd}}"/>
            <input type="hidden" name="mode" value="{{mode}}"/>
            <input type="hidden" name="token" value="{{token}}"/>

            <fieldset>
                <label class="col-12 col-sm-4 col-md-3">Código: &nbsp;</label>
                <input type="text" name="dummy" value="{{codprd}}" placeholder="Código" disabled readonly/>
            </fieldset>

            <fieldset>
                <label class="col-12 col-sm-4 col-md-3">Código Interno: &nbsp;</label>
                <input type="text" name="skuprd" value="{{skuprd}}" maxlength=128 placeholder="SKU" {{if isReadOnly}} disabled readonly {{endif isReadOnly}} />
            </fieldset>

            <fieldset>
                <label class="col-12 col-sm-4 col-md-3">Categoría: &nbsp;</label>
                <select name="catprd" {{if isReadOnly}} disabled readonly {{endif isReadOnly}}>
                    <option value="VRS" {{catLBATrue}}>Varios</option>
                    <option value="REM" {{catREMTrue}}>Donacion</option>
                    <option value="ESC" {{catESCTrue}}>Apadrinar niños para Escuelas</option>
                </select>
            </fieldset>

            <fieldset>
                <label class="col-12 col-sm-4 col-md-3">Descripción Comercial: &nbsp;</label>
                <input type="text" name="dscprd" value="{{dscprd}}" maxlength="70" placeholder="Descripción Comercial" {{if isReadOnly}} disabled readonly {{endif isReadOnly}}/>
            </fieldset>

            <fieldset>
                <label class="col-12 col-sm-4 col-md-3">Descripción Corta: &nbsp;</label>
                <textarea name="sdscprd" maxlength="255" placeholder="Descripción Corta" class="col-12 col-sm-8 col-md-9" {{if isReadOnly}} disabled readonly {{endif isReadOnly}}>{{sdscprd}}</textarea>
            </fieldset>

            <fieldset>
                <label class="col-12 col-sm-4 col-md-3">Descripción Larga: &nbsp;</label>
                <textarea name="ldscprd" maxlength="2048" rows="10" placeholder="Descripción Larga" class="col-12 col-sm-8 col-md-9" {{if isReadOnly}} disabled readonly {{endif isReadOnly}}>{{ldscprd}}</textarea>
            </fieldset>

            <fieldset>
                <label class="col-12 col-sm-4 col-md-3">Precio: &nbsp;</label>
                <input type="text" name="prcprd" value="{{prcprd}}" maxlength="15" placeholder="Precio de Venta" {{if isReadOnly}} disabled readonly {{endif isReadOnly}}/>
            </fieldset>

            <fieldset>
                <label class="col-12 col-sm-4 col-md-3">URL imagen: &nbsp;</label>
                <input type="text" name="urlprd" value="{{urlprd}}" maxlength="255" placeholder="Imagen de Portada" disabled readonly/>
            </fieldset>

            <fieldset>
                <label class="col-12 col-sm-4 col-md-3">URL imagen pequeña: &nbsp;</label>
                <input type="text" name="urlthbprd" value="{{urlthbprd}}" maxlength="255" placeholder="Imagen Catálogo" disabled readonly/>
            </fieldset>
            
            <fieldset>
                <label class="col-12 col-sm-4 col-md-3">Estado: &nbsp;</label>
                <select name="estprd" {{if isReadOnly}} disabled readonly {{endif isReadOnly}}>
                    <option value="ACT" {{estACTTrue}}>Activo</option>
                    <option value="INA" {{estINATrue}}>Inactivo</option>
                    <option value="PLN" {{estPLNTrue}}>Planificación</option>
                    <option value="RET" {{estRETTrue}}>Retirado</option>
                    <option value="DSC" {{estDSCTrue}}>Descontinuado</option>
                </select>
            </fieldset>

            <fieldset class="right">
                {{if hasAction}} <button type="submit" name="botGuardar" class="m-padding btn-primary">Guardar</button> &nbsp; {{endif hasAction}}
                <button type="submit" id="botCancelar" class="m-padding">Cancelar</button>
            </fieldset>
        </form>
    </main>
</section>

<script>
    var botCancelar = document.getElementById("botCancelar");

    botCancelar.addEventListener("click", function(e)
    {
        e.preventDefault();
        e.stopPropagation();

        window.location.assign("index.php?page=productos");
    });
</script>

<style>
    .formMan{
        box-shadow: 3px 5px 7px #777;
    }

    .btn-primary{
        background-color: rgb(34, 34, 148);
    }
</style>