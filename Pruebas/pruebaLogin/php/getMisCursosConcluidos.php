<?php

include_once 'conexion.php';

if (!isset($_POST)) {
    die();
}

$id = mysqli_real_escape_string($conn, $_POST['idUsuario']);

$formatt = "SET lc_time_names = 'es_MX' ";
mysqli_query($conn,$formatt);

$sql = "SELECT curso.idCurso, curso.nombreCurso as curso, 
        curso.objetivo, 
        concat_ws(' - ', DATE_FORMAT(curso.fechaInicio, '%d de %M'), DATE_FORMAT(curso.fechaFin, '%d de %M, %Y')) as fecha, 
        concat_ws(' - ',curso.horaInicio,curso.horaFin) as horario, 
        curso.lugar,curso.duracion,curso.destinatarios, curso.validado
        FROM usuario_has_curso Inner join curso 
        ON curso.idCurso = usuario_has_curso.Curso_idCurso 
        AND usuario_has_curso.estado = 0
        AND usuario_has_curso.Usuario_idUsuario = $id";

$result = $conn->query($sql) or die($conn->error . __LINE__);

$curso = mysqli_fetch_all($result, MYSQLI_ASSOC);

echo json_encode($curso);