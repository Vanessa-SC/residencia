<?php

/* Obtiene un listado de los comentarios de los documentos de un curso */

// Conexión
include_once 'conexion.php';

// Asignación de variables
$idCurso = mysqli_real_escape_string($conn, $_POST['idCurso']);
$idDocumento = mysqli_real_escape_string($conn, $_POST['idDocumento']);

// Query de consulta
$sql = "SELECT *
        FROM curso_has_documento
        WHERE Curso_idCurso = $idCurso
        AND Documento_idDocumento = $idDocumento";
// Validacion de ejecución de consulta
$result = $conn->query($query) or die($conn->error . __LINE__);
// Asociación de resultados
$comentarios = mysqli_fetch_all($result, MYSQLI_ASSOC);
// Impresión de resultados
echo json_encode($comentarios,true);
