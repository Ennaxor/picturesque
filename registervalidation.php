<?php

	$NameValidation=false;
	echo "Username: " ;	
	print_r($_POST["username"]);
	echo "<br>";
	echo "Email: " ;	
	print_r($_POST["email"]);
	echo "<br>";
				
	echo "Birth date: " ;	
	print_r($_POST["day"]);
	echo "/";
	print_r($_POST["month"]);
	echo "/";
	print_r($_POST["year"]);
	echo "<br>";
		
	echo "Gender: " ;	
	print_r($_POST["genderType"]);
	echo "<br>";

	if($_POST["city"] != null) {
		echo "City: " ;	
		print_r($_POST["city"]);
		echo "<br>";
	}
	if($_POST["country"] != null){
		echo "Country: " ;	
		print_r($_POST["country"]);
		echo "<br>";
	}

	$alphabet= "/^[a-zA-Z0-9]+$/";
	
	if(preg_match($alphabet,$_POST["username"],$res)){
		$len=strlen($res[0]);
		if($len<3 || $len>15){
			$NameValidation=false;
		}
		else{
			$NameValidation=true;
		}
	}
	
	if( $NameValidation==false){
		header("Location: register.php?name=1");
	}
	else{
		header("Location: registerresult.php");
	}
	
	/*var numbers=/^[0-9]+$/;
	
	if(username.value == ""){
		document.getElementById("usernameRegisterError").innerHTML = "Please provide your username*";
		return false;
	}
	else if (username.value.length < 3 || username.value.length > 15){
		document.getElementById("usernameRegisterError").innerHTML = "Username has to be between 3 and 15 characters*";
		return false;
	}
	else {
		for(var i=0; i<username.value.length; i++){
			var char1 = username.value.charAt(i);			
			if(char1.match(alphabet) || char1.match(numbers)){

			}

			else {
				document.getElementById("usernameRegisterError").innerHTML = "Please use English alphabet*";
			 	return false;
			}
		}
	}
	return true;*/
	

?>