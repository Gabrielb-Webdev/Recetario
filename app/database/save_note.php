<?php
include 'config.php';

$usuario_id = $_POST['usuario_id'];
$tipo = $_POST['tipo'];
$titulo = $_POST['titulo'];
$contenido = $_POST['contenido'];
$cumplido = $_POST['cumplido'] ? 1 : 0;

$sql = "INSERT INTO notas (usuario_id, tipo, titulo, contenido, cumplido) VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("isssi", $usuario_id, $tipo, $titulo, $contenido, $cumplido);

if ($stmt->execute()) {
    echo "Nota guardada";
} else {
    echo json_encode(["status" => "error", "message" => $stmt->error]);
}

$conn->close();
?>
