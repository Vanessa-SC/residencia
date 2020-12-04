<?php

include_once 'conexion.php';

if (!isset($_POST)) {
    die();
}

$formatt = "SET lc_time_names = 'es_MX' ";
mysqli_query($conn,$formatt);


$idCurso = 1;

$sql = "SELECT 
            usuario.idUsuario, departamento.nombreDepartamento as nombreD, usuario.rol, usuario.RFC, 
            usuario.CURP, usuario.horas, usuario.nivel, usuario.perfilDeseable, usuario.funcionAdministrativa as FD, 
            concat_ws(' ',usuario.apellidoPaterno,usuario.apellidoMaterno,usuario.nombre) as nombre,
            concat_ws(' ',instructor.apellidoPaterno,instructor.apellidomaterno,instructor.nombre) as maestro, 
            instructor.RFC as insRFC,
            instructor.CURP as insCURP,
            curso.idCurso, 
            curso.nombreCurso as curso, 
            curso.objetivo, curso.Instructor_idInstructor,            
            curso.modalidad,
            concat_ws(' - ', DATE_FORMAT(curso.fechaInicio, '%d de %M'), DATE_FORMAT(curso.fechaFin, '%d de %M, %Y')) as fecha,
            concat_ws(' - ',curso.horaInicio,curso.horaFin) as horario, 
            curso.lugar,
            curso.duracion,
            curso.periodo,
            curso.destinatarios, 
            curso.validado,
            curso.Departamento_idDepartamento as departamento
            FROM usuario_has_curso 
            Inner join usuario        
            ON usuario.idUsuario = usuario_has_curso.Usuario_idUsuario
            Inner join departamento
            ON usuario.Departamento_idDepartamento = departamento.idDepartamento
            AND usuario_has_curso.estado = 1
            AND usuario_has_curso.Curso_idCurso = $idCurso
            Inner join curso 
            ON curso.idCurso = usuario_has_curso.Curso_idCurso            
            Inner join instructor 
            ON curso.Instructor_idInstructor=instructor.idInstructor
            WHERE usuario.rol = 3 
            AND activo = 'SI'         
            
        ";

$result = $conn->query($sql) or die($conn->error . __LINE__);

$curso = mysqli_fetch_all($result, MYSQLI_ASSOC);

echo json_encode($curso[0]);