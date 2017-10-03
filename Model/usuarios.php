<?php

require_once 'config_inc.php';
require_once 'correo.php';

class ModelUsuarios {

    private $datosRegistro;
    private $db;
    

    public function __construct() {
        $this->datosRegistro = array();
        $this->db = new database();
    }

    function __destruct() {
        unset($this);
    }

    public function nuevoUsuario($firstName,$lastName,$email,$password,$curso,$birth) {

        try {
            $sql = "INSERT INTO usuarios (firstName, lastName, email, password, curso,birth) 
                    VALUES  (:firstName, :lastName, :email, :password, :curso,:birth)";
            $query = $this->db->prepare($sql);

            $query->bindParam(':firstName', $firstName);
            $query->bindParam(':lastName', $lastName);
            $query->bindParam(':email', $email);
            $query->bindParam(':password', $password);
            $query->bindParam(':curso', $curso);
            $query->bindParam(':birth', $birth);
            
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
    
    public function Login($email,$password) {
        try {
            $sql = "SELECT * FROM usuarios WHERE password = :password and email = :email";
            $query = $this->db->prepare($sql);
            $query->bindParam(':email', $email);
            $query->bindParam(':password', $password);
            
            $value = $query->execute();
            if ($value) {
                $count = $query->rowCount();
                if ($count !== 0 ) {
                    $res = $query->fetch(PDO::FETCH_ASSOC);
                    if ($password === $res['password'])
                    {
                        $_SESSION['id'] = $res['id'];
                        $_SESSION['email'] = $res['email'];
                        $_SESSION['nombre'] = $res['firstName']." ".$res['lastName'];
                        return "{\"status\":\"ok\",\"data\":\"portal.html\"}";
                    }
                    if ($password != $res['password'])
                    {
                        return "{\"status\":\"error\",\"data\":\"NoPassword\}";
                    }
                                   
                }
                return "{\"status\":\"error\",\"data\":\"NoExist\",\"email\":\"error\",\"name\":\"error\"}";
            } else {
                return "{\"status\":\"error\",\"data\":\"NoExist\",\"email\":\"error\",\"name\":\"error\"}";
            }
        } catch (Exception $e) {
            $error = $e->getMessage();
            $error = "{\"status\":\"error\",\"data\":\"" . $error . "\"}";
            return $error;
        }
    }
    
    public function GetUsuarios() {
        try {
            $sql = "Select u.*,e.empresaNombre as UsuarioEmpresaNombre from usuarios u , empresas e where u.UsuarioEmpresa = e.empresaId";
            $result = $this->db->prepare($sql);
            $value = $result->execute();
            if ($value) {
                $count = $result->rowCount();
                if ($count != 0) {
                    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                        $DataEvents[] = array(
                            'UsuarioId' => $row['UsuarioId'],
                            'UsuarioNombre' => $row['UsuarioNombre'],
                            'UsuarioEmail' => $row['UsuarioEmail'],
                            'UsuarioAcceso' => $row['UsuarioAcceso'],
                            'UsuarioNivel' => $row['UsuarioNivel'],
                            'UsuarioEstado' => $row['UsuarioEstado'],
                            'UsuarioEmpresaNombre' => $row['UsuarioEmpresaNombre'],
                            //'UsuarioPassword' => $row['UsuarioPassword'],
                            'UsuarioEmpresa' => $row['UsuarioEmpresa']
                        );
                    }
                    $datos = json_encode($DataEvents);
                    return "{\"status\":\"ok\",\"data\":" . $datos . "}";
                } else {
                    $error = "{\"status\":\"ok\",\"data\":\"[]\"}";
                    return $error;
                }
            } else {
                $error = $result->errorCode();
                $error = "{\"status\":\"error\",\"data\":\"" . $error . "\"}";
                return $error;
            }
        } catch (Exception $e) {
            $error = $e->getMessage();
            $error = "{\"status\":\"error\",\"data\":\"" . $error . "\"}";
            return $error;
        }
    }
    
    public function GetUserByMail($UsuarioEmail) {
        try {
            $sql = "SELECT * FROM usuarios WHERE UsuarioEmail = :UsuarioEmail)";
            $query = $this->db->prepare($sql);
            $query->bindParam(':UsuarioEmail', $UsuarioEmail);
            $value = $query->execute();
            if ($value) {
                $count = $query->rowCount();
                if ($count !== 0 ) {
                    $res = $query->fetch(PDO::FETCH_ASSOC);
                    return $res;
                }
                return null;
            } else {
                return null;
            }
        } catch (Exception $e) {
            $error = $e->getMessage();
            $error = "{\"status\":\"error\",\"data\":\"" . $error . "\"}";
            return null;
        }
    }
    
    public function EditarUsuario($UsuarioNombre, $UsuarioEmail,$UsuarioAcceso,$UsuarioPassword,$UsuarioNivel,$UsuarioEstado,$UsuarioEmpresa,$UsuarioId) {
        try {
            $sql = "Update usuarios SET UsuarioNombre = :UsuarioNombre,UsuarioEmail = :UsuarioEmail,UsuarioAcceso = :UsuarioAcceso,UsuarioNivel = :UsuarioNivel,UsuarioEstado = :UsuarioEstado,UsuarioEmpresa=:UsuarioEmpresa where UsuarioId = :UsuarioId";
            $query = $this->db->prepare($sql);
            $query->bindParam(':UsuarioNombre', $UsuarioNombre);
            $query->bindParam(':UsuarioEmail', $UsuarioEmail);
            $query->bindParam(':UsuarioAcceso', $UsuarioAcceso);
            $query->bindParam(':UsuarioNivel', $UsuarioNivel);
            $query->bindParam(':UsuarioEstado', $UsuarioEstado);
            $query->bindParam(':UsuarioEmpresa', $UsuarioEmpresa);
            $query->bindParam(':UsuarioId', $UsuarioId);
            $value = $query->execute();
            if ($value) {
                $users = $this->GetUsuarios();
                return $users;
            } else {
                $error = $result->errorCode();
                $error = "{\"status\":\"error\",\"data\":\"" . $error . "\"}";
                return $error;
            }
        } catch (Exception $e) {
            $error = $e->getMessage();
            $error = "{\"status\":\"error\",\"data\":\"" . $error . "\"}";
            return false;
        }
    }
    
    public function EliminarUsuario($UsuarioId) {
        try {
            $sql = "delete from usuarios where UsuarioId = :UsuarioId";
            $query = $this->db->prepare($sql);
            $query->bindParam(':UsuarioId', $UsuarioId);
            $value = $query->execute();
            if ($value) {
                $users = $this->GetUsuarios();
                return $users;
            } else {
                $error = $result->errorCode();
                $error = "{\"status\":\"error\",\"data\":\"" . $error . "\"}";
                return $error;
            }
        } catch (Exception $e) {
            $error = $e->getMessage();
            $error = "{\"status\":\"error\",\"data\":\"" . $error . "\"}";
            return false;
        }
    }
    
    public function UpdatePassword($user,$newPassword) {
        try {
            $sql = "Update usuarios SET UsuarioPassword = :newPassword where UsuarioId = :UsuarioId";
            $query = $this->db->prepare($sql);
            $query->bindParam(':newPassword', $newPassword);
            $query->bindParam(':UsuarioId', $user['UsuarioId']);
            $value = $query->execute();
            if ($value) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            $error = $e->getMessage();
            $error = "{\"status\":\"error\",\"data\":\"" . $error . "\"}";
            return false;
        }
    }
    
    public function regeneratePwd()
    {
    	    $str = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890#@!";
	    $cad = "";

	    for($i=0;$i<8;$i++) {
	        $cad .= substr($str,rand(0,62),1);
	    }
	    return $cad;	
    }
    
    public function recuperarPwd($UsuarioEmail) {
            $newPassword = regeneratePwd();
            $user = $this->GetUserByEmail($UsuarioEmail);
            if ($user != null)
            {
                $MyCorreo = new ModelCorreo();
                $update = $this->UpdatePassword($user,$newPassword);
                $plantilla = $MyCorreo->GetContenidoMail("passwordPerdido", $user,$newPassword);
                $mail = $MyCorreo->send_email($plantilla, $UsuarioEmail, "co@treedm.com", "Password Generated", "no file"); 
                return "{\"status\":\"ok\",\"data\":\"ok\"}";
            }
            return "{\"status\":\"error\",\"data\":\"error\"}";
    }
    
    
    
}
