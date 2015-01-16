<?php
	// Crea una imagen
	$image = imagecreatetruecolor(200, 280);
	// Define los colores que se van a emplear
	$white = imagecolorallocate($image, 0xFF, 0xFF, 0xFF);
	$gray = imagecolorallocate($image, 0xC0, 0xC0, 0xC0);
	$darkgray = imagecolorallocate($image, 0x90, 0x90, 0x90);
	$navy = imagecolorallocate($image, 0x00, 0x00, 0x80);
	$darknavy = imagecolorallocate($image, 0x00, 0x00, 0x50);
	$red = imagecolorallocate($image, 0xFF, 0x00, 0x00);
	$darkred = imagecolorallocate($image, 0x90, 0x00, 0x00);
	$orange = imagecolorallocate($image, 0xF3, 0x7A, 0x29);
	
	// Rellena la imagen de blanco
	imagefill($image, 0, 0, $orange);
	$imageArray=array();
					
	$sentencia= "select idAlbum from albumes where albumes.usuario='$_SESSION[idUsu]'";
				
	if(!($resultado1 = @mysqli_query($identificador,$sentencia))){
		echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: ". mysqli_error($identificador);
		echo "</p>";
		exit;
	}

	$array=array();
	while ($fila= @mysqli_fetch_assoc($resultado1)){
		$array[]=$fila["idAlbum"];
	}
	

	
	$minelem=0;
	
	for ($i=0;$i<count($array);$i++){
		$sentencia = "select * from fotos where Album=$array[$i]";
		if(!($resultado1 = @mysqli_query($identificador,$sentencia))){
			echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: ". mysqli_error($identificador);
			echo "</p>";
			exit;
		}
		$countIMG = mysqli_num_rows($resultado1);
		if($countIMG > 0){
			$portada=array();
			while ($fila= @mysqli_fetch_assoc($resultado1)){
				$portada[]=$fila["Fichero"];
				if($minelem==5) break;
				$minelem++;
			}
			$minelem=0;
			
			$j=rand(0,count($portada)-1);
				$type=exif_imagetype ( $portada[$j]);
				switch ($type){
					case 2: $foto= imagecreatefromjpeg ( $portada[$j] ); break;
					case 3: $foto= imagecreatefrompng ( $portada[$j] ); break;
				}
				
				//$foto1;
				//imagecopyresampled($foto1,$foto,0,50,50,30,150,60,imagesx($foto),imagesy($foto));
				
				for($x = 0; $x < imagesx($foto); $x++) {
					for($y = 0; $y < imagesy($foto); $y++) {
						$rgb = imagecolorat($foto, $x, $y);
						// Realiza un desplazamiento de bits para obtener cada componente
						$r = ($rgb >> 16) & 0xFF;
						$g = ($rgb >> 8) & 0xFF;
						$b = $rgb & 0xFF;
						$nivel = ($r + $g + $b) / 3;
						$color = imagecolorallocate($foto, $nivel, $nivel, $nivel);
						imagesetpixel($foto, $x, $y, $color);
					}
				}
					
			
			$image = $foto;
			
		}
		else{
			$image = imagecreatetruecolor(200, 280);
			imagefill($image, 0, 0, $orange);
		}
		
		$imageArray[]=$image;
	}
	
	
	
	
	
	$imageShow= array();
	for($i=0;$i<count($imageArray);$i++){
		// Activa el almacenamiento en el buffer de salida
		ob_start();
		imagepng($imageArray[$i]);
		// ob_get_contents() devuelve el contenido del buffer de salida
		$imageShow[] = "data:image/png;base64," . base64_encode(ob_get_contents());
		// Limpia y deshabilita el buffer de salida
		ob_end_clean();
		// Libera los recursos utilizados
		imagedestroy($imageArray[$i]);
	}
?>
