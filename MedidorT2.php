<?php
	
require 'fpdf/fpdf.php';
include "conexion.php";
$pdf = new FPDF();
$pdf = new FPDF('L', 'mm', 'A4');
$pdf->AddPage();



header('Content-type: application/vnd.ms-excel;charset=iso-8859-15');
header('Content-Disposition: attachment; filename=PanoramaConceptos.xls');
header("Content-Type: text/html;charset=utf-8");

	
	
	
	$busqueda = "SELECT inm_Id,dbo.alote(inm_id) as lote,lec_FechaOperacion,lec_Anterior,lec_Actual,cl_id,dbo.conceptolectura(cl_id) as n
	 from [CONTROLTOTAL(PANORAMA)].dbo.agu_Lecturas where mes_Id= dbo.devuelveIdPeriodoActual()-1";
//		and rec.inm_id = 39 
	$buscar = sqlsrv_query($con, $busqueda);
    $i = 0;
	
	

  echo "<table border='1' cellpadding='2' cellspacing='0' width='100%'>
      <caption><font color='red' size='10'>Conceptos</font></caption>
      <tr>
        <td>Inmueble</td>
        <td>Lote</td>
        <td>Fecha Operacion</td>
        <td>Lectura Anterior</td>
        <td>LEctura Actual</td>
        <td>ID Concepto</td>
        <td>Concepto</td>
        
      </tr>
      ";

      while($Fila=sqlsrv_fetch_array($buscar)) {
            $inm_Id_ = $Fila['inm_Id'];
      	$lote_ = $Fila['lote'];
            $dia_Fecha_ = $Fila['lec_FechaOperacion']; 
             $fecha_ = $dia_Fecha_->format('Y-m-d');
            
            $lec_Anterior_ = $Fila['lec_Anterior']; 
            $lec_Actual_ = $Fila['lec_Actual'];
            $cl_id_ = $Fila['cl_id'];  
            $n_ = $Fila['n']; 
            
            
   
        ?>      

    <tr>
        <td><?php echo $inm_Id_; ?></td>
        <td style="mso-number-format:'@'"><?php echo $lote_; ?></td>
        <td><?php echo $fecha_; ?></td>
        <td ><?php echo $lec_Anterior_; ?></td>
        <td ><?php echo utf8_decode($lec_Actual_); ?></td>
        <td><?php echo $cl_id_; ?></td>
        <td ><?php echo utf8_decode($n_); ?></td>
      
     
    </tr>

  <?php  
   }  
    
  echo "
      </table>  ";
  sqlsrv_close($con);

      ?>