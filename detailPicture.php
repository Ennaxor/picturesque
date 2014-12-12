<!DOCTYPE html>
<html lang="es">
	<?php 
		require_once 'head.php'; 
		$webTitle = "Picture Detail - Picturesque";	
		if (!isset($_COOKIE['authenticated']) && !isset($_SESSION['authenticated'])){
			$host = $_SERVER['HTTP_HOST'];
            $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
            $extra = 'index.php';
            header("Location: http://$host$uri/$extra");
		}	
		$identificador = @mysqli_connect('localhost','web','','pibd');
        if(!$identificador){
            echo "<p>Error al conectar con la base de datos: ". mysqli_connect_errno();
            echo "</p>";
            exit;
        }
		 
        $sentenciaAlbum = "select Album from fotos where idFoto = $_GET[id]";
		if( !($resultado = @mysqli_query($identificador,$sentenciaAlbum))){
            echo "<p>Error al ejecutar la sentencia <b>$sentenciaAlbum</b>: ". mysqli_error($identificador);
            echo "</p>";
            exit;
        }
		$cont=mysqli_num_rows($resultado);
		if($cont!=0){
			while($fila=mysqli_fetch_assoc($resultado)){
				$idA=$fila["Album"];
			}
			$sentenciaUsuario = "select Usuario from albumes where idAlbum=".$idA;
			if( !($resultado = @mysqli_query($identificador,$sentenciaUsuario))){
				echo "<p>Error al ejecutar la sentencia <b>$sentenciaAlbum</b>: ". mysqli_error($identificador);
				echo "</p>";
				exit;
			}
		}

	?>

	<body>
	<div id="popUpDeletePhoto">
		<?php
			include 'deletephoto.html';	
		?>
	</div>
	<div id="overlay-back"></div>
		<header>				
			<a href="index.php"> 
				<img class="logoBox" src="Resources/Images/logo.png" alt="Logo"/> 
			</a>	

			<?php
			 if (isset($_COOKIE['authenticated']) || isset($_SESSION['authenticated'])) include 'logged.html'; 
			?>	
			
			<div class="currentStyle">
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


			<div class="padding headerContent">
				<h1>DISCOVER &amp; SHARE</h1>				
				<form enctype="multipart/form-data" method="get" action="searchresults.php">					
						<div class="searchContainer">							
							<img class="lupa" src="Resources/Images/search-icon.png" alt="search icon" />
							<input required="" class="search" type="search" name="searchInput" placeholder="Search..." />

							<input class="btn btn-login" type="submit" value="Go!"/>
							<a class= "btn btn-login searchAdvanced" href="searchpro.php">
								<img src="Resources/Images/gear.png" alt="gear icon" />
							</a>
						</div>						
					</form>				
				
			</div>						
		</header>

		<section>
			<div class="boxPics"> <a class="back" href="index.php"><h2>&lt;- Go back</h2></a></div>

			
			
			<div class="padding picDet">	
				<?php
				
				while ($fila = @mysqli_fetch_assoc($resultado)){
				 	if($fila["Usuario"] == $_SESSION["idUsu"]) echo "<button class=\"btn btn-login btnStyle\" id=\"deletePhoto\" onclick=\"showDeletePhoto($_GET[id])\">Delete</button>";
					
				}
				 
						
					
						
					
				?>
                <?php
                    $sentencia= "select f.Fichero, f.Descripcion, f.Titulo, f.Fecha, p.NombrePais, a.idAlbum, a.TituloAlbum, u.NomUsuario from fotos f,paises p,albumes a,usuarios u 
                    			where idFoto=$_GET[id] and f.pais=p.idPais and f.Album=a.idAlbum and u.idUsuario=a.Usuario";
                    if(!($resultado = @mysqli_query($identificador,$sentencia))){
                        echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: ". mysqli_error($identificador);
                        echo "</p>";
                        exit;
                    }
					$count = mysqli_num_rows($resultado);		
					if($count == 0) echo "<span class='noPhotos'>NO PHOTO WITH THIS ID</span>";
					else{
	                    $fila = @mysqli_fetch_assoc($resultado);
	                    echo "<img class='detailPicture' src='$fila[Fichero]' alt='$fila[Descripcion]'/>";

                ?>
				<span class="info">
					This is <?php $t='fotos.'.'Titulo';echo "$fila[Titulo]";?>, the <?php echo "$fila[Fecha] ";?> 
					in <?php echo "$fila[NombrePais] ";?> 
				</span>

				<span class="authors">
					<b>From the album:</b> <?php echo"<a href='detailalbum.php?id=$fila[idAlbum]' class='detailAhref'>";  echo "$fila[TituloAlbum]";?></a> <br>
                    <b>From the user:</b> <?php echo"<a href='#' class='detailAhref'>"; echo "$fila[NomUsuario]"; 
                    	} //END ELSE COUNT
                    	mysqli_free_result($resultado);
						mysqli_close($identificador);
                    ?></a>     
	
				</span>
							
			</div>			
		</section>
		<span class="rights printIn">Made for an awesome subject in the University of Alicante. All Copyright reserved to Alberto Martínez Martínez and Roxanne López van Dooren</span>
		<?php
			require_once("footer.php");
		?>	
	</body>	
</html>