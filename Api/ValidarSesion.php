<?php

try {
    session_start();
    if (isset($_SESSION['email'])) {
        echo "{\"status\":\"ok\",\"data\":\"BackEnd.html\",\"email\":\"" . $_SESSION['email'] . "\",\"name\":\"" . $_SESSION['nombre'] . "\"}";
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