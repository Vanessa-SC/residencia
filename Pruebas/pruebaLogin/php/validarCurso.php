<?php

/* Establece el estado de un curso como "Válido" */

/* Conexion */
include_once 'conexion.php';

/* Recepcion de datos */
$idc = mysqli_real_escape_string($conn,$_POST['idc']);
$val = mysqli_real_escape_string($conn,$_POST['val']);

/* Array de respuesta */
$response = [];

/* SQL */
$sql =  "UPDATE curso
         SET validado = '$val'
         WHERE idCurso = $idc";


if(mysqli_query($conn,$sql)) {
    $response['status'] = 'ok';
} else {
    $response['status'] = 'error '.mysqli_error($conn);
}

echo json_encode($response,true);