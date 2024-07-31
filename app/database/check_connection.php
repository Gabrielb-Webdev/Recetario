<?php
include 'config.php';

if ($mysqli->ping()) {
    echo 'connected';
} else {
    echo 'disconnected';
}
?>
