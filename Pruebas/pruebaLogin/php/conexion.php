<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
// header("Content-Type: text/html;charset=utf-8");

$conn = new mysqli('localhost', 'root', '', 'bd_actdocente');

if ($conn->connect_error) {
    die('Error de Conexión (' . $conn->connect_errno . ') '
        . $conn->connect_error);
}

mysqli_set_charset($conn, 'utf8');
// mysqli_query("SET NAMES 'utf8'");
