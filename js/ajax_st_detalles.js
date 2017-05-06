//Marcelo Chavez
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


function Enviar_datos_st(etiqueta){
	divResultado = document.getElementById(etiqueta);
    document.getElementById("adicionar").value = "Enviando...";
	document.getElementById("adicionar").disabled = "disabled";
	nro=document.amper.nro.value;
	producto=document.amper.producto.value;
	marca=document.amper.marca.value;
	caracteristicas=document.amper.caracteristicas.value;
	sn=document.amper.sn.value;
	departamento=document.amper.departamento.value;
	ubicacion=document.amper.ubicacion.value;
	
	ajax=objetoAjax();
	ajax.open("POST", "../../modulos/seguimiento_tecnico/trabajo_r.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			divResultado.innerHTML = ajax.responseText;
			document.getElementById("adicionar").value = "Adicionar";
			document.getElementById("adicionar").disabled = "";
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("nro="+nro+"&producto="+producto+"&marca="+marca+"&caracteristicas="+caracteristicas+"&sn="+sn+"&departamento="+departamento+"&ubicacion="+ubicacion);	
}

function Eliminar(etiqueta,id_item,nro,adm){
if(confirm("Esta seguro de eliminar este Item?"))
			{			
	var url="../../modulos/seguimiento_tecnico/trabajo_eliminar_item.php?id_item="+id_item+"&nro="+nro+"&adm="+adm;		
	divResultado = document.getElementById(etiqueta);
	divResultado.innerHTML='<img src="../../img/mozilla_blu.gif"> Cargando, por favor espere...';
	ajax=objetoAjax();
	ajax.open("GET", url,true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.send(null);
}
else {return false;}	
}

function Ver_detalles(etiqueta,id_cliente){
			
	var url="../../modulos/seguimiento_tecnico/veedor_cliente_contactos.php?id_cliente="+id_cliente;		
	divResultado = document.getElementById(etiqueta);
	divResultado.innerHTML='<img src="../../img/mozilla_blu.gif"> Cargando, por favor espere...';
	ajax=objetoAjax();
	ajax.open("GET", url,true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.send(null);
}

function Eliminar_cliente_contacto(etiqueta,id_st_personal_veedor,id_cliente){
if(confirm("Esta seguro de eliminar este Contacto?"))
			{			
	var url="../../modulos/seguimiento_tecnico/eliminar_cliente_contacto.php?id_st_personal_veedor="+id_st_personal_veedor+"&id_cliente="+id_cliente;		
	divResultado = document.getElementById(etiqueta);
	divResultado.innerHTML='<img src="../../img/mozilla_blu.gif"> Cargando, por favor espere...';
	ajax=objetoAjax();
	ajax.open("GET", url,true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.send(null);
}
else {return false;}	
}