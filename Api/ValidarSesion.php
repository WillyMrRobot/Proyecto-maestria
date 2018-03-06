<?php

try {
    session_start();
    if (isset($_SESSION['correo'])) {
        echo "{\"status\":\"ok\",\"data\":\"BackEnd.html\",\"correo\":\"" . $_SESSION['correo'] . "\",\"name\":\"" . $_SESSION['nombre'] . "\"}";
    }
    else {
        //El usuario no tiene session
        echo "{\"status\":\"error\",\"data\":\"NoSession\"}";
    }

} catch (Exception $e) {
    $error = $e->getMessage();
    $error = "{\"status\":\"error\",\"data\":\"" . $error . "\"}";
    echo "{\"status\":\"error\",\"data\":\"NoSession\"}";
}