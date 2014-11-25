<!DOCTYPE html>
<html lang="es">
	<?php 
		require_once 'head.php';
		$webTitle = "My Profile - Picturesque";	
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
		
		$sentencia= "select * from albumes,usuarios where usuarios.idUsuario=albumes.Usuario and NomUsuario='$_COOKIE[authenticated]'";
		$usuario= "select * from usuarios,sexo where NomUsuario='$_COOKIE[authenticated]' and usuarios.sexo=sexo.idGenero";
				
		if(!($resultado = @mysqli_query($identificador,$sentencia)) || !($resultado2 = @mysqli_query($identificador,$usuario)) ){
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
			<div class="boxPics"> <h2>My profile <i class="fa fa-thumb-tack"></i></h2> </div>	

			
			<h2 class="titleProfiles">My Account <i class="fa fa-database"></i>
			<button class="btn btn-login btnModify"><i class="fa fa-pencil-square-o"></i>
			 Modify</button>
 			</h2>
			<div class="userInfo">
				<?php 
					$user = mysqli_fetch_assoc($resultado2);
					if($user['Foto']==null){
						echo "<img id='photoUser' src='Resources/Images/add_user.png' alt='User avatar'/>";
					}
					else{
						echo "<img id='photoUser' src='$user[Foto]' alt='User avatar'/>";
					}				
				
				?>
				
				<span class="usernameUser">
					<?php if(!isset($_COOKIE['authenticated']) && isset($_SESSION['authenticated'])) echo $_SESSION['authenticated'];
						else echo $_COOKIE['authenticated'];
					 ?>

				</span>
				<p class="genderUser"><?php  echo "$user[Tipo]";?></p>
				<p class="emailUser"><?php echo "$user[Email]";?></p>
				<p class="dateUser"><?php echo "$user[FNacimiento]";?></p>
				<p class="cityUser"><?php echo "$user[Ciudad]";?></p>
			</div>
			
			
			
			<br>
			<h2 class="titleProfiles">My Albums <i class="fa fa-picture-o"></i>
			<button class="btn btn-login btnNew">
			 <i class="fa fa-plus"></i><a href="crearalbum.php"> New Album</a></button>
			</h2>
			<!--<ul>
				<li style="height:150px; width:176px;">
					<img src="Resources/Images/perro1.jpg" alt="Perro 1"/>
					<a class="titleImage" href="detailpicture.php"><span class="titleImage">Album: dogs</span></a>
				</li>
				<li style="height:150px; width:176px;">
					<img src="Resources/Images/perro2.jpg" alt="Perro 2"/>
					<a class="titleImage" href="detailpicture.php"><span class="titleImage">Album: doggy</span></a>
				</li>
				<li style="height:150px; width:176px;">
					<img src="Resources/Images/perro3.jpg" alt="Perro 3"/>
					<a class="titleImage" href="detailpicture.php"><span class="titleImage">Album: cats</span></a>					
				</li>				
			</ul>-->
			
			<?php 
				
				echo "<ul>";
				while ($fila = @mysqli_fetch_assoc($resultado)){
					echo "<li>";
						echo "<a class='titleImage' href='detailalbum.php?id=$fila[idAlbum]'><span class='titleImage'>Album: $fila[TituloAlbum]</span></a>";
					echo "</li>";
				}
				echo "</ul>";
			
			
			?>

			<a href="#" id="deleteUser">Delete account</a>		
			<br><br>	
		</section>
		<span class="rights printIn">Made for an awesome subject in the University of Alicante. All Copyright reserved to Alberto Martínez Martínez and Roxanne López van Dooren</span>
		

		<?php
			require_once("footer.php");
		?>		
		
		<script src="js/login.js"></script>
	</body>	
</html>


