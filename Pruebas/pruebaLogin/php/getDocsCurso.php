<?php

include_once 'conexion.php';

if (!isset($_POST)) {
    die();
}

$idCurso = $_POST['idCurso'];

$sql = "SELECT documento.idDocumento,
        documento.nombreDocumento,
        curso_has_documento.rutaArchivo
        FROM documento,curso_has_documento
        WHERE documento.idDocumento = curso_has_documento.Documento_idDocumento
        AND curso_has_documento.Curso_idCurso = $idCurso
        ORDER BY documento.idDocumento";

$result = $conn->query($sql) or die($conn->error . __LINE__);

$arr = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $arr[] = $row;
    }
}

echo json_encode($arr);
