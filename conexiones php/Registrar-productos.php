<?php

if (!empty($_POST["btnregistrar"])) {
  $nombre = $_POST['nombre'];
  $descripcion = "<p>" . $_POST['descripcion'] . "</p>";
  $precio = $_POST['precio'];
  $marca = $_POST['marca'];
  $categoria = $_POST['categoria'];
  $existencias = $_POST['existencias'];
  $visibilidad = $_POST['visibilidad'];
  $directorio = "img/productos/";

  $imagen = $_FILES['imagen']['tmp_name'];
  $nombreImagen = $_FILES['imagen']['name'];
  $tipoImagen = strtolower(pathinfo($nombreImagen, PATHINFO_EXTENSION));

  if ($tipoImagen === "jpg" or $tipoImagen === "jpeg" or $tipoImagen === "png") {
      $registro = $conn->query("INSERT INTO productos (nombre_producto, descripcion, precio, marca, categoria, existencias, visibilidad, imagen) 
                                VALUES ('$nombre', '$descripcion', '$precio', '$marca', '$categoria', '$existencias', '$visibilidad', '')");
      $idRegistro = $conn->insert_id;
      $ruta = $directorio . $idRegistro . "." . $tipoImagen;

    
      $actualizarImagen = $conn->query("UPDATE productos SET imagen='$ruta' WHERE id_producto=$idRegistro");


      if (move_uploaded_file($imagen, $ruta)) {
        echo "<div class='alert alert-info'>Producto guardada exitosamente</div>";
    } else {
        echo "<div class='alert alert-danger'>Error al guardar la imagen</div>";
    }
} else {
    echo "<div class='alert alert-info'>Por favor complete todos los campos</div>";
}
}
?>
<script>
history.replaceState(null, null, location.pathname);
</script>