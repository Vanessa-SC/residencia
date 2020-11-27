<?php

include_once 'conexion.php';

$formatt = "SET lc_time_names = 'es_MX' ";
mysqli_query($conn,$formatt);

$idEvaluacion = $_POST['idEvaluacion'];

$sql = "SELECT * 
		FROM evaluacion, evaluacion_has_pregunta, pregunta
		WHERE evaluacion.idEvaluacion = evaluacion_has_pregunta.Evaluacion_idEvaluacion
		AND pregunta.idPregunta = evaluacion_has_pregunta.Pregunta_idPregunta
		AND evaluacion.idEvaluacion = $idEvaluacion";

$result = $conn->query($sql) or die($conn->error . __LINE__);

$arr = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $arr[] = $row;
    }
}

echo json_encode($arr);
