<?php

/* Obtiene los datos del usuario para rellenar el formulario de actualizacion de los datos del usuario */

/* Conexión a la BD */
include_once 'conexion.php';

/* Validar que se estén recibiendo datos */
if (!isset($_POST)) {
    die();
}

/* Recepción de variables POST */
$id = mysqli_real_escape_string($conn, $_POST['idUsuario']);

/* Consulta SQL */
$sql = "SELECT idUsuario, Departamento_idDepartamento as departamento, rol, nombreUsuario, contrasena, apellidoPaterno, apellidoMaterno, nombre, sexo, contrato, RFC, CURP, fechaNacimiento, telefono, Correo, horas, nivel, perfilDeseable, activo, funcionAdministrativa FROM usuario
        WHERE idUsuario = '$id'";

/* Ejecución de la consulta */
$result = $conn->query($sql) or die($conn->error . __LINE__);

$curso = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Impresión de resultados
echo json_encode($curso[0],true);