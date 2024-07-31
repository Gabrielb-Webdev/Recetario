<?php
require_once 'config.php';
header('Content-Type: application/json');

$response = array('success' => false);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario_id = $_POST['usuario_id'];
    $titulo = $_POST['titulo'];
    $contenido = $_POST['contenido'];
    $tipo = $_POST['tipo'];
    $cumplido = $_POST['cumplido'] === 'true' ? 1 : 0;

    // Validar entrada
    if (empty($usuario_id) || empty($titulo) || empty($contenido) || empty($tipo)) {
        $response['error'] = 'All fields are required.';
    } else {
        // Insertar nota en la base de datos
        $sql = "INSERT INTO notas (usuario_id, titulo, contenido, tipo, cumplido) VALUES (?, ?, ?, ?, ?)";
        $stmt = $mysqli->prepare($sql);

        if ($stmt) {
            $stmt->bind_param('isssi', $usuario_id, $titulo, $contenido, $tipo, $cumplido);
            if ($stmt->execute()) {
                $response['success'] = true;
            } else {
                $response['error'] = 'Error executing statement: ' . $stmt->error;
            }
            $stmt->close();
        } else {
            $response['error'] = 'Error preparing statement: ' . $mysqli->error;
        }
    }
} else {
    $response['error'] = 'Invalid request method.';
}

echo json_encode($response);
?>
