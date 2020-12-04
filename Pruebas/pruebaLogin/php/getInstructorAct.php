<?php

include_once 'conexion.php';

if (!isset($_POST)) {
    die();
}

$id = mysqli_real_escape_string($conn, $_POST['idInstructor']);

$sql = "SELECT 
        instructor.idInstructor, instructor.apellidoPaterno, instructor.apellidoMaterno, 
        instructor.nombre, instructor.RFC, instructor.CURP, instructor.fechaNacimiento, 
        instructor.telefono, instructor.Correo, usuario.nombreUsuario, usuario.contrasena,
        usuario.horas, usuario.perfilDeseable, usuario.activo, usuario.funcionAdministrativa, usuario.nivel,
        usuario.Departamento_idDepartamento as departamento
        FROM instructor 
        INNER JOIN usuario
        ON instructor.idUsuario = usuario.idUsuario
        WHERE instructor.idInstructor = '$id'";

$result = $conn->query($sql) or die($conn->error . __LINE__);

$curso = mysqli_fetch_all($result, MYSQLI_ASSOC);

echo json_encode($curso[0]);