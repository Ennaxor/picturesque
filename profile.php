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
        
        $sentencia= "select * from albumes,usuarios where usuarios.idUsuario=albumes.Usuario and idUsuario='$_SESSION[idUsu]'";
        $usuario= "select * from usuarios,sexo where idUsuario='$_SESSION[idUsu]' and usuarios.sexo=sexo.idGenero";
                
        if(!($resultado = @mysqli_query($identificador,$sentencia)) || !($resultado2 = @mysqli_query($identificador,$usuario)) ){
            echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: ". mysqli_error($identificador);
            echo "</p>";
            exit;
        }

	?>
	<body>	
		<div id="popUpDeleteAccount">
			<?php
				include 'deleteaccount.html';	

    		?>

		</div>
		<div id="overlay-back"></div>
		
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
			<div class="boxPics profileBox"> <h2>My profile <i class="fa fa-thumb-tack"></i></h2> </div>	

			
			<h2 class="titleProfiles">My Account <i class="fa fa-database"></i>
			<button class="btn btn-login btnModify" onclick="modifyProfile()"><i class="fa fa-pencil-square-o"></i>
			 Modify</button>
 			</h2>
			<div class="userInfo">
				<?php 
                    $user = mysqli_fetch_assoc($resultado2);
                    if( strlen($user['Foto']) == 0 ){
                        echo "<img id='photoUser' src='Resources/Images/add_user.png' alt='User avatar'/>";
                    }
                    else{
                        echo "<img id='photoUser' src='$user[Foto]' alt='User avatar'/>";
                    }               
                ?>

				<span class="usernameUser">
					<?php
						$sentenciaUsuarioNombre = "select NomUsuario from usuarios where idUsuario='$_SESSION[idUsu]'";
						if(!($resultadoNombre = @mysqli_query($identificador,$sentenciaUsuarioNombre)) ){
				            echo "<p>Error al ejecutar la sentencia <b>$sentenciaUsuarioNombre</b>: ". mysqli_error($identificador);
				            echo "</p>";
				            exit;
				        }
				        while ($filaNombre = @mysqli_fetch_assoc($resultadoNombre)){
			        		if(!isset($_COOKIE['idUsu']) && isset($_SESSION['idUsu'])) echo $filaNombre["NomUsuario"];
							else echo $_COOKIE['idUsu'];
			            }
						
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
			 <i class="fa fa-plus"></i><a href="crearalbum.php"> New Album </a></button>
			</h2>
			
			<?php 
				$count = mysqli_num_rows($resultado);		
				if($count == 0) echo "<span class='noPhotos'>No albums created</span>";
                echo "<ul>";
                while ($fila = @mysqli_fetch_assoc($resultado)){
                    echo "<li>";
                        echo "<a class='titleImage' href='detailalbum.php?id=$fila[idAlbum]'><span class='titleImage'>Album: $fila[TituloAlbum]</span></a>";
                    echo "</li>";
                }
                echo "</ul>";
                mysqli_free_result($resultado);
                mysqli_free_result($resultado2);
				mysqli_close($identificador);
            ?>


			<!--<a href="#" id="deleteUser">Delete account</a>	-->
			<h2> 
			<button class="btn btn-login btnNew btnDA" onclick="showDeleteAccount()">Delete account</button>
			</h2>
			
			<br><br>	
		</section>
		<span class="rights printIn">Made for an awesome subject in the University of Alicante. All Copyright reserved to Alberto Martínez Martínez and Roxanne López van Dooren</span>
		<?php
			require_once("footer.php");
		?>		
		
		<script src="js/login.js"></script>
	</body>	
</html>


