<?php
if(isset($_POST["fecha"])) $fecha = $_POST["fecha"]." 00:00:00";
else {
	$dato=mysql_fetch_array(mysql_query("select now()"));
	$fecha=$dato[0];
}

if(isset($_POST["menos"]))
{
	$dato=mysql_fetch_array(mysql_query("SELECT DATE_SUB('$fecha',INTERVAL 1 DAY)"));
	$fecha=$dato[0];
}

if(isset($_POST["mas"]))
{
$dato=mysql_fetch_array(mysql_query("SELECT DATE_ADD('$fecha',INTERVAL 1 DAY)"));
$fecha=$dato[0];
}

$fecha=substr($fecha,0,10);

?>
<table width="98%" align="center" class="table3">
<caption>TICKETS DEL DIA PARA SEGUIMIENTO TECNICO</caption>
<tr><TD colspan="8">
<table>
<tr><td><a class="enlaceboton" href="../../excel/excel_st_listado_ticket.php" onclick="openNewWindowhtml( this, '800', '590' );return false;"><img src="../../img/excel_ico.gif" alt="Ver Listado en Excel" width="16" height="16" border="0" align="absmiddle" /> Ver Todo Listado en Excel </a></td></tr>	
<tr>
	<td class="marco">
	  <form name="form1" method="post" action="#">
	  <span class="title7">Seleccione el dia a ver:</span> 
	  <input name="menos" type="submit" value="&lt;" title="dia anterior"> 
          <input name="mas" type="submit"value="&gt;" title="dia siguiente"> 
          <input name="fecha" type="text" onclick="displayCalendar(this,'yyyy-mm-dd',this)" id="fecha" value="<?=substr($fecha,0,10);?>">
	  <input name="Submit" type="submit" value="Ver">  
	  <? if($nively == 1){  ?>
	  <input onClick="location.href='<?=$link_modulo?>?path=n_ticket.php'" type="button" value="Nuevo Ticket">
	  <? }  ?>
&nbsp;
<?php
	$dias=date("w",mktime(0,0,0,substr($fecha,5,2),substr($fecha,8,2),substr($fecha,0,4)));
	switch($dias)
	  {
	  case 1: echo"<b>LUN</b>";break;
	  case 2: echo"<b>MAR</b>";break;
	  case 3: echo"<b>MIE</b>";break;
	  case 4: echo"<b>JUE</b>";break;
	  case 5: echo"<b>VIE</b>";break;
	  case 6: echo"<b>SAB</b>";break;
	  case 0: echo"<b>DOM</b>";break;		  	  
	  }	  
		  $dia=substr($fecha,8,2);
		  $mes=substr($fecha,5,2);
		  echo", $dia de ";
	switch($mes)
	  {
	  case 1: echo"ENE";break;
	  case 2: echo"FEB";break;
	  case 3: echo"MAR";break;
	  case 4: echo"ABR";break;
	  case 5: echo"MAY";break;
	  case 6: echo"JUN";break;
	  case 7: echo"JUL";break;
	  case 8: echo"AGO";break;
	  case 9: echo"SEP";break;
	  case 10: echo"OCT";break;
	  case 11: echo"NOV";break;
	  case 12: echo"DIC";break;		  	  
	  }
	  echo" ".substr($fecha,0,4);
?>
		</form>
		</td>
		</tr>
</table>
</TD></tr>
<tr>
<th width="2%">N&deg;</th>
<th width="8%">TICKET</th>
<th width="7%">APERTURA</th>			              
<th width="7%">CIERRE</th>
<th width="7%">DURACION</th>
<th width="7%">NOTIFICACION</th> 
<th width="5%">ID NODO</th>
<th width="20%">ESTACION</th>
<th width="5%">TIPO</th>
<th width="12%">PROBLEMA</th>
<!--
<th width="12%">PLAN DE ACCION</th>
<th width="11%">PERSONAL</th>
-->
</tr>
<?php
$consulta = "SELECT id_st_ticket,ticket,idnodo,estacion,fecha_inicio_rif,hora_inicio_rif,fecha_fin_rif,hora_fin_rif,tipo,problema,fecha_not,hora_not,plan_accion,trabajo_realizado,personal,observaciones " .
		    "FROM st_ticket WHERE fecha_inicio_rif='$fecha'"; 
