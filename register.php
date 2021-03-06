<?php session_start(); ?>

<!DOCTYPE html>
<html lang="es">
<?php 
	$webTitle = "Register - Picturesque";
	require_once 'head.php'; 
	if (isset($_SESSION['authenticated'])){
 			echo "
            	<script> document.location.href = 'index.php'; </script>
            ";
	}
	$NameValidation=FALSE;
	$PassValidation=FALSE;
	$DateValidation=FALSE;
	$GenderValidation=FALSE;
	$identificador = @mysqli_connect('localhost',$MYSQL_USER,$MYSQL_PASS,$MYSQL_DB);
    if(!$identificador){
        echo "<p>Error al conectar con la base de datos: ". mysqli_connect_errno();
        echo "</p>";
        exit;
    }
    $user = 0;

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
				<!--onSubmit="return checkform(this);"-->
                    <form autocomplete="on" action="register.php" method="post" enctype="multipart/form-data"> 
                        <span class="titleh1">Register as a new user</span> 
                        <div class="usuRegistro"> 
	                        <p>     
	                        	<label for="username">User name*: </label>                        
	                            <input type="text" name="username" id="username" value='<?php if(!empty($_POST["username"])){ echo "$_POST[username]";} ?>' onkeyup="nospaces(this)" onkeydown="reseting(this)"/> 
								<span id="usernameRegisterError">
								<?php 
									if(isset($_POST['Register']) && isset($_POST['username']) ){ 
										$sentencia= "select * from usuarios where NomUsuario = '$_POST[username]'";
										if( !($resultado = @mysqli_query($identificador,$sentencia)) ){
											echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: ". mysqli_error($identificador);
											echo "</p>";
											exit;
										}
										$user=mysqli_fetch_assoc($resultado);
										$count = mysqli_num_rows($resultado);	
										if($count > 0){
											echo "This username is already taken*";
										}
										else{	
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
	                                    }
                                    }
								?>
								</span>								
	                        </p>                        
	                        <p>          
	                        	<label for="password">Password**: </label>                                              
	                            <input type="password" name="password"  id="password" value='<?php if(!empty($_POST["password"])){ echo "$_POST[password]";} ?>' onkeyup="nospaces(this)" onkeydown="reseting(this)"/>
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
	                            <input type="password" name="password2"  id="password2" value='<?php if(!empty($_POST["password2"])){ echo "$_POST[password2]";} ?>' onkeyup="nospaces(this)" onkeydown="reseting(this)"/>
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
	                            <input type="text" name="email"  id="email" value='<?php if(!empty($_POST["email"])){ echo "$_POST[email]";} ?>' onkeyup="nospaces(this)" onkeydown="reseting(this)"/>
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
								
	                        	<input id="man" type="radio" name="genderType" value="1" <?php if(!empty($_POST['genderType'])){if( $_POST['genderType']=="Man" ){?> checked <?php }}?>>
	                        	<label for="man" class="radiolabel"> Man </label>
								<input id="woman" type="radio" name="genderType" value="2" <?php if(!empty($_POST['genderType'])){if( $_POST['genderType']=="Woman" ){?> checked <?php }}?>>  
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
										if($user["Sexo"] == 1 ){
											echo"<input type='hidden' name='genderType' value='1'>";
										}
										
										if($user["Sexo"] == 2 ){
											echo"<input type='hidden' name='genderType' value='2'>";
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
									require_once("includecountry.php");
								?>
	                        </p>  
	                        <p>          
	                        	<label for="picture">Picture (URL): </label>        
	                        	<input type="text" name="picture" id="picture"/> 
								<input type="file" name="picturefile" id="picturefile"/>
	                        </p>    
	                        <p><span class="obligated">*Obligatory fields</span></p>  
	                        <p><span class="obligated">**Password must contain at least One UpperCase letter, One LowerCase letter and One Number</span></p>                 
                        </div> 

						<p id="logYet">Already have an account? Login <span class="fake-link" onClick="showLogin()"><b>HERE</b></span></p>                  
                        <p class="login button printOut buttonR"> 
                            <input id="RegNow" type="submit" name="Register" value="Register now!"/> 
						</p>

						<!-- PRINT BUTTON -->
						<button class="printIn">Register now!</button>
                    </form>
        		</div>
        	</div>
		</section>
		
		<?php
			//Validacion
			if(isset($_POST['Register'])){
			$nombreFoto;
			
			if(empty($_POST["picture"])){
				if($_FILES["picturefile"]["error"]){
					echo "No hay Foto, error: ".$_FILES["picturefile"]["error"];
				}
				else{
					if($_FILES["picturefile"]["type"]=="image/jpg" || $_FILES["picturefile"]["type"]=="image/jpeg" || $_FILES["picturefile"]["type"]=="image/png"){
						$nombreFoto=$_POST["username"].$_FILES["picturefile"]["name"];
						echo " $nombreFoto ";
						if(@move_uploaded_file($_FILES["picturefile"]["tmp_name"], "Resources/Avatar/".$nombreFoto)){
							//echo "La foto se ha movido efectivamente";
						}
						else{
							echo "Error al mover la foto a la direccion especificada";
						}
					}
				}
			}
			else{
				$nombreFoto=$_POST["picture"];
			}
						
					
				if($NameValidation==true && $PassValidation==true && $GenderValidation==true && $DateValidation==true){
					$identificador = @mysqli_connect('localhost',$MYSQL_USER,$MYSQL_PASS,$MYSQL_DB);
				    if(!$identificador){
				        echo "<p>Error al conectar con la base de datos: ". mysqli_connect_errno();
				        echo "</p>";
				        exit;
				    }
					$md5Pass = md5($_POST['password']);
					$date = $_POST['year'].'-'.$str.'-'.$_POST['day'];
					$insercionUsuario= "insert into usuarios (NomUsuario, Clave, Email, Sexo, FNacimiento, Ciudad, Pais, Foto, FRegistro)
										VALUES ('$_POST[username]', '$md5Pass', '$_POST[email]', '$_POST[genderType]', '$date',
												'$_POST[city]', '$_POST[country]'";
					//Anyadir la imagen  ", '$_POST[picture]'";
					
					if(empty($_POST["picture"]) && $nombreFoto!="" ){
						$insercionUsuario.=", 'http://mi-tele.com/picturesque/Resources/Avatar/$nombreFoto'";
					}
					else{
						$insercionUsuario.=", '$nombreFoto'";
					}
					
					//anyadir la fecha 
					$insercionUsuario.=", NOW())";	
					if( !($resultado = @mysqli_query($identificador,$insercionUsuario)) ){
			            echo "<p>Error al ejecutar la sentencia <b>$insercionUsuario</b>: ". mysqli_error($identificador);
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
		?>
		
		
		
		<span class="rights printIn">Made for an awesome subject in the University of Alicante. All Copyright reserved to Alberto Martínez Martínez and Roxanne López van Dooren</span>
		<?php
			require_once("footer.php");
		?>
		<script src="js/register.js"></script>
		
	</body>
	</html>