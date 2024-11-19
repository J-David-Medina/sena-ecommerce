<!DOCTYPE html>
<html lang="en">


<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/style-registrarse.css" />
  <title>Registro</title>
</head>


<body>
  <div class="login-wrapper">
    <a href="index.php" class="back-btn">Regresar</a>
    <div class="logo">
      <img src="img/logos/5550463.png" alt="">
    </div>
    <br>
    <div class="login-heading">
      Registrate
    </div>
    <br>
    <form class="login-form" id="loginForm" method="post">
      <div class="input-field">
        <span class="user-icon"></span>
        <input type="text" name="userName" id="userName" placeholder="Nombre de usuario" required>
      </div>
      <div class="input-field">
        <span class="user-icon"></span>
        <input type="email" name="email" id="email" placeholder="Correo electrónico" required>
      </div>
      <div class="input-field">
        <span class="user-icon"></span>
        <input type="tel" name="phone" id="phone" placeholder="Teléfono" required>
      </div>
      <div class="input-field">
        <input type="password" name="password" id="password" placeholder="Contraseña" required />
        <img id="eyeicon1" class="img-contra" src="img/logos/ojonoseve.png" alt="" onclick="ver()" />
      </div>
      <div class="input-field">
        <input type="password" name="confirmPassword" id="confirmPwd" placeholder="Confirmar contraseña" required />
      </div>
      <button class="login-btn " style="border:none;">Registrarse</button>
    </form>
    <br>
    <div class="register">
      <h1>¿Ya tienes una cuenta? </h1> <a href="iniciosesion.php">Inicie sesión aquí</a>
    </div>
    <br>
    <!-- mensaje recibido por el script. -->
    <div id="message"></div>
  </div>

  <!-- script del ojito -->
  <script>
  function Verpassword(inputId, eyeIconId) {
    const eyeIcon = document.getElementById(eyeIconId);
    const password = document.getElementById(inputId);

    if (password.type === "password") {
      password.type = "text";
      eyeIcon.src = "img/logos/ojoseve.png";
    } else {
      password.type = "password";
      eyeIcon.src = "img/logos/ojonoseve.png";
    }
  }

  function ver() {
    Verpassword("password", "eyeicon1");
    Verpassword("confirmPwd", "eyeicon2");
  }
  </script>

  <!-- Script para recibir los mensajes en la misma pagina -->
  <script>
  document.addEventListener('DOMContentLoaded', function() {
    var form = document.querySelector('.login-form');
    var messageContainer = document.getElementById('message');

    form.addEventListener('submit', function(event) {
      event.preventDefault();

      var formData = new FormData(form);

      var xhr = new XMLHttpRequest();
      xhr.open('POST', 'conexiones php/conexion-registro.php', true);
      xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
      xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
          var response = JSON.parse(xhr.responseText);
          if (response.status === 'success') {
            messageContainer.innerHTML = '<p class="success-message">' + response.message + '</p>';
            form.reset();
          } else {
            messageContainer.innerHTML = '<p class="error-message">' + response.message + '</p>';
          }
        }
      };
      xhr.send(formData);
    });
  });
  </script>
</body>

</html>