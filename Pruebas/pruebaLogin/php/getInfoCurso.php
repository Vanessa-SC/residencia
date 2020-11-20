<?php

include_once 'conexion.php';

if (!isset($_POST)) {
    die();
}

$formatt = "SET lc_time_names = 'es_MX' ";
mysqli_query($conn,$formatt);

$id = mysqli_real_escape_string($conn, $_POST['idCurso']);

$sql = "SELECT curso.idCurso, 
            concat_ws(' ',instructor.apellidoPaterno,instructor.apellidomaterno,instructor.nombre) as maestro, 
            curso.nombreCurso as curso, 
            curso.objetivo, 
            concat_ws(' - ', DATE_FORMAT(curso.fechaInicio, '%d de %M'), DATE_FORMAT(curso.fechaFin, '%d de %M, %Y')) as fecha,
            concat_ws(' - ',curso.horaInicio,curso.horaFin) as horario, 
            curso.lugar,
            curso.duracion,
            curso.destinatarios, 
            curso.validado
    FROM instructor Inner join curso
    ON curso.Instructor_idInstructor=instructor.idInstructor
    AND curso.idCurso = $id ";

$result = $conn->query($sql) or die($conn->error . __LINE__);

$curso = mysqli_fetch_all($result, MYSQLI_ASSOC);

echo json_encode($curso[0]);
