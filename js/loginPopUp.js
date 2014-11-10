function showLogin(){
	var div=document.getElementById("popUpLogin");
	var plantilla=document.getElementById("overlay-back");
	var close=document.getElementById("closePopUp");

	div.style.visibility = "visible";
	plantilla.style.visibility = "visible";


	plantilla.onclick = function()
	{
		div.style.visibility = "hidden";
		plantilla.style.visibility = "hidden";
	}

	close.onclick = function(){
		div.style.visibility = "hidden";
		plantilla.style.visibility = "hidden";
	}


}


/* FADE IN STUFF */

