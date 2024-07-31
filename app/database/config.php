<?php
$host = 'localhost';
$db = 'u543453127_mi_recetario';
$user = 'u543453127_rooot';
$pass = 'Lg030920.';

$mysqli = new mysqli($host, $user, $pass, $db);

if ($mysqli->connect_error) {
    die('Connection failed: ' . $mysqli->connect_error);
}
?>
