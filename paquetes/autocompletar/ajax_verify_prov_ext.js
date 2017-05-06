	/************************************************************************************************************
	Creado por Marcelo Chavez Duran
	************************************************************************************************************/	

function getXmlHttpRequestObject() {
	if (window.XMLHttpRequest) {
		return new XMLHttpRequest();
	} else if(window.ActiveXObject) {
		return new ActiveXObject("Microsoft.XMLHTTP");
	} else {
		alert("Amper: Error de datos!");
	}
}
var searchReq = getXmlHttpRequestObject();

function actualizar_datos_prov() {
	
	if (searchReq.readyState == 4 || searchReq.readyState == 0) {
		var str = document.amper.prov_ext.value;
		var url = '../../paquetes/autocompletar/datos_prov_ext.php?prov=' + str
		searchReq.open("GET",url, true);
		searchReq.onreadystatechange = function(){
			if (searchReq.readyState == 4) {
			error=searchReq.responseText;	
			if(error!=""){ 
			var datos=searchReq.responseText.split("|");
			document.getElementById('contacto_principal').value=datos[0];
			document.getElementById('direccion').value=datos[1]; 
			}
			else { 
			document.getElementById('contacto_principal').value="";
			document.getElementById('direccion').value=""; 
			}
			}
		} 
		searchReq.send(null);
	}		
}

function verify_item(url) {
	
	if (searchReq.readyState == 4 || searchReq.readyState == 0) {
		searchReq.open("GET",url, true);
		searchReq.onreadystatechange = function(){
			if (searchReq.readyState == 4) {
			error=searchReq.responseText;	
			if(error==""){ 
			alert("No existe el Proveedor");
			document.getElementById('id_prov_ext').value=""; 
			document.getElementById('prov_ext').focus(); 
			}
			else { 
			document.getElementById('id_prov_ext').value=searchReq.responseText; 
			}
			}
		} 
		searchReq.send(null);
	}		
}
