<?php

$curso = json_decode(file_get_contents("php://input"));

include_once('conexion.php');


/* Conversión de los formatos de fecha y hora, año */
$horaInicio = date('h:i', strtotime($curso->horaInicio));
$horaFin = date('h:i', strtotime($curso->horaFin));

setlocale(LC_TIME,'es_MX');

$fechaInicio = strftime ('%Y-%m-%d', strtotime($curso->fechaInicio));
$fechaFin = strftime ('%Y-%m-%d', strtotime($curso->fechaFin));


/* Determinar periodo */
if($curso->periodo == 1) {
    $periodo = "Agosto / Diciembre ";
} else {
    $periodo = "Enero / Junio ";
}

/* Modalidad */
if($curso->modalidad == 1) {
    $modalidad = "Presencial";
} else {
    $modalidad = "Virtual";
}

/* Asignación de instructor y departamento por defecto */
//$instructor = 1;
//$departamento = 1;


/* Query de insercion */
$sql = "INSERT INTO curso
        VALUES ('', 
            '$curso->folio',
            '$curso->clave',
            '$curso->nombre',
            '$periodo',
            '$curso->duracion',
            '$horaInicio',
            '$horaFin',
            '$fechaInicio',
            '$fechaFin',
            '$modalidad',
            '$curso->lugar',
           ' $curso->destinatarios',
            '$curso->Objetivo',
            '$curso->observaciones',
            'no',
            '$curso->instructor',
            '$curso->departamento')
        ";

if (mysqli_query($conn, $sql)) {
    $response['status'] = 'ok';
} else {
    $response['status'] = 'error' . mysqli_error($conn);
} 

echo json_encode($response,JSON_FORCE_OBJECT);