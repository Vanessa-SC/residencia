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
        usuario.Departamento_idDepartamento = '$actUsuario->departamento',
        usuario.rol = '$actUsuario->rol',
        usuario.nombreUsuario = '$actUsuario->nombreUsuario',
        usuario.contrasena = '$actUsuario->contrasena',
        usuario.apellidoPaterno = '$actUsuario->apellidoPaterno',
        usuario.apellidoMaterno = '$actUsuario->apellidoMaterno',            
        usuario.nombre = '$actUsuario->nombre',
        usuario.sexo = '$actUsuario->sexo',
        usuario.contrato = '$actUsuario->contrato',
        usuario.RFC = upper('$actUsuario->RFC'),
        usuario.CURP = upper('$actUsuario->CURP'),
        usuario.fechaNacimiento = '$actUsuario->fechaNacimiento',
        usuario.telefono = '$actUsuario->telefono',
        usuario.Correo = '$actUsuario->Correo',
        usuario.horas = '$actUsuario->horas',
        usuario.nivel = '$actUsuario->nivel',
        usuario.perfilDeseable = '$actUsuario->perfilDeseable',
        usuario.activo = '$actUsuario->activo',
        usuario.funcionAdministrativa = '$actUsuario->funcionAdministrativa'
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
