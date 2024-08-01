<?php
// Este archivo simplemente intenta conectarse a la base de datos
include 'config.php';

if ($conn->connect_error) {
    echo "desconectado";
} else {
    echo "conectado";
}

$conn->close();
?>

