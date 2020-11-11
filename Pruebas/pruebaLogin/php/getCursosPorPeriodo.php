<?php

include_once 'conexion.php';

if (!isset($_POST)) {
    die();
}

$periodo = mysqli_real_escape_string($conn, $_POST['periodo']);


$formatt = "SET lc_time_names = 'es_MX' ";
mysqli_query($conn,$formatt);

$sql = "SELECT curso.idCurso,
            concat_ws(' ',instructor.apellidoPaterno,instructor.apellidomaterno,instructor.nombreInstructor) as maestro,
            curso.nombreCurso as curso,
            curso.objetivo,
            concat_ws(' - ', DATE_FORMAT(curso.fechaInicio, '%d de %M'), DATE_FORMAT(curso.fechaFin, '%d de %M, %Y')) as fecha,
            concat_ws(' a ',curso.horaInicio,curso.horaFin) as horario,
            curso.validado,
            curso.periodo
    FROM instructor Inner join curso
    ON curso.Instructor_idInstructor=instructor.idInstructor 
    AND curso.periodo = '$periodo'";

$result = $conn->query($sql) or die($conn->error . __LINE__);

$arr = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $arr[] = $row;
    }
}

echo json_encode($arr);
