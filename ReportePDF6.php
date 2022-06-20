<?php
	require 'fpdf/fpdf.php';	
	include("conexion.php");
	$pdf = new FPDF('L', 'mm', array(200,130 ));
	$pdf->AliasNbPages();
	$pdf->SetAutoPageBreak(true,5);
	$linea11 = $_POST['linea1'];
	$linea21 = $_POST['linea2'];
	$linea31 = $_POST['linea3'];
	$linea41 = $_POST['linea4'];
	$linea51 = $_POST['linea5'];

	$lunes11 = $_POST['lunes1'];
	$lunes112 = $_POST['lunes123'];
	$sabado11 = $_POST['sabado1'];
	$sabado112 = $_POST['sabado123'];
	$domingo11 = $_POST['domingo1'];
	$domingo112 = $_POST['domingo123'];

	$lunes12 = $_POST['lun'];
	$lunes121 = $_POST['lun2'];
	$sabado12 = $_POST['saba'];
	$sabado121 = $_POST['saba2'];
	$domingo12 = $_POST['domi'];
	$domingo121 = $_POST['domi2'];

	
	//$busqueda = "Select * from recibos";
	$busqueda = "SELECT inm_id,inm_IdGenerado from reporteVistaCortes";
	$buscar = sqlsrv_query($con, $busqueda);
    $i = 0;
	$f = 0;

	while($fila = sqlsrv_fetch_array($buscar)){
		$recibo_ = $fila['inm_id'];
		$inm_IdGe = $fila['inm_IdGenerado'];

	    $i++;
	
	if ($f == 0 ) {
	$pdf->AddPage();
	$x = 5;
	$xx = 40;
	$s = 0;
	}	
	if ($f == 1 ) {
	$x = 167;
	$xx = 187;
	$f = 0;
	$s = 1;	
	}		

	$pdf->SetFont('Arial','',10);
	$pdf->SetXy(90,"$x");	
	$pdf->Cell(50,8 , "                                                         Mixco,   ".date('d-m-Y'), 0,0,'L');
	
	$pdf->Cell(8,52, $pdf->Image('LogoSascim.jpg', $pdf->GetX()-120, $pdf->GetY(),30),0);

	
	
	$pdf->SetFont('Arial','',10);
	$pdf->SetXy(2,40);
	$pdf->Cell(20,5 , utf8_decode('                  Estimado usuario:   '), 0,0,'L');
	$pdf->Cell(10,5 , '', 0,1,'L');	
	
    $pdf->SetFont('Arial','B',10);
	$pdf->Cell(20,5 , '          ID                    Lote', 0,1,'L');	

	 $pdf->SetFont('Arial','',10);
	$pdf->SetXy(19,50);	
	$pdf->Cell(20,5 , "$recibo_", 0,0,'L');
	 	



	
	$pdf->Cell(20,5,''. $inm_IdGe, 0,0,'L');
	$pdf->Cell(20,5 , '', 0,1,'L');

	
	$pdf->SetFont('Arial','',10);
	$pdf->SetXy(25,55);	
	$pdf->Cell(50,8 , " $linea11,   ", 0,0,'L');

	$pdf->SetFont('Arial','',10);
	$pdf->SetXy(20,60);	
	$pdf->Cell(50,5, "$linea21   ", 0,0,'L');

	$pdf->SetFont('Arial','',10);
	$pdf->SetXy(20,65);	//a lo ancho a lo alto
	$pdf->Cell(50,2 , "$linea31", 0,0,'L');

	$pdf->SetFont('Arial','',10);
	$pdf->SetXy(20,69);	//a lo ancho a lo alto
	$pdf->Cell(50,2 , "$linea41", 0,0,'L');

	$pdf->SetFont('Arial','',10);
	$pdf->SetXy(20,73);	//a lo ancho a lo alto
	$pdf->Cell(50,2 , "$linea51", 0,0,'L');

if (!empty($_POST['check']) && !empty($_POST['check2'])) {
	
    $pdf->Cell(10,5 , '', 0,1,'L');
	$pdf->SetFont('Arial','',10);
	$pdf->Cell(2,0, '                                 Horario de Atencion:                                     Mega Frater             Sankris Mall ', 5,0,'L');


	if (!empty($_POST['check3'] ) && !empty($_POST['check6'])) {
	$pdf->SetFont('Arial','',10);
	$pdf->SetXy(70,78);	
	$pdf->Cell(50,8 , "         Lunes a Viernes       $lunes11 A $lunes112         $lunes12 A $lunes121 ", 0,0,'L');
	 $pdf->Cell(10,5 , '', 0,1,'L');	

	}if (!empty($_POST['check4'] ) && !empty($_POST['check7'])) {
	$pdf->SetFont('Arial','',10);
	$pdf->SetXy(70,83);	
	$pdf->Cell(50,8 , "         Sabados                   $sabado11 A $sabado112         $sabado12 A $sabado121 ", 0,0,'L');
	 $pdf->Cell(10,5 , '', 0,1,'L');	

	}if (!empty($_POST['check5'] ) && !empty($_POST['check8'])) {
	$pdf->SetFont('Arial','',10);
	$pdf->SetXy(40,88);	
	$pdf->SetTextColor(245, 51, 8).$pdf->Cell(50,8 , "  Horario especial:           Domingo                  $domingo11 A $domingo112         $domingo12 A $domingo121  ", 0,0,'L');
	
	$pdf->Cell(10,5 , '', 0,1,'L');	

	}else if (!empty($_POST['check5'] )) {
	$pdf->SetFont('Arial','',10);
	$pdf->SetXy(40,88);	
	$pdf->SetTextColor(245, 51, 8).$pdf->Cell(50,8 , "  Horario especial:           Domingo                  $domingo11 A $domingo112   ", 0,0,'L');
	
	$pdf->Cell(10,5 , '', 0,1,'L');	

	}else if (!empty($_POST['check8'] )) {
	$pdf->SetFont('Arial','',10);
	$pdf->SetXy(40,88);	
	$pdf->SetTextColor(245, 51, 8).$pdf->Cell(50,8 , "  Horario especial:           Domingo                                                   $domingo12 A $domingo121 ", 0,0,'L');
	
	$pdf->Cell(10,5 , '', 0,1,'L');	

	}
}else 
 	if (!empty($_POST['check'] )) {
    $pdf->Cell(10,5 , '', 0,1,'L');
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(2,0, '                                 Horario de Atencion:                                   Mega Frater             ', 5,0,'L');

	if (!empty($_POST['check3'] )) {
	$pdf->SetFont('Arial','',10);
	$pdf->SetXy(70,78);	
	$pdf->Cell(50,8 , "         Lunes a Viernes       $lunes11 A $lunes112   ", 0,0,'L');
	 $pdf->Cell(10,5 , '', 0,1,'L');	

	}if (!empty($_POST['check4'] )) {
	$pdf->SetFont('Arial','',10);
	$pdf->SetXy(70,83);	
	$pdf->Cell(50,8 , "         Sabados                   $sabado11 A $sabado112   ", 0,0,'L');
	 $pdf->Cell(10,5 , '', 0,1,'L');	

	}if (!empty($_POST['check5'] )) {
	$pdf->SetFont('Arial','',10);
	$pdf->SetXy(40,88);	
	$pdf->SetTextColor(245, 51, 8).$pdf->Cell(50,8 , "  Horario especial:           Domingo                  $domingo11 A $domingo112   ", 0,0,'L');
	
	$pdf->Cell(10,5 , '', 0,1,'L');	

	}


}else 
 	if (!empty($_POST['check2'] )) {
    $pdf->Cell(10,5 , '', 0,1,'L');
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(2,0, '                                 Horario de Atencion:                                   Sankris Mall             ', 5,0,'L');

	if (!empty($_POST['check6'] )) {
	$pdf->SetFont('Arial','',10);
	$pdf->SetXy(70,78);	
	$pdf->Cell(50,8 , "         Lunes a Viernes       $lunes12 A $lunes121   ", 0,0,'L');
	 $pdf->Cell(10,5 , '', 0,1,'L');	

	}if (!empty($_POST['check7'] )) {
	$pdf->SetFont('Arial','',10);
	$pdf->SetXy(70,83);	
	$pdf->Cell(50,8 , "         Sabados                   $sabado12 A $domingo121   ", 0,0,'L');
	 $pdf->Cell(10,5 , '', 0,1,'L');	

	}if (!empty($_POST['check8'] )) {
	$pdf->SetFont('Arial','',10);
	$pdf->SetXy(40,88);	
	$pdf->SetTextColor(245, 51, 8).$pdf->Cell(50,8 , "  Horario especial:           Domingo                  $domingo12 A $domingo121   ", 0,0,'L');
	
	$pdf->Cell(10,5 , '', 0,1,'L');	

	}


}   




  	
	



	$pdf->SetFont('Arial','',10);
	$pdf->SetTextColor(6, 6, 6);
	$pdf->Cell(20,5 , '          Atentamente', 0,0,'L');
	$pdf->Cell(10,5 , '', 0,1,'L');

	$pdf->SetFont('Arial','',10);
	$pdf->Cell(20,5 , '             Sascim', 0,0,'L');
	

	if ($s == 0 ) {
	$f = 1;
	}		
	if ($s == 1 ) {
	$f = 0;
	}	
	}
	$pdf->Output();
	sqlsrv_close($con);
	
?>