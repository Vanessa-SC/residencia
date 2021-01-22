<?php

/** Generar grupo de constancias para usuarios con 80% de asistencia **/

/* Recepción de los datos del curso, conexión, array de respuesta, libreria FPDF */
$data = json_decode(file_get_contents('php://input'));
require_once '../FPDF/fpdf.php';
include_once 'conexion.php';
$response = [];

/* Separación de datos del curso */
$curso = $data->curso;
$idc = $data->idCurso;
$folio = $data->folio;
$ClaveRegistro = $data->ClaveRegistro;
$fechaInicio = $data->fechaInicio;
$fechaFin = $data->fechaFin;
$duracion = $data->duracion;

$contador = 1;

// Obtener listado de participantes con asistencia mayor a 80%
$queryAlumnos = "SELECT a.Usuario_idUsuario as idUsuario,
                    upper(concat_ws(' ',u.nombre,u.apellidoPaterno,u.apellidoMaterno)) as nombre
                    FROM asistencia a, usuario u
                    WHERE a.Curso_idCurso = $idc
                    AND a.Usuario_idUsuario = u.idUsuario
                    group by a.Usuario_idUsuario
                    HAVING ROUND((SUM(CASE WHEN a.asistencia = '1' THEN 1 ELSE 0 END)/COUNT(*)*100),2) >= 80";

$res = mysqli_query($conn, $queryAlumnos);
$participantes = mysqli_fetch_all($res);

// Obtener listado de participantes con asistencia menor a 80%
$queryAlumnosR = "SELECT a.Usuario_idUsuario as idUsuario,
                    upper(concat_ws(' ',u.nombre,u.apellidoPaterno,u.apellidoMaterno)) as nombre
                    FROM asistencia a, usuario u
                    WHERE a.Curso_idCurso = $idc
                    AND a.Usuario_idUsuario = u.idUsuario
                    group by a.Usuario_idUsuario
                    HAVING ROUND((SUM(CASE WHEN a.asistencia = '1' THEN 1 ELSE 0 END)/COUNT(*)*100),2) <= 80";

$resA = mysqli_query($conn, $queryAlumnosR);
$participantesR = mysqli_fetch_all($resA);

/* Recorrer el arreglo y hacer la actualización de estado 2 -> reprobado  */
foreach ($participantesR as list($id, $nombre)) {
    $sqli = "UPDATE usuario_has_curso
        SET estado = '2'
        WHERE Usuario_idUsuario = $id
        AND Curso_idCurso = $idc
        ";

    mysqli_query($conn, $sqli);
}

/* Recorrer el arreglo y hacer inserciones de usuarios aprobados */
foreach ($participantes as list($id, $nombre)) {

    /* Creación del documento PDF */
    
    // documento en 'landscape' (orientacion horizontal)
    $pdf = new FPDF('P', 'mm', 'letter');
    // Deshabilitar el salto de página automático
    $pdf->SetAutoPageBreak(false);
    // Agregar página
    $pdf->AddPage();
    // Background
    $pdf->Image('C:\xampp\htdocs\Residencia\ActualizacionDocente\FPDF\CONSTANCIA.jpg', 3, 0, 210);
    $pdf->Ln(43);
    // Tipografía
    $pdf->AddFont('Montserrat', '', 'montserrat.php');
    $pdf->AddFont('Montserrat', 'I', 'montserrati.php');
    $pdf->AddFont('Montserrat', 'B', 'montserratb.php');
    $pdf->AddFont('Montserrat-black', '', 'Montserrat-Black.php');
    $pdf->AddFont('Montserrat-medium', '', 'Montserrat-Medium.php');

    $pdf->SetFont('Montserrat-black', '', 18);

    /* Nombre del participante */
    $pdf->Ln(10);
    $pdf->Cell(200, 150, utf8_decode($nombre), 0, 0, 'C');
    $pdf->Ln(10);
    $pdf->SetFont('Montserrat-medium', '', 14);
    $pdf->Cell(200, 160, utf8_decode(mb_strtoupper('por su participación en el curso:', 'utf-8')), 0, 0, 'C');
    $pdf->Ln(85);
    $pdf->MultiCell(0, 7, utf8_decode(mb_strtoupper($curso, 'utf-8')), 0, 'C', false);
    $pdf->MultiCell(0, 7, utf8_decode(mb_strtoupper('REALIZADO DEL ' . $fechaInicio . ' al ' . $fechaFin, 'UTF-8')), 0, 'C', false);
    $pdf->MultiCell(0, 7, utf8_decode(mb_strtoupper('CON UNA DURACIÓN DE ' . $duracion . ' HORAS', 'UTF-8')), 0, 'C', false);
    $pdf->SetFont('Montserrat-medium', '', 11);
    $pdf->Ln(10);
    $pdf->MultiCell(0, 0, strtoupper('Victoria de Durango, Dgo. a ' . $fechaFin), 0, 'C', false);
    // Posición: a 1,5 cm del final
    $pdf->SetY(-15);
    $pdf->SetFont('Montserrat', '', 11);
    // Folios
    $pdf->Cell(0, 10, $folio.'          '. utf8_decode(mb_strtoupper($ClaveRegistro.'-'.str_pad($contador, 2, "0", STR_PAD_LEFT),'utf-8')), 0, 0, 'C');

    // Nombre del PDF C_+ marca de tiempo + extension
    $archivo = 'C_' . time() . $id . '.pdf';
    // Salida del archivo -> mostrar en el navegador para su visualizar o descargar
    $pdf->Output("C:/xampp/htdocs/Residencia/ActualizacionDocente/files/" . $archivo, 'F');

    //Query para determinar si ya se ha subido un documento previamente
    $query = "SELECT * FROM constancia
                WHERE Usuario_idUsuario = $id
                AND Curso_idCurso = $idc";
    $result = mysqli_query($conn, $query);

    /* Si no existe un registro previo, hace una inserción en la base de datos. Caso contrario realiza un update para actualizar el nombre el archivo */
    if (mysqli_num_rows($result) == 0) {
        // /* Inserción del nombre del documento a la base de datos */
        $sql = "INSERT INTO constancia
        VALUES('','".$ClaveRegistro.'-'.str_pad($contador, 2, "0", STR_PAD_LEFT)."','$archivo',$idc,$id)";
        mysqli_query($conn, $sql);

        // Actualización de estado 0 -> concluyó satisfactoriamente el curso
        $sqli = "UPDATE usuario_has_curso
        SET estado = '0'
        WHERE Usuario_idUsuario = $id
        AND Curso_idCurso = $idc
        ";
        mysqli_query($conn, $sqli);
    } else {
        $sql = "UPDATE constancia
                SET rutaConstancia='$archivo'
                WHERE Usuario_idUsuario = $id
                AND Curso_idCurso = $idc";
        mysqli_query($conn, $sql);
    }
    //aumenta el contador para el folio de la constancia
    $contador++;
}

