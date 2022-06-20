<?php
$alert  = '';
$existe = '';
use PHPMailer\PHPMailer\PHPMailer;

require 'phpmail/src/Exception.php';
require 'phpmail/src/PHPMailer.php';
require 'phpmail/src/SMTP.php';

// Load Composer's autoloader
require 'vendor/autoload.php';

require 'fpdf/fpdf.php';
include "conexion.php";
include "function.php";
$correousuario = "galiciaz600@gmail.com";
$clp_nombre_   = "zuly";
$mes_Consumo       = "enero";
$propietario_="zuly";
$mail          = new PHPMailer(true);


     try {
            
          
        $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';  //gmail SMTP server
    $mail->SMTPSecure = 'tls';
    $mail->SMTPAutoTLS = true;
    $mail->SMTPAuth = true;

   $mail->Username = 'intermpanorama@gmail.com';   //username
    $mail->Password = 'epsonlg2';   //password
                    
 $mail->Port = 587;
 $mail->SMTPDebug  = 0;

 
    $mail->setFrom('intermpanorama@gmail.com', 'Recibo Panorama');
    $mail->addAddress('galiciaz600@gmail.com', 'ZulyGalicia');

 
    $mail->isHTML(true);
 
    $mail->Subject = 'TEST CORREO';
    $mail->Body    = "mensaje de prueba saludos";
 
 $mail->send();
} catch (Exception $e) {
    //echo 'Message could not be sent.';
   //echo 'Mailer Error: ' . $mail->ErrorInfo;
}

    sqlsrv_close($con);
