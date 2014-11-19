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
				<img id="photoUser" src="Resources/Images/add_user.png" alt="User avatar"/>
				<span class="usernameUser">
					<?php echo $_SESSION['authenticated'] ?>
				</span>
				<p class="genderUser">Female</p>
				<p class="emailUser">roxanne@hotmail.com</p>
				<p class="dateUser">29/04/1994</p>
				<p class="cityUser">Alicante</p>
			</div>
			<br>
			<h2 class="titleProfiles">My Albums <i class="fa fa-picture-o"></i>
			<button class="btn btn-login btnNew">
			 <i class="fa fa-plus"></i><a href="crearalbum.php"> New Album</a></button>
			</h2>
			<ul>
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
			</ul>

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


