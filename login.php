<?php
    if(isset($_POST["username"]) && isset($_POST["password"])){
        $u = $_POST["username"];
        $p = $_POST["password"];       

        if(($u =="Pepe" && $p =="123") || ($u =="Pepa" && $p =="123")){
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

<?php 
    if(isset($_GET['login'])) { ?> 
            <script>
           showLogin();</script>

<?php } ?>   

<div class="wrapperP wrapper printOut">
    <div class="login loginP">
        <form name="loginForm" autocomplete="on" onSubmit="return checkform(this)" action="index.php" method="post"> 
            <span class="titleh1">Enter your profile!</span>
			<a class="btn btn-login" id="closePopUp"> <i class="fa fa-times"></i></a>
            <div class="usernameContainer"> 
                <p> 
                    <input class="input-normal username" type="text" id="username" name="username" placeholder="Username..." onkeyup="nospaces(this)"
                    onkeydown="reseting()" />
                    <img src="Resources/Images/user-icon.png" alt="user icon" />
                    <span id="usernameError" style="font-size:9px; color:red;"></span>
                </p>
            </div>
			
            <div class="passContainer">
                <p> 
                   <input class="input-normal password" type="password" id="password" name="password" placeholder="Pasword..." 
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
            
            <p class="registerButton">Don't have an account? Register <a href="register.php" class="registerLink"><b>HERE</b></a></p>                  

            <p class="login button"> 
                <input id="loginButton" type="submit" value="Login" /> 
			</p>


        </form>

        
	</div>
</div>
