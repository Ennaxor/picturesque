<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">
	<?php 
		$webTitle = "Album Detail - Picturesque";
		require_once 'head.php';
		require_once 'pagination.php';			
		if (!isset($_COOKIE['authenticated']) && !isset($_SESSION['authenticated'])){
		  echo "
            	<script> document.location.href = 'datailpictnosession.php'; </script>
            ";
		}
		//Conectar con la base de datos
        $identificador = @mysqli_connect('localhost',$MYSQL_USER,$MYSQL_PASS,$MYSQL_DB);
        if(!$identificador){
            echo "<p>Error al conectar con la base de datos: ". mysqli_connect_errno();
            echo "</p>";
            exit;
        }
		$sentencia= "select * from fotos, paises, albumes where fotos.pais=paises.idPais and fotos.album=albumes.idAlbum and fotos.album=$_GET[id] order by idFoto desc";
		
        
        $sentenciaAlbum = "select TituloAlbum, idAlbum, Usuario from albumes where idAlbum = $_GET[id]";
		if(!($resultado = @mysqli_query($identificador,$sentencia)) || !($resultado2 = @mysqli_query($identificador,$sentenciaAlbum))){
            echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: ". mysqli_error($identificador);
            echo "</p>";
            exit;
        }
		$count = mysqli_num_rows($resultado);
		$paginationCount = 0;		
		if($count > 0) $paginationCount=getPagination($count);
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
				 	echo " <i class='fa fa-camera'></i>";
				 	if($fila["Usuario"] == $_SESSION["idUsu"]) echo " <button class='btn btn-login btnNew'><i class='fa fa-plus'></i><a href='addphoto.php?id=$fila[idAlbum]&er=0'> Add Photo</a></button>";
					echo "</h2>";
				}
			
			 	
            ?>
            <div id="imageList"></div>
            <div id='btnPages'>
	            <button class='btn btn-login btnMR' id='backResults' onclick="prevPage()">Prev</button>
	            <?php 
	            	for($i=0;$i<$paginationCount;$i++) echo "<button class='btn btn-login btnP' onclick=\"gotoPage($i)\">$i</button>"
	            ?>
	            <button class='btn btn-login btnMR' id='moreResults' onclick="nextPage()">Next</button>
            </div>

		</section>
		
		
		<span class="rights printIn">Made for an awesome subject in the University of Alicante. All Copyright reserved to Alberto Martínez Martínez and Roxanne López van Dooren</span>
		<?php
			mysqli_free_result($resultado);
            mysqli_free_result($resultado2);
			mysqli_close($identificador);
			require_once("footer.php");

			echo "<script>
				var maxPage = $paginationCount;
				//alert(maxPage);
			</script>";
		?>

		<script type="text/javascript">
			var pageNumber = 0;
			var fetchImageList = function(pageNumber){
				
				var albumId = 0;
				if( window.location.search.substring(1).split("=")[0] == "id") albumId = window.location.search.substring(1).split("=")[1];

				var params = "pageId="+pageNumber;
				var imageListContainer = document.getElementById("imageList");
				var httpRequest = new XMLHttpRequest();
				httpRequest.onreadystatechange = function (e) { 
					if (httpRequest.readyState == 4 && httpRequest.status == 200) {
						imageListContainer.innerHTML = httpRequest.responseText;
					}
				}
				httpRequest.open("POST", "loadData.php?id="+albumId, true);
				//httpRequest.setRequestHeader("Content-length", params.length);
	 			httpRequest.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
	 			httpRequest.send(params);
 			}
 			fetchImageList(pageNumber);

 			var nextPage = function(){
 				if(pageNumber < maxPage-1) pageNumber++;
 				fetchImageList(pageNumber);
 				updateButtons();
 			}

 			var prevPage = function(){
 				if(pageNumber > 0) pageNumber--;
 				fetchImageList(pageNumber);
 				updateButtons();
 			}

 			var gotoPage = function(page){
 				pageNumber = page;
 				fetchImageList(pageNumber);
 				updateButtons();
 			}

 			var updateButtons = function(){
 				if(pageNumber == 0) document.getElementById("backResults").disabled = true;
 				else document.getElementById("backResults").disabled = false;
 				if(pageNumber < maxPage-1) document.getElementById("moreResults").disabled = false;
 				else document.getElementById("moreResults").disabled = true;
 				var buttonContainer = document.getElementById("btnPages");
 				var buttonArray = buttonContainer.querySelectorAll(".btnP");
 				var i;
				for (i = 0; i < buttonArray.length; i++) {
					if(buttonArray[i].innerHTML == pageNumber) buttonArray[i].disabled = true;
					else buttonArray[i].disabled = false;
				}
 			}

 			updateButtons();



		</script>
		
		<script src="js/login.js"></script>
	</body>	
</html>


