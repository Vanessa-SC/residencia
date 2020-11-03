<?php

include_once 'conexion.php';

if (!isset($_POST)) {
    die();
}

$id = mysqli_real_escape_string($conn, $_POST[3]);

$sql = "SELECT curso.idCurso, curso.nombreCurso as curso, curso.objetivo, concat_ws(' al ',curso.fechaInicio,curso.fechaFin) as fecha, curso.horario,curso.lugar,curso.duracion,curso.destinatarios, curso.validado
    FROM usuario_has_curso Inner join curso
    ON usuario_has_curso.Curso_idCurso=curso.idCurso
    AND usuario_has_curso.Usuario_idUsuario = $id ";

$result = $conn->query($sql) or die($conn->error . __LINE__);

$curso = mysqli_fetch_all($result, MYSQLI_ASSOC);

echo json_encode($curso[0]);