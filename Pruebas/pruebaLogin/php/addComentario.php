<?php

/* Agregará el comentario de un documento perteneciente a un curso */

// Conexión
include_once 'conexion.php';
// Valiación de que existen datos pasados por POST
if (!isset($_POST)) {
    die();
}
// Array de respuesta
$response = [];
// Asignación de datos recibidos a variables
$idCurso = mysqli_real_escape_string($conn, $_POST['idCurso']);
$idDocumento = mysqli_real_escape_string($conn, $_POST['idDocumento']);
$comentario = mysqli_real_escape_string($conn, $_POST['comentario']);

// Query SQL
$sql = "UPDATE curso_has_documento
        SET comentario = '$comentario'
        WHERE Curso_idCurso = $idCurso
        AND Documento_idDocumento = $idDocumento";

// Validación del éxito o fracaso del update
        if(mysqli_query($conn,$sql)){
            $response['status'] = 'ok';
        } else {
            $response['status'] = 'error';
        }

// Impresión de la respuesta
echo json_encode($response,true);
