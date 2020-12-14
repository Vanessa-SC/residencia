<?php

/* Registrará un nuevo usuario */

// Recepcion del array de datos
$users = json_decode(file_get_contents("php://input"));
// Conexión
include_once('conexion.php');

/* Conversión de los formatos de fecha */

setlocale(LC_TIME,'es_MX');

$fechaNacimiento = strftime ('%Y-%m-%d', strtotime($users->fechaNacimiento));

/* Query de insercion  a tabla usuario */
$sql = "INSERT INTO usuario
        VALUES ('',
            '$users->departamento',
            '$users->rol',
            '$users->nombreUsuario',
            '$users->contrasena',
            '$users->apellidoPaterno',
            '$users->apellidoMaterno',
            '$users->nombre',
            '$users->sexo',
            '$users->contrato',
            upper('$users->RFC'),
            upper('$users->CURP'),
            '$fechaNacimiento',
            '$users->telefono',
            '$users->Correo',
            '$users->horas',
            '$users->nivel',
            '$users->perfilDeseable',
            'SI',
            '$users->funcionAdministrativa'
            )
        ";
// Ejecución del query y validación de su ejecucion
if (mysqli_query($conn, $sql)) {
        $response['status'] = 'ok';
} else {
    $response['status'] = 'error: ' . mysqli_error($conn);
} 
// Impresión del resultado
echo json_encode($response,JSON_FORCE_OBJECT);