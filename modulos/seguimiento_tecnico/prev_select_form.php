<?php

$idevento 		= $_GET["idevento"];

?>
<link href="../../css/general.css" rel="stylesheet" type="text/css">
<form name="form2" method="POST" enctype="multipart/form-data" action="<?=$link_modulo_r?>"  onSubmit=" return VerifyOne ();" onKeyPress="return disableEnterKey(event)";>
<input type="hidden" name="path" value="prev_select_form_r.php" />
<input name="idevento" id="idevento" type="hidden" value="<?=$idevento?>">

<table width="100%" align="center" class="table2">
<caption><? print($idevento); ?> Eliga el Formulario de Mantenimiento</caption>
<tr>
	<th>Formulario:</th>
	<td><select name="formulario" class="selectbuscar" id="formulario">
			<option value="0" selected class="title7"> Seleccionar... </option>
			<?php
			$resultado = mysql_query("SELECT idformulario, codigo, nombre, area FROM formulario");
			while($dato=mysql_fetch_array($resultado))
				echo '<option value="'.$dato['idformulario'].'-'.$dato['codigo'].'-'.$dato['nombre'].'">'.$dato['codigo'].' - '.$dato['nombre'].'</option>';
			?>
		</select>
	</td>
</tr>
<tr>
	<th></th>
	<td><input name="submit" type="submit" id="continuar" value="Continuar" /></td>
</tr>
<tfoot>
<tr>
	<td colspan="2">
		<span id="allowed" class="verde"> ... </span>
		<br />
		<span class="naranja">...</span>
	</td>
</tr>
</tfoot>

</table></form>
<SCRIPT src="../../js/validador.js" type=text/javascript></SCRIPT>
<SCRIPT type=text/javascript>
function disableEnterKey(e){
var key; 
if(window.event){
key = window.event.keyCode; //IE
}else{
key = e.which; //firefox 
}
if(key==13){
return false;
}else{
return true;
}
}
function renameSync() {
  	var fn = document.getElementById("file").value;
  	if (fn == ""){
  		document.getElementById("filename").value = '';
  	} else {
  		var b = fn.match(/[\/|\\]([^\\\/]+)$/);
  		document.getElementById("filename").value = b[1];
  	}
  	filetypeCheck();
  }
function filetypeCheck() {
  	var allowedtypes = '.<? echo join(".",$allowed_fileext); ?>.';

  	var fn = document.getElementById("filename").value;
  	if (fn == ""){
  		document.getElementById("allowed").className ='';
  		document.getElementById("upload").disabled = true;
  	} else {
  		var ext = fn.split(".");
  		if (ext.length==1)
  		ext = '.noext.';
  		else
  		ext = '.' + ext[ext.length-1].toLowerCase() + '.';

  		if (allowedtypes.indexOf(ext) == -1) {
  			document.getElementById("allowed").className ='title7';
  			document.getElementById("upload").disabled = true;
			
  		} else {
  			document.getElementById("allowed").className ='verde';
  			document.getElementById("upload").disabled = false;			
  		}
  	}
  }
function validar2(frm)
{
	document.getElementById("upload").value = "Enviando...";
	document.forms[frm].submit();
}

function VerifyOne () {

   if(
   checkField( document.form2.filename, isAlphanumeric, false ) && 
   isNull( document.form2.titulo))	{					
	return true;				
	}
	else {	
	return false;
    }
}

</SCRIPT>
