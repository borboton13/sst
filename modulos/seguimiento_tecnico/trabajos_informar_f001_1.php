<style>	
	.time_picker_div {padding:5px;
		border:solid #999999 1px;
		background:#ffffff;}
	legend{
	font-weight:bold;
	font-style:italic}	
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
<? 
$id_st_cronograma_informes=$_GET["id_st_cronograma_informes"];

$fecha=date("d/m/Y");
$pro_key="f001";

$resultado=mysql_query("SELECT
id_st_proyecto,
id_item,
id_cliente,
id_usuario,
detalles,
periodo,
DATE_FORMAT(fecha,'%d/%m/%Y') AS fecha,
conta,
hora_programada AS h_prog,
DATE_FORMAT(hora_llegada,'%Y-%m-%d %H:%i') AS hora_llegada,
DATE_FORMAT(hora_salida,'%Y-%m-%d %H:%i') AS hora_salida,
obs,
DATE_FORMAT(p1,'%Y-%m-%d %H:%i') AS p1,
DATE_FORMAT(p2,'%Y-%m-%d %H:%i') AS p2,
p3,
p4,
p5,
p6,
p7,
p8,
p9,nro_ticket,id_nodo,fecha_apertura,fecha_cierre,p71
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



?>
<table width="600" align="center">
<tr>
<td><a class="enlaceboton" href="<?=$link_modulo?>?path=trabajos_ver_correlativo.php&nro=<?=$dato['id_st_proyecto']?>" target='_top'><img src='../../img/ico_detalles.gif' alt='Ver Proyecto' border="0" align="absmiddle"> Ver Lista de Equipos del Proyecto </a>
</td></tr>
<tr>
<td>
<form name="amper" method="post" action="<?=$link_modulo_r?>" onSubmit=" return VerifyOne ();">
<input type="hidden" name="path" value="trabajos_informar_<?=$pro_key?>_1r.php" />

<input type="hidden" name="id_st_cronograma_informes" value="<?=$id_st_cronograma_informes;?>" />
<input type="hidden" name="id_item" value="<?=$dato['id_item'];?>" />

<table width="100%" class="table2">
<caption><span style="font-size:18px">INFORME EMERGENCIAS</span><br />
Llenar Formulario Paso 1 de 3:
</caption>
<tr>
<td width="65%">Proyecto Nro:<span class="title">
  <?=$dato['id_st_proyecto'];?>
</span></td>
<td width="35%" align="right"><span class="medium">INF:</span><span class="medium azul"> <?=strtoupper($pro_key)?><?=str_pad($id_st_cronograma_informes, 4, "0", STR_PAD_LEFT);?></span></td>
</tr>
<tr>
<td>Cliente:<span class="medium title7">
  <?=$cliente;?>
</span></td>
<td width="35%" align="right">Intervenci&oacute;n Nro: <strong class="medium"><?=$dato['periodo'];?> de
  <?=$de?>
</strong></td>
</tr>
</table>

<table width="100%" class="table2">
	<tr>
		<th colspan="2"><strong class="verde">Detalles del Servico:</strong></th>
	</tr>
	<tr>
		<td width="58%"><span class="rojo">*</span>Detalles:
		  <input name="detalles" type="text" id="detalles" value="<?=$dato['detalles'];?>" size="41" maxlength="250"/>
		</td>
		<td width="42%">
		  	<div align="right">COD CONTA- 
		    <input name="conta" type="text" id="conta" value="<?=$dato['conta'];?>" size="6" maxlength="6"/>
			</div>
		</td>
	</tr>
	<tr>
		<td><span class="rojo">*</span>Estaci&oacute;n:
		  <input name="ubicacion" type="text" id="ubicacion" value="<?=$dato_t['ubicacion'];?>" size="41" maxlength="100"/>
		</td>
		<td>
		  Departamento:<span class="azul"><?=$dato_t['departamento'];?></span>
		</td>
	</tr>
</table>

<!-- RIF -->
<table width="100%" class="table2">
	<tr>
		<th colspan="2"><strong class="verde">Detalles RIF:</strong></th>
	</tr>
	<tr>
		<td width="50%">
			<div align="right">
			Nro de Ticket:
		  	<input name="nro_ticket" type="text" id="nro_ticket" value="<?=$dato['nro_ticket'];?>" size="20" maxlength="250"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		  	</div>
		</td>
		<td></td>

<!--
		<td width="50%">
		  	<div align="right">ID Nodo:  
		    <input name="id_nodo" type="text" id="id_nodo" value="<?=$dato['id_nodo'];?>" size="20" maxlength="6"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			</div>
		</td>
	</tr>
	<tr>
		<td width="50%">
			<div align="right">
			<span class="rojo">*</span>Fecha de Apertura:
			<input name="fecha_apertura" type="text" id="fecha_apertura" size="20" value="<?=$dato['fecha_apertura']?>" onclick="displayCalendar(this,'yyyy-mm-dd hh:ii',this,true)"/>
			<img onclick="displayCalendar(document.amper.fecha_apertura,'yyyy-mm-dd hh:ii',this,true)" src="../../img/time.png" alt="Seleccionar fecha apertura" width="16" height="16">
			</div>
		</td>
		<td width="50%">
			<div align="right">Fecha de Cierre:
			<input name="fecha_cierre" type="text" id="fecha_cierre" size="20" value="<?=$dato['fecha_cierre']?>" onclick="displayCalendar(this,'yyyy-mm-dd hh:ii',this,true)"/>
			<img onclick="displayCalendar(document.amper.fecha_cierre,'yyyy-mm-dd hh:ii',this,true)" src="../../img/time.png" alt="Seleccionar fecha cierre" width="16" height="16">
			</div>
		</td>
	</tr>
-->
</table>

<!-- FIN RIF -->

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
<td><span class="azul"><?=$tecnico;?></span></td>
</tr>
</table>

<table width="100%" border="0" cellpadding="0" cellspacing="2" class="table2">
<tr>
<th colspan="2"><strong class="verde">ATENCION:</strong></th>
</tr>
<tr>
<td width="49%"><div align="right"><span class="rojo">*</span>Notificaci&oacute;n:<input name="p1" type="text" id="p1" size="20" value="<?=$dato['p1']?>" onclick="displayCalendar(this,'yyyy-mm-dd hh:ii',this,true)"/><img onclick="displayCalendar(document.amper.p1,'yyyy-mm-dd hh:ii',this,true)" src="../../img/time.png" alt="Seleccionar fecha incial" width="16" height="16"></div></td>
<td width="51%"><div align="right"><span class="rojo">*</span>Ingreso al Sitio:<input name="time1" type="text" id="time1" size="20" value="<?=$dato['hora_llegada']?>" onclick="displayCalendar(this,'yyyy-mm-dd hh:ii',this,true)"/><img onclick="displayCalendar(document.amper.time1,'yyyy-mm-dd hh:ii',this,true)" src="../../img/time.png" alt="Seleccionar fecha incial" width="16" height="16"></div></td>
</tr>
<tr>
<td><div align="right"><span class="rojo">*</span>Inicio de Viaje:<input name="p2" type="text" id="p2" size="20" value="<?=$dato['p2']?>" onclick="displayCalendar(this,'yyyy-mm-dd hh:ii',this,true)"/><img onclick="displayCalendar(document.amper.p2,'yyyy-mm-dd hh:ii',this,true)" src="../../img/time.png" alt="Seleccionar fecha incial" width="16" height="16"></div></td>
<td><div align="right"><span class="rojo">*</span>Conclusi&oacute;n del trabajo:<input name="time2" type="text" id="time2" size="20" value="<?=$dato['hora_salida']?>" onclick="displayCalendar(this,'yyyy-mm-dd hh:ii',this,true)"/><img onclick="displayCalendar(document.amper.time2,'yyyy-mm-dd hh:ii',this,true)" src="../../img/time.png" alt="Seleccionar fecha incial" width="16" height="16"></div></td>
</tr>
</table>
<table width="100%" cellspacing="2" class="table2">
<tr>
<th><strong class="verde"><span class="rojo">*</span>Personal de turno del Cliente </strong></th>
<th><strong class="verde"><span class="rojo">*</span>Personal Contratista de turno </strong></th>
</tr>
<tr>
<td valign="top" width="50%"><textarea class="resizable" name="p3" style="width: 295px; height: 60px;" id="p3"><?=$dato['p3']?></textarea></td>
<TD valign="top" width="50%"><textarea class="resizable" name="p4" style="width: 295px; height: 60px;" id="p4"><?=$dato['p4']?></textarea></TD>
</tr>
<tr>
<th><strong class="verde"><span class="rojo">*</span>TIPO DE EMERGENCIA </strong></th>
<th><strong class="verde"><span class="rojo">*</span>SERVICIO AFECTADO </strong></th>
</tr>
<tr>
<td width="50%">
    <div align="right" style="padding-right:80px">
    TRANSMISION <input name="p5" type="radio" value="TRANSMISION" <? if($dato['p5']=="TRANSMISION") { echo"checked";}?>/><br />
    ENERGIA <input name="p5" type="radio" value="ENERGIA" <? if($dato['p5']=="ENERGIA") { echo"checked";}?>/><br />
    RBS <input name="p5" type="radio" value="RBS" <? if($dato['p5']=="RBS") { echo"checked";}?>/><br />
    BTS <input name="p5" type="radio" value="BTS" <? if($dato['p5']=="BTS") { echo"checked";}?>/><br />
    INFRAESTRUCTURA<input name="p5" type="radio" value="INFRAESTRUCTURA" <? if($dato['p5']=="INFRAESTRUCTURA") { echo"checked";}?>/>
    </div>
</td>
<TD width="50%">
    <div align="right" style="padding-right:80px">
    CORTE DE TRAFICO <input name="p6" type="radio" value="CORTE DE TRAFICO"  <? if($dato['p6']=="CORTE DE TRAFICO") { echo"checked";}?>/><br />
    CORTE INTERMITENTE <input name="p6" type="radio" value="CORTE INTERMITENTE" <? if($dato['p6']=="CORTE INTERMITENTE") { echo"checked";}?>/><br />
    PELIGRO DE CORTE <input name="p6" type="radio" value="PELIGRO DE CORTE" <? if($dato['p6']=="PELIGRO DE CORTE") { echo"checked";}?>/></div><div align="center">
    OTROS <input name="p6" type="radio" value="OTROS" <? if(substr($dato['p6'],0,5)=="OTROS") { echo"checked";}?>/>
    <input name="p6_otros" type="text" <? if(substr($dato['p6'],0,5)=="OTROS") { echo"value='".substr($dato['p6'],7)."'";}?>/>
    </div></TD>
</tr>
<tr>
<th colspan="2"><strong class="verde"><span class="rojo">*</span>DESCRIPCION DE LA FALLA</strong></th>
</tr>
<tr>
<td colspan="2">
<textarea name="p7" class="resizable" style="width: 596px; height: 100px;" id="p7"><?=$dato['p7']?></textarea>
</td>
</tr>

<!--
<tr>
<th colspan="2"><strong class="verde"><span class="rojo">*</span>DAÑOS Y PARTES AFECTADAS EN LA ESTACIÓN *</strong></th>
</tr>
<tr>
<td colspan="2">
<textarea name="p71" class="resizable" style="width: 596px; height: 100px;" id="p71"><?=$dato['p71']?></textarea>
</td>
</tr>
-->

<tr>
<th colspan="2"><strong class="verde">DESCRIPCION DE LA INTERVENCION</strong></th>
</tr>
<tr>
<td colspan="2"><textarea name="p8" class="resizable" style="width: 596px; height: 100px;" id="p8"><?=$dato['p8']?></textarea></td>
</tr>


<tr>
<th colspan="2"><strong class="verde">REPUESTOS E INSUMOS UTILIZADOS</strong></th>
</tr>
<tr>
<td colspan="2"><textarea name="p9" class="resizable" style="width: 596px; height: 100px;" id="p9"><?=$dato['p9']?></textarea></td>
</tr>
<!--
<tr>
<th><strong class="verde">DESCRIPCION DE LA INTERVENCION</strong></th>
<th><strong class="verde">REPUESTOS E INSUMOS UTILIZADOS</strong></th>
</tr>
<tr>
<td valign="top" width="50%"><textarea name="p8" class="resizable" style="width: 295px; height: 100px;" id="p8"><?=$dato['p8']?></textarea></td>
<TD valign="top" width="50%"><textarea name="p9" class="resizable" style="width: 295px; height: 100px;" id="p9"><?=$dato['p9']?></textarea></TD>
</tr>
-->
<tr>
<th colspan="2" height="20" ><strong class="verde">OBSERVACIONES:</strong></th>
</tr>
<tr>
<td colspan="2" height="20"><textarea name="obs" class="resizable" style="width: 596px; height: 100px;"  id="obs"><?=$dato['obs']?></textarea></td>
</tr>
</table>
<table width="100%" class="table2">
<tfoot>
<tr>
<td width="50%" ><span class="rojo">(*) Campos Requeridos</span><br /><center>
<input name="validar" type="submit" class="large" value="Siguiente &gt; Paso 2" />
</center></td>
</tr>
</tfoot>
</table>
</form>
<table width="400" border="0" align="right" class="table2">	
<tr><td class="marco"><? echo" <a class=\"enlaceboton\" href='../../html/html_st_".$pro_key.".php?id_st_cronograma_informes=".base64_encode($id_st_cronograma_informes)."&id_item=".base64_encode($dato['id_item'])."' onClick=\"openNewWindowhtml( this, '800', '590' );return false;\"><img src='../../img/c_html.gif' alt='Ver Informe en HTML' border=\"0\">Vista preliminar en HTML</a>"; ?></td><td class="marco"><? echo"<a class=\"enlaceboton\" href='../../pdf/pdf_st_".$pro_key.".php?id_st_cronograma_informes=".base64_encode($id_st_cronograma_informes)."&id_item=".base64_encode($dato['id_item'])."' onClick=\"openNewWindowhtml( this, '800', '590' );return false;\"><img src='../../img/imp.gif' alt='Ver Informe en PDF' border=\"0\">Vista Preliminar en PDF</a> ";
?></td></tr></table>
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
<link type="text/css" rel="stylesheet" href="../../paquetes/calendar/dhtmlgoodies_calendar/dhtmlgoodies_calendar.css?random=20051112" media="screen"></LINK>
<SCRIPT type="text/javascript" src="../../paquetes/calendar/dhtmlgoodies_calendar/dhtmlgoodies_calendar.js?random=20060118"></script>		
<SCRIPT src="../../js/validador.js" type=text/javascript></SCRIPT>
<script type="text/javascript">
function VerifyOne () {
if( checkField( document.amper.detalles, isName, false) &&
checkField( document.amper.ubicacion, isName, false) &&
isNull( document.amper.time1) &&
isNull( document.amper.time2) &&
isNull( document.amper.p1) &&
isNull( document.amper.p2) &&
isNull( document.amper.p3) &&
validarRB(document.amper.p5,'Seleccione el Tipo de Emergencia!') &&
validarRB(document.amper.p6,'Seleccione el Servicio Afectado!') &&
isNull( document.amper.p7)
)
{ 
if(confirm("Esta Guardando esta información y Pasando al Paso 2 de 3."))
{return true;}
else {return false;}   

}
else {return false;}   	
}
</script>  
