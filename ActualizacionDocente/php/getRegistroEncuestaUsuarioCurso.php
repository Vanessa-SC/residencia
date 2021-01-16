<?php

/* Verifica si un docente ya ha respondido una encuesta de un curso */

/* Validar que se estén recibiendo datos */
if(!isset($_POST)) die();

/* Conexión a la BD */
include_once 'conexion.php';

/* Recepción de variables POST */
$idCurso = mysqli_real_escape_string($conn,$_POST['idc']);
$idUsuario = mysqli_real_escape_string($conn,$_POST['idu']);
$idEncuesta = mysqli_real_escape_string($conn,$_POST['ide']);

/* Array que almacenará resultados */
$response = [];

/* Consulta SQL */
$query = "SELECT * 
        FROM usuario_responde_encuesta
        WHERE usuario_responde_encuesta.Usuario_idUsuario = $idUsuario
        AND usuario_responde_encuesta.Curso_idCurso = $idCurso
        AND usuario_responde_encuesta.Encuesta_idEncuesta = $idEncuesta";

/* Ejecución de la consulta */
$result = $conn->query($query) or die($conn->error . __LINE__);

if( mysqli_num_rows($result) > 0 ){
    $response['status'] = 'contestada';
} else {
    $response['status'] = 'no contestada';
}

/* Imprimir respuesta en formato JSON */
echo json_encode($response, true);
