var idPhoto;

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

function showDeleteAccount(){
	var div=document.getElementById("popUpDeleteAccount");
	var plantilla=document.getElementById("overlay-back");
	var close=document.getElementById("closePopUpDA");

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

function showDeletePhoto(id){
idPhoto=id;
	var div=document.getElementById("popUpDeletePhoto");
	var plantilla=document.getElementById("overlay-back");
	var close=document.getElementById("closePopUpDA");

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

function closeDeleceAccountPopUp(){
	var div=document.getElementById("popUpDeleteAccount");
	var plantilla=document.getElementById("overlay-back");
	var close=document.getElementById("NoDelete");
	close.onclick = function(){
		div.className = "";
		plantilla.style.visibility = "hidden";
	}
}

function closeDelecePhotoPopUp(){
	var div=document.getElementById("popUpDeletePhoto");
	var plantilla=document.getElementById("overlay-back");
	var close=document.getElementById("NoDelete");
	close.onclick = function(){
		div.className = "";
		plantilla.style.visibility = "hidden";
	}
}

function goBack(object){

	document.location.href = "register.php";

}

function goRegister(){

	document.location.href = "register.php";

}

function closePopUpAlbum(){
	document.location.href = "index.php";

}

function deleteUser(){
	document.location.href = "deleteaccount.php";
}
function deletePhoto(){
	document.location.href = "deletephoto.php?id="+idPhoto;
}

function modifyProfile(){
	document.location.href = "modifydata.php?er=0";
}
/* FADE IN STUFF */

