
function checkform(myform){
	if(myform.elements["username"].value == ""){
		document.getElementById("usernameError").innerHTML = "Please provide your username*";
		return false;
	}
	else if(myform.elements["password"].value == ""){
		document.getElementById("passError").innerHTML = "Please provide your password*";		
		return false;
	}
	return true;

}

function nospaces(object){
	if(object.value.match(/\s/g)){	
		document.getElementById("spaceError").innerHTML = "No spaces allowed*";
		object.value= "";
	}
    
}

function reseting(){
	document.getElementById("usernameError").innerHTML = "";
	document.getElementById("passError").innerHTML = "";
	document.getElementById("spaceError").innerHTML = "";
}