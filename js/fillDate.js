function fillDate(){	
	var days = [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31];
	var months =["January","February","March","April","May","June","July","August","September","October","November","December"];
	var years = Array.apply(null,Array(115));
	
	for (var i=0;i<115;i++){
		years[i]=1900+i;
	}
	
	var dayf=document.getElementById("dayfrom");
	var dayt=document.getElementById("dayto");
	
	for(var i = 0; i < days.length; i++) {
		var opt = document.createElement('option');
		opt.innerHTML = days[i];
		opt.value = days[i];
		dayf.appendChild(opt);
	}
	
	for(var i = 0; i < days.length; i++) {
		var opt = document.createElement('option');
		opt.innerHTML = days[i];
		opt.value = days[i];
		dayt.appendChild(opt);
	}
	
	
	var monthf=document.getElementById("monthfrom");
	var montht=document.getElementById("monthto");
	
	for(var i = 0; i < months.length; i++) {
		var opt = document.createElement('option');
		opt.innerHTML = months[i];
		opt.value = months[i];
		monthf.appendChild(opt);
	}
	
	for(var i = 0; i < months.length; i++) {
		var opt = document.createElement('option');
		opt.innerHTML = months[i];
		opt.value = months[i];
		montht.appendChild(opt);
	}
	
	var yearf=document.getElementById("yearfrom");
	var yeart=document.getElementById("yearto");
	
	for(var i = 0; i < years.length; i++) {
		var opt = document.createElement('option');
		opt.innerHTML = years[i];
		opt.value = years[i];
		yearf.appendChild(opt);
	}
	for(var i = 0; i < years.length; i++) {
		var opt = document.createElement('option');
		opt.innerHTML = years[i];
		opt.value = years[i];
		yeart.appendChild(opt);
	}
}


function fillAlbumDate(){	
	var days = [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31];
	var months =["January","February","March","April","May","June","July","August","September","October","November","December"];
	var years = Array.apply(null,Array(115));
	
	for (var i=0;i<115;i++){
		years[i]=1900+i;
	}
	
	var dayf=document.getElementById("dayfrom");
	
	for(var i = 0; i < days.length; i++) {
		var opt = document.createElement('option');
		opt.innerHTML = days[i];
		opt.value = days[i];
		dayf.appendChild(opt);
	}
	
	
	
	var monthf=document.getElementById("monthfrom");
	
	for(var i = 0; i < months.length; i++) {
		var opt = document.createElement('option');
		opt.innerHTML = months[i];
		opt.value = months[i];
		monthf.appendChild(opt);
	}
	
	
	var yearf=document.getElementById("yearfrom");
	
	for(var i = 0; i < years.length; i++) {
		var opt = document.createElement('option');
		opt.innerHTML = years[i];
		opt.value = years[i];
		yearf.appendChild(opt);
	}
}