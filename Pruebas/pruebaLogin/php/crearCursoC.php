<?php

/*  Creación de un curso desde usuario Coordinador  */

//Recepcion de array de datos
$curso = json_decode(file_get_contents("php://input"));
//conexion
include_once 'conexion.php';

/* Conversión de los formatos de fecha y hora, año */
$horaInicio = date('h:i', strtotime($curso->horaInicio));
$horaFin = date('h:i', strtotime($curso->horaFin));
$año = date('Y', strtotime($curso->fechaInicio));

setlocale(LC_TIME, 'es_MX');

$fechaInicio = strftime('%Y-%m-%d', strtotime($curso->fechaInicio));
$fechaFin = strftime('%Y-%m-%d', strtotime($curso->fechaFin));

/* fecha del curso para el oficio de registro */
$inicio = strftime('%d de %B', strtotime($curso->fechaInicio));
$fin = strftime('%d de %B, %Y', strtotime($curso->fechaFin));
$fechaCurso = $inicio . ' al ' . $fin;

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

/* Validar si hay observaciones */
if(empty($curso->observaciones)){
    $curso->observaciones== "Ninguna";
}

/* validar si hay folio  */
if(empty($curso->folio)){
    $curso->folio = "";
}

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
            null,
            '$curso->username',
            '$curso->instructor',
            '$curso->departamento')
        ";

/* Ejecución del Query */
if (mysqli_query($conn, $sql)) {
    $response['status'] = 'ok';
} else {
    $response['status'] = 'error' . mysqli_error($conn);
}

/* Impresión de resultado */
echo json_encode($response, JSON_FORCE_OBJECT);
