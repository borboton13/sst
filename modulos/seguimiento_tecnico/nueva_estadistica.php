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
<?php
$estacion_val = "";
$filas = 0;

?>
<table width="700" align="center">
<tr>

</tr>
<tr>
<td>
<form name="amper" method="post" action="../../modulos/seguimiento_tecnico/s_nueva_estadistica.php" onSubmit=" return VerifyOne ();">
<input type="hidden" name="filas" value="" />


<table width="100%" class="table2">
<caption><span style="font-size:18px">REGISTRO DE NUEVA ESTADISTICA</span><br /></caption>
</table>

<!-- RIF -->
<table width="100%" class="table2">
	<tr>
		<th colspan="2"><strong class="verde">Datos necesarios:</strong></th>
	</tr>

	<tr>
		<td width="20%">
			<div align="left">
			<span class="rojo">*</span>CODIGO:		  	
		  	</div>
		</td>
		<td width="80%">
			<input name="codigo" type="text" id="codigo" value="" size="20" maxlength="15"/>&nbsp;&nbsp;&nbsp;
		</td>
	</tr>
	
	
	<tr>
		<td width="20%">
			<div align="left"><span class="rojo">*</span>FECHA DE INICIO:
			
			</div>
		</td>
		<td width="80%">
			<input name="fecha_inicio_est" type="text" id="fecha_inicio_est" size="20" value="" onclick="displayCalendar(this,'yyyy-mm-dd',this,false)"/>
			<img onclick="displayCalendar(document.amper.fecha_inicio_rif,'yyyy-mm-dd',this,false)" src="../../img/time.png" alt="Seleccionar fecha" width="16" height="16">
		</td>
		
	</tr>
	<tr>
		<td width="20%">
			<div align="left"><span class="rojo">*</span>FECHA DE FIN:
			
			</div>
		</td>
		<td width="80%">
			<input name="fecha_fin_est" type="text" id="fecha_fin_est" size="20" value="" onclick="displayCalendar(this,'yyyy-mm-dd',this,false)"/>
			<img onclick="displayCalendar(document.amper.fecha_fin_rif,'yyyy-mm-dd',this,false)" src="../../img/time.png" alt="Seleccionar fecha" width="16" height="16">				
	</tr>
	
	<tr>
		<td width="20%">
		  	<div align="left"><span class="rojo">*</span>DESCRIPCION:  
		    
			</div>
		</td>
		<td width="80%">
			<input name="descripcion" type="text" id="descripcion" value="" size="60" maxlength="100"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		</td>
		
	</tr>

    

</table>

<!-- FIN RIF -->



<table width="100%" cellspacing="2" class="table2">
<!--<tr>
<th colspan="2"><strong class="verde">Plan de Accion</strong></th>
</tr>
<tr>
<td colspan="2">
<textarea name="plan_accion" class="resizable" style="width: 596px; height: 40px;" id="plan_accion"><?/*=$dato['plan_accion']*/?></textarea>
</td>
</tr>-->

<!--<tr>
<th colspan="2"><strong class="verde">Trabajo Realizado</strong></th>
</tr>
<tr>
<td colspan="2">
<textarea name="trabajo_realizado" class="resizable" style="width: 596px; height: 40px;" id="trabajo_realizado"><?/*=$dato['trabajo_realizado']*/?></textarea>
</td>
</tr>-->

<!--<tr>
<th colspan="2"><strong class="verde">Personal</strong></th>
</tr>
<tr>
<td colspan="2">
<textarea name="personal" class="resizable" style="width: 596px; height: 40px;" id="personal"><?/*=$dato['personal']*/?></textarea>
</td>
</tr>-->



</table>

<table width="100%" class="table2">
<tfoot>
<tr>
<td width="50%" ><span class="rojo"></span><br /><center>
<input name="validar" type="submit" class="large" value="&nbsp;&nbsp;Guardar&nbsp;&nbsp;" />
</center></td>
</tr>
</tfoot>
</table>
</form>

</td>
</tr>
</table>
<script type="text/javascript" src="../../paquetes/autocompletar/ajax.js"></script>
<script type="text/javascript" src="../../paquetes/autocompletar/ajax-dynamic-list.js"></script>
<link href="../../paquetes/autocompletar/ajax-dynamic-list.css" rel="stylesheet" type="text/css">

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
//validarRB(document.amper.p5,'Seleccione el Tipo de Emergencia!') &&
//validarRB(document.amper.p6,'Seleccione el Servicio Afectado!') &&

function VerifyOne () {
	
if(checkField( document.amper.codigo , isName, false) &&	
	isNull( document.amper.fecha_inicio_est) && 
	isNull( document.amper.fecha_fin_est)&&
	checkField( document.amper.descripcion, isName, false) 
	)
{ 
	if(confirm("Esta Guardando esta información de la nueva Estadística"))
	{	return true;	}
	else {return false;}   

}
else {return false;}   	
}
</script>  
