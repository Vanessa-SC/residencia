<?php

// Librería y archivo de conexión
require_once "../XLSX/PHPWord_0.17/autoload.php";
include_once 'conexion.php';

// Variable que se obtiene al momento de llamar al método
$id = $_GET['id'];

// Nombre del nuevo archivo que se genera
$template_word = '../XLSX/plantillaFicha.docx';
// Instancias de creación
$templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor($template_word);

/*
Consulta a la base de datos, para obtener al Jefe de Desarrollo Académico
*/
$sql = $conn->query("SELECT Jefe
                FROM departamento
                WHERE nombreDepartamento='Desarrollo Académico'
        ");

/*
Consulta a la base de datos, para obtener la información del curso
*/
$query = $conn->query("SELECT  
            curso.idCurso, 
            concat_ws(' ',instructor.apellidoPaterno,instructor.apellidomaterno,instructor.nombre) as maestro, 
            concat_ws(' ',instructor.nombre,instructor.apellidoPaterno,instructor.apellidomaterno) as nombre,
            curso.nombreCurso as curso, 
            curso.objetivo, 
            curso.modalidad,
            concat_ws(' - ',curso.horaInicio,curso.horaFin) as horario, 
            curso.lugar,
            curso.duracion,
            curso.destinatarios, 
            curso.validado,
            departamento.nombreDepartamento,
            curso.Departamento_idDepartamento as departamento
        FROM instructor 
        INNER JOIN curso
        ON curso.Instructor_idInstructor=instructor.idInstructor
        INNER JOIN departamento
        ON curso.Departamento_idDepartamento = departamento.idDepartamento
        AND curso.idCurso = '$id'      
        ");

// Si se obtiene el número de filas del resultado de la primera consulta, entonces comienza el recorrido para imprimir Jefe
if($sql->num_rows > 0) {
    // Comienza en la fila 22
    $i = 22;
    // Ciclo while que recorremo los resultados de la consulta y los imprime
    while($row = $sql->fetch_assoc()) {
        $templateProcessor->setValue('nombreJefe', $row['Jefe']);
        $i++;
    }
}

// Si se obtiene el número de filas del resultado, entonces comienza el recorrido para imprimir datos del curso
if($query->num_rows > 0) {
    // Comienza en la fila 22
    $i = 22;
    // Ciclo while que recorremo los resultados de la consulta y los imprime
    while($row = $query->fetch_assoc()) {
        $templateProcessor->setValue('nombreCurso', $row['curso']);
        $templateProcessor->setValue('maestro', $row['maestro']);
        $templateProcessor->setValue('objetivo', $row['objetivo']);
        $templateProcessor->setValue('duracion', $row['duracion']);
        $templateProcessor->setValue('nombre', $row['nombre']);
        $i++;
    }
}

// Guarda el nuevo documento Word
$temp_file = tempnam(sys_get_temp_dir(), 'Word');
$templateProcessor->saveAS($temp_file);
// Operaciones con el archivo resultante
$documento = file_get_contents($temp_file);
unlink($temp_file);  // Borra archivo temporal
// Renombra nuevo documento
header("Content-Disposition: attachment; filename= Ficha Tecnica del Servicio.docx");
header('Content-Type: application/word');
// Crea documento
echo $documento;