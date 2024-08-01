<?php
require_once 'config.php';

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error . " (" . $conn->connect_errno . ")");
}
echo "Conexión exitosa";
$conn->close();
?>
