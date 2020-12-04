<?php

$inst = json_decode(file_get_contents("php://input"));

include_once('conexion.php');


/* Conversión de los formatos de fecha */

setlocale(LC_TIME,'es_MX');

$fechaNacimiento = strftime ('%Y-%m-%d', strtotime($inst->fechaNacimiento));

if ($inst->horas == 1) {
    $horas = "Sin horas";
} elseif ($inst->horas == 2) {
    $horas = "Tiempo Completo";
} elseif ($inst->horas == 3) {
    $horas = "Medio Tiempo";
} elseif ($inst->horas == 4) {
    $horas = "Tres Cuartos de Tiempo";
} else {
    $horas = "Asignaturas";
}

if ($inst->nivel == 1) {
    $nivel = "Licenciatura";
} elseif ($inst->nivel == 2) {
    $nivel = "Maestría";
} elseif ($inst->nivel == 3) {
    $nivel = "Doctorado";
} else {
    $nivel = "Especialización";
} 

if ($inst->perfilDeseable == 1) {
    $perfilDeseable = "Maestría";
} elseif ($inst->perfilDeseable == 2) {
    $perfilDeseable = "Doctorado";
} else {
    $perfilDeseable = "Especialización";
} 

if ($inst->funcionAdministrativa == 1) {
    $funcionAdministrativa = "SI";
} else {
    $funcionAdministrativa = "NO";
} 

/* Query de insercion */
$sql = "INSERT INTO usuario
        VALUES ('',
            '$inst->departamento',
            4,
            '$inst->nombreUsuario',
            '$inst->contrasena',
            '$inst->apellidoPaterno',
            '$inst->apellidoMaterno',
            '$inst->nombre',
            upper('$inst->RFC'),
            upper('$inst->CURP'),
            '$inst->horas',
            '$inst->nivel',
            '$inst->perfilDeseable',
            'SI',
            '$inst->funcionAdministrativa'
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