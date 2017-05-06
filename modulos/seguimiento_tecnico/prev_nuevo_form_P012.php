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
	<input type="hidden" name="path" value="prev_nuevo_form_P012_r.php" />
	<input type="hidden" name="idevento" value="<?=$idevento?>" />
	<input type="hidden" name="idformulario" value="<?=$idformulario?>" />
	<input type="hidden" name="params" value="<?=$params?>" />

	<table width="1000" align="center" class="table2">
	<caption>FORMULARIO DE MANTENIIENTO PREVENTIVO<br />SISTEMA DE PROTECCION</caption>
	<tr>
		<th width="25%">Estación</th>
		<td width="75%" class="resaltar"><? echo $codEs . " - " . $nomEs; ?></td>
	</tr>
	<tr>
		<th width="25%">Titulo</th>
		
		<td width="75%" class="resaltar">
			<input name="titulo" type="text" id="titulo" value="<?=$nombreForm?>" size="70" maxlength="" />
		</td>
	</tr>
	</table>
	<br />
	<table  width="1000" align="center" class="table2">
		<tr><th colspan="12"><strong class="verde">MTTO. DE  SISTEMAS DE PROTECCION:</strong></th></tr>
		<tr>
			<td></td>
			<td align="center" colspan="6">ANTES MTTO.</td>
			<td align="center" colspan="6">DESPUES MTTO.</td>
		</tr>
		<tr align="center">
			<td width='40%' class="cafe">PARARRAYOS</td>
			<td width='6%' class="azul2">No Existe</td>
			<td width='6%'>Malo</td>
			<td width='6%'>Bajo</td>
			<td width='6%'>Medio</td>
			<td width='6%'>Alto</td>
			<td width='6%'>Bueno</td>
			<td width='6%'>Reparado</td>
			<td width='6%'>Ajustado</td>
			<td width='6%'>Cambiado</td>
			<td width='6%'>Pendiente</td>
			<td width='6%'>Otro</td>
		</tr>
		<?
		$text =	"Verificación del estado de pararrayos.;;;;;;;;;;;|".
		"Revisión, limpieza, ajuste, del cable de conexión del pararrayos a las mallas de tierra en la base de la torre.;;;;;;;;;;;|".
		"Revisión, limpieza, ajuste de  conexiones de cables de torres a la malla de tierra;;;;;;;;;;;";

		$arrays = explode('|',$text);
		$result = "";
		$a = 1;
		foreach ($arrays as $array){
			$subarray = explode(';', $array);
			$result .= "<tr align=''>";
			for ($i = 0; $i < sizeof($subarray); $i++) {
				if($i == 0){
					$result .= "<td>$subarray[$i]</td>";
					$result .= "<input name='p01$a' id='p01$a$b' type='hidden' value='$subarray[$i]'>";
				}else{
					if($i == 11)
						$result .= "<td align='center'><input type='text' name='p01$a' size='10'></td>";
					else
						$result .= "<td align='center'><input type='checkbox' name='p01$a' value='$a'></td>";
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
	<table  width="1000" align="center" class="table2">
		<tr>
			<td></td>
			<td align="center" colspan="6">ANTES MTTO.</td>
			<td align="center" colspan="4">DESPUES MTTO.</td>
			<td></td>
		</tr>
		<tr align="center">
			<td width='40%' class="cafe">MALLA DE TIERRA</td>
			<td width='6%' class="azul2">No Existe</td>
			<td width='6%'>Malo</td>
			<td width='6%'>Bajo</td>
			<td width='6%'>Medio</td>
			<td width='6%'>Alto</td>
			<td width='6%'>Bueno</td>
			<td width='6%'>Reparado</td>
			<td width='6%'>Ajustado</td>
			<td width='6%'>Cambiado</td>
			<td width='6%'>Pendiente</td>
			<td width='6%'>Otro</td>
		</tr>
		<?
		//$text =	"Verificación del estado de pararrayos.;;;;;;;;;;;|".
		$text =	"Valor de tierra en la malla ubicada en la base de la torre en Ohms (máximo es 10 Ohm);;;;;;;;;;;|".
		"Valor de tierra en el distribuidor de tierra de la malla alrededor de la sala de equipos (máximo es 10 Ohm);;;;;;;;;;;|".
		"Revisión , limpieza , ajuste de conexiones de cables, jabalinas mediante las  cámaras de inspección;;;;;;;;;;;|".
		"Revisión, limpieza, ajuste de  las conexiones en el distribuidor principal de tierra de la estación;;;;;;;;;;;|".
		"Conexión a tierra de equipos;;;;;;;;;;;|".
		"Revisar, limpiar, ajustar las conexiones a tierra de los equipos , racks, grupos generadores, escalerillas, equipos de energía, tableros de distribución AC;;;;;;;;;;;|".
		"Protectores de Transientes en Baja Tensión;;;;;;;;;;;|".
		"Verificar el estado de  protectores de transientes de baja tensión, mediante su indicador visual;;;;;;;;;;;|".
		"Medida Potencial entre el sistema de tierra y neutro;;;;;;;;;;;|".
		"Medida Potencial entre el neutro y masa;;;;;;;;;;;";

		$arrays = explode('|',$text);
		$result = "";
		$a = 1;
		foreach ($arrays as $array){
			$subarray = explode(';', $array);
			$result .= "<tr align=''>";
			for ($i = 0; $i < sizeof($subarray); $i++) {
				if($i == 0){
					$result .= "<td>$subarray[$i]</td>";
					$result .= "<input name='p02$a' id='p02$a$b' type='hidden' value='$subarray[$i]'>";
				}else{
					if($i == 11)
						$result .= "<td align='center'><input type='text' name='p02$a' size='10'></td>";
					else
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
	<table width="1000" align="center" class="table2" cellspacing="2" class="table2">
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