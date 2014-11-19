<!DOCTYPE html>
<html lang="es">
	<?php 
		$webTitle = "Create your album- Picturesque";
		require_once 'head.php'; 
	?>

	<body onLoad="fillAlbumDate()">
		<div id="popUpLogin">
			<?php
      			include 'login.php';      			
    		?>
		</div>
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
			<button id="loginPopUp" onClick="showLogin();"><i class="fa fa-sign-in"></i> Sign in! </button>
			<div class="padding headerContent">				
				<h1>Create your own album...</h1>				
			</div>						
		</header>

		<section>
			<div class="boxPics"> <a class="back" href="profile.php"><h2><i class="fa fa-arrow-left"></i>  Go back</h2></a></div>
			<div class="wrapper ASWrapper">
                <div class="login WSadvanced">				
					<form autocomplete="on" method="get" id="albumform" onsubmit="showAlbum();return false" > 
						<div class="wrapperSearch">
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
									<input type="text" name="country" id="country" placeholder="E.G: Ireland"/>                         
								</p>   

								<p class="button printOut"><input class="searchR" type="submit" value="Create!"/> </p>
								<button class="printIn">Create!</button>
													 
							</div> 
						</div>                      
					</form>
					</div>
                 
        		</div>
        	</div>
	
		</section>
		<span class="rights printIn">Made for an awesome subject in the University of Alicante. All Copyright reserved to Alberto Martínez Martínez and Roxanne López van Dooren</span>
		<?php
			require_once("footer.php");
		?>	
		
	</body>	
</html>