<?php
include "conexiones php/conexion.php";
$conexion = new conexion();
$conn = $conexion->getConexion();
$sql = $conn->query("SELECT * FROM productos");
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://kit.fontawesome.com/fbb57f44e2.js" crossorigin="anonymous"></script>
  <title>Formulario de Productos</title>
</head>

<body class="bg-body-secondary">
  <?php
  include "conexiones php/Eliminar-porducto.php";
  ?>

  </div>
  <div class="container-fluid row">
    <form class="col-10 p-3 m-auto" method="post" enctype="multipart/form-data">
      <div class="bg-dark-subtle ">
        <h3 class="text-center text-secondary mt-2 mb-5"><strong>Registro de Productos</strong></h3>
      </div>
      <?php
          include "conexiones php/Registrar-productos.php";
        ?>
      <div class="row mb-4">
        <div class="col-md-6 mb-20">
          <label for="exampleInputEmail1" class="form-label"><strong>Nombre Producto</strong></label>
          <input type="text" class="form-control" id="nombre" name="nombre">
        </div>
        <div class="col-md-6 mb-10">
          <label for="exampleInputEmail1" class="form-label"><strong>Precio del producto</strong></label>
          <input type="number" class="form-control" id="precio" name="precio" placeholder="$">
        </div>

      </div>

      <div class="row mb-4">

        <div class="col-md-6 mb-10">
          <label for="exampleInputEmail1" class="form-label"><strong>Cuantos productos?</strong></label>
          <input type="number" id="existencias" name="existencias" class="form-control">
        </div>
        <div class="col-md-6 mb-3">
          <label for="exampleInputEmail1" class="form-label"><strong>Imagen</strong></label>
          <input type="file" class="form-control" name="imagen" id="imagen" accept="image/*">
        </div>
      </div>

      <div class="row mb-4">

        <div class="col-md-6 mb-10">
          <label for="exampleInputEmail1" class="form-label"><strong>Marca</strong></label>
          <select id="marca" name="marca" class="form-select" required>
            <option selected>Seleccione Una Opción</option>
            <option value="Mary Kay">Mary Kay</option>
            
          </select>
        </div>
        <div class="col-md-6 mb-10">
          <label for="exampleInputEmail1" class="form-label"><strong>Categoría</strong></label>
          <select id="categoria" name="categoria" class="form-select" required>
            <option selected>Seleccione Una Opción</option>
            <option value="Limpiador">Limpiador</option>
            <option value="Tonicos">Tonicos</option>
            <option value="Gel humectante">Gel humectante</option>
            <option value="Bloqueador solar">Bloqueador solar</option>
            <option value="Cremas">Cremas</option>
            <option value="MkMens">MkMens</option>
          </select>
        </div>
      </div>


      <div class="row">

        <div class="col-md-6 mb-10">
          <label for="exampleInputEmail1" class="form-label"><strong>¿Visible?</strong></label>
          <select class="form-select" id="visibilidad" name="visibilidad" required>
            <option selected>Seleccione Una Opción</option>
            <option value="Si">Sí</option>
            <option value="No">No</option>
          </select>
        </div>
        <div class="col-md-6 mb-10">
          <label for="exampleInputEmail1" class="form-label"><strong>Descripción</strong></label>
          <textarea class="form-control" id="detalle" name="descripcion" rows="3"></textarea>
        </div>
      </div>

      <div class="text-center mt-5 mb-"><button type="submit" class="btn btn-primary btn-lg px-5 py-3"
          name=" btnregistrar" value="ok">Guardar
          Producto</button></div><br><br><br><br><br><br>

      <div id="message"></div>
    </form>
    <div class="bg-dark-subtle">
      <h3 class=" text-center text-secondary mt-2 mb-5"><strong>Tabla de Productos</strong></h3>
    </div>



  </div>
  <div class="col-15 p-4 ">
    <table class="table table-striped table-bordered">
      <thead class="table-info text-center">
        <tr>
          <th>ID</th>
          <th>Nombre</th>
          <th>Descripción</th>
          <th>img</th>
          <th>Precio</th>
          <th>Marca</th>
          <th>Categoría</th>
          <th>Cantidad</th>
          <th>Visibilidad</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <?php
         
    while ($datos = $sql->fetch_object()) {
  
?>
        <tr>
          <td><strong><?php echo $datos->id_producto; ?></strong></td>
          <td><?php echo $datos->nombre_producto; ?></td>
          <td><?php echo substr($datos->descripcion, 0, 20); ?></td>
          <td class="text-center"><img width="30" height="30" src="<?=$datos->imagen?>" alt=""></td>
          <td><strong><?php echo $datos->precio; ?></strong></td>
          <td><?php echo substr($datos->marca, 0, 10) ?></td>
          <td><?php echo $datos->categoria; ?></td>
          <td><strong><?php echo $datos->existencias; ?></strong> Unidades</td>
          <td><?php echo $datos->visibilidad; ?></td>
          <td class="text-center">
            <a href="vistas/Modificar-producto.php?id=<?php echo $datos->id_producto; ?>"
              class="btn btn-small btn-warning"><i class="fa-solid fa-pen-to-square"></i></a>
            <a onclick="return eliminar()" href="productos.php?id=<?=$datos->id_producto;?>&datos=<?=$datos->imagen;?>"
              class="btn btn-small btn-danger">
              <i class="fa-solid fa-trash"></i>
            </a>
          </td>
        </tr>

        <?php
    }
?>
      </tbody>
    </table>
  </div><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
  integrity="sha384-+pVoZvbOlfOSaBpuNbu4gHbyFyWVkvZfGT2rJfXM6Xf0uCZCQFaO2pbvp37WQr6q" crossorigin="anonymous"></script>

<script src="js/productos.js"></script>
<script>
function eliminar() {
  let respuesta = confirm("Estas seguro que deseas eliminar?")
  return respuesta
}
</script>


</html>