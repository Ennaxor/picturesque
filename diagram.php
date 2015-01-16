<?php
	// Crea una imagen
	$image = imagecreatetruecolor(500, 280);
	// Define los colores que se van a emplear
	$white = imagecolorallocate($image, 0xFF, 0xFF, 0xFF);
	$gray = imagecolorallocate($image, 0xC0, 0xC0, 0xC0);
	$darkgray = imagecolorallocate($image, 0x90, 0x90, 0x90);
	$navy = imagecolorallocate($image, 0x00, 0x00, 0x80);
	$darknavy = imagecolorallocate($image, 0x00, 0x00, 0x50);
	$red = imagecolorallocate($image, 0xFF, 0x00, 0x00);
	$darkred = imagecolorallocate($image, 0x90, 0x00, 0x00);
	$orange = imagecolorallocate($image, 0xF3, 0x7A, 0x29);
	$blue = imagecolorallocate($image,0x80,0xD1,0xB9);
	// Rellena la imagen de blanco
	imagefill($image, 0, 0, $orange);
	// Dibuja los ejes
	//imagefilledrectangle ( resource $image , int $x1 , int $y1 , int $x2 , int $y2 , int $color )
	
	imagefilledrectangle ($image , 148 , 5 , 150 , 275 , $blue );//vertical
	imagefilledrectangle ($image , 5 , 250 , 495 , 252 , $blue );//horizontal
	
	//Barras de cada una de las imagenes
	$posy=22;
	$posfin=30;
	
	$max=0;
	$array=$finaldateArray;
	for($i=0;$i<count($array);$i++){
		$date = split('[ ]', $array[$i][0]);
		imagestring ( $image , 1 , 50 , $posy , $date[0] , $white );
		imagefilledrectangle ($image , 150 , $posy-2 , 150+$posfin*$array[$i][1] , $posy+2 , $white );//horizontal
		if($array[$i][1]>$max) $max=$array[$i][1];
		$posy+=30;
	}
	
	$posx =180;
	for($i=0;$i<$max;$i++){
		imagestring ( $image , 1 , $posx , 260 , $i+1 , $white );
		$posx+=30;
	}	
	
	// Activa el almacenamiento en el buffer de salida
	ob_start();
	imagepng($image);
	// ob_get_contents() devuelve el contenido del buffer de salida
	$img_src = "data:image/png;base64," . base64_encode(ob_get_contents());
	// Limpia y deshabilita el buffer de salida
	ob_end_clean();
	// Libera los recursos utilizados
	imagedestroy($image);

?>
