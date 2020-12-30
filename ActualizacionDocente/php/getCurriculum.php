<?php

//Librería y archivo de conexión
require_once "../XLSX/PHPWord_0.17/autoload.php";
include_once 'conexion.php';

//Variable que se obtiene al momento de llamar al método
$id = $_GET['id'];

//Nombre del nuevo archivo que se genera
$template_word = '../XLSX/plantillaCurriculum.docx';
// Instancias de creación
$templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor($template_word);

/*
Consulta a la base de datos, para obtener el instructor
*/

$query = $conn->query("SELECT 
        instructor.idInstructor, instructor.idUsuario,
        concat_ws(' ',instructor.apellidoPaterno,instructor.apellidomaterno,instructor.nombre) as nombre,
        instructor.RFC, instructor.CURP, 
        DATE_FORMAT(instructor.fechaNacimiento, '%d/%m/%Y') as fecha, 
        instructor.telefono, instructor.Correo, usuario.idUsuario, usuario.nombreUsuario, usuario.contrasena, usuario.sexo, usuario.contrato,
        usuario.horas, usuario.perfilDeseable, usuario.activo, usuario.funcionAdministrativa, usuario.nivel,
        usuario.Departamento_idDepartamento as departamento
        FROM instructor 
        INNER JOIN usuario
        ON instructor.idUsuario = usuario.idUsuario
        WHERE instructor.idUsuario = '$id'      
        ");

// Si se obtiene el número de filas del resultado, entonces comienza el recorrido
if($query->num_rows > 0) {
    // Comienza en la fila 22
    $i = 22;
    // Ciclo while que recorremo los resultados de la consulta y los imprime
    while($row = $query->fetch_assoc()) {
        $templateProcessor->setValue('nombre_instructor', $row['nombre']);
        $templateProcessor->setValue('fechaNacimiento', $row['fecha']);
        $templateProcessor->setValue('CURP_instructor', $row['CURP']);
        $templateProcessor->setValue('RFC_instructor', $row['RFC']);
        $templateProcessor->setValue('telefono_instructor', $row['telefono']);
        $templateProcessor->setValue('Correo_instructor', $row['Correo']);
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
header("Content-Disposition: attachment; filename= Curriculum del Instructor.docx");
header('Content-Type: application/word');
// Crea documento
echo $documento;