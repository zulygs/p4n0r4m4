<?php
session_start();
$id_ = $_SESSION['Id'];
if (!isset($_SESSION['Id'])) {
    echo "<script>window.location='index.html';</script>";
}
else {
    if (isset($_POST['correo123'])) {
        $idinm_ = $_POST['idinm'];
        $mes_   = $_POST['mes'];
        if (empty($_POST['idinm'])) {
            $alert = 'Lote No Encontrado';
        } else {
            $idinm_ = $_POST['idinm'];
            $mes_   = $_POST['mes'];
            $alert  = '';
            header("Location: Correo1.php?inm_id_b=$idinm_&%20mes__=" . urlencode($mes_));
        }
    }
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
    #lateral { height: 800px; }
  </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed sidebar-collapse " >
  <nav class="main-header navbar navbar-expand  navbar-light header bg-gradient-primary " >
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
    <aside class="main-sidebar sidebar-light-secundary elevation-4">
      <?php include 'menu.php';?>
      <div class="header bg-gradient-primary pt-md-7" id="lateral">
        <center>
          <div class="panel-header panel-header-lg" id="lateral">
            <div class="container container-form-lg">
              <div class="col-md-12">
                <h3 class="titulo">CORREOS</h3>
                <form class="needs-validation" novalidate method="POST" action="Correo.php">
                  <input type="text"  class="form-control" placeholder="Lote" name="idinm" required>
                  <h3>Mes A Imprimir:</h3>
                  <select name='mes' class="form-control selectpicker">
                    <?php
                    include 'conexion.php';
                    $con      = sqlsrv_connect($serverName, $connectionInfo) or die('Error en el Servidor');
                    $Consulta = "SELECT  top 2 mes_Nombre,mes_id,year(mes_FechaInicio) as ano
                    FROM pdv_CiclosMeses 
                    where mes_Estado =3
                    order by mes_id desc";
                    $R = sqlsrv_query($con, $Consulta);
                    while ($Fila = sqlsrv_fetch_array($R)) {
                      echo "<option value='" . $Fila['mes_id'] . "'>" . $Fila['mes_Nombre'] . " " . $Fila['ano'] . "</option>";
                    }
                    sqlsrv_close($con);
                    ?>
                  </select><br>
                  <div class="form-group">
                    <input type="submit" id="click" name= "correo123" class="btn btn-primary " style="width: 250px" value= "Buscar" >
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div> 
      </aside>
    </center>
    <?php include 'scripts.php'?>
  </body>
</html>
