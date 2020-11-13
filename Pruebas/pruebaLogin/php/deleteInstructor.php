<?php


include_once 'conexion.php';

if (!isset($_POST)) {
    die();
}

$response = [];

$id = mysqli_real_escape_string($conn, $_POST['idInstructor']);

$query = "DELETE FROM instructor WHERE idInstructor = '$id'";

if(mysqli_query($conn, $query)){
   $response['status'] = 'ok';
} else {
    $response['status'] = 'Error';
}

echo json_encode($response);