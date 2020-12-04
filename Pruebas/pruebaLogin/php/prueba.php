<?php

include_once 'conexion.php';

if (!isset($_POST)) {
    die();
}

$formatt = "SET lc_time_names = 'es_MX' ";
mysqli_query($conn,$formatt);

/* 
 SELECT
    SUM(CASE WHEN sexo = 'Masculino' THEN 1 END) AS Masculino
    ,SUM(CASE WHEN sexo = 'Femenino' THEN 1 END) AS Femenino
    from usuario
    where rol = 3
*/


$idCurso = 1;

$nombre = "Sistemas y Computación";

/*
CORRECTA
SELECT
    departamento.nombreDepartamento,
    SUM(usuario.Departamento_idDepartamento) as totalDpto
    FROM 
    usuario    
    INNER JOIN departamento 
    ON usuario.Departamento_idDepartamento = departamento.idDepartamento
    INNER JOIN usuario_has_curso
    ON usuario.idUsuario = usuario_has_curso.Usuario_idUsuario
    where departamento.idDepartamento in(select idDepartamento from departamento)    
    AND usuario.rol = 3
    AND usuario_has_curso.Curso_idCurso = $idCurso
    GROUP BY 
    departamento.nombreDepartamento

    *******
    departamento.nombreDepartamento
    SUM(usuario.Departamento_idDepartamento) as totalDpto,
    SUM(CASE WHEN usuario.sexo = 'Masculino' THEN 1 END) AS totalMasculino,
    SUM(CASE WHEN usuario.sexo = 'Femenino' THEN 1 END) AS totalFemenino,

    FROM 
    usuario    
    INNER JOIN departamento 
    ON usuario.Departamento_idDepartamento = departamento.idDepartamento
    INNER JOIN usuario_has_curso
    ON usuario.idUsuario = usuario_has_curso.Usuario_idUsuario
    where departamento.idDepartamento in(select idDepartamento from departamento)    
    AND usuario.rol = 3
    AND usuario_has_curso.Curso_idCurso = $idCurso
    GROUP BY 
    departamento.nombreDepartamento


*/

$idDepartamento = 2;

$sql = "SELECT
    departamento.nombreDepartamento,
    SUM(usuario.Departamento_idDepartamento) AS totalDpto,
    SUM(CASE WHEN usuario.sexo = 'Masculino' THEN 1 END) AS totalMasculino,
    SUM(CASE WHEN usuario.sexo = 'Femenino' THEN 1 END) AS totalFemenino,
    SUM(CASE WHEN usuario.contrato = 'Base' THEN 1 END) AS totalBase,
    SUM(CASE WHEN usuario.contrato = 'Honorario,' THEN 1 END) AS totalHonorario,
    SUM(CASE WHEN usuario.contrato = 'Interinato' THEN 1 END) AS totalInterinato,
    SUM(CASE WHEN usuario.horas = 'Medio Tiempo' THEN 1 END) AS totalMedioTiempo,
    SUM(CASE WHEN usuario.horas = 'Tres Cuartos de Tiempo' THEN 1 END) AS totalTresCuartosTiempo,
    SUM(CASE WHEN usuario.horas = 'Tiempo Completo' THEN 1 END) AS totalTiempoCompleto,
    SUM(CASE WHEN usuario.horas = 'Asignaturas' THEN 1 END) AS totalAsignaturas,
    SUM(CASE WHEN usuario.horas = 'Sin Horas' THEN 1 END) AS totalSinHoras,
    SUM(CASE WHEN usuario.nivel = 'Maestría' THEN 1 END) AS totalMaestria,
    SUM(CASE WHEN usuario.nivel = 'Licenciatura' THEN 1 END) AS totalLicenciatura,
    SUM(CASE WHEN usuario.nivel = 'Doctorado' THEN 1 END) AS totalDoctorado,
    SUM(CASE WHEN usuario.nivel = 'Especialización' THEN 1 END) AS totalEspecializacion,
    SUM(CASE WHEN usuario.perfilDeseable = 'Maestría' THEN 1 END) AS totalMaestria,
    SUM(CASE WHEN usuario.perfilDeseable = 'Licenciatura' THEN 1 END) AS totalLicenciatura,
    SUM(CASE WHEN usuario.perfilDeseable = 'Doctorado' THEN 1 END) AS totalDoctorado,
    SUM(CASE WHEN usuario.perfilDeseable = 'Especialización' THEN 1 END) AS totalEspecializacion,
    SUM(CASE WHEN usuario.funcionAdministrativa = 'X' THEN 1 END) AS totalfuncionAdministrativa,
    SUM(CASE WHEN usuario.funcionAdministrativa = 'NO' THEN 1 END) AS totalNfuncionAdministrativa
    FROM 
    usuario    
    INNER JOIN departamento 
    ON usuario.Departamento_idDepartamento = departamento.idDepartamento
    INNER JOIN usuario_has_curso
    ON usuario.idUsuario = usuario_has_curso.Usuario_idUsuario
    WHERE departamento.idDepartamento IN(SELECT idDepartamento FROM departamento)    
    AND usuario.rol = 3
    AND usuario_has_curso.Curso_idCurso = $idCurso
    GROUP BY 
    departamento.nombreDepartamento
    ";

$result = $conn->query($sql) or die($conn->error . __LINE__);

$curso = mysqli_fetch_all($result, MYSQLI_ASSOC);

echo json_encode($curso);