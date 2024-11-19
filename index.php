<?php
require 'conexiones php/conexion.php';

$db = new conexion(); 
$con = $db->getConexion();  
$sql = "SELECT id_producto, nombre_producto, precio, descripcion, imagen FROM productos WHERE visibilidad='Si'";
$resultado = $con->query($sql);   

$total = isset($_POST['total']) ? $_POST['total'] : 50.000;

   
    require_once 'vendor/autoload.php';

    use MercadoPago\MercadoPagoConfig;
    use MercadoPago\Client\Preference\PreferenceClient;
    use MercadoPago\Exceptions\MPApiException;
    
    MercadoPagoConfig::setAccessToken("TEST-7131873344030437-022312-ca37222b5371fb05b51c0aa6adfdba71-752439296");
    
    $client = new PreferenceClient();
    $preference = $client->create([
      "items"=> array(
        array(
          "title" => "Mi producto",
          "quantity" => 1,
          "unit_price" => 20000
        )
      )
    ]);
    
    ?>





<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;700&display=swap" rel="stylesheet" />
  <!-- en caso de emergencia comentariar la linea siguiente -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  <script src="https://sdk.mercadopago.com/js/v2"></script>
  <link rel="stylesheet" href="css/style.css" />
  <title>Tienda de Maquillaje</title>
</head>

