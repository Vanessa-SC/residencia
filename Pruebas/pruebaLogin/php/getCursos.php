<?php

include_once 'conexion.php';

$sql = "SELECT curso.idCurso, instructor.nombreInstructor as maestro, 
curso.nombreCurso as curso, curso.objetivo, concat_ws(' al ',curso.fechaInicio,curso.fechaFin) as fecha, 
concat_ws(' - ',curso.horaInicio,curso.horaFin) as horario, curso.lugar, curso.duracion,curso.destinatarios, curso.validado
			FROM instructor Inner join curso
			ON curso.Instructor_idInstructor=instructor.idInstructor ";

$result = $conn->query($sql) or die($conn->error . __LINE__);

$arr = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $arr[] = $row;
    }
}

echo json_encode($arr);