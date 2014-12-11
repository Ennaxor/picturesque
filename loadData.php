<?php
	include_once('pagination.php');

	$identificador = @mysqli_connect('localhost','web','','pibd');
    if(!$identificador){
        echo "<p>Error al conectar con la base de datos: ". mysqli_connect_errno();
        echo "</p>";
        exit;
    }

	if(isset($_POST['pageId']) && !empty($_POST['pageId'])){
	   $id=$_POST['pageId'];
	}else{
	   $id='0';
	}
	$pageLimit=PAGE_PER_NO*$id;
	$query = "select f.Fichero, f.idFoto, f.Titulo, f.Fecha, p.NombrePais from fotos f, paises p, albumes a where 
				f.pais=p.idPais and f.album=a.idAlbum and f.album=$_GET[id] order by idFoto desc limit $pageLimit,".PAGE_PER_NO;
	$res=mysqli_query($identificador, $query);
	$count=mysqli_num_rows($res);
	if($count > 0){
		echo "<ul>";
		while($fila=mysqli_fetch_array($res)){
		  echo "<li>";
            echo "<img src='$fila[Fichero]' alt='$fila[Fichero]'/>  ";
            echo "<a class='titleImage' href='detailpicture.php?id=$fila[idFoto]'><span class='titleImage'>Title: $fila[Titulo]</span></a> ";
            echo "<p><b class='titlePrint'><a href='detailpicture.php?id=$fila[idFoto]'>Title: $fila[Titulo]</a></b> <b>Date:</b> $fila[Fecha] <b>Country:</b> $fila[NombrePais] </p>";
        	echo "</li>";;
		}
		 echo "</ul>";
	}else{
	    echo "<span class='noPhotos'>No photos to show in this album</span>";
	}
?>

	