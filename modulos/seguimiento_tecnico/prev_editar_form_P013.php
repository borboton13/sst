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

$resultQuery = mysql_query("SELECT * FROM formulario_p013 p WHERE p.id = ".$idformtto);
$result      = mysql_fetch_array($resultQuery);

$titulo = $result['titulo'];
$p01	= $result['p01'];
$p02	= $result['p02'];
$p03	= $result['p03'];
$p04	= $result['p04'];
$p05	= $result['p05'];
$p06	= $result['p06'];
$p07	= $result['p07'];
$p08	= $result['p08'];
$p09	= $result['p09'];
$p10	= $result['p10'];
$p11	= $result['p11'];
$p12	= $result['p12'];
$p13	= $result['p13'];
$p14	= $result['p14'];
$p15	= $result['p15'];
$p16	= $result['p16'];
$p17	= $result['p17'];
$p18	= $result['p18'];

$opP01 = array("...", "SI", "NO");
$opP04 = array("...", "ACTIVO", "FUERA DE SERVICIO");
$opP05 = array("...", "ERICSSON", "HUAWEI", "VNL", "ZTE");
$opP07 = array("...", "PEX_Cu", "MICROONDAS", "FIBRA OPTICA", "SATELITAL");
$opP09 = array("...", "ETHERNET", "E1", "FIBRA OPTICA");
$opP11 = array("...", "RED COMERCIAL", "GRUPO GENERADOR", "PANELES SOLARES");
$opP12 = array("...", "BANCO DE BATERIAS", "GRUPO GENERADOR", "PANELES SOLARES");
$opP15 = array("...", "Funciona", "No funciona", "No existe");
$opP16 = array("...", "SI", "NO", "N/A");
$opP17 = array("...", "Sectorial", "Ominidireccional");
$opP17_1 = array("..", "SI", "NO");
?>
<form name="amper" method="post" action="<?=$link_modulo_r?>" onSubmit=" return VerifyOne ();">
	<input type="hidden" name="path" value="prev_nuevo_form_P013_r.php" />
	<input type="hidden" name="idevento" value="<?=$idevento?>" />
	<input type="hidden" name="idformulario" value="<?=$idformulario?>" />
	<input type="hidden" name="params" value="<?=$params?>" />
	<input type="hidden" name="idformtto" value="<?=$idformtto?>" />

