<?php

/* Obtiene el listado de los cursos y se muestran en el Programa del Coordinador */

// conexion
include_once 'conexion.php';
// Formato de fechas en español
$formatt = "SET lc_time_names = 'es_MX' ";
mysqli_query($conn,$formatt);
// Query de consulta
$sql = "SELECT curso.idCurso,
            concat_ws(' ',instructor.apellidoPaterno,instructor.apellidomaterno,instructor.nombre) as maestro,
            curso.nombreCurso as curso,
            curso.objetivo,
            concat_ws(' - ', DATE_FORMAT(curso.fechaInicio, '%d de %M'), DATE_FORMAT(curso.fechaFin, '%d de %M, %Y')) as fecha,
            concat_ws(' a ',curso.horaInicio,curso.horaFin) as horario,
            curso.validado
    FROM instructor Inner join curso
    ON curso.Instructor_idInstructor=instructor.idInstructor ";
// validacion de resultados de ejecucion
$result = $conn->query($sql) or die($conn->error . __LINE__);
// array de resultados
$arr = array();
// si hay resultados se guardan en una variable
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $arr[] = $row;
    }
}
// impresion de resultados
echo json_encode($arr,true);
