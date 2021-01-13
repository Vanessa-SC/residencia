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
$sql =  "SELECT idCurso,
                nombreCurso as curso,
                periodo,
                concat_ws(' - ', DATE_FORMAT(fechaInicio, '%d/%M/%Y'), DATE_FORMAT(fechaFin, '%d/%M/%Y')) as fecha,
                concat_ws(' a ',horaInicio,horaFin) as horario
        FROM curso
        WHERE Departamento_idDepartamento = $id 
        OR ( Departamento_idDepartamento = 5)";
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
