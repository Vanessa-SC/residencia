<?php

/* Obtiene las fechas en las que está activa una encuesta */

// Conexión
include_once 'conexion.php';

// Asignación de variables
$idEncuesta = mysqli_real_escape_string($conn, $_POST['ide']);
$idCurso = mysqli_real_escape_string($conn, $_POST['idc']);
$res = [];

date_default_timezone_set('America/Mexico_City');
$hoy = date('Y-m-d');
// SQL de consulta
$sql = "SELECT c.idCurso,ea.fechaInicio,ea.fechaFin,ea.idEncuesta
        FROM encuesta_is_activa ea,curso_has_encuesta ce,curso c
        WHERE ea.idEncuesta = $idEncuesta
        AND ea.fechaFin >= '$hoy'
        AND ce.curso_idCurso = $idCurso
        AND ea.idEncuesta = ce.encuesta_idEncuesta
        AND ce.curso_idCurso = c.idCurso
        and ea.periodo = c.periodo";

// Validación de ejecución de la consulta
$result = $conn->query($sql) or die($conn->error . __LINE__);

// Verificar si hubo resultados o no
if (mysqli_num_rows($result) > 0) {
    $res['status'] = 'on time';
} else {
    $res['status'] = 'out of date';
}

echo json_encode($res, true);
