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
$estacion_val = "";
$filas = 0;
if(isset($_GET["rif"])){
	$id_st_ticket = $_GET["rif"];
	$consulta = "SELECT id_st_ticket,ticket,idnodo,estacion,fecha_inicio_rif,hora_inicio_rif,fecha_fin_rif,hora_fin_rif,tipo,problema,fecha_not,hora_not,plan_accion,trabajo_realizado,personal,observaciones,idtipofalla " .
			    "FROM st_ticket WHERE id_st_ticket='$id_st_ticket'";
	$resultado 	= mysql_query($consulta);
	$filas	   	= mysql_num_rows($resultado);
	$dato		= mysql_fetch_array($resultado);
    $estacion_val = $dato['estacion'];
}

/*if(isset($_GET["idestacion"])){
    $idestacion = $_GET["idestacion"];
}*/

?>
<table width="700" align="center">
<tr>
<td><a class="enlaceboton" href="<?=$link_modulo?>?path=tickets.php" target='_top'>
	<img src='../../img/ico_detalles.gif' alt='Ver Proyecto' border="0" align="absmiddle"> Ver Lista de Tickets </a>
</td>
</tr>
<tr>
<td>
<form name="amper" method="post" action="../../modulos/seguimiento_tecnico/s_ticket.php" onSubmit=" return VerifyOne ();">
<input type="hidden" name="filas" value="<?=$filas?>" />
<input type="hidden" name="id_st_ticket" value="<?=$id_st_ticket?>" />

<table width="100%" class="table2">
<caption><span style="font-size:18px">REGISTRO DE TICKET</span><br /></caption>
</table>

<!-- RIF -->
<table width="100%" class="table2">
	<tr>
		<th colspan="2"><strong class="verde">Detalles RIF:</strong></th>
	</tr>

	<tr>
		<td width="50%">
			<div align="right">
			<span class="rojo">*</span>Nro de Ticket:
		  	<input name="ticket" type="text" id="ticket" value="<?=$dato['ticket'];?>" size="20" maxlength="15"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		  	</div>
		</td>
		<td width="50%">
            <div align="center">Escribir y seleccionar SOLO de la lista</div>
		</td>
	</tr>
	
	<tr>
		<td width="50%">
		  	<div align="right"><span class="rojo">*</span>ID Nodo:  
		    <input name="idnodo" type="text" id="idnodo" value="<?=$dato['idnodo'];?>" size="20" maxlength="10"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			</div>
		</td>
		<td width="50%">
			<!--<div align="right">
			Estación:
		  	<input name="estacion" type="text" id="estacion" value="<?/*=$dato['estacion'];*/?>" size="30" maxlength="255"/>&nbsp;&nbsp;
		  	</div>-->
            <div align="right">
                <span class="cafe">ESTACION:</span>
                <input name="estacion"
                       type="text"
                       id="estacion"
                       value="<? echo $estacion_val; ?>"
                       onKeyUp="ajax_showOptions(this,'',event,'../../paquetes/autocompletar/search_estaciones.php')" size="30" autocomplete="off" >&nbsp;&nbsp;
                <input type="hidden" id="idestacion" name="idestacion">
            </div>
		</td>
	</tr>
	
	<tr>
		<td width="50%">
			<div align="right"><span class="rojo">*</span>Fecha de Inicio:
			<input name="fecha_inicio_rif" type="text" id="fecha_inicio_rif" size="20" value="<?=$dato['fecha_inicio_rif']?>" onclick="displayCalendar(this,'yyyy-mm-dd',this,false)"/>
			<img onclick="displayCalendar(document.amper.fecha_inicio_rif,'yyyy-mm-dd',this,false)" src="../../img/time.png" alt="Seleccionar fecha apertura" width="16" height="16">
			</div>
		</td>
		<td width="50%">
			<div align="right"><span class="rojo">*</span>Hora Inicio:
			<input name="hora_inicio_rif" type="text" id="hora_inicio_rif" size="15" value="<?=$dato['hora_inicio_rif']?>" />
			(hh:mm:ss)
			</div>
		</td>
	</tr>
	<tr>
		<td width="50%">
			<div align="right">Fecha de Fin:
			<input name="fecha_fin_rif" type="text" id="fecha_fin_rif" size="20" value="<?=$dato['fecha_fin_rif']?>" onclick="displayCalendar(this,'yyyy-mm-dd',this,false)"/>
			<img onclick="displayCalendar(document.amper.fecha_fin_rif,'yyyy-mm-dd',this,false)" src="../../img/time.png" alt="Seleccionar fecha apertura" width="16" height="16">
			</div>
		</td>
		<td width="50%">
			<div align="right">Hora Fin:
			<input name="hora_fin_rif" type="text" id="hora_fin_rif" size="15" value="<?=$dato['hora_fin_rif']?>" />
			(hh:mm:ss)
			</div>
		</td>
	</tr>
	
	<tr>
		<td width="50%">
		  	<div align="right"><span class="rojo">*</span>Tipo:  
		    <input name="tipo" type="text" id="tipo" value="<?=$dato['tipo'];?>" size="20" maxlength="100"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			</div>
		</td>
		<td width="50%">
			<div align="right"><span class="rojo">*</span>Problema:
		  	<input name="problema" type="text" id="problema" value="<?=$dato['problema'];?>" size="28" maxlength="255"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		  	</div>
		</td>
	</tr>

    <tr>
        <td width="100%" colspan="2">
            <div align="center"><span class="rojo">* </span>FALLA:
                <select name="tipofalla" class="selectbuscar">
                    <option value="0" selected class="title7"> Seleccionar... </option>
                    <?php
                    $res2=mysql_query("SELECT idtipofalla, nombre FROM tipofalla");
                    while($dato2=mysql_fetch_array($res2)){
                        $idtipofalla = $dato2['idtipofalla'];
                        $nombre      = $dato2['nombre'];
                        echo '<option value="'.$idtipofalla.'" ';
                        if($idtipofalla==$dato['idtipofalla']) echo 'selected';
                        echo'>'.$nombre.'</option>';
                    }
                    ?>
                </select>
            </div>
        </td>
    </tr>

