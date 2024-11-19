<?php
if (!empty($_GET["id"]) && !empty($_GET["datos"])) {
  $id = $_GET["id"];
  $nombre = $_GET["datos"];
  try {
    unlink($nombre);
  } catch (\Throwable $th) {
 
  }
  $eliminar = $conn->query("DELETE FROM productos WHERE id_producto = $id");

  if ($eliminar == 1) {
    $eliminar = $conn->query("ALTER TABLE productos AUTO_INCREMENT = 1");
    echo "<div class='alert alert-info'>La imagen se elimino correctamente</div>";
  } else {
    echo "Error al eliminar el registro";
  }

  echo "<script>window.location.replace(window.location.href.split('?')[0]);</script>";
}
?>
<script>
history.replaceState(null, null, location.pathname);
</script>