<?php
require_once 'conexion.php';

$userNameOrEmail = $_POST['userName'];
$password = $_POST['password'];

$sql = "SELECT * FROM usuarios WHERE nombre_user = '$userNameOrEmail' OR correo_electronico = '$userNameOrEmail'";
$result = $conn->query($sql);

$response = array();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    
    if ($row['contraseña'] == $password) {
        $response['status'] = 'success';
        $response['message'] = 'Inicio de sesión exitoso.';
        
        // Check if user is admin
        if ( $row['nombre_user'] == 'admin' && $row['correo_electronico'] == 'eladmin@gmail.com' && $row['contraseña'] == 'admin') {
            // Redirigir al usuario a otro link si es admin
            $response['redirect'] = 'productos.php';
        } else {
            // Redirigir al usuario a la página principal si no es admin
            $response['redirect'] = 'index.php';
        }
    } else {
        $response['status'] = 'error';
        $response['message'] = 'Contraseña incorrecta.';
    }
} else {
    $response['status'] = 'error';
    $response['message'] = 'Usuario no encontrado.';
}

header('Content-Type: application/json');
echo json_encode($response);

$conn->close();
?>
