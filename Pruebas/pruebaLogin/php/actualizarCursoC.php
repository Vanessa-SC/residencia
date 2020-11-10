<?php


$curso = json_decode(file_get_contents("php://input"));

include_once('conexion.php');

$response = [];


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

/* Query de actualización */
$sql = "UPDATE curso
        SET Folio = '$curso->Folio',
            ClaveRegistro = '$curso->ClaveRegistro',
            nombreCurso = '$curso->curso',
            periodo = '$periodo',
            duracion = '$curso->duracion',
            horaInicio = '$curso->horaInicio',
            horaFin = '$curso->horaFin',
            fechaInicio = '$curso->fechaInicio',
            fechaFin = '$curso->fechaFin',
            modalidad = '$modalidad',
            lugar = '$curso->lugar',
            destinatarios = '$curso->destinatarios',
            objetivo = '$curso->objetivo',
            observaciones = '$curso->observaciones'
        WHERE idCurso = '$curso->idCurso'
        ";

if (mysqli_query($conn, $sql)) {
    $response['status'] = 'ok';
} else {
    $response['status'] = 'error' . mysqli_error($conn);
} 


echo json_encode($response,JSON_FORCE_OBJECT);
// echo json_encode($curso);

