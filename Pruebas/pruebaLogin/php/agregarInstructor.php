<?php

$inst = json_decode(file_get_contents("php://input"));

include_once('conexion.php');


/* Conversión de los formatos de fecha */

setlocale(LC_TIME,'es_MX');

$fechaNacimiento = strftime ('%Y-%m-%d', strtotime($inst->fechaNacimiento));

/* Query de insercion */
$sql = "INSERT INTO instructor
        VALUES ('',
            '$inst->apellidoPaterno',
            '$inst->apellidoMaterno',
            '$inst->nombreInstructor',
            '$inst->RFC',
           ' $inst->CURP',
            '$fechaNacimiento',
            '$inst->telefono',
            '$inst->correo')
        ";

if (mysqli_query($conn, $sql)) {
    $response['status'] = 'ok';
} else {
    $response['status'] = 'error' . mysqli_error($conn);
} 

echo json_encode($response,JSON_FORCE_OBJECT);