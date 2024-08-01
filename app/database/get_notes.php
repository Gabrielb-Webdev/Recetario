<?php
include 'config.php';

$usuario_id = $_POST['usuario_id'];

$sql = "SELECT * FROM notas WHERE usuario_id='$usuario_id'";
$result = $conn->query($sql);

$notas = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $notas[] = $row;
    }
    echo json_encode($notas);
} else {
    echo json_encode([]);
}

$conn->close();
?>
