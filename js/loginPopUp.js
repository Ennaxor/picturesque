function showLogin(){
	var div=document.getElementById("popUpLogin");
	var plantilla=document.getElementById("overlay-back");
	var close=document.getElementById("closePopUp");

	div.className = "visible";
	plantilla.style.visibility = "visible";


	plantilla.onclick = function()
	{
		div.className = "";
		plantilla.style.visibility = "hidden";
	}

	close.onclick = function(){
		div.className = "";
		plantilla.style.visibility = "hidden";
	}
}

function goBack(object){

	document.location.href = "register.php";

}


/* FADE IN STUFF */

