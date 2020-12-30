<?php

/* Obtiene los datos de un documento de un curso */

// Conexión a la BD
include_once 'conexion.php';

// ¿Se reciben datos POST?
if (!isset($_POST)) {
    die();
}

// Asignación de variables
$idCurso = $_POST['idCurso'];
$idDocumento = $_POST['idDocumento'];

// Consulta SQL
$sql = "SELECT documento.idDocumento,
        documento.nombreDocumento,
        curso_has_documento.comentario,
        curso_has_documento.rutaArchivo
        FROM documento,curso_has_documento
        WHERE documento.idDocumento = curso_has_documento.Documento_idDocumento
        AND curso_has_documento.Curso_idCurso = $idCurso
        AND curso_has_documento.Documento_idDocumento = $idDocumento";

// Validación de ejecución de consulta
$result = $conn->query($sql) or die($conn->error . __LINE__);

// Declaración del array que contendrá los resultados de la consulta
$arr = array();

// Si hay resultados...
if ($result->num_rows > 0) {

    // Guardamos los resultados en el array
    while ($row = $result->fetch_assoc()) {
        $arr[] = $row;
    }
}

// Impresión de resultados
echo json_encode($arr,true);
