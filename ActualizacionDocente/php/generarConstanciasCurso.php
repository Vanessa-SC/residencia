<?php

/** Generar grupo de constancias para usuarios con 80% de asistencia **/

/* Recepción de los datos del curso, conexión, array de respuesta, libreria FPDF */
$data = json_decode(file_get_contents('php://input'));
require '../FPDF/fpdf.php';
include_once 'conexion.php';
$response = [];


/* Separación de datos del curso */
$curso = $data->curso;
$idc = $data->idCurso;
$folio = $data->folio;
$fecha = $data->fecha;

// Obtener listado de participantes con asistencia mayor a 80%
$queryAlumnos   =  "SELECT a.Usuario_idUsuario as idUsuario, 
                    upper(concat_ws(' ',u.nombre,u.apellidoPaterno,u.apellidoMaterno)) as nombre
                    FROM asistencia a, usuario u
                    WHERE a.Curso_idCurso = $idc 
                    AND a.Usuario_idUsuario = u.idUsuario
                    group by a.Usuario_idUsuario
                    HAVING ROUND((SUM(CASE WHEN a.asistencia = '1' THEN 1 ELSE 0 END)/COUNT(*)*100),2) >= 80";


$res = mysqli_query($conn, $queryAlumnos);
$participantes = mysqli_fetch_all ($res);

// Obtener listado de participantes con asistencia menor a 80%
$queryAlumnosR   =  "SELECT a.Usuario_idUsuario as idUsuario, 
                    upper(concat_ws(' ',u.nombre,u.apellidoPaterno,u.apellidoMaterno)) as nombre
                    FROM asistencia a, usuario u
                    WHERE a.Curso_idCurso = $idc 
                    AND a.Usuario_idUsuario = u.idUsuario
                    group by a.Usuario_idUsuario
                    HAVING ROUND((SUM(CASE WHEN a.asistencia = '1' THEN 1 ELSE 0 END)/COUNT(*)*100),2) <= 80";


$resA = mysqli_query($conn, $queryAlumnosR);
$participantesR = mysqli_fetch_all ($resA);

/* Recorrer el arreglo y hacer inserciones  */
foreach($participantesR as list($id,$nombre)){
    $sqli = "UPDATE usuario_has_curso
        SET estado = '2'
        WHERE Usuario_idUsuario = $id
        AND Curso_idCurso = $idc
        ";

    mysqli_query($conn, $sqli);
}

/* Recorrer el arreglo y hacer inserciones  */
foreach($participantes as list($id,$nombre)){
   
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
    $pdf->AddFont('Montserrat','','montserrat.php');
    $pdf->AddFont('Montserrat','I','montserrati.php');
    $pdf->AddFont('Montserrat','B','montserratb.php');
    $pdf->AddFont('Montserrat-black','','Montserrat-Black.php');
    $pdf->AddFont('Montserrat-medium','','Montserrat-Medium.php');

    $pdf->SetFont('Montserrat-black','',18);

    /* Nombre del participante */
    $pdf->Cell(200, 160, utf8_decode( $nombre ), 0, 0, 'C');
    $pdf->SetFont('Montserrat-medium', '', 14);
    $pdf->Ln(90);

    $pdf->SetFont('Montserrat-medium', '', 14);
    $pdf->MultiCell(0, 7, utf8_decode(mb_strtoupper('por su valiosa participación en el curso '.$curso,'utf-8')) , 0, 'C', false);
    $pdf->SetFont('Montserrat-medium', '', 11);
    $pdf->Ln(10);
    $pdf->MultiCell(0, 0, 'Victoria de Durango, Dgo. a ' . $fecha, 0, 'C', false);

    // Nombre del PDF C_+ marca de tiempo + extension
    $archivo = 'C_' . time() . $id . '.pdf';
    // Salida del archivo -> mostrar en el navegador para su visualizar o descargar
    $pdf->Output("C:/xampp/htdocs/Residencia/ActualizacionDocente/files/" . $archivo, 'F');

    // /* Inserción del nombre del documento a la base de datos */
    $sql = "INSERT INTO constancia
            VALUES('','$folio-$id','$archivo',$idc,$id)";

    mysqli_query($conn, $sql);

    $sqli = "UPDATE usuario_has_curso
        SET estado = '0'
        WHERE Usuario_idUsuario = $id
        AND Curso_idCurso = $idc
        ";

    mysqli_query($conn, $sqli);
}

/** Obtener nombre del instructor */
$getInstructor  =  "SELECT upper(concat_ws(' ',i.nombre,i.apellidoPaterno,i.apellidoMaterno)) as nombre, i.idUsuario
                    FROM instructor i, curso c
                    WHERE i.idInstructor = c.Instructor_idInstructor
                    AND c.idCurso = $idc";


$result = $conn->query($getInstructor) or die($conn->error . __LINE__);
$data = mysqli_fetch_all($result, MYSQLI_ASSOC);

$instructor = $data[0]['nombre'];
$idi = $data[0]['idUsuario'];

/* Creación del RECONOCIMIENTO del instructor */

// documento en 'landscape' (orientacion horizontal)
$pdf = new FPDF('P', 'mm', 'letter');
$pdf->SetAutoPageBreak(false);
$pdf->AddPage();
$pdf->Image('C:\xampp\htdocs\Residencia\ActualizacionDocente\FPDF\RECONOCIMIENTO.jpg', 3, 0, 210);
$pdf->Ln(43);

$pdf->AddFont('Montserrat','','montserrat.php');
$pdf->AddFont('Montserrati','I','montserrati.php');
$pdf->AddFont('Montserratb','B','montserratb.php');
$pdf->AddFont('Montserrat-black','B','Montserrat-Black.php');
$pdf->AddFont('Montserrat-medium','','Montserrat-Medium.php');
$pdf->SetFont('Montserrat-black','B',18);
/* Nombre del instructor */
$pdf->Cell(200, 160, $instructor, 0, 0, 'C');
$pdf->SetFont('Montserrat-medium', '', 14);
$pdf->Ln(90);
$pdf->MultiCell(0, 5, utf8_decode(mb_strtoupper('por haber impartido el curso '.$curso,'utf-8')) , 0, 'C', false);
$pdf->SetFont('Montserrat-medium', '', 11);
$pdf->Ln(15);
$pdf->MultiCell(0, 0, utf8_decode(mb_strtoupper('Victoria de Durango, Dgo. a ' . $fecha,'utf-8')), 0, 'C', false);

$archivo = 'R_' . time() . '.pdf';

$pdf->Output("C:/xampp/htdocs/Residencia/ActualizacionDocente/files/" . $archivo, 'F');

$sql2 = "INSERT INTO constancia
        VALUES('','$folio-$idi-R','$archivo',$idc,$idi)";


mysqli_query($conn, $sql2);




$response['status'] = 'ok';


echo json_encode($response,true);
