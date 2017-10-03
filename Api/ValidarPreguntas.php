<?php

session_start();
date_default_timezone_set("America/Bogota");
require_once '../Model/preguntas.php';

/* Funcion para simular el $_POST */

function getPost() {
    $request = file_get_contents('php://input');
    return json_decode($request, true);
}

$preguntas = new ModelPreguntas();
$data = $preguntas->validarPreguntas();
echo $data;