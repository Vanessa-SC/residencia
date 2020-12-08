<?php

include 'conexion.php';

$data = json_decode(file_get_contents("php://input"));

if (!isset($_POST)) {
    die();
}

$idCurso = ($_POST['idCurso']);
$idDocumento = ($_POST['idDocumento']);

$response = [];

// echo $idDocumento.' '.$idCurso;

if (!empty($_FILES['archivo'])) {
    if (($_FILES['archivo']['type'] == "application/pdf")) {
        if (($_FILES['archivo']['error'] > 0)) {
            $response['status'] = "Error archivo";
        } else {
            $ext = pathinfo($_FILES['archivo']['name'], PATHINFO_EXTENSION);
            $archivo = 'doc' . time() . '.' . $ext;
            $location = 'c://xampp/htdocs/Residencia/proyecto/files/';
            move_uploaded_file($_FILES['archivo']['tmp_name'], $location . $archivo);

            $query = "SELECT * FROM curso_has_documento
                     WHERE curso_idCurso='$idCurso'
                     AND documento_idDocumento='$idDocumento'";

            $result = mysqli_query($conn, $query);

            if ($rowcount = mysqli_num_rows($result) == 0 ) {
                $sql = "INSERT INTO curso_has_documento
                        VALUES('$idCurso','$idDocumento','$archivo','NO',null)";
            } else {
                $sql = "UPDATE curso_has_documento
                        SET rutaArchivo='$archivo', estadoVerificado='NO', comentario=null
                        WHERE curso_has_documento.Curso_idCurso='$idCurso'
                        AND curso_has_documento.Documento_idDocumento='$idDocumento'";
            }

            if (mysqli_query($conn, $sql)) {
                $response['status'] = 'ok';
                $response['doc'] = $archivo;
            } else {
                $response['status'] = 'error: ' . mysqli_error($conn);
            }

        }
    }
}

echo json_encode($response);
