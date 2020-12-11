<?php

/*  Realiza una verificación para ver si todos los documentos del curso ya están validados o no  */

/* Conexión */
include_once 'conexion.php';

/* Recepción de datos */
$idc = mysqli_real_escape_string($conn,$_POST['idc']);

/* Array de respuesta */
$response = [];

/* SQL */
$sql =  "SELECT * 
         FROM curso_has_documento
         WHERE Curso_idCurso = $idc 
         AND estadoVerificado = 'SI'";

// Ejecución de la consulta
$result = $conn->query($sql) or die($conn->error . __LINE__);

/* Contar si todos los documentos del curso han sido validados */
if(mysqli_num_rows($result) == 7 ) {
    $response['docs_status'] = 'validos';
} else {
    $response['docs_status'] = 'invalidos';
}
// Imprimimos la respuesta
echo json_encode($response, true);