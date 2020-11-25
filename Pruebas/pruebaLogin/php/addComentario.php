<?php

include_once 'conexion.php';

if (!isset($_POST)) {
    die();
}

$response = [];

$idCurso = mysqli_real_escape_string($conn, $_POST['idCurso']);
$idDocumento = mysqli_real_escape_string($conn, $_POST['idDocumento']);
$comentario = mysqli_real_escape_string($conn, $_POST['comentario']);

$response['curso'] = $idCurso;
$response['documento'] = $idDocumento;
$response['comentario'] = $comentario;

$sql = "UPDATE curso_has_documento
        SET comentario = '$comentario'
        WHERE Curso_idCurso = $idCurso
        AND Documento_idDocumento = $idDocumento";

        if(mysqli_query($conn,$sql)){
            $response['status'] = 'ok';
        } else {
            $response['status'] = 'error';
        }


echo json_encode($response);
