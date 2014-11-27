<!DOCTYPE html>
<html lang="es">
	<?php 
		require_once 'head.php';
		$webTitle = "Album Detail - Picturesque";	
		if (!isset($_COOKIE['authenticated']) && !isset($_SESSION['authenticated'])){
			$host = $_SERVER['HTTP_HOST'];
            $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
            $extra = 'index.php';
            header("Location: http://$host$uri/$extra");
		}
		//Conectar con la base de datos
		
        $identificador = @mysqli_connect('localhost','web','','pibd');
        if(!$identificador){
            echo "<p>Error al conectar con la base de datos: ". mysqli_connect_errno();
            echo "</p>";
            exit;
        }
        
        $sentencia= "select * from fotos, paises, albumes where fotos.pais=paises.idPais and fotos.album=albumes.idAlbum and fotos.album=$_GET[id]";
        $sentenciaAlbum = "select TituloAlbum, idAlbum from albumes where idAlbum = $_GET[id]";
		if(!($resultado = @mysqli_query($identificador,$sentencia)) || !($resultado2 = @mysqli_query($identificador,$sentenciaAlbum)) ){
            echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: ". mysqli_error($identificador);
            echo "</p>";
            exit;
        }

	?>
	<body>				
		<header>				
			<a href="index.php"> 
				<img class="logoBox" src="Resources/Images/logo.png" alt="Logo"/> 
			</a>				
			<?php if (isset($_COOKIE['authenticated']) || isset($_SESSION['authenticated'])) include 'logged.html';   ?>

			<div class="currentStyleProfile">
				<button class="btn btn-login btnStyle" id="cangestyle">Style</button>
				<ul id="webstyle">
					<li id="principal" onclick="getStringFromObject(this)"> <p>Principal</p></li>
					<li id="accesible" onclick="getStringFromObject(this)"> <p>Accesible</p></li>			
				</ul>
			</div>	
			<div class="currentAccesibleStyle">
				<p> Pick the Style: </p>
				<button class="btn btn-login btnStyle" id="principalA" onclick="getStringFromObject(this)" >Principal </button>
				<button class="btn btn-login btnStyle" id="accesibleA" onclick="getStringFromObject(this)" >Accesible </button>
			</div>
			
			<div class="padding headerUser"></div>							
		</header>	
	
		<section>			
			<div class="boxPics">  <a class="back" href="profile.php"><h2>&lt;- Go back</h2></a> </div>	
			<br>
			<h2 class="titleProfiles">Photos from 
			<?php 
			 	while ($fila = @mysqli_fetch_assoc($resultado2)){
					echo "$fila[TituloAlbum]"; 
				 	echo " <i class='fa fa-camera'></i> <button class='btn btn-login btnNew'><i class='fa fa-plus'></i><a href='addphoto.php?id=$fila[idAlbum]'> Add Photo</a></button>
					</h2>";
				}
			?>
			
			 <?php 
			 	if (mysqli_num_rows($resultado) == 0) { 
   					echo "<span class='noPhotos'>No photos in this album</span>";
				}
				else{
	                echo "<ul>";
	                    while ($fila = @mysqli_fetch_assoc($resultado)){
	                        echo "<li>";
	                            echo "<img src='$fila[Fichero]' alt='$fila[Fichero]'/>  ";
	                            echo "<a class='titleImage' href='detailpicture.php?id=$fila[idFoto]'><span class='titleImage'>Title: $fila[Titulo]</span></a> ";
	                            echo "<p><b class='titlePrint'><a href='detailpicture.php?id=$i'>Title: $fila[Titulo]</a></b> <b>Date:</b> $fila[Fecha] <b>Country:</b> $fila[NombrePais] </p>";
	                        echo "</li>";
	                    }
	                echo "</ul>";
                }
                mysqli_free_result($resultado);
                mysqli_free_result($resultado2);
				mysqli_close($identificador);
            ?>
			
		</section>
		<span class="rights printIn">Made for an awesome subject in the University of Alicante. All Copyright reserved to Alberto Martínez Martínez and Roxanne López van Dooren</span>
		<?php
			require_once("footer.php");
		?>		
		
		<script src="js/login.js"></script>
	</body>	
</html>


