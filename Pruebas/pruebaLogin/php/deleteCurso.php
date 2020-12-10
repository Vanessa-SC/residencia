<?php

/* Eliminación de un curso */

//conexion
include_once 'conexion.php';
// Se recibe algo en POST?
if (!isset($_POST)) {
    die();
}
// array de respuesta
$response = [];
// asignacion de dato a variable
$id = mysqli_real_escape_string($conn, $_POST['idCurso']);
// Query de eliminacion
$query = "DELETE FROM curso WHERE idCurso = '$id'";
// Se ejecutó correctamente?
if(mysqli_query($conn, $query)){
   $response['status'] = 'ok';
} else {
    $response['status'] = 'Error';
}
// respuesta
echo json_encode($response);