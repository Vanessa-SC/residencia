<?php

/* Creacion de curso desde usuairo Jefe */

/* Recepción de Array de datos */
$curso = json_decode(file_get_contents("php://input"));
// Conexión
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
    $curso->observaciones = "Ninguna";
}

/* Validar si hay materiales */
if(empty($curso->materiales)){
    $curso->materiales = "Ninguno";
}

/* Validar si hay fuentes */
if(empty($curso->fuentes)){
    $curso->fuentes = "Ninguna";
}

/* Validar si hay folio  */
if(empty($curso->folio)){
    $curso->folio = "";
}

//     /* Query de inserción */
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
        '$curso->introduccion',
        '$curso->justificacion',
        '$curso->contenido',
        '$curso->materiales',
        '$curso->criterios',
        '$curso->resultados',
        '$curso->fuentes',
        '$curso->observaciones',
        'NO',
        null,
        '$curso->username',
        '$curso->instructor',
        '$departamento')
    ";

if (mysqli_query($conn, $sql)) {
    
    // Asignar los tipos de encuesta al curso
    $idc = mysqli_insert_id($conn);
    $sqlEncuestasCurso = "INSERT INTO curso_has_encuesta
                          VALUES($idc,1),($idc,2),($idc,3)";
    mysqli_query($conn,$sqlEncuestasCurso);


    $response['status'] = 'ok';
} else {
    $response['status'] = 'error' . mysqli_error($conn);
}

echo json_encode($response, JSON_FORCE_OBJECT);
