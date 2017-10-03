<?php

require_once 'config_inc.php';
require_once 'correo.php';

class ModelPreguntas {

    private $datosRegistro;
    private $db;
    

    public function __construct() {
        $this->datosRegistro = array();
        $this->db = new database();
    }

    function __destruct() {
        unset($this);
    }


    
    public function validarPreguntas() {
        $usuarioId = $_SESSION['id'];
        try {
            $sql = "SELECT * FROM respuestas WHERE usuarioId = :usuarioId";
            $query = $this->db->prepare($sql);
            $query->bindParam(':usuarioId', $usuarioId);
                        
            $value = $query->execute();
            if ($value) {
                $count = $query->rowCount();
                $respuestas = "";
                if ($count !== 0 ) {
                    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                        $respuestas .= strval($row['preguntaId']).",";
                        
                    }
                    if (substr($respuestas, -1, 1) == ',')
                    {
                        $respuestas = substr($respuestas, 0, -1);
                    }
                    $datos = $respuestas;
                    return "{\"status\":\"ok\",\"data\":\"" . $datos . "\"}";
                                   
                }
                else {
                    $error = "{\"status\":\"ok\",\"data\":\"[]\"}";
                    return $error;
                }
            } else {
                $error = $query->errorCode();
                $error = "{\"status\":\"error\",\"data\":\"" . $error . "\"}";
                return $error;
            }
        } catch (Exception $e) {
            $error = $e->getMessage();
            $error = "{\"status\":\"error\",\"data\":\"" . $error . "\"}";
            return $error;
        }
    }
    
    
    public function registrarRespuesta($preguntaId,$respuestaId) {
        $usuarioId = $_SESSION['id'];
        $fechaRespuesta = date("Y/m/d");
        try {
            $sql = "INSERT INTO respuestas (usuarioId, preguntaId, respuesta, fechaRespuesta) 
                    VALUES  (:usuarioId, :preguntaId, :respuesta, :fechaRespuesta)";
            $query = $this->db->prepare($sql);

            $query->bindParam(':usuarioId', $usuarioId);
            $query->bindParam(':preguntaId', $preguntaId);
            $query->bindParam(':respuesta', $respuestaId);
            $query->bindParam(':fechaRespuesta', $fechaRespuesta);
            
            
            $value = $query->execute();
            if ($value) {
                $error = "Registro satisfactorio";
                $error = "{\"status\":\"ok\",\"data\":\"" . $error . "\"}";
                return $error;
            } else {
                $error = $query->errorCode();
                $error = "{\"status\":\"error\",\"data\":\"" . $error . "\"}";
                return $error;
            }
        } catch (Exception $e) {
            $error = $e->getMessage();
            $error = "{\"status\":\"error\",\"data\":\"" . $error . "\"}";
            return $error;
        }
    }
    
}
