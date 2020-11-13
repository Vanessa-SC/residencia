<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header("Content-Type: text/html;charset=utf-8");

if(!isset($_POST)) die();

session_start();

$response = [];

$con = mysqli_connect('localhost','root','','bd_actdocente');
$con->set_charset("utf8");

$username = mysqli_real_escape_string($con, $_POST['username']);
$password = mysqli_real_escape_string($con, $_POST['password']);



$query = "SELECT idUsuario, Departamento_idDepartamento, rol, nombreUsuario, contrasena,  concat_ws(' ',nombreU,apellidoPaterno,apellidomaterno) as nombre
FROM `usuario` WHERE `nombreUsuario`='$username' AND `contrasena`='$password'";

$result = mysqli_query($con, $query);
$user = mysqli_fetch_all($result,MYSQLI_ASSOC);


if(mysqli_num_rows($result) > 0) {
	$response['status'] = 'loggedin';
	$response['user'] = $user[0]['nombre'];
	$response['useruniqueid'] = md5(uniqid());
	$_SESSION['useruniqueid'] = $response['useruniqueid'];
} else {
	$response['status'] = 'error';
}




// echo json_encode($response);

echo json_encode($user[0]+$response,JSON_FORCE_OBJECT);
