<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include 'config.php';

$username = $_POST['username'];
$password = $_POST['password'];

// Asegúrate de que las variables POST estén definidas
if (!isset($username) || !isset($password)) {
    echo json_encode(["status" => "error", "message" => "Datos incompletos"]);
    exit();
}

// Prepara la consulta para evitar inyección SQL
$sql = $conn->prepare("SELECT * FROM usuarios WHERE username=?");
$sql->bind_param("s", $username);
$sql->execute();
$result = $sql->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if (password_verify($password, $row['password'])) {
        echo json_encode(["status" => "success", "user_id" => $row['id']]);
    } else {
        echo json_encode(["status" => "error", "message" => "Contraseña incorrecta"]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Usuario no encontrado"]);
}

$conn->close();
?>
