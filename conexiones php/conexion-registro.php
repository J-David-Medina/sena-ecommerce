<?php
require_once 'conexion.php';

$conexion = new Conexion();
$conn = $conexion->getConexion();

$userName = $_POST['userName'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$password = $_POST['password'];
$confirmPwd = $_POST['confirmPassword']; 
$response = array();

// sentencia que verifica si el nombre del usuario esta en uso
$sql_check_user = "SELECT id_usuario FROM usuarios WHERE nombre_user = '$userName'";
$result_user = $conn->query($sql_check_user);

if ($result_user->num_rows > 0) {
    $response['status'] = 'error';
    $response['message'] = "El nombre de usuario '$userName' ya está en uso.";
} else {
    // sentencia que verifica si el correo electronio del usuario esta en uso
    $sql_check_email = "SELECT id_usuario FROM usuarios WHERE correo_electronico = '$email'";
    $result_email = $conn->query($sql_check_email);

    if ($result_email->num_rows > 0) {
        $response['status'] = 'error';
        $response['message'] = "El correo electrónico '$email' ya está en uso.";
    } else {
        if ($password === $confirmPwd) {
            $sql = "INSERT INTO usuarios (nombre_user, correo_electronico, telefono, contraseña)
                    VALUES ('$userName', '$email', '$phone', '$password')";

            if ($conn->query($sql) === TRUE) {
                $response['status'] = 'success';
                $response['message'] = "Registro exitoso, por favor haga clic en 'inicie sesión aquí'.";
            } else {
                $response['status'] = 'error';
                $response['message'] = "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            $response['status'] = 'error';
            $response['message'] = "Las contraseñas no coinciden.";
        }
    }
}

header('Content-Type: application/json');
echo json_encode($response);

$conn->close();
?>
