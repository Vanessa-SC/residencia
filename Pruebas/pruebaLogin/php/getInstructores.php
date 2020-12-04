<?php 

include_once 'conexion.php';

$formatt = "SET lc_time_names = 'es_MX' ";
mysqli_query($conn,$formatt);

$sql = "SELECT 
    instructor.idInstructor, instructor.apellidoPaterno, instructor.apellidomaterno, 
    instructor.nombre, 
    concat_ws(' ',instructor.apellidoPaterno,instructor.apellidomaterno,instructor.nombre) as nombre,
    instructor.RFC, instructor.CURP, DATE_FORMAT(instructor.fechaNacimiento, '%d-%M-%Y') as fechaNacimiento, 
    instructor.telefono, instructor.Correo, 
    usuario.horas, usuario.perfilDeseable, usuario.activo, usuario.funcionAdministrativa, usuario.nivel
    FROM instructor 
    Inner join usuario
    ON instructor.idUsuario = usuario.idUsuario
    ORDER BY apellidoPaterno ASC 
";

$result = $conn->query($sql) or die($conn->error . __LINE__);

$arr = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $arr[] = $row;
    }
}

echo json_encode($arr);