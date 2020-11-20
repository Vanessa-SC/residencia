<?php

include_once 'conexion.php';

if (!isset($_POST)) {
    die();
}

$id = mysqli_real_escape_string($conn, $_POST['idCurso']);

$sql = "SELECT curso.idCurso, curso.Folio, curso.ClaveRegistro, 
concat_ws(' ',instructor.apellidoPaterno,instructor.apellidomaterno,instructor.nombre) as maestro, curso.nombreCurso as curso, 
curso.periodo, curso.duracion, curso.horaInicio, curso.horaFin, curso.fechaInicio, curso.fechaFin, curso.modalidad, curso.lugar, curso.destinatarios,
curso.objetivo, curso.observaciones
    FROM instructor Inner join curso
    ON curso.Instructor_idInstructor=instructor.idInstructor
    AND curso.idCurso = $id ";

$result = $conn->query($sql) or die($conn->error . __LINE__);

$curso = mysqli_fetch_all($result, MYSQLI_ASSOC);

echo json_encode($curso[0]);
