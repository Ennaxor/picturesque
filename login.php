
<div class="wrapperP wrapper printOut">
    <div class="login loginP">
        <form name="loginForm" autocomplete="on" onSubmit="return checkform(this)"> 
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
            
            <p class="registerButton">Don't have an account? Register <a href="register.php" class="registerLink"><b>HERE</b></a></p>                  

            <p class="login button"> 
                <input id="loginButton" type="submit" value="Login" /> 
			</p>
        </form>
	</div>
</div>
