<?php
require 'conexion.php';
$db = new conexion(); 
$con = $db->getConexion();  

// Esto obtiene los valores de marca y categoría enviados por ajax
$marca = isset($_POST['marca']) ? $_POST['marca'] : '';
$categoria = isset($_POST['categoria']) ? $_POST['categoria'] : '';

// consulta para obtener los productos filtrados
$sql = "SELECT id_producto, nombre_producto, precio, descripcion, imagen FROM productos WHERE visibilidad='Si'";

// condicion para filtrar por marca o categoría. Tener presente mejoras aqui
if ($marca != 'Seleccione Una Opción' && $marca != 'Todos') {
    $sql .= " AND marca = '$marca'";
}

if ($categoria != 'Seleccione Una Opción' && $categoria != 'Todos') {
    $sql .= " AND categoria = '$categoria'";
}

$resultado = $con->query($sql);

// Constructor html en base al index con los productos filtrados 
$html = '';

if ($resultado->num_rows > 0) {
    $html .= '<div class="container">';
    foreach ($resultado as $row) {
        $html .= '<div class="ejemplo">';
        $html .= '<a href="#trabajo-' . $row['id_producto'] . '" class="producto-card">';
        $html .= '<img src="' . $row['imagen'] . '" alt="Trabajo 1" />';
        $html .= '</a>';
        $html .= '<aside class="cont-info-descripcion">';
        $html .= '<h3 class="nombre-producto">' . $row['nombre_producto'] . '</h3>';
        $html .= '<aside class="price">$ ' . $row['precio'] . '</aside>';
        $html .= '</aside>';
        $html .= '</div>';
    }
    $html .= '</div>';
} else {
    $html = '<p>No se encontraron productos.</p>';
}

echo $html;
?>


