<?php
include 'config.php';

$id = $_POST['id'];
$usuario_id = $_POST['usuario_id'];
$tipo = $_POST['tipo'];
$titulo = $_POST['titulo'];
$contenido = $_POST['contenido'];
$cumplido = $_POST['cumplido'] ? 1 : 0;

$sql = "UPDATE notas SET titulo='$titulo', contenido='$contenido', cumplido='$cumplido' WHERE id='$id' AND usuario_id='$usuario_id'";

if ($conn->query($sql) === TRUE) {
    echo "Nota actualizada";
} else {
    echo json_encode(["status" => "error", "message" => $conn->error]);
}

$conn->close();
?>
