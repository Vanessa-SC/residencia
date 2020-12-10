<?php

/* Actualizará los datos del curso desde el usuario Coordinador */

/* Recepción del array que contiene los datos */
$curso = json_decode(file_get_contents("php://input"));
/* Conexión a la BD */
include_once('conexion.php');
/* Array de respuesta */
$response = [];

/* Obtención del año */
$año =  date('Y', strtotime($curso->fechaInicio));

/* Determinar periodo */
$mes = date('m', strtotime($curso->fechaInicio));

if ( $mes <= 6 ){
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
            observaciones = '$curso->observaciones',
            Instructor_idInstructor = '$curso->instructor',
            Departamento_idDepartamento = '$curso->departamento'
        WHERE idCurso = '$curso->idCurso'
        ";


/* Ejecución de la sentencia SQL */
if (mysqli_query($conn, $sql)) {
    $response['status'] = 'ok';
} else {
    $response['status'] = 'error' . mysqli_error($conn);
} 

/* Impresión de la respuesta en formato JSON */
echo json_encode($response,JSON_FORCE_OBJECT);
