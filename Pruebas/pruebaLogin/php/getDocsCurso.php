<?php

/* Obtiene los documentos de un curso ordenados por su ID */

// conexion
include_once 'conexion.php';

// recibe datos?
if (!isset($_POST)) {
    die();
}

// asignación de variable
$idCurso = $_POST['idCurso'];

//query de consulta
$sql = "SELECT documento.idDocumento,
        documento.nombreDocumento,
        curso_has_documento.comentario,
        curso_has_documento.rutaArchivo,
        curso_has_documento.estadoVerificado as validado
        FROM documento,curso_has_documento
        WHERE documento.idDocumento = curso_has_documento.Documento_idDocumento
        AND curso_has_documento.Curso_idCurso = $idCurso
        ORDER BY documento.idDocumento";

// validacion de ejecucion de consulta
$result = $conn->query($sql) or die($conn->error . __LINE__);

// almacenamiento de resultados
$arr = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $arr[] = $row;
    }
}

// impresion de resultados
echo json_encode($arr);
