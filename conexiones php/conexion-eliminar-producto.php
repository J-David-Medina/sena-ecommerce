<?php
require_once 'conexion.php';

class EliminadorProductos {
    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    public function eliminarProductoPorId($id) {
        $stmt = $this->conexion->prepare("DELETE FROM productos WHERE id_producto = ?");
        
        if (!$stmt) {
            return $this->conexion->error;
        }
    
        $stmt->bind_param("i", $id);
    
        if ($stmt->execute()) {
            return true;
        } else {
            return $stmt->error;
        }
    }
}

$conexion = new Conexion();
$conn = $conexion->getConexion();

$response = '';

if (isset($_GET['id'])) {
    $id_producto = $_GET['id'];

    $eliminadorProductos = new EliminadorProductos($conn);

    // Verificar si se ha confirmado la eliminación
    if (isset($_GET['confirm']) && $_GET['confirm'] == 'true') {
        $productoEliminado = $eliminadorProductos->eliminarProductoPorId($id_producto);
        
        if ($productoEliminado) {
            $response = 'El producto ha sido eliminado exitosamente.';
        } else {
            $response = 'Hubo un error al intentar eliminar el producto.';
        }
    } else {
        // Mostrar alerta de confirmación
        $response = '<script>
                        var confirmar = confirm("¿Está seguro de eliminar este producto?");
                        if (confirmar) {
                            window.location.href = "eliminar_producto.php?id=' . $id_producto . '&confirm=true";
                        } else {
                            window.location.href = "pagina_anterior.php"; // Página anterior o donde quieras redirigir si se cancela la eliminación
                        }
                    </script>';
    }
}

$conn->close();

echo $response;
?>