<table width="900" align="center" class="table2">
	<caption>FORMULARIO DE MANTENIIENTO PREVENTIVO<br>RADIO BASES</caption>
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
	  <th width="25%">Tiene Radio Base</th>
	  <td width="75%">
		  <select name="p01">
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
	<tr>
		<th width="25%">Nombre Radio Base</th>
		<td width="50%">
			<input name="p02" type="text" id="p02" size="30" value="<?=$p02?>" />
			&nbsp;&nbsp;
			<label for="id_radio">ID Radio Base:</label>
			<input name="p03" type="text" id="p03" size="15" value="<?=$p03?>" />
		</td>
	</tr>

	<tr>
		<th width="25%">Estado</th>
		<td width="75%">
			<select name="p04">
				<?
				foreach($opP04 as $opcion){
					echo '<option value="'.$opcion.'" ';
					if($opcion == $p04) echo 'selected';
					echo'>'.$opcion.'</option>';
				}
				?>
			</select>
		</td>
	</tr>

	<tr>
		<th width="25%">Marca</th>
		<td width="75%">
			<select name="p05">
				<?
				foreach($opP05 as $opcion){
					echo '<option value="'.$opcion.'" ';
					if($opcion == $p05) echo 'selected';
					echo'>'.$opcion.'</option>';
				}
				?>
			</select>
		</td>
	</tr>

	<tr>
		<th width="25%">Modelo</th>
		<td width="75%"><input name="p06" type="text" id="p06" size="30" value="<?=$p06?>" /></td>
	</tr>

	<tr>
		<th width="25%">Tipo de transmision</th>
		<td width="75%">
			<select name="p07">
				<?
				foreach($opP07 as $opcion){
					echo '<option value="'.$opcion.'" ';
					if($opcion == $p07) echo 'selected';
					echo'>'.$opcion.'</option>';
				}
				?>
			</select>
		</td>
	</tr>

	<tr>
		<th width="25%">Salto Anterior</th>
		<td width="75%"><input name="p08" type="text" id="p08" size="30" value="<?=$p08?>" /></td>
	</tr>

	<tr>
		<th width="25%">Interface</th>
		<td width="75%">
			<select name="p09">
				<?
				foreach($opP09 as $opcion){
					echo '<option value="'.$opcion.'" ';
					if($opcion == $p09) echo 'selected';
					echo'>'.$opcion.'</option>';
				}
				?>
			</select>
		</td>
	</tr>

	<tr>
		<th width="25%">Equipo de transmisión</th>
		<td width="75%"><input name="p10" type="text" id="p10" size="30" value="<?=$p10?>" /></td>
	</tr>

	<tr>
		<th width="25%">Energía principal</th>
		<td width="75%">
			<select name="p11">
				<?
				foreach($opP11 as $opcion){
					echo '<option value="'.$opcion.'" ';
					if($opcion == $p11) echo 'selected';
					echo'>'.$opcion.'</option>';
				}
				?>
			</select>
		</td>
	</tr>

	<tr>
		<th width="25%">Energía Respaldo</th>
		<td width="75%">
			<select name="p12">
				<?
				foreach($opP12 as $opcion){
					echo '<option value="'.$opcion.'" ';
					if($opcion == $p12) echo 'selected';
					echo'>'.$opcion.'</option>';
				}
				?>
			</select>
		</td>
	</tr>
</table>
<br />
<table  width="900" align="center" class="table2">
	<tr><th colspan="3"><strong class="verde">2.- Mantenimiento Preventivo</strong></th></tr>
	<tr align="center">
		<td width='55%'></td>
		<td>Revisado</td>
		<td>Observaciones</td>
	</tr>
	<?
	$text = $p13;
	$arrays = explode('|',$text);
	$result = "";
	$a = 1;
	foreach ($arrays as $array){
		$subarray = explode(';', $array);
		$result .= "<tr>";
		for ($i = 0; $i < sizeof($subarray); $i++) {
			switch($i){
				case 0: $result .= "<td>$subarray[$i]</td>";
						$result .= "<input name='p13$a' id='$a$b' type='hidden' value='$subarray[$i]'>";
						break;
				case 1: $result .= "<td align='center'><input type='checkbox' name='p13$a' value='$a'";
						if($subarray[$i] == $a) $result .= "checked";
						$result .= " ></td>";
						break;
				default: $result .= "<td align='center'><input type='text' name='p13$a' value='$subarray[$i]' size='20'/></td>";
			}
			$a++;
		}
		$result .= "</tr>";
	}
	echo $result;
	?>
	<input type="hidden" name="size13" value="<?=$a?>" />
</table>
	<br />
<table  width="900" align="center" class="table2">

		<tr align="center">
			<td width='35%'>Listar alarmas de Radio Base por LMT</td>
			<td width='20%'>Causa</td>
			<td width='20%'>Solucion</td>
			<td width='20%'>Observaciones</td>
		</tr>
		<?
		/*$text =	";;;|;;;|;;;|;;;|;;;";*/
		$text =	$p14;
		$arrays = explode('|',$text);
		$result = "";
		$a = 1;
		foreach ($arrays as $array){
			$subarray = explode(';', $array);
			$result .= "<tr align=''>";
			for ($i = 0; $i < sizeof($subarray); $i++) {
				if($i == 0){
					$result .= "<td align='center'><input type='text' name='p14$a' size='30' value='$subarray[$i]' /></td>";
				}else{
					$result .= "<td align='center'><input type='text' name='p14$a' size='20' value='$subarray[$i]'/></td>";
				}
				$a++;
			}
			$result .= "</tr>";
		}
		echo $result;
		?>
		<input type="hidden" name="size14" value="<?=$a?>" />
