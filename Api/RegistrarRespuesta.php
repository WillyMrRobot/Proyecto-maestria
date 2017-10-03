<?php

session_start();
date_default_timezone_set("America/Bogota");
require_once '../Model/preguntas.php';

/* Funcion para simular el $_POST */

function getPost() {
    $request = file_get_contents('php://input');
    return json_decode($request, true);
}

$getPost = getPost();
            
         
$preguntaId = $getPost['preguntaId'];
$respuestaId = $getPost['respuestaId'];


$usuarios = new ModelPreguntas();
$data = $usuarios->registrarRespuesta($preguntaId,$respuestaId);
echo $data;