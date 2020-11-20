<?php


include_once 'conexion.php';

if (!isset($_POST)) {
    die();
}

$response = [];

$idUsuario = mysqli_real_escape_string($conn, $_POST['idUsuario']);
$idCurso = mysqli_real_escape_string($conn, $_POST['idCurso']);

$query = "DELETE 
            FROM usuario_has_curso
            WHERE Curso_idCurso = '$idCurso'
            AND Usuario_idUsuario = '$idUsuario'
            ";

if(mysqli_query($conn, $query)){
   $response['status'] = 'ok';
} else {
    $response['status'] = 'Error';
}

echo json_encode($response);