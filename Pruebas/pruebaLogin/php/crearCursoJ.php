<?php

/* Creacion de curso desde usuairo Jefe */

/* Recepción de Array de datos */
$curso = json_decode(file_get_contents("php://input"));
//conexion
include_once 'conexion.php';

/* Conversión de los formatos de fecha y hora, año */
$horaInicio = date('h:i', strtotime($curso->horaInicio));
$horaFin = date('h:i', strtotime($curso->horaFin));
$año = date('Y', strtotime($curso->fechaInicio));

$fechaInicio = date('Y-m-d', strtotime($curso->fechaInicio));
$fechaFin = date('Y-m-d', strtotime($curso->fechaFin));

/* Fecha actual en español */
$bMeses = array("void", "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
$bDias = array("Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado");
$fecha = getdate();

$dias = $bDias[$fecha["wday"]];
$meses = $bMeses[$fecha["mon"]];

$actual = $fecha["mday"] . " de " . $meses . " de " . $fecha["year"];

/* Determinar periodo */
$mes = date('m', strtotime($curso->fechaInicio));

if ($mes <= 6) {
    $periodo = 'Enero / Junio ' . $año;
} else {
    $periodo = 'Agosto / Diciembre ' . $año;
}

/* Modalidad */
if ($curso->modalidad == 1) {
    $modalidad = "Presencial";
} elseif ($curso->modalidad == 2) {
    $modalidad = "Virtual";
} else {
    $modalidad = "Semipresencial";
}

/* Determinar si va dirigido a cualquier departamento */
    /* Obtener id del departamento */
    $sqlGetDepto = "SELECT idDepartamento
                    FROM departamento
                    WHERE nombreDepartamento='Todos los Departamentos'";

    $res = mysqli_query($conn,$sqlGetDepto);
    $idDepartamento = mysqli_fetch_array ($res);

    if($curso->departamento == 0){
        $departamento = $idDepartamento[0];
    } else {
        $departamento = $curso->departamento;
    }

/* Validar si hay observaciones */
if(empty($curso->observaciones)){
    $curso->observaciones== "Ninguna";
}

/* validar si hay folio  */
if(empty($curso->folio)){
    $curso->folio = "";
}


// if(array_key_exists('observaciones', get_object_vars($curso))){
//     /* Query de insercion */
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
        '$curso->destinatarios',
        '$curso->Objetivo',
        '$curso->observaciones',
        'no',
        null,
        '$curso->username',
        '$curso->instructor',
        '$departamento')
    ";
// } else {
//     /* Query de insercion */
//     $sql = "INSERT INTO curso
//     VALUES ('',
//         '$curso->folio',
//         '$curso->clave',
//         '$curso->nombre',
//         '$periodo',
//         '$curso->duracion',
//         '$curso->horaInicio',
//         '$curso->horaFin',
//         '$fechaInicio',
//         '$fechaFin',
//         '$modalidad',
//         '$curso->lugar',
//         '$curso->destinatarios',
//         '$curso->Objetivo',
//         'Ninguna',
//         'no',
//         null,
//         '$curso->username',
//         '$curso->instructor',
//         '$departamento')
//     ";
// }

if (mysqli_query($conn, $sql)) {
    $response['status'] = 'ok';
} else {
    $response['status'] = 'error' . mysqli_error($conn);
}

echo json_encode($response, JSON_FORCE_OBJECT);
