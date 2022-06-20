<?php 

include("conexion.php");
$query="SELECT cast(dia_Fecha as date) AS FECHA,COUNT(*) as total
FROM ECUENTA where usuario='Banrural' AND cast(dia_Fecha as date)
BETWEEN '2021-08-01' and EOMONTH( '2021-08-01' )
GROUP BY cast(dia_Fecha as date)
ORDER BY cast(dia_Fecha as date)";

$result=sqlsrv_query($con,$query);
while ($fila=sqlsrv_fetch_array($result)) {
print_r($fila);	# code...
}
 ?>