<?php

/* Obtiene los datos del instructor para rellenar el formulario de actualizacion de los datos del instructor */

/* Conexión a la BD */
include_once 'conexion.php';

/* Validar que se estén recibiendo datos */
if (!isset($_POST)) {
    die();
}

/* Recepción de variables POST */
$id = mysqli_real_escape_string($conn, $_POST['idInstructor']);

/* Consulta SQL */
$sql = "SELECT 
        instructor.idInstructor, instructor.idUsuario, instructor.apellidoPaterno, instructor.apellidoMaterno, 
        instructor.nombre, instructor.RFC, instructor.CURP, instructor.fechaNacimiento, 
        instructor.telefono, instructor.Correo, usuario.idUsuario, usuario.nombreUsuario, usuario.contrasena, usuario.sexo, usuario.contrato,
        usuario.horas, usuario.perfilDeseable, usuario.activo, usuario.funcionAdministrativa, usuario.nivel,
        usuario.Departamento_idDepartamento as departamento
        FROM instructor 
        INNER JOIN usuario
        ON instructor.idUsuario = usuario.idUsuario
        WHERE instructor.idInstructor = '$id'";

/* Ejecución de la consulta */
$result = $conn->query($sql) or die($conn->error . __LINE__);

$curso = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Impresión de resultados
echo json_encode($curso[0],true);