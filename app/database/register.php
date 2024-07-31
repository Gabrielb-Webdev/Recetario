<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'config.php';
header('Content-Type: application/json');

$response = array('success' => false);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validar entrada
    if (empty($username) || empty($password)) {
        $response['error'] = 'Username and password are required.';
    } else {
        // Insertar usuario en la base de datos
        $sql = "INSERT INTO usuarios (username, password) VALUES (?, ?)";
        $stmt = $mysqli->prepare($sql);

        if ($stmt) {
            $hashed_password = password_hash($password, PASSWORD_BCRYPT);
            $stmt->bind_param('ss', $username, $hashed_password);
            if ($stmt->execute()) {
                $response['success'] = true;
                $response['user_id'] = $mysqli->insert_id;
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
