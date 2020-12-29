<?php

/** Obtener encuestas respondidas en un curso */

if(!isset($_POST)) die();

//Conexión y recepcion de datos

include_once 'conexion.php';
$idc = mysqli_real_escape_string($conn,$_POST['idc']);
$ide = mysqli_real_escape_string($conn,$_POST['ide']);
$response = [];


$sql = "SELECT ur.pregunta_idPregunta as idPregunta, AVG(ur.respuesta) as resultado
        FROM usuario_responde_encuesta ur 
        Where ur.Curso_idCurso = $idc
        AND ur.Encuesta_idEncuesta = $ide
        group by ur.pregunta_idPregunta";

$result = $conn->query($sql) or die($conn->error . __LINE__);
$data = mysqli_fetch_all($result, MYSQLI_ASSOC);

$response = $data;

echo json_encode($response, true);