</table>
	<br />
<table  width="900" align="center" class="table2">
		<tr align="center">
			<td width='40%' class="cafe"><b>Verificar alarmas</b></td>
			<td width='20%' class="cafe"><b>Estado</b></td>
			<td width='40%' class="cafe"><b>Observaciones</b></td>
		</tr>
		<?
		$text = $p15;
		$arrays = explode('|',$text);
		$result = "";
		$a = 1;
		foreach ($arrays as $array){
			$subarray = explode(';', $array);
			$result .= "<tr>";
			for ($i = 0; $i < sizeof($subarray); $i++) {
				switch($i){
					case 0: $result .= "<td>$subarray[$i]</td>";
							$result .= "<input name='p15$a' type='hidden' value='$subarray[$i]'>";
							break;
					case 1: $result .= "<td align='center'><select name='p15$a'>";
							foreach($opP15 as $opcion){
								$result .= '<option value="'.$opcion.'" ';
								if($opcion == $subarray[$i]) $result .= 'selected';
								$result .='>'.$opcion.'</option>';
							}
							$result .= 	"</select></td>";
							break;
					default: $result .= "<td align='center'><input type='text' name='p15$a' value='$subarray[$i]' size='20'/></td>";
				}

				$a++;
			}
			$result .= "</tr>";
		}
		echo $result;
		?>
		<input type="hidden" name="size15" value="<?=$a?>" />
</table>
<br />
<table  width="900" align="center" class="table2">
		<tr align="center">
			<td width='20%' class="cafe"><b>Pruebas de servicio</b></td>
			<td width='15%' class="cafe"><b>Numero de A</b></td>
			<td width='15%' class="cafe"><b>Numero de B</b></td>
			<td width='10%' class="cafe"><b>Prueba exitosa?</b></td>
			<td width='20%' class="cafe"><b>Fecha y hora</b></td>
			<td width='20%' class="cafe"><b>Observaciones</b></td>
		</tr>
		<?
		$text = $p16;
		$arrays = explode('|',$text);
		$result = "";
		$a = 1;
		foreach ($arrays as $array){
			$subarray = explode(';', $array);
			$result .= "<tr>";
			for ($i = 0; $i < sizeof($subarray); $i++) {
				switch($i){
					case 0: $result .= "<td>$subarray[$i]</td>";
						$result .= "<input name='p16$a' type='hidden' value='$subarray[$i]'>";
						break;
					case 3: $result .= "<td align='center'><select name='p16$a'>";
							foreach($opP16 as $opcion){
								$result .= '<option value="'.$opcion.'" ';
								if($opcion == $subarray[$i]) $result .= 'selected';
								$result .='>'.$opcion.'</option>';
							}
							$result .= 	"</select></td>";
							break;
					case 4: $result .= "<td align='center'><input type='text' name='p16$a' size='12' value='$subarray[$i]' /></td>";
							break;
					default: $result .= "<td align='center'><input type='text' name='p16$a' size='10' value='$subarray[$i]' /></td>";
				}
				$a++;
			}
			$result .= "</tr>";
		}
		echo $result;
		?>
		<input type="hidden" name="size16" value="<?=$a?>" />
</table>
	<br />
