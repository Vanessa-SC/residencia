<?php

// Conexión a la BD
include_once 'conexion.php';

// Asignación de variables
$idc = mysqli_real_escape_string($conn,$_POST['idc']);
// Array de respuesta
$response = [];

// SQL de consulta
$sql = "SELECT concat_ws(' ',u.apellidoPaterno,u.apellidoMaterno,u.nombre) as docente, 
               a.asistencia, 
               u.idUsuario,
               DATE_FORMAT(a.fecha,'%d/%m') as fecha
        FROM asistencia a, usuario_has_curso uc, curso c, usuario u
        WHERE a.usuario_idusuario = uc.Usuario_idUsuario
        AND a.curso_idcurso = uc.Curso_idCurso  
        AND uc.Curso_idCurso = c.idCurso
        AND uc.Usuario_idUsuario = u.idUsuario
        and uc.curso_idcurso = $idc
        order by fecha,docente ASC ";

// validacion de ejecucion de consulta
$result = $conn->query($sql) or die($conn->error . __LINE__);
// Asociación de resultados
$data = mysqli_fetch_all($result, MYSQLI_ASSOC);



// Impresión de resultados
echo json_encode($data, true);
