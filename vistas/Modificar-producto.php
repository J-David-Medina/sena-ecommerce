<?php
include "../conexiones php/conexion.php";

$id= $_GET["id"];
$sql = $conn->query("SELECT * FROM productos WHERE id_producto = $id");


?>

<!DOCTYPE html>

<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://kit.fontawesome.com/fbb57f44e2.js" crossorigin="anonymous"></script>
  <title>Modificar Productos</title>
</head>

<body class="bg-body-secondary">
  <div class="container-fluid row">
    <form class="col-10 p-3 m-auto" method="POST">

      <h3 class=" text-center  bg-success-subtle  mt-3 mb-3">Modificar Productos</h3>


      <input type="hidden" name="id" value="<?= $_GET["id"]?>">
      <?php

      
include "../conexiones php/modificar-producto.php";

while ($datos = $sql->fetch_object()) {
?>
      <div class="row">
        <div class="col-md-6 mb-10">
          <label for="exampleInputEmail1" class="form-label"><strong>Nombre Producto</strong></label>
          <input type="text" class="form-control" id="nombre" name="nombre" value="<?= $datos->nombre_producto ?>">
        </div>
        <div class="col-md-6 mb-3">
          <label for="exampleInputEmail1" class="form-label"><strong>Precio del producto</strong></label>
          <input type="number" class="form-control" id="precio" name="precio" placeholder="$"
            value="<?= $datos->precio ?>">
        </div>
      </div>

      <div class="row">

        <div class="col-md-6 mb-3">
          <label for="exampleInputEmail1" class="form-label"><strong>Cuantos productos?</strong></label>
          <input type="number" id="existencias" name="existencias" class="form-control"
            value="<?= $datos->existencias ?>">
        </div>
        <div class="col-md-6 mb-3">
          <label for="exampleInputEmail1" class="form-label"><strong>¿Visible?</strong></label>
          <select class="form-select" id="visibilidad" name="visibilidad" required>
            <option value="" disabled>Seleccione Una Opción</option>
            <option value="Si" <?php if ($datos->visibilidad === 'Si') echo 'selected'; ?>>Sí</option>
            <option value="No" <?php if ($datos->visibilidad === 'No') echo 'selected'; ?>>No</option>
          </select>
        </div>
      </div>

      <div class="row">

        <div class="col-md-6 mb-3">
          <label for="exampleInputEmail1" class="form-label"><strong>Marca</strong></label>
          <select id="marca" name="marca" class="form-select" required>
            <option value="" disabled>Seleccione Una Opción</option>
            <option value="Mary Kay" <?php if ($datos->marca === 'Mary Kay') echo 'selected'; ?>>Mary Kay</option>
          </select>
        </div>

        <div class="col-md-6 mb-3">
          <label for="exampleInputEmail1" class="form-label"><strong>Categoría</strong></label>
          <select id="categoria" name="categoria" class="form-select" required>
            <option value="" disabled>Seleccione Una Opción</option>
            <option value="Limpiador" <?php if ($datos->categoria === 'Limpiador') echo 'selected'; ?>>Limpiador</option>
            <option value="Tonicos" <?php if ($datos->categoria === 'Tonicos') echo 'selected'; ?>>Tonicos</option>
            <option value="Gel humectante" <?php if ($datos->categoria === 'Gel humectante') echo 'selected'; ?>>Gel humectante</option>
            <option value="Bloqueador solar" <?php if ($datos->categoria === 'Bloqueador solar') echo 'selected'; ?>>Bloqueador solar</option>
            <option value="Cremas" <?php if ($datos->categoria === 'Cremas') echo 'selected'; ?>>Cremas</option>
            <option value="MkMens" <?php if ($datos->categoria === 'MkMens') echo 'selected'; ?>>MkMens</option>
          </select>
        </div>
      </div>

      <div class="col-md-6 mb-3">
        <label for="exampleInputEmail1" class="form-label"><strong>Descripción</strong></label>
        <textarea class="form-control" id="detalle" name="descripcion" rows="3"><?= $datos->descripcion ?></textarea>
      </div>

      <?php
}
?>

      <div class="text-center"> <button type="submit" class="btn btn-primary btn-lg px-6 py-2" name="btnregistrar"
          value="ok">Modificar
          Producto</button></div>
      <div id="message"></div>
    </form>
</body>

</html>