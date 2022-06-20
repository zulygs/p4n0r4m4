<?php
	require 'fpdf/fpdf.php';	
	include("conexion.php");
	$pdf = new FPDF('P','mm','A5');
	$pdf->AliasNbPages();

	$pdf->SetAutoPageBreak(true,5);
	
	$lote_ = $_POST['lote'];
	$mes_ = $_POST['mes'];
	
	$busqueda = "SELECT lec.lec_ExcesoMts3 as Excesomts3, dbo.ecuentasaldopormes(rec.inm_id,'2018-11-23') as saaldo , * 
		from recibos as rec  LEFT JOIN agu_Lecturas as lec 
			on  rec.inm_Id = lec.inm_id
		where rec.mes_id = '$mes_'  and lec.mes_Id = '$mes_' and inm_idGenerado like '%$lote_%'";
//		and rec.inm_id = 39 
	$buscar = sqlsrv_query($con, $busqueda);
    $i = 0;
	$f = 0;
	while($fila = sqlsrv_fetch_array($buscar)){
		$recibo_ = $fila['recibo'];
		$mes_id = $fila['mes_id'];
		$mes_Consumo = $fila['mesConsumo'];
		$inm_IdGe = $fila['inm_idGenerado'];
		$propietario_ = $fila['propietario'];
		$lec_Anterior_ = $fila['lec_anterior'];
		$saldoant_ = $fila['saldoanterior'];
		$lec_Actual_ = $fila['lec_actual'];
		$VConsumo_ = $fila['valorconsumo'];
		$Consumo_ = $fila['mes1'];
		$VExceso_ = $fila['valorexceso'];
		$Excesomts3_ = $fila['Excesomts3'];
		$total_ = $fila['total'];
		$total_1 = $fila['saaldo'];
		$mora_ = $fila['mora'];
//		$fec_pag = $fila['fechapago'];
		$fec_pag = date("d/m/Y");
//		$fec_pag = "21/ENE/2019";
		$leyenda_ = $fila['leyenda'];
		$fechaemision_ = $fila['fechaEmision'];
	    $i++;
	if ($f == 0 ) {
	$pdf->AddPage();
	$x = 20;
	$xx = 32;
	$s = 0;
	}	
	if ($f == 1 ) {
	$x = 167;
	$xx = 187;
	$f = 0;
	$s = 1;	
	}		
	$pdf->Image('Logo_ Panorama.jpg', 5, 3, 45 ); 
	$pdf->SetFont('Arial','',8);
		$pdf->SetXy(50, 5 );
	$pdf->Cell(80,4.5 , 'ASOCIACION DE VECINOS COLONIA PANORAMA', 0,0,'C');
	$pdf->SetFont('Arial','',8);
				$pdf->SetXy(50, 8 );
	$pdf->Cell(80,4.5 , utf8_decode('Intervención Municipal de Mixco'), 0,0,'C');
	$pdf->SetFont('Arial','',8);
		$pdf->SetXy(50, 11 );
	$pdf->Cell(80,4.5 , 'PBX:  2376-4001', 0,0,'C');
	$pdf->SetFont('Arial','',14);
		$pdf->SetXy(85, "$x");
	$pdf->Cell(8,8 , 'No. ', 0,0,'L');
	$pdf->Cell(20,8 , "$recibo_", 0,0,'L');
	$pdf->SetFont('Arial','',12);
		$pdf->SetXy(55,"$xx");
	$pdf->Cell(40,5 , utf8_decode('Fecha de Emisión:   '), 0,0,'L');
	$pdf->Cell(20,5 , "$fechaemision_" , 0,1,'L');	
	$pdf->Cell(85,5 , '                                          Mes Consumo:   ', 0,0,'L');
	$pdf->Cell(20,5 , "$mes_Consumo", 0,1,'L');	
	$pdf->Cell(10,5 , '', 0,1,'L');	
//	$pdf->Cell(10,5 , '', 0,1,'L');
	$pdf->Cell(40,5 , utf8_decode('Dirección o Código:   '), 0,0,'L');	
	$pdf->Cell(30,5 , "$inm_IdGe", 0,1,'L');
	$pdf->Cell(25,5 , 'Usuario:   ', 0,0,'L');	
	$pdf->Cell(70,5 , utf8_decode("$propietario_"), 0,1,'L');
	$pdf->Cell(10,4 , '', 0,1,'L');
		$pdf->SetFont('Arial','',10);
	$pdf->Cell(35,4.5 , 'Lectura Anterior: ', 0,0,'L');
	$pdf->Cell(20,4.5 , "$lec_Anterior_", 0,0,'L');
	$pdf->Cell(35,4.5 , 'Saldo Anterior:      Q.', 0,0,'L');
	$pdf->Cell(20,4.5 , number_format ("$saldoant_",2), 0,1,'R');
	$pdf->Cell(35,4.5 , 'Lectura Actual:', 0,0,'L');
	$pdf->Cell(20,4.5 , "$lec_Actual_", 0,0,'L');
	$pdf->Cell(35,4.5 , 'Valor Canon:         Q.', 0,0,'L');
	$pdf->Cell(20,4.5 , number_format ("$VConsumo_",2), 0,1,'R');
	$pdf->Cell(35,4.5 , 'Consumo Mts. 3:', 0,0,'L');
	$pdf->Cell(20,4.5 , "$Consumo_", 0,0,'L');
	$pdf->Cell(35,4.5 , 'Valor Exceso:        Q.', 0,0,'L');
	$pdf->Cell(20,4.5 , number_format ("$VExceso_",2), 0,1,'R');
	$pdf->Cell(35,4.5 , 'Exceso Mts. 3:', 0,0,'L');
	$pdf->Cell(20,4.5 , "$Excesomts3_", 0,0,'L');
	$pdf->Cell(35,4.5 , 'Mora:                     Q.', 0,0,'L');
	$pdf->Cell(20,4.5 , number_format("$mora_",2), 0,1,'R');
	$pdf->SetFont('Arial','',12);
	$pdf->Cell(73,7 , '                      TOTAL A PAGAR:    Q.', 0,0,'L');
	$pdf->Cell(23,7 , number_format("$total_",2), 0,1,'R');
//	$pdf->Cell(23,7 , number_format("$total_1",2), 0,1,'R');
	$pdf->Cell(10,5 , '', 0,1,'L');	
	$pdf->SetFont('Arial','',9);
	$pdf->Cell(40,4.5,'',0,0,'L');
	$pdf->Cell(110,4.5, utf8_decode("$leyenda_"),0,1, 'C');
	$pdf->SetFont('Arial','',12);	
	$pdf->Cell(105,7 , '                                              SU RECIBO VENCE EL: ', 0,0,'L');
	$pdf->Cell(20,7 , "$fec_pag", 0,1,'L');	
	$pdf->Cell(10,2 , '', 0,1,'L');	
	$pdf->SetTextColor (255,0,0);
	$pdf->Cell(105,7 , '                                                PAGAR UNICAMENTE EN BANRURAL ', 0,0,'L');
	$pdf->SetTextColor (0,0,0);
	$pdf->Image('Logo_banrural.png', 26, 104, 38 ); 
	$pdf->SetFont('Arial','',14);
			$pdf->SetXy(75, 113 );
	$pdf->Cell(25,7,'ATX - 249-278',0,1,'C');


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