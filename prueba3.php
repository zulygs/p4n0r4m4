<?php

session_start();
$id_ = $_SESSION['Id'];
if (!isset($_SESSION['Id'])) {
    echo "<script>window.location='index.html';</script>";
}
$alert  = '';
$existe = '';
require 'fpdf/fpdf.php';
include "conexion.php";
include "function.php";
use PHPMailer\PHPMailer\PHPMailer;
require 'phpmail/src/Exception.php';
require 'phpmail/src/PHPMailer.php';
require 'phpmail/src/SMTP.php';
require 'vendor/autoload.php';


$pdf = new FPDF('P', 'mm', 'legal');
$pdf->AliasNbPages();
$pdf->SetAutoPageBreak(true, 5);
$pdf->setfillcolor(174, 214, 241);
$pdf->SetDrawColor(174, 214, 241);
$archivo_      = "carga";
$filename      = "temporales4/$archivo_.pdf";
$busqueda = "SELECT inm_IdGenerado,recibo,fechaEmision as fecha,
round( dbo.ecuentasaldopormes(inm_id,CONVERT (date, SYSDATETIME())),2)
  as totalapagar
 ,propietario from recibos where mes_id=dbo.devuelveIdPeriodoActual()
   order by recibo";
   $buscar = sqlsrv_query($con, $busqueda);
   $pdf->AddPage();
   while($fila = sqlsrv_fetch_array($buscar)){
    $inm_IdGenerado_ = $fila['inm_IdGenerado'];
    $recibo_ = $fila['recibo'];
    $fecha_ = $fila['fecha'];
    
    $totalapagar_ = $fila['totalapagar'];
    $propietario_ = $fila['propietario'];
    $pdf->SetFillColor(232, 232, 232);
    $pdf->SetFont('Arial', '', 7);
    $pdf->Cell(20, 7, $inm_IdGenerado_, 1, 0, 'C');
    $pdf->Cell(25, 7, $recibo_, 1, 0, 'C');
    $pdf->Cell(30, 7, $fecha_, 1, 0, 'C');

    $pdf->Cell(10, 7, $totalapagar_, 1, 0, 'C');
    $pdf->Cell(60, 7, $propietario_, 1, 1, 'C');
  }
  $pdf->Output($filename, 'F');

$date = str_replace('/', '-', date("d-m-Y"));


$archivo2_      = "CE_PANORAMA". date('dmY', strtotime($date));
$filename2      = "temporales4/$archivo2_.xls";



$shtml="<table>"; 



while ($datos=sqlsrv_fetch_array($buscar)){
    $inm_IdGenerado_=$datos['inm_IdGenerado'];
    $recibo_=$datos['recibo'];
    $fecha_=$datos['fecha'];
    $totalapagar_=$datos['totalapagar'];
    $propietario_=$datos['propietario'];
    $shtml=$shtml."<tr> 
                    <td>".$inm_IdGenerado_."</td>
                    <td>".$recibo_."</td>
                    <td>".$fecha_."</td>
                    <td>".$totalapagar_."</td>
                    <td>".$propietario_."</td>
                </tr>";
}
$shtml=$shtml."</table>";
$sfile=$filename2; // Ruta del archivo a generar 

$fp=fopen($sfile,"w"); 
fwrite($fp,$shtml); 
fclose($fp); 

setlocale(LC_TIME, "spanish");

$date = str_replace('/', '-', date("d-m-Y")); 

$date2 = str_replace('/', '-', $fecha_);
$newDate = date("d-m-Y", strtotime($date2));        
$mesDesc = strftime("%B ", strtotime($newDate));

 if (isset($_POST['correobtn'])) {
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
}
    
$query="SELECT top 1 mes_id,mes_Nombre,mes_FechaInicio,mes_FechaFin from pdv_CiclosMeses where mes_Estado=3 order by mes_id desc";
 $result=sqlsrv_query($con,$query);
 while ($row=sqlsrv_fetch_array($result)) {

  $mes_id_=$row["mes_id"];
  $mes_Nombre_=$row["mes_Nombre"];
  $mes_FechaInicio_=$row["mes_FechaInicio"]->format("d-m-Y");
  $mes_FechaFin_=$row["mes_FechaFin"]->format("d-m-Y");
   # code...
 }


 
   
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Panorama Inicio</title>
  <?php include 'Header.php';?>
  <style type="text/css">
    #lateral { height: 900px; }
  </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed sidebar-collapse " id="lateral" >
  <nav class="main-header navbar navbar-expand  navbar-light header bg-gradient-primary">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
      <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="./index1.php" style="align-content: center">&nbsp;Panorama &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
      <!-- Form -->
        <form class="navbar-search navbar-search-dark form-inline mr-3 d-none d-md-flex ml-lg-auto" >
          <div class="form-group mb-0" style="align-content: right">
            <div class="input-group input-group-alternative">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-search"></i></span>
              </div>
              <input class="form-control" placeholder="Search" type="text">
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            </div>
          </div>
        </form>
       <ul class="navbar-nav align-items-center d-none d-md-flex">
        <li class="nav-item dropdown">
          <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <div class="media align-items-center">
              <span class="avatar avatar-sm rounded-circle">
                <img alt="Image placeholder" src="./assets/img/icons/man.ico">
              </span>
              <div class="media-body ml-2 d-none d-lg-block" style="align-content: left">
                <span class="mb-0 text-sm  font-weight-bold"><?php echo $id_ ?></span>
              </div>
            </div>
          </a>
          <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
            <div class=" dropdown-header noti-title">
              <h6 class="text-overflow m-0">Bienvenido!</h6>
            </div>
            <div class="dropdown-divider"></div>
            <a href="Logout.php" class="dropdown-item">
              <i class="ni ni-user-run"></i>
              <span>Salir</span>
              </a>
            </div>
          </li>
        </ul>
    </ul>
  </nav>
  <center>
    <aside class="main-sidebar sidebar-light-secundary elevation-4"   id="lateral">
      <?php include 'menu.php';?>
      <div class="header bg-gradient-primary pt-md-7"  >
        <center>
          <div class="panel-header panel-header-lg" >
            <div class="container container-form-lg"  >
              <div class="col-md-12 ">
                <!--<h3 class="titulo">Enviar Correo A:</h3>-->
                <form class="needs-validation" novalidate method="POST" action="prueba3.php">
                  <h1>Cargas Del Mes De <?php echo "$mes_Nombre_" ;?><br>De <?php echo " $mes_FechaInicio_ ";echo " Al ";echo "$mes_FechaFin_";  ?></h1>
                  <div class="col-md-12 ">
                      <button href="" type="submit" id="correobtn" name="correobtn" class="btn btn-success btn-lg">Enviar Correo</button>
                    </div>
                  <center>
                    <div class="col form-row">
                      
                    </div>
                  </center>
                  <div class="content123"> <?php echo isset($alert) ? $alert : ''; ?></div>

                <div class="container container-form-lg-">
                  <br>
                  <embed src="<?php echo $filename; ?>#toolbar=0&navpanes=0&scrollbar=0" type="application/pdf" width="100%" height="500px"/>
                  <div class="form-group ">
                    
                    <br>
                  </div>
                </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </aside>
    </center>

<?php include "scripts.php";?>
<script src="js/jquery.min.js"></script>
<script src="js/funciones.js"></script>
<?php include "includes/fooder.php";?>

</body>
</html>