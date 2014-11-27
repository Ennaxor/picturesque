<?php    
    $identificador = @mysqli_connect('localhost','web','','pibd');
    $i=0;
    if(!$identificador){
        echo "<p>Error al conectar con la base de datos: ". mysqli_connect_errno();
        echo "</p>";
        exit;
    }   

    if(isset($_POST["usernameL"]) && isset($_POST["passwordL"])){
        $u = $_POST["usernameL"];
        $p = $_POST["passwordL"];  
        $sentencia = "select * from usuarios where NomUsuario = '$_POST[usernameL]' AND Clave = '$_POST[passwordL]'";
        if(!($resultado = @mysqli_query($identificador,$sentencia))){
            echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: ". mysqli_error($identificador);
            echo "</p>";
            exit;
        }
        $row = mysqli_fetch_array($resultado) ;
        if(!empty($row['NomUsuario']) AND !empty($row['Clave'])){
            if(isset($_POST["remember"]) && $_POST["remember"] == true){
                $cookie_name = 'authenticated';
				$cookie_date_name = 'date';
				$cookie_time_name = 'time';
                $cookie_value = $u;
				$cookie_date_value = date('d/m/Y', time());
				$cookie_time_value = date('H:i:s', time());
                setcookie($cookie_name, $cookie_value, time() + (86400 * 30), '/');
				setcookie($cookie_date_name,$cookie_date_value,time()+(86400*30),'/');
				setcookie($cookie_time_name,$cookie_time_value,time()+(86400*30),'/');
            }  

            $_SESSION["authenticated"] = $u;              

            $host = $_SERVER['HTTP_HOST'];
            $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
            $extra = 'profile.php';
            header("Location: http://$host$uri/$extra");
            exit;
        }
        else{
           $info = "Wrong parameters - No such user";
        }
        echo '<script>document.onreadystatechange = function(){ showLogin(); }</script>';
    }      
        
?>
  

<div class="wrapperP wrapper printOut">
    <div class="login loginP">
        <form name="loginForm" autocomplete="on" onSubmit="return checkform(this)" action="index.php" method="post"> 
            <span class="titleh1">Enter your profile!</span>
			<a class="btn btn-login" id="closePopUp"> <i class="fa fa-times"></i></a>
            <div class="usernameContainer"> 
                <p> 
                    <input class="input-normal username" type="text" id="username" name="usernameL" placeholder="Username..." onkeyup="nospaces(this)"
                    onkeydown="reseting()" />
                    <img src="Resources/Images/user-icon.png" alt="user icon" />
                    <span id="usernameError" style="font-size:9px; color:red;"></span>
                </p>
            </div>
			
            <div class="passContainer">
                <p> 
                   <input class="input-normal password" type="password" id="password" name="passwordL" placeholder="Pasword..." 
                   onkeyup="nospaces(this)" onkeydown="reseting()"/>
                   <img src="Resources/Images/pass-icon.png" alt="pass icon" /> 
                   <span id="passError" style="font-size:9px; color:red;"></span>
                </p>       
            </div> 
            <span id="infoerror">
                <?php 
                    if(isset($info)) echo $info;
                ?>
            </span>

            <div class="checkBox"><input  type="checkbox" name="remember" id="remember" value="Rememberme" > <label for="remember">Remember me</label></div>
            
            <p class="registerButton">Don't have an account? Register <a href="register.php" class="registerLink"><b>HERE</b></a></p>                  

            <p class="login button"> 
                <input id="loginButton" type="submit" value="Login" /> 
			</p>


        </form>

        
	</div>
</div>
