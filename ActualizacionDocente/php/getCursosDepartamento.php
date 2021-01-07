<?php
/* Obtiene los cursos filtrados por departamento para Jefe */

// Conexión
include_once 'conexion.php';
// Se reciben datos POST?
if (!isset($_POST)) {
    die();
}
// Asignación de variables
$id = mysqli_real_escape_string($conn, $_POST['idDepartamento']);

// Formato español para la fecha
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
        AND curso.Departamento_idDepartamento = '$id' 
        AND curso.periodo LIKE '$periodo%'
        AND YEAR(curso.fechaInicio) = $año
        OR (curso.Instructor_idInstructor=instructor.idInstructor 
            AND curso.Departamento_idDepartamento = 5
            AND curso.periodo LIKE '$periodo%'
            AND YEAR(curso.fechaFin) = $año)";
        /*!- El ID 5 corresponde al departamento "Todos los Departamentos" */

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
// Impresión de resultados
echo json_encode($arr,true);
