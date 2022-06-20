<?php



include("conexion.php");
  use PHPMailer\PHPMailer\PHPMailer;
require 'phpmail/src/Exception.php';
require 'phpmail/src/PHPMailer.php';
require 'phpmail/src/SMTP.php';  
        /*$busqueda = "SELECT lec.lec_ExcesoMts3 as Excesomts3, dbo.ecuentasaldopormes(rec.inm_id,'2018-11-23') as saaldo , * 
        from recibos as rec  LEFT JOIN agu_Lecturas as lec 
            on  rec.inm_Id = lec.inm_id";
        $buscar   = sqlsrv_query($con, $busqueda);
        //break;
        //     }
        while ($fila = sqlsrv_fetch_array($buscar)) {
           print_r($fila);
        }*/
         $mail = new PHPMailer(true);
         try{
         $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';  //gmail SMTP server
    $mail->SMTPSecure = 'tls';
    $mail->SMTPAutoTLS = true;
    $mail->SMTPAuth = true;



   $mail->Username = 'zulygalicia4@gmail.com';   //username
    $mail->Password = 'ocefnkqoqgbxhxgn';   //password
        $mail->Port = 587;
        $mail->SMTPDebug  = 0;//0 no muestra errores, 1 muestra solo si hay errores, 2 muestra todo el estado
        $mail->setFrom('zulygalicia4@gmail.com', 'Facturas Panorama');

        $emails = array('pasarcosasiphone1@gmail.com','galiciaz600@gmail.com' );
        $emails2 = array('zuly','Merari' );

      /*  $people = array(
    array('pasarcosasiphone1@gmail.com','zuly'),
    array('galiciaz600@gmail.com', 'Merdari')
);*/

/*for($i = 0; $i < count($people); $i++) {
    $correos=$people[$i];
}*/
   // echo $emails[$i];
    $mail->addAddress('pasarcosasiphone1@gmail.com','zuly'); 
    $mail->addAddress('galiciaz600@gmail.com', 'Merdari'); 



     // Add a recipient
       // $mail->addAttachment(('temporales3/') . ('BLSUR02-64') . ('.pdf'));
        $mail->addAttachment(('temporales4/CE_PANORAMA22072021.xls'));
        $mail->isHTML(true);
        $mail->Subject = 'Factura' ;
        $mail->Body    = 'Sres.:';
        if (!$mail->send()) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        } else {
            echo'<script type="text/javascript">
            alert("CORREO ENVIADO EXITOSAMENTE");
            window.history.back(-3);
            </script>';
            //echo "<h1 style=\"color:red;\" >CORREO ENVIADO EXITOSAMENTE: </h1>" . $correousuario;
        }
    } catch (Exception $e) {
        echo 'Message could not be sent.';
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    }
       


     