<?php

/* Registrará un nuevo departamento */

// Recepcion del array de datos
$dpto = json_decode(file_get_contents("php://input"));
// Conexión
include_once('conexion.php');

/* Query de insercion  a tabla departamento */
$sql = "INSERT INTO departamento
        VALUES ('',
            '$dpto->nombreDpto',
            '$dpto->usuario'
            )
        ";
// Ejecución del query y validación de su ejecucion
if (mysqli_query($conn, $sql)) {
        $response['status'] = 'ok';
} else {
    $response['status'] = 'error: ' . mysqli_error($conn);
} 
// Impresión del resultado
echo json_encode($response,JSON_FORCE_OBJECT);