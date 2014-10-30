//GLOBAL VAR
var orderType = 0; //0 ASC, 1 DESC
var sortField = "";

var datePattern = /(\d{2})\/(\d{2})\/(\d{4})/;


function orderby(object){
	if(sortField !== object.id){
		orderType = 0;
		sortField = object.id;
	}
	else{
		orderType = (orderType+1) % 2;
	}

	var disordered = document.getElementById("searchResults").children;
	var disorderedArr = [];
	for(var i = 0; i < disordered.length; i++){
		if(disordered[i]){
			disorderedArr.push(disordered[i]);			
		} 
	}

	var ordered = disorderedArr.sort(function(a, b){ 
		var dataA = 0;
		var dataB = 0;
		switch(object.id){
			case "orderTitle":				
			  	dataA = a.querySelector(".titleImage").innerHTML.toLowerCase();
				dataB = b.querySelector(".titleImage").innerHTML.toLowerCase();
				break;
			case "orderDate":
			  	var dataA_temp = a.querySelector(".dateField").innerHTML;
				var dataB_temp = b.querySelector(".dateField").innerHTML;
				dataA = new Date(dataA_temp.replace(datePattern, '$3-$2-$1'));
				dataB = new Date(dataB_temp.replace(datePattern, '$3-$2-$1'));
				break;
			case "orderCountry":
			  	var dataA = a.querySelector(".countryField").innerHTML.toLowerCase();
				var dataB = b.querySelector(".countryField").innerHTML.toLowerCase();
				break;

		}
		if(orderType == 0){
			if(dataA < dataB) return -1;
			else if(dataA > dataB) return 1;
			else return 0;
		}
		else{
			if(dataA < dataB) return 1;
			else if(dataA > dataB) return -1;
			else return 0;
		}

	});
	document.getElementById("searchResults").innerHTML = "";
	for(var i=0; i<ordered.length; i++){
		document.getElementById("searchResults").innerHTML += ordered[i].outerHTML;
	}
	showCaret(object);
}

var showCaret = function(object){
	switch(object.id){
		case "orderTitle":
			document.getElementById("orderCountry").innerHTML = "Country ~"
			document.getElementById("orderDate").innerHTML = "Date ~"

		  	if(orderType == 0) object.innerHTML = "Title ▲";
		  	else  object.innerHTML = "Title ▼";
			break;
		case "orderDate":
			document.getElementById("orderCountry").innerHTML = "Country ~"
			document.getElementById("orderTitle").innerHTML = "Title ~"

		  	if(orderType == 0) object.innerHTML = "Date ▲";
		  	else  object.innerHTML = "Date ▼";
			break;
		case "orderCountry":
			document.getElementById("orderTitle").innerHTML = "Title ~"
			document.getElementById("orderDate").innerHTML = "Date ~"

		  	if(orderType == 0) object.innerHTML = "Country ▲";
		  	else  object.innerHTML = "Country ▼";
			break;
	}
}