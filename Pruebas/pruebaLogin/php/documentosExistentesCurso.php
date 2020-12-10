<?php

/* Verifica si ya se han subido documentos a un curso y retorna el path de los mismos*/

// POST vacio?
if (!isset($_POST)) {
    die();
}
// conexion
include_once 'conexion.php';

// $idCurso = $_POST['idc'];
$idCurso = mysqli_real_escape_string($conn, $_POST['idc']);

// array de respuesta
$response = [];

// Consulta
$sql = "SELECT documento.idDocumento,
            documento.nombreDocumento,
            curso_has_documento.comentario,
            curso_has_documento.rutaArchivo
        FROM documento,curso_has_documento
        WHERE documento.idDocumento = curso_has_documento.Documento_idDocumento
        AND curso_has_documento.Curso_idCurso = $idCurso
        ORDER BY documento.idDocumento";

// ejecución de la consulta
$result = $conn->query($sql) or die($conn->error . __LINE__);

// Si hubo resultados...
if ($result->num_rows > 0) {

    // Se asigna el resultado a la variable
    $docs = mysqli_fetch_all($result, MYSQLI_ASSOC);

    // El estado de documentos indica que existe
    $response['status'] = 'existe';

    //extraccion de los key para el ciclo For
    $keyDocs = (array_keys($docs));

    for ($i = 0; $i <= max($keyDocs); $i++) {

        /* almacenamos la ruta de los documentos individuales */
        $response['documentos'][$i+1] = $docs[$i]['rutaArchivo'];

    }
}

// imprimimos la respuesta
echo json_encode($response, true);
