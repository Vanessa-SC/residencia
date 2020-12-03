<?php

if(!isset($_POST)) die();

include_once 'conexion.php';

$idCurso = mysqli_real_escape_string($conn,$_POST['idc']);
$idUsuario = mysqli_real_escape_string($conn,$_POST['idu']);

$response = [];

$query = "SELECT * 
        FROM usuario_responde_encuesta, curso_has_encuesta
        WHERE usuario_responde_encuesta.Encuesta_idEncuesta = curso_has_encuesta.Encuesta_idEncuesta 
        AND usuario_responde_encuesta.Usuario_idUsuario = $idUsuario 
        AND curso_has_encuesta.Curso_idCurso = $idCurso";

$result = $conn->query($query) or die($conn->error . __LINE__);

$curso = mysqli_fetch_all($result, MYSQLI_ASSOC);

if( mysqli_num_rows($result) > 0 ){
    $response['status'] = 'contestada';
} else {
    $response['status'] = 'no contestada';
}

echo json_encode($response, true);
