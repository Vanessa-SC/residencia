<?php

include_once 'conexion.php';

if (!isset($_POST)) {
    die();
}

$id = mysqli_real_escape_string($conn, $_POST['idUsuario']);

$sql = "SELECT curso.idCurso, curso.nombreCurso as curso, 
        curso.objetivo, concat_ws(' ',curso.fechaInicio,curso.fechaFin) as fecha, curso.horario, 
        curso.lugar,curso.duracion,curso.destinatarios, curso.validado
        FROM usuario_has_curso Inner join curso 
        ON curso.idCurso = usuario_has_curso.Curso_idCurso 
        AND usuario_has_curso.Usuario_idUsuario = $id ";

/* ESTA ERA LA ALTERNATIVA, NO HAGAN CASO */
// $username = mysqli_real_escape_string($conn, $_POST['username']);
// $sql = "SELECT curso.idCurso, curso.nombreCurso as curso, 
//         curso.objetivo, concat_ws(' ',curso.fechaInicio,curso.fechaFin) as fecha, curso.horario, 
//         curso.lugar,curso.duracion,curso.destinatarios, curso.validado
//         FROM usuario_has_curso,curso,usuario
//         WHERE curso.idCurso = usuario_has_curso.Curso_idCurso 
//         AND usuario_has_curso.Usuario_idUsuario = usuario.idUsuario
//         AND usuario.nombreUsuario = $username";

$result = $conn->query($sql) or die($conn->error . __LINE__);

$curso = mysqli_fetch_all($result, MYSQLI_ASSOC);

echo json_encode($curso);