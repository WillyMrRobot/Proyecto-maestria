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
		
		public function getEntryComments($id_publicacion) {
			try {
				$sql = "SELECT c.*,u.nombre,u.foto FROM comentarios c , usuario u where u.id_user = c.id_usuario 	and c.id_publicacion = :id_publicacion  order by fecha_creacion desc";
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

}
