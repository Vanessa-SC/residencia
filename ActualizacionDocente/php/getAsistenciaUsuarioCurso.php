<?php

// Conexión a la BD
include_once 'conexion.php';

// Asignación de variables
$idc = mysqli_real_escape_string($conn,$_POST['idc']);
$idu = mysqli_real_escape_string($conn,$_POST['idu']);
// Array de respuesta
$response = [];

// SQL de consulta
$sql = "SELECT a.asistencia, c.nombreCurso, DATE_FORMAT(a.fecha,'%d/%m/%Y') as fecha
        FROM asistencia a, usuario_has_curso uc, curso c
        WHERE a.usuario_idusuario = uc.Usuario_idUsuario
        AND a.curso_idcurso = uc.Curso_idCurso  
        AND uc.Curso_idCurso = c.idCurso
        AND uc.Usuario_idUsuario = $idu
        and uc.curso_idcurso = $idc
        order by fecha ASC ";

// validacion de ejecucion de consulta
$result = $conn->query($sql) or die($conn->error . __LINE__);
// Asociación de resultados
$data = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Impresión de resultados
echo json_encode($data, true);
