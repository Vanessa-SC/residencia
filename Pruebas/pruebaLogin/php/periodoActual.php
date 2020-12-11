<?php 

/*  Calcular el periodo actual  */

$response = [];
// Día y año actual
$mes = date('n');
$año = date('Y');

if ( $mes <= 6 ){
    $response['periodo'] = 'Enero / Junio ' . $año;
} else {
    $response['periodo'] = 'Agosto / Diciembre ' . $año;
}
// Resultado
echo json_encode($response);