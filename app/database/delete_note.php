<?php
include 'config.php';

$id = $_POST['id'];
$usuario_id = $_POST['usuario_id'];

$sql = "DELETE FROM notas WHERE id='$id' AND usuario_id='$usuario_id'";

if ($conn->query($sql) === TRUE) {
    echo "Nota eliminada";
} else {
    echo json_encode(["status" => "error", "message" => $conn->error]);
}

$conn->close();
?>
