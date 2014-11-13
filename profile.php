<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8" />
		<title>Home Page - Picturesque</title>
		<link rel="stylesheet" href="css/font-awesome/css/font-awesome.min.css" type="text/css" title="Estilo Principal"/>
		<link href="css/style.css" rel="stylesheet" type="text/css" media="all" title="Estilo Principal" />
		<link href="css/accesible.css" rel="alternate stylesheet" type="text/css" title="Estilo Accesible"  />
		<link href="css/print.css" rel="stylesheet" type="text/css" media="print" />
		<script src="js/style.js"></script>		
		<script>cargarPagina();</script>
	</head>

	<body>		
		
		<header>				
			<a href="index.php"> 
				<img class="logoBox" src="Resources/Images/logo.png" alt="Logo"/> 
			</a>	
			
			<?php
  				include 'logged.html';      			
			?>					
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
				<span class="usernameUser">Pepita Lolita</span>
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


