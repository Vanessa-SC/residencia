<?php

/* genera una constancia para un usuario */

/* Import de la conexión y la librería para la creación 
   del documento PDF */
require '../FPDF/fpdf.php';
include_once 'conexion.php';

/* Recepción de datos */
$datos = json_decode(file_get_contents("php://input"));

$preFolioCons = "";
$ClaveRegistro = $datos->ClaveRegistro;

/*Query para determinar si ya se han creado constancias anteriormente para el curso */
$query = "SELECT * FROM constancia WHERE Curso_idCurso = $datos->idCurso";
$result = mysqli_query($conn, $query);


/* Si no existe un registro previo, el numero del folio inicia en 001 */
if (mysqli_num_rows($result) == 0 ) {
    $folioCons = $ClaveRegistro.'-001';
} else {
    /** obtener ultimo folio */
    $getFolio = "SELECT RIGHT(folio,3) as cod FROM constancia WHERE Curso_idCUrso = $datos->idCurso ORDER BY cod DESC LIMIT 1 ";
    $res = mysqli_query($conn,$getFolio);
    $code = mysqli_fetch_assoc($res);
    $codigo = intval($code['cod']) + 1;

    $folioCons = $ClaveRegistro.'-'.str_pad($codigo, 3, "0", STR_PAD_LEFT);
}

/* Creación del documento PDF */
class PDF extends FPDF
{
    // Pie de página
    public function Footer()
    {
        global $datos;
        global $folioCons;
       
        // Posición: a 1,5 cm del final
        $this->SetY(-15);
        // fuente
        $this->SetFont('Montserrat', '', 11);
        // folios
        $this->Cell(0, 10, $datos->folio.'          '.utf8_decode(mb_strtoupper($folioCons,'utf-8')), 0, 0, 'C');
    }
}
// documento en 'landscape' (orientacion horizontal)
$pdf = new PDF('P', 'mm', 'letter');
// Deshabilitar el salto de página automático
$pdf->SetAutoPageBreak(false);
// Agregar página
$pdf->AddPage();
// Background
$pdf->Image('C:\xampp\htdocs\Residencia\ActualizacionDocente\FPDF\CONSTANCIA.jpg', 0, 0, 220);
$pdf->Ln(50);
// Tipografía
$pdf->AddFont('Montserrat','','montserrat.php');
$pdf->AddFont('Montserrati','I','montserrati.php');
$pdf->AddFont('Montserratb','B','montserratb.php');
$pdf->AddFont('Montserrat-black','B','Montserrat-Black.php');
$pdf->AddFont('Montserrat-medium','','Montserrat-Medium.php');

$pdf->SetFont('Montserrat-black','B',18);

/* Nombre del participante */
$pdf->Cell(200, 160, strtoupper(utf8_decode($datos->participante)), 0, 0, 'C');
$pdf->Ln(10);
$pdf->SetFont('Montserrat-medium', '', 14);
$pdf->Cell(200, 160, utf8_decode(mb_strtoupper('por su participación en el curso:', 'utf-8')), 0, 0, 'C');
$pdf->Ln(85);
$pdf->MultiCell(0, 7, utf8_decode(mb_strtoupper($datos->curso, 'utf-8')), 0, 'C', false);
$pdf->MultiCell(0, 7, utf8_decode(mb_strtoupper('REALIZADO DEL ' . $datos->fechaInicio.' al '.$datos->fechaFin, 'UTF-8')), 0, 'C', false);
$pdf->MultiCell(0, 7, utf8_decode(mb_strtoupper('CON UNA DURACIÓN DE ' . $datos->duracion . ' HORAS', 'UTF-8')), 0, 'C', false);
$pdf->SetFont('Montserrat-medium', '', 11);
$pdf->Ln(10);
$pdf->MultiCell(0, 0, strtoupper('Victoria de Durango, Dgo. a ' . $datos->fechaFin), 0, 'C', false);

// Nombre del PDF C_+ marca de tiempo + extension
$archivo = 'C_' . time() . '.pdf';
// Salida del archivo -> mostrar en el navegador para su visualizar o descargar
$pdf->Output("C:/xampp/htdocs/Residencia/ActualizacionDocente/files/" . $archivo, 'F');

//Query para determinar si ya se ha subido un documento previamente
$query = "SELECT * FROM constancia
WHERE Usuario_idUsuario = $datos->idUsuario
AND Curso_idCurso = $datos->idCurso";
$result = mysqli_query($conn, $query);

/* Si no existe un registro previo, hace una inserción en la base de datos. Caso contrario realiza un update para actualizar el nombre el archivo */
if (mysqli_num_rows($result) == 0 ) {
    /* Inserción del nombre del documento a la base de datos */
    $sql = "INSERT INTO constancia
            VALUES('','". $folioCons."','$archivo',$datos->idCurso,$datos->idUsuario)";
} else {
    $sql = "UPDATE constancia
            SET rutaConstancia='$archivo'
            WHERE Usuario_idUsuario = $datos->idUsuario
            AND Curso_idCurso = $datos->idCurso";
}

/* Ejecucuón del Query */
if (mysqli_query($conn, $sql)) {
    $response['status'] = 'ok';
} else {
    $response['status'] = 'error';
}

$sqli = "UPDATE usuario_has_curso
        SET estado = '0'
        WHERE Usuario_idUsuario = $datos->idUsuario
        AND Curso_idCurso = $datos->idCurso
        ";

mysqli_query($conn, $sqli);

/* Respuesta */
echo json_encode($response, JSON_FORCE_OBJECT);
