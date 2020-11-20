<?php

$inst = json_decode(file_get_contents("php://input"));

include_once('conexion.php');


/* Conversión de los formatos de fecha */

setlocale(LC_TIME,'es_MX');

$fechaNacimiento = strftime ('%Y-%m-%d', strtotime($inst->fechaNacimiento));

/* Query de insercion */
$sql = "INSERT INTO usuario
        VALUES ('',
            '$inst->departamento',
            4,
            '$inst->apellidoPaterno',
            '$inst->apellidoMaterno',
            '$inst->nombre',
            '$inst->nombreUsuario',
            '$inst->contrasena'
            )
        ";

if (mysqli_query($conn, $sql)) {

    /* INSERTAR CAMPOS EN TABLA instructor */
    $idUsuario = mysqli_insert_id($conn);
    $sql = "INSERT INTO instructor
    VALUES(
        '',
        '$idUsuario',
        '$inst->apellidoPaterno',
        '$inst->apellidoMaterno',
        '$inst->nombre',
        upper('$inst->RFC'),
        upper('$inst->CURP'),
        '$fechaNacimiento',
        '$inst->telefono',
        '$inst->correo'
    )";
    if(mysqli_query($conn, $sql)){
        $response['status'] = 'ok';
    } else {
        $response['status'] = 'error al insertar oficio de registro';
    }
} else {
    $response['status'] = 'error' . mysqli_error($conn);
} 

echo json_encode($response,JSON_FORCE_OBJECT);