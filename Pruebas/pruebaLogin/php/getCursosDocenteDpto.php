<?php

/* Obtiene los datos del curso correspondientes al departamento del Docente y dirigidos a todos los departamentos */

// Conexión
include_once 'conexion.php';
// recibe datos POST?
if (!isset($_POST)) {
    die();
}
// Asignación de variables
$id = mysqli_real_escape_string($conn, $_POST['idDepartamento']);

/* Obtener ID del departamento "Todos los Departamentos" */
$sqlGetDpto= "SELECT idDepartamento
                FROM departamento
                WHERE nombreDepartamento='Todos los Departamentos'";

$res = mysqli_query($conn, $sqlGetDpto);
$dpto= mysqli_fetch_row ($res);

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
        FROM instructor 
        Inner join curso
        ON curso.Instructor_idInstructor=instructor.idInstructor     
        AND curso.Departamento_idDepartamento = '$id' 
        UNION 
        SELECT curso.idCurso,
                concat_ws(' ',instructor.apellidoPaterno,instructor.apellidomaterno,instructor.nombre) as maestro,
                curso.nombreCurso as curso,
                curso.objetivo,
                concat_ws(' - ', DATE_FORMAT(curso.fechaInicio, '%d de %M'), DATE_FORMAT(curso.fechaFin, '%d de %M, %Y')) as fecha,
                concat_ws(' a ',curso.horaInicio,curso.horaFin) as horario,
                curso.validado
        FROM instructor 
        Inner join curso
        ON curso.Instructor_idInstructor=instructor.idInstructor     
        AND curso.Departamento_idDepartamento = '$dpto[0]' 
        ";

// Validación de ejecución de la consulta
$result = $conn->query($sql) or die($conn->error . __LINE__);
// Array de respuesta
$arr = array();
// Si hay resultados se almacenan en el array
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $arr[] = $row;
    }
}
// Impresión del array
echo json_encode($arr, true);
