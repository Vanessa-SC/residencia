<?php 

include_once 'conexion.php';

$formatt = "SET lc_time_names = 'es_MX' ";
mysqli_query($conn,$formatt);

$sql = "SELECT idInstructor, apellidoPaterno, apellidomaterno, nombre, 
concat_ws(' ',apellidoPaterno,apellidomaterno,nombre) as nombre,
RFC, CURP, DATE_FORMAT(fechaNacimiento, '%d-%M-%Y') as fechaNacimiento, telefono, Correo 
FROM instructor ORDER BY apellidoPaterno ASC ";

$result = $conn->query($sql) or die($conn->error . __LINE__);

$arr = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $arr[] = $row;
    }
}

echo json_encode($arr);