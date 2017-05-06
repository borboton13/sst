<?php
$web=$_SESSION["web"];

if (isset($_GET['idevento']))   $idevento     = $_GET['idevento'];
if (isset($_GET['idform']))     $idformulario = $_GET['idform'];
if (isset($_GET['idformtto'])) $idformtto 	= $_GET['idformtto'];
if (isset($_GET['nombreForm'])) $nombreForm   = $_GET['nombreForm'];
if (isset($_GET['params']))       $params	= base64_decode($_GET['params']);

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

//$params = "&anio=$anio&codCentro=$codCentro&ini=$ini&fin=$fin&idev=$idev&codEs=$codEs&nomEs=$nomEs";

$resultQuery = mysql_query("SELECT * FROM formulario_p015 p WHERE p.id = ".$idformtto);
$result      = mysql_fetch_array($resultQuery);

$titulo = $result['titulo'];
$p01	= $result['p01'];
$p02	= $result['p02'];
$p03	= $result['p03'];
$p04	= $result['p04'];
$p05	= $result['p05'];

$opP01 = array("...", "SI", "NO");
$opEstado = array("...", "En funcionamiento", "En falla");

?>
<form name="amper" method="post" action="<?=$link_modulo_r?>" onSubmit=" return VerifyOne ();">
	<input type="hidden" name="path" value="prev_nuevo_form_P015_r.php" />
	<input type="hidden" name="idevento" value="<?=$idevento?>" />
	<input type="hidden" name="idformulario" value="<?=$idformulario?>" />
	<input type="hidden" name="params" value="<?=$params?>" />
	<input type="hidden" name="idformtto" value="<?=$idformtto?>" />

<table width="1000" align="center" class="table2">
	<caption>FORMULARIO DE MANTENIIENTO PREVENTIVO<br>EQUIPOS DE RADIO ENLACE</caption>
	<tr>
		<th width="25%">Estación</th>
		<td width="75%" class="resaltar"><? echo $codEs . " - " . $nomEs; ?></td>
	</tr>
	<tr>
		<th width="25%">Titulo</th>
		<td width="75%" class="resaltar"><input name="titulo" type="text" id="titulo" value="<?=$titulo?>" size="70" /></td>
	</tr>
	<tr><th colspan="2"><strong class="verde">1.- Relevamiento</strong></th></tr>
	<tr>
	  <th width="25%">Se tiene equipo Radio Enlace?</th>
	  <td width="75%">
		  <select name="p01" class='selectb'>
			  <?
			  foreach($opP01 as $opcion){
				  echo '<option value="'.$opcion.'" ';
				  if($opcion == $p01) echo 'selected';
				  echo'>'.$opcion.'</option>';
			  }
			  ?>
		  </select>
	  </td>
	</tr>
