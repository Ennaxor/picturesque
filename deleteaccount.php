<?php
	require_once 'head.php'; 
	$identificador = @mysqli_connect('localhost','web','','pibd');
	$i=0;
	if(!$identificador){
		echo "<p>Error al conectar con la base de datos: ". mysqli_connect_errno();
		echo "</p>";
		exit;
	}				
	$sentencia= "select idAlbum from albumes where Usuario=$_SESSION[idUsu]";
	if(!($resultado = @mysqli_query($identificador,$sentencia))){
		echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: ". mysqli_error($identificador);
		echo "</p>";
		exit;
	}
	
	 $albumes =array();
	 while($album = mysqli_fetch_assoc($resultado)){
		$albumes[$i] = $album["idAlbum"];
		$i++;
	 }
	$i=0;
	while($i<count($albumes)){
		$sentencia= "delete from fotos where album=$albumes[$i]";
		if(!($resultado = @mysqli_query($identificador,$sentencia))){
			echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: ". mysqli_error($identificador);
			echo "</p>";
			exit;
		}
		$i++;
	}
	
	
	$sentencia= "delete from albumes where Usuario=$_SESSION[idUsu]";
	if(!($resultado = @mysqli_query($identificador,$sentencia))){
		echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: ". mysqli_error($identificador);
		echo "</p>";
		exit;
	}
	 
	$sentencia= "delete from usuarios where idUsuario=$_SESSION[idUsu]";
	if(!($resultado = @mysqli_query($identificador,$sentencia))){
		echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: ". mysqli_error($identificador);
		echo "</p>";
		exit;
	}
	
	$_SESSION = array();
            
			if(isset($_COOKIE[$cookie_name])) {
				setcookie($cookie_name, '', time() - 42000, '/');
			}

            session_destroy(); 
            $host = $_SERVER['HTTP_HOST'];
            $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
            $extra = 'index.php';
            header("Location: http://$host$uri/$extra");
	
	header("Location: index.php");
	mysqli_free_result($resultado);
	mysqli_close($identificador);
?>