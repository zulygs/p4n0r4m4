<?php
  require 'fpdf/fpdf.php';  
  include("conexion.php");
  $pdf = new FPDF('L', 'mm', array(200,130));
  $pdf->AliasNbPages();
  $pdf->SetAutoPageBreak(true,5);
  $linea11 = $_POST['linea1'];
  $linea21 = $_POST['linea2'];
  $linea31 = $_POST['linea3'];
  $linea311 = $_POST['linea31'];
  $linea312 = $_POST['linea32'];
  $linea313 = $_POST['linea33'];
  $linea41 = $_POST['linea4'];
  $linea411 = $_POST['linea41'];
  $linea51 = $_POST['linea5'];
  $linea511 = $_POST['linea51'];
  $linea61 = $_POST['linea6'];
  $linea71 = $_POST['linea7'];
  $linea81 = $_POST['linea8'];
  $linea91 = $_POST['linea9'];

 /* $recibo_ = 58522;
    $inm_IdGe = 789;*/

$busquedas = "SELECT inm_id,inm_IdGenerado from reporteVistaCortes";
  $buscars = sqlsrv_query($con, $busquedas);
    $i = 0;
  $f = 0;
if (@sqlsrv_fetch_array($buscars)>0) {
 
  while($filas = sqlsrv_fetch_array($buscars)){
    $recibo_ = $filas['inm_id'];
    $inm_IdGe = $filas['inm_IdGenerado'];


      $i++;
  
  if ($f == 0 ) {
  $pdf->AddPage();
  $x = 5;
  $xx = 40;
  $s = 0;
  } 
  if ($f == 1 ) {
  $x = 54868;
  $xx = 187;
  $f = 0;
  $s = 1; 
  }   
$pdf->SetY(10);
$pdf->SetX(5);
  $pdf->SetFont('Arial','',11);
  $pdf->SetXy(140,"$x"); 
  $pdf->Cell(50,8 , "", 0,0,'L');
  $pdf->Image("Logo_panorama_png.png",77,-2, 45, 34,'PNG');
  //$pdf->Cell(78,100, $pdf->Image('Logo_panorama.jpg', $pdf->GetX(),-10, $pdf->GetY(),30),0); 
  $pdf->SetFont('times','B',10);
  $pdf->SetXy(32,27);
  $pdf->SetTextColor(0, 53, 153);
  $pdf->Cell(15,5 , utf8_decode('ASOCIACION DE VECINOS COLONIA PANORAMA INTERVENCION MUNICIPAL'), 0,0,'L');
  $pdf->SetXy(22,30);
  $pdf->Cell(20,5 , utf8_decode(' 4ª. Calle 19-68 ZONA 8 DE MIXCO, SAN CRISTOBAL, TELEFONOS 2376-4001 Y 5952-3760'), 0,0,'L');

  $pdf->SetFont('times','',12);
  $pdf->SetTextColor(17, 13, 12);
  $pdf->SetXy(2,40);
  $pdf->Cell(15,5 , utf8_decode('            Estimado Vecino:   '), 0,0,'L');
  $pdf->Cell(10,5 , '', 0,1,'L'); 

  $pdf->SetFont('times','B',12);
  $pdf->Cell(15,5 , utf8_decode('     ID                    Lote'), 0,1,'L'); 
  $pdf->SetFont('times','',12);
  $pdf->SetXy(15,50); 
  $pdf->Cell(15,5 , "$recibo_", 0,0,'L');     
  $pdf->Cell(15,5,"$inm_IdGe", 0,0,'L');
  $pdf->Cell(15,5 , '', 0,1,'L'); 

  $pdf->SetFont('times','',12);
  $pdf->SetXy(15,60); 
  $pdf->Cell(50,2 , utf8_decode("$linea11   "), 0,0,'L');
  $pdf->SetFont('times','',12);
  $pdf->SetXy(15,65); 
  $pdf->Cell(50,2, utf8_decode("$linea21   "), 0,0,'L');
  $pdf->SetXy(15,70); 
  $pdf->Cell(50,2 , "   ", 0,0,'L');
  $pdf->SetFont('times','',12);
  $pdf->SetXy(15,73); //a lo ancho a lo alto
  $pdf->Cell(50,2 , utf8_decode("$linea31"), 0,0,'L');
  $pdf->SetFont('times','B',12);
  $pdf->SetXy(91,73); //a lo ancho a lo alto
  $pdf->Cell(50,2 , utf8_decode("$linea311"), 0,0,'L');
  $pdf->SetFont('times','',12);
  $pdf->SetXy(137,73); //a lo ancho a lo alto
  $pdf->Cell(50,2 , utf8_decode("$linea312"), 0,0,'L');
  $pdf->SetFont('times','B',12);
  $pdf->SetXy(160,73); //a lo ancho a lo alto
  $pdf->Cell(50,2 , utf8_decode("$linea313"), 0,0,'L');
  $pdf->SetFont('times','B',12);
  $pdf->SetXy(15,77); //a lo ancho a lo alto
  $pdf->Cell(50,2 , utf8_decode("$linea41"), 0,0,'L');
  $pdf->SetFont('times','',12);
  $pdf->SetXy(110,77); //a lo ancho a lo alto
  $pdf->Cell(50,2 , utf8_decode("$linea411"), 0,0,'L');
  $pdf->SetFont('times','',12);
  $pdf->SetXy(15,81); //a lo ancho a lo alto
  $pdf->Cell(50,2 , utf8_decode("$linea51"), 0,0,'L'); 
   $pdf->SetFont('times','B',12);
  $pdf->SetXy(76,81); //a lo ancho a lo alto
  $pdf->Cell(50,2 , utf8_decode("$linea511"), 0,0,'L'); 
  $pdf->SetFont('times','',12);
    $pdf->Cell(10,5 , '', 0,1,'L');
    $pdf->SetXy(15,85); //a lo ancho a lo alto
  $pdf->Cell(50,2 , utf8_decode("$linea61"), 0,0,'L'); 
   
  $pdf->SetXy(15,90); //a lo ancho a lo alto
  $pdf->Cell(50,2 , utf8_decode("$linea71"), 0,0,'L'); 
  $pdf->SetXy(15,96); //a lo ancho a lo alto
  $pdf->Cell(50,2 , utf8_decode("Horario de atencion: Agencia Central Lunes a Viernes de 8:00 a 17:00 | Sabados de 8:00 a 13:00"), 0,0,'L'); 
  $pdf->SetXy(15,105); //a lo ancho a lo alto
  $pdf->Cell(50,2 , utf8_decode("$linea81"), 0,0,'L'); 

  

  $pdf->SetFont('times','',12 );
  $pdf->Cell(2,5 , '', 0,1,'C');
  $pdf->Cell(180,10, "$linea91", 0,0,'C');
  if ($s == 0 ) {
  $f = 1;
  }   
  if ($s == 1 ) {
  $f = 0;
  } 
  } 
  $pdf->Output();
   # code...
}else{
  echo "No Hay Datos Disponibles";
}
?>