//Desarrollado por Marcelo Chavez
function getXmlHttpRequestObject() {
	if (window.XMLHttpRequest) {
		return new XMLHttpRequest();
	} else if(window.ActiveXObject) {
		return new ActiveXObject("Microsoft.XMLHTTP");
	} else {
		alert("Amper: Error de datos!");
	}
}

//Our XmlHttpRequest object to get the auto suggest
var ajax = getXmlHttpRequestObject();

function seleccionar_carta(carta,display,grupo){

	divResultado = document.getElementById(display);
	ajax.open("GET", "../../paquetes/nicEdit/ajax_display.php?carta_id="+carta+"&grupo="+grupo);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {			
			divResultado.innerHTML = ajax.responseText;
			
		}
	}
	ajax.send(null);
	
}
function seleccionar_carta_general(carta,display,grupo){

	divResultado = document.getElementById(display);
	ajax.open("GET", "../../paquetes/nicEdit/ajax_display_general.php?carta_id="+carta+"&grupo="+grupo);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {			
			divResultado.innerHTML = ajax.responseText;
			
		}
	}
	ajax.send(null);
	
}

