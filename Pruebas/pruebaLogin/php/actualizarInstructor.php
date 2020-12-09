<?php


$actInstructor = json_decode(file_get_contents("php://input"));

include_once('conexion.php');

$response = [];

$fechaNacimiento = strftime ('%Y-%m-%d', strtotime($actInstructor->fechaNacimiento));

/* Query de actualización */
$sql = "UPDATE instructor
        INNER JOIN usuario
        ON instructor.idUsuario = usuario.idUsuario
        SET instructor.apellidoPaterno = '$actInstructor->apellidoPaterno',
            instructor.apellidoMaterno = '$actInstructor->apellidoMaterno',
            instructor.nombre = '$actInstructor->nombre',
            instructor.RFC = upper('$actInstructor->RFC'),
            instructor.CURP = upper('$actInstructor->CURP'),
            instructor.fechaNacimiento = '$fechaNacimiento',
            instructor.telefono = '$actInstructor->telefono',
            instructor.Correo = '$actInstructor->Correo',
            usuario.Departamento_idDepartamento = '$actInstructor->departamento',
            usuario.rol = '4',
            usuario.nombreUsuario = '$actInstructor->nombreUsuario',
            usuario.contrasena = '$actInstructor->contrasena',
            usuario.apellidoPaterno = '$actInstructor->apellidoPaterno',
            usuario.apellidoMaterno = '$actInstructor->apellidoMaterno',            
            usuario.nombre = '$actInstructor->nombre',
            usuario.sexo = '$actInstructor->sexo',
            usuario.contrato = '$actInstructor->contrato',
            usuario.RFC = upper('$actInstructor->RFC'),
            usuario.CURP = upper('$actInstructor->CURP'),
            usuario.horas = '$actInstructor->horas',
            usuario.nivel = '$actInstructor->nivel',
            usuario.perfilDeseable = '$actInstructor->perfilDeseable',
            usuario.activo = '$actInstructor->activo',
            usuario.funcionAdministrativa = '$actInstructor->funcionAdministrativa'
        WHERE instructor.idInstructor = $actInstructor->idInstructor
        ";

if (mysqli_query($conn, $sql)) {
    $response['status'] = 'ok';
} else {
    $response['status'] = 'error' . mysqli_error($conn);
} 


echo json_encode($response,JSON_FORCE_OBJECT);
// echo json_encode($curso);
