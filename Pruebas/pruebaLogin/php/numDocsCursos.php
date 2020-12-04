<?php

include_once 'conexion.php';

$response = [];

$sqlIdMax = "SELECT max(idCurso) as id FROM curso";
$res1 = mysqli_fetch_all(mysqli_query($conn,$sqlIdMax), MYSQLI_ASSOC);

$idMax = intval(implode($res1[0]));

$documentos = [];

for ( $i = 1 ; $i <= $idMax ; $i++ ){

    $sql =  "SELECT count(curso_has_documento.Curso_idCurso) as num_docs 
             FROM curso_has_documento
             WHERE Curso_idCurso = $i";

    $result = $conn->query($sql) or die($conn->error . __LINE__);

    if ($result->num_rows > 0) {
        $num_docs = mysqli_fetch_all($result, MYSQLI_ASSOC);
        $documentos['numDocsCurso'][$i] = $num_docs[0];
        $documentos['numDocsCurso'][$i]['idCurso'] = $i;
    }

    
}
 echo json_encode($documentos, true);



// $sql =  "SELECT count(curso_has_documento.Curso_idCurso) as numDocs 
//             FROM curso_has_documento
//             WHERE Curso_idCurso = $idCurso";

// $result = $conn->query($sql) or die($conn->error . __LINE__);

// if ($result->num_rows > 0) {
    
//     $docs = mysqli_fetch_all($result, MYSQLI_ASSOC);
// }

// echo json_encode($idMax, true);