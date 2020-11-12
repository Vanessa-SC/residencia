<?php

include_once 'conexion.php';

if (!isset($_POST)) {
    die();
}

$id = mysqli_real_escape_string($conn, $_POST['idCurso']);

$sql = "SELECT usuario.idUsuario, departamento.nombreDepartamento as nombreD, usuario.rol, 
        concat_ws(' ',usuario.apellidoPaterno,usuario.apellidoMaterno,usuario.nombreU) as nombre
        FROM usuario_has_curso 
        Inner join usuario        
        ON usuario.idUsuario = usuario_has_curso.Usuario_idUsuario
        Inner join departamento
        ON usuario.Departamento_idDepartamento = departamento.idDepartamento
        AND usuario_has_curso.estado = 1
        AND usuario_has_curso.Curso_idCurso = $id 
        ORDER BY usuario.apellidoPaterno ASC";

$result = $conn->query($sql) or die($conn->error . __LINE__);

$curso = mysqli_fetch_all($result, MYSQLI_ASSOC);

echo json_encode($curso);