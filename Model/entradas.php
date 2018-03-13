<?php

require_once 'config_inc.php';
require_once 'correo.php';

class ModelEntradas {

    private $datosRegistro;
    private $db;
    

    public function __construct() {
        $this->datosRegistro = array();
        $this->db = new database();
    }

    function __destruct() {
        unset($this);
    }
    
    public function getAllEntries() {
        
        try {
            $sql = "SELECT p.*,u.nombre,u.foto FROM publicaciones p , usuario u where u.id_user = p.id_usuario  order by fecha_creacion desc";
            $query = $this->db->prepare($sql);
                        
            $value = $query->execute();
            if ($value) {
                $count = $query->rowCount();
                $respuestas = "";
                if ($count !== 0 ) {
                    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                        $DataEvents[] = array( 
                            'userFoto' => $row['foto'],
                            'userName' => $row['nombre'],
                            'id_publicacion' => $row['id_publicacion'],
                            'titulo' => $row['titulo'],
                            'comentarios' => $row['comentarios'],
                            'visto' => $row['visto'],
                            'fecha_creacion' => $row['fecha_creacion'],
                        );
                    }
                    $datos = json_encode($DataEvents);
                    return "{\"status\":\"ok\",\"data\": $datos }";
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

    public function getEntry($id_publicacion) {
		try {
			$sql = "SELECT p.*,u.nombre,u.foto FROM publicaciones p , usuario u where u.id_user = p.id_usuario 	and p.id_publicacion = :id_publicacion  order by fecha_creacion desc";
			$query = $this->db->prepare($sql);
			$query->bindParam(':id_publicacion', $id_publicacion);
			$value = $query->execute();
			if ($value) {
				$count = $query->rowCount();
				$respuestas = "";
				if ($count !== 0 ) {
					$row = $query->fetch(PDO::FETCH_ASSOC);
					$DataEvents = array( 
						'userFoto' => $row['foto'],
						'userName' => $row['nombre'],
						'id_publicacion' => $row['id_publicacion'],
						'titulo' => $row['titulo'],
						'comentarios' => $row['comentarios'],
						'visto' => $row['visto'],
						'fecha_creacion' => $row['fecha_creacion'],
						'contenido' => $row['contenido'],
					);
					$datos = json_encode($DataEvents);
					return "{\"status\":\"ok\",\"data\": $datos }";
				} else {
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
		
	public function getEntryComments($id_publicacion) {
			try {
				$sql = "SELECT c.*,u.nombre,u.foto FROM comentarios c , usuario u where u.id_user = c.id_usuario 	and c.id_publicacion = :id_publicacion  order by id_parent_comment asc, fecha_creacion desc";
				$query = $this->db->prepare($sql);
				$query->bindParam(':id_publicacion', $id_publicacion);
				$value = $query->execute();
				if ($value) {
						$count = $query->rowCount();
						$respuestas = "";
						if ($count !== 0 ) {
								while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
										$DataEvents[] = array( 
												'userFoto' => $row['foto'],
												'userName' => $row['nombre'],
												'id_publicacion' => $row['id_publicacion'],
												'id_comentario' => $row['id_comentario'],
												'id_parent_comment' => $row['id_parent_comment'],
												'comentario' => $row['comentario'],
												'fecha_creacion' => $row['fecha_creacion'],
										);
								}
								$datos = json_encode($DataEvents);
								return "{\"status\":\"ok\",\"data\": $datos }";
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
	
	public function registrarComentario($id_publicacion,$comentario,$id_parent_comment) {
			$id_usuario = $_SESSION['id_user'];
			$fecha_creacion = date("Y/m/d H:i:s");
			$id_comentario = $this->GUID();
			
			try {
				$sql = "INSERT INTO comentarios (id_usuario, id_comentario,id_publicacion, comentario, fecha_creacion,id_parent_comment) 
						VALUES  (:id_usuario, :id_comentario, :id_publicacion, :comentario,:fecha_creacion,:id_parent_comment)";
				$query = $this->db->prepare($sql);
	
				$query->bindParam(':id_usuario', $id_usuario);
				$query->bindParam(':id_comentario', $id_comentario);
				$query->bindParam(':id_publicacion', $id_publicacion);
				$query->bindParam(':comentario', $comentario);
				$query->bindParam(':fecha_creacion', $fecha_creacion);
				$query->bindParam(':id_parent_comment', $id_parent_comment);
				
				
				$value = $query->execute();
				if ($value) {
					$error = "Registro satisfactorio";
					$error = "{\"status\":\"ok\",\"data\":\"" . $error . "\"}";
					return $error;
				} else {
					$error = $query->errorCode();
					$error = "{\"status\":\"error\",\"data\":\""  . $id_comentario . "\"}";
					return $error;
				}
			} catch (Exception $e) {
				$error = $e->getMessage();
				$error = "{\"status\":\"error\",\"data\":\"" . $error . "\"}";
				return $error;
			}
		}

		function GUID()
		{
			if (function_exists('com_create_guid') === true)
			{
				return trim(com_create_guid(), '{}');
			}
		
			return sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
		}

}
