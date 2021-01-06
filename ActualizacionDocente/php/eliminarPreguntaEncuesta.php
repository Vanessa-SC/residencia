<?php

if (!isset($_POST)) {
    die();
}

$response = [];
include_once 'conexion.php';

$idp = $_POST['idp'];
$ide = $_POST['ide'];

$query = "DELETE FROM encuesta_has_pregunta WHERE pregunta_idPregunta = $idp AND encuesta_idEncuesta = $ide";
$query2 = "DELETE FROM pregunta WHERE idPregunta = $idp";

if (mysqli_query($conn, $query)) {
    if (mysqli_query($conn,$query2)) {
        $response['status'] = 'ok';
    } else {
        $response['status'] = 'error: '.mysqli_error($conn);
    }
    
}

echo json_encode($response,true);
