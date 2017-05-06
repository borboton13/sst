<?php
$id_item = $_GET["id_item"];
$id_st_cronograma_informes = $_GET["id_st_cronograma_informes"];
$volver = $_GET["volver"];

$resultado=mysql_query("SELECT sub_grupo FROM parametrica WHERE grupo='tipo_archivo'");
while($dato=mysql_fetch_array($resultado))
 {
 $allowed_fileext[]=$dato[0];
 }
$resultado=mysql_query("SELECT sub_grupo FROM parametrica WHERE grupo='tamano_archivo'");
$dato=mysql_fetch_array($resultado);
$max="(max $dato[0][Kb])";
?>
<link href="../../css/general.css" rel="stylesheet" type="text/css">
<form name="form2" method="POST" enctype="multipart/form-data" action="<?=$link_modulo_r?>"  onSubmit=" return VerifyOne ();" onKeyPress="return disableEnterKey(event)";>
<input type="hidden" name="path" value="adjuntar_archivo_r.php" />
<input name="id_item" id="id_item" type="hidden" value="<?=$id_item?>">
<input name="id_st_cronograma_informes" id="id_st_cronograma_informes" type="hidden" value="<?=$id_st_cronograma_informes?>">
<input name="volver" id="volver" type="hidden" value="<?=$volver?>">

<table width="100%" align="center" class="table2">
<caption>Eliga el Archivo que desea adjuntar al Informe Tecnico</caption>
<tr><th>Archivo:</th><td><input name="file" type="file" class="title6" id="file" onchange="renameSync();" size="60" /> <?=$max?></td></tr>
<tr><th>Renombrar:</th><td><input name="filename" type="text" class="title6" id="filename" onkeyup="filetypeCheck();" size="60" />
<input name="submit" type="submit" disabled="disabled" id="upload" value="Adjuntar Archivo" onclick="validar2('form2');"/></td></tr>
<tr><th>Titulo:</th><td><input name="titulo" type="text" class="title6" id="titulo" size="80" autocomplete="off"/></td></tr>
<tfoot>
<tr>
<td colspan="2">
Tipos de archivos soportados :
<span id="allowed" class="verde"> <?=join(",",$allowed_fileext);?></span>
<br />
<BR />
<span class="naranja">- Renombre el archivo sin espacios, solo se premiten letras, n&uacute;meros y estos caracteres especiales: gui&oacute;n </span><span class="title">-</span><span class="naranja">, gui&oacute;n bajo </span><span class="title">_</span><span class="naranja"> y punto </span><span class="title">.</span><span class="naranja"> , no se olvide la extension del archivo ejm: archivo_001<strong>.pdf</strong>, otro_archivo-2<strong>.doc</strong>. <br />
</span></td>
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
