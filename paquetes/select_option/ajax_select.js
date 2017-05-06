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

function option_select(identify,list_label_in,imput_txt_in){

	divResultado = document.getElementById(list_label_in);
	ajax.open("GET", "../../paquetes/select_option/list.php?search="+identify);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			str = ajax.responseText.split("\n");
			divResultado.innerHTML='';
		for(i=0; i < str.length - 1; i++) {
			var suggest = '<div onmouseover="javascript:selectOver(this);" ';
			suggest += 'onmouseout="javascript:selectOut(this);" ';
			suggest += 'onclick="javascript:setSearch(this.innerHTML,\''+list_label_in+'\',\''+imput_txt_in+'\');" ';
			suggest += 'class="select_link">' + str[i] + '</div>';
			divResultado.innerHTML += suggest;
			}
		    divResultado.innerHTML += '<div class="select_link" align="right"><a class="a_select" onclick="javascript:ocultar(\''+list_label_in+'\');">[x]Cerrar</a></div>';
		}
	}
	ajax.send(null)

}
function selectOver(div_value) {
	div_value.className = 'select_link_over';
}
//Mouse out function
function selectOut(div_value) {
	div_value.className = 'select_link';
}
function setSearch(value,list_label,imput_txt) {
	document.getElementById(imput_txt).value = value;
	document.getElementById(list_label).innerHTML = '';
}
function ocultar(value) {
	document.getElementById(value).innerHTML = '';
}
