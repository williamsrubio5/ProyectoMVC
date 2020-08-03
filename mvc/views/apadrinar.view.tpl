<body>
   
    <script src="https://kit.fontawesome.com/a27d97ec24.js" crossorigin="anonymous"></script>

    <div class="banner">
     <img src="public/img/pago.jpg" alt="">
      <div class="contenedor">
        <h2 class="banner__titulo">"si pones una mano en la obra se ejecuta, si pones las dos se acelera..."</h2>
      </div>
    </div>
    <main class="main">
      <div class="contenedor">
        <section class="rows">
          <div class="inicio2">
          </div>
          <div class="cuadro">
          <h2>Plan de Apadrinamiento</h2>
            <span>
              ¿Quieres apoyarnos mediante apadrinamiento? Puedes apoyar mediante donativos mensuales a nuestros niños. 
           </span>
  
           <span>
              Si tu respuesta es sí, solo tienes que llenar los siguientes datos y comenzaras a apoyar mensualmente a nuestros jovenes 
           </span>
          </div>
  
          <form id="formToValidate" method="post" action="unete.html" class="col-s-12 col-6 col-offset-3">
              <fieldset class="rows">
                <label for="txtNombre">Nombre Completo</label>
                <input class="material col-s-12" type="text" name="txtNombre" id="txtNombre"
                  placeholder="Escriba su Nombre Completo"
                />
                
                <span class="error" id="txtNombreError"></span>
              </fieldset>

              <fieldset>
                <label for="txtCorreo">Correo Electrónico</label>
                <input class="material col-s-12" type="email" name="txtCorreo" id="txtCorreo" placeholder="Escriba su Correo Electrónico" /><br>
                <span class="error"  id="txtCorreoError"></span>
              </fieldset>

              <fieldset>
                <label for="txttelefono">Telefono</label>
                <input class="material col-s-12" type="tel"  maxlength="8" name="txttelefono" id="txttelefono" placeholder="Escriba su telefono" /><br>
                <span class="error" id="txttelefonoError"></span>
              </fieldset>

              <fieldset>
              <label for="txtdireccion">Direccion</label>
                <input class="material col-s-12" type="tel" name="txtdireccion" id="txtdireccion" placeholder="Escriba su direccion (opcional)" /><br>
                <span class="error" id="txtdireccionError"></span>
              </fieldset>

              <br>
        <fieldset>
        <select id="cmbDepartamento" name="cmbDepartamento" id="cmbDepartamento">
          <option value="01" selected>Seleccione Plan</option>
          <option value="02">1 lp diario = 30 lps al mes</option>
          <option value="03">50 lps Mensuales</option>
          <option value="04">100 lps Mensuales</option>
          <option value="05">200 lps Mensuales</option>
          <option value="06">500 lps Mensuales</option>
          <option value="07">1000 lps Mensuales</option>

          
          
  </select>
        </fieldset>
        <br>

              <fieldset>
                <label for="txttarjeta">Tarjeta</label>
                <input class="material col-s-12" type="tel"  maxlength="16" name="txttarjeta" id="txttarjeta" placeholder="1234-5678-9012-3456" /><br>
                <span class="error" id="txttarjetaError"></span>
              </fieldset>



            
        <fieldset>
            <label for="txtcvv">Numero Secreto</label>
                <input class="material col-s-12" type="tel" maxlength="3" name="txtcvv" id="txtcvv" placeholder="CVV" /><br>
                <span class="error" id="txtcvvError"></span>
        </fieldset>


        <br>
        <fieldset>
        <select id="cmbDepartamento" name="cmbDepartamento" id="cmbDepartamento">
          <option value="01" selected>Seleccione Mes de Vencimiento</option>
          <option value="02">Enero</option>
          <option value="03">Febrero</option>
          <option value="04">Marzo</option>
          <option value="05">Abril</option>
          <option value="06">Mayo</option>
          <option value="07">Junio</option>
          <option value="08">Julio</option>
          <option value="09">Agosto</option>
          <option value="10">Septiembre </option>
          <option value="11">Octubre</option>
          <option value="12">Noviembre</option>
          <option value="13">Diciembre</option>

          
          
  </select>
        </fieldset>
  <br>
  <br>
  <fieldset>
  <select id="cmbDepartamento" name="cmbDepartamento" id="cmbDepartamento">
    <option value="01" selected>Seleccione año Vencimiento</option>
    <option value="02">2020</option>
    <option value="03">2021</option>
    <option value="04">2022</option>
    <option value="05">2023</option>
    <option value="06">2024</option>
    <option value="07">2025</option>
    <option value="08">2026</option>
    <option value="09">2027</option>
    <option value="10">2028 </option>
    <option value="11">2029</option>
    <option value="12">2030</option>
    

    
    
</select>
</fieldset>
<br>


    </fieldset>
              
              <fieldset>
                  <button class="primary col-s-12 col-m-4 col-3 col-offset-m-8 col-offset-9" type="submit" id="btnGuardar">Enviar</button>
                </fieldset>
            </form>
            
          </section>
          <script src="public/js/validate2.js"></script>
    </main>