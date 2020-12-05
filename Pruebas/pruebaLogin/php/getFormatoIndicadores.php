<?php

//Librería y archivo de conexión
require_once "../XLSX/vendor/autoload.php";
include_once 'conexion.php';

//Variable que se obtiene al momento de llamar al método
$idCurso = $_GET['idc'];

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

//Nombre del nuevo archivo que se genera
$filename = "Indicadores de Participantes del Curso.xlsx";
header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheet‌​ml.sheet");
header('Content-Disposition: attachment; filename="' . $filename. '"');

//Llamado a la plantilla
$documento = \PhpOffice\PhpSpreadsheet\IOFactory::load('../XLSX/plantillaIndicadores.xlsx');

$activeSheet = $documento->getActiveSheet();
$activeSheet->setTitle("Indicadores");

/*
Consulta a la base de datos
*/
$sql = $conn->query("SELECT
        departamento.nombreDepartamento, COUNT(usuario.Departamento_idDepartamento) AS totalDpto 
        FROM usuario 
        inner join departamento 
        on usuario.Departamento_idDepartamento = departamento.idDepartamento 
        INNER JOIN usuario_has_curso
        ON usuario.idUsuario = usuario_has_curso.Usuario_idUsuario
        where departamento.idDepartamento in(select idDepartamento from departamento) 
        AND usuario_has_curso.Curso_idCurso = $idCurso
        GROUP BY  departamento.nombreDepartamento
        ");

$query = $conn->query("SELECT
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
        COUNT(CASE WHEN usuario.funcionAdministrativa = 'X' THEN 1 END) AS totalfuncionAdministrativa,
        COUNT(CASE WHEN usuario.funcionAdministrativa = 'NO' THEN 1 END) AS totalNfuncionAdministrativa
        FROM 
        usuario    
        INNER JOIN usuario_has_curso
        ON usuario.idUsuario = usuario_has_curso.Usuario_idUsuario
        WHERE usuario_has_curso.Curso_idCurso = $idCurso
        AND usuario.rol = 3
        ");

// Si se obtiene el número de filas del resultado, entonces comienza el recorrido
if($query->num_rows > 0) {
    //Comienza en la fila 22
    $i = 11;
    //Ciclo while que recorremo los resultados de la consulta y los imprime
    while($row = $query->fetch_assoc()) {
        $activeSheet->setCellValue('B'.'11' , $row['totalFemenino']);
        $activeSheet->setCellValue('B'.'12' , $row['totalMasculino']);
        $activeSheet->setCellValue('D'.'11' , $row['totalBase']);
        $activeSheet->setCellValue('D'.'12' , $row['totalHonorario']);
        $activeSheet->setCellValue('D'.'13' , $row['totalInterinato']);
        $activeSheet->setCellValue('H'.'11' , $row['totalTiempoCompleto']);
        $activeSheet->setCellValue('H'.'12' , $row['totalMedioTiempo']);
        $activeSheet->setCellValue('H'.'13' , $row['totalTresCuartosTiempo']);
        $activeSheet->setCellValue('H'.'14' , $row['totalAsignaturas']);
        $activeSheet->setCellValue('H'.'15' , $row['totalSinHoras']);
        $activeSheet->setCellValue('J'.'11' , $row['totalLicenciatura']);
        $activeSheet->setCellValue('J'.'12' , $row['totalMaestria']);
        $activeSheet->setCellValue('J'.'13' , $row['totalDoctorado']);
        $activeSheet->setCellValue('J'.'14' , $row['totalEspecializacion']);
        $activeSheet->setCellValue('L'.'11' , $row['totalPMaestria']);
        $activeSheet->setCellValue('L'.'12' , $row['totalPDoctorado']);
        $activeSheet->setCellValue('L'.'13' , $row['totalPEspecializacion']);
        $activeSheet->setCellValue('N'.'11' , $row['totalfuncionAdministrativa']);
        $activeSheet->setCellValue('N'.'12' , $row['totalNfuncionAdministrativa']);
        $i++;
    }
}

if($sql->num_rows > 0) {
    //Comienza en la fila 22
    $i = 11;
    //Ciclo while que recorremo los resultados de la consulta y los imprime
    while($row = $sql->fetch_assoc()) {
        $activeSheet->setCellValue('E'.$i , $row['nombreDepartamento']);
        $activeSheet->setCellValue('F'.$i , $row['totalDpto']);
        $i++;
    }
}

//Creación de documento
$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($documento, 'Xlsx');
$writer->save("php://output");