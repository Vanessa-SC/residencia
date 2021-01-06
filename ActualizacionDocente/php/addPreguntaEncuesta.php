<?php

if(!isset($_POST)) die ();

include_once 'conexion.php';
$response = [];

$pregunta = $_POST['preg'];
$encuesta = $_POST['enc'];

$response['p'] = $pregunta;
$response['e'] = $encuesta;

/** Inserción de la pregunta */
$query1 = "INSERT INTO pregunta VALUES('','$pregunta')";
if(mysqli_query($conn,$query1)){
    $idp = mysqli_insert_id($conn);

    $query2 = "INSERT INTO encuesta_has_pregunta VALUES($encuesta,$idp)";
    if(mysqli_query($conn,$query2)){
        $response['status'] = 'ok';
    } else {
        $response['status'] = 'error: '.mysqli_error($conn);
    }
}

/** Asignación de la pregunta a la encuesta */

echo json_encode($response,true);
