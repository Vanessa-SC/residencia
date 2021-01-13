<?php

/* Obtiene las fechas en las que está activa una encuesta */

// Conexión
include_once 'conexion.php';

// Asignación de variables
$idEncuesta = mysqli_real_escape_string($conn, $_POST['ide']);

// SQL de consulta
$sql = "SELECT *
        FROM encuesta_has_activa
        WHERE idEncuesta = $idEncuesta";

// Validación de ejecución de la consulta
$result = $conn->query($sql) or die($conn->error . __LINE__);

// Asociación de resultados en una variable
$encuesta = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Impresión de resultados
echo json_encode($encuesta[0],true);