$resultado = mysql_query($consulta);
$filas	   = mysql_num_rows($resultado);

if($filas!=0){ 
	$i=0;
	while($dato=mysql_fetch_array($resultado)){	
		$i++;
		$inicio = $dato['fecha_inicio_rif'].' '.$dato['hora_inicio_rif'];
		$fin 	= $dato['fecha_fin_rif'].' '.$dato['hora_fin_rif'];
		$dif 	= date("H:i", strtotime("00:00") + strtotime($fin) - strtotime($inicio));
		
		/* ------------------------------------------------------ */
		$s  = strtotime($fin)-strtotime($inicio);
		$ss = strtotime($fin)-strtotime($inicio);
		$d = intval($s/86400);
		$s -= $d*86400;
		$h = intval($s/3600);
		$s -= $h*3600;
		$m = intval($s/60);
		$s -= $m*60;
		
		if($dato['fecha_fin_rif']){
			$dif1 = (($d*24)+$h).hrs." ".$m."min";
		}else{
			$dif1 = '';	
		}
		//$dif2= $d.$space.dias." ".$h.hrs." ".$m."min";
		//$dif3= $d.$space.dias." ".$h.hrs." ".$m."min ".$s."seg";
		/* ------------------------------------------------------ */
		
		if($i%2==0) $rowt="#f1f1f1"; else $rowt="#f6f7f8";

		$rif = $dato['id_st_ticket']; 
		if($nively == 1){
			$ticket_html = "<a href='$link_modulo?path=n_ticket.php&rif=$rif'>".$dato['ticket']."</a>";			
		}else{
			$ticket_html = $dato['ticket'];
		}				
						
	echo"
	<tr bgcolor='$rowt' onmouseover=\"setPointer(this, '#DADADA')\" onmouseout=\"setPointer(this, '$rowt')\">
	<td>".$i."</td>
	<td><center>$ticket_html</center></td>
	<td><center>".$dato['fecha_inicio_rif']."<br>".$dato['hora_inicio_rif']."</center></td>
	<td><center>".$dato['fecha_fin_rif']."<br>".$dato['hora_fin_rif']."</center></td>
	<td><center>$dif1</center></td>
	<td><center>".$dato['fecha_not']."<br>".$dato['hora_not']."</center></td>
    <td><center>".$dato['idnodo']."</center></td>
	<td><center>".$dato['estacion']."</center></td>
	<td><center>".$dato['tipo']."</center></td>
	<td><center>".$dato['problema']."</center></td>
	<!--
	<td><center>".$dato['plan_accion']."</center></td>
	<td><center>".$dato['personal']."</center></td>
	-->
	</tr>
	";

	 }
	}
	?>
</table>			  
<link href="../../paquetes/greybox/gb_styles.css" rel="stylesheet" type="text/css" media="all" />
    <script type="text/javascript">
        var GB_ROOT_DIR = "./../../paquetes/greybox/";
    </script>    
	<script type="text/javascript" src="../../paquetes/greybox/AJS.js"></script>
    <script type="text/javascript" src="../../paquetes/greybox/AJS_fx.js"></script>
    <script type="text/javascript" src="../../paquetes/greybox/gb_scripts_no_reload.js"></script>
<link type="text/css" rel="stylesheet" href="../../paquetes/calendar/dhtmlgoodies_calendar/dhtmlgoodies_calendar.css?random=20051112" media="screen"></LINK>
<SCRIPT type="text/javascript" src="../../paquetes/calendar/dhtmlgoodies_calendar/dhtmlgoodies_calendar.js?random=20060118"></script>
