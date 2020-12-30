<?php

/** Actualizar departamento */

// Recepción de datos, conexión
$datos = json_decode(file_get_contents("php://input"));
include_once 'conexion.php';

$response = [];

//Query de actualización
$sql = "UPDATE departamento
        SET nombreDepartamento = '$datos->nombreDepartamento',
        Jefe = '$datos->Jefe'
        WHERE idDepartamento = $datos->idDepartamento";

        if(mysqli_query($conn, $sql)){
            $response['status'] = 'ok';
        } else {
            $response['status'] = 'error '.mysqli_error($conn);
        }

echo json_encode($response,true);
