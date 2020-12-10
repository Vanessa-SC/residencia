<?php

/* Obtiene el número de Documentos de cada curso individual */

// Conexion
include_once 'conexion.php';
// Array de respuesta
$response = [];
// Obtención del ID más grande para usarse en el ciclo FOR
$sqlIdMax = "SELECT max(idCurso) as id FROM curso";
$res1 = mysqli_fetch_all(mysqli_query($conn,$sqlIdMax), MYSQLI_ASSOC);
$idMax = intval(implode($res1[0]));

// Array que contendrá el número de documentos para cada curso
$documentos = [];

for ( $i = 1 ; $i <= $idMax ; $i++ ){
    // Contador de los documentos de un curso
    $sql =  "SELECT count(curso_has_documento.Curso_idCurso) as num_docs 
             FROM curso_has_documento
             WHERE Curso_idCurso = $i";
    $result = $conn->query($sql) or die($conn->error . __LINE__);

    if ($result->num_rows > 0) {
        $num_docs = mysqli_fetch_all($result, MYSQLI_ASSOC);
        // numeroDocumentosCurso[idCurso] = numeroDocumentos
        $documentos['numDocsCurso'][$i] = $num_docs[0];
        // numeroDocumentosCurso[idCurso] = idCurso
        $documentos['numDocsCurso'][$i]['idCurso'] = $i;
    }
}

echo json_encode($documentos, true);