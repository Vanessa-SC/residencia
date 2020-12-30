<?php

/* Verifica si ya se ha registrado la asistencia del día de hoy en un curso */

/* Conexión a la BD */
include_once 'conexion.php';

/* Validar que se estén recibiendo datos */
if(!isset($_POST)) die();

/* Recepción de variables POST */
$idCurso = mysqli_real_escape_string($conn,$_POST['idc']);

/* Array que almacenará resultados */
$response = [];

// Zona horaria y obtención de fecha actual
date_default_timezone_set('America/Mexico_City');
$fecha = date('Y-m-d');

/* Consulta SQL */
$query  = "SELECT * 
            FROM asistencia 
            WHERE Curso_idCurso = $idCurso 
            AND fecha LIKE '$fecha%'";

// Ejecución de la consulta
$result = $conn->query($query) or die($conn->error . __LINE__);

if( mysqli_num_rows($result) > 0 ){
    $response['status'] = 'existe';
} else {
    $response['status'] = 'no existe';
}

/* Imprimir respuesta en formato JSON */
echo json_encode($response, true);
