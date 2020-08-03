<div class="banner">
     <img src="public/img/unete.jpg" alt="">
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
          <h2>Ayuda a nuestra causa</h2>
            <span>
              ¿Quieres formar parte de nuestro proyecto que tiene como objetivo mejorar las condiciones de vida de niños y jóvenes en situación de vulnerabilidad de sus derechos mediante la implementación de procesos participativos?
           </span>
  
           <span>
              Si tu respuesta es sí, solo tienes que llenar los siguientes datos y te mantendremos al tanto de nuestras actividades 
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
                <input class="material col-s-12" type="tel" name="txttelefono" maxlength="8" id="txttelefono" placeholder="Escriba su telefono" /><br>
                <span class="error" id="txttelefonoError"></span>
              </fieldset>
              <label for="txtdireccion">Direccion</label>
                <input class="material col-s-12" type="tel" name="txtdireccion" id="txtdireccion" placeholder="Escriba su direccion (opcional)" /><br>
                <span class="error" id="txtdireccionError"></span>
              </fieldset>
              
              <div class="col-s-12"><textarea  class="col-s-12 material" placeholder="Tu mensaje (opcional)" name="" rows="5"></textarea></div>
              <fieldset>
                  <button class="primary col-s-12 col-m-4 col-3 col-offset-m-8 col-offset-9" type="submit" id="btnGuardar">Enviar</button>
                </fieldset>
            </form>
            
          </section>
          <script src="public/js/validacion.js"></script>
    </main>