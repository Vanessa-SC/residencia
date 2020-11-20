<?php

if (!isset($_POST)) {
    die();
}

include_once 'conexion.php';

$folio = mysqli_real_escape_string($conn, $_POST['folio']);
$idCurso = mysqli_real_escape_string($conn, $_POST['idCurso']);

$response = [];

$query  =  "SELECT folio, rutaConstancia
            FROM constancia
            WHERE folio = '$folio'
            AND Curso_idCurso = '$idCurso'";

$result = $conn->query($query) or die($conn->error . __LINE__);

$constancia = mysqli_fetch_all($result, MYSQLI_ASSOC);

echo json_encode($constancia);
