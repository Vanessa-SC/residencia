<?php

/** Actualizar departamento */

// Recepción de datos, conexión
$datos = json_decode(file_get_contents("php://input"));
include_once 'conexion.php';

$response = [];

//Query para determinar si ya hay fechas
$query = "SELECT * FROM encuesta_has_activa
WHERE idEncuesta = '$datos->encuesta'
AND fechaInicio = '$datos->fechaInicio'
AND fechaFin = '$datos->fechaFin'";
$result = mysqli_query($conn, $query);

setlocale(LC_TIME, 'es_MX');

$fechaInicio = strftime('%Y-%m-%d', strtotime($datos->fechaInicio));
$fechaFin = strftime('%Y-%m-%d', strtotime($datos->fechaFin));

/* Si no existe un registro previo, hace una inserción en la base de datos. Caso contrario realiza un update para actualizar las fechas */
if ($rowcount = mysqli_num_rows($result) == 0 ) {
    /* Inserción del nombre del documento a la base de datos */
    $sql = "INSERT INTO encuesta_has_activa
            VALUES('$datos->encuesta','$datos->fechaInicio','$datos->fechaFin')";
        if(mysqli_query($conn, $sql)){
            $response['status'] = 'ok';
        } else {
            $response['status'] = 'error '.mysqli_error($conn);
        }

echo json_encode($response,true);
} else {
    
//Query de actualización
    $sqlU = "UPDATE encuesta_has_activa
            SET fechaInicio='$datos->$fechaInicio', 
            fechaFin = '$datos->fechaFin'
            WHERE idEncuesta = '$datos->encuesta'";
             if(mysqli_query($conn, $sqlU)){
                $response['status'] = 'ok';
            } else {
                $response['status'] = 'error '.mysqli_error($conn);
            }
    
    echo json_encode($response,true);
}

       
