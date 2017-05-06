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

$resultQuery = mysql_query("SELECT * FROM formulario_p006 p WHERE p.id = ".$idformtto);
$result      = mysql_fetch_array($resultQuery);

$titulo = $result['titulo'];
$p01	= $result['p01'];
$p02	= $result['p02'];
$p03	= $result['p03'];
$p04	= $result['p04'];
$p05	= $result['p05'];
$p06	= $result['p06'];
$p06_1	= $result['p06_1'];
$p07	= $result['p07'];
$p08	= $result['p08'];
$p09	= $result['p09'];
$p10	= $result['p10'];
$p11	= $result['p11'];
$p12	= $result['p12'];
$p13	= $result['p13'];
$p14	= $result['p14'];
$p15	= $result['p15'];


?>
<form name="amper" method="post" action="<?=$link_modulo_r?>" onSubmit=" return VerifyOne ();">
	<input type="hidden" name="path" value="prev_nuevo_form_P006_r.php" />
	<input type="hidden" name="idevento" value="<?=$idevento?>" />
	<input type="hidden" name="idformulario" value="<?=$idformulario?>" />
	<input type="hidden" name="params" value="<?=$params?>" />
	<input type="hidden" name="idformtto" value="<?=$idformtto?>" />

<table width="900" align="center" class="table2">
	<caption>FORMULARIO DE MANTENIIENTO PREVENTIVO <br>GRUPO GENERADOR</caption>
	<tr>
		<th width="25%">Estación</th>
		<td width="75%" class="resaltar"><? echo $codEs . " - " . $nomEs; ?></td>
	</tr>
	<tr>
		<th width="25%">Titulo</th>
		<td width="75%" class="resaltar"><input name="titulo" type="text" id="titulo" value="<?=$titulo?>" size="70" maxlength=""/></td>
	</tr>

	<tr>
	  <th width="25%">Marca</th>
	  <td width="75%"><input name="p01" type="text" size="20" value="<?=$p01?>" /></td>
	</tr>

	<tr>
		<th width="25%">No. Serie</th>
		<td width="75%"><input name="p02" type="text" size="20" value="<?=$p02?>" /></td>
	</tr>
