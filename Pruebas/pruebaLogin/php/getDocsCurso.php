<?php

/* Obtiene los documentos de un curso ordenados por su ID */

// Conexión
include_once 'conexion.php';

// ¿Recibe datos?
if (!isset($_POST)) {
    die();
}

// Asignación de variable
$idCurso = $_POST['idCurso'];

// SQL de consulta
$sql = "SELECT documento.idDocumento,
        documento.nombreDocumento,
        curso_has_documento.comentario,
        curso_has_documento.rutaArchivo,
        curso_has_documento.estadoVerificado as validado
        FROM documento,curso_has_documento
        WHERE documento.idDocumento = curso_has_documento.Documento_idDocumento
        AND curso_has_documento.Curso_idCurso = $idCurso
        ORDER BY documento.idDocumento";

// Validación de ejecucion de consulta
$result = $conn->query($sql) or die($conn->error . __LINE__);

// Almacenamiento de resultados
$arr = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $arr[] = $row;
    }
}

// Impresión de resultados
echo json_encode($arr);
