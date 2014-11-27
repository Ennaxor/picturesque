<?php
	$identificador = @mysqli_connect('localhost','web','','pibd');
	if(!$identificador){
	echo "<p>Error al conectar con la base de datos: ". mysqli_connect_errno();
		echo "</p>";
		exit;
	}

	$sentencia= "select * from paises";

	if(!($resultado = @mysqli_query($identificador,$sentencia))){
		echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: ". mysqli_error($identificador);
		echo "</p>";
		exit;
	}

	echo "<select name='country' id='country'>";
	while ($fila = @mysqli_fetch_assoc($resultado)){
		echo "<option value='$fila[idPais]'> $fila[NombrePais] </option>";
	}

	echo "</select>";
	mysqli_free_result($resultado);
	mysqli_close($identificador);
?>