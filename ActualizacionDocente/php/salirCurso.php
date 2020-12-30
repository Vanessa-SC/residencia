<?php

/* Cancela la inscripción a un curso */

// Conexión, recepción de datos y declaracion de variables
include_once 'conexion.php';
if (!isset($_POST)) die();
$idUsuario = mysqli_real_escape_string($conn, $_POST['idUsuario']);
$idCurso = mysqli_real_escape_string($conn, $_POST['idCurso']);
$response = [];

// Query de eliminacion
$query = "DELETE 
            FROM usuario_has_curso
            WHERE Curso_idCurso = '$idCurso'
            AND Usuario_idUsuario = '$idUsuario'
            ";
// ¿Se ejecutó correctamente?
if(mysqli_query($conn, $query)){
   $response['status'] = 'ok';
} else {
    $response['status'] = 'Error';
}
// Respuesta
echo json_encode($response);