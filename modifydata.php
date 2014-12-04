<!DOCTYPE html>
<html lang="es">
	<?php 
		require_once 'head.php'; 
		$webTitle = "Register - Picturesque";
		$NameValidation=FALSE;
		$PassValidation=FALSE;
		$DateValidation=FALSE;
		$GenderValidation=FALSE;
		$auxCountry=FALSE;
		echo"<input type='hidden' name='genderType'>";
	
		$identificador = @mysqli_connect('localhost','web','','pibd');
		$i=0;
		if(!$identificador){
			echo "<p>Error al conectar con la base de datos: ". mysqli_connect_errno();
			echo "</p>";
			exit;
		}				
		$sentencia= "select * from usuarios where idUsuario=$_SESSION[idUsu]";
		$sentencia2= "select NomUsuario from usuarios";
		$sentencia3= "select * from paises order by NombrePais asc";

		if(!($resultado3 = @mysqli_query($identificador,$sentencia3))){
			echo "<p>Error al ejecutar la sentencia <b>$sentencia3</b>: ". mysqli_error($identificador);
			echo "</p>";
			exit;
		}
		if(!($resultado = @mysqli_query($identificador,$sentencia))){
			echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: ". mysqli_error($identificador);
			echo "</p>";
			exit;
		}
		if(!($resultado2 = @mysqli_query($identificador,$sentencia2))){
			echo "<p>Error al ejecutar la sentencia <b>$sentencia2</b>: ". mysqli_error($identificador);
			echo "</p>";
			exit;
		}
		$user=mysqli_fetch_assoc($resultado);
	?>
	<body onload="fillDate();">

		<div id="popUpLogin">
			<?php
      			include 'login.php';      			
    		?>
		</div>
		<div id="overlay-back"></div>

		<header>				
			<a href="index.php"> 
				<img class="logoBox" src="Resources/Images/logo.png" alt="Logo"/> 
			</a>	
			<?php if (isset($_SESSION['authenticated'])) include 'logged.html';   ?>	

			<?php if (!isset($_SESSION['authenticated'])) 
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
			<div class="padding headerContent">				
					<h1>DISCOVER &amp; SHARE</h1>				
			</div>						
		</header>
		<section>
			<div class="wrapper loginR">
                <div class="login aux">
				<!--onSubmit="return checkform(this);"-->
                    <form autocomplete="on"  action="modifydata.php" method="post"> 
                        <span class="titleh1">Modify your user data</span> 
                        <div class="usuRegistro"> 
	                        <p>     
	                        	<label for="username">User name*: </label>                        
	                            <input type="text" name="username"  id="username" value='<?php if(!empty($_POST["username"])){ echo "$_POST[username]";} else{echo "$user[NomUsuario]";}?>' onkeyup="nospaces(this)" onkeydown="reseting(this)"/> 
								<span id="usernameRegisterError">
								<?php 
									if(isset($_POST['Register']) && isset($_POST['username']) ){				
										$alphabet= "/^[a-zA-Z0-9]+$/";
										$len= strlen($_POST["username"]);
										if(empty($_POST['username'])){
											echo "Please provide your username*";
										}
										else {
											if($len<3 || $len>15){
												echo "Username has to be between 3 and 15 characters*";
											}
											if(!preg_match_all($alphabet,$_POST["username"],$res)){
												echo "Please use English alphabet*";											
											}
											else{
												$NameValidation= TRUE;
											}
										}
										
										while($users=mysqli_fetch_assoc($resultado2)){
											if($users["NomUsuario"]==$_POST['username'] && $users["NomUsuario"]!=$user["NomUsuario"]){
												echo "The username is already taken*";
											}
										}
									}
								?>
								</span>								
	                        </p>                        
	                        <p>          
	                        	<label for="password">Password**: </label>                                              
	                            <input type="password" name="password"  id="password"  value='<?php if(!empty($_POST["password"])){ echo "$_POST[password]";} else{echo "$user[Clave]";}?>' onkeyup="nospaces(this)" onkeydown="reseting(this)"/>
								<span id="passwordRegisterError">
								<?php 
									if(isset($_POST['Register']) && isset($_POST['password']) ){				
										$alphabetm= "/^[a-z]+$/";
										$contm=0;
										$alphabetM= "/^[A-Z]+$/";
										$contM=0;
										$alphabetn= "/^[0-9]+$/";
										$contn=0;
										$expr= "/^[_]+$/";
										
										$controlador=false;
										
										$len= strlen($_POST["password"]);
										if(empty($_POST['password'])){
											echo "Please provide your password*";
										}
										else {
											if($len<6 || $len>15){
												echo "Password has to be between 6 and 15 characters*";
											}
											$i=0;
											for ($i=0 ; $i<$len ; $i++){
												if(preg_match($alphabetm,$_POST['password']{$i},$resp)){ $contm++; }
												else {
													if(preg_match($alphabetM,$_POST['password']{$i},$resp)){ $contM++;}
													else{
														if(preg_match($alphabetn,$_POST['password']{$i},$resp)){ $contn++;	}
														else{
															if(preg_match($expr,$_POST['password']{$i},$resp)){}
															else{
																echo "Please use English alphabet*";
																$controlador=true;
																break;
															}	
														}
													}
												}
											}
											if($controlador==false ){
												if($contm<1 || $contM<1 || $contn<1){
													echo "Password must contain at least One UpperCase letter, One LowerCase letter and One Number*";
												}
											}
										}
									}
									
									if( !empty($_POST['password']) && !empty($_POST['password2'])){
										if($_POST['password']!=$_POST['password2']){
											echo "Password doesn't match*";
										}
									}
								?>
								</span>
	                        </p>  
	                        <p>          
	                        	<label for="password2">Repeat Password*: </label>                                              
	                            <input type="password" name="password2"  id="password2" value='<?php if(!empty($_POST["password"])){ echo "$_POST[password]";} else{echo "$user[Clave]";}?>' onkeyup="nospaces(this)" onkeydown="reseting(this)"/>
								<span id="repeatPasswordRegisterError">
								<?php 
									if(isset($_POST['Register']) && !empty($_POST['password2']) ){				
										if( !empty($_POST['password']) && !empty($_POST['password2'])){
											if($_POST['password']!=$_POST['password2']){
												echo "Password doesn't match*";
											}
											else{
												$PassValidation=TRUE;
											}
										}
									}
									
								?>
								</span>
	                        </p>  	
	                        <p>          
	                        	<label for="email">Email*: </label>                                              
	                            <input type="text" name="email"  id="email" value='<?php if(!empty($_POST["email"])){ echo "$_POST[email]";} else{echo "$user[Email]";}?>' onkeyup="nospaces(this)" onkeydown="reseting(this)"/>
								<span id="emailRegisterError">
								<?php	
									if(isset($_POST['Register']) && isset($_POST['email']) ){				
										if(empty($_POST['email'])){
											echo "Please provide your email*";
										}
										else{
											$splitA= preg_split("/[@]/", $_POST['email'],-1, PREG_SPLIT_NO_EMPTY);
											if(count($splitA) != 2){
												echo "That doesn't look like an email..";
											}
											else{
												$splitB= preg_split("/[.]/",$splitA[1],-1, PREG_SPLIT_NO_EMPTY);
												if(count($splitB) < 2){
													echo "That doesn't look like an email..";
												}
												else{
													$splitbL=count($splitB)-1;
													$domainLength = strlen($splitB[$splitbL]);
													if($domainLength < 2 || $domainLength > 4){
														echo "Email's main domain must be between 2 and 4 chars";
													}
													else{
														echo "";
													}
												}
											}
										}
									}
								?>
								</span>
	                        </p> 
	                        <p class="radio">          
	                        	<label>Gender*: </label>  
								
	                        	<input id="man" type="radio" name="genderType" value="Man" <?php if(!empty($_POST['genderType'])){ if($_POST['genderType']=="Man"){?>checked<?php }}else{ $user["Sexo"] == 1?> checked <?php }?>>
	                        	<label for="man" class="radiolabel"> Man </label>
								<input id="woman" type="radio" name="genderType" value="Woman" <?php if(!empty($_POST['genderType'])) {if($_POST['genderType']=="Woman"){?>checked<?php }}else{ $user["Sexo"] == 2?> checked <?php }?>>
								<label for="woman" class="radiolabel">Woman </label>
								
								
								<span id="genderRegisterError">
								<?php
									if(isset($_POST['Register']) && isset($_POST['genderType']) ){				
										if( empty($_POST['genderType'])){
											echo "Please provide your gender*";
										}
										else {
											echo"";
											$GenderValidation=TRUE;
										}
									}
									else{
										if( $user["Sexo"] == 1 ){
											echo"<input type='hidden' name='genderType' value='Man'>";
										}
										
										if( $user["Sexo"] == 2 ){
											echo"<input type='hidden' name='genderType' value='Woman'>";
										}
									}
								
								?>
								
								</span>
	                        </p>  

	                        <p>          
	                        	<label>Date of birth*: </label>
								<select class="SelectStyle" id="day" name="day" onchange="reseting(this)">
								</select>
								<select class="SelectStyle" id="month" name="month" onchange="reseting(this)">
								</select>
								<select class="SelectStyle" id="year" name="year" onchange="reseting(this)">
								</select>
								<span id="dateRegisterError">
								<?php
									if(isset($_POST['Register']) && isset($_POST['day']) && isset($_POST['month']) && isset($_POST['year']) ){	
										$months =["January" => 1,"February" => 2,"March" => 3,"April" => 4,"May" => 5,"June" => 6,"July" => 7,"August" => 8,"September" => 9,"October" => 10,"November" => 11,"December" => 12];
										$str=$months[$_POST['month']];
										$foo=checkdate($str,$_POST["day"],$_POST["year"]);
										if($foo==TRUE){
											$DateValidation=TRUE;
										}
									}
								?>
								</span>
	                        </p>    
	                         <p>          
	                        	<label for="city">City: </label>                                              
	                            <input type="text" name="city" id="city"/>
	                        </p>    
	                        <p>          
	                        	<label for="country">Country: </label>                                              
								<?php
									echo "<select name='country' id='country'>";
									while ($fila = @mysqli_fetch_assoc($resultado3)){
										if($user["Pais"] == $fila["idPais"] && !isset($_POST['Register']) ){
											echo "<option value='$fila[idPais]' selected> $fila[NombrePais]</option>";
										}
										else{
											if(!empty($_POST["country"])){
												if($_POST['country'] == $fila["idPais"] ){
													echo "<option value='$fila[idPais]' selected> $fila[NombrePais]</option>";
												}
												else{
													echo "<option value='$fila[idPais]'> $fila[NombrePais] </option>";
												}
											}
											else{
												echo "<option value='$fila[idPais]'> $fila[NombrePais] </option>";
											}
										}
									}

									echo "</select>";
								?>
	                        </p>  
	                        <p>          
	                        	<label for="picture">Picture: </label>                                              
	                            <input type="text" name="picture" id="picture"/> 
	                        </p>    
	                        <p><span class="obligated">*Obligatory fields</span></p>  
	                        <p><span class="obligated">**Password must contain at least One UpperCase letter, One LowerCase letter and One Number</span></p>                 
                        </div> 
                
                        <p class="login button printOut buttonR"> 
                            <input id="RegNow" type="submit" name="Register" value="Modify!"/> 
						</p>

                    </form>
        		</div>
        	</div>
		</section>
		
		<?php
		
			//Validacion
			if(isset($_POST['Register'])){
				if($NameValidation==TRUE && $PassValidation==true && $GenderValidation==true && $DateValidation==true){
					$date = $_POST['year'].'-'.$str.'-'.$_POST['day'];
					$update="update usuarios set idUsuario=\"$_SESSION[idUsu]\"";
					if(!empty($_POST["username"]) &&  $_POST["username"]!=$user["NomUsuario"]){
						$update.=" ,NomUsuario=\"$_POST[username]\"";
					}
					if(!empty($_POST["password"]) &&  $_POST["password"]!=$user["Clave"]){
						$update.=" ,Clave=\"$_POST[password]\"";
					}
					if(!empty($_POST["email"]) &&  $_POST["email"]!=$user["Email"]){
						$update.=" ,NomUsuario=\"$_POST[email]\"";
					}
					if(!empty($_POST["genderType"])){
						if($_POST["genderType"]=="Man"){
							$update.=" ,Sexo=\"1\"";
						}
						else{
							$update.=" ,Sexo=\"2\"";
						}
					}
					if(!empty($_POST["day"]) && !empty($_POST["month"]) && !empty($_POST["year"]) &&  $date!=$user["FNacimiento"]){
						$update.=" ,FNacimiento=\"$date\"";
					}
					if(!empty($_POST["city"]) &&  $_POST["city"]!=$user["Ciudad"] ){
						$update.=" ,Ciudad=\"$_POST[city]\"";
					}
					if(!empty($_POST["country"]) &&  $_POST["country"]!=$user["Pais"] ){
						$update.=" ,Pais=\"$_POST[country]\"";
					}
					if(!empty($_POST["picture"]) &&  $_POST["picture"]!=$user["Fichero"] ){
						$update.=" ,Fichero=\"$_POST[picture]\"";
					}
					$update.=";";
					if( !($resultado4 = @mysqli_query($identificador,$update)) ){
			            echo "<p>Error al ejecutar la sentencia <b>$update</b>: ". mysqli_error($identificador);
			            echo "</p>";
			            exit;
			        }
					
					$_SESSION["registered_username"]= $_POST['username'];	
			        $_SESSION["registered_pass"]= substr($_POST['password'], 0,3).'***';
			        $_SESSION["registered_email"]= $_POST['email'];
			        $_SESSION["registered_gender"]= $_POST['genderType'];
			        $_SESSION["registered_date"]= $date;
			        $_SESSION["registered_city"]= $_POST['city'];
			        $_SESSION["registered_country"]= $_POST['country'];

					echo "<script>document.location.href = \"registerresult.php\";</script>";
				}
			}
		mysqli_free_result($resultado);
		mysqli_free_result($resultado2);
		mysqli_close($identificador);
		?>
		
		
		
		<span class="rights printIn">Made for an awesome subject in the University of Alicante. All Copyright reserved to Alberto Martínez Martínez and Roxanne López van Dooren</span>
		<?php
			require_once("footer.php");
		?>
		<script src="js/register.js"></script>
		
	</body>
	</html>