</table>
<br />
<table  width="800" align="center" class="table2">
		<tr>
			<td width='20%'></td>
			<td width='20%' align="center"><b>RED - GRUPO</b></td>
			<td width='20%' align="center"><b>PANEL - GRUPO</b></td>
			<td width='20%' align="center"><b>GRUPO - GRUPO</b></td>
		</tr>
		<?
		$text =	"TIPO ESTACION;;;;";
		$text = $p03;
		$arrays = explode('|',$text);
		$result = "";
		$a = 1;
		foreach ($arrays as $array){
			$subarray = explode(';', $array);
			$result .= "<tr align=''>";
			for ($i = 0; $i < sizeof($subarray); $i++) {
				if($i == 0){
					$result .= "<td class='cafe'>$subarray[$i]</td>";
					$result .= "<input name='p03$a' type='hidden' value='$subarray[$i]'>";
				}else{
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
<table  width="800" align="center" class="table2">
	<tr>
		<td width='50%' class="cafe" colspan="2">MEDIDAS CON EL MOTOR EN FUNCIONAMIENTO</td>
		<td width='25%' align="center">ANTES MTTO.</td>
		<td width='25%' align="center">DESPUES MTTO.</td>
	</tr>
	<?
	$text =	"Presión del aceite en el motor;BAR;;|".
			"Temperatura del motor en operación;°C;;|".
			"Revoluciones (RPM) del motor en operación;RPM;;|".
			"Horas de funcionamiento del motor;Hrs;;|".
			"Color del Humo a la salida del escape;COLOR;;";
	$text = $p04;
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
				default: $result .= "<td align='center'><input class='Text_left' name='p04$a' type='text' size='7' value='$subarray[$i]'/></td>";
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
<table  width="800" align="center" class="table2">
		<tr>
			<td colspan="2" width='35%' class="cafe">Medidas de  AC  del grupo generador sin carga</td>
			<td colspan="3" align="center"><b>ANTES MTTO.</b></td>
			<td colspan="3" align="center"><b>DESPUES MTTO.</b></td>
		</tr>

		<tr align="center">
			<td colspan="2" width='35%'></td>
			<td>Fase 1</td>
			<td>Fase 2</td>
			<td>Fase 3</td>

			<td>Fase 1</td>
			<td>Fase 2</td>
			<td>Fase 3</td>
		</tr>
		<?
		$text =	"Voltaje de salida del grupo sin carga [V];;;;;;|".
				"Frecuencia sin carga [Hz];;;;;;";
		$text = $p05;
		$arrays = explode('|',$text);
		$result = "";
		$a = 1;
	for ($f = 0; $f < sizeof($arrays); $f++) {
		$array = $arrays[$f];
		$subarray = explode(';', $array);
		$result .= "<tr>";
		for ($i = 0; $i < sizeof($subarray); $i++) {
			if($f == 0) {
				switch ($i) {
					case 0:
					case 1:
						$result .= "<td>$subarray[$i]</td>";
						$result .= "<input name='p05$a' type='hidden' value='$subarray[$i]'>";
						break;
					default: $result .= "<td align='center'><input class='Text_left' name='p05$a' type='text' size='4' value='$subarray[$i]'/></td>";
				}
			}else{
				switch ($i) {
					case 0:
					case 1:
						$result .= "<td>$subarray[$i]</td>";
						$result .= "<input name='p05$a' type='hidden' value='$subarray[$i]'>";
						break;
					case 2:
					case 5:	$result .= "<td colspan='3' align='center'><input class='Text_center' name='p05$a' type='text' size='15' value='$subarray[$i]' /></td>";
						break;
					default: $result .= "<input name='p05$a' type='hidden' value='$subarray[$i]'>";
				}
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
<table  width="800" align="center" class="table2">
		<tr>
			<td width='55%' class="cafe">Medidas de AC del grupo generador con carga</td>
			<td colspan="3" align="center"><b>ANTES MTTO.</b></td>
			<td colspan="3" align="center"><b>DESPUES MTTO.</b></td>
		</tr>

		<tr align="center">
			<td width='46%'></td>
			<td>Fase 1</td>
			<td>Fase 2</td>
			<td>Fase 3</td>

			<td>Fase 1</td>
			<td>Fase 2</td>
			<td>Fase 3</td>
		</tr>
		<?
		$text =	"Voltaje de salida del grupo con carga [V];;;;;;|".
				"Corriente de Salida del Grupo en Servicio [A];;;;;;|".
				"Frecuencia con carga [Hz];;;;;;|".
				"Verificación de la estabilidad de tensión y  sin carga y con carga [V];;;;;;|".
				"Verificación de la estabilidad de tensión y  sin carga y con carga [Hz];;;;;;|".
				"Verificación del funcionamiento en tensión del alternador de Baja [V];;;;;;";
		$text = $p06;
		$arrays = explode('|',$text);
		$result = "";
		$a = 1;
		//foreach ($arrays as $array){
		for ($f = 0; $f < sizeof($arrays); $f++) {
			$array = $arrays[$f];
			$subarray = explode(';', $array);
			$result .= "<tr>";
			for ($i = 0; $i < sizeof($subarray); $i++) {
				if($f==2 || $f==4 || $f==5){
					switch($i){
						case 0: $result .= "<td align='right'>$subarray[$i]</td>";
							$result .= "<input name='p06$a' id='$a$b' type='hidden' value='$subarray[$i]'>";
							break;
						case 1:
						case 4:	$result .= "<td colspan='3' align='center'><input class='Text_center' name='p06$a' type='text' size='21' value='$subarray[$i]'/></td>";
							break;
						default: $result .= "<input name='p06$a' type='hidden' value='$subarray[$i]'>";
					}
				}else{
					switch($i){
						case 0: $result .= "<td align='right'>$subarray[$i]</td>";
							$result .= "<input name='p06$a' type='hidden' value='$subarray[$i]'>";
							break;
						default: $result .= "<td align='center'><input class='Text_left' name='p06$a' type='text' size='4' value='$subarray[$i]'/></td>";
					}
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
<table  width="800" align="center" class="table2">
		<tr>
			<td width='70%' align="center">Verificación del funcionamiento en tensión del alternador de Baja [V]</td>
			<td align="center"> <input class='Text_center' name='p06_1' type='text' size='15' value="<?=$p06_1?>"/> </td>
		</tr>
</table>
<br />
<table  width="900" align="center" class="table2">
		<tr>
			<td width='60%' class="cafe">ACTIVIDADES SEGUN HORAS DE FUNCIONAMIENTO</td>
			<td align="center"><b>250 Hr</b></td>
			<td align="center"><b>500 Hr</b></td>
			<td align="center"><b>750 Hr</b></td>
			<td align="center"><b>1000 Hr</b></td>
		</tr>
		<?
		$text =	"Revisar el nivel  de aceite del motor , viscosidad y contenido de carbón;;;;|".
				"Efectuar el cambio  de aceite, éste debe ser el especificado por fábrica.;;;;|".
				"Renovar el elemento de filtro de aceite.;;;;|".
				"Limpieza del elemento filtro de aire con aire comprimido.;;;;|".
				"Verificar limpiar y ajustar conexiones de las baterías de arranque.;;;;|".
				"Verificar si la coloración del humo es normal a la salida del escape.;;;;|".
				"Revisión del estado del filtro de combustible, efectuar  la limpieza  con aire comprimido y cambio si fuera necesario;;;;|".
				"Realizar ajuste de luz de válvulas de admisión y escape.;;;;|".
				"Controlar la tensión de Correas, de acuerdo a especificación del modelo de grupo;;;;|".
				"Realizar el mantenimiento/limpieza del alternador de baja.;;;;|".
				"Verificar el juego correcto de la polea.;;;;|".
				"Verificar / limpiar si existe un excesivo depósito de carbón en la tubería de Escape.;;;;|".
				"Con el motor en carga verificar si existe pérdida de Potencia.;;;;|".
				"Verificar si existe ruido en  rodamientos (alternador).;;;;|".
				"Quitar el filtro de aire: 1) Si el filtro de aire es seco, limpiar con aire comprimido;;;;|".
				"Quitar el filtro de aire: 2) Si el filtro de aire es húmedo, lavarlo con diesel y llenar con aceite nuevo;;;;|".
				"Revisar y registrar  la presión del aceite, temperatura del motor.;;;;|".
				"Revisar el nivel  de aceite del motor , viscosidad y contenido de carbón.;;;;|".
				"Renovar el elemento filtro de aire.;;;;|".
				"Verificar la presión y pulverización de los inyectores.;;;;|".
				"Limpiar las aletas/cubiertas de refrigeración/ventilación;;;;|".
				"Quitar el motor de arranque, desmontarlo, limpieza.;;;;";
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
					$result .= "<input name='p07$a' type='hidden' value='$subarray[$i]'>";
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
<table  width="1000" align="center" class="table2">
		<tr>
			<td class="cafe">MTTO CON EL MOTOR APAGADO Y FRIO:</td>
			<td align="center" colspan="6">ANTES MTTO.</td>
			<td align="center" colspan="4">DESPUES MTTO.</td>
			<td></td>
		</tr>
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
			<td width='6%'>Otro</td>
		</tr>
		<?
		$text =	"Nivel de aceite en motor y tanque suplementario;;;;;;;;;;;|".
			"Nivel de aceite en el filtro de aire;;;;;;;;;;;|".
			"Nivel de polvo en el filtro de aire;;;;;;;;;;;|".
			"Existencia de Fugas de Combustible;;;;;;;;;;;|".
			"Existencia de Fugas de aceite lubricante;;;;;;;;;;;|".
			"Verificación de la tensión en las correas impulsoras de las turbinas de aire;;;;;;;;;;;|".
			"Nivel de refrigerante en el radiador;;;;;;;;;;;|".
			"Verificar si la rejilla de salida de aire, está libre de obstrucciones;;;;;;;;;;;";
		$text = $p08;
		$arrays = explode('|',$text);
		$result = "";
		$a = 1;
		foreach ($arrays as $array){
			$subarray = explode(';', $array);
			$result .= "<tr align=''>";
			for ($i = 0; $i < sizeof($subarray); $i++) {
				if($i == 0){
					$result .= "<td>$subarray[$i]</td>";
					$result .= "<input name='p08$a' type='hidden' value='$subarray[$i]'>";
				}else{
					if($i == 11)
						$result .= "<td align='center'><input type='text' name='p08$a' size='4' value='$subarray[$i]'></td>";
					else {
						$result .= "<td align='center'><input type='checkbox' name='p08$a' value='$a'";
						if($subarray[$i] == $a) $result .= "checked";
						$result .= " ></td>";
					}
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
<table  width="1000" align="center" class="table2">
		<tr>
			<td class="cafe">Mtto del alternador de baja , motor apagado:</td>
			<td align="center" colspan="6">ANTES MTTO.</td>
			<td align="center" colspan="4">DESPUES MTTO.</td>
			<td></td>
		</tr>
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
			<td width='6%'>Otro</td>
		</tr>
		<?
		$text =	"Verificar que todas las conexiones estén ajustadas;;;;;;;;;;;|".
				"Verificar si existe juego en el acoplamiento Alternador/Motor;;;;;;;;;;;|".
				"Verificar que el ventilador del alternador este ajustado;;;;;;;;;;;|".
				"Verificar estado de los carbones;;;;;;;;;;;";
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
					$result .= "<input name='p09$a' type='hidden' value='$subarray[$i]'>";
				}else{
					if($i == 11)
						$result .= "<td align='center'><input type='text' name='p09$a' size='4' value='$subarray[$i]' ></td>";
					else{
						$result .= "<td align='center'><input type='checkbox' name='p09$a' value='$a'";
						if($subarray[$i] == $a) $result .= "checked";
						$result .= " ></td>";
					}
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
<table  width="1000" align="center" class="table2">
		<tr>
			<td class="cafe">Medidas relacionadas al Grupo Generador:</td>
			<td align="center" colspan="6">ANTES MTTO.</td>
			<td align="center" colspan="4">DESPUES MTTO.</td>
			<td></td>
		</tr>
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
			<td width='6%'>Otro</td>
		</tr>
		<?
		$text =	"Verificar el libre desplazamiento del flotador en el tanque de combustible;;;;;;;;;;;|".
				"Verificar la operación de las bombas de combustible;;;;;;;;;;;|".
				"Drenar el sedimento del tanque de servicio diario;;;;;;;;;;;|".
				"Existencia de fugas en la bomba y tuberías;;;;;;;;;;;|".
				"Verificación funcionamiento precalentador de arranque;;;;;;;;;;;";
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
					$result .= "<input name='p10$a' type='hidden' value='$subarray[$i]'>";
				}else{
					if($i == 11)
						$result .= "<td align='center'><input type='text' name='p10$a' size='4' value='$subarray[$i]' ></td>";
					else{
						$result .= "<td align='center'><input type='checkbox' name='p10$a' value='$a'";
						if($subarray[$i] == $a) $result .= "checked";
						$result .= " ></td>";
					}
				}
				$a++;
			}
			$result .= "</tr>";
		}
		echo $result;
		?>
		<input type="hidden" name="size10" value="<?=$a?>" />
</table>

<table  width="1000" align="center" class="table2">
		<tr>
			<td width="38%"></td>
			<td></td>
			<td width="38%"></td>
			<td></td>
		</tr>
		<?
		$text =	"Cantidad de Diesel del tanque de alimentación diaria [Litros];;Cantidad de Diesel en el tanque de almacenamiento [Litros];|".
				"Cantidad de aceite lubricante existente en la estación [Litros];;Cantidad de agua destilada existente en la estación [Litros];";
		$text = $p11;
		$arrays = explode('|',$text);
		$result = "";
		$a = 1;
		foreach ($arrays as $array){
			$subarray = explode(';', $array);
			$result .= "<tr>";
			for ($i = 0; $i < sizeof($subarray); $i++) {
				switch($i){
					case 0:
					case 2: $result .= "<td>$subarray[$i]</td>";
						$result .= "<input name='p11$a' type='hidden' value='$subarray[$i]'>";
						break;
					default: $result .= "<td><input class='Text_left' name='p11$a' type='text' size='7' value='$subarray[$i]' /></td>";
				}
				$a++;
			}
			$result .= "</tr>";
		}
		echo $result;
		?>
		<input type="hidden" name="size11" value="<?=$a?>" />

</table>
<br />
<table  width="1000" align="center" class="table2">
		<tr>
			<td width='23%' class="cafe">MTTO BATERIAS DE ARRANQUE</td>
			<td align="center" colspan="6" class="cafe" style="background-color: #D6EAF8;">Marca Bateria 1: <input class='Text_left' name='p12' type='text' size='20' value="<?=$p12?>"/></td>
			<td align="center" colspan="6" class="cafe" style="background-color: #D6DBDF;">Marca Bateria 2: <input class='Text_left' name='p13' type='text' size='20' value="<?=$p13?>"/></td>
		</tr>
		<tr>
			<td></td>
			<td align="center">Celda 1</td>
			<td align="center">Celda 2</td>
			<td align="center">Celda 3</td>
			<td align="center">Celda 4</td>
			<td align="center">Celda 5</td>
			<td align="center">Celda 6</td>
			<td align="center">Celda 1</td>
			<td align="center">Celda 2</td>
			<td align="center">Celda 3</td>
			<td align="center">Celda 4</td>
			<td align="center">Celda 5</td>
			<td align="center">Celda 6</td>
		</tr>
		<?
		$text =	"Voltaje DC en  flotación [V];;;;;;;;;;;;|".
				"Temperatura de operación [°C];;;;;;;;;;;;|".
				"Densidad de cada celda [Baumes];;;;;;;;;;;;";
		$text = $p14;
		$arrays = explode('|',$text);
		$result = "";
		$a = 1;
		foreach ($arrays as $array){
			$subarray = explode(';', $array);
			$result .= "<tr align=''>";
			for ($i = 0; $i < sizeof($subarray); $i++) {
				if($i == 0){
					$result .= "<td>$subarray[$i]</td>";
					$result .= "<input name='p14$a' type='hidden' value='$subarray[$i]'>";
				}else{
					$result .= "<td align='center'><input class='Text_left' name='p14$a' type='text' size='5' value='$subarray[$i]' /></td>";
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
		<tr>
			<td width='40%'></td>
			<td width='25%' class="cafe" align="center">OK</td>
		</tr>
		<?
		$text =	"Prueba de arranque  con el grupo generador;|".
				"Medición de corriente de carga con el grupo encendido;|".
				"Verificar, limpiar, asegurar  terminales de las baterías de arranque;";
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
					default: //$result .= "<td align='center'><input type='checkbox' name='p15$a' value='$a'></td>";
							$result .= "<td align='center'><input type='checkbox' name='p15$a' value='$a'";
							if($subarray[$i] == $a) $result .= "checked";
							$result .= " ></td>";
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