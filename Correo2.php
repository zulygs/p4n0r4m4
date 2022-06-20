<?php

session_start();
$alert  = '';
$existe = '';
require 'fpdf/fpdf.php';
include "conexion.php";
include "function.php";
use PHPMailer\PHPMailer\PHPMailer;
require 'phpmail/src/Exception.php';
require 'phpmail/src/PHPMailer.php';
require 'phpmail/src/SMTP.php';

// Load Composer's autoloader
require 'vendor/autoload.php';
$id_ = $_SESSION['Id'];
if (!isset($_SESSION['Id'])) {
    echo "<script>window.location='index.html';</script>";
}
else{
$inm_id_b_ = $_REQUEST['inm_id_b'];
$mes___    = $_REQUEST['mes__'];
$id_       = $_SESSION['Id'];
//$userr     = $_SESSION['user'];


    $correo        = "SELECT * from correosPanorama  where inm_IdGenerado= '$inm_id_b_'";
    $ejecutacorreo = sqlsrv_query($con, $correo);
    while ($fila = sqlsrv_fetch_array($ejecutacorreo)) {
        $pdf = new FPDF('P', 'mm', 'legal');
        $pdf->AliasNbPages();
        $pdf->SetAutoPageBreak(true, 5);
        $pdf->setfillcolor(174, 214, 241);
        $pdf->SetDrawColor(174, 214, 241);
        //$pdf->SetTextColor(0,255,0);
        $inm_id_       = $fila["inm_idGenerado"];
        $archivo_      = $inm_id_;
        //$correousuario = 'galiciaz600@gmail.com';
        $correousuario = $fila['CORREO'];
        //echo "$correousuario";
        //$fila['CORREO']
        $fecha         = '';
        $filename      = "temporales3/$archivo_.pdf";
        $busqueda      = "SELECT lec.lec_ExcesoMts3 as Excesomts3,  *
    from recibos as rec  LEFT JOIN agu_Lecturas as lec
    on  rec.inm_Id = lec.inm_id
    where rec.mes_id = '$mes___'  and lec.mes_Id = '$mes___' and inm_idGenerado like '%$inm_id_b_%'";
        $buscar = sqlsrv_query($con, $busqueda);
        $i      = 0;
        $f      = 0;
        while ($fila2 = sqlsrv_fetch_array($buscar)) {
            $recibo_       = $fila2['recibo'];
            $mes_id        = $fila2['mes_id'];
            $mes_Consumo   = $fila2['mesConsumo'];
            $inm_IdGe      = $fila2['inm_idGenerado'];
            $propietario_  = $fila2['propietario'];
            $lec_Anterior_ = $fila2['lec_anterior'];
            $saldoant_     = $fila2['saldoanterior'];
            $lec_Actual_   = $fila2['lec_actual'];
            $VConsumo_     = $fila2['valorconsumo'];
            $Consumo_      = $fila2['mes1'];
            $VExceso_      = $fila2['valorexceso'];
            $Excesomts3_   = $fila2['Excesomts3'];
            $total_        = $fila2['total'];
            $mora_         = $fila2['mora'];
            $fec_pag       = $fila2['fechapago'];
            $leyenda_      = $fila2['leyenda'];
            $fechaemision_ = $fila2['fechaEmision'];

            $i++;
            if ($f == 0) {
                $pdf->AddPage();
                $x  = 20;
                $xx = 32;
                $s  = 0;
            }
            if ($f == 1) {
                $x  = 167;
                $xx = 187;
                $f  = 0;
                $s  = 1;
            }

            $pdf->Image('Logo_ Panorama.jpg', 5, 3, 45);
            $pdf->SetFont('Arial', '', 8);
            $pdf->SetXy(50, 5);
            $pdf->Cell(80, 4.5, 'ASOCIACION DE VECINOS COLONIA PANORAMA', 0, 0, 'C');
            $pdf->SetFont('Arial', '', 8);
            $pdf->SetXy(50, 8);
            $pdf->Cell(80, 4.5, utf8_decode('Intervención Municipal de Mixco'), 0, 0, 'C');
            $pdf->SetFont('Arial', '', 8);
            $pdf->SetXy(50, 11);
            $pdf->Cell(80, 4.5, 'PBX:  2376-4001', 0, 0, 'C');
            $pdf->SetFont('Arial', '', 14);
            $pdf->SetXy(85, "$x");
             $pdf->SetTextColor(255, 0, 0);
            $pdf->Cell(8, 8, 'No. ', 0, 0, 'L');
            $pdf->Cell(20, 8, "$recibo_", 0, 0, 'L');
             $pdf->SetTextColor(0, 0, 0);
            $pdf->SetFont('Arial', '', 12);
            $pdf->SetXy(55, "$xx");
            $pdf->Cell(40, 5, utf8_decode('Fecha de Emisión:   '), 0, 0, 'L');
            $pdf->Cell(20, 5, "$fechaemision_", 0, 1, 'L');
            $pdf->Cell(85, 5, '                                          Mes Consumo:   ', 0, 0, 'L');
            $pdf->Cell(20, 5, "$mes_Consumo", 0, 1, 'L');
            $pdf->Cell(10, 5, '', 0, 1, 'L');
            $pdf->Cell(40, 5, utf8_decode('Dirección o Código:   '), 0, 0, 'L','true');
            $pdf->Cell(70, 5, "$inm_IdGe                                                    ", 0, 1, 'L','true');
            $pdf->Cell(40, 5, 'Usuario:   ', 0, 0, 'L','true');
            $pdf->Cell(70, 5, utf8_decode("$propietario_"), 0, 1, 'L','true');
            $pdf->Cell(10, 4, '', 0, 1, 'L');
            $pdf->SetFont('Arial', '', 10);
           
            $pdf->Cell(35, 4.5, 'Lectura Anterior: ', 0, 0, 'L','true');
            $pdf->Cell(20, 4.5, "$lec_Anterior_", 0, 0, 'L','true');
            $pdf->Cell(35, 4.5, 'Saldo Anterior:      Q.', 0, 0, 'L','true');
            $pdf->Cell(20, 4.5, number_format("$saldoant_", 2), 0, 1, 'R','true');
            $pdf->Cell(35, 4.5, 'Lectura Actual:', 0, 0, 'L','true');
            $pdf->Cell(20, 4.5, "$lec_Actual_", 0, 0, 'L','true');
            $pdf->Cell(35, 4.5, 'Valor Canon:         Q.', 0, 0, 'L','true');
            $pdf->Cell(20, 4.5, number_format("$VConsumo_", 2), 0, 1, 'R','true');
            $pdf->Cell(35, 4.5, 'Consumo Mts. 3:', 0, 0, 'L','true');
            $pdf->Cell(20, 4.5, "$Consumo_", 0, 0, 'L','true');
            $pdf->Cell(35, 4.5, 'Valor Exceso:        Q.', 0, 0, 'L','true');
            $pdf->Cell(20, 4.5, number_format("$VExceso_", 2), 0, 1, 'R','true');
            $pdf->Cell(35, 4.5, 'Exceso Mts. 3:', 0, 0, 'L','true');
            $pdf->Cell(20, 4.5, "$Excesomts3_", 0, 0, 'L','true');
            $pdf->Cell(35, 4.5, 'Mora:                     Q.', 0, 0, 'L','true');
            $pdf->Cell(20, 4.5, number_format("$mora_", 2), 0, 1, 'R','true');
            $pdf->SetFont('Arial', '', 12);
            $pdf->Cell(73, 7, '                      TOTAL A PAGAR:    Q.', 0, 0, 'L');
            $pdf->Cell(23, 7, number_format("$total_", 2), 0, 1, 'R');
            $pdf->Cell(10, 5, '', 0, 1, 'L');
            $pdf->SetFont('Arial', '', 9);
            $pdf->Cell(40, 4.5, '', 0, 0, 'L');
            $pdf->Cell(110, 4.5, utf8_decode("$leyenda_"), 0, 1, 'C');
            $pdf->SetFont('Arial', '', 12);
            $pdf->Cell(105, 7, '                                              SU RECIBO VENCE EL: ', 0, 0, 'L');
            $pdf->Cell(20, 7, "$fec_pag", 0, 1, 'L');
            $pdf->Cell(10, 2, '', 0, 1, 'L');
            $pdf->SetTextColor(255, 0, 0);
            $pdf->Cell(105, 7, '                                                PAGAR UNICAMENTE EN BANRURAL ', 0, 0, 'L');
            $pdf->SetTextColor(0, 0, 0);
            $pdf->Image('Logo_banrural.png', 26, 104, 38);
            $pdf->SetFont('Arial', '', 14);
            $pdf->SetXy(75, 113);
            $pdf->Cell(25, 7, 'ATX - 249-278', 0, 1, 'C');
            $pdf->Cell(40, 5, utf8_decode('-------------------------------------------------------------------------'), 0, 0, 'L');

            $pdf->Image('Logo_ Panorama.jpg', 5, 125, 45);
            $pdf->SetFont('Arial', '', 8);
            $pdf->SetXy(50, 5);
            //a lo ancho,a lo largo
            $pdf->Cell(80, 250, 'ASOCIACION DE VECINOS COLONIA PANORAMA', 0, 0, 'C');
            $pdf->SetFont('Arial', '', 8);
            $pdf->SetXy(50, 8);
            $pdf->Cell(80, 250, utf8_decode('Intervención Municipal de Mixco'), 0, 0, 'C');
            $pdf->SetFont('Arial', '', 8);
            $pdf->SetXy(50, 11);
            $pdf->Cell(80, 250, 'PBX:  2376-4001', 0, 0, 'C');
            $pdf->SetFont('Arial', '', 14);
            $pdf->SetXy(85, "$x");
            $pdf->SetTextColor(255, 0, 0);
            $pdf->Cell(8, 253.50, 'No. ', 0, 0, 'L');
            $pdf->Cell(20, 253.50, "$recibo_", 0, 0, 'L');
            $pdf->SetTextColor(0, 0, 0);
            $pdf->SetFont('Arial', '', 12);
            $pdf->SetXy(55, "$xx");
            $pdf->Cell(40, 245, utf8_decode('Fecha de Emisión:   '), 0, 0, 'L');
            $pdf->Cell(20, 245, "$fechaemision_", 0, 1, 'L');
            $pdf->Cell(85, -235, '                                          Mes Consumo:   ', 0, 0, 'L');
            $pdf->Cell(20, -235, "$mes_Consumo", 0, 1, 'L');
            $pdf->Cell(10, 123, '', 0, 1, 'L');
            $pdf->Cell(40, 5, utf8_decode('Dirección o Código:   '), 0, 0, 'L','true');
            $pdf->Cell(70, 5, "$inm_IdGe                                                    ", 0, 1, 'L','true');
            $pdf->Cell(40, 5, 'Usuario:   ', 0, 0, 'L','true');
            $pdf->Cell(70, 5, utf8_decode("$propietario_"), 0, 1, 'L','true');
            $pdf->Cell(10, 150, '', 0, 1, 'L');
             $pdf->Cell(73, -294, '                      TOTAL A PAGAR:    Q.', 0, 0, 'L');
            $pdf->Cell(23, -294, number_format("$total_", 2), 0, 1, 'R');
            $pdf->Cell(10, 5, '', 0, 1, 'L');
            $pdf->SetFont('Arial', '', 9);
            $pdf->Cell(40, 4.5, '', 0, 0, 'L');
            $pdf->Cell(110, 4.5, utf8_decode("$leyenda_"), 0, 1, 'C');
            $pdf->SetFont('Arial', '', 12);
            $pdf->Cell(105, 295, '                                              SU RECIBO VENCE EL: ', 0, 0, 'L');
            $pdf->Cell(20, 295, "$fec_pag", 0, 1, 'L');
            $pdf->Cell(10, 2, '', 0, 1, 'L');
            $pdf->SetTextColor(255, 0, 0);
            $pdf->Cell(105,-283, '                                                PAGAR UNICAMENTE EN BANRURAL ', 0, 0, 'L');
            
            $pdf->Image('Logo_banrural.png', 26, 190, 38);
            $pdf->SetTextColor(0, 0, 0);
            $pdf->SetFont('Arial', '', 14);
            $pdf->SetXy(75, 100);
            $pdf->Cell(25, 205, 'ATX - 249-278', 0, 1, 'C');
            $pdf->Output($filename, 'F');
        }}

    if (isset($_POST['correobtn'])) {

        $mail = new PHPMailer(true);
        try{
 
        $mail->isSMTP();

    $mail->Host = '31.22.4.167';  //gmail SMTP server
    $mail->SMTPSecure = false;
    $mail->SMTPAutoTLS = false;
    $mail->SMTPAuth = true;

    $mail->Username = 'zulygalicia4@gmail.com';   //username
    $mail->Password = 'ocefnkqoqgbxhxgn';   //password
                    
 $mail->Port = 25;
 $mail->SMTPDebug  = 1;

 
    $mail->setFrom('zulygalicia4@gmail.com', 'Facturas Panorama');
    $mail->addAddress($correousuario, $propietario_); // Add a recipient

    $mail->addAttachment(('temporales3/') . ($inm_id_) . ('.pdf'));
    $mail->isHTML(true);
 
     $mail->Subject = 'Factura' ." ". $mes_Consumo;
            $mail->Body    = 'Sres.:<br><br>' . $propietario_ . '<br><br>Adjunto encontrara un documento con copia de la factura correspondiente ' . $mes_Consumo . '<br><br>' . 'NO RESPONDA A ESTE CORREO. Este es un correo automatico Unicamente para envio. Para dudas o sugerencias por favor llame a nuestra linea de Servicio al Cliente 2376-4001' . '<br><br>' . 'Atentamente<br>' . 'PANORAMA';
 
    if (!$mail->send()) {
        echo 'Message could not be sent.';
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    } else {
     
       // echo "<h1 style=\"color:red;\" >CORREO ENVIADO EXITOSAMENTE: </h1>" . $correousuario;
    }
} catch (Exception $e) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
}

        
    }
    $query = "SELECT * from correosPanorama  where inm_IdGenerado='$inm_id_b_'";
    $R     = sqlsrv_query($con, $query);
    while ($fila = sqlsrv_fetch_array($R)) {
        $Correo_ = $fila['CORREO'];
    }
    sqlsrv_close($con);
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
                <h3 class="titulo">Enviar Correo A:</h3>
                <form class="needs-validation" novalidate method="POST" action="Correo2.php?inm_id_b=<?php echo $inm_id_b_; ?>& mes__=<?php echo $mes___; ?>">
                  <center>
                    <div class="col form-row">
                      <div class="col form-group col-md-6">
                        <h3>Lote:</h3>
                        <input type="text" class="form-control"  style="width: 255px" placeholder="" name="Lote_" value="<?php echo isset($inm_id_b_) ? $inm_id_b_ : ''; ?>" required disabled>
                      </div>
                      <div class="col form-group">
                        <h3>Correo Electronico:</h3>
                        <input type="text"  class="form-control" style="width: 255px" placeholder="" name="Correo_" value="<?php echo isset($Correo_) ? $Correo_ : ''; ?>" required disabled>
                      </div>
                    </div>
                  </center>
                  <div class="content123"> <?php echo isset($alert) ? $alert : ''; ?></div>

                <div class="container container-form-lg-">
                  <br>
                  <embed src="<?php echo $filename; ?>#toolbar=0&navpanes=0&scrollbar=0" type="application/pdf" width="100%" height="500px"/>
                  <div class="form-group ">
                    <div class="col-md-12 ">
                      <button href="" type="submit" id="correobtn" name="correobtn" class="btn btn-success btn-lg">Confirmar Envio</button>
                    </div>
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