<body>
  <header class="header">
    <section class="container">
      <div class="logo">
        <a href="index.php"> <img src="img/logos/logo-proyecto-removebg-preview.png" alt="Imagen" /></a>
      </div>
      <!-- input de busqueda  -->
      <!-- <aside class="barra-busqueda">
        <input type="text" placeholder="Buscar" />
        <input class="" type="submit" value="Buscar" />
      </aside> -->
      <nav class="menu">
        <a href="#inicio">Inicio</a>
        <a href="#productos">Productos</a>
        <a href="#contacto">Contacto</a>
        <div class="container-icon">
          <div class="container-cart-icon">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
              stroke="currentColor" class="icon-cart">
              <path stroke-linecap="round" stroke-linejoin="round"
                d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
            </svg>
            <div class="count-products">
              <span id="contador-productos">0</span>
            </div>
          </div>

          <div class="container-cart-products hidden-cart">
            <div class="row-product hidden">
              <div class="cart-product">
                <div class="info-cart-product">
                  <span class="cantidad-producto-carrito">1</span>
                  <p class="titulo-producto-carrito">Base</p>
                  <span class="precio-producto-carrito">$140.000</span>

                </div>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                  stroke="currentColor" class="icon-close">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
              </div>
            </div>

            <div class="cart-total hidden">
              <h3>Total:</h3>
              <span class="total-pagar">$200.000</span>
              <div id="wallet_container"></div>

            </div>
            <p class="cart-empty">El carrito está vacío</p>
            <div class="row-product"></div>
          </div>
      </nav>
      <div class="container-user-actions">
        <img src="img/logos/5550463.png" alt="User Actions" id="userActionsToggle">
        <div class="user-actions hidden-user-actions">
          <a href="iniciosesion.php" class="btn">Iniciar Sesión</a>
          <br>
          <br>
          <a href="registrarse.php" class="btn">Registrarse</a>
        </div>
      </div>
    </section>
  </header>

  <section id="inicio" class="home">
    <article class="hero-image" style="--hero-image: url('/img/logos/home.jpg'); --hero-attachment: fixed">
      <aside class="hero-image-opacity" style="--hero-opacity-color: var(--black-alpha-color)">
        <div class="hero-image-content">
          <h2 class="hero-image-title" style="--hero-text-color: var(--white-color)">
            Bienvenidas <br />
            Encanto Cosmético
          </h2>
        </div>
      </aside>
    </article>
  </section>
  <br>

  <h2 class="section-title">Productos</h2>
  <div class="filtros-container">
    <div class="filtro">
      <label for="marca">Marca:</label>
      <select id="marca" name="marca" class="form-select" required>
        <option selected>Seleccione Una Opción</option>
        <option value="Todos">Todos</option>
        <option value="Mary Kay"> MARY KAY </option>
      </select>
    </div>
    <div class="filtro2">
      <label for="Categoria">Categoria:</label>
      <select id="Categoria" name="Categoria" class="form-select" required>
        <option selected>Seleccione Una Opción</option>
        <option value="Todos">Todos</option>
        <option value="Limpiador">Limpiador</option>
        <option value="Tonicos">Tonicos</option>
        <option value="Gel humectante">Gel humectante</option>
        <option value="Bloqueador solar">Bloqueador solar</option>
        <option value="Cremas">Cremas</option>
        <option value="MkMens">MkMens</option>
      </select>
    </div>
  </div>

  <br><br><br><br><br>

  <section id="productos" class="producto section">
    <div class="container">

      <?php foreach($resultado as $row) { ?>
      <div class="ejemplo">
        <a href="#trabajo-<?php echo $row['id_producto']; ?>" class="producto-card">
          <img src="<?php echo $row['imagen']; ?>" alt="Trabajo 1" />
        </a>
        <aside class="cont-info-descripcion">
          <h3 class="nombre-producto"><?php echo $row['nombre_producto']; ?></h3>
          <aside class="price">$ <?php echo $row['precio']; ?></aside>
        </aside>
      </div>
      <?php } ?>
    </div>
  </section>

  <?php foreach($resultado as $row) { ?>
  <article id="trabajo-<?php echo $row['id_producto']; ?>" class="modal">
    <div class="modal-content">
      <a href="#cerrar" class="modal-close">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
          <path
            d="M12,2C6.486,2,2,6.486,2,12s4.486,10,10,10s10-4.486,10-10S17.514,2,12,2z M16.207,14.793l-1.414,1.414L12,13.414 l-2.793,2.793l-1.414-1.414L10.586,12L7.793,9.207l1.414-1.414L12,10.586l2.793-2.793l1.414,1.414L13.414,12L16.207,14.793z" />
        </svg>
      </a>

      <article class="producto-modal">
        <img src="<?php echo $row['imagen']; ?>" alt=" " />
        <div class="cont-info-descripcion">
          <h3><?php echo $row['nombre_producto']; ?></h3>
          <p>
            <?php echo $row['descripcion']; ?>
          </p>
          <p class="price">$<?php echo $row['precio']; ?></p>

          <div class="btn-modal">
            <a href="#cerrar" class="btn">Añadir carrito</a>
            <span class="vtex-product-price-1-x-currencyCode vtex-product-price-1-x-currencyCode--summary"></span>
          </div>
        </div>
      </article>
    </div>
  </article>
  <?php } ?>


  <br><br><br><br><br><br><br><br><br><br>
  <div class="Campaña">
    Campaña: Enero - Marzo 2024 MARY KAY
  </div><br>
  <footer id="contacto">
    <div class="footer-left">
      <p>Diva Beauty</p>
      <p>El sistema web Diva Beauty es una innovación donde las personas pueden hacer sus compras de manera más rápida,
        segura y fácil. Estamos a disposición del cliente para cumplir con sus pedidos y estamos dispuestos a seguir
        mejorando para mejorar la experiencia de compra de nuestros clientes. Nuestro objetivo es proporcionar un
        servicio excepcional y garantizar la satisfacción de quienes confían en nosotros para sus necesidades de belleza
        y cuidado personal.</p>
    </div>
    <div class="footer-center">
      <p>Redes Sociales</p>
      <a href="" target="_blank"><img src="img/logos/Facebook.png" alt="Facebook"></a>
      <a href="" target="_blank"><img src="img/logos/WhatsApp (1).png" alt="WhatsApp"></a>
      <a href="" target="_blank"><img src="img/logos/Instagram.png" alt="Instagram"></a>
    </div>

    <div class="footer-right">
      <p>Información de contacto</p>
      <div class="footer-contact">
        <img src="img/logos/ubicacion.png" alt="Agregar Ubicación">
        <p></p>
      </div>
      <div class="footer-contact">
        <img src="img/logos/correo2.png" alt="Correo">
        <p></p>
      </div>
      <div class="footer-contact">
        <img src="img/logos/telefono.png" alt="Teléfono">
        <p></p>
      </div>
    </div>
  </footer>

  <footer class="small-footer">
    <div class="small-footer-left">
      <p>© 2024 Todos los derechos reservados | ADSO</p>
    </div>
    <div class="small-footer-right">
      <p>Información | <a href="#">Privacidad y política</a> | <a href="#">Términos y condiciones</a></p>
    </div>
  </footer>

  <!-- este es el script qie procesa la solicitud ajax  -->
  <script>
  $(document).ready(function() {
    $('#marca, #Categoria').change(function() {
      var marca = $('#marca').val();
      var categoria = $('#Categoria').val();

      $.ajax({
        type: 'POST',
        url: 'conexiones php/filtro-productos.php', // url del archivo qiue procesara la solicitud
        data: {
          marca: marca,
          categoria: categoria
        },
        success: function(response) {
          $('#productos').html(response);
        }
      });
    });
  });
  </script>


  <script>
  const mp = new MercadoPago('TEST-4443a3c4-029d-4d71-aa91-d86649dc763d');
  const bricksBuilder = mp.bricks();

  mp.bricks().create("wallet", "wallet_container", {
    initialization: {
      preferenceId: "<?php echo $preference->id; ?>",
    },
    customization: {
      texts: {
        valueProp: 'smart_option',
      },
    },
  });
  </script>


  <script src="js/index.js"></script>
</body>

</html>