<?php 

/*  Calcular el periodo actual  */


$response = [];

$mes = date('n');
$año = date('Y');

if ( $mes <= 6 ){
    $response['periodo'] = 'Enero / Junio ' . $año;
} else {
    $response['periodo'] = 'Agosto / Diciembre ' . $año;
}

echo json_encode($response);