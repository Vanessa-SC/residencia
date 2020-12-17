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

/* Obtener fecha actual en español */
$bMeses = array("void", "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
$bDias = array("Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado");
$fecha = getdate();

$dias = $bDias[$fecha["wday"]];
$meses = $bMeses[$fecha["mon"]];

$hoy = $fecha["mday"] . " de " . $meses . " de " . $fecha["year"];

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
    $pdf->Image('C:\xampp\htdocs\Residencia\Pruebas\pruebaLogin\FPDF\CONSTANCIA.jpg', 0, 0, 220);
    $pdf->Ln(50);
    // Tipografía
    $pdf->AddFont('Montserrat','','montserrat.php');
    $pdf->AddFont('Montserrat','I','montserrati.php');
    $pdf->AddFont('Montserrat','B','montserratb.php');
    $pdf->AddFont('Montserrat-black','B','Montserrat-Black.php');
    $pdf->AddFont('Montserrat-medium','','Montserrat-Medium.php');

    $pdf->SetFont('Montserrat-black','B',18);

    /* Nombre del participante */
    $pdf->Cell(200, 160, utf8_decode( $nombre ), 0, 0, 'C');
    $pdf->SetFont('Montserrat-medium', '', 14);
    $pdf->Ln(90);

    $pdf->SetFont('Montserrat', 'I', 14);
    $pdf->MultiCell(0, 7, utf8_decode(mb_strtoupper('por su valiosa participación en el curso '.$curso,'utf-8')) , 0, 'C', false);
    $pdf->SetFont('Montserrat', 'I', 11);
    $pdf->Ln(10);
    $pdf->MultiCell(0, 0, 'Victoria de Durango, Dgo. a ' . $hoy, 0, 'C', false);

    // Nombre del PDF C_+ marca de tiempo + extension
    $archivo = 'C_' . time() . $id . '.pdf';
    // Salida del archivo -> mostrar en el navegador para su visualizar o descargar
    $pdf->Output("C:/xampp/htdocs/Residencia/Proyecto/files/" . $archivo, 'F');

    // /* Inserción del nombre del documento a la base de datos */
    $sql = "INSERT INTO constancia
            VALUES('','$folio-$id','$archivo',$idc,$id)";

    mysqli_query($conn, $sql);
}

$response['status'] = 'ok';



echo json_encode($response,true);