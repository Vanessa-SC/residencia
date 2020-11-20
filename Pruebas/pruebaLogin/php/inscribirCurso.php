<?php


include_once 'conexion.php';

if (!isset($_POST)) {
    die();
}

$response = [];

$idUsuario = mysqli_real_escape_string($conn, $_POST['idUsuario']);
$idCurso = mysqli_real_escape_string($conn, $_POST['idCurso']);

$query = "INSERT INTO usuario_has_curso (Usuario_idUsuario, Curso_idCurso, estado) VALUES ('$idUsuario', '$idCurso', '1')";

if(mysqli_query($conn, $query)){
   $response['status'] = 'ok';
} else {
    $response['status'] = 'Error';
}

echo json_encode($response);