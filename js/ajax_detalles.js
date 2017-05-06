//Desarrollado por Jesus Liñán
//ribosomatic.com
//Puedes hacer lo que quieras con el código
//pero visita la web cuando te acuerdes
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

function MostrarConsulta(id1,id2){
	
	divResultado = document.getElementById('detalles');
	divResultado.innerHTML='<img src="../../img/mozilla_blu.gif"> Cargando, por favor espere...';
	ajax=objetoAjax();
	//ajax.open("GET", datos);
	ajax.open("GET", "clientes_r.php?path=ficha_cliente.php&id1="+id1+"&id2="+id2);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			divResultado.innerHTML = ajax.responseText
		}
	}
	ajax.send(null)
}
function limpiar(etiqueta){
	divResultado = document.getElementById(etiqueta);
	divResultado.innerHTML = '';
}