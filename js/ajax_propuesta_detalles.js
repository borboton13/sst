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


function Enviar_datos_propuesta(){
	divResultado = document.getElementById('listar_items');
	divResultado1 = document.getElementById('estado');
	divResultado1.innerHTML='<img src="../../img/mozilla_blu.gif"><br>Cargando, por favor espere...';
	document.getElementById("adicionar_item").disabled = "disabled";
	tipo_item=document.amper.tipo_item.value;
	cantidad=document.amper.cantidad.value;
	id_item=document.amper.id_item.value;
	t_entrega=document.amper.t_entrega.value;
	if(t_entrega=='[Inserte el tiempo de entrega si es aplicable]') t_entrega='';
	pu=document.amper.pu.value;
	nro=document.amper.nro.value;
	
	
	ajax=objetoAjax();
	ajax.open("POST", "borrador_item_r.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			divResultado.innerHTML = ajax.responseText;
			divResultado1.innerHTML='';
			document.getElementById("adicionar_item").disabled = "";
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("nro="+nro+"&tipo_item="+tipo_item+"&cantidad="+cantidad+"&id_item="+encodeURIComponent(id_item)+"&t_entrega="+t_entrega+"&pu="+pu);	
}

function Eliminar_item(id_item,nro){
if(confirm("Esta seguro de eliminar este Item?"))
			{			
	var url="borrador_item_eliminar.php?id_item="+id_item+"&nro="+nro;		
	divResultado = document.getElementById('listar_items');
	divResultado1 = document.getElementById('items');
	divResultado1.innerHTML='<img src="../../img/gray_busy.gif">';
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