</table>

<!-- FIN RIF -->

<table width="100%" border="0" cellpadding="0" cellspacing="2" class="table2">
<tr>
<th colspan="2"><strong class="verde">NOTIFICACION:</strong></th>
<tr>
		<td width="50%">
			<div align="right"><span class="rojo">*</span>Fecha:
			<input name="fecha_not" type="text" id="fecha_not" size="20" value="<?=$dato['fecha_not']?>" onclick="displayCalendar(this,'yyyy-mm-dd',this,false)"/>
			<img onclick="displayCalendar(document.amper.fecha_not,'yyyy-mm-dd',this,false)" src="../../img/time.png" alt="Seleccionar fecha apertura" width="16" height="16">
			</div>
		</td>
		<td width="50%">
			<div align="right"><span class="rojo">*</span>Hora:
			<input name="hora_not" type="text" id="hora_not" size="15" value="<?=$dato['hora_not']?>" />
			(hh:mm:ss)
			</div>
		</td>
</tr>
</table>

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

<tr>
<th colspan="2"><strong class="verde">OBSERVACIONES</strong></th>
</tr>
<tr>
<td colspan="2" align="center">
<textarea name="observaciones" class="resizable" style="width: 650px; height: 80px;" id="observaciones"><?=$dato['observaciones']?></textarea>
</td>
</tr>

</table>

<table width="100%" class="table2">
<tfoot>
<tr>
<td width="50%" ><span class="rojo">(*) Campos Requeridos</span><br /><center>
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
	
if( checkField( document.amper.ticket, isName, false) &&
	checkField( document.amper.idnodo, isName, false) &&
	isNull( document.amper.fecha_inicio_rif) && 
	isNull( document.amper.hora_inicio_rif)&&
	checkField( document.amper.tipo, isName, false) &&
	checkField( document.amper.problema, isName, false) &&
	isNull( document.amper.fecha_not)&&
	isNull( document.amper.hora_not)
  )
{ 
	if(confirm("Esta Guardando esta información del TICKET"))
	{	return true;	}
	else {return false;}   

}
else {return false;}   	
}
</script>  
