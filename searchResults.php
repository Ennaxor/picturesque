<!DOCTYPE html>
<html lang="es">
	<?php 
		require_once 'head.php'; 
		$webTitle = "Results of your search- Picturesque";		
	?>

	<body>
		<div id="popUpLogin">
			<?php
      			if (!isset($_COOKIE['authenticated']) || !isset($_SESSION['authenticated'])) include 'login.php';       			     			
    		?>
		</div>
		<div id="overlay-back"></div>

		<header class="specialHeader">				
			<a href="index.php"> 
				<img class="logoBox" src="Resources/Images/logo.png" alt="Logo"/> 
			</a>	
			<?php if (isset($_COOKIE['authenticated']) || isset($_SESSION['authenticated'])) include 'logged.html';   ?>	

			<?php if (!isset($_COOKIE['authenticated']) && !isset($_SESSION['authenticated'])) 
			echo "<button id=\"loginPopUp\" onClick=\"showLogin();\"><i class=\"fa fa-sign-in\"></i> Sign in! </button>" ?>
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
			<div class="padding headerContent searching">
				<h1>You searched for...</h1>	
				<ul class="searchRes">			
					<li><b>TITLE</b><br> 
					<?php 
						//Conectar con la base de datos y hacer la consulta
						$identificador = @mysqli_connect('localhost','web','','pibd');
						$i=0;
						if(!$identificador){
							echo "<p>Error al conectar con la base de datos: ". mysqli_connect_errno();
							echo "</p>";
							exit;
						}
						$title = null;						
						if(empty($_GET["searchInput"])==0){
							print_r($_GET["searchInput"]);
                            $title=$_GET["searchInput"];
						}
						else{
							if(empty($_GET["title"])==0){
								print_r($_GET["title"]);
                                $title=$_GET["title"];
							}
							else{
								echo ('empty') ;
							}
						}
					?>
							</li>							
					<li><b>DATE TIME</b><br>
					From:
					<?php 
						$montharrya = array("January","February","March","April","May","June","July","August","September","October","November","December");
						$datefrom=null;
						if(empty($_GET["dayfrom"])==0 || empty($_GET["monthfrom"])==0 || empty($_GET["yearfrom"])==0){
							print_r($_GET["dayfrom"]);
							echo("/");
							for($i=0;$i<11;$i++){
								if($_GET["monthfrom"]==$montharrya[$i]){
									$mes=$i+1;
									echo ("$mes/");
								}
							}
							print_r($_GET["yearfrom"]);
							$datefrom=$_GET["yearfrom"]."-".$mes."-".$_GET["dayfrom"];
						}
						else{
							echo ('empty') ;
						}
						
					?> 
					- To: 
					<?php 
						$dateto=null;
						if(empty($_GET["dayto"])==0 || empty($_GET["monthto"])==0 || empty($_GET["yearto"])==0){
							print_r($_GET["dayto"]);
							echo("/");
							for($i=0;$i<11;$i++){
								if($_GET["monthto"]==$montharrya[$i]){
									$mes=$i+1;
									echo ("$mes/");
								}
							}
							print_r($_GET["yearto"]);
							$dateto=$_GET["yearto"]."-".$mes."-".$_GET["dayto"];
						}
						else{
							echo("empty");
						}
					?>
					</li>					
					<li><b>COUNTRY</b> <br>
					<?php 
						$country=null;
						if(empty($_GET["country"])==0){
							$sentenciaCountry = "select NombrePais from paises where idPais = '$_GET[country]'";
							if(!($resultadoCountry = @mysqli_query($identificador,$sentenciaCountry))){
								echo "<p>Error al ejecutar la sentencia <b>$sentenciaCountry</b>: ". mysqli_error($identificador);
								echo "</p>";
								exit;
							}
							$fila = @mysqli_fetch_assoc($resultadoCountry);
							print_r("$fila[NombrePais]");
							$country="$fila[NombrePais]";
						}
						else{
							echo ('empty') ;
						}
					?></li>
					<?php
						$sentencia= "select * from fotos, paises where fotos.pais=paises.idPais";
						if($title != null)	$sentencia.=" and Titulo LIKE '%$title%'";
						if($datefrom !=null) $sentencia.=" and Fecha>='$datefrom'";
						if($dateto !=null) $sentencia.=" and Fecha<='$dateto'";
						if($country != null) $sentencia.=" and NombrePais='$country'";
						if(!($resultado = @mysqli_query($identificador,$sentencia))){
							echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: ". mysqli_error($identificador);
							echo "</p>";
							exit;
						}
						$cont=mysqli_num_rows($resultado);
					?>
					<li><b>MATCHES</b> <br> <?php echo " $cont " ?>results</li>        
		
										
				</ul>			
			</div>						
		</header>
		<section>			
			<div class="boxPics"><a class="back" href="searchpro.php"><h2><i class="fa fa-arrow-left"></i> Other</h2></a></div>
			<br>
			<span class="orderText">
				Order by 
				<button class="btn btn-order" id="orderTitle" onclick="orderby(this)">Title ~</button> 
				<button class="btn btn-order" id="orderDate" onclick="orderby(this)">Date ~</button>
				<button class="btn btn-order country" id="orderCountry" onclick="orderby(this)">Country ~</button>
			</span>
			<br>
			<br>
			<?php 				
				echo "<ul id='searchResults'>";
				while ($fila = @mysqli_fetch_assoc($resultado)){
					echo "<li>";
						echo "<img src='$fila[Fichero]' alt='Perro 1'/>  ";
						echo "<a class='titleImage' href='detailpicture.php?id=$fila[idFoto]'><span class='titleImage'>Title: $fila[Titulo]</span></a> ";
						echo "<p><b class='titlePrint'><a href='detailpicture.php?id=$i'>Title: <span class='titleImage'>$fila[Titulo]</span></a></b>
						made on the <span class='dateField'>$fila[Fecha]</span> in <span class='countryField'>$fila[NombrePais]</span> </p>";
					echo "</li>";
				}
				echo "</ul>";
				
	            mysql_free_result($resultado);
	            mysql_close($identificador);			
			?>
					
		</section>
		
		

		<span class="rights printIn">Made for an awesome subject in the University of Alicante. All Copyright reserved to Alberto Martínez Martínez and Roxanne López van Dooren</span>
		<?php
			require_once("footer.php");
		?>

		<script src="js/order.js"></script>
		
	</body>	
</html>