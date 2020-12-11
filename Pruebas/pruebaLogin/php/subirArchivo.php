<?php

/* Sube el documento de un curso */

// Conexión y recepción de datos
    include 'conexion.php';
    // Array que contiene el documento
    $data = json_decode(file_get_contents("php://input"));
    // IDs pasados vía POST
    if (!isset($_POST)) die();
    $idCurso = ($_POST['idCurso']);
    $idDocumento = ($_POST['idDocumento']);

    //Array de respuesta
    $response = [];
    
    // Verificación de que se está recibiendo un archivo
if (!empty($_FILES['archivo'])) {
    // Verificación de que el formato de archivo sea PDF
    if (($_FILES['archivo']['type'] == "application/pdf")) {
        // Verificación de que el archivo no se haya subido con errores
        if (($_FILES['archivo']['error'] > 0)) {
            $response['status'] = "Error archivo";
        } else {
            //Obtención de la extensión del archivo
            $ext = pathinfo($_FILES['archivo']['name'], PATHINFO_EXTENSION);
            //Nuevo nombre del archivo
            $archivo = 'doc' . time() . '.' . $ext;
            //Directorio destino
            $location = 'c://xampp/htdocs/Residencia/proyecto/files/';
            // Subida (movida) del archivo al directorio destino
            move_uploaded_file($_FILES['archivo']['tmp_name'], $location . $archivo);

            //Query para determinar si ya se ha subido un documento previamente
            $query = "SELECT * FROM curso_has_documento
                     WHERE curso_idCurso='$idCurso'
                     AND documento_idDocumento='$idDocumento'";
            $result = mysqli_query($conn, $query);

            /* Si no existe un registro previo, hace una inserción en la base de datos. Caso contrario realiza un update para actualizar el nombre el archivo */
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

// Respuesta
echo json_encode($response);
