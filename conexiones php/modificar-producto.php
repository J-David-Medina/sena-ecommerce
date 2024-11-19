<?php
if (!empty($_POST["btnregistrar"])) {
  if (!empty($_POST["btnregistrar"]) && !empty($_POST["nombre"]) && !empty($_POST["descripcion"]) && !empty($_POST["precio"]) && !empty($_POST["marca"]) && !empty($_POST["categoria"]) && !empty($_POST["existencias"]) && !empty($_POST["visibilidad"])) {

    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $marca = $_POST['marca'];
    $categoria = $_POST['categoria'];
    $existencias = $_POST['existencias'];
    $visibilidad = $_POST['visibilidad'];

   
    $sql = $conn->query("update productos set nombre_producto='$nombre', descripcion='$descripcion',precio='$precio',marca='$marca',categoria='$categoria',existencias= $existencias,visibilidad='$visibilidad' where id_producto= $id");
    if ($sql==1) {
      header("Location: ../productos.php");


    }else {
      echo "<div class='alert alert-danger'>error al modificar</div>";
    }

 }else {
  echo "<div class='alert alert-warning'>Campos vacios</div>";
 }
}


?>