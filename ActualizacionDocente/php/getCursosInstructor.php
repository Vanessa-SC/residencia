<?php

/* Obtiene los cursos que han sido asignados a un Instructor */

// Conexión
include_once 'conexion.php';
// Se reciben datos POST?
if (!isset($_POST)) {
    die();
}
// Asignación de variables
$id = mysqli_real_escape_string($conn, $_POST['idUsuario']);
// Formato de fechas en español
$formatt = "SET lc_time_names = 'es_MX' ";
mysqli_query($conn,$formatt);
// Obtiene la fecha
$mes = date('m');
$año = date('Y');
$dia = date('d');

// SQL de consulta
$sql = "SELECT curso.idCurso, curso.nombreCurso AS curso, 
        curso.objetivo, curso.Instructor_idInstructor, curso.periodo,
        concat_ws(' - ', DATE_FORMAT(curso.fechaInicio, '%d de %M'), DATE_FORMAT(curso.fechaFin, '%d de %M, %Y')) AS fecha, 
        concat_ws(' - ',curso.horaInicio,curso.horaFin) AS horario, 
        curso.lugar,curso.duracion,curso.destinatarios, curso.validado
        FROM instructor INNER JOIN curso 
        ON curso.Instructor_idInstructor = instructor.idInstructor
        INNER JOIN usuario
        ON usuario.idUsuario = instructor.idUsuario
        WHERE usuario.idUsuario = $id
        AND YEAR(curso.fechaFin) = $año
        AND MONTH(curso.fechaFin) <= $mes
        AND DAY(curso.fechaFin) <= $dia
        ORDER BY fechaInicio ASC
        ";
// Validación de ejecución de la consulta
$result = $conn->query($sql) or die($conn->error . __LINE__);
// Guardado de resultados en un array
$curso = mysqli_fetch_all($result, MYSQLI_ASSOC);
// Impresión de resultados
echo json_encode($curso);