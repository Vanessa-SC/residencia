<?php


include_once 'conexion.php';

if (!isset($_POST)) {
    die();
}

$response = [];

$id = mysqli_real_escape_string($conn, $_POST['idCurso']);

$query = "DELETE FROM curso WHERE idCurso = '$id'";

if(mysqli_query($conn, $query)){
   $response['status'] = 'ok';
} else {
    $response['status'] = 'Error';
}

echo json_encode($response);