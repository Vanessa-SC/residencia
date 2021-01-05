<?php

/** Obtener listado de encuestas */

//Conexión 
include_once 'conexion.php';

// Query
$sql = "SELECT idEncuesta, tipoEncuesta, nombreEncuesta 
        FROM encuesta";

$result = $conn->query($sql) or die($conn->error . __LINE__);
$data = mysqli_fetch_all($result, MYSQLI_ASSOC);


echo json_encode($data, true);
