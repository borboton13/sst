//Desarrollado por Marcelo Chavez
function objetoAjax(){
	var xmlhttp=false;
	try {
		xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
	} catch (e) {
		try {
		   xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		} catch (E) {
			xmlhttp = false;
  		}
	}

	if (!xmlhttp && typeof XMLHttpRequest!='undefined') {
		xmlhttp = new XMLHttpRequest();
	}
	return xmlhttp;
}

function mostrar_detalles_inv(dato){
	
	divResultado = document.getElementById('mostrar_detalles');
	divResultado.innerHTML='<img src="../../img/mozilla_blu.gif"> Cargando, por favor espere...';
	ajax=objetoAjax();
	//ajax.open("GET", datos);
	ajax.open("GET", "../../modulos/pedidos_alm/detalles_inv.php?cod="+dato);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			divResultado.innerHTML = ajax.responseText
		}
	}
	ajax.send(null)
}