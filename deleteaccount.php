<?php
	session_start();
	require_once 'head.php'; 
	if (!isset($_COOKIE['authenticated']) && !isset($_SESSION['authenticated'])){
        echo "
        	<script> document.location.href = 'datailpictnosession.php'; </script>
        ";
	}
	$identificador =  @mysqli_connect('localhost',$MYSQL_USER,$MYSQL_PASS,$MYSQL_DB);
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
    echo "
    	<script> document.location.href = 'index.php'; </script>

    ";
	mysqli_free_result($resultado);
	mysqli_close($identificador);
?>