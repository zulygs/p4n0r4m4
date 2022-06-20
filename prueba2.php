<?php
include "conexion.php";
$Consulta2 = "SELECT top 1 inm_IdGenerado,recibo,fechaEmision as fecha, 
round( dbo.ecuentasaldopormes(inm_id,CONVERT (date, SYSDATETIME())),2)
  as totalapagar
 ,propietario from recibos where mes_id=dbo.devuelveIdPeriodoActual()
   order by recibo";
date_default_timezone_set('UTC');
$R2 = sqlsrv_query($con, $Consulta2);
while ($Fila2 = sqlsrv_fetch_array($R2)) {


    $fecha2_          = $Fila2['fecha'];
   
}

$date = str_replace('/', '-', $fecha2_);

header('Content-type: application/vnd.ms-excel;charset=iso-8859-15');
header('Content-Disposition: attachment; filename=CE_PANORAMA'. date('dmY', strtotime($date)).'.xls');
header("Content-Type: text/html;charset=utf-8");


$archivo_      = "carga2";
$filename      = "temporales4/$archivo_.xls";

$Consulta = "SELECT inm_IdGenerado,recibo,fechaEmision as fecha, 
round( dbo.ecuentasaldopormes(inm_id,CONVERT (date, SYSDATETIME())),2)
  as totalapagar
 ,propietario from recibos where mes_id=dbo.devuelveIdPeriodoActual()
   order by recibo";

$R = sqlsrv_query($con, $Consulta);

$shtml="<table>"; 



while ($datos=sqlsrv_fetch_array($R)){
    $inm_IdGenerado_=$datos['inm_IdGenerado'];;
    $recibo_=$datos['recibo'];
    $fecha_=$datos['fecha'];;
    $totalapagar_=$datos['totalapagar'];
    $propietario_=$datos['propietario'];
    $shtml=$shtml."<tr> 
                    <td>".$inm_IdGenerado_."</td>
                    <td>".$recibo_."</td>
                    <td>".$fecha_."</td>
                    <td>".$totalapagar_."</td>
                    <td>".$propietario_."</td>
                </tr>";
}
$shtml=$shtml."</table>";
$sfile="temporales4/carga2.xls"; // Ruta del archivo a generar 

$fp=fopen($sfile,"w"); 
fwrite($fp,$shtml); 
fclose($fp); 
?>