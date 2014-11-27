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
	?>

	<body>
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
							<input class="search" type="search" name="searchInput" placeholder="Search..." />

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
                    $identificador = @mysqli_connect('localhost','web','','pibd');
                    $i=0;
                    if(!$identificador){
                        echo "<p>Error al conectar con la base de datos: ". mysqli_connect_errno();
                        echo "</p>";
                        exit;
                    }
                    $sentencia= "select * from fotos,paises,albumes,usuarios where idFoto=$_GET[id] and fotos.pais=paises.idPais and fotos.Album=albumes.idAlbum and usuarios.idUsuario=albumes.Usuario";
                    if(!($resultado = @mysqli_query($identificador,$sentencia))){
                        echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: ". mysqli_error($identificador);
                        echo "</p>";
                        exit;
                    }
                    $fila = @mysqli_fetch_assoc($resultado);
                    echo "<img class='detailPicture' src='$fila[Fichero]' alt='$fila[Descripcion]'/>";
                ?>
				<span class="info">
					 By <?php $t='fotos.'.'Titulo';echo "$fila[Titulo]";?>, the <?php echo "$fila[Fecha] ";?> 
					in <?php echo "$fila[NombrePais] ";?> 
				</span>

				<span class="authors">
					<b>From the album:</b> <?php echo"<a href='detailalbum.php?id=$fila[idAlbum]' class='detailAhref'>";  echo "$fila[TituloAlbum]";?></a> <br>
                    <b>From the user:</b> <?php echo"<a href='#' class='detailAhref'>"; echo "$fila[NomUsuario]";
                    	mysql_free_result($resultado);
						mysql_close($identificador);
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