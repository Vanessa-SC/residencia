<?php

/* Obtiene el listado de los cursos y se muestran en el Programa del Coordinador */

// Conexión
include_once 'conexion.php';
// Formato de fechas en español
$formatt = "SET lc_time_names = 'es_MX' ";
mysqli_query($conn,$formatt);

// Obtiene el periodo actual
$mes = date('n');
$año = date('Y');

if ( $mes <= 6 ){
    $periodo = 'Enero / Junio ' . $año;
} else {
    $periodo = 'Agosto / Diciembre ' . $año;
}

// Zona horaria y obtención de la fecha
date_default_timezone_set('America/Mexico_City');
$fecha = date('Y-m-d');


// SQL de consulta
$sql = "SELECT curso.idCurso,
            concat_ws(' ',instructor.apellidoPaterno,instructor.apellidomaterno,instructor.nombre) as maestro,
            curso.nombreCurso as curso,
            curso.objetivo,
            concat_ws(' - ', DATE_FORMAT(curso.fechaInicio, '%d de %M'), DATE_FORMAT(curso.fechaFin, '%d de %M, %Y')) as fecha,
            concat_ws(' a ',curso.horaInicio,curso.horaFin) as horario,
            curso.validado
    FROM instructor Inner join curso
    ON curso.Instructor_idInstructor=instructor.idInstructor 
    WHERE curso.periodo LIKE '$periodo%'
    AND YEAR(curso.fechaFin) = $año";
// Validación de resultados de ejecución
$result = $conn->query($sql) or die($conn->error . __LINE__);
// Array de resultados
$arr = array();
// Si hay resultados se guardan en una variable
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $arr[] = $row;
    }
}
// Impresión de resultados
echo json_encode($arr,true);
