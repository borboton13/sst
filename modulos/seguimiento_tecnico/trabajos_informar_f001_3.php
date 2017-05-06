<script type="text/javascript" src="../../paquetes/autocompletar/ajax.js"></script>
<script type="text/javascript" src="../../paquetes/autocompletar/ajax-dynamic-list.js"></script>
<link href="../../paquetes/autocompletar/ajax-dynamic-list.css" rel="stylesheet" type="text/css">
<style>
	div.grippie {
		background:#EEEEEE url(../../paquetes/textarea/grippie.png) no-repeat scroll center 2px;
		border-color:#DDDDDD;
		border-style:solid;
		border-width:0pt 1px 1px;
		cursor:s-resize;
		height:9px;
		overflow:hidden;
	}
</style>
<?php
$id_st_cronograma_informes=$_GET["id_st_cronograma_informes"];
$web=$_SESSION["web"];
$pro_key="f001";
if($nively=='1'){ $adm=1;}

$fecha=date("d/m/Y");

$resultado=mysql_query("SELECT
id_st_proyecto,
id_item,
id_cliente,
id_usuario,
periodo,
DATE_FORMAT(fecha,'%d/%m/%Y') AS fecha,
hora_programada AS h_prog,
obs_int,
revision
FROM st_cronograma_informes_".$pro_key." 
WHERE id_st_cronograma_informes_".$pro_key."='".$id_st_cronograma_informes."'");
$dato=mysql_fetch_array($resultado);

$datox=mysql_fetch_array(mysql_query("SELECT razon_social FROM clientes WHERE id='".$dato['id_cliente']."'"));
$cliente=$datox['razon_social'];
$datox=mysql_fetch_array(mysql_query("SELECT concat(nombre, ' ', ap_pat) as usuario FROM usuarios WHERE id='".$dato['id_usuario']."'"));
$tecnico=$datox['usuario'];
$datox=mysql_fetch_array(mysql_query("SELECT MAX(periodo) AS de FROM st_cronograma_informes_".$pro_key." WHERE id_item='".$dato['id_item']."'"));
$de=$datox['de'];

$dato_t=mysql_fetch_array(mysql_query("SELECT departamento,producto,marca,caracteristicas,ubicacion,sn FROM st_trabajos WHERE id_item='".$dato['id_item']."'"));

$carpeta_id=$pro_key."_".$id_st_cronograma_informes;

$carpeta="archivos_st/".$dato['id_st_proyecto']."/".$carpeta_id;
$dir = "../../".$carpeta."/";
$dir_ext=$web."/".$carpeta."/";
?>
<table width="600" align="center">
<tr>
<td><a class="enlaceboton" href="<?=$link_modulo?>?path=trabajos_ver_correlativo.php&nro=<?=$dato['id_st_proyecto']?>" target='_top'><img src='../../img/ico_detalles.gif' alt='Ver Proyecto' border="0" align="absmiddle"> Ver Lista de Equipos del Proyecto </a>
</td></tr>
<tr>
<td>

<form name="amper" method="post" action="<?=$link_modulo_r?>" onSubmit=" return VerifyOne ();">
<input type="hidden" name="path" value="trabajos_informar_<?=$pro_key?>_3r.php" />
<input type="hidden" name="id_st_cronograma_informes" value="<?=$id_st_cronograma_informes;?>" />
<input type="hidden" name="id_item" value="<?=$dato['id_item'];?>" />

<table width="100%" class="table2">
<caption><span style="font-size:18px">INFORME EMERGENCIAS</span><br />
Llenar Formulario Paso 3 de 3:
</caption>
<tr>
<td width="65%">Proyecto Nro:<span class="title">
  <?=$dato['id_st_proyecto'];?>
</span></td>
<td width="35%" align="right"><span class="medium">INF:</span><span class="medium azul"> F001<?=str_pad($id_st_cronograma_informes, 4, "0", STR_PAD_LEFT);?></span></td>
</tr>
<tr>
<td>Cliente:<span class="medium title7">
  <?=$cliente;?>
</span></td>
<td width="35%" align="right">Mantenimiento Nro: <strong class="medium"><?=$dato['periodo'];?> de
  <?=$de?>
</strong></td>
</tr>
</table>
<table width="100%" class="table2">
<tr>
<th colspan="2"><strong class="verde">Detalles del Servico:</strong></th>
</tr>
<tr>
<td width="58%">Caracteristicas: <span class="azul"><?=$dato_t['caracteristicas'];?></span></td>
<td width="42%">Fecha Actual:<span class="azul"> <?=$fecha;?></span></td>
</tr>
<tr>
<td>Estaci&oacute;n: <span class="azul"><?=$dato_t['ubicacion'];?></span></td>
<td>
  Departamento:<span class="azul">
    <?=$dato_t['departamento'];?>
</span></td>
</tr>
</table>

<table width="100%" class="table2">
<tr>
<th colspan="2"><strong class="verde">Programacion:</strong></th>
</tr>
<tr>
<td width="25%">Fecha Programada:</td>
<td><span class="azul"><?=$dato['fecha'];?></span> </td>
</tr>
<tr>
<td width="25%">Hora Programada:</td>
<td><span class="azul"><?=$dato['h_prog'];?></span> </td>
</tr>
<tr>
<td>Tecnico a Cargo:</td>
<td><span class="azul"><?=$tecnico;?></span>                              </td>
</tr>
</table>

<!--
<table width="100%" class="table2">
<tr>
<th colspan="2"><strong class="verde">R I F</strong></th>
</tr>
<tr>
<td width="25%">Nro. de Ticket:</td>
<td>
<input name="ticket" type="text" class="Text_left" id="ticket" size="45" autocomplete="off"
	   onKeyUp="ajax_showOptions(this,'',event,'../../paquetes/autocompletar/search_tickets.php')">
<input type="hidden" id="ticket_hidden" name="id_ticket">
</td>
</tr>
</table>
-->	
<table width="604" cellspacing="2" class="table2">
<tr>
<th height="20" colspan="3"><strong class="verde">ARCHIVOS ADJUNTOS PARA REPORTE FOTOGRAFICO:</strong></th>
</tr>
<tr height="16">
<th width="414">Archivos a Enviar </th>
<th width="79">Tama&ntilde;o</th>
<th width="95"></th>
</tr>
<?php 
	$resultado=mysql_query("SELECT titulo,imagen,item FROM st_cronograma_informes_".$pro_key."_archivos WHERE id_st_cronograma_informes_".$pro_key."='".$id_st_cronograma_informes."' ORDER BY item ASC");
	$filas=mysql_num_rows($resultado);
	if($filas!=0)
	{ $j=0;
	while($dato_arch=mysql_fetch_array($resultado))
	 {

$nombre=$dato_arch['imagen'];
$titulo=$dato_arch['titulo'];

	$tam=filesize($dir.$nombre)/1024;
	$ext=substr(strrchr($nombre, '.'), 1);
	if($j%2==0)
	{
	$rowt="#f6f7f8";
	}
	else
	{
	$rowt="#f1f1f1";
	}

	?>
	<tr height="25" onmouseover="setPointer(this, '#DADADA')" onmouseout="setPointer(this, '<?=$rowt?>')">
	<td style="background:<?=$rowt?>"><label title="<?=$nombre?>"><a href="<?=$dir_ext.$nombre;?>" target="_blank" class="enlaceboton">
	<img src="../../img/icons/icon_<?=$ext?>.gif" border="0" align="top"><?=$titulo?></a></label></td>
	<TD style="background:<?=$rowt?>"><div align="right"><? echo round($tam)." Kb"; ?></div></TD>
	<td style="background:<?=$rowt?>"><div align="center">
		<a href="<?=$dir_ext.$nombre;?>" target="_blank" class="enlaceboton"><img src="../../img/icons/icon_<?=$ext?>.gif" border="0" align="top"></a>
		<a title="Descargar Archivo ahora!" href="../../funciones/descargar_archivo.php?download=<?=$nombre?>&directorio=<?=$carpeta?>" target="_blank" class="enlaceboton">
			<img border=0 src="../../img/download.gif" >
		</a>
		<a title="Eliminar Archivo"
		   class="enlaceboton"
		   href="<?=$link_modulo_r?>?path=eliminar_archivo.php&item=<?=$dato_arch['item']?>&id_item=<?=$dato['id_item']?>&id_st_cronograma_informes=<?=$id_st_cronograma_informes?>&volver=3&nomfile=<?=base64_encode($nombre)?>">
			<img src="../../img/ico_cancel.gif" border="0" onclick="return confirm('DIMESAT SRL: Esta seguro que desea eliminar el Archivo:  <?=$nombre?> ?');">
		</a>
		<a href="<?=$link_modulo_r?>?path=adjuntar_archivo_editar.php&id_st_cronograma_informes=<?=$id_st_cronograma_informes?>&item=<?=$dato_arch['item']?>&pro_key=<?=$pro_key?>&volver=3"
		   class="enlace_s_menu"
		   onclick="return GB_showCenter('ADICIONAR ARCHIVO', this.href,182, 700)">
			<img src="../../img/change.gif" alt="ADICIONAR ARCHIVO" vspace="0" border="0" align="absbottom">
		</a></div>
	</td>
	</tr>
	<?php 
	$j++;
	}
} 
else{
	?>
	<tr height="25">
	<td colspan="3"><div class="marcar">Sin Archivos para Adjuntar</div></td>
	</tr>
	<?	
	}
?>
<tr>
<td height="23" colspan="3">
<div align="right">
    <a href="<?=$link_modulo_r?>?path=adjuntar_archivo.php&id_item=<?=$dato['id_item']?>&id_st_cronograma_informes=<?=$id_st_cronograma_informes?>&volver=3" 
       class="enlace_s_menu" 
       onclick="return GB_showCenter('ADICIONAR ARCHIVO', this.href,182, 700)">
    <img src="../../img/add_archivos.gif" alt="ADICIONAR ARCHIVO" vspace="0" border="0" align="absbottom"> <B>Adjuntar Archivo al Informe</B></a>
</div>
</td>
</tr> 
</table>
<? 
switch($dato['revision']){
case 'R': if($adm){
?>
<table width="100%" cellspacing="2" class="table2">
<tr>
<td height="20" class="verde">MENSAJE INTERNO:</td>
</tr>
<tr>
<td height="20"><?=$dato['obs_int']?></td>
</tr>
<tr>
<th height="20"><strong class="verde">CONDICION FINAL:</strong></th>
</tr>
<tr>
<td height="30">
<table border="0" align="center" class="table2">	
<tr><td class="marco"><label><input name="condicion_final" type="radio" value="OK">
<span class="verde"><strong>OK</strong></span></label> &nbsp;</td><td class="marco"><label><input name="condicion_final" type="radio" value="Pendiente">
<span class="title7"><strong>Pendiente</strong></span></label> &nbsp;</td><td class="marco"><label><input name="condicion_final" type="radio" value="Irreparable">
<span class="title2">Irreparable</span></label> &nbsp;</td></tr></table>
</td>
</tr>
</table>
<table width="100%" cellspacing="2" class="table2">
<tr>
<th height="20"><strong class="verde">DESTINATARIOS QUE RECIBIRAN EL INFORME:</strong></th>
</tr>
<tr><td width="50%"><span class="title6">T�cnico responsable:</span>
		  <?
		$datox=mysql_fetch_array(mysql_query("SELECT u.mail,CONCAT(u.nombre,' ',u.ap_pat) AS tecnico FROM st_cronograma_informes_".$pro_key." i INNER JOIN usuarios u ON i.id_usuario=u.id WHERE i.id_st_cronograma_informes_".$pro_key."='".$id_st_cronograma_informes."'"));
	$bcc=$datox['mail'];
	?>
	<span class="marcar_check"><?=$bcc?> </span>(<?=$datox['tecnico']?>)
		   </td></tr>
<tr><td width="50%"><span class="title6">Destinatarios Cliente:</span>
		  <?
//	$consulta="SELECT v.correo,v.nombre_completo FROM st_proyecto p INNER JOIN st_personal_veedor v ON p.id_st_proyecto='".$dato['id_st_proyecto']."' AND p.id_cliente=v.id_cliente";
$consulta="SELECT CONCAT(nombre,' ',ap_pat) AS usuario,mail FROM usuarios WHERE nivel='3'";
$resultado=mysql_query($consulta);
$k=1;
	$filas=mysql_num_rows($resultado);
	if($filas!=0)
	{  
while($datoc=mysql_fetch_array($resultado))
 		{
		?>
<!--<BR /><label id="label<?=$k?>" class="marcar_check"><input name="d_p[]" type="checkbox" value="<?=$datoc['correo']?>" id="check_<?=$k?>" onclick="marcar_check(this,'label<?=$k?>')" checked="checked"/>-->
<!--<?=$datoc['correo']?> </label>(<?=$datoc['nombre_completo']?>)-->
		<BR /><label id="label<?=$k?>" class="marcar_check"><input name="notificar[]" type="checkbox" value="<?=$datoc['mail']?>" id="check_<?=$k?>" onclick="marcar_check(this,'label<?=$k?>')" />
		<?=$datoc['mail']?> </label>(<?=$datoc['usuario']?>)
		<?
		$k++;
		}				
	}
		?>
		   </td></tr><tr><td>
<span class="title6">Destinatarios Internos:</span>		   
<?
$consulta="SELECT CONCAT(nombre,' ',ap_pat) AS usuario,mail FROM usuarios WHERE nivel='1'";
$resultado=mysql_query($consulta);
$k=1;
	$filas=mysql_num_rows($resultado);
	if($filas!=0)
	{  
while($datoc=mysql_fetch_array($resultado))
 		{
		?>
		<BR /><label id="label<?=$k?>" class="marcar_check"><input name="notificar[]" type="checkbox" value="<?=$datoc['mail']?>" id="check_<?=$k?>" onclick="marcar_check(this,'label<?=$k?>')" checked="checked"/>
<?=$datoc['mail']?>  </label>(<?=$datoc['usuario']?>)
		<?
		$k++;
		}				
	}
?>
	      
</td></tr>
<tr><td>
<span class="title6">Adem&aacute;s enviar a: </span>  
		  <img src="../../img/ico_info_tooltip.gif" width="38" height="17" align="absmiddle" 
onmouseover="tooltip.show('&lt;strong&gt;Ademas enviar a:&lt;/strong&gt;&lt;br /&gt; Si va a enviar a varios destinatarios adicionales, inserte los correos separados por comas, Eje: corre1@dominio1.com,corre2@dominio2.com');" 
onmouseout="tooltip.hide();"/><input name="copia_mail" type="text" id="copia_mail" size="65" class="Text_left">
</td></tr>

<tfoot>
<tr>
<td height="20"><center>
<input name="validar" type="submit" class="large" value="ENVIAR INFORME" />
</center></td>
</tr>
</tfoot>
</table>
<?
} else{ 	?>
<table width="100%" cellspacing="2" class="table2">
<tr>
<th colspan="2"><strong class="naranja"><div align="center">PENDIENTE DE REVISION</div></strong></th>
</tr>
</table>
<?
}
break;
case 'E': ?>
<table width="100%" cellspacing="2" class="table2">
<tr>
<th colspan="2"><strong class="verde"><div align="center">ESTE INFORME YA FUE REVISADO Y VALIDADO</div></strong></th>
</tr>
</table>

<?
break;
default:
if($adm){ ?>
<table width="100%" cellspacing="2" class="table2">
<tr>
<th colspan="2"><strong class="rojo"><div align="center">ESTE INFORME ESTA PENDIENTE DE REGISTRO Y CONFIGURACION</div></strong></th>
</tr>
</table>
<? }
else{
?>
<table width="100%" cellspacing="2" class="table2">
<tr>
<th colspan="2"><strong class="verde"><div align="center">- MENSAJE INTERNO -</div></strong></th>
</tr>
<tr>
<td height="20" class="cafe">Este mensaje no forma parte del Informe, solo es informaci�n para fines internos:</td>
</tr>
<tr>
<td height="20"><textarea name="obs_int" class="resizable" style="width: 590px; height: 50px;" id="obs_int"><?=$dato['obs_int']?></textarea></td>
</tr>
<tr><td>
<span class="title6">Enviar Notificaci�n de Revisi�n a:</span>
<?
$consulta="SELECT CONCAT(nombre,' ',ap_pat) AS usuario,mail FROM usuarios WHERE nivel='1'";
$resultado=mysql_query($consulta);
$k=1;
	$filas=mysql_num_rows($resultado);
	if($filas!=0)
	{  
while($datoc=mysql_fetch_array($resultado))
 		{
		?>
		<BR /><label id="label<?=$k?>" class="marcar_check"><input name="notificar[]" type="checkbox" value="<?=$datoc['mail']?>" id="check_<?=$k?>" onclick="marcar_check(this,'label<?=$k?>')" checked="checked"/>
<?=$datoc['mail']?>  </label>(<?=$datoc['usuario']?>)
		<?
		$k++;
		}				
	}
?>
</td></tr>
<tfoot>
<tr>
<td height="20" ><center><input name="validar" type="submit" class="large" value="ENVIAR A REVISION" /></center></td>
</tr>
</tfoot>
</table>
<?
	}
}
?>
<table width="600" border="0" align="right" class="table2">	
<tr><td class="marco"><? echo" <a class=\"enlaceboton\" href='../../html/html_st_".$pro_key.".php?id_st_cronograma_informes=".base64_encode($id_st_cronograma_informes)."&id_item=".base64_encode($dato['id_item'])."' onClick=\"openNewWindowhtml( this, '800', '590' );return false;\"><img src='../../img/c_html.gif' alt='Ver Informe en HTML' border=\"0\">Vista preliminar en HTML</a>"; ?></td><td class="marco"><? echo"<a class=\"enlaceboton\" href='../../pdf/pdf_st_".$pro_key.".php?id_st_cronograma_informes=".base64_encode($id_st_cronograma_informes)."&id_item=".base64_encode($dato['id_item'])."' onClick=\"openNewWindowhtml( this, '800', '590' );return false;\"><img src='../../img/imp.gif' alt='Ver Informe en PDF' border=\"0\">Vista Preliminar en PDF</a> ";
?></td><td class="marco"><a class="enlaceboton" href="<?=$link_modulo?>?path=trabajos_informar_<?=$pro_key?>_2.php&id_st_cronograma_informes=<?=$id_st_cronograma_informes?>" target='_top'><img src='../../img/change.gif' alt='Volver al Paso Anterior' border="0" align="absmiddle"> Volver Al Paso Anterior </a></td></tr></table>
</form>
</td>
</tr>
</table>
<script type="text/javascript" src="../../paquetes/textarea/jquery-latest.js"></script>
<script type="text/javascript" src="../../paquetes/textarea/jquery.textarearesizer.compressed.js"></script>
<script type="text/javascript">
	/* jQuery textarea resizer plugin usage */
	$(document).ready(function() {
		$('textarea.resizable:not(.processed)').TextAreaResizer();
	});
</script>
<SCRIPT src="../../js/validador.js" type=text/javascript></SCRIPT>
<script type="text/javascript">
function VerifyOne () {
if(validarRB(document.amper.condicion_final,'Seleccione la condicion final!')
)
{ 
if(confirm("ESTA VALIDANDO ESTE FORMULARIO\n Verific� bien los datos antes de continuar?"))
{return true;}
else {return false;}   

}
else {return false;}   	
}
function marcar_check(check,value){
label = document.getElementById(value)
if (check.checked == true)
		{		
		label.className = 'marcar_check';
        }
		else{
		label.className = 'adjunto';
		}
		

}
</script> 
<script type="text/javascript">var GB_ROOT_DIR = "./../../paquetes/greybox/";</script>
<script type="text/javascript" src="../../paquetes/greybox/AJS.js"></script>
<script type="text/javascript" src="../../paquetes/greybox/AJS_fx.js"></script>
<script type="text/javascript" src="../../paquetes/greybox/gb_scripts_no_reload.js"></script>
<link href="../../paquetes/greybox/gb_styles.css" rel="stylesheet" type="text/css" media="all" />
<link href="../../paquetes/tooltip/tooltip.css" rel="stylesheet" type="text/css">
<script language=javascript type="text/javascript" src="../../paquetes/tooltip/tooltip.js"></script>	
