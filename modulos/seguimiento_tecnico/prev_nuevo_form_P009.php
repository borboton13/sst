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

?>
<form name="amper" method="post" action="<?=$link_modulo_r?>" onSubmit=" return VerifyOne ();">
	<input type="hidden" name="path" value="prev_nuevo_form_P009_r.php" />
	<input type="hidden" name="idevento" value="<?=$idevento?>" />
	<input type="hidden" name="idformulario" value="<?=$idformulario?>" />
	<input type="hidden" name="params" value="<?=$params?>" />

<table width="900" align="center" class="table2">
	<caption>FORMULARIO DE MANTENIIENTO PREVENTIVO <br> RECTIFICADOR</caption>
	<tr>
		<th width="25%">Estación</th>
		<td width="75%" class="resaltar"><? echo $codEs . " - " . $nomEs; ?></td>
	</tr>
	<tr>
		<th width="25%">Titulo</th>
		<td width="75%" class="resaltar"><input name="titulo" type="text" id="titulo" value="<?=$nombreForm?>" size="70" maxlength=""/></td>
	</tr>
	<tr><th colspan="2"><strong class="verde">1.- Relevamiento</strong></th></tr>
	<tr>
	  <th width="25%">Tiene Rectificador</th>
	  <td width="75%">
		  <select name="p01">
			  <option value="...">...</option>
			  <option value="SI">SI</option>
			  <option value="NO">NO</option>
		  </select>
	  </td>
	</tr>
	<tr>
		<th width="25%">Estado</th>
		<td width="75%">
			<select name="p02">
				<option value="...">...</option>
				<option value="En funcionamiento">En funcionamiento</option>
				<option value="En falla">En falla</option>
				<option value="No existe">No existe</option>
			</select>
		</td>
	</tr>

	<tr>
	  <th width="25%">Marca</th>
	  <td width="75%"><input name="p03" type="text" id="marca" size="30" maxlength=""/></td>
	</tr>

	<tr>
		<th width="25%">Modelo</th>
		<td width="75%"><input name="p04" type="text" id="modelo" size="30" maxlength=""/></td>
	</tr>

	<tr>
		<th width="25%">Serie</th>
		<td width="75%"><input name="p05" type="text" id="serie" size="30" maxlength=""/></td>
	</tr>

	<tr>
		<th width="25%">Voltaje (V)</th>
		<td width="75%"><input name="p06" type="text" id="voltaje" size="10" maxlength=""/></td>
	</tr>

	<tr>
		<th width="25%">Capacidad (KVA)</th>
		<td width="75%"><input name="p07" type="text" id="capacidad" size="10" maxlength=""/></td>
	</tr>

	<tr>
		<th width="25%">Cantidad de módulos</th>
		<td width="75%"><input name="p08" type="text" id="modulos" size="10" maxlength=""/></td>
	</tr>
</table>
<br />
<table  width="900" align="center" class="table2">
	<tr align="center">
		<td width='20%'></td>
		<td colspan="3"><b>ANTES MTTO.</b></td>
		<td colspan="3"><b>DESPUES MTTO.</b></td>
	</tr>

	<tr align="center">
		<td width='20%'></td>
		<td>Fase 1</td>
		<td>Fase 2</td>
		<td>Fase 3</td>

		<td>Fase 1</td>
		<td>Fase 2</td>
		<td>Fase 3</td>
	</tr>
	<?
	$text =	"Voltaje AC de Entrada [V];;;;;;|".
			"Corriente de Entrada [A];;;;;;|".
			"Voltaje DC de Salida [V];;;;;;|".
			"Corriente DC de Salida [A];;;;;;";

	$arrays = explode('|',$text);
	$result = "";
	$a = 1;
	foreach ($arrays as $array){
		$subarray = explode(';', $array);
		$result .= "<tr align='center'>";
		for ($i = 0; $i < sizeof($subarray); $i++) {
			if($i == 0){
				$result .= "<td>$subarray[$i]</td>";
				$result .= "<input name='$a' id='$a$b' type='hidden' value='$subarray[$i]'>";
			}else{
				$result .= "<td><input name='$a' type='text' id='$a$b' value='$subarray[$i]' size='7'/></td>";
			}
			$a++;
		}
		$result .= "</tr>";
	}
	echo $result;
	?>
	<input type="hidden" name="size" value="<?=$a?>" />
	<tr><td width='20%'></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
</table>
<br />
<table  width="900" align="center" class="table2">
	<tr>
		<td width="50%">Corriente DC hacia la carga técnica de la estación [A]</td>
		<td width="50%"><input name="p10" type="text" id="marca" size="10" maxlength=""/></td>
	</tr>
	<tr>
		<td width="50%">Corriente DC hacia el banco de baterías de la estación [A]</td>
		<td width="50%"><input name="p11" type="text" id="marca" size="10" maxlength=""/></td>
	</tr>

	<tr>
		<td width="50%">Configuración de Parametros</td>
		<td width="50%">
			<select name="p12">
				<option value="...">...</option>
				<option value="SI">SI</option>
				<option value="NO">No</option>
			</select>
		</td>
	</tr>

	<tr>
		<td width="50%">Verificar y controlar la distribución de AC/DC en tableros</td>
		<td width="50%">
			<select name="p13">
				<option value="...">...</option>
				<option value="Equilibrado">Equilibrado</option>
				<option value="Desequilibrado">Desequilibrado</option>
			</select>
		</td>
	</tr>

	<tr>
		<td width="50%">Revisión de sobrecalentamiento del cableado en AC/DC</td>
		<td width="50%">
			<select name="p14">
				<option value="...">...</option>
				<option value="Normal">Normal</option>
				<option value="Caliente">Caliente</option>
			</select>
		</td>
	</tr>

	<tr>
		<td width="50%">Alarmas Activas</td>
		<td width="50%">
			<select name="p15">
				<option value="...">...</option>
				<option value="SI">SI</option>
				<option value="NO">NO</option>
			</select>
		</td>
	</tr>
</table>
<table width="900" align="center" class="table2" cellspacing="2" class="table2">
	<tr>
		<td>
			<input name="guardar" type="submit"  value="Guardar" />
			<input type="button" name="Submit" value="<< Atras" onclick="javascript:history.back(1)" />
		</td>
	</tr>
</table>
</form>

<!--<form name="amper" method="post" action="<?/*=$link_modulo*/?>?path=cronograma_prev.php">
<input name="centro" id="centro" type="hidden" value="<?/*=$codCentro*/?>">
<input name="anio" id="anio" type="hidden" value="<?/*=$anio*/?>">
<input name="mes" id="mes" type="hidden" value="<?/*=$mes*/?>">
<table width="900" align="center" class="table2" cellspacing="2" class="table2">
	<tr>
	<td><input name="atras" type="submit"  value="Guardar" /></td>
	</tr>
</table>
</form>-->

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