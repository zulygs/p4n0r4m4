<?php
session_start();
$id_ = $_SESSION['Id'];
if (!isset($_SESSION['Id'])) {
    echo "<script>alert('Inicie Sesion Para Continuar'); window.location='index.html';</script>";
}
?>
<!DOCTYPE html>
<?php
include "conexion.php";
?>
<meta charset="UTF-8">
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Panorama Inicio</title>
  <?php include('Header.php'); ?>
  <style type="text/css">
    #lateral { height: 757px; }
  </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed sidebar-collapse ">
  <nav class="main-header navbar navbar-expand  navbar-light header bg-gradient-primary">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
      <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="./index1.php
        " style="align-content: center">&nbsp;Panorama &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      </a>
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
            <div class="dropdown-divider">              
            </div>
            <a href="Logout.php" class="dropdown-item">
              <i class="ni ni-user-run"></i>
              <span>Salir</span>
            </a>
          </div>
        </li>
      </ul>
    </ul>
    <!-- SEARCH FORM -->
    <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
      </div>
    </form>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
    </ul>
  </nav>
  <center>
    <aside class="main-sidebar sidebar-light-secundary elevation-4">
      <?php include('menu.php'); ?>
      <center>
        <div class="header bg-gradient-primary pb-9 pt-5 pt-md-7" id="lateral">
          <div class="container-fluid">
            <div class="header-body" >
              <div class="col-md-12 col-md-offset-0">
        <h1>Imprimir Avisos</h1>
        <form method="POST" action="ReportePDFAvisos.php" target="_blank">
          <div class="form-group">
            <label for="firstName"><h3>Texto</h3></label>
            <div class="col-md-10 mb-48" >
              <input type="text" class="form-control2" id="" placeholder="" value="Por medio de la presente le informamos que de acuerdo a nuestros registros su servicio presenta un" name="linea1" style="width: 800px" required>
              <div class="col-md-15 mb-0" >
                <input type="text" class="form-control2" id="" placeholder="" value="saldo acumulado por canon de agua pendiente, el cual no ha sido cortado en apoyo de su economia." name="linea2" style="width: 800px"  required>
              </div>
                <div class="row col-xs-12">
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <input type="text" class="form-control2" id="" placeholder="" value="Le recomendamos realizar el pago antes del" name="linea3"  style="width: 360px" required>
                <input type="text" class="form-control2" id="" placeholder="" value="15 de Diciembre de 2020" name="linea31"  style="width: 220px;font-weight: bold" required>
                <input type="text" class="form-control2" id="" placeholder="" value="ya que el día" name="linea32"  style="width: 120px" required>
                <input type="text" class="form-control2" id="" placeholder="" value="16 de ese" name="linea33"  style="width: 100px;font-weight: bold" required>
              </div>

                <div class="row col-xs-12">
                 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <input type="text" class="form-control2" id="" placeholder="" value="mismo mes se llevarán a cabo los cortes del servicio." name="linea4" style="width: 444px;font-weight: bold"  required>
                <input type="text" class="form-control2" id="" placeholder="" value="El monto de su deuda está expresamente" name="linea41" style="width: 356px"  required>
              </div>
                <div class="row col-xs-12">
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <input type="text" class="form-control2" id="" placeholder="" value="señalado en la boleta emitida el día" name="linea5" style="width: 300px" required>
                <input type="text" class="form-control2" id="" placeholder="" value="22/11/2020." name="linea51" style="width: 500px;font-weight: bold" required>
              </div>
              <div class="col-md-15 mb-0" >
                <input type="text" class="form-control2" id="" placeholder="" value="Si usted ya realizo el pago correspondiente de su servicio por favor haga caso omiso de esta" name="linea6" style="width: 800px" required>
              </div>
              <div class="col-md-15 mb-0" >
                <input type="text" class="form-control2" id="" placeholder="" value="notificación." name="linea7" style="width: 800px" required>
              </div>
            </div>
            <div class="col-md-15 mb-0" >
                <input type="text" class="form-control2" id="" placeholder="" value="Cualquier duda le atenderemos gustosamente al PBX o puede visitar nuestra Agencia Central." name="linea8" style="width: 800px" required>
              </div>
              <div class="col-md-15 mb-0" >
                <input type="text" class="form-control2" id="" placeholder="" value="Departamento de Operaciones" name="linea9" style="width: 800px" required>
              </div>
          </div>
          <center>
            <div class="col-md-12">
              <input type="submit" id="click" name="inserta" class="btn btn-primary " value="Imprimir"><br>
            </div>
          </center>
          <style type="text/css">
            #div1 {
              overflow:scroll;
              height:235px;
               width: 900;
             }
           </style>
        </form>
      </div>
            </div>
          </div>
        </div>
      </center>
    </aside>
  </center>
  <!-- jQuery -->
  <?php include('scripts.php'); ?>
</body>
</html>