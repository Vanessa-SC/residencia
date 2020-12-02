<?php

include_once 'conexion.php';

date_default_timezone_set('America/Mexico_City');

$res = [];

$fecha = date('d/m/Y');

    $res['fecha'] = $fecha;
    
echo json_encode($res);

?>