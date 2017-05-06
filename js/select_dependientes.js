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

function cargaContenido(id_grupo,list_label){

	document.getElementById("codigo").value = "";
	document.getElementById("codigo").disabled = true;
	document.getElementById("boton").disabled = true;
	
	divResultado = document.getElementById(list_label);
	ajax=objetoAjax();
	ajax.open("GET", "../../modulos/contabilidad/plandecuentas_insertar_subgrupo.php?id_grupo="+id_grupo);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			
			divResultado.innerHTML = ajax.responseText; 
			
		}
	}
	ajax.send(null)

}
function mostrar(valor){
document.getElementById("codigo").value = valor;
document.getElementById("codigo").disabled = false;
document.getElementById("boton").disabled = false;
}