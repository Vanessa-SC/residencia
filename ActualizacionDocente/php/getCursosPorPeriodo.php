<?php

/* Obtiene los cursos impartidos durante un periodo determinado */

// Conexión
include_once 'conexion.php';

// ¿Se reciben datos POST?
if (!isset($_POST)) {
    die();
}
// Asignación de variables
$periodo = mysqli_real_escape_string($conn, $_POST['periodo']);

// Formato de fechas en español
$formatt = "SET lc_time_names = 'es_MX' ";
mysqli_query($conn,$formatt);

// SQL de consulta
$sql = "SELECT curso.idCurso,
            curso.folio,
            concat_ws(' ',instructor.apellidoPaterno,instructor.apellidomaterno,instructor.nombre) as maestro,
            curso.nombreCurso as curso,
            curso.objetivo,
            curso.duracion,
            concat_ws(' - ', DATE_FORMAT(curso.fechaInicio, '%d de %M'), DATE_FORMAT(curso.fechaFin, '%d de %M, %Y')) as fecha,
            DATE_FORMAT(curso.fechaFin, '%d de %M del %Y') as fechaFin,
            concat_ws(' a ',curso.horaInicio,curso.horaFin) as horario,
            curso.validado,
            curso.periodo
        FROM instructor Inner join curso
        ON curso.Instructor_idInstructor=instructor.idInstructor 
        AND curso.periodo = '$periodo'";

// Validación de ejecución de la consulta
$result = $conn->query($sql) or die($conn->error . __LINE__);

// Array de resultado
$arr = array();

// Si hay resultados se guardan en el array
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $arr[] = $row;
    }
}

// Impresión del array
echo json_encode($arr);
