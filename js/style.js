function changeStyle(name){
	
	var nombre= "Estilo ";
	nombre=nombre+name;
	var arrayLink = document.getElementsByTagName("link");
	for (var i=0; i< arrayLink.length;i++){
		if(arrayLink[i].getAttribute('rel')!=null && arrayLink[i].getAttribute('rel').indexOf('stylesheet') != -1 && arrayLink[i].getAttribute('media')!= 'print') {
			var nombre2= arrayLink[i].title+"A";
			if(arrayLink[i].title.toLowerCase() == nombre.toLowerCase() || nombre2.toLowerCase() == nombre.toLowerCase()){
				setCookie("style",name,365);
				arrayLink[i].disabled=false;
				
			}
			else{
				arrayLink[i].disabled=true;
			}
		}
		else{
			
		}
	}
}

function getStringFromObject(object){
	var name=object.id;	
	changeStyle(name);
}

function cargarPagina(){
	var aux= getCookie("style");
	
	if(aux!=""){
		//alert(aux);
		var object = document.getElementById(aux);
		
		
	}
	else{
		aux="principal";
	}
	
	changeStyle(aux);
}


function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = "expires="+d.toUTCString();
    document.cookie = cname + "=" + cvalue + "; " + expires;
}


function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for(var i=0; i<ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1);
        if (c.indexOf(name) != -1) return c.substring(name.length,c.length);
    }
    return "";
}