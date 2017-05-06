<?php
$web=$_SESSION["web"];

if (isset($_GET['idevento']))   $idevento     = $_GET['idevento'];
if (isset($_GET['idform']))     $idformulario = $_GET['idform'];
if (isset($_GET['idformtto'])) $idformtto 	= $_GET['idformtto'];
if (isset($_GET['nombreForm'])) $nombreForm   = $_GET['nombreForm'];
if (isset($_GET['params']))       $params	= base64_decode($_GET['params']);

$resultado = mysql_query("
SELECT ev.idevento, ev.estado, ev.inicio, ev.fin, es.codigo as codigoest, es.nombre as nombreest, g.codigo AS codigog, g.nombre as nomGrupo, c.idcentro, c.codigo as codCentro, c.nombre as nomCentro, c.depto
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
$depto 			= $dato['depto'];
$nomCentro		= $dato['nomCentro'];
$nomGrupo		= $dato['nomGrupo'];

//$params = "&anio=$anio&codCentro=$codCentro&ini=$ini&fin=$fin&idev=$idev&codEs=$codEs&nomEs=$nomEs";

$resultQuery = mysql_query("SELECT * FROM formulario_p001 p WHERE p.id = ".$idformtto);
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

$opTipoEstacion = array("...", "Edificio tecnico", "Greenfield", "Rooftop", "Gabinete outdoor de calle");
$opPropiedad = array("...", "Alquilada", "Comodato", "Propiedad Tigo", "Propiedad BTV", "Propiedad ENTEL");
$opcionSN = array("...", "SI", "NO");

?>
<form name="amper" method="post" action="<?=$link_modulo_r?>" onSubmit=" return VerifyOne ();">
	<input type="hidden" name="path" value="prev_nuevo_form_P001_r.php" />
	<input type="hidden" name="idevento" value="<?=$idevento?>" />
	<input type="hidden" name="idformulario" value="<?=$idformulario?>" />
	<input type="hidden" name="params" value="<?=$params?>" />
	<input type="hidden" name="idformtto" value="<?=$idformtto?>" />

<table width="900" align="center" class="table2">
	<caption>MODIFICAR FORMULARIO DE MANTENIIENTO PREVENTIVO <br>SITIO</caption>
	<tr>
		<th width="25%">Titulo</th>
		<td width="75%"><input name="titulo" type="text" id="titulo" value="<?=$titulo?>" size="70" maxlength=""/></td>
	</tr>
	<tr>
		<th width="25%">CM/SCM</th>
		<td width="75%"><?=$nomCentro?></td>
	</tr>
	<tr>
		<th width="25%">Nombre de Responsables:</th>
		<td width="75%">
			<?=$nomGrupo?>&nbsp;&nbsp;
			<? echo "<span class='cafe'><b>Fecha de Mantenimiento: </b></span>" . $ini; ?>
		</td>
	</tr>
	<tr>
		<th width="25%">Departamento:</th>
		<td width="75%"><?=$depto?></td>
	</tr>
	<tr>
		<th width="25%">Estación</th>
		<td width="75%"><? echo $nomEs . "&nbsp;&nbsp;&nbsp;&nbsp;<span class='cafe'><b>ID Estación:</b></span> " . $codEs ?></td>
	</tr>

	<tr><th colspan="2"><strong class="verde">1.- Relevamiento</strong></th></tr>
	<tr>
		<th width="25%">Dirección:</th>
		<td width="75%"><input name="p01" type="text" id="p01" size="60" value="<?=$p01?>" /></td>
	</tr>
	<tr>
	  <th width="25%">Tipo de estación</th>
	  <td width="75%">
		  <select name="p02">
			  <?
			  foreach($opTipoEstacion as $opcion){
				  echo '<option value="'.$opcion.'" ';
				  if($opcion == $p02) echo 'selected';
				  echo'>'.$opcion.'</option>';
			  }
			  ?>
		  </select>
	  </td>
	</tr>
	<tr>
		<th width="25%">Propiedad</th>
		<td width="75%">
			<select name="p03">
				<?
				foreach($opPropiedad as $opcion){
					echo '<option value="'.$opcion.'" ';
					if($opcion == $p03) echo 'selected';
					echo'>'.$opcion.'</option>';
				}
				?>
			</select>
		</td>
	</tr>
	<tr>
		<th width="25%">Requiere desmalezado?</th>
		<td width="75%">
			<select name="p04">
				<?
				foreach($opcionSN as $opcion){
					echo '<option value="'.$opcion.'" ';
					if($opcion == $p04) echo 'selected';
					echo'>'.$opcion.'</option>';
				}
				?>
			</select>
		</td>
	</tr>

	<tr>
	  <th width="25%">Horarios de accesibilidad al sitio</th>
	  <td width="75%"><input name="p05" type="text" id="p05" size="5" value="<?=$p05?>" /> Horas</td>
	</tr>
</table>

<br />
<table  width="900" align="center" class="table2">
		<tr align="center">
			<td width='20%'></td>
			<td colspan="2"><b>Temporada Seca</b></td>
			<td colspan="2"><b>Temporada Lluvia</b></td>
			<td></td>
		</tr>

		<tr align="center">
			<td class='cafe' width='20%'><b>Tipo de acceso</b></td>
			<td class='cafe'>Distancia Km</td>
			<td class='cafe'>Tiempo en hrs</td>
			<td class='cafe'>Distancia Km</td>
			<td class='cafe'>Tiempo en hrs</td>
			<td class='cafe'>Observaciones</td>
		</tr>
		<?
		$text = $p06;	//"ASFALTO;;;;;|TIERRA;;;;;|A PIE;;;;;|FLUVIAL;;;;;|AEREA;;;;;";
		$arrays = explode('|',$text);
		$result = "";
		$a = 1;
		foreach ($arrays as $array){
			$subarray = explode(';', $array);
			$result .= "<tr align='center'>";
			for ($i = 0; $i < sizeof($subarray); $i++) {
				if($i == 0){
					$result .= "<td>$subarray[$i]</td>";
					$result .= "<input name='p06$a' id='p06$a$b' type='hidden' value='$subarray[$i]'>";
				}else{
					$result .= "<td><input name='p06$a' type='text' id='p06$a$b' value='$subarray[$i]' size='7'/></td>";
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
<table  width="1050" align="center" class="table2">

	<tr align="center">
		<td width='40%'></td>
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
	</tr>
	<?
	/*$text =	"Observar, registrar e informar el estado de los Caminos de Acceso;;;;;;;;;;|
	         Observar, registrar e informar el estado de la infraestructura de la Estación;;;;;;;;;;";*/

	$text = $p07;
	$arrays = explode('|',$text);
	$result = "";
	$a = 1;
	foreach ($arrays as $array){
		$subarray = explode(';', $array);
		$result .= "<tr align=''>";
		for ($i = 0; $i < sizeof($subarray); $i++) {
			if($i == 0){
				$result .= "<td>$subarray[$i]</td>";
				$result .= "<input name='p07$a' id='p07$a$b' type='hidden' value='$subarray[$i]'>";
			}else{
				$result .= "<td align='center'><input type='checkbox' name='p07$a' value='$a'";
				if($subarray[$i] == $a) $result .= "checked";
				$result .= " ></td>";
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
<table  width="1050" align="center" class="table2">
		<tr><td colspan="11"><strong class="verde">2.- Mantenimiento Preventivo</strong></td></tr>
		<tr align="center">
			<td width='40%'></td>
			<td width='6%'>No Existe</td>
			<td width='6%'>Malo</td>
			<td width='6%'>Bajo</td>
			<td width='6%'>Medio</td>
			<td width='6%'>Alto</td>
			<td width='6%'>Bueno</td>
			<td width='6%'>Reparado</td>
			<td width='6%'>Ajustado</td>
			<td width='6%'>Cambiado</td>
			<td width='6%'>Pendiente</td>
		</tr>
		<?
		/*$text =	"<b>LIMPIEZA DE EQUIPOS Y AMBIENTES </b>;;;;;;;;;;|
				 Limpieza de chasis, cubierta de grupos generadores, manchas de aceite, cables de interconexión;;;;;;;;;;|
	             Limpieza de la Batería de arranque  y sus terminales;;;;;;;;;;|
	             Limpieza del banco de baterías, sus terminales y cables de interconexión;;;;;;;;;;|
	             Limpieza de la superficie de cada  panel del arreglo solar;;;;;;;;;;|
	             Limpieza de  las salas de  rectificadores y baterías;;;;;;;;;;|
	             Limpieza de las salas de grupos generadores;;;;;;;;;;|
	             Limpieza y ordenamiento de las salas de grupo generador;;;;;;;;;;|
	             Limpieza de  escalerillas y ductos de cables de energía;;;;;;;;;;|
	             Limpieza del área  dentro y fuera del cerco  perimetral recolectando cables, filtros de aceite sucios,  desechos sólidos , depositando en contenedores;;;;;;;;;;|
	             Maleza en el área perimetral;;;;;;;;;;|
	             Limpieza Exterior (Papeles Pegados);;;;;;;;;;|
	             Filtraciones de Agua;;;;;;;;;;|
	             Humedad;;;;;;;;;;|
	             Polvo Excesivo;;;;;;;;;;|
	             Plagas(hormigas, roedores, etc.);;;;;;;;;;";*/

		$text = $p08;
		$arrays = explode('|',$text);
		$result = "";
		$a = 1;
		foreach ($arrays as $array){
			$subarray = explode(';', $array);
			$result .= "<tr>";
			for ($i = 0; $i < sizeof($subarray); $i++) {
				if($i == 0){
					$result .= "<td>$subarray[$i]</td>";
					$result .= "<input name='p08$a' id='p08$a$b' type='hidden' value='$subarray[$i]'>";
				}else{
					$result .= "<td align='center'><input type='checkbox' name='p08$a' value='$a'";
					if($subarray[$i] == $a) $result .= "checked";
					$result .= " ></td>";
				}
				$a++;
			}
			$result .= "</tr>";
		}
		echo $result;
		?>
		<input type="hidden" name="size8" value="<?=$a?>" />
</table>
<br />
<table  width="1050" align="center" class="table2">
		<tr align="center">
			<td width='40%'></td>
			<td width='6%'>No Existe</td>
			<td width='6%'>Malo</td>
			<td width='6%'>Bajo</td>
			<td width='6%'>Medio</td>
			<td width='6%'>Alto</td>
			<td width='6%'>Bueno</td>
			<td width='6%'>Reparado</td>
			<td width='6%'>Ajustado</td>
			<td width='6%'>Cambiado</td>
			<td width='6%'>Pendiente</td>
		</tr>
		<?
		/*$text =	"<b>ILUMINACION:</b>;;;;;;;;;;|
				 Focos de Balizamiento en AC y DC;;;;;;;;;;|
	             Iluminación de salas de energía y equipos;;;;;;;;;;|
	             Iluminación de exteriores, dentro el cerco perimetral de repetidoras;;;;;;;;;;";*/
		$text = $p09;
		$arrays = explode('|',$text);
		$result = "";
		$a = 1;
		foreach ($arrays as $array){
			$subarray = explode(';', $array);
			$result .= "<tr align=''>";
			for ($i = 0; $i < sizeof($subarray); $i++) {
				if($i == 0){
					$result .= "<td>$subarray[$i]</td>";
					$result .= "<input name='p09$a' id='p09$a$b' type='hidden' value='$subarray[$i]'>";
				}else{
					$result .= "<td align='center'><input type='checkbox' name='p09$a' value='$a'";
					if($subarray[$i] == $a) $result .= "checked";
					$result .= " ></td>";
				}
				$a++;
			}
			$result .= "</tr>";
		}
		echo $result;
		?>
		<input type="hidden" name="size9" value="<?=$a?>" />
</table>
<br />
<table  width="1050" align="center" class="table2">
		<tr align="center">
			<td width='40%'></td>
			<td width='6%'>No Existe</td>
			<td width='6%'>Malo</td>
			<td width='6%'>Bajo</td>
			<td width='6%'>Medio</td>
			<td width='6%'>Alto</td>
			<td width='6%'>Bueno</td>
			<td width='6%'>Reparado</td>
			<td width='6%'>Ajustado</td>
			<td width='6%'>Cambiado</td>
			<td width='6%'>Pendiente</td>
		</tr>
		<?
		/*$text =	"<b>ESTRUCTURA METALICA:</b>;0;0;0;0;0;0;0;0;0;0|
				 Control Tensores, Riendas y Anclajes.;0;0;0;0;0;0;0;0;0;0|
	             Verificación del estado de coaxiales, f.o., cableado de bajada.;0;0;0;0;0;0;0;0;0;0|
	             Verificación Puesta a Tierra.;0;0;0;0;0;0;0;0;0;0|
	             Control y ajuste de buloneria;0;0;0;0;0;0;0;0;0;0|
	             Control de corrosión de torre, portones y partes metálicas.;0;0;0;0;0;0;0;0;0;0|
	             Control de Cerraduras y Candados.;0;0;0;0;0;0;0;0;0;0|
	             Control de Verticalidad;0;0;0;0;0;0;0;0;0;0|
	             Verificar puertas y chapas;0;0;0;0;0;0;0;0;0;0";*/
		$text = $p10;
		$arrays = explode('|',$text);
		$result = "";
		$a = 1;
		foreach ($arrays as $array){
			$subarray = explode(';', $array);
			$result .= "<tr align=''>";
			for ($i = 0; $i < sizeof($subarray); $i++) {
				if($i == 0){
					$result .= "<td>$subarray[$i]</td>";
					$result .= "<input name='p10$a' id='p10$a$b' type='hidden' value='$subarray[$i]'>";
				}else{
					//$result .= "<td align='center'><input type='checkbox' name='p10$a' value='$a'></td>";
					$result .= "<td align='center'><input type='checkbox' name='p10$a' value='$a'";
					if($subarray[$i] == $a) $result .= "checked";
					$result .= " ></td>";
				}
				$a++;
			}
			$result .= "</tr>";
		}
		echo $result;
		?>
		<input type="hidden" name="size10" value="<?=$a?>" />
</table>
<table width="1050" align="center" class="table2" cellspacing="2" class="table2">
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