/** Obtener nombre del instructor */
$getInstructor = "SELECT upper(concat_ws(' ',i.nombre,i.apellidoPaterno,i.apellidoMaterno)) as nombre, i.idUsuario
                    FROM instructor i, curso c
                    WHERE i.idInstructor = c.Instructor_idInstructor
                    AND c.idCurso = $idc";

$result = $conn->query($getInstructor) or die($conn->error . __LINE__);
$data = mysqli_fetch_all($result, MYSQLI_ASSOC);

$instructor = $data[0]['nombre'];
$idi = $data[0]['idUsuario'];

/* Creación del RECONOCIMIENTO del instructor */

// documento en 'landscape' (orientacion horizontal)
$pdfR = new FPDF('P', 'mm', 'letter');
$pdfR->SetAutoPageBreak(false);
$pdfR->AddPage();
$pdfR->Image('C:\xampp\htdocs\Residencia\ActualizacionDocente\FPDF\RECONOCIMIENTO.jpg', 3, 0, 210);
$pdfR->Ln(43);

$pdfR->AddFont('Montserrat', '', 'montserrat.php');
$pdfR->AddFont('Montserrati', 'I', 'montserrati.php');
$pdfR->AddFont('Montserratb', 'B', 'montserratb.php');
$pdfR->AddFont('Montserrat-black', 'B', 'Montserrat-Black.php');
$pdfR->AddFont('Montserrat-medium', '', 'Montserrat-Medium.php');
$pdfR->SetFont('Montserrat-black', 'B', 18);
/* Nombre del instructor */
$pdfR->Cell(200, 150, strtoupper(utf8_decode($instructor)), 0, 0, 'C');
$pdfR->SetFont('Montserrat-medium', '', 14);
$pdfR->Ln(10);

$pdfR->Cell(200, 160, utf8_decode(mb_strtoupper('por haber impartido el curso:', 'utf-8')), 0, 0, 'C');
$pdfR->Ln(85);
$pdfR->MultiCell(0, 7, utf8_decode(mb_strtoupper($curso, 'utf-8')), 0, 'C', false);

$pdfR->MultiCell(0, 7, utf8_decode(mb_strtoupper('REALIZADO DEL ' . $fechaInicio . ' al ' . $fechaFin, 'UTF-8')), 0, 'C', false);
$pdfR->MultiCell(0, 7, utf8_decode(mb_strtoupper('CON UNA DURACIÓN DE ' . $duracion . ' HORAS', 'UTF-8')), 0, 'C', false);
$pdfR->SetFont('Montserrat-medium', '', 11);
$pdfR->Ln(10);
$pdfR->MultiCell(0, 0, strtoupper('Victoria de Durango, Dgo. a ' . $fechaFin), 0, 'C', false);
// Posición: a 1,5 cm del final
$pdfR->SetY(-15);
$pdfR->SetFont('Montserrat', '', 11);
// folios
$pdfR->Cell(0, 10, $folio.'          '. utf8_decode(mb_strtoupper($ClaveRegistro.'-'.str_pad($contador, 2, "0", STR_PAD_LEFT),'utf-8')), 0, 0, 'C');
$archivo = 'R_' . time() . '.pdf';

$pdfR->Output("C:/xampp/htdocs/Residencia/ActualizacionDocente/files/" . $archivo, 'F');

//Query para determinar si ya se ha subido un documento previamente
$queryi = "SELECT * FROM constancia
WHERE Usuario_idUsuario = $idi
AND Curso_idCurso = $idc";
$result = mysqli_query($conn, $queryi);

/* Si no existe un registro previo, hace una inserción en la base de datos. Caso contrario realiza un update para actualizar el nombre el archivo */
if (mysqli_num_rows($result) == 0) {
    // /* Inserción del nombre del documento a la base de datos */
    $sql2 = "INSERT INTO constancia
    VALUES('','".$ClaveRegistro.'-'.str_pad($contador, 2, "0", STR_PAD_LEFT)."','$archivo',$idc,$idi)";
    mysqli_query($conn, $sql2);
} else {
    $sql = "UPDATE constancia
           SET rutaConstancia='$archivo'
           WHERE Usuario_idUsuario = $idi
           AND Curso_idCurso = $idc";
    mysqli_query($conn, $sql);
}

$response['status'] = 'ok';

echo json_encode($response, true);
