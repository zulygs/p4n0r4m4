<?php
session_start();
$id_ = $_SESSION['Id'];
$valorr=1;
$valore=0;
if (!isset($_SESSION['Id'])) {
    echo "<script>alert('Inicie Sesion Para Continuar'); window.location='index.html';</script>";
}
$fecha= $_REQUEST['fecha'];
header("Cache-Control: no-cache, must-revalidate");
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
    #lateral { height: auto; }
   
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
        
         <div class="container container-form-lg" style="width: 600px">
        <center>
          <div class="form-row" >
            <div class="col form-group" id="" >
              <div class="card" >
            
                  <center><h2>Consulta De Cargas</h2></center>
               
             
                <div class="table-responsive" style="width: auto">
                  <table class="table">
                    <thead class=" text-primary2" align="center" >
                      <th ><font color="black">NO.</font></th>
                      <th><font color="black">Fecha</font></th>
                      <th><font color="black">Total De Cargas</font></th>
                      <th><font color="black">Acción</font></th>
                    </thead>
                    <tbody>
                      <?php
                      $busqueda    = "SELECT cast(dia_Fecha as date) AS FECHA,COUNT(*) as total
FROM ECUENTA where usuario='Banrural' AND cast(dia_Fecha as date)
BETWEEN '$fecha-01' and EOMONTH( '$fecha-01' )
GROUP BY cast(dia_Fecha as date)
ORDER BY cast(dia_Fecha as date)";
                      /*SELECT cast(dia_Fecha as date) AS FECHA,COUNT(*) as total
                      FROM ECUENTA where usuario='$tipo' AND cast(dia_Fecha as date) BETWEEN DATEADD(MONTH, DATEDIFF(MONTH, 0,GETDATE()), 0) and EOMONTH( GETDATE() )
                      GROUP BY cast(dia_Fecha as date)
                      ORDER BY cast(dia_Fecha as date)*/
                      $buscar = sqlsrv_query($con, $busqueda);
                      $total  = 0;
                      $i         = 0;
                      $Cantidad=0;
                      
                      while ($fila = sqlsrv_fetch_array($buscar)) {
                      $FECHA_                     = $fila['FECHA'];
                      $FECHAF_                     = date_format($FECHA_, "d/m/Y");
                      $total_                       = $fila['total'];
                      $Cantidad+=$fila['total'];
                      $i++;
                      ?>
                      <tr class="" align="center">
                        <td ><font color="#5B5B5B"><?php echo $i; ?></font></td>
                        <td><font color="#5B5B5B"><?php echo $FECHAF_; ?></font></td>
                        <td nowrap><font color="#5B5B5B"><?php echo $total_; ?></font></td>
                        <td>
                          <a id="bbb" type="submit"  href="TablaCargas.php?FECHA=<?php echo $fila['FECHA']->format('Y-m-d'); ?>&fecha=<?php echo $fecha; ?>&valore=<?php echo $valorr; ?>" >
                            <img src="https://img.icons8.com/color/36/000000/details-pane.png"/><font color="#5B5B5B">Detalle</font>
                          </a>
                        </td>
                      </tr>
                     <?php }  ?>
                      <tr class="" align="center">
                        <td ><font color="#5B5B5B"><?php echo "Total Cargas:"; ?></font></td>
                        <td ><font color="#5B5B5B"></font></td>
                        <td ><font color="#5B5B5B"><?php echo number_format($Cantidad); ?></font></td>
                        <td></td>
                        <td></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </center>
      </div>
      <!--********************************DETALLE*********************************-->
      <?php
      if (isset($_GET['valore'])==1) {
        $FECHA_ = $_GET['FECHA'];
        
        ?>
        <div class="container container-form-lg"  style="width: auto">
          <div class="form-row" >
            <div class="col form-group" id="" >
              <div class="card" >
                
                  <center>
                    <h2 class="modal-title">Detalle De <?php echo($FECHA_); ?></h2>
                  </center>
                
                <div class = "container" >
                  <table id="example" class="table table-responsive" cellspacing="0" width="">
                    <thead  class="text-primary2" align="right">
                      <th><font color="black">NO.</font></th>
                      <th><font color="black">Fecha</font></th>
                      <th><font color="black">Codigo</font></th>
                      <th><font color="black">Descripcion</font></th>
                      <th><font color="black">HABER</font></th>
                      <th><font color="black">Inmueble</font></th>
                      <th><font color="black">Lote</font></th>
                      <th><font color="black">Mov NoDocto</font></th>
                      <th><font color="black">Usuario</font></th>
                      <th><font color="black">No. Docto</font></th>
                    </thead>
                    <tbody>
                      <?php
                     
                      $i=0;



                      $busquedaD    = "SELECT dia_Fecha,tra_Codigo,tra_Descripcion,HABER,inm_id,dbo.alote(inm_id) as lote, mov_NoDocto,USUARIO,NoDocto
FROM ECUENTA where usuario='Banrural' AND cast(dia_Fecha as date)
='$FECHA_'
ORDER BY cast(dia_Fecha as date)";
                $buscarD = sqlsrv_query($con, $busquedaD);

                while ($filaD = sqlsrv_fetch_array($buscarD)) {
                  //print_r($filaD);
                  $FECH                  = $filaD['dia_Fecha'];
                  $FECHAF_                 = date_format($FECH, "d/m/Y H:i:s");
                  $tra_Codigo_             = $filaD['tra_Codigo'];
                  $tra_Descripcion_        = $filaD['tra_Descripcion'];
                  $HABER_                  = $filaD['HABER'];
                  $inm_id_                 = $filaD['inm_id'];
                  $lote_                   = $filaD['lote'];
                  $mov_NoDocto_            = $filaD['mov_NoDocto'];
                  $USUARIO_                = $filaD['USUARIO'];
                  $NoDocto_                = $filaD['NoDocto'];
            
                  $i++;
                
                  ?>
                
                  <tr class="" align="">
                    <td><font color="#5B5B5B"><?php echo $i; ?></font></td>
                    <td nowrap><font color="#5B5B5B"><?php echo $FECH->format("d/m/Y H:i:s"); ?></td>
                    <td><font color="#5B5B5B"><?php echo $tra_Codigo_; ?></font></td>
                    <td><font color="#5B5B5B"><?php echo $tra_Descripcion_; ?></font></td>
                    <td><font color="#5B5B5B"><?php echo $HABER_; ?></font></td>
                    <td><font color="#5B5B5B"><?php echo $inm_id_; ?></font></td>
                    <td><font color="#5B5B5B"><?php echo $lote_; ?></font></td>
                    <td><font color="#5B5B5B"><?php echo $mov_NoDocto_; ?></font></td>
                    <td><font color="#5B5B5B"><?php echo $USUARIO_; ?></font></td>
                    <td><font color="#5B5B5B"><?php echo $NoDocto_; ?></font></td>
                    
 
            
               </tr>
                <?php }?>

                    
                
                    
                 
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    </div>
<?php  # code...
} ?>

</div>
      </center>
    </aside>
  </center>
  <!-- jQuery -->
  <?php include('scripts.php'); ?>
</body>
</html>