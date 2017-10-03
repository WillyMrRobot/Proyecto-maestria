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
            
         
$firstName = $getPost['firstName'];
$lastName = $getPost['lastName'];
$email = $getPost['email'];
$password = $getPost['password'];
$curso = $getPost['curso'];
$birth = $getPost['birth'];

$usuarios = new ModelUsuarios();
$data = $usuarios->nuevoUsuario($firstName,$lastName,$email,$password,$curso,$birth);
echo $data;