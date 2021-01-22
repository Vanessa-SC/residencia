<?php

/* Verifica si un documento de un curso está validado */


/* Validar que se estén recibiendo datos */
if(!isset($_POST)) die();

/* Conexión a la BD */
include_once 'conexion.php';

/* Recepción de variables POST */
$idd = mysqli_real_escape_string($conn, $_POST['idd']);
$validado = mysqli_real_escape_string($conn, $_POST['validado']);
$idc = mysqli_real_escape_string($conn, $_POST['idc']);

/* Array que almacenará resultados */
$response = [];

/* Consulta SQL */
$sql = "UPDATE curso_has_documento
        SET estadoVerificado = '".$validado."'
        WHERE Curso_idCurso = ".$idc."
        AND Documento_idDocumento = ".$idd;

/* Ejecución de la consulta */
if(mysqli_query($conn,$sql)){
    $sqli = "UPDATE curso_has_documento set comentario = null WHERE Curso_idCurso = $idc AND Documento_idDocumento = $idd ";
    $response['sql'] = $sqli;
    mysqli_query($conn,$sqli);
    $response['status'] = 'ok';
} else {
    $response['status'] = 'error: '.mysqli_error($conn);
}

/* Imprimir respuesta en formato JSON */
echo json_encode($response,true);