<?php


$curso = json_decode(file_get_contents("php://input"));

include_once('conexion.php');

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

/* Formato fecha */
$fechaInicio = date('Y-m-d', strtotime($curso->fechaInicio));
$fechaFin = date('Y-m-d', strtotime($curso->fechaFin));

/* Modalidad */
if ($curso->modalidad == 1) {
    $modalidad = "Presencial";
} elseif ($curso->modalidad == 2) {
    $modalidad = "Virtual";
} else {
    $modalidad = "Semipresencial";
}

/* Determinando el departamento */
if($curso->departamento == 0 ){
    $curso->departamento = 5;
}

$dep = "SELECT nombreDepartamento 
        FROM departamento 
        WHERE idDepartamento = $curso->departamento";

$result = $conn->query($dep) or die($conn->error . __LINE__);

$departamento = implode(mysqli_fetch_assoc($result));

if($departamento == "Todos los Departamentos"){
    $departamento = "ITD";
}

/* Actualizar Clave de registro */
$preClave = substr($curso->ClaveRegistro, 0, 9);  

$claveRegistro = $preClave . $departamento;

/* Query de actualización */
$sql = "UPDATE curso
        SET Folio = '$curso->Folio',
            ClaveRegistro = '$claveRegistro',
            nombreCurso = '$curso->curso',
            periodo = '$periodo',
            duracion = '$curso->duracion',
            horaInicio = '$curso->horaInicio',
            horaFin = '$curso->horaFin',
            fechaInicio = '$fechaInicio',
            fechaFin = '$fechaFin',
            modalidad = '$modalidad',
            lugar = '$curso->lugar',
            destinatarios = '$curso->destinatarios',
            objetivo = '$curso->objetivo',
            observaciones = '$curso->observaciones',
            instructor_idInstructor = '$curso->instructor',
            departamento_idDepartamento = '$curso->departamento'
        WHERE idCurso = '$curso->idCurso'
        ";

if (mysqli_query($conn, $sql)) {
    $response['status'] = 'ok';
} else {
    $response['status'] = 'error' . mysqli_error($conn);
} 


echo json_encode($response,JSON_FORCE_OBJECT);
// echo json_encode($curso);

