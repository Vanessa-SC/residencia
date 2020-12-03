<?php

include_once 'conexion.php';

$formatt = "SET lc_time_names = 'es_MX' ";
mysqli_query($conn,$formatt);

$ide = $_POST['ide'];

$sql = "SELECT pregunta.descripcion as pregunta , pregunta.idPregunta as id
        FROM encuesta,encuesta_has_pregunta, pregunta 
        WHERE encuesta.idEncuesta = encuesta_has_pregunta.Encuesta_idEncuesta 
        AND pregunta.idPregunta = encuesta_has_pregunta.Pregunta_idPregunta 
        AND encuesta.idEncuesta = $ide";

$result = $conn->query($sql) or die($conn->error . __LINE__);

$arr = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $arr[] = $row;
    }
}

echo json_encode($arr);