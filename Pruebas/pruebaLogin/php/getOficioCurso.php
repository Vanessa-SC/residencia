<?php


require '..\FPDF\force_justify.php';

include_once 'conexion.php';

/* Obtencion de datos pasados por URL */
$idDepartamento = $_GET['idd'];
$idCurso = $_GET['idc'];
$idUsuario = $_GET['idu'];

/* Formato de fecha en español */
$formatt = "SET lc_time_names = 'es_MX' ";
mysqli_query($conn,$formatt);

/* Obtener nombre del departamento */
$sqlGetDepto = "SELECT nombreDepartamento
                FROM departamento
                WHERE idDepartamento='$idDepartamento'";

$res = mysqli_query($conn,$sqlGetDepto);
$departamento = mysqli_fetch_array ($res);

/* Obtener nombre del coordinador(a) de Actualizacion Docente */
$sqlGetCoord = "SELECT Jefe
                FROM departamento
                WHERE nombreDepartamento='Actualización Docente'";

$res1 = mysqli_query($conn, $sqlGetCoord);
$coord= mysqli_fetch_array ($res1);

/* Obtener nombre del Jefe de Desarrollo Académico */
$sqlGetJefe  = "SELECT Jefe
                FROM departamento
                WHERE nombreDepartamento='Desarrollo Académico'";

$res2 = mysqli_query($conn, $sqlGetJefe);
$jefe = mysqli_fetch_array ($res2);

/* Obtener nombre del usuario */
$sqlGetNombre = "SELECT concat_ws(' ',nombre,apellidoPaterno,apellidoMaterno) as nombre
                 FROM usuario
                 WHERE idUsuario='$idUsuario'";

$res3 = mysqli_query($conn,$sqlGetNombre);
$usuario = mysqli_fetch_array ($res3);

/* Obtener datos del curso */
$datosCurso = "SELECT
                    idCurso,
                    nombreCurso,
                    duracion,
                    concat_ws(' al ', DATE_FORMAT(fechaInicio, '%d de %M'), DATE_FORMAT(fechaFin, '%d de %M del %Y')) as fecha,
                    modalidad,
                    objetivo,
                    DATE_FORMAT(created_at, '%d de %M, %Y') as creacion,
                    created_by as usuario
                FROM curso
                WHERE idCurso='$idCurso'";

$res4 = mysqli_query($conn, $datosCurso);
$curso = mysqli_fetch_array ($res4);


/* Creación el oficio */

$pdf = new FPDF('P', 'mm', 'letter');
$pdf->SetAutoPageBreak(false);
$pdf->AddPage();
$pdf->SetFillColor(255,255,255);
$pdf->SetLeftMargin(30);
$pdf->SetRightMargin(25);
$pdf->SetFont('Arial', '', 12);
$pdf->Ln(20);

$pdf->Cell(155, 0, 'Durango, Dgo. a ' . $curso['creacion'], 0, 1, 'R');
$pdf->Ln(5);
$pdf->Cell(155, 0, 'OFICIO No. '.$curso['idCurso'], 0, 1, 'R');
$pdf->Ln(20);

$pdf->SetFont('', 'B', 12);
$pdf->Cell(170, 0, utf8_decode($jefe[0]), 0, 1, 'L');
$pdf->Ln(5);
$pdf->Cell(170, 0, utf8_decode('JEFE/JEFA DEL DEPTO. DE DESARROLLO ACADÉMICO'), 0, 1, 'L');
$pdf->Ln(15);

$pdf->Cell(155, 0,"At'n: ". utf8_decode($coord[0]), 0, 1, 'R');
$pdf->Ln(5);
$pdf->Cell(155, 0, utf8_decode('Coordinador(a) de Actualización Docente'), 0, 1, 'R');
$pdf->Ln(15);

$pdf->SetFont('', 'B', 12);
$pdf->Cell(170, 0, 'PRESENTE', 0, 1, 'L');
$pdf->Ln(5);
$pdf->SetFont('', '', 12);

$pdf->MultiCell(155, 7, utf8_decode('Por este conducto me permito solicitar su amable intervención para la validación y registro del CURSO: "' . $curso['nombreCurso'] . '", mismo que tiene una duración de ' . $curso['duracion'] . ' horas en la modalidad ' . $curso['modalidad'] . ', comprendido del '.$curso['fecha'].', dirigido al personal docente de nuestro Instituto, cuyo objetivo general es: "' . $curso['objetivo'].'".'),0,'FJ',0);

$pdf->Ln(15);

$pdf->MultiCell(153, 7, utf8_decode('Agradeciendo de antemano su atención, me es grato reiterarle mi consideración alta y distinguida.'), 0, 'FJ', 0);

$pdf->Ln(15);
$pdf->SetFont('', 'B', 12);
$pdf->Cell(105, 0, 'ATENTAMENTE', 0, 0,'L');
$pdf->Ln(30);


$pdf->Cell(strlen($curso['usuario'])*2.3, 0, utf8_decode($curso['usuario']), 0, 0,'L');
$pdf->Ln(5);
$pdf->Cell(105, 0, 'DEPARTAMENTO DE '.utf8_decode($departamento[0]), 0, 0,'L');
// // // Nombre del PDF
$archivo = 'doc_' . time() . '.pdf';
$pdf->Output($archivo, 'I');
// print $usuario;