<table  width="1000" align="center" class="table2">

			<tr><td colspan="14"><strong class="verde">CELDAS</strong></td></tr>
		<tr><th colspan="14"><strong class="verde">1.- Relevamiento</strong></th></tr>

		<tr align="center">
			<td width='4%' class="cafe">Sector</td>
			<td width='9%' class="cafe">ID Celda</td>
			<td width='10%' class="cafe">Tipo de antena</td>
			<td width='10%' class="cafe">Marca</td>
			<td width='10%' class="cafe">Modelo</td>
			<td width='5%' class="cafe">Azimuth</td>
			<td width='5%' class="cafe">Tilt Mecanico</td>
			<td width='5%' class="cafe">Tilt Electrico</td>
			<td width='5%' class="cafe">Angulo apertura</td>
			<td width='5%' class="cafe">Altura antena</td>
			<td width='5%' class="cafe">Cantidad TMA/RRU</td>
			<td width='10%' class="cafe">Marca TMA/RRU</td>
			<td width='12%' class="cafe">Modelo TMA/RRU</td>
			<td width='5%' class="cafe">Tiene RET</td>
		</tr>
		<?
		$text = $p17;
		$arrays = explode('|',$text);
		$result = "";
		$a = 1;
		foreach ($arrays as $array){
			$subarray = explode(';', $array);
			$result .= "<tr>";
			for ($i = 0; $i < sizeof($subarray); $i++) {
				switch($i){
					case 0: $result .= "<td align='center'><input type='text' name='p17$a' size='1' class='font9' value='$subarray[$i]' /></td>";
						break;
					case 2: $result .= "<td align='center'><select name='p17$a' class='font9'>";
						foreach($opP17 as $opcion){
							$result .= '<option value="'.$opcion.'" ';
							if($opcion == $subarray[$i]) $result .= 'selected';
							$result .='>'.$opcion.'</option>';
						}
						$result .= 	"</select></td>";
						break;
					case $i==3 || $i==4: $result .= "<td align='center'><input type='text' name='p17$a' size='12' class='font9' value='$subarray[$i]' /></td>";
							break;
					case $i>=5 && $i<=10: $result .= "<td align='center'><input type='text' name='p17$a' size='2' class='font9' value='$subarray[$i]' /></td>";
							 break;
					case 12: $result .= "<td align='center'><input type='text' name='p17$a' size='20' class='font9' value='$subarray[$i]' /></td>";
							 break;
					case 13: $result .= "<td align='center'><select name='p17$a' class='font9'>";
						foreach($opP17_1 as $opcion){
							$result .= '<option value="'.$opcion.'" ';
							if($opcion == $subarray[$i]) $result .= 'selected';
							$result .='>'.$opcion.'</option>';
						}
						$result .= 	"</select></td>";
						break;
					default: $result .= "<td align='center'><input type='text' class='font9' name='p17$a' size='9' value='$subarray[$i]' /></td>";
				}
				$a++;
			}
			$result .= "</tr>";
		}
		echo $result;
		?>
		<input type="hidden" name="size17" value="<?=$a?>" />
</table>
<br />
<table  width="900" align="center" class="table2">
		<tr><th colspan="3"><strong class="verde">2.- Mantenimiento Preventivo</strong></th></tr>
		<tr align="center">
			<td width='55%'></td>
			<td>Revisado</td>
			<td>Observaciones</td>
		</tr>
		<?
		$text = $p18;
		$arrays = explode('|',$text);
		$result = "";
		$a = 1;
		foreach ($arrays as $array){
			$subarray = explode(';', $array);
			$result .= "<tr>";
			for ($i = 0; $i < sizeof($subarray); $i++) {
				switch($i){
					case 0: $result .= "<td>$subarray[$i]</td>";
						$result .= "<input name='p18$a' type='hidden' value='$subarray[$i]'>";
						break;
					case 1: //$result .= "<td align='center'><input type='checkbox' name='p18$a' value='$a'></td>";
						$result .= "<td align='center'><input type='checkbox' name='p18$a' value='$a'";
						if($subarray[$i] == $a) $result .= "checked";
						$result .= " ></td>";
						break;
					default: $result .= "<td align='center'><input type='text' name='p18$a' value='$subarray[$i]' size='20'/></td>";
				}
				$a++;
			}
			$result .= "</tr>";
		}
		echo $result;
		?>
		<input type="hidden" name="size18" value="<?=$a?>" />
</table>

<table width="900" align="center" class="table2" cellspacing="2" class="table2">
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