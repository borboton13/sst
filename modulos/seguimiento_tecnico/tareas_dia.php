<?
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
<caption>
TAREAS DEL DIA PARA SEGUIMIENTO TECNICO
</caption>
<tr><TD colspan="7">
<table>	
<tr>
	<td class="marco">
		<form name="form1" method="post" action="#">
	  <span class="title7">Seleccione el dia a ver:</span> 
	  <input name="menos" type="submit" value="&lt;" title="dia anterior"> 
	  <input name="mas" type="submit"value="&gt;" title="dia siguiente"> 
	  <input name="fecha" type="text" onclick="displayCalendar(this,'yyyy-mm-dd',this)" id="fecha" value="<?=substr($fecha,0,10);?>">
	  <input name="Submit" type="submit" value="Ver">  
&nbsp;
<?
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
		</form></td>	
	</tr>
</table>
</TD></tr>
<tr>
<th width="2%">N&deg;</th>
<th width="4%">DIA</th>
<th width="7%">FECHA</th>			              
<th width="13%">RESPONSABLE</th>
<th width="17%">ESTADO</th> 
<th width="46%">CLIENTE, PRODUCTO/SERVICIO Y LUGAR </th>
<th width="9%">SEGUIMIENTO</th>
</tr>
	<? 
	$consulta="SELECT dia,date_format(fecha,'%d/%m/%y'),responsable,condicion_final,departamento,razon_social,producto,marca,caracteristicas,ubicacion,id_item,id_st_proyecto,date_format(hora_programada,'%H:%i'),postm_condicion_final FROM v_st_cronograma WHERE fecha='$fecha'";
	$resultado=mysql_query($consulta);
	$filas=mysql_num_rows($resultado);
	if($filas!=0)
	{ $i=0;
	while($dato=mysql_fetch_array($resultado))
	 {
	 $dia=$dato[0]; 
	 $fecha=$dato[1]; 
	 $responsable=$dato[2]; 
	 $condicion_final=$dato[3]; 
	 $departamento=$dato[4]; 
	 $razon_social=$dato[5]; 
	 $producto=$dato[6];
	 $marca=$dato[7];
	 $caracteristicas=$dato[8];
	 $ubicacion=$dato[9];
	 $id_item=$dato[10]; 
	 $nro=$dato[11];
	 $hora_p=$dato[12];
	 $postm_condicion_final=$dato[13];  
	 $i++;
	 
	switch($condicion_final){
	case 'OK' : $img="<img src='../../img/semaforo_verde.gif' border=\"0\" width=\"46\" height=\"16\" align=\"absmiddle\">"; break;
	case 'Pendiente' : 
	if($postm_condicion_final=="OK+") {
	$img="<img src='../../img/semaforo_azul.gif' border=\"0\" width=\"62\" height=\"16\" align=\"absmiddle\" alt='Estado: OK'>";
	$condicion_final=$postm_condicion_final;
	}		
		else $img="<img src='../../img/semaforo_amarillo.gif' border=\"0\" width=\"46\" height=\"16\" align=\"absmiddle\">"; break;
	case 'Irreparable' : 
	if($postm_condicion_final=="OK+") {
	$img="<img src='../../img/semaforo_azul.gif' border=\"0\" width=\"62\" height=\"16\" align=\"absmiddle\" alt='Estado: OK'>";
	$condicion_final=$postm_condicion_final;
	}		
		else $img="<img src='../../img/semaforo_rojo.gif' border=\"0\" width=\"46\" height=\"16\" align=\"absmiddle\">"; break;
default: $img="Inicial <img src='../../img/ico_reloj.gif' alt='Esperando próxima fecha' border=\"0\">";
	}
	if($i%2==0) $rowt="#f1f1f1";
	 else $rowt="#f6f7f8";
	 
	echo"
	<tr bgcolor='$rowt' onmouseover=\"setPointer(this, '#DADADA')\" onmouseout=\"setPointer(this, '$rowt')\">
	<td>".$i."</td>
	<td><center><span class='title'>".$dia."</span></center></td>
	<td><center>".$fecha."<BR>".$hora_p."</center></td>
	<td>".$responsable."</td>
	<td><center><span class='title6'>".$condicion_final."</span> ".$img."</center></td>
	<td>
	<b>Cliente:</b> <span class='title7'>".$razon_social."</span><br><span class='title5'><b>Departamento:</b></span> <span class='verde'><b>".$departamento."</b></span><br><span class='title5'>
	<b>Producto: <span class='cafe'>".$producto."</span></b><br>
	<b>Marca:</b> ".$marca."<br>
	<b>Caracteristicas:</b> ".$caracteristicas."<br>
	<b>Ubicacion:</b> ".$ubicacion."</span>
	</td>
	<td><center><a href='".$link_modulo_r."?path=trabajos_visitas_ver.php&id_item=".$id_item."'  onclick=\"return GB_showCenter('Ver Actividades', this.href,460, 460)\" class='enlaceboton'><img src='../../img/glyphs_info.gif' alt='Dar Informe' border=\"0\">Informe</a></center></td>
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
