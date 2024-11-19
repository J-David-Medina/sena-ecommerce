<?php
require_once 'conexion.php';

class ConsultorProductos {
    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    public function consultarProductoPorNombre($nombre) {
        $stmt = $this->conexion->prepare("SELECT * FROM productos WHERE nombre_producto LIKE ?");
        
        if (!$stmt) {
            return false;
        }

        $nombre = "%" . $nombre . "%"; 

        $stmt->bind_param("s", $nombre);

        $stmt->execute();
        
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return false;
        }
    }
}

$conexion = new Conexion();
$conn = $conexion->getConexion();

if (isset($_GET['nombre'])) {
    $nombre = $_GET['nombre'];

    $consultorProductos = new ConsultorProductos($conn);
    $productosEncontrados = $consultorProductos->consultarProductoPorNombre($nombre);

    if (!empty($productosEncontrados)) {
        foreach ($productosEncontrados as $producto) {
            echo "<p>Nombre: " . $producto['nombre_producto'] . "</p>";
            echo "<p>Descripción: " . $producto['descripcion'] . "</p>";
            echo "<p>Precio: " . $producto['precio'] . "</p>";
            echo "<p>Marca: " . $producto['marca'] . "</p>";
            echo "<p>Categoría: " . $producto['categoria'] . "</p>";
            echo "<p>Existencias: " . $producto['existencias'] . "</p>";
            echo "<p>Visibilidad: " . $producto['visibilidad'] . "</p>";
            
            // Formulario para modificar
            echo "<form method='post' action='modificar_producto.php'>";
            echo "<input type='hidden' name='id' value='" . $producto['id_producto'] . "'>";
            echo "<input type='submit' value='Modificar'>";
            echo "</form>";

            // Formulario para eliminar
            echo "<form method='get' action='conexion-eliminar-producto.php'>";
            echo "<input type='hidden' name='id' value='" . $producto['id_producto'] . "'>";
            echo "<input type='hidden' name='confirm' value='true'>"; // Agregar confirmación
            echo "<input type='submit' value='Eliminar'>";
            echo "</form>";

            echo "<hr>"; 
        }
    } else {
        echo 'No se encontraron productos por el nombre "' . $nombre . '".';
    }
}

$conn->close();
?>


