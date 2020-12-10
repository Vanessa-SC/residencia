<?php

/* Registra las respuestas de un usuario en una encuesta */

/* Recepcion de datos y conexión */
$datos = json_decode(file_get_contents("php://input"),true);

include_once 'conexion.php';

/* Separar el arreglo */
$respuestas = $datos['respuestas'];
$idCurso = $datos['idCurso'];
$idUsuario = $datos['idUsuario'];
$idEncuesta = $datos['idEncuesta'];

/* Validar si se reciben sugerencias */
if(!empty($datos['sugerencias'])){
$sugerencias = $datos['sugerencias'];
}

$response = [];
$contador = 0;

/* Recorrer el arreglo y hacer inserciones  */
    foreach($respuestas as $key => $value){

        $sql = "INSERT INTO usuario_responde_encuesta
                VALUES($idUsuario,$idCurso,$idEncuesta,$key,$value,null)";
                
        if(mysqli_query($conn,$sql)){
            $contador = $contador + 1;
        }
    }

    /* Insertar sugerencias */
    if(!empty($sugerencias)){
        $sql2 = "INSERT INTO sugerencia
                VALUES('','$sugerencias',$idCurso,$idUsuario)";
        mysqli_query($conn, $sql2);
    }
    
    /* Si todas las preguntas se insertaron devuelve OK */
    if($contador == sizeof($respuestas)){
        $response['status'] = 'ok';
    }

echo json_encode($response, true);