function checkform(myform){
	var username = myform.elements["username"];
		booluser = checkUserName(username);
	var password = myform.elements["password"];
		boolpass = checkPassword(password);
	var repeatPassword = myform.elements["password2"];
		boolpass2 = checkRepeatPassword(repeatPassword,password);
	var email = myform.elements["email"];
		boolmail = checkEmail(email);
	var gender = myform.elements["genderType"];
		checkGender(gender);
		
	var day = myform.elements["day"];
	var month = myform.elements["month"];
	var year = myform.elements["year"];
		booldate = checkDate(day,month,year);
	if(booluser == true && boolpass == true && boolpass2 == true && boolmail == true && booldate == true){
		return true;	
	}
	else{
		return false;
	}
}


function fillDate(){	
	var days = [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31];
	var months =["January","February","March","April","May","June","July","August","September","October","November","December"];
	var years = Array.apply(null,Array(115));
	
	for (var i=0;i<115;i++){
		years[i]=1900+i;
	}
	
	var day=document.getElementById("day");
	
	for(var i = 0; i < days.length; i++) {
		var opt = document.createElement('option');
		opt.innerHTML = days[i];
		opt.value = days[i];
		day.appendChild(opt);
	}
	var month=document.getElementById("month");
	
	for(var i = 0; i < months.length; i++) {
		var opt = document.createElement('option');
		opt.innerHTML = months[i];
		opt.value = months[i];
		month.appendChild(opt);
	}
	
	var year=document.getElementById("year");
	
	for(var i = 0; i < years.length; i++) {
		var opt = document.createElement('option');
		opt.innerHTML = years[i];
		opt.value = years[i];
		year.appendChild(opt);
	}
}

function checkUserName(username){
	var alphabet= /^[a-zA-Z]+$/;
	var numbers=/^[0-9]+$/;
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
	return true;
}

function checkPassword(password){
	var alphabetminus= /^[a-z]+$/;
	var contalphmin=0
	var alphabetmaxi= /^[A-Z]+$/;
	var contalphmax=0;
	var numbers=/^[0-9]+$/;
	var contnumbers=0;
	
	if(password.value == ""){
		document.getElementById("passwordRegisterError").innerHTML = "Please provide your password*";
		return false;
	}
	else if (password.value.length < 6 || password.value.length > 15){
		document.getElementById("passwordRegisterError").innerHTML = "Password has to be between 6 and 15 characters*";
		return false;
	}
	
	else {
		for(var i=0; i<password.value.length; i++){
			var char1 = password.value.charAt(i);
			if(char1.match(alphabetminus)){
				contalphmin++;
			}
			else if(char1.match(alphabetmaxi)){
				contalphmax++;
			}
			else if(char1.match(numbers)){
				contnumbers++;
			}
			else if(char1=='_'){
			
			}
			else {
				document.getElementById("passwordRegisterError").innerHTML = "Please use English alphabet*";
				return false;
			}
		}
		if(contalphmin>=1 && contalphmax>=1 && contnumbers>=1){
			
		}		
		else{
			document.getElementById("passwordRegisterError").innerHTML = "Password must contain at least One UpperCase letter, One LowerCase letter and One Number*";
			return false;
		}
	}
	return true;
}

function checkRepeatPassword(repeatPassword,password){
	if(repeatPassword.value == password.value){
		//LOS PASSWPRD SON IGUALES
	}
	else{
		document.getElementById("repeatPasswordRegisterError").innerHTML = "Password doesn't match*";
		document.getElementById("passwordRegisterError").innerHTML = "Password doesn't match*";
		return false;
	}
	
	return true;
}

function checkEmail(email){	
	if(email.value == ""){
		document.getElementById("emailRegisterError").innerHTML = "Please provide your email*";
        return false;
	}
    else{
        var splitA=email.value.split("@");
        if(splitA.length != 2){
            document.getElementById("emailRegisterError").innerHTML = "That doesn't look like an email..";
            return false;
        }
        else{
            var splitB=splitA[1].split(".");
            if(splitB.length < 2){
                document.getElementById("emailRegisterError").innerHTML = "That doesn't look like an email..";
                return false;
            }
            else{
                var domainLength = splitB[splitB.length-1].length;
                if(domainLength < 2 || domainLength > 4){
                    document.getElementById("emailRegisterError").innerHTML = "Email's main domain must be between 2 and 4 chars";
                    return false;
                }
                else{
                    //SUCCESS!!!
                    document.getElementById("emailRegisterError").innerHTML = "";
                    return true;
                }
            }
        }
    }
}

function checkGender(gender){
	
	if(gender.value == ""){
		document.getElementById("genderRegisterError").innerHTML = "Please provide your gender*";
		return false;
	}
}

function checkDate(day,month,year){

	var leapyears = Array.apply(null,Array(50));
	var firstyear=1900;
	for (var i=0;i<50;i++){
		firstyear+=4;
		leapyears[i]=firstyear;
	}
	
	for (var i=0;i<50;i++){
		if(year.value == leapyears[i] && day.value>28 && month.value == "February" ){
			document.getElementById("dateRegisterError").innerHTML = "February only has 28 days this year*";
			return false;
		}	
	}
	if(day.value>27 && month.value == "February"){
		document.getElementById("dateRegisterError").innerHTML = "February only has 27 days*";
				return false;
	}
	
	if(day.value>30){
		switch (month.value){
			case "April":
				document.getElementById("dateRegisterError").innerHTML = "This month only has 30 days*";
				return false;
				break;
			case "June":
				document.getElementById("dateRegisterError").innerHTML = "This month only has 30 days*";
				return false;
				break;
			case "September":
				document.getElementById("dateRegisterError").innerHTML = "This month only has 30 days*";
				return false;
				break;
			case "November":
				document.getElementById("dateRegisterError").innerHTML = "This month only has 30 days*";
				return false;
				break;
		}
	}
	return true;

}

function nospaces(object){
	if(object.value.match(/\s/g)  ){
		switch (object.name){
			case "username":
				document.getElementById("usernameRegisterError").innerHTML = "No spaces allowed*";
				break;
			case "password":
				document.getElementById("passwordRegisterError").innerHTML = "No spaces allowed*";
				break;
			case "password2":
				document.getElementById("repeatPasswordRegisterError").innerHTML = "No spaces allowed*";
				break;	
			case "email":
				document.getElementById("emailRegisterError").innerHTML = "No spaces allowed*";
				break;
		}
        object.value= "";
    }
}

function reseting(object){
	switch (object.name){
			case "username":
				document.getElementById("usernameRegisterError").innerHTML = "";
				break;
			case "password":
				document.getElementById("passwordRegisterError").innerHTML = "";
				break;
			case "password2":
				document.getElementById("repeatPasswordRegisterError").innerHTML = "";
				break;	
			case "email":
				document.getElementById("emailRegisterError").innerHTML = "";
				break;
			case "day":
				document.getElementById("dateRegisterError").innerHTML = "";
				break;
			case "month":
				document.getElementById("dateRegisterError").innerHTML = "";
				break;
			case "year":
				document.getElementById("dateRegisterError").innerHTML = "";
				break;
	}

	
}