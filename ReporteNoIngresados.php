<?php
	
require 'fpdf/fpdf.php';
include "conexion.php";
$pdf = new FPDF();
$pdf = new FPDF('L', 'mm', 'A4');
$pdf->AddPage();
	

	
	$busqueda = "SELECT inm_id,inm_IdGenerado,dbo.recuperaEstadoInmueble(inm_id) as estado,dbo.devuelveIdPeriodoActual() as periodo,
	dbo.devuelveDescripcionMesPorMesID(dbo.devuelveIdPeriodoActual()) as mes
	from tblInmuebles where inm_id not in(select inm_id from agu_LecturaTemporal where mes_id=dbo.devuelveIdPeriodoActual())";
//		and rec.inm_id = 39 
	$buscar = sqlsrv_query($con, $busqueda);
    $i = 0;
	
	

	
	$pdf->SetFont('Arial', 'B', 15);
$pdf->SetTextColor(2, 157, 116);
$pdf->Cell(0, 0, 'Reporte De Lotes Sin Lectura ', 0, 1, 'C');

$pdf->Cell(50, 5, '', 0, 1);
$pdf->SetX(50);
$pdf->SetFillColor(232, 232, 232);
$pdf->SetTextColor(17, 13, 12);
$pdf->SetFont('Arial', 'B', 9.5);



$pdf->Cell(20, 6, 'No.', 1, 0, 'C', 1);
$pdf->Cell(20, 6, 'Id', 1, 0, 'C', 1);
$pdf->Cell(40, 6, 'Lote', 1, 0, 'C', 1);
$pdf->Cell(30, 6, 'Estado', 1, 0, 'C', 1);
$pdf->Cell(20, 6, 'Periodo', 1, 0, 'C', 1);
$pdf->Cell(50, 6, 'Mes', 1, 1, 'C', 1);

$i = 0;
while($fila = sqlsrv_fetch_array($buscar)){
		$inm_id_ = $fila['inm_id'];
		$inm_IdGenerado_ = $fila['inm_IdGenerado'];
		$estado_ = $fila['estado'];
		$periodo_ = $fila['periodo'];
		$mes_ = $fila['mes'];
	    $i++;
		
    $pdf->SetX(50);

    $pdf->SetFillColor(232, 232, 232);
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(20, 10, $i, 1, 0, 'C');
    $pdf->Cell(20, 10, $inm_id_, 1, 0, 'C');
    $pdf->Cell(40, 10, $inm_IdGenerado_, 1, 0, 'C');
    $pdf->Cell(30, 10, $estado_, 1, 0, 'C');
    $pdf->Cell(20, 10, $periodo_, 1, 0, 'C');
    $pdf->Cell(50, 10, $mes_, 1, 1, 'C');

}

$pdf->Output();
?>