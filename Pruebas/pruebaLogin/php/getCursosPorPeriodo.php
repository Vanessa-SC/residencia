<?php

/* Obtiene los cursos impartidos durante un periodo determinado */

// conexion
include_once 'conexion.php';

// se reciben datos POST?
if (!isset($_POST)) {
    die();
}
// asignacion de variables
$periodo = mysqli_real_escape_string($conn, $_POST['periodo']);

// Formato de fechas en español
$formatt = "SET lc_time_names = 'es_MX' ";
mysqli_query($conn,$formatt);

// Query de consulta
$sql = "SELECT curso.idCurso,
            concat_ws(' ',instructor.apellidoPaterno,instructor.apellidomaterno,instructor.nombre) as maestro,
            curso.nombreCurso as curso,
            curso.objetivo,
            curso.duracion,
            concat_ws(' - ', DATE_FORMAT(curso.fechaInicio, '%d de %M'), DATE_FORMAT(curso.fechaFin, '%d de %M, %Y')) as fecha,
            concat_ws(' a ',curso.horaInicio,curso.horaFin) as horario,
            curso.validado,
            curso.periodo
        FROM instructor Inner join curso
        ON curso.Instructor_idInstructor=instructor.idInstructor 
        AND curso.periodo = '$periodo'";

// validacion de ejecucion de la consulta
$result = $conn->query($sql) or die($conn->error . __LINE__);

// array de resultado
$arr = array();

// si hay resultados se guardan en el array
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $arr[] = $row;
    }
}

// impresion del array
echo json_encode($arr);
