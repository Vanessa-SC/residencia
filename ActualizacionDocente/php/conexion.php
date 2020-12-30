<?php
/* Headers */
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

/* Conexión a la BD */
$conn = new mysqli('localhost', 'root', '', 'bd_actdocente');

/* Impresión del error en caso de fallar la conexión */
if ($conn->connect_error) {
    die('Error de Conexión (' . $conn->connect_errno . ') '
        . $conn->connect_error);
}
/* Estableciendo el charset a la BD */
mysqli_set_charset($conn, 'utf8');
