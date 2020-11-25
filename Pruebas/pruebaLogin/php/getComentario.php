<?php

include_once 'conexion.php';

$response = [];

$idCurso = mysqli_real_escape_string($conn, $_POST['idCurso']);
$idDocumento = mysqli_real_escape_string($conn, $_POST['idDocumento']);

$response['curso'] = $idCurso;
$response['documento'] = $idDocumento;
$response['comentario'] = $comentario;

$sql = "SELECT *
        FROM curso_has_documento
        WHERE Curso_idCurso = $idCurso
        AND Documento_idDocumento = $idDocumento";

if (mysqli_query($conn, $sql)) {
    $response['status'] = 'ok';
} else {
    $response['status'] = 'error';
}

$result = $conn->query($query) or die($conn->error . __LINE__);

$comentarios = mysqli_fetch_all($result, MYSQLI_ASSOC);

echo json_encode($comentarios);
