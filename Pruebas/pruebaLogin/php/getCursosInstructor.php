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
// Query de consulta
$sql = "SELECT curso.idCurso, curso.nombreCurso as curso, 
        curso.objetivo, curso.Instructor_idInstructor,
        concat_ws(' - ', DATE_FORMAT(curso.fechaInicio, '%d de %M'), DATE_FORMAT(curso.fechaFin, '%d de %M, %Y')) as fecha, 
        concat_ws(' - ',curso.horaInicio,curso.horaFin) as horario, 
        curso.lugar,curso.duracion,curso.destinatarios, curso.validado
        FROM instructor Inner join curso 
        ON curso.Instructor_idInstructor = instructor.idInstructor
        Inner join usuario
        ON usuario.idUsuario = instructor.idUsuario
        AND usuario.idUsuario = $id
        ORDER BY fechaInicio ASC
        ";
// Validación de ejecución de la consulta
$result = $conn->query($sql) or die($conn->error . __LINE__);
// Guardado de resultados en un array
$curso = mysqli_fetch_all($result, MYSQLI_ASSOC);
// Impresión de resultados
echo json_encode($curso);