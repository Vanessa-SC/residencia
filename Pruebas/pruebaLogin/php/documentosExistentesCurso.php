<?php

if (!isset($_POST)) {
    die();
}

include_once 'conexion.php';

// $idCurso = $_POST['idc'];
$idCurso = mysqli_real_escape_string($conn, $_POST['idc']);

$response = [];

$sql = "SELECT documento.idDocumento,
            documento.nombreDocumento,
            curso_has_documento.comentario,
            curso_has_documento.rutaArchivo
        FROM documento,curso_has_documento
        WHERE documento.idDocumento = curso_has_documento.Documento_idDocumento
        AND curso_has_documento.Curso_idCurso = $idCurso
        ORDER BY documento.idDocumento";

$result = $conn->query($sql) or die($conn->error . __LINE__);

if ($result->num_rows > 0) {
    
    $docs = mysqli_fetch_all($result, MYSQLI_ASSOC);
    $response['status'] = 'existe';
    
    $keyDocs = (array_keys($docs));

    for ($i = 0; $i <= max($keyDocs); $i++) {
        $response['documentos'][$i+1] = $docs[$i]['rutaArchivo'];
    }
}

echo json_encode($response, true);
