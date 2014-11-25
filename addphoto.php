<!DOCTYPE html>
<html lang="es">
	<?php 
		require_once 'head.php'; 
		$webTitle = "Add photo- Picturesque";		
	?>

	<body onLoad="fillAlbumDate()">		
		<div id="popUpAlbum">
			<?php
      			include 'album.html';  
    		?>
		</div>
		<div id="overlay-back"></div>
		<header>				
			<a href="index.php"> 
				<img class="logoBox" src="Resources/Images/logo.png" alt="Logo"/> 
			</a>	
			<?php if (isset($_COOKIE['authenticated']) || isset($_SESSION['authenticated'])) include 'logged.html';   ?>

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
				<h1>Add a new photo to...</h1>				
			</div>						
		</header>

		<section>
			<div class="boxPics"> <a class="back" href="profile.php"><h2><i class="fa fa-arrow-left"></i>  Go back</h2></a></div>
			<div class="wrapper ASWrapper">
                <div class="login WSadvanced">				
					<form autocomplete="on" method="get" id="addPhotoform" action="addphoto.php" > 
						<div class="wrapperSearch wrapperAddPhoto">
							<span class="titleh1">Complete the fields... </span> 
							<div class="usuRegistro"> 
								<p>     
									<label for="title"><b>TITLE: </b> </label>                      
									<input type="text" name="title" id="title" placeholder="E.G: landscape"/>                         
								</p>   
								<p>     
									<label for="title"><b>DESCRIPTION: </b> </label> <br>
									<textarea rows="4" cols="50" name="description" id="description" form="albumform">  </textarea>							
								</p>   
								<p id="dateFields">     
									<label for="dateFrom" id="dateTitle"><b>DATE: </b> </label>                  
											<select id="dayfrom" name="dayfrom" onchange="reseting(this)">
											</select>
											<select id="monthfrom" name="monthfrom" onchange="reseting(this)">
											</select>
											<select id="yearfrom" name="yearfrom" onchange="reseting(this)">
											</select> <br>         
								</p>   
								
								<p>     
									<label for="title"><b>COUNTRY: </b> </label>                      
									<?php
											$identificador = @mysqli_connect('localhost','web','','pibd');
											$i=0;
											if(!$identificador){
												echo "<p>Error al conectar con la base de datos: ". mysqli_connect_errno();
												echo "</p>";
												exit;
											}
											
											$sentencia= "select * from paises";
											
											if(!($resultado = @mysqli_query($identificador,$sentencia))){
												echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: ". mysqli_error($identificador);
												echo "</p>";
												exit;
											}
										
											echo "<select name='country' id='country'>";
												while ($fila = @mysqli_fetch_assoc($resultado)){
													echo "<option value='$fila[idPais]'> $fila[NombrePais] </option>";
												}
											
											echo "</select>";
										
										?>                       
								</p>   
								<label for="picture">Picture: </label>                                              
	                            <input type="file" name="picture" id="picture"/>

								<p class="button printOut"><input class="searchR" type="submit" value="Add!"/> </p>
								<button class="printIn">Add!</button>
													 
							</div> 
						</div>                      
					</form>
					</div>
                 
        		</div>
        	</div>
	
		</section>
		
		<?php
			print_r ($_GET);
			
		?>
		
		<span class="rights printIn">Made for an awesome subject in the University of Alicante. All Copyright reserved to Alberto Martínez Martínez and Roxanne López van Dooren</span>
		<?php
			require_once("footer.php");
		?>	
		
	</body>	
</html>