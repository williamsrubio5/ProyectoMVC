<section class="login_body">
  <div>
  <form id="formLogin" action="index.php?page=login" method="POST">
  <div class="frontbox">
    <div class="textcontent">
          <p class="title1">NO TIENES UNA CUENTA?</p>
          <p>REGISTRATE AHORA MISMO Y SE PARTE DE LA COMUNIDAD.</p>
          <button class="btn1" >
            <a href="index.php?page=register" class="{{index}}">REGISTRATE</a>
          </button>
        </div>
  </div>

    <div class="container">
        <h1>Inicio de Sesión</h1>
        <input name="returnto" value="{{returnto}}" type="hidden" />
        <input name="tocken" value="{{tocken}}" type="hidden" />

          <input type="text" name="txtEmail" id="txtEmail" value="{{txtEmail}}" class="username" placeholder="Correo Electrónico"/>
          <input type="password" name="txtPswd" id="txtPswd" value="" class="password" placeholder="Contraseña"/>

        <div class="row">
          <button class="btn" id="btnSend"><span class="ion-log-in"></span>&nbsp;Iniciar Sesión</button>
        </div>
        {{if showerrors}}
        <div class="alert alert-danger">
          <ul style="margin-bottom:1em !important;">
            {{foreach errors}}
            <li>
              {{this}}
            </li>
            {{endfor errors}}
          </ul>
        </div>
        {{endif showerrors}}
    </div>
  </form>
  </div>
</section>

<script>
  $().ready(
    function () {
      $("#btnSend").click(function (e) {
        e.preventDefault();
        e.stopPropagation();
        $("#formLogin").submit();
      });
    }
  );
</script>

<style>
  .col-md-12 {
    background-color: #c18907;
    width:40%;
  }

  .password {
    background-color: white;
  }

  .username {
    background-color: white;
  }

 
</style>
