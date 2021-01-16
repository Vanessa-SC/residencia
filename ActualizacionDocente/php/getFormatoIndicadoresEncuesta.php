<?php

// Librería y archivo de conexión
require_once "../XLSX/vendor/autoload.php";
include_once 'conexion.php';

// Instancias de creación
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// Nombre del nuevo archivo que se genera
$filename = "Indicadores de Participantes del Curso.xlsx";
header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheet‌​ml.sheet");
header('Content-Disposition: attachment; filename="' . $filename. '"');

// Llamado a la plantilla
$documento = \PhpOffice\PhpSpreadsheet\IOFactory::load('../XLSX/plantillaIndicadores.xlsx');

$activeSheet = $documento->getActiveSheet();
$activeSheet->setTitle("Indicadores");

/*
Consulta a la base de datos para obtener los nombres de los departamentos, 
filtrarlos según los usuarios pertenecientes al curso y contar los departamentos
*/
$sql = $conn->query("SELECT
        curso.nombreCurso, 
        departamento.nombreDepartamento, COUNT(usuario.Departamento_idDepartamento) AS totalDpto 
        FROM usuario 
        INNER JOIN departamento 
        ON usuario.Departamento_idDepartamento = departamento.idDepartamento 
        INNER JOIN usuario_has_curso
        ON usuario.idUsuario = usuario_has_curso.Usuario_idUsuario
        INNER JOIN curso
        ON curso.idCurso = usuario_has_curso.Curso_idCurso
        WHERE departamento.idDepartamento IN(SELECT idDepartamento FROM departamento) 
        GROUP BY curso.nombreCurso, departamento.nombreDepartamento
        ");

// Obtiene el periodo actual para la consulta
$mes = date('n');
$año = date('Y');

if ( $mes <= 6 ){
    $response = 'Enero / Junio ';
} else {
    $response = 'Agosto / Diciembre ';
}

/*
Consulta a la base de datos para contar los diferentes indicadores de los usuarios pertenecientes al curso
*/
$query = $conn->query("SELECT
        curso.nombreCurso, 
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
        WHERE usuario.rol = 3
        AND curso.periodo LIKE '$response%'
        AND YEAR(curso.fechaInicio) = $año
        GROUP BY curso.nombreCurso
        ");

/* Si se obtiene el número de filas del resultado de la segunda consulta, 
entonces comienza el recorrido para imprimir el total de indicadores
*/
if($query->num_rows > 0) {
    // Comienza en la fila 22
    $i = 11;
    // Ciclo while que recorremo los resultados de la consulta y los imprime
    while($row = $query->fetch_assoc()) {
        $activeSheet->setCellValue('B'.$i , $row['nombreCurso']);
        $activeSheet->setCellValue('C'.$i , $row['totalFemenino']);
        $activeSheet->setCellValue('D'.$i , $row['totalMasculino']);
        $activeSheet->setCellValue('E'.$i , $row['totalBase']);
        $activeSheet->setCellValue('F'.$i , $row['totalHonorario']);
        $activeSheet->setCellValue('G'.$i , $row['totalInterinato']);
        $activeSheet->setCellValue('H'.$i , $row['totalTiempoCompleto']);
        $activeSheet->setCellValue('I'.$i , $row['totalMedioTiempo']);
        $activeSheet->setCellValue('J'.$i , $row['totalTresCuartosTiempo']);
        $activeSheet->setCellValue('K'.$i , $row['totalAsignaturas']);
        $activeSheet->setCellValue('L'.$i , $row['totalSinHoras']);
        $activeSheet->setCellValue('M'.$i , $row['totalLicenciatura']);
        $activeSheet->setCellValue('N'.$i , $row['totalMaestria']);
        $activeSheet->setCellValue('O'.$i , $row['totalDoctorado']);
        $activeSheet->setCellValue('P'.$i , $row['totalEspecializacion']);
        $activeSheet->setCellValue('Q'.$i , $row['totalPMaestria']);
        $activeSheet->setCellValue('R'.$i , $row['totalPDoctorado']);
        $activeSheet->setCellValue('S'.$i , $row['totalPEspecializacion']);
        $activeSheet->setCellValue('T'.$i , $row['totalfuncionAdministrativa']);
        $activeSheet->setCellValue('U'.$i , $row['totalNfuncionAdministrativa']);
        // Totales
        $activeSheet->setCellValue('C51','=SUM(C11:C50)');
        $activeSheet->setCellValue('D51','=SUM(D11:D50)');
        $activeSheet->setCellValue('E51','=SUM(E11:E50)');
        $activeSheet->setCellValue('F51','=SUM(F11:F50)');
        $activeSheet->setCellValue('G51','=SUM(G11:G50)');
        $activeSheet->setCellValue('H51','=SUM(H11:H50)');
        $activeSheet->setCellValue('I51','=SUM(I11:I50)');
        $activeSheet->setCellValue('J51','=SUM(J11:J50)');
        $activeSheet->setCellValue('K51','=SUM(K11:K50)');
        $activeSheet->setCellValue('L51','=SUM(L11:L50)');
        $activeSheet->setCellValue('M51','=SUM(M11:M50)');
        $activeSheet->setCellValue('N51','=SUM(N11:N50)');
        $activeSheet->setCellValue('O51','=SUM(O11:O50)');
        $activeSheet->setCellValue('P51','=SUM(P11:P50)');
        $activeSheet->setCellValue('Q51','=SUM(Q11:Q50)');
        $activeSheet->setCellValue('R51','=SUM(R11:R50)');
        $activeSheet->setCellValue('S51','=SUM(S11:S50)');
        $activeSheet->setCellValue('T51','=SUM(T11:T50)');
        $activeSheet->setCellValue('U51','=SUM(U11:U50)');
        $i++;
    }
}

// Creación de nueva hoja
$hoja = $documento->createSheet();
$hoja->setTitle("Departamentos");

// Valores por defecto
$hoja->setCellValue('A1', 'Nombre del curso')->getColumnDimension('A')->setWidth(60);
$hoja->setCellValue('B1', 'Departamento')->getColumnDimension('B')->setWidth(30);
$hoja->setCellValue('C1', 'Total');

/*
Si se obtiene el número de filas del resultado de la primera consulta, 
entonces comienza el recorrido para imprimir los Cursos y los Departamentos de los participantes
*/
if($sql->num_rows > 0) {
    // Comienza en la fila 22
    $i = 2;
    // Ciclo while que recorremo los resultados de la consulta y los imprime
    while($row = $sql->fetch_assoc()) {
        $hoja->setCellValue('A'.$i , $row['nombreCurso']);
        $hoja->setCellValue('B'.$i , $row['nombreDepartamento']);
        $hoja->setCellValue('C'.$i , $row['totalDpto']);
        $i++;
    }
}

// Creación de documento
$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($documento, 'Xlsx');
$writer->save("php://output");