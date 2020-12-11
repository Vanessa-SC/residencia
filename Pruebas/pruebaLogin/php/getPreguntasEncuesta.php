<?php

/* Obtiene las preguntas de una encuesta */

// Conexión a la BD
include_once 'conexion.php';

// Formato de idioma para las fechas
$formatt = "SET lc_time_names = 'es_MX' ";
mysqli_query($conn,$formatt);

// Recibe el ID de la encuesta
$ide = $_POST['ide'];

// Consulta SQL
$sql = "SELECT pregunta.descripcion as pregunta , pregunta.idPregunta as id
        FROM encuesta,encuesta_has_pregunta, pregunta 
        WHERE encuesta.idEncuesta = encuesta_has_pregunta.Encuesta_idEncuesta 
        AND pregunta.idPregunta = encuesta_has_pregunta.Pregunta_idPregunta 
        AND encuesta.idEncuesta = $ide";

// Validación de ejecución de consulta
$result = $conn->query($sql) or die($conn->error . __LINE__);

// Declaración del array que contendrá los resultados de la consulta
$arr = array();

// Si hay resultados...
if ($result->num_rows > 0) {

    // Guardamos los resultados en el array
    while ($row = $result->fetch_assoc()) {
        $arr[] = $row;
    }
}

// Impresión de resultados
echo json_encode($arr);