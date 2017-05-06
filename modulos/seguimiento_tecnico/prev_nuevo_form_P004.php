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
	<input type="hidden" name="path" value="prev_nuevo_form_P004_r.php" />
	<input type="hidden" name="idevento" value="<?=$idevento?>" />
	<input type="hidden" name="idformulario" value="<?=$idformulario?>" />
	<input type="hidden" name="params" value="<?=$params?>" />

<table width="900" align="center" class="table2">
	<caption>FORMULARIO DE MANTENIIENTO PREVENTIVO <br /> ENERGIA COMERCIAL</caption>
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
	
	<tr><th colspan="2"><strong class="verde">1.- Relevamiento</strong></th></tr>
	
	<tr>
		<th width="25%">Tiene Energía comercial</th>
		<td width="75%">
			<select name="p01">
				<option value="...">...</option>
				<option value="SI">SI</option>
				<option value="NO">NO</option>
			</select>
		</td>
	</tr>
	<tr>
	  <th width="25%">Empresa distribuidora</th>
	  <td width="75%"><input name="p02" type="text" id="p02" size="15" /></td>
	</tr>
	<tr>
		<th width="25%">Media / baja tensión</th>
		<td width="75%">
			<select name="p03">
				<option value="...">...</option>
				<option value="Media tension">Media tension</option>
				<option value="Baja tension">Baja tension</option>
			</select>
		</td>
	</tr>
	<tr>
		<th width="25%">Monofásico / trifásico</th>
		<td width="75%">
			<select name="p04">
				<option value="...">...</option>
				<option value="Monofasico">Monofasico</option>
				<option value="Trifasico">Trifasico</option>
			</select>
		</td>
	</tr>
	
	
	<tr>
	  <th width="25%">Potencia del transformador KVA</th>
	  <td width="75%"><input name="p05" type="text" id="p05" size="15" /></td>
	</tr>
	<tr>
	  <th width="25%">N. de medidor</th>
	  <td width="75%"><input name="p06" type="text" id="p06" size="15" /></td>
	</tr>
</table>
<br />
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