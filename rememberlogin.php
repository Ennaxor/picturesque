<div class="wrapperP wrapper printOut">
    <div class="login loginP">
        <span class="titleh1">Hello <?php echo $_COOKIE['authenticated'] ?> !</span>
		<a class="btn btn-login" id="closePopUp"> <i class="fa fa-times"></i></a>
      
        <p class="textVisit">Your last visit was on the <?php echo $_COOKIE['date'] ?> at <?php echo $_COOKIE['time'] ?>
            </p>
            <?php
                $cookie_date_name = 'date';
                $cookie_time_name = 'time';
                $cookie_date_value = date('d/m/Y', time());
                $cookie_time_value = date('H:i:s', time());
                setcookie($cookie_date_name,$cookie_date_value,time()+(86400*30),'/');
                setcookie($cookie_time_name,$cookie_time_value,time()+(86400*30),'/');
            ?>
        
        <a class="btn btn-login btn-continue userDetails" href="index.php?signin">Continue</a>
        <a class="btn btn-login btn-signoutC userDetails" href="index.php?signout">Sign out</a>
		       
	</div>
</div>