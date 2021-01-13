<?php

//Librería y archivo de conexión
require_once "../XLSX/PHPWord_0.17/autoload.php";
include_once 'conexion.php';

/* Obtencion de datos pasados por URL */
$idCurso = $_GET['idc'];

/* Formato de fecha en español */
$formatt = "SET lc_time_names = 'es_MX' ";
mysqli_query($conn,$formatt);

//Nombre del nuevo archivo que se genera
$template_word = '../XLSX/plantillaOficioRegistro.docx';
// Instancias de creación
$templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor($template_word);

// Consulta para obtener el nombre del departamento
$sqlGetDepto = $conn->query("SELECT d.nombreDepartamento, UPPER(d.Jefe) as jefe
        FROM departamento d
        INNER JOIN curso c
        ON c.Departamento_idDepartamento = d.idDepartamento
        WHERE c.idCurso = $idCurso     
        ");
// Imprimir resultados
if($sqlGetDepto->num_rows > 0) {
    while($row = $sqlGetDepto->fetch_assoc()) {
        $templateProcessor->setValue('nombreDepartamento', $row['nombreDepartamento']);
        $templateProcessor->setValue('jefeDpto', $row['jefe']);
    }
}

// Consulta para obtener el nombre del coordinador(a) de Actualizacion Docente
$sqlGetCoord = $conn->query("SELECT Jefe
        FROM departamento
        WHERE nombreDepartamento='Actualización Docente'    
        ");
// Imprimir resultados
if($sqlGetCoord->num_rows > 0) {
    while($row = $sqlGetCoord->fetch_assoc()) {
        $templateProcessor->setValue('coordinador', $row['Jefe']);
    }
}

// Consulta para obtener el nombre del Jefe de Desarrollo Académico
$sqlGetJefe = $conn->query("SELECT UPPER(Jefe) as jefe
        FROM departamento
        WHERE nombreDepartamento='Desarrollo Académico'    
        ");
// Imprimir resultados
if($sqlGetJefe->num_rows > 0) {
    while($row = $sqlGetJefe->fetch_assoc()) {
        $templateProcessor->setValue('jefeDes', $row['jefe']);
    }
}

/*
Consulta a la base de datos, para obtener el instructor
*/

$query = $conn->query("SELECT 
                    idCurso,
                    nombreCurso,
                    duracion,
                    concat_ws(' al ', DATE_FORMAT(fechaInicio, '%d de %M %Y'), DATE_FORMAT(fechaFin, '%d de %M %Y')) as fecha,
                    modalidad,
                    objetivo,
                    DATE_FORMAT(created_at, '%d de %M, %Y') as creacion
                    FROM curso 
                    WHERE idCurso = $idCurso    
        ");

// Si se obtiene el número de filas del resultado, entonces comienza el recorrido
if($query->num_rows > 0) {
    while($row = $query->fetch_assoc()) {
        $templateProcessor->setValue('nombreCurso', $row['nombreCurso']);
        $templateProcessor->setValue('modalidad', $row['modalidad']);
        $templateProcessor->setValue('horas', $row['duracion']);
        $templateProcessor->setValue('fecha', $row['fecha']);
        $templateProcessor->setValue('objetivo', $row['objetivo']);
        $templateProcessor->setValue('creacion', $row['creacion']);
    }
}

// Guarda el nuevo documento Word
$temp_file = tempnam(sys_get_temp_dir(), 'Word');
$templateProcessor->saveAS($temp_file);
// Operaciones con el archivo resultante
$documento = file_get_contents($temp_file);
unlink($temp_file);  // Borra archivo temporal
// Renombra nuevo documento
header("Content-Disposition: attachment; filename= Oficio de Registro de Curso.docx");
header('Content-Type: application/word');
// Crea documento
echo $documento;