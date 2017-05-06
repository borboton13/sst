<?php
$web=$_SESSION["web"];

if (isset($_GET['idevento']))   $idevento     = $_GET['idevento'];
if (isset($_GET['idform']))     $idformulario = $_GET['idform'];
if (isset($_GET['nombreForm'])) $nombreForm   = $_GET['nombreForm'];

$resultado = mysql_query("
SELECT ev.idevento, ev.estado, ev.inicio, ev.fin, es.codigo as codigoest, es.nombre as nombreest, g.codigo AS codigog, c.idcentro, c.codigo as codCentro
FROM evento ev
JOIN estacion es ON ev.idestacion = es.idestacion
JOIN grupo g 	 ON ev.idgrupo = g.idgrupo
JOIN centro c    ON ev.idcentro = c.idcentro
WHERE ev.idevento = '$idevento' ");

$dato = mysql_fetch_array($resultado);

$arr = explode('-', $dato['inicio']);

$anio			= $arr[0];
$codCentro 		= $dato['codCentro'];
$ini			= $dato['inicio'];
$fin			= $dato['fin'];
$idev 			= $idevento;
$codEs			= $dato['codigoest'];
$nomEs 			= $dato['nombreest'];

$params = "&anio=$anio&codCentro=$codCentro&ini=$ini&fin=$fin&idev=$idev&codEs=$codEs&nomEs=$nomEs";
$opP03 = array("...", "B", "D", "M", "N/A");
$opP04 = $opP03;
$opP05 = array("...", "S", "N", "N/A");

?>
<form name="amper" method="post" action="<?=$link_modulo_r?>" onSubmit=" return VerifyOne ();">
	<input type="hidden" name="path" value="prev_nuevo_form_P018_r.php" />
	<input type="hidden" name="idevento" value="<?=$idevento?>" />
	<input type="hidden" name="idformulario" value="<?=$idformulario?>" />
	<input type="hidden" name="params" value="<?=$params?>" />

<table width="900" align="center" class="table2">
	<caption>FORMULARIO DE MANTENIIENTO PREVENTIVO<br>NODOS OPTICOS , ADSL Y DATOS</caption>
	<tr>
		<th width="25%">Estación</th>
		<td colspan="3" width="75%" class="resaltar"><? echo $codEs . " - " . $nomEs; ?></td>
	</tr>
	<tr>
		<th width="25%">Titulo</th>
		<td colspan="3" width="75%" class="resaltar"><input name="titulo" type="text" id="titulo" value="<?=$nombreForm?>" size="70" /></td>
	</tr>
	<tr><td colspan="4"></td></tr>

	<tr>
		<th width="25%">HORA DE INICIO:</th>
		<td width="25%"><input class="Text_left" name="p01" type="text" size="15" />&nbsp;00:00</td>
		<th width="25%">HORA DE CONCLUSION:</th>
		<td width="25%"><input class="Text_left" name="p02" type="text" size="15" />&nbsp;00:00</td>
	</tr>

</table>
<br />
<table  width="900" align="center" class="table2">
	<tr>
		<td colspan="3"><span class="verde">LIMPIEZA, INSPECCION DE LA INFRAESTRUCTURA EXTERNA:</span></td>
		<td colspan="2">B=BUENO &nbsp;&nbsp; D=DEGRADADO &nbsp;&nbsp; M=MALO &nbsp;&nbsp; N/A=NO APLICA</td>
	</tr>
	<tr align="center">
		<td width='5%' class="cafe">N.ITEM</td>
		<td width='40%' class="cafe">DESCRIPCION DEL ITEM</td>
		<td width='15%' class="cafe">ESTADO DE CONSERVACION</td>
		<td width='15%' class="cafe">DESPUES DE LA INTERVENCION</td>
		<td width='25%' class="cafe">OBSERVACIONES</td>
	</tr>
	<?
	$text =	"1;ESTRUCTURA EXTERIOR (CARCAZA);;;|".
			"2;PINTURA;;;";
	$arrays = explode('|',$text);
	$result = "";
	$a = 1;
	foreach ($arrays as $array){
		$subarray = explode(';', $array);
		$result .= "<tr>";
		for ($i = 0; $i < sizeof($subarray); $i++) {
			switch($i){
				case 0:
				case 1: $result .= "<td>$subarray[$i]</td>";
						$result .= "<input name='p03$a' type='hidden' value='$subarray[$i]'>";
						break;
				case 2:
				case 3: $result .= "<td align='center'><select name='p03$a' class='selectbuscar'>";
						foreach($opP03 as $opcion)
							$result .= "<option value='$opcion'>$opcion</option>";
						$result .= 	"</select></td>";
						break;
				default: $result .= "<td align='center'><input class='Text_left' type='text' name='p03$a' value='$subarray[$i]' size='25'/></td>";
			}
			$a++;
		}
		$result .= "</tr>";
	}
	echo $result;
	?>
	<input type="hidden" name="size3" value="<?=$a?>" />
</table>
<br />
<table  width="900" align="center" class="table2">
		<tr>
			<td colspan="3"><span class="verde">INSPECCION DE LA INFRAESTRUCTURA INTERNA:</span></td>
			<td colspan="2">B=BUENO &nbsp;&nbsp; D=DEGRADADO &nbsp;&nbsp; M=MALO &nbsp;&nbsp; N/A=NO APLICA</td>
		</tr>
		<tr align="center">
			<td width='5%' class="cafe">N.ITEM</td>
			<td width='40%' class="cafe">DESCRIPCION DEL ITEM</td>
			<td width='15%' class="cafe">ESTADO DE CONSERVACION</td>
			<td width='15%' class="cafe">DESPUES DE LA INTERVENCION</td>
			<td width='25%' class="cafe">OBSERVACIONES</td>
		</tr>
		<?
		$text =	"3;ESTADO GENERAL DEL EQUIPAMIENTO;;;|".
				"4;INTERIOR: MUX , SDH , MODEMS ,EQUIPOS IPNGN, ETC.;;;|".
				"5;CABLEADO ( FIBRA Y COBRE);;;|".
				"6;ESTADO D.D.F. Y CONECTORES;;;|".
				"7;SENSORES DE ALARMAS;;;|".
				"8;PROTECTORES DE TRANSIENTES;;;|".
				"9;PROTECTORES DE LINEAS DE ABONADOS;;;";
		$arrays = explode('|',$text);
		$result = "";
		$a = 1;
		foreach ($arrays as $array){
			$subarray = explode(';', $array);
			$result .= "<tr>";
			for ($i = 0; $i < sizeof($subarray); $i++) {
				switch($i){
					case 0:
					case 1: $result .= "<td>$subarray[$i]</td>";
						$result .= "<input name='p04$a' type='hidden' value='$subarray[$i]'>";
						break;
					case 2:
					case 3: $result .= "<td align='center'><select name='p04$a' class='selectbuscar'>";
						foreach($opP04 as $opcion)
							$result .= "<option value='$opcion'>$opcion</option>";
						$result .= 	"</select></td>";
						break;
					default: $result .= "<td align='center'><input class='Text_left' type='text' name='p04$a' value='$subarray[$i]' size='25'/></td>";
				}
				$a++;
			}
			$result .= "</tr>";
		}
		echo $result;
		?>
		<input type="hidden" name="size4" value="<?=$a?>" />
</table>
<br />
<table  width="900" align="center" class="table2">
		<tr>
			<td colspan="3"><span class="verde"></span></td>
			<td colspan="2" align="center">S=SI &nbsp;&nbsp; N=NO &nbsp;&nbsp; N/A=NO APLICA</td>
		</tr>
		<tr align="center">
			<td width='5%' class="cafe">N.ITEM</td>
			<td width='40%' class="cafe">DESCRIPCION DEL ITEM</td>
			<td width='15%' class="cafe">ESTADO DE CONSERVACION</td>
			<td width='15%' class="cafe">DESPUES DE LA INTERVENCION</td>
			<td width='25%' class="cafe">OBSERVACIONES</td>
		</tr>
		<?
		$text =	"10;POLVO INTERIOR;;;|".
				"11;ALARMAS SOBRE TARJETAS;;;|".
				"12;ALARMAS DE UPS;;;|".
				"13;ALARMAS DE RECTIFICADOR;;;|".
				"14;REPORTE  ALARMAS AL NOC (AC-BAT- RECTIF);;;|".
				"15;EXISTEN F.O. DE RESERVA?;;;";
		$arrays = explode('|',$text);
		$result = "";
		$a = 1;
		foreach ($arrays as $array){
			$subarray = explode(';', $array);
			$result .= "<tr>";
			for ($i = 0; $i < sizeof($subarray); $i++) {
				switch($i){
					case 0:
					case 1: $result .= "<td>$subarray[$i]</td>";
						$result .= "<input name='p05$a' type='hidden' value='$subarray[$i]'>";
						break;
					case 2:
					case 3: $result .= "<td align='center'><select name='p05$a' class='selectbuscar'>";
						foreach($opP05 as $opcion)
							$result .= "<option value='$opcion'>$opcion</option>";
						$result .= 	"</select></td>";
						break;
					default: $result .= "<td align='center'><input class='Text_left' type='text' name='p05$a' value='$subarray[$i]' size='25'/></td>";
				}
				$a++;
			}
			$result .= "</tr>";
		}
		echo $result;
		?>
		<input type="hidden" name="size5" value="<?=$a?>" />
</table>
<br />
<table  width="900" align="center" class="table2">
		<tr><th colspan="5" class="verde">MEDICION DE PARAMETROS:</th></tr>
		<tr><td colspan="5" class="cafe">TARJETAS,EQUIPOS Y MODULOS INSTALADOS:</td></tr>
		<tr align="center">
			<td width='5%' class="cafe">N.ITEM</td>
			<td width='20%' class="cafe">DESCRIPCION</td>
			<td width='70%' class="cafe">OBSERVACIONES</td>
		</tr>
		<?
		$text =	"16;TARJETAS;|".
				"17;MODULOS;|".
				"18;MATERIALES;|".
				"19;RECTIFICADORES;";
		$arrays = explode('|',$text);
		$result = "";
		$a = 1;
		foreach ($arrays as $array){
			$subarray = explode(';', $array);
			$result .= "<tr>";
			for ($i = 0; $i < sizeof($subarray); $i++) {
				switch($i){
					case 0:
					case 1: $result .= "<td>$subarray[$i]</td>";
						$result .= "<input name='p06$a' type='hidden' value='$subarray[$i]'>";
						break;
					default: $result .= "<td align='center'><input class='Text_left' type='text' name='p06$a' value='$subarray[$i]' size='85'/></td>";
				}
				$a++;
			}
			$result .= "</tr>";
		}
		echo $result;
		?>
		<input type="hidden" name="size6" value="<?=$a?>" />
</table>
<br />
<table  width="900" align="center" class="table2">
		<tr><td colspan="5" class="cafe">REQUERIMIENTOS PENDIENTES:</td></tr>
		<tr align="center">
			<td width='5%' class="cafe">N.ITEM</td>
			<td width='20%' class="cafe">DESCRIPCION</td>
			<td width='70%' class="cafe">OBSERVACIONES</td>
		</tr>
		<?
		$text =	"20;TARJETAS;|".
				"21;MODULOS;|".
				"22;MATERIALES;";
		$arrays = explode('|',$text);
		$result = "";
		$a = 1;
		foreach ($arrays as $array){
			$subarray = explode(';', $array);
			$result .= "<tr>";
			for ($i = 0; $i < sizeof($subarray); $i++) {
				switch($i){
					case 0:
					case 1: $result .= "<td>$subarray[$i]</td>";
						$result .= "<input name='p07$a' type='hidden' value='$subarray[$i]'>";
						break;
					default: $result .= "<td align='center'><input class='Text_left' type='text' name='p07$a' value='$subarray[$i]' size='85'/></td>";
				}
				$a++;
			}
			$result .= "</tr>";
		}
		echo $result;
		?>
		<input type="hidden" name="size7" value="<?=$a?>" />
</table>
<br />
<table  width="900" align="center" class="table2">
		<tr>
			<td width='10%' align="center" class="cafe">NOTA:</td>
			<td width='80%'>A LA CONCLUSION DEL TRABAJO, EL PERSONAL DE MANTENIMIENTO DEBE CONTACTARSE CON EL CENTRO DE GESTION, PARA VERIFICAR EL CORRECTO FUNCIONAMIENTO DEL NODO</td>
		</tr>
</table>
<br />
<table  width="900" align="center" class="table2">
		<tr>
			<td width='20%' align="center" class="cafe">CRITICIDADES:</td>
			<td width='70%' align="center"><input class="Text_left" name="p08" type="text" size="80" /></td>
		</tr>
		<tr>
			<td width='20%' align="center" class="cafe">TRABAJOS PENDIENTES: </td>
			<td width='70%' align="center"><input class="Text_left" name="p09" type="text" size="80" /></td>
		</tr>
</table>
<br />
<table width="900" align="center" class="table2" cellspacing="2" class="table2">
	<tr>
		<td>
			<input name="guardar" type="submit"  value="Guardar" />
			<input type="button" name="Submit" value="<< Atras" onclick="javascript:history.back(1)" />
		</td>
	</tr>
</table>
</form>


<script type="text/javascript" src="../../paquetes/autocompletar/ajax.js"></script>
<script type="text/javascript" src="../../paquetes/autocompletar/ajax-dynamic-list.js"></script>
<link href="../../paquetes/autocompletar/ajax-dynamic-list.css" rel="stylesheet" type="text/css" />
<SCRIPT src="../../js/epoch_classes.js" type=text/javascript></SCRIPT>
<LINK href="../../css/epochprime_styles.css" type=text/css rel=stylesheet />
<script src="../../paquetes/nicEdit/nicEdit.js" type="text/javascript"></script>             

<script type=text/javascript>
bkLib.onDomLoaded(function() {
	new nicEditor({buttonList : ['removeformat','bold','italic','underline','html']}).panelInstance('obs');
});
</script>
<script type=text/javascript>
var calendar;
var calendarb;
window.onload = function() {
	calendar = new Epoch('dp_cal','popup',document.getElementById('fecha_ini'));
	calendarb = new Epoch('dp_cal','popup',document.getElementById('fecha_fin'));
}
</script>  

<script type="text/javascript">var GB_ROOT_DIR = "./../../paquetes/greybox/";</script>
<script type="text/javascript" src="../../paquetes/greybox/AJS.js"></script>
<script type="text/javascript" src="../../paquetes/greybox/AJS_fx.js"></script>
<script type="text/javascript" src="../../paquetes/greybox/gb_scripts_no_reload.js"></script>
<link href="../../paquetes/greybox/gb_styles.css" rel="stylesheet" type="text/css" media="all" />
<link href="../../paquetes/tooltip/tooltip.css" rel="stylesheet" type="text/css">
<script language=javascript type="text/javascript" src="../../paquetes/tooltip/tooltip.js"></script>

<script src="../../js/validador.js" type=text/javascript></script>
<script type="text/javascript">
function VerifyOne () {
    if( checkField( document.amper.cliente, isName, false ) &&
	    isNull( document.amper.fecha_ini) &&
		isNull( document.amper.obs) 
		)
		{
			if(confirm("Verifico bien los datos antes de continuar?"))
			{return true;}
			else {return false;}
    }
else {	
return false;
     }
}
</script>