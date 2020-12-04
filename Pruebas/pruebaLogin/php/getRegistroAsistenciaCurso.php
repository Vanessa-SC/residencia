<?php

if(!isset($_POST)) die();

include_once 'conexion.php';

$idCurso = mysqli_real_escape_string($conn,$_POST['idc']);


date_default_timezone_set('America/Mexico_City');
$fecha = date('Y-m-d');

$response = [];

$query = "SELECT * FROM asistencia WHERE Curso_idCurso = $idCurso AND fecha LIKE '$fecha%'";

$result = $conn->query($query) or die($conn->error . __LINE__);

$curso = mysqli_fetch_all($result, MYSQLI_ASSOC);

if( mysqli_num_rows($result) > 0 ){
    $response['status'] = 'existe';
} else {
    $response['status'] = 'no existe';
}

echo json_encode($response, true);
