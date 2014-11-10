<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8" />
		<title>Register a new user - Picturesque</title>

		<link href="css/accesible.css" rel="alternate stylesheet" type="text/css" title="Estilo Accesible"/>
		<link rel="stylesheet" href="css/font-awesome/css/font-awesome.min.css" type="text/css" title="Estilo Principal"/>

		<link href="css/style.css" rel="stylesheet" type="text/css" media="all" title="Estilo Principal" />
		<link href="css/print.css" rel="stylesheet" type="text/css" media="print" title="Estilo Para Impresión"/>		
		<script src="js/style.js"></script>
		<script src="js/loginPopUp.js"></script>
	</head>
	<body onload="fillDate(); cargarPagina()">

		<div id="popUpLogin">
			<?php
      			include 'login.html';      			
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
					<h1>DISCOVER &amp; SHARE</h1>				
			</div>						
		</header>
		<section>
			<div class="wrapper loginR">
                <div class="login aux">
                    <form autocomplete="on" onSubmit="return checkform(this);" action="successregister.php" method="GET"> 
                        <span class="titleh1">Register as a new user</span> 
                        <div class="usuRegistro"> 
	                        <p>     
	                        	<label for="username">User name*: </label>                        
	                            <input type="text" name="username"  id="username" onkeyup="nospaces(this)" onkeydown="reseting(this)"/>  
								<span id="usernameRegisterError"></span>								
	                        </p>                        
	                        <p>          
	                        	<label for="password">Password**: </label>                                              
	                            <input type="password" name="password"  id="password" onkeyup="nospaces(this)" onkeydown="reseting(this)"/>
								<span id="passwordRegisterError"></span>
	                        </p>  
	                        <p>          
	                        	<label for="password2">Repeat Password*: </label>                                              
	                            <input type="password" name="password2"  id="password2" onkeyup="nospaces(this)" onkeydown="reseting(this)"/>
								<span id="repeatPasswordRegisterError"></span>
	                        </p>  	
	                        <p>          
	                        	<label for="email">Email*: </label>                                              
	                            <input type="text" name="email"  id="email" onkeyup="nospaces(this)" onkeydown="reseting(this)"/>
								<span id="emailRegisterError"></span>
	                        </p> 
	                        <p class="radio">          
	                        	<label>Gender*: </label>  
	                        	<input id="man" type="radio" name="genderType" value="Man">
	                        	<label for="man" class="radiolabel"> Man </label>
								<input id="woman" type="radio" name="genderType" value="Woman">  
								<label for="woman" class="radiolabel">Woman </label>
								<span id="genderRegisterError"></span>
	                        </p>  

	                        <p>          
	                        	<label>Date of birth*: </label>
								<select id="day" name="day" onchange="reseting(this)">
								</select>
								<select id="month" name="month" onchange="reseting(this)">
								</select>
								<select id="year" name="year" onchange="reseting(this)">
								</select>
								<span id="dateRegisterError"></span>
	                        </p>    
	                         <p>          
	                        	<label for="city">City: </label>                                              
	                            <input type="text" name="city" id="city"/>
	                        </p>    
	                        <p>          
	                        	<label for="country">Country: </label>                                              
	                            <input type="text" name="country" id="country"/>
	                        </p>  
	                        <p>          
	                        	<label for="picture">Picture: </label>                                              
	                            <input type="file" name="picture" id="picture"/>
	                        </p>    
	                        <p><span class="obligated">*Obligatory fields</span></p>  
	                        <p><span class="obligated">**Password must contain at least One UpperCase letter, One LowerCase letter and One Number</span></p>                 
                        </div> 

						<p id="logYet">Already have an account? Login <span class="fake-link" onClick="showLogin()"><b>HERE</b></span></p>                  
                        <p class="login button printOut buttonR"> 
                            <input id="RegNow" type="submit" value="Register now!"/> 
						</p>

						<!-- PRINT BUTTON -->
						<button class="printIn">Register now!</button>
                    </form>
        		</div>
        	</div>
		</section>
		<span class="rights printIn">Made for an awesome subject in the University of Alicante. All Copyright reserved to Alberto Martínez Martínez and Roxanne López van Dooren</span>
		<?php
			require_once("footer.php");
		?>
		<script src="js/register.js"></script>
		
	</body>
	</html>