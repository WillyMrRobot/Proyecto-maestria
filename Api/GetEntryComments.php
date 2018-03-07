<?php

session_start();
date_default_timezone_set("America/Bogota");
require_once '../Model/entradas.php';

/* Funcion para simular el $_POST */

function getPost() {
    $request = file_get_contents('php://input');
    return json_decode($request, true);
}

$getPost = getPost();
$id_publicacion = $getPost['id_publicacion'];

$entradas = new ModelEntradas();
$data = $entradas->getEntryComments($id_publicacion);
echo $data;