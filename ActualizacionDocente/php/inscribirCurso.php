<?php

/* Incribir un docente a un curso */

// Conexión, recepción de datos y declaracion de variables
include_once 'conexion.php';
if (!isset($_POST)) {
    die();
}

$response = [];

$idUsuario = mysqli_real_escape_string($conn, $_POST['idUsuario']);
$idCurso = mysqli_real_escape_string($conn, $_POST['idCurso']);

/* Verifica si no está incrito previamente al curso */
$result = $conn->query("SELECT * FROM usuario_has_curso
WHERE Usuario_idUsuario = $idUsuario AND Curso_idCurso = $idCurso AND estado = 1");

/* Determinar el número de filas del resultado */
$row_cnt = $result->num_rows;
if ($row_cnt > 0) {
    $response['status'] = 'Ya se ha inscrito a este curso.';
} else {

    /** Verificar que no se inscriba a cursos a la misma hora */

    //Obtener datos del nuevo curso
    $sqlCurso = "SELECT c.idCurso, c.horaInicio, c.horaFin, c.fechaInicio, c.fechaFin
                FROM curso c
                WHERE idCurso = $idCurso";

    $curso = mysqli_fetch_all(mysqli_query($conn, $sqlCurso), MYSQLI_ASSOC);
    $fi = $curso[0]['fechaInicio'];
    $ff = $curso[0]['fechaFin'];
    $hi = $curso[0]['horaInicio'];
    $hf = $curso[0]['horaInicio'];

    //Obtener cursos a los que está inscrito que coincidan con el horario o fecha del nuevo curso
    $sqlCursosInscritos = "SELECT c.idCurso, c.horaInicio, c.horaFin, c.fechaInicio, c.fechaFin
                            FROM usuario_has_curso uc , curso c
                            WHERE uc.usuario_idUsuario = 6
                                AND uc.Curso_idCurso = c.idCurso
                                AND c.fechaInicio between '$fi' and '$ff'
                                AND c.horaInicio between '$hi' AND '$hf'
                            OR ( uc.usuario_idUsuario = 6
                                AND uc.Curso_idCurso = c.idCurso
                                AND c.fechaInicio between '$fi' and '$ff'
                                AND c.horaInicio between '$hi' AND '$hf' )";

    $r = mysqli_query($conn, $sqlCursosInscritos);
    $resultado = mysqli_fetch_all($r, MYSQLI_ASSOC);
    $num_rows = mysqli_num_rows($r);

    if ($num_rows >= 1) {
        $response['status'] = 'Ya se inscribió a un curso a esa hora.';
    } else {
        // Realiza la inscripción al curso
        $query = "INSERT INTO usuario_has_curso VALUES ('$idUsuario', '$idCurso', '1')";
        // ¿Se ejecutó correctamente?
        if (mysqli_query($conn, $query)) {
            $response['status'] = 'ok';
        } else {
            $response['status'] = 'Error';
        }
    }
}
// Respuesta
echo json_encode($response);
