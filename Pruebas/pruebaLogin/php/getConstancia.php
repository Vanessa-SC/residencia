<?php

/* Obtiene el folio y ruta de una constancia de cierto curso */

// Se reciben datos POST?
if (!isset($_POST)) {
    die();
}
// conexion
include_once 'conexion.php';

// asignacion de variables
$folio = mysqli_real_escape_string($conn, $_POST['folio']);
$idCurso = mysqli_real_escape_string($conn, $_POST['idCurso']);

// array de respuesta
$response = [];

// Query de consulta
$query  =  "SELECT folio, rutaConstancia
            FROM constancia
            WHERE folio = '$folio'
            AND Curso_idCurso = '$idCurso'";

// validacion de ejecucion de consulta
$result = $conn->query($query) or die($conn->error . __LINE__);

// asociacion de resultados
$constancia = mysqli_fetch_all($result, MYSQLI_ASSOC);

// impresion de resultados
echo json_encode($constancia,true);
