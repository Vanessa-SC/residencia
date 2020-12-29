<?php

/** Obtener encuestas respondidas en un curso */

if(!isset($_POST)) die();

//Conexión y recepcion de datos

include_once 'conexion.php';
$idc = mysqli_real_escape_string($conn,$_POST['idc']);
$response = [];


$sql = "SELECT e.idEncuesta, e.nombreEncuesta 
        FROM encuesta e, curso_has_encuesta ce
        WHERE e.idEncuesta = ce.Encuesta_idEncuesta 
        AND ce.Curso_idCurso = $idc";

$result = $conn->query($sql) or die($conn->error . __LINE__);
$data = mysqli_fetch_all($result, MYSQLI_ASSOC);

$response = $data;

echo json_encode($response, true);
