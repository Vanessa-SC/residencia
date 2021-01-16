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

SELECT a.id, a.nombre, SUM(b.valor)
   FROM tablanombres a LEFT JOIN tablavalores b ON a.id = b.id 
   GROUP BY a.id, a.nombre

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


    -----
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


    SELECT  
    departamento.nombreDepartamento, COUNT(usuario.Departamento_idDepartamento) AS dptos 
    FROM usuario 
    inner join departamento 
    on usuario.Departamento_idDepartamento = departamento.idDepartamento 
    INNER JOIN usuario_has_curso
    ON usuario.idUsuario = usuario_has_curso.Usuario_idUsuario
    where departamento.idDepartamento in(select idDepartamento from departamento) 
    AND usuario_has_curso.Curso_idCurso = $idCurso
    GROUP BY  departamento.nombreDepartamento

    IF(usuario.funcionAdministrativa = 'NO', 'X', usuario.funcionAdministrativa) AS D,
    IF(usuario.funcionAdministrativa = 'SI', 'X', usuario.funcionAdministrativa) AS FD,
*/

// Obtiene el periodo actual para la consulta
$mes = date('n');
$año = date('Y');

if ( $mes <= 6 ){
    $response = 'Enero / Junio ';
} else {
    $response = 'Agosto / Diciembre ';
}

$sql = "SELECT s.comentario,
concat_ws(' ',u.apellidoPaterno,u.apellidoMaterno,u.nombre) AS nombre
FROM usuario_responde_encuesta ur 
INNER JOIN usuario u
ON u.idUsuario = ur.Usuario_idUsuario
INNER JOIN sugerencia s
ON s.Encuesta_idEncuesta = ur.Encuesta_idEncuesta
Where ur.Curso_idCurso = 1
AND ur.Encuesta_idEncuesta = 1
group by nombre, s.comentario
";

/* Ejecución de la consulta */
$result = $conn->query($sql) or die($conn->error . __LINE__);
$curso = mysqli_fetch_all($result, MYSQLI_ASSOC);

/* Imprimir respuesta */
echo json_encode($curso);

/* 
u.contrato, count(distinct u.idUsuario) as usuarios 
	FROM usuario u, usuario_has_curso uc, curso c
	WHERE u.idUsuario = uc.Usuario_idUsuario
	AND c.idCurso = uc.Curso_idCurso
	AND u.rol = 3
	AND c.periodo LIKE 'Agosto / Diciembre 2020'
	group by u.contrato

(CASE WHEN a.asistencia IS NULL THEN 0 ELSE a.asistencia END) as asistencia, 
DATE(a.fecha) mydate 
FROM asistencia a  
WHERE a.Curso_idCurso = 1
AND fecha > DATE_SUB(NOW(), INTERVAL 1 WEEK)


SELECT SUM(CASE WHEN caja_hoy IS NULL THEN 0 ELSE caja_hoy END) as monto, DATE(fecha) mydate FROM salidas WHERE date(fecha) >= date('2017-07-1') AND date(fecha) <='2017-07-31' GROUP BY mydate

concat_ws(' ',usuario.apellidoPaterno,usuario.apellidoMaterno,usuario.nombre) AS nombre,
DATE_FORMAT(asistencia.fecha,'%d/%m') as fecha 
FROM asistencia 
INNER JOIN usuario
ON usuario.idUsuario = asistencia.Usuario_idUsuario
WHERE asistencia.Curso_idCurso = 1
AND DAYOFWEEK(fecha) = 5
AND fecha > DATE_SUB(NOW(), INTERVAL 1 WEEK)


$sql = "SELECT usuario.nombre, CONCAT(ELT(WEEKDAY(asistencia.fecha)+1, 'L', 'M', 'M', 'J', 'V')) AS DIA_SEMANA, 
DATE_FORMAT(asistencia.fecha,'%d/%m') as fecha
FROM  asistencia
INNER JOIN usuario
ON usuario.idUsuario = asistencia.Usuario_idUsuario
WHERE asistencia.Curso_idCurso = 1

SELECT * FROM asistencia WHERE fecha > DATE_SUB(NOW(), INTERVAL 1 WEEK) ORDER BY Usuario_idUsuario DESC



AND YEAR(curso.periodo) = $response
SELECT * FROM curso WHERE periodo LIKE '$response%';


SELECT curso.nombreCurso,
        COUNT(CASE WHEN usuario.sexo = 'Masculino' THEN 1 END) AS totalMasculino,
        COUNT(CASE WHEN usuario.sexo = 'Femenino' THEN 1 END) AS totalFemenino,
        COUNT(CASE WHEN usuario.contrato = 'Base' THEN 1 END) AS totalBase,
        COUNT(CASE WHEN usuario.contrato = 'Honorario' THEN 1 END) AS totalHonorario,
        COUNT(CASE WHEN usuario.contrato = 'Interinato' THEN 1 END) AS totalInterinato,
        COUNT(CASE WHEN usuario.horas = 'Medio Tiempo' THEN 1 END) AS totalMedioTiempo,
        COUNT(CASE WHEN usuario.horas = 'Tres Cuartos de Tiempo' THEN 1 END) AS totalTresCuartosTiempo,
        COUNT(CASE WHEN usuario.horas = 'Tiempo Completo' THEN 1 END) AS totalTiempoCompleto,
        COUNT(CASE WHEN usuario.horas = 'Asignaturas' THEN 1 END) AS totalAsignaturas,
        COUNT(CASE WHEN usuario.horas = 'Sin Horas' THEN 1 END) AS totalSinHoras,
        COUNT(CASE WHEN usuario.nivel = 'Maestría' THEN 1 END) AS totalMaestria,
        COUNT(CASE WHEN usuario.nivel = 'Licenciatura' THEN 1 END) AS totalLicenciatura,
        COUNT(CASE WHEN usuario.nivel = 'Doctorado' THEN 1 END) AS totalDoctorado,
        COUNT(CASE WHEN usuario.nivel = 'Especialización' THEN 1 END) AS totalEspecializacion,
        COUNT(CASE WHEN usuario.perfilDeseable = 'Maestría' THEN 1 END) AS totalPMaestria,
        COUNT(CASE WHEN usuario.perfilDeseable = 'Licenciatura' THEN 1 END) AS totalPLicenciatura,
        COUNT(CASE WHEN usuario.perfilDeseable = 'Doctorado' THEN 1 END) AS totalPDoctorado,
        COUNT(CASE WHEN usuario.perfilDeseable = 'Especialización' THEN 1 END) AS totalPEspecializacion,
        COUNT(CASE WHEN usuario.funcionAdministrativa = 'SI' THEN 1 END) AS totalfuncionAdministrativa,
        COUNT(CASE WHEN usuario.funcionAdministrativa = 'NO' THEN 1 END) AS totalNfuncionAdministrativa
        FROM 
        usuario    
        INNER JOIN usuario_has_curso
        ON usuario.idUsuario = usuario_has_curso.Usuario_idUsuario
        INNER JOIN curso
        ON curso.idCurso = usuario_has_curso.Curso_idCurso
        AND usuario.rol = 3
        GROUP BY curso.nombreCurso
*/