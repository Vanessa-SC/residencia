<?php

/* Verifica si ya se ha registrado la asistencia del día de hoy en un curso */


include_once 'conexion.php';
if(!isset($_POST)) die();
$idCurso = mysqli_real_escape_string($conn,$_POST['idc']);
$response = [];

// Zona horaria y obtención de fecha actual
date_default_timezone_set('America/Mexico_City');
$fecha = date('Y-m-d');

$query  = "SELECT * 
            FROM asistencia 
            WHERE Curso_idCurso = $idCurso 
            AND fecha LIKE '$fecha%'";
            
$result = $conn->query($query) or die($conn->error . __LINE__);

if( mysqli_num_rows($result) > 0 ){
    $response['status'] = 'existe';
} else {
    $response['status'] = 'no existe';
}

echo json_encode($response, true);
