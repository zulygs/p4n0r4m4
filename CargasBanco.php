<?php
require_once 'Classes/PHPExcel.php';
$objPHPExcel = new PHPExcel;
$objSheet    = $objPHPExcel->getActiveSheet();

$objPHPExcel->getActiveSheet()->freezePaneByColumnAndRow(1, 4);
header('Content-type: application/vnd.ms-excel;charset=iso-8859-15');
header('Content-Disposition: attachment; filename=CE_PANORAMA22062021.xls');
header("Content-Type: text/html;charset=utf-8");

include "conexion.php";


?>
<?php

$busqueda = "SELECT inm_IdGenerado,recibo, getdate() as fecha, round( dbo.ecuentasaldopormes(inm_id,CONVERT (date, SYSDATETIME())),2)as totalapagar,propietario from recibos where mes_id=156 order by recibo";

$buscar = sqlsrv_query($con, $busqueda);

echo "<table border='1' cellpadding='2' cellspacing='0' width='100%'>
 
     ";

while ($fila = sqlsrv_fetch_array($buscar)) {
    $lote_                 = $fila['inm_IdGenerado'];
    $recibo_            = $fila['recibo'];
    $fecha_           = $fila['fecha'];
    $totalapagar_                = $fila['totalapagar'];
    $propietario_            = $fila['propietario'];
    $cadena_nuevo_formato2 = date_format($fecha_, "d/m/Y");

    ?>

    <tr>
        <td><?php echo $lote_; ?></td>
        <td ><?php echo utf8_decode($lote_); ?></td>
        <td ><?php echo $recibo_; ?></td>
        <td ><?php echo $cadena_nuevo_formato2; ?></td>
        <td ><?php echo number_format($totalapagar_, 2); ?></td>
        <td ><?php echo $propietario_; ?></td>
    </tr>
    <?php
    }
   

echo "
   </table>  ";
sqlsrv_close($con);

?>



