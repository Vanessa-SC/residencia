<?php

include_once 'conexion.php';

if (!isset($_POST)) {
    die();
}

$id = mysqli_real_escape_string($conn, $_POST['idUsuario']);

$formatt = "SET lc_time_names = 'es_MX' ";
mysqli_query($conn,$formatt);

$sql = "SELECT curso.idCurso, curso.nombreCurso as curso, 
        curso.objetivo, curso.Instructor_idInstructor,
        concat_ws(' - ', DATE_FORMAT(curso.fechaInicio, '%d de %M'), DATE_FORMAT(curso.fechaFin, '%d de %M, %Y')) as fecha, 
        concat_ws(' - ',curso.horaInicio,curso.horaFin) as horario, 
        curso.lugar,curso.duracion,curso.destinatarios, curso.validado
        FROM instructor Inner join curso 
        ON curso.Instructor_idInstructor = instructor.idInstructor
        Inner join usuario
<<<<<<< HEAD
        ON usuario.idUsuario = instructor.idInstructor
=======
        ON usuario.idUsuario = instructor.idUsuario
>>>>>>> 3a05ba65cd804c6a541ecb63a1864393b79abc24
        AND usuario.idUsuario = $id
        ORDER BY fechaInicio ASC
        ";

$result = $conn->query($sql) or die($conn->error . __LINE__);

$curso = mysqli_fetch_all($result, MYSQLI_ASSOC);

echo json_encode($curso);