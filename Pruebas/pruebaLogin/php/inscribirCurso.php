<?php

/* Incribir un docente a un curso */

include_once 'conexion.php';
if (!isset($_POST))    die();

$response = [];

$idUsuario = mysqli_real_escape_string($conn, $_POST['idUsuario']);
$idCurso = mysqli_real_escape_string($conn, $_POST['idCurso']);

/* Verifica si no está incrito previamente al curso */
$result = $conn->query("SELECT * FROM usuario_has_curso
WHERE Usuario_idUsuario = $idUsuario AND Curso_idCurso = $idCurso AND estado = 1");

$row_cnt = $result->num_rows;
if ($row_cnt > 0) {
    $response['status'] = 'Ya existe';
} else {
    // Realiza la inscripción al curso
    $query = "INSERT INTO usuario_has_curso VALUES ('$idUsuario', '$idCurso', '1')";
    if (mysqli_query($conn, $query)) {
        $response['status'] = 'ok';
    } else {
        $response['status'] = 'Error';
    }
}
echo json_encode($response);
