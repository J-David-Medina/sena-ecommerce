<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/style-iniciosesion.css" />
  <title>Inicio de Sesión</title>
</head>

<body>
  <div class="login-wrapper">
    <a href="index.php" class="back-btn">Regresar</a>
    <div class="logo">
      <img src="img/logos/5550463.png" alt="">
    </div>
    <br>
    <div class="login-heading">
      Inicio de sesión
    </div>
    <br>
    <form class="login-form" id="loginForm" method="post">
      <div class="input-field">
        <span class="user-icon"></span>
        <input type="text" name="userName" id="userName" placeholder="Usuario o correo electrónico" required>
      </div>
      <div class="input-field">
        <input type="password" name="password" id="password" placeholder="Contraseña" required />
        <img id="eyeicon" class="img-contra" src="img/logos/ojonoseve.png" alt="" />
      </div>
      <button class="login-btn">Iniciar sesión</button>
    </form>
    <br>
    <div class="register">
      <h1>¿No tiene cuenta? </h1> <a href="registrarse.php">Regístrese aquí</a>
    </div>
    <br>
    <!-- mensaje recibido por el script. -->
    <div id="message"></div>
  </div>



  </script>
  <!-- script del ojito -->
  <script>
  const eyeicon = document.getElementById("eyeicon");
  const password = document.getElementById("password");

  eyeicon.onclick = function() {
    if (password.type == "password") {
      password.type = "text";
      eyeicon.src = "img/logos/ojonoseve.png";
    } else {
      password.type = "password";
      eyeicon.src = "img/logos/ojoseve.png";
    }
  };
  </script>

  <!-- script que muestra el restado de la base de datos en la misma pagina -->
  <script>
  document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('.login-form');
    const messageContainer = document.getElementById('message');

    form.addEventListener('submit', async function(event) {
      event.preventDefault();

      const formData = new FormData(form);

      try {
        const response = await fetch('conexiones php/conexion-iniciosesion.php', {
          method: 'POST',
          body: formData,
          headers: {
            'X-Requested-With': 'XMLHttpRequest'
          }
        });
        if (response.ok) {
          const data = await response.json();
          if (data.status === 'success') {
            if (data.redirect) {
              window.location.href = data.redirect;
            } else {
              window.location.href = 'index.php';
            }
          } else {
            messageContainer.innerHTML = `<p class="error-message">${data.message}</p>`;
          }
        } else {
          throw new Error('Network response was not ok.');
        }
      } catch (error) {
        console.error('Error fetching data:', error);
      }
    });
  });
  </script>


</body>

</html>