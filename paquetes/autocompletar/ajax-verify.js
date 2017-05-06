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

function verify_item(url) {
	
	if (searchReq.readyState == 4 || searchReq.readyState == 0) {
		searchReq.open("GET",url, true);
		searchReq.onreadystatechange = function(){
			if (searchReq.readyState == 4) {
			error=searchReq.responseText;	
			if(error==""){ 
			alert("No existe el cliente");
			document.getElementById('id_cliente').value=""; 			
			}
			else { 
			document.getElementById('id_cliente').value=searchReq.responseText; 
			}
			}
		} 
		searchReq.send(null);
	}		
}
