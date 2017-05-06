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

$opTieneAire = array("...", "SI", "NO");
$opEstado 	= array("...", "En funcionamiento", "En falla", "No existe");
$opTipo 	= array("...", "Split", "Mochila", "Ventana");

?>
<form name="amper" method="post" action="<?=$link_modulo_r?>" onSubmit=" return VerifyOne ();">
	<input type="hidden" name="path" value="prev_nuevo_form_P010_r.php" />
	<input type="hidden" name="idevento" value="<?=$idevento?>" />
	<input type="hidden" name="idformulario" value="<?=$idformulario?>" />
	<input type="hidden" name="params" value="<?=$params?>" />

	<table width="900" align="center" class="table2">
	<caption>FORMULARIO DE MANTENIIENTO PREVENTIVO<br />AIRE CONDICIONADO</caption>
	<tr>
		<th width="25%">Estación</th>
		<td width="75%" class="resaltar"><? echo $codEs . " - " . $nomEs; ?></td>
	</tr>
	<tr>
		<th width="25%">Titulo</th>
		
		<td width="75%" class="resaltar">
			<input name="titulo" type="text" id="titulo" value="<?=$nombreForm?>" size="70" />
		</td>
	</tr>
	</table>
	<br />
	<table  width="900" align="center" class="table2">
		<tr><th colspan="12"><strong class="verde">1.- Relevamiento</strong></th></tr>

		<tr align="center">
			<td width='40%'></td>
			<td width='30%'>Equipo 1</td>
			<td width='30%'>Equipo 2</td>
		</tr>
		<?
		$text =	"Tiene Aire Acondicionado;;|".
				"Estado;;|".
				"Marca;;|".
				"Modelo;;|".
				"Serie;;|".
				"Voltaje (V);;|".
				"Capacidad (BTU);;|".
				"Tipo;;";

		$arrays = explode('|',$text);
		$result = "";
		$a = 1;
		foreach ($arrays as $array){
			$subarray = explode(';', $array);
			$result .= "<tr align=''>";
			for ($i = 0; $i < sizeof($subarray); $i++) {
				switch($a){
					case 1:
					case 4:
					case 7:
					case 10:
					case 13:
					case 16:
					case 19:
					case 22: 	$result .= "<td>$subarray[$i]</td>";
							 	$result .= "<input name='p01$a' type='hidden' value='$subarray[$i]'>";
							 	break;
					case 2:
					case 3: 	$result .= "<td align='center'><select name='p01$a'>";
								foreach($opTieneAire as $opcion){
									$result .= "<option value='$opcion'>$opcion</option>";
			  					}
								$result .= "</select></td>";
								break;
					case 5:
					case 6: 	$result .= "<td align='center'><select name='p01$a'>";
								foreach($opEstado as $opcion){
									$result .= "<option value='$opcion'>$opcion</option>";
								}
								$result .= "</select></td>";
								break;
					case 23:
					case 24: 	$result .= "<td align='center'><select name='p01$a'>";
								foreach($opTipo as $opcion){
									$result .= "<option value='$opcion'>$opcion</option>";
								}
								$result .= "</select></td>";
								break;
					default: 	$result .= "<td align='center'><input type='text' name='p01$a' value='$subarray[$i]' size='15'/></td>";
				}
				$a++;
			}
			$result .= "</tr>";
		}
		echo $result;
		?>
		<input type="hidden" name="size1" value="<?=$a?>" />
	</table>
	<br />
	<table  width="900" align="center" class="table2">
		<tr>
			<td></td>
			<td align="center" colspan="4">ANTES MANTENIMIENTO</td>
			<td align="center" colspan="4">DESPUES MANTENIMIENTO</td>

		</tr>
		<tr align="center">
			<td width='48%'></td>
			<td width='6%'>Malo</td>
			<td width='6%'>Bajo</td>
			<td width='6%'>Medio</td>
			<td width='6%'>Alto</td>

			<td width='7%'>Reparado</td>
			<td width='7%'>Ajustado</td>
			<td width='7%'>Cambiado</td>
			<td width='7%'>Pendiente</td>
		</tr>
		<?
		$text =	"Medición de la temperatura ambiente de salas de equipos;;;;;;;;|".
				"Medición de la temperatura ambiente de salas de baterías / Energía;;;;;;;;|".
				"Limpieza de filtros de los equipos de aire acondicionado y ventiladores;;;;;;;;|".
				"Verificación del funcionamiento de equipos de aire acondicionado;;;;;;;;|".
				"Verificación del funcionamiento de ventiladores AC/DC;;;;;;;;|".
				"Presencia de ruido en el funcionamiento de ventiladores AC/DC;;;;;;;;|".
				"Verificación del funcionamiento de extractores de aire;;;;;;;;";

		$arrays = explode('|',$text);
		$result = "";
		$a = 1;
		foreach ($arrays as $array){
			$subarray = explode(';', $array);
			$result .= "<tr align=''>";
			for ($i = 0; $i < sizeof($subarray); $i++) {
				if($i == 0){
					$result .= "<td>$subarray[$i]</td>";
					$result .= "<input name='p02$a' type='hidden' value='$subarray[$i]'>";
				}else{
					$result .= "<td align='center'><input type='checkbox' name='p02$a' value='$a'></td>";
				}
				$a++;
			}
			$result .= "</tr>";
		}
		echo $result;
		?>
		<input type="hidden" name="size2" value="<?=$a?>" />
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