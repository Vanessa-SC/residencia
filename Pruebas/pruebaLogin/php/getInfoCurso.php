<?php

include_once 'conexion.php';

if (!isset($_POST)) {
    die();
}

$id = mysqli_real_escape_string($conn, $_POST['idCurso']);

$sql = "SELECT curso.idCurso, instructor.nombreInstructor as maestro, curso.nombreCurso as curso, curso.objetivo, concat_ws(' al ',curso.fechaInicio,curso.fechaFin) as fecha, curso.horario,curso.lugar,curso.duracion,curso.destinatarios, curso.validado
    FROM instructor Inner join curso
    ON curso.Instructor_idInstructor=instructor.idInstructor
    AND curso.idCurso = $id ";

$result = $conn->query($sql) or die($conn->error . __LINE__);

$curso = mysqli_fetch_all($result, MYSQLI_ASSOC);

echo json_encode($curso[0]);
