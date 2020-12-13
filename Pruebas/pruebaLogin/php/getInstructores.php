<?php 

/* Obtiene el listado de los datos de los instructores */

// Conexión y formato de fecha en español
include_once 'conexion.php';
$formatt = "SET lc_time_names = 'es_MX' ";
mysqli_query($conn,$formatt);

// Consulta, ejecución y asociación de resultados
$sql = "SELECT 
    instructor.idInstructor,
    concat_ws(' ',instructor.apellidoPaterno,instructor.apellidoMaterno,instructor.nombre) as nombre,
    instructor.RFC, instructor.CURP, DATE_FORMAT(instructor.fechaNacimiento, '%d-%M-%Y') as fechaNacimiento, 
    instructor.telefono, instructor.Correo, 
    usuario.horas, usuario.perfilDeseable, usuario.activo, usuario.funcionAdministrativa, usuario.nivel
    FROM instructor 
    Inner join usuario
    ON instructor.idUsuario = usuario.idUsuario
    ORDER BY instructor.apellidoPaterno ASC 
";

// Validación de ejecución de consulta
$result = $conn->query($sql) or die($conn->error . __LINE__);

// Declaración del array que contendrá los resultados de la consulta
$arr = array();

// Si hay resultados...
if ($result->num_rows > 0) {

    // Guardamos los resultados en el array
    while ($row = $result->fetch_assoc()) {
        $arr[] = $row;
    }
}

// Impresión de resultados
echo json_encode($arr);