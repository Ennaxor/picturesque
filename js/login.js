
function checkform(myform){
	if(myform.elements["username"].value == ""){
		document.getElementById("usernameError").innerHTML = "Provide a user*";
		return false;
	}
	else if(myform.elements["password"].value == ""){
		document.getElementById("passError").innerHTML = "Provide a pass*";		
		return false;
	}
	return true;

}


function nospaces(object){
	if(object.value.match(/\s/g)){
		switch (object.name){
			case "username":
				document.getElementById("usernameError").innerHTML = "No spaces allowed*";
				break;
			case "password":
				document.getElementById("passError").innerHTML = "No spaces allowed*";
				break;
		}
        object.value= "";
    }	
}

function reseting(){
	document.getElementById("usernameError").innerHTML = "";
	document.getElementById("passError").innerHTML = "";
	document.getElementById("spaceError").innerHTML = "";
}