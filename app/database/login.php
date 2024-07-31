<?php
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
        // Verificar usuario en la base de datos
        $sql = "SELECT id, password FROM usuarios WHERE username = ?";
        $stmt = $mysqli->prepare($sql);

        if ($stmt) {
            $stmt->bind_param('s', $username);
            $stmt->execute();
            $stmt->store_result();
            
            if ($stmt->num_rows > 0) {
                $stmt->bind_result($id, $hashed_password);
                $stmt->fetch();
                if (password_verify($password, $hashed_password)) {
                    $response['success'] = true;
                    $response['user_id'] = $id;
                } else {
                    $response['error'] = 'Invalid password.';
                }
            } else {
                $response['error'] = 'User not found.';
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
