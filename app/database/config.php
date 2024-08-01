<?php
$servername = "localhost";
$username = "u543453127_rooot";
$password = "Lg030920.";
$dbname = "u543453127_mi_recetario";

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>
