<?php
class conexion {
    private $servidor = "localhost";
    private $usuario = "root";
    private $contraseña = "";
    private $baseDatos = "tiendamaquillaje";
    public $conn;

    public function __construct() {
        $this->conn = new mysqli($this->servidor, $this->usuario, $this->contraseña, $this->baseDatos);
        if ($this->conn->connect_error) {
            die("Conexión fallida: " . $this->conn->connect_error);
        }
    }

    public function getConexion() {
        return $this->conn;
    }
}


$conexion = new Conexion();
$conn = $conexion->getConexion();
?>
