<?php  

	$Usuarioo=$_POST['user'];
	$pass=$_POST['password'];
	include('conexion.php');
	$con = sqlsrv_connect( $serverName, $connectionInfo) or die ('Error en el Servidor');
	$Consulta="SELECT * from Login where IdUsuario='$Usuarioo' and PWDCOMPARE('$pass', contrasenia) = 1";
	$R=sqlsrv_query($con,$Consulta);
	$Fila=sqlsrv_fetch_array($R);
	if($Fila == 0 || ($Usuarioo=="admin" && $pass=="sistemas2020*")){
		echo "<script>window.history.back(); </script>";
	}else {
		session_start();
		$_SESSION['Id'] =$Fila['IdUsuario'];
		header('Location: index1.php');
	}
	sqlsrv_close($con);

?>

