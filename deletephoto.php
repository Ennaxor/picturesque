<?php
	require_once 'head.php'; 
	$identificador = @mysqli_connect('localhost','web','','pibd');
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
	
	header("Location: profile.php");
	mysqli_free_result($resultado);
	mysqli_close($identificador);
?>