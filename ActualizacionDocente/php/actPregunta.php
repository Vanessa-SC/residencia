<?php

if(!isset($_POST)) die();

include_once 'conexion.php';
$response = [];

$idp = $_POST['idp'];
$pregunta = $_POST['pregunta'];

$response['ipd'] = $idp;
$response['preg'] = $pregunta;

$query = "UPDATE pregunta SET descripcion = '$pregunta' WHERE idPregunta = $idp ";

if(mysqli_query($conn,$query)){
    $response['status'] = 'ok';
} else {
    $response['status'] = 'error: '.mysqli_error($conn);
}

echo json_encode($response,true);