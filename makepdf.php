<?php
	//require_once 'head.php';
	include_once("mysql_connection_data.php");

	//Conectar con la base de datos
    $identificador = @mysqli_connect('localhost',$MYSQL_USER,$MYSQL_PASS,$MYSQL_DB);
    if(!$identificador){
        echo "<p>Error al conectar con la base de datos: ". mysqli_connect_errno();
        echo "</p>";
        exit;
    }

    $sqlResult = "SELECT * FROM fotos LEFT JOIN paises ON Pais = idPais WHERE Album = $_GET[id] ORDER BY Fecha DESC";
    $sqlAlbumResult = "SELECT * FROM albumes LEFT JOIN paises ON Pais = idPais LEFT JOIN usuarios ON Usuario = idUsuario WHERE idAlbum = $_GET[id]";

    if(!($resultado = @mysqli_query($identificador,$sqlResult)) || !($resultado2 = @mysqli_query($identificador,$sqlAlbumResult))){
        echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: ". mysqli_error($identificador);
        echo "</p>";
        exit;
    }

    $cont=mysqli_num_rows($resultado2);

    if($cont != 0){
    	while($fila=mysqli_fetch_assoc($resultado2)){
			$tituloAlbum=$fila["TituloAlbum"];
			$usuario = $fila['NomUsuario'];
	        $fecha = $fila['Fecha'];
	        $pais = $fila['NombrePais'];
	        $descripcion = $fila['Descripcion'];
		}
    }
    date_default_timezone_set('Europe/Madrid');
	require("Resources/fpdf17/fpdf.php");
	
	$pdf = new FPDF("P","mm","A4");
	$pdf->SetFont("Times");
	$pdf->AddPage();
	
	$pdf->SetFont("Arial", "I", 12);
	$pdf->Cell(0, 10, "Album:", 0, 1, "C");

  	$pdf->SetFont("Arial", "B", 20);
    $pdf->Cell(0, 10, $tituloAlbum, 0, 1, "C");

    $pdf->SetFont("Arial", "", 10);
    if($fecha != NULL) $pdf->Cell(0, 10, "".$fecha, 0, 1, "C");
    else $pdf->Cell(0, 10, "No date", 0, 1, "C");
    $pdf->Cell(0, 10, "Created by: ".$usuario, 0, 1, "C");
    $pdf->Cell(0, 200, "PDF created on the: ".date("d/m/Y"), 0, 1, "C");

    $pdf->AddPage();
    $pdf->SetLeftMargin(15);
    $pdf->SetFont("Arial", "U", 20);
    $pdf->Write(50, $tituloAlbum."\n");
	
	$pdf->SetFont("Arial", "I", 14);
	if(strlen($descripcion) > 0) $pdf->Write(7, "Descripcion: ".$descripcion."\n");
	if($fecha != NULL) $pdf->Write(7, "Fecha: ".$fecha."\n");
    if($pais != NULL) $pdf->Write(7, "Pais: ".$pais."\n");

    $n = mysqli_num_rows($resultado);
    //$pdf->SetLeftMargin(135);
    $pdf->SetFont("Arial", "I", 10);
    if($n != 1) $pdf->Write(25, "The album contains $n pictures \n");
    else if($n == 1) $pdf->Write(25, "The album contains $n picture \n");
    else $pdf->Write(25, "El álbum does not contain any picture\n");

    if($n != 0){
	    $pdf->AddPage();
	  	$pdf->SetLeftMargin(15);
	   	$pdf->SetFont("Arial", "I", 12);

	    while($sqlPhotoArray = mysqli_fetch_array($resultado)){
	    	
			$tituloFoto = $sqlPhotoArray['Titulo'];
			$descripcionFoto = $sqlPhotoArray['Descripcion'];
			$fechaFoto = $sqlPhotoArray['Fecha'];
			$paisFoto = $sqlPhotoArray['NombrePais'];
			$url = $sqlPhotoArray['Fichero'];
			
			$pdf->SetFont("Arial", "B", 18);
			$pdf->Cell(0, 10, $tituloFoto, 0, 1, "C");
			$pdf->SetFont("Arial", "", 12);
			if($fechaFoto != NULL || $paisFoto != NULL) $pdf->Cell(0, 5, $fechaFoto." ".$paisFoto, 0, 1, "C");
			if(strlen($descripcionFoto) > 0) $pdf->Cell(0, 10, $descripcionFoto, 0, 1, "C");  
			$size = 100;
			$absx=(210-$size)/2;  
			//if(substr($url,0,5) == "media")	$pdf->Image("../".$url, $absx, NULL, $size);     
			$pdf->Image($url, $absx, NULL, $size); 
			$pdf->Cell(0, 20, "", 0, 1, "C");

			$titulos[] =  $tituloFoto; ;
	    }
	    $pdf->AddPage();
	    
	    $pdf->SetFont("Arial", "B", 12);
	    $pdf->Write(10, "List of pictures: \n");
	    $pdf->SetFont("Arial", "", 10);
	    for($i=0; $i<sizeof($titulos);$i++){
	      $pdf->Write(5, $titulos[$i]."\n");
	    }
	}

    $pdf->Output();
?>