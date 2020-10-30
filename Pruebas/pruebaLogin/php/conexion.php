<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

$conn = new mysqli('localhost', 'root', '', 'bd_actdocente');

if ($conn->connect_error) {
    die('Error de Conexión (' . $conn->connect_errno . ') '
        . $conn->connect_error);
}

mysqli_set_charset($conn, 'utf8');
