<?php


$instructor = json_decode(file_get_contents("php://input"));

include_once('conexion.php');

$response = [];

$fechaNacimiento = strftime ('%Y-%m-%d', strtotime($instructor->fechaNacimiento));

/* Query de actualización */
$sql = "UPDATE instructor
        INNER JOIN usuario
        ON instructor.idUsuario = usuario.idUsuario
        SET instructor.apellidoPaterno = '$instructor->apellidoPaterno',
            instructor.apellidoMaterno = '$instructor->apellidoMaterno',
            instructor.nombre = '$instructor->nombre',
            instructor.RFC = upper('$instructor->RFC'),
            instructor.CURP = upper('$instructor->CURP'),
            instructor.fechaNacimiento = '$fechaNacimiento',
            instructor.telefono = '$instructor->telefono',
            instructor.Correo = '$instructor->Correo',
            usuario.Departamento_idDepartamento = '$instructor->departamento',
            usuario.nombreUsuario = '$instructor->nombreUsuario',
            usuario.contrasena = '$instructor->contrasena',
            usuario.apellidoPaterno = '$instructor->apellidoPaterno',
            usuario.apellidoMaterno = '$instructor->apellidoMaterno',            
            usuario.nombre = '$instructor->nombre',
            usuario.RFC = upper('$instructor->RFC'),
            usuario.CURP = upper('$instructor->CURP'),
            usuario.horas = '$instructor->horas',
            usuario.nivel = '$instructor->nivel',
            usuario.perfilDeseable = '$instructor->perfilDeseable',
            usuario.activo = '$instructor->activo',
            usuario.funcionAdministrativa = '$instructor->funcionAdministrativa',
        WHERE idInstructor = '$instructor->idInstructor'
        ";

if (mysqli_query($conn, $sql)) {
    $response['status'] = 'ok';
} else {
    $response['status'] = 'error' . mysqli_error($conn);
} 


echo json_encode($response,JSON_FORCE_OBJECT);
// echo json_encode($curso);
