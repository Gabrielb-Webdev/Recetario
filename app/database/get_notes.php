<?php
require_once 'config.php';
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $usuario_id = $_GET['usuario_id'];
    $tipo = $_GET['tipo'];

    // Validar entrada
    if (empty($usuario_id) || empty($tipo)) {
        echo json_encode(['success' => false, 'error' => 'User ID and note type are required.']);
        exit;
    }

    // Obtener notas de la base de datos
    $sql = "SELECT id, titulo, contenido, tipo, cumplido FROM notas WHERE usuario_id = ? AND tipo = ?";
    $stmt = $mysqli->prepare($sql);

    if ($stmt) {
        $stmt->bind_param('is', $usuario_id, $tipo);
        $stmt->execute();
        $result = $stmt->get_result();
        $notas = $result->fetch_all(MYSQLI_ASSOC);
        echo json_encode($notas);
        $stmt->close();
    } else {
        echo json_encode(['success' => false, 'error' => 'Error preparing statement: ' . $mysqli->error]);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Invalid request method.']);
}
?>
