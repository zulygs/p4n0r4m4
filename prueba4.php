<?php 
require 'fpdf/fpdf.php';
include "conexion.php";
include "function.php";
use PHPMailer\PHPMailer\PHPMailer;
require 'phpmail/src/Exception.php';
require 'phpmail/src/PHPMailer.php';
require 'phpmail/src/SMTP.php';
require 'vendor/autoload.php';

$archivo2_      = "CE_PANORAMA02082021";
$filename2      = "temporales4/$archivo2_.xls";
 $mail = new PHPMailer(true);
        try{
         $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';  //gmail SMTP server
    $mail->SMTPSecure = 'tls';
    $mail->SMTPAutoTLS = true;
    $mail->SMTPAuth = true;

   $mail->Username = 'zulygalicia4@gmail.com';   //username
  
   
   $mail->Password = 'ocefnkqoqgbxhxgn';
        $mail->Port = 587;
        $mail->SMTPDebug  = 0;//0 no muestra errores, 1 muestra solo si hay errores, 2 muestra todo el estado
        $mail->setFrom('zulygalicia4@gmail.com', 'Sascim Informatica');
        $mail->addAddress('pasarcosasiphone1@gmail.com','zuly'); 
        $mail->addAddress('galiciaz600@gmail.com', 'Merdari'); 
          $mail->addBCC('zgalicias@miumg.edu.gt', 'galiciaU');
        $mail->addAttachment(($filename2));
        $mail->isHTML(true);
        $mail->Subject = 'Base de Datos PANORAMA a '.$mesDesc.' 2022 carga FULL';
        $mail->Body    = 'Adjunto: les estoy enviando la base de datos de cobros del mes de '.$mesDesc.'<br>
2022 de Asociación de Vecinos Colonia Panorama Intervención Municipal<br>
ATX 249-278 No. Cuenta Banrural de depósitos monetarios 3-153-04242-1.<br>
Solicitaría su colaboración a efecto de poder subir esta base de datos<br>
a su sistema, Quedó a la espera de su confirmación de que la base de<br>
datos quedó cargada y la transacción habilitada a efecto de que<br>
nosotros podamos distribuir los recibos de cobro a nuestros usuarios.<br>
Saludos<br><br>

intervención panorama<br>
Depto. Informática<br>
Asociación de Vecinos Colonia Panorama';
        if (!$mail->send()) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        } else {
            echo'<script type="text/javascript">
            alert("CORREO ENVIADO EXITOSAMENTE");
            history.go(-3);
            </script>';
            //echo "<h1 style=\"color:red;\" >CORREO ENVIADO EXITOSAMENTE: </h1>" . $correousuario;
        }
    } catch (Exception $e) {
        echo 'Message could not be sent.';
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    }
 ?>