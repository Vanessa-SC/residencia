<?php

/* Establece el estado de un curso como "Válido" */

/* Conexión */
include_once 'conexion.php';

/* Recepción de datos */
$idc = mysqli_real_escape_string($conn,$_POST['idc']);
$val = mysqli_real_escape_string($conn,$_POST['val']);

/* Array de respuesta */
$response = [];

/* SQL */
$sql =  "UPDATE curso
         SET validado = '$val'
         WHERE idCurso = $idc";

/* Ejecución de la consulta */
if(mysqli_query($conn,$sql)) {
    $response['status'] = 'ok';
} else {
    $response['status'] = 'error '.mysqli_error($conn);
}

/* Imprimir respuesta en formato JSON */
echo json_encode($response,true);