<?php

/* 
    Crear la Clave de Registro del curso creado por el usuario Jefe siguiendo el formato:
        xxxxx-año-departamento
    donde xxxxx es un número autoincremental y el año es a dos dígitos
*/

include_once 'conexion.php';

if (!isset($_POST)) die();
$idDepto = mysqli_real_escape_string($conn, $_POST['idDepartamento']);

/* ID 0 => Todos los departamentos, ID 1 => Departamento no asignado */
if ($idDepto != 1 && $idDepto != 0){

    /* Asignación del código del folio */
    $cod = "SELECT LEFT(ClaveRegistro,3) as cod FROM curso ORDER BY idCurso DESC LIMIT 1";
    $result = $conn->query($cod) or die($conn->error . __LINE__);
    if (mysqli_num_rows($result) == 0) {
        $code = 001;
    } else {
        $code = mysqli_fetch_assoc($result);
    }
    $codigo = intval($code['cod']) + 1;

    /* Determinando el departamento */
    $dep = "SELECT nombreDepartamento FROM departamento WHERE idDepartamento = $idDepto";
    $result = $conn->query($dep) or die($conn->error . __LINE__);

    $departamento = implode(mysqli_fetch_assoc($result));


    /* Obtencion del año */
    $año = date('y');

    /*Agregar ceros al codigo  y Creación del código final*/
    $codigo_nuevo = str_pad($codigo, 3, "0", STR_PAD_LEFT) . '-' . $año . '-' . $departamento;
    
    
    echo json_encode($codigo_nuevo);
} else if ($idDepto == 0){

    /* Asignación del código del folio */
    $cod = "SELECT LEFT(ClaveRegistro,3) as cod FROM curso ORDER BY idCurso DESC LIMIT 1";
    $result = $conn->query($cod) or die($conn->error . __LINE__);
    if (mysqli_num_rows($result) > 0) {
        $code = mysqli_fetch_assoc($result);
    } else {
        $code = 001;
    }
    $codigo = intval($code['cod']) + 1;

    /* Determinando el departamento */
    $departamento = "ITD";


    /* Obtencion del año */
    $año = date('y');

    /*Agregar ceros al codigo  y Creación del código final*/
    $codigo_nuevo = str_pad($codigo, 3, "0", STR_PAD_LEFT) . '-' . $año . '-' . $departamento;
    
    
    echo json_encode($codigo_nuevo);
}


else {

    /* Asignación del código del folio */
    $cod = "SELECT LEFT(Folio,5) as cod FROM curso ORDER BY idCurso DESC LIMIT 1";
    $result = $conn->query($cod) or die($conn->error . __LINE__);
    if (mysqli_num_rows($result) > 0) {
        $code = mysqli_fetch_assoc($result);
    } else {
        $code = 00001;
    }
    $codigo = intval($code['cod']) + 1;

    /* Obtencion del año */
    $año = date('y');

    /*Agregar ceros al codigo  y Creación del código final*/
    $codigo_nuevo = str_pad($codigo, 5, "0", STR_PAD_LEFT) . '-' . $año;
    
    
    echo json_encode($codigo_nuevo);

}
