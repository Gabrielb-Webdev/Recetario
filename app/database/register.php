<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include 'config.php';

$username = $_POST['username'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

// Asegúrate de que las variables POST estén definidas
if (!isset($username) || !isset($password)) {
    echo json_encode(["status" => "error", "message" => "Datos incompletos"]);
    exit();
}

// Prepara la consulta para evitar inyección SQL
$sql = $conn->prepare("INSERT INTO usuarios (username, password) VALUES (?, ?)");
$sql->bind_param("ss", $username, $password);

if ($sql->execute()) {
    echo "Registro exitoso";
} else {
    echo "Error: " . $sql->error;
}

$conn->close();
?>
