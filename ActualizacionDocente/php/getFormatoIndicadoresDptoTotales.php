<?php

// Librería y archivo de conexión
require_once "../XLSX/vendor/autoload.php";
include_once 'conexion.php';

//Variable que se obtiene al momento de llamar al método
$idDpto = $_GET['idd'];

// Instancias de creación
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// Nombre del nuevo archivo que se genera
$filename = "Formato de Indicadores de Participantes Totales del Periodo Actual.xlsx";
header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheet‌​ml.sheet");
header('Content-Disposition: attachment; filename="' . $filename. '"');

// Llamado a la plantilla
$documento = \PhpOffice\PhpSpreadsheet\IOFactory::load('../XLSX/plantillaIndicadoresTotales.xlsx');

$activeSheet = $documento->getActiveSheet();
$activeSheet->setTitle("Indicadores");

// Obtiene el periodo actual para la consulta
$mes = date('n');
$año = date('Y');

if ( $mes <= 6 ){
    $response = 'Enero / Junio ';
} else {
    $response = 'Agosto / Diciembre ';
}

$activeSheet->setCellValue('G7', 'Periodo '.$response);

/*
Consulta a la base de datos para contar los diferentes indicadores de los usuarios pertenecientes al curso
*/

// Consulta para obtener el sexo
$sexo = $conn->query("SELECT
        u.sexo,count(distinct u.idUsuario) as usuarios 
        FROM usuario u, usuario_has_curso uc, curso c
        WHERE u.idUsuario = uc.Usuario_idUsuario
        AND c.idCurso = uc.Curso_idCurso
        AND u.rol = 3
        AND uc.estado = 0
        AND c. periodo LIKE '$response%'
        AND YEAR(c.fechaInicio) = $año
        AND c.Departamento_idDepartamento = $idDpto
        group by u.sexo
        ");

/* Si se obtiene el número de filas del resultado de la segunda consulta, 
entonces comienza el recorrido para imprimir el total de indicadores
*/
if($sexo->num_rows > 0) {
    // Comienza en la columna A
    $i = 'A';
    // Ciclo while que recorremo los resultados de la consulta y los imprime
    while($row = $sexo->fetch_assoc()) {
        $activeSheet->setCellValue($i . '12' , $row['sexo']);
        $activeSheet->setCellValue($i . '13' , $row['usuarios']);
        $i++;
    }
}

// Consulta para obtener el contrato
$contrato = $conn->query("SELECT
        u.contrato,count(distinct u.idUsuario) as usuarios 
        FROM usuario u, usuario_has_curso uc, curso c
        WHERE u.idUsuario = uc.Usuario_idUsuario
        AND c.idCurso = uc.Curso_idCurso
        AND u.rol = 3
        AND uc.estado = 0
        AND c. periodo LIKE '$response%'
        AND YEAR(c.fechaInicio) = $año
        AND c.Departamento_idDepartamento = $idDpto
        group by u.contrato
        ");

/* Si se obtiene el número de filas del resultado de la segunda consulta, 
entonces comienza el recorrido para imprimir el total de indicadores
*/
if($contrato->num_rows > 0) {
    // Comienza en la columna A
    $i = 'C';
    // Ciclo while que recorremo los resultados de la consulta y los imprime
    while($row = $contrato->fetch_assoc()) {
        $activeSheet->setCellValue($i . '12' , $row['contrato']);
        $activeSheet->setCellValue($i . '13' , $row['usuarios']);
        $i++;
    }
}

// Consulta para obtener las horas
$horas = $conn->query("SELECT
        u.horas,count(distinct u.idUsuario) as usuarios 
        FROM usuario u, usuario_has_curso uc, curso c
        WHERE u.idUsuario = uc.Usuario_idUsuario
        AND c.idCurso = uc.Curso_idCurso
        AND u.rol = 3
        AND uc.estado = 0
        AND c. periodo LIKE '$response%'
        AND YEAR(c.fechaInicio) = $año
        AND c.Departamento_idDepartamento = $idDpto
        group by u.horas
        ");

/* Si se obtiene el número de filas del resultado de la segunda consulta, 
entonces comienza el recorrido para imprimir el total de indicadores
*/
if($horas->num_rows > 0) {
    // Comienza en la columna A
    $i = 'F';
    // Ciclo while que recorremo los resultados de la consulta y los imprime
    while($row = $horas->fetch_assoc()) {
        $activeSheet->setCellValue($i . '12' , $row['horas']);
        $activeSheet->setCellValue($i . '13' , $row['usuarios']);
        $i++;
    }
}

// Consulta para obtener el nivel
$nivel = $conn->query("SELECT
        u.nivel,count(distinct u.idUsuario) as usuarios 
        FROM usuario u, usuario_has_curso uc, curso c
        WHERE u.idUsuario = uc.Usuario_idUsuario
        AND c.idCurso = uc.Curso_idCurso
        AND u.rol = 3
        AND uc.estado = 0
        AND c. periodo LIKE '$response%'
        AND YEAR(c.fechaInicio) = $año
        AND c.Departamento_idDepartamento = $idDpto
        group by u.nivel
        ");

/* Si se obtiene el número de filas del resultado de la segunda consulta, 
entonces comienza el recorrido para imprimir el total de indicadores
*/
if($nivel->num_rows > 0) {
    // Comienza en la columna A
    $i = 'K';
    // Ciclo while que recorremo los resultados de la consulta y los imprime
    while($row = $nivel->fetch_assoc()) {
        $activeSheet->setCellValue($i . '12' , $row['nivel']);
        $activeSheet->setCellValue($i . '13' , $row['usuarios']);
        $i++;
    }
}

// Consulta para obtener el perfilDeseable
$perfilDeseable = $conn->query("SELECT
        u.perfilDeseable,count(distinct u.idUsuario) as usuarios 
        FROM usuario u, usuario_has_curso uc, curso c
        WHERE u.idUsuario = uc.Usuario_idUsuario
        AND c.idCurso = uc.Curso_idCurso
        AND u.rol = 3
        AND uc.estado = 0
        AND c. periodo LIKE '$response%'
        AND YEAR(c.fechaInicio) = $año
        AND c.Departamento_idDepartamento = $idDpto
        group by u.perfilDeseable
        ");

/* Si se obtiene el número de filas del resultado de la segunda consulta, 
entonces comienza el recorrido para imprimir el total de indicadores
*/
if($perfilDeseable->num_rows > 0) {
    // Comienza en la columna A
    $i = 'O';
    // Ciclo while que recorremo los resultados de la consulta y los imprime
    while($row = $perfilDeseable->fetch_assoc()) {
        $activeSheet->setCellValue($i . '12' , $row['perfilDeseable']);
        $activeSheet->setCellValue($i . '13' , $row['usuarios']);
        $i++;
    }
}

// Consulta para obtener la funcionAdministrativa
$funcionAdministrativa = $conn->query("SELECT
        u.funcionAdministrativa,count(distinct u.idUsuario) as usuarios 
        FROM usuario u, usuario_has_curso uc, curso c
        WHERE u.idUsuario = uc.Usuario_idUsuario
        AND c.idCurso = uc.Curso_idCurso
        AND u.rol = 3
        AND uc.estado = 0
        AND c. periodo LIKE '$response%'
        AND YEAR(c.fechaInicio) = $año
        AND c.Departamento_idDepartamento = $idDpto
        group by u.funcionAdministrativa
        ");

/* Si se obtiene el número de filas del resultado de la segunda consulta, 
entonces comienza el recorrido para imprimir el total de indicadores
*/
if($funcionAdministrativa->num_rows > 0) {
    // Comienza en la columna A
    $i = 'R';
    // Ciclo while que recorremo los resultados de la consulta y los imprime
    while($row = $funcionAdministrativa->fetch_assoc()) {
        $activeSheet->setCellValue($i . '12' , $row['funcionAdministrativa']);
        $activeSheet->setCellValue($i . '13' , $row['usuarios']);
        $i++;
    }
}

// Creación de documento
$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($documento, 'Xlsx');
$writer->save("php://output");