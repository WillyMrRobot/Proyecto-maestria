<?php

require_once 'config_inc.php';


class ModelCorreo {
         private $datosCorreo;
         public $usuario;
         private $db;
        
	 public function __construct(){
	     $this->datosCorreo = array();
             $this->db = new database();
         }
         
         function __destruct() {
             unset($this);
         }
         
        function GetContenidoMail($type,$user,$newPassword) {
            if ($type == "passwordPerdido") {
                $content = '<table class="table100" cellpadding="0" cellspacing="0" border="0" width="650" align="center">';
                $content .= '    <tr>';
                $content .= '        <td class="displaynone" width="40">';
                $content .= '        </td>';
                $content .= '        <td style="font-family: arial; font-size: 14px; line-height: 20px; color: #4d4d4d;" class="td100" width="570">';
                $content .= '            <br/><br/>';
                $content .= '            <span class="titulo" style="color: #4d4d4d; font-weight: lighter; font-family: arial; font-size: 30px; display: block; border-bottom: solid 1px #4d4d4d; padding: 20px 0; width: 65%;"><strong>TreeDM</strong> Nueva Contraseña<strong></strong></span>';
                $content .= '             <br/><br/>';
                $content .= '            <p style="color: #CC0000; font-size: 18px"> <strong>'.$user['UsuarioNombre'].'</strong>, su nuevo password se ha generado!</p>';
                $content .= '            <p>Por favor utilice este usuario <strong>'.$user['UsuarioAcceso'].'</strong> y este password  <strong>'.$newPassword.'</strong> para acceder al administrador de TreeDM. </p>';
                $content .= '            <p>&nbsp;</p>';
                $content .= '            <p>Inconvenientes?, por favor contactese con : <span style="color: #D52027;">bladimyrov@treedm.com</span></p>';
                $content .= '            <p>&nbsp;</p>';
                $content .= '            <p>Gracias!</p>';
                $content .= '            <br /><br />';
                $content .= '        </td>';
                $content .= '        <td class="displaynone" width="40">';
                
                $content .= '        </td>';
                $content .= '    </tr>';
                $content .= '</table>';
                return $content;
            }
        }
         
        function send_email($emailmessage,$emailto,$emailfrom,$emailsubject,$file) {
            if($file != "no file"){
                    // Campos del mensaje
		    $headers = "From: TreeDM "." <".$emailfrom.">";
                    //$headers = "From: $emailfrom";
                    
                    // boundary 
                    $semi_rand = md5(time()); 
                    $mime_boundary = "==Multipart_Boundary_x{$semi_rand}x"; 

                    // multipart boundary 
                    $message = "This is a multi-part message in MIME format.\n\n" . "--{$mime_boundary}\n" . "Content-type:text/html; charset=iso-8859-1\r\n" . "Content-Transfer-Encoding: 7bit\n\n" . $emailmessage . "\n\n"; 
                    $message .= "--{$mime_boundary}\n";
                                
                    //Validar si es mensaje para solicitante sino adjunta archivos

                    // Validar si existen archivos para adjuntar
                    $calendario = "../feedbackFiles/".$file;
                    

                    $file = fopen($calendario,"rb");
                    $data = fread($file,filesize($calendario));
                    fclose($file);
                    $data = chunk_split(base64_encode($data));
                    $message .= "Content-Type: {\"application/octet-stream\"};\n" . " name=\"$calendario\"\n" . 
                                "Content-Disposition: attachment;\n" . " filename=\"$calendario\"\n" . 
                                "Content-Transfer-Encoding: base64\n\n" . $data . "\n\n";
                    $message .= "--{$mime_boundary}\n";        
                    
                          
                    // headers for attachment 
                    $headers .= "\nMIME-Version: 1.0\n" . "Content-Type: multipart/mixed;\n" . " boundary=\"{$mime_boundary}\"";
					//$headers. = "Content-Type: text/html; charset=UTF-8";
                    $ok = mail($emailto, $emailsubject, utf8_decode($message), $headers); 
                    if($ok) {
                        $value = 1;
                    }
                    else {
                        $value = 0;
                    }
                    return $value;
            }
            else{
                $headers = "From: TreeDM "." <".$emailfrom.">\r\n";
                $headers .= "Content-type:text/html; charset=UTF-8\r\n";
                $message = $emailmessage;
                $okc = mail($emailto, $emailsubject, $message, $headers);
                if($okc){
                    $value = 1;
                }
                else { 
                    $value = 0;
                }
                return $value;
            }
        } 
        
       
}
         
?>

