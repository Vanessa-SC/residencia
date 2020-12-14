<?php

/* Actualizará los datos de un Usuario */

/* Recepción del array con los datos del Usuario */
$actUsuario = json_decode(file_get_contents("php://input"));
// Conexión
include_once('conexion.php');
// Array de respuesta
$response = [];
// Formato de la fecha
$fechaNacimiento = strftime ('%Y-%m-%d', strtotime($actUsuario->fechaNacimiento));

/* Query de actualización */
$sql = "UPDATE usuario
        SET 
            Departamento_idDepartamento = '$actUsuario->departamento',
            rol = '$actUsuario->rol',
            nombreUsuario = '$actUsuario->nombreUsuario',
            contrasena = '$actUsuario->contrasena',
            apellidoPaterno = '$actUsuario->apellidoPaterno',
            apellidoMaterno = '$actUsuario->apellidoMaterno',            
            nombre = '$actUsuario->nombre',
            sexo = '$actUsuario->sexo',
            contrato = '$actUsuario->contrato',
            RFC = upper('$actUsuario->RFC'),
            CURP = upper('$actUsuario->CURP'),
            fechaNacimiento = '$actUsuario->fechaNacimiento',
            telefono = '$actUsuario->telefono',
            Correo = '$actUsuario->Correo',
            horas = '$actUsuario->horas',
            nivel = '$actUsuario->nivel',
            perfilDeseable = '$actUsuario->perfilDeseable',
            activo = '$actUsuario->activo',
            funcionAdministrativa = '$actUsuario->funcionAdministrativa'
        WHERE idUsuario = $actUsuario->idUsuario
        ";
// Ejecución del Query
if (mysqli_query($conn, $sql)) {
    $response['status'] = 'ok';
} else {
    $response['status'] = 'error ' . mysqli_error($conn);
} 

// Impresión de la respuesta
echo json_encode($response,JSON_FORCE_OBJECT);
