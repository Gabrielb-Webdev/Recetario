<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'config.php';

if ($mysqli->connect_error) {
    die('Connection failed: ' . $mysqli->connect_error);
} else {
    echo 'Connected successfully to the database.';
}
?>
