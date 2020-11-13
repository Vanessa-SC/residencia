<?php 

include_once 'conexion.php';

$sql = "SELECT idInstructor, apellidoPaterno, apellidomaterno, nombreInstructor, 
concat_ws(' ',apellidoPaterno,apellidomaterno,nombreInstructor) as nombre,
RFC, CURP, fechaNacimiento, telefono, Correo 
FROM instructor ORDER BY apellidoPaterno ASC ";

$result = $conn->query($sql) or die($conn->error . __LINE__);

$arr = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $arr[] = $row;
    }
}

echo json_encode($arr);