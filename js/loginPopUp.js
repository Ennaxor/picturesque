function showLogin(){
	var div=document.getElementById("popUpLogin")
	div.style.visibility="visible";
	div.innerHTML='<object width="400" height="400" data="login.html" type="text/html">';
}

function closePopUpLogin(){
	window.open("register.html","_parent");
}

