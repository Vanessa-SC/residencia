<?php

// Conexión a la BD
include_once 'conexion.php';

// Formato de idioma para las fechas
$formatt = "SET lc_time_names = 'es_MX' ";
mysqli_query($conn,$formatt);

// Recibe el ID de la evaluación
$idEvaluacion = $_POST['idEvaluacion'];

// Consulta SQL
$sql = "SELECT * 
		FROM evaluacion, evaluacion_has_pregunta, pregunta
		WHERE evaluacion.idEvaluacion = evaluacion_has_pregunta.Evaluacion_idEvaluacion
		AND pregunta.idPregunta = evaluacion_has_pregunta.Pregunta_idPregunta
		AND evaluacion.idEvaluacion = $idEvaluacion";

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
