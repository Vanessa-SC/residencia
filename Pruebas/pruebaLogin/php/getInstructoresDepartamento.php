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
// SQL de consulta
$sql = "SELECT 
        instructor.idInstructor,
        concat_ws(' ',instructor.apellidoPaterno,instructor.apellidoMaterno,instructor.nombre) as nombre,
        instructor.RFC, instructor.CURP, DATE_FORMAT(instructor.fechaNacimiento, '%d-%M-%Y') as fechaNacimiento, 
        instructor.telefono, instructor.Correo, instructor.personal,
        usuario.horas, usuario.perfilDeseable, usuario.activo, usuario.funcionAdministrativa, usuario.nivel
        FROM instructor 
        Inner join usuario
        ON instructor.idUsuario = usuario.idUsuario
        AND usuario.Departamento_idDepartamento = '$id' 
        OR (usuario.idUsuario=instructor.idUsuario and usuario.Departamento_idDepartamento = 1)        
        ORDER BY instructor.apellidoPaterno ASC 
        ";
        /*!- El ID 1 corresponde al departamento "No asignado" */

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
