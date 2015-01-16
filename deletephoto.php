<?php
	session_start();
	require_once 'head.php'; 
	if (!isset($_COOKIE['authenticated']) && !isset($_SESSION['authenticated'])){
            echo "
            	<script> document.location.href = 'datailpictnosession.php'; </script>
            ";
		}
	$identificador = @mysqli_connect('localhost',$MYSQL_USER,$MYSQL_PASS,$MYSQL_DB);
	$i=0;
	if(!$identificador){
		echo "<p>Error al conectar con la base de datos: ". mysqli_connect_errno();
		echo "</p>";
		exit;
	}				
	
	$sentencia= "DELETE FROM fotos WHERE idFoto=$_GET[id]";
	if(!($resultado = @mysqli_query($identificador,$sentencia))){
		echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: ". mysqli_error($identificador);
		echo "</p>";
		exit;
	}
	
	echo "
    	<script> document.location.href = 'profile.php'; </script>
    ";
	mysqli_free_result($resultado);
	mysqli_close($identificador);
?>