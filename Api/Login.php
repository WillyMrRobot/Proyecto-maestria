<?php

session_start();
date_default_timezone_set("America/Bogota");
require_once '../Model/usuarios.php';

/* Funcion para simular el $_POST */
function getPost() {
    $request = file_get_contents('php://input');
    return json_decode($request, true);
}

$getPost = getPost();
        
$email = $getPost['email'];
$password = $getPost['password'];


$usuarios = new ModelUsuarios();
$data = $usuarios->login($email,$password);
echo $data;