<?php


$instructor = json_decode(file_get_contents("php://input"));

include_once('conexion.php');

$response = [];

/* Query de actualización */
$sql = "UPDATE instructor
        SET apellidoPaterno = '$instructor->apellidoPaterno',
            apellidoMaterno = '$instructor->apellidoMaterno',
            nombreInstructor = '$instructor->nombreInstructor',
            RFC = '$RFC',
            CURP = '$instructor->CURP',
            fechaNacimiento = '$instructor->fechaNacimiento',
            telefono = '$instructor->telefono',
            Correo = '$instructor->Correo'
        WHERE idInstructor = '$instructor->idInstructor'
        ";

if (mysqli_query($conn, $sql)) {
    $response['status'] = 'ok';
} else {
    $response['status'] = 'error' . mysqli_error($conn);
} 


echo json_encode($response,JSON_FORCE_OBJECT);
// echo json_encode($curso);
