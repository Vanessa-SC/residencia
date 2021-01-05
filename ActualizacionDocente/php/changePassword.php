<?php

/** Recepción de datos, conexión */
include_once 'conexion.php';
$data = json_decode(file_get_contents('php://input'));
$response = [];
/** Cambiar contraseña */

$query  =   "UPDATE usuario SET contrasena='".$data->pass."' WHERE idUsuario=".$data->idu;

if(mysqli_query($conn,$query)){
    $response['status'] = 'ok';
} else {
    $response['status'] = 'error: '.mysqli_error($conn);
}

echo json_encode($response,true);
