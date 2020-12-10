<?php

/* Obtiene los datos de todos los usuarios que están inscritos a un curso */

include_once 'conexion.php';

if (!isset($_POST)) die();
$id = mysqli_real_escape_string($conn, $_POST['idCurso']);

$sql = "SELECT usuario.idUsuario, departamento.nombreDepartamento as nombreD, usuario.rol, usuario.RFC, 
        usuario.CURP, usuario.horas, usuario.nivel, usuario.perfilDeseable, 
        IF(usuario.funcionAdministrativa = 'X', 'SI', usuario.funcionAdministrativa) AS FD,
        usuario.sexo, usuario.contrato, 
        concat_ws(' ',usuario.apellidoPaterno,usuario.apellidoMaterno,usuario.nombre) as nombre
        FROM usuario_has_curso 
        Inner join usuario        
        ON usuario.idUsuario = usuario_has_curso.Usuario_idUsuario
        Inner join departamento
        ON usuario.Departamento_idDepartamento = departamento.idDepartamento
        AND usuario_has_curso.Curso_idCurso = $id
        WHERE usuario.rol = 3 
        AND activo = 'SI'
        ORDER BY usuario.apellidoPaterno ASC";

$result = $conn->query($sql) or die($conn->error . __LINE__);
$curso = mysqli_fetch_all($result, MYSQLI_ASSOC);
echo json_encode($curso);