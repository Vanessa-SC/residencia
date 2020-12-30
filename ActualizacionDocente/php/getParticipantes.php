<?php

/* Obtiene los datos de todos los usuarios que están inscritos a un curso */

/* Conexión a la BD */
include_once 'conexion.php';

/* Validar que se estén recibiendo datos */
if (!isset($_POST)) die();
/* Recepción de variables POST */
$id = mysqli_real_escape_string($conn, $_POST['idCurso']);

/* Consulta SQL */
$sql = "SELECT usuario.idUsuario, departamento.nombreDepartamento as nombreD, usuario.rol, usuario.RFC, 
        usuario.CURP, usuario.horas, usuario.nivel, usuario.perfilDeseable, usuario.funcionAdministrativa as FD,
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

/* Ejecución de la consulta */
$result = $conn->query($sql) or die($conn->error . __LINE__);
$curso = mysqli_fetch_all($result, MYSQLI_ASSOC);

/* Imprimir respuesta */
echo json_encode($curso);