</table>
<br />
<table  width="1000" align="center" class="table2">
		<tr align="center">
			<td width='2%'>Equipo</td>
			<td width='8%'>Estado</td>
			<td width='8%'>Fabricante</td>
			<td width='8%'>Modelo</td>
			<td width='25%' class="verde">Radioenlace MW</td>
			<td width='8%'>ID Sitio salto radio enlace</td>
			<td width='8%' class="verde">Frecuencia Tx (Ghz)</td>
			<td width='8%' class="verde">Frecuencia Rx (Ghz)</td>
			<td width='8%' class="verde">Topología Radio MW  1+1, 1+0, 2+0, XPIC, HTBY</td>
			<td width='4%'>Azimut</td>
			<td width='5%'>Diametro antena</td>
			<td width='5%'>Altura antena</td>
		</tr>
		<?
		$text =	"1;;;;;;;;;;;|".
				"2;;;;;;;;;;;|".
				"3;;;;;;;;;;;|".
				"4;;;;;;;;;;;|".
				"5;;;;;;;;;;;|".
				"6;;;;;;;;;;;|".
				"7;;;;;;;;;;;|".
				"8;;;;;;;;;;;|".
				"9;;;;;;;;;;;|".
				"10;;;;;;;;;;;|".
				"11;;;;;;;;;;;|".
				"12;;;;;;;;;;;|".
				"13;;;;;;;;;;;|".
				"14;;;;;;;;;;;|".
				"15;;;;;;;;;;;";
		$text = $p02;
		$arrays = explode('|',$text);
		$result = "";
		$a = 1;
		foreach ($arrays as $array){
			$subarray = explode(';', $array);
			$result .= "<tr>";
			for ($i = 0; $i < sizeof($subarray); $i++) {
				switch($i){
					case 0: $result .= "<td align='center'>$subarray[$i]</td>";
							$result .= "<input name='p02$a' type='hidden' value='$subarray[$i]'>";
						break;
					case 1: $result .= "<td align='center'><select name='p02$a' class='selectb'>";
						/*foreach($opEstado as $opcion)
							$result .= "<option value='$opcion'>$opcion</option>";*/
						foreach($opEstado as $opcion){
							$result .= '<option value="'.$opcion.'" ';
							if($opcion == $subarray[$i]) $result .= 'selected';
							$result .='>'.$opcion.'</option>';
						}

						$result .= 	"</select></td>";
						break;
					case 2:
					case 3:	$result .= "<td align='center'><input type='text' class='Text_left' name='p02$a' value='$subarray[$i]' size='8'/></td>";
							break;
					case 4:	$result .= "<td align='center'><input type='text' class='Text_left' name='p02$a' value='$subarray[$i]' size='30'/></td>";
							break;
					case 9:
					case 10:
					case 11:	$result .= "<td align='center'><input type='text' class='Text_left' name='p02$a' value='$subarray[$i]' size='2'/></td>";
								break;
					default: $result .= "<td align='center'><input type='text' class='Text_left' name='p02$a' value='$subarray[$i]' size='8'/></td>";
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
<table  width="1000" align="center" class="table2">
		<tr><th colspan="3"><strong class="verde">2.- Mantenimiento Preventivo</strong></th></tr>

		<tr align="center">
			<td width='50%'></td>
			<td width='50%' class="cafe">Revisado</td>
		</tr>
		<?
		$text =	"Verificar la instalación del Equipo;|".
				"Verificar soportes de antena (vertical/Horizontal);|".
				"Verificar pintado  referencial de azimut (soporte vertical);|".
				"Verificar  estabilidad de antena parabolica;|".
				"Verificar conectores y bulcanizados;|".
				"Verificar que los cables de energía y aterramiento no esten dañados o rotos;";
		$text = $p03;
		$arrays = explode('|',$text);
		$result = "";
		$a = 1;
		foreach ($arrays as $array){
			$subarray = explode(';', $array);
			$result .= "<tr align=''>";
			for ($i = 0; $i < sizeof($subarray); $i++) {
				if($i == 0){
					$result .= "<td>$subarray[$i]</td>";
					$result .= "<input name='p03$a' type='hidden' value='$subarray[$i]'>";
				}else{
					//$result .= "<td align='center'><input type='checkbox' name='p03$a' value='$a'></td>";
					$result .= "<td align='center'><input type='checkbox' name='p03$a' value='$a'";
					if($subarray[$i] == $a) $result .= "checked";
					$result .= " ></td>";
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
	<table  width="1000" align="center" class="table2">
		<tr><td colspan="4"><strong class="verde">Disponibilidad de interfaces E1, FE, GE</strong></td></tr>

		<tr align="center">
			<td width='20%'></td>
			<td width='30%' class="cafe">En servicio</td>
			<td width='30%' class="cafe">Libre</td>
			<td width='20%'></td>
		</tr>
		<?
		$text =	"E1;;;|".
				"FE;;;|".
				"GE (Electrico);;;|".
				"GE (Optico);;;";
		$text = $p04;
		$arrays = explode('|',$text);
		$result = "";
		$a = 1;
		foreach ($arrays as $array){
			$subarray = explode(';', $array);
			$result .= "<tr align=''>";
			for ($i = 0; $i < sizeof($subarray); $i++) {
				switch($i) {
					case 0:	$result .= "<td>$subarray[$i]</td>";
							$result .= "<input name='p04$a' type='hidden' value='$subarray[$i]'>";
							break;
					case 1:
					case 2: $result .= "<td align='center'><input type='text' class='Text_left' name='p04$a' size='8' value='$subarray[$i]' /></td>";
							break;
					default: $result .= "<td align='center'></td>";
							 break;
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
<table width="1000" align="center" class="table2">
	<tr>
		<td class="cafe">Observaciones:</td>
		<td><input type='text' class='Text_left' name='p05' size='95' value="<?=$p05?>"/></td>
	</tr>
</table>
<br />
<table width="1000" align="center" class="table2" cellspacing="2" class="table2">
	<tr>
		<td>
			<!--<input name="guardar" type="submit"  value="Guardar" />
			<input type="button" name="Submit" value="<< Atras" onclick="javascript:history.back(1)" />-->
			<?php include("prev_form_buttons.php"); ?>
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