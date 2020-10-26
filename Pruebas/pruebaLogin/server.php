<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

if(!isset($_POST)) die();

session_start();

$response = [];

$con = mysqli_connect('localhost','root','','bd_actdocente');


$username = mysqli_real_escape_string($con, $_POST['username']);
$password = mysqli_real_escape_string($con, $_POST['password']);



$query = "SELECT * FROM `usuario` WHERE `nombreUsuario`='$username' AND `contrasena`='$password'";

$result = mysqli_query($con, $query);
$user = mysqli_fetch_all($result,MYSQLI_ASSOC);


if(mysqli_num_rows($result) > 0) {
	$response['status'] = 'loggedin';
	$response['user'] = $username;
	$response['useruniqueid'] = md5(uniqid());
	$_SESSION['useruniqueid'] = $response['useruniqueid'];
} else {
	$response['status'] = 'error';
}




// echo json_encode($response);

echo json_encode($user[0]+$response,JSON_FORCE_OBJECT);
