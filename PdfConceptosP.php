<?php
$serverName = "192.168.0.10";
$connectionInfo = array( "Database"=>"CONTROLTOTAL(panorama)", "UID"=>"Hardsys", "PWD"=>'$$sascim', "CharacterSet"=>"UTF-8");
$con = sqlsrv_connect( $serverName, $connectionInfo);
require 'fpdf/fpdf.php';
$pdf = new FPDF('L', 'mm', 'A4');
$pdf->AddPage();
$mes_ = $_REQUEST["mes"];


$busqueda = "SELECT  inm_id, dbo.alote(inm_Id) as lote, lec_Anterior as enero, lec_Actual as febrero,lec_DerechoMts,lec_Consumo as consumo_enero,
dbo.FN_AguDevuelveLecAct(inm_Id,dbo.devuelveIdPeriodoActual()) AS lec_actual_febrero,
dbo.aderechomt(inm_id) as derecho_mts,
dbo.FN_AguDevuelveLecCons(inm_Id,dbo.devuelveIdPeriodoActual()) AS consumo_febrero, cl_id,dbo.conceptolectura(cl_id) as concepto,
dbo.cargacanon(inm_id) as canon,dbo.FN_AguDevuelveLecExc(inm_Id,dbo.devuelveIdPeriodoActual()) as mtsExceso ,
dbo.FN_AguDevuelveValorExceso(inm_id,dbo.devuelveIdPeriodoActual()) as valor_total_exceso_febrero
from agu_Lecturas where  mes_Id=dbo.devuelveiDMesAnterior($mes_) and cl_id >0 and dbo.FN_AguDevuelveLecCons(inm_Id,dbo.devuelveIdPeriodoActual()) > 0
and lec_Anterior= lec_Actual   and  cl_id not in(18,17,3) and (dbo.FN_AguDevuelveLecCons(inm_Id,dbo.devuelveIdPeriodoActual())-lec_DerechoMts) > 0
order by lote";

$buscar = sqlsrv_query($con, $busqueda);

$busqueda2 = "SELECT dbo.devuelveMesAnterior($mes_,2)  as marzo ,dbo.devuelveMesAnterior($mes_,1) as abril ,dbo.devuelveMesAnterior($mes_,0) as mayo";
$buscar2   = sqlsrv_query($con, $busqueda2);
while ($fila2 = sqlsrv_fetch_array($buscar2)) {
    $marzo_ = $fila2['marzo'];
    $abril_ = $fila2['abril'];
    $mayo_  = $fila2['mayo'];
}

$pdf->SetFont('Arial', 'B', 15);
$pdf->SetTextColor(2, 157, 116);
$pdf->Cell(0, 0, 'Reporte De Lecturas Por Conceptos ', 0, 1, 'C');

$pdf->Cell(50, 5, '', 0, 1);
$pdf->SetX(3);
$pdf->SetFillColor(232, 232, 232);
$pdf->SetTextColor(17, 13, 12);
$pdf->SetFont('Arial', 'B', 9.5);

$pdf->Cell(11, 5, '', 0, 0, 'C', 0);
$pdf->Cell(15, 5, '', 0, 0, 'C', 0);
$pdf->Cell(25, 5, '', 0, 0, 'C', 0);
$pdf->Cell(18, 5, '', 0, 0, 'C', 0);
$pdf->Cell(16, 5, '', 0, 0, 'C', 0);
$pdf->Cell(18, 5, 'Consumo', 1, 0, 'C', 1);
$pdf->Cell(18, 5, 'Actual', 1, 0, 'C', 1);
$pdf->Cell(20, 5, 'Derecho', 1, 0, 'C', 1);
$pdf->Cell(20, 5, 'Consumo', 1, 0, 'C', 1);
$pdf->Cell(14, 5, '', 0, 0, 'C', 0);
$pdf->Cell(64, 5, '', 0, 0, 'C', 0);
$pdf->Cell(17, 5, '', 0, 0, 'C', 0);
$pdf->Cell(22, 5, 'Mts', 1, 0, 'C', 1);
$pdf->Cell(15, 5, 'Total', 1, 1, 'C', 1);
$pdf->SetX(3);

$pdf->Cell(11, 6, 'No.', 1, 0, 'C', 1);
$pdf->Cell(15, 6, 'Id', 1, 0, 'C', 1);
$pdf->Cell(25, 6, 'Lote', 1, 0, 'C', 1);
$pdf->Cell(18, 6, $marzo_, 1, 0, 'C', 1);
$pdf->Cell(16, 6, $abril_, 1, 0, 'C', 1);
$pdf->Cell(18, 6, $abril_, 1, 0, 'C', 1);
$pdf->Cell(18, 6, $mayo_, 1, 0, 'C', 1);
$pdf->Cell(20, 6, 'Mts', 1, 0, 'C', 1);
$pdf->Cell(20, 6, $mayo_, 1, 0, 'C', 1);
$pdf->Cell(14, 6, 'Codigo', 1, 0, 'C', 1);
$pdf->Cell(64, 6, 'concepto', 1, 0, 'C', 1);
$pdf->Cell(17, 6, 'canon', 1, 0, 'C', 1);
$pdf->Cell(22, 6, 'Exceso' . ' ' . $mayo_, 1, 0, 'C', 1);
$pdf->Cell(15, 6, 'Exceso', 1, 1, 'C', 1);

$i = 0;
while ($fila = sqlsrv_fetch_array($buscar)) {
    $inm_id_                     = $fila['inm_id'];
    $lote_                       = $fila['lote'];
    $enero_                      = $fila['enero'];
    $febrero_                    = $fila['febrero'];
    $lec_DerechoMts_             = $fila['lec_DerechoMts'];
    $consumo_enero_              = $fila['consumo_enero'];
    $lec_actual_febrero_         = $fila['lec_actual_febrero'];
    $derecho_mts_                = $fila['derecho_mts'];
    $consumo_febrero_            = $fila['consumo_febrero'];
    $cl_id_                      = $fila['cl_id'];
    $concepto_                   = $fila['concepto'];
    $canon_                      = $fila['canon'];
    $mtsExceso_                  = $fila['mtsExceso'];
    $valor_total_exceso_febrero_ = $fila['valor_total_exceso_febrero'];
    $i++;
    $pdf->SetX(3);

    $pdf->SetFillColor(232, 232, 232);
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(11, 10, $i, 1, 0, 'C');
    $pdf->Cell(15, 10, $inm_id_, 1, 0, 'C');
    $pdf->Cell(25, 10, $lote_, 1, 0, 'C');
    $pdf->Cell(18, 10, $enero_, 1, 0, 'C');
    $pdf->Cell(16, 10, $febrero_, 1, 0, 'C');
    //$pdf->Cell(22,7,$lec_DerechoMts_  ,1,0,'C');
    $pdf->Cell(18, 10, $consumo_enero_, 1, 0, 'C');
    $pdf->Cell(18, 10, $lec_actual_febrero_, 1, 0, 'C');
    $pdf->Cell(20, 10, $derecho_mts_, 1, 0, 'C');
    $pdf->Cell(20, 10, $consumo_febrero_, 1, 0, 'C');
    $pdf->Cell(14, 10, $cl_id_, 1, 0, 'C');
    $pdf->Cell(64, 10, utf8_decode($concepto_), 1, 0, 'C');
    $pdf->Cell(17, 10, number_format($canon_, 2, '.', ''), 1, 0, 'C');
    $pdf->Cell(22, 10, $mtsExceso_, 1, 0, 'C');
    $pdf->Cell(15, 10, $valor_total_exceso_febrero_, 1, 1, 'C');

}

$pdf->Output();

//}