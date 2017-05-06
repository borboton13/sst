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

function option_select(identify,list_label,imput_txt){

	divResultado = document.getElementById(list_label);
	divResultado.innerHTML='<img src="../../img/loading_small.gif"> Cargando...';
	ajax=objetoAjax();
	ajax.open("GET", "../../paquetes/list_options/list.php?search="+identify+"&put="+imput_txt);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			
			divResultado.innerHTML = ajax.responseText; 
			
		}
	}
	ajax.send(null)

}