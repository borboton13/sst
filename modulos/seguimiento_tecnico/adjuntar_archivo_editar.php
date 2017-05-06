<?
$item = $_GET["item"];
$id_st_cronograma_informes = $_GET["id_st_cronograma_informes"];
$volver = $_GET["volver"];
$pro_key = $_GET["pro_key"];

$resultado=mysql_query("SELECT titulo,imagen FROM st_cronograma_informes_".$pro_key."_archivos WHERE id_st_cronograma_informes_".$pro_key."='".$id_st_cronograma_informes."' AND item='".$item."'");
$dato_arch=mysql_fetch_array($resultado);
?>
<link href="../../css/general.css" rel="stylesheet" type="text/css">
<form name="form2" method="POST" enctype="multipart/form-data" action="<?=$link_modulo_r?>" onSubmit=" return VerifyOne ();">
<input type="hidden" name="path" value="adjuntar_archivo_editar_r.php" />
<input name="id_st_cronograma_informes" id="id_st_cronograma_informes" type="hidden" value="<?=$id_st_cronograma_informes?>">
<input name="volver" id="volver" type="hidden" value="<?=$volver?>">
<input name="item" id="item" type="hidden" value="<?=$item?>">
<input name="pro_key" id="pro_key" type="hidden" value="<?=$pro_key?>">

<table width="100%" align="center" class="table2">
<caption>Usted esta Modificando el Titulo del siguiente Archivo:</caption>
<tr><th>Archivo:</th>
  <td><?=$dato_arch['imagen']?></td>
</tr>
<tr><th>Titulo:</th><td><input name="titulo" type="text" class="title6" id="titulo" size="90" value="<?=$dato_arch['titulo']?>" autocomplete="off"/></td></tr>
<tfoot>
<tr>
<td colspan="2"><div align="right">
  <input type="submit" name="Submit" value="Modificar Titulo"/>
</div></td>
</tr>
</tfoot>
</table>
</form>

<SCRIPT type=text/javascript>
function VerifyOne () {

   if(document.form2.titulo.value!=""){					
	return true;				
	}
	else {	
	alert('Escriba el titulo de la imagen');
	document.form2.titulo.focus();
	return false;
    }
}
</SCRIPT>
