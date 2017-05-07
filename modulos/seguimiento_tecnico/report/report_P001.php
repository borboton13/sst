<?php
$idcentro    = $_POST["idcentro"];
$formulario  = $_POST["formulario"];
$fechainicio = $_POST["fechainicio"];
$fechafin    = $_POST["fechafin"];

header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=st_reporte_mtto.xls");
header("Pragma: no-cache");
header("Expires: 0");

$cabecera = array("No Existe", "Malo", "Bajo", "Medio", "Alto", "Bueno", "Reparado", "Ajustado", "Cambiado", "Pendiente");
$cab10 = "";
foreach ($cabecera as $cab){
    $cab10 .= "<th>$cab</th>";
}

?>
<table border="1">

<tr>
    <th></th>
    <th></th>
    <th></th>
    <th></th>
    <th></th>
    <th></th>
    <th></th>
    <th></th>
    <th></th>
    <th></th>
    <th colspan="2"><b>Temporada Seca</b></th>
    <th colspan="2"><b>Temporada Lluvia</b></th>
    <th></th>
    <th></th>
    <th colspan="2"><b>Temporada Seca</b></th>
    <th colspan="2"><b>Temporada Lluvia</b></th>
    <th></th>
    <th></th>
    <th colspan="2"><b>Temporada Seca</b></th>
    <th colspan="2"><b>Temporada Lluvia</b></th>
    <th></th>
    <th></th>
    <th colspan="2"><b>Temporada Seca</b></th>
    <th colspan="2"><b>Temporada Lluvia</b></th>
    <th></th>
    <th></th>
    <th colspan="2"><b>Temporada Seca</b></th>
    <th colspan="2"><b>Temporada Lluvia</b></th>
    <th></th>
    <th></th>
</tr>
<tr>
    <th>No</th>
    <th>FECHA</th>
    <th>NOM_ESTACION</th>
    <th>TITULO</th>
    <th></th>
    <th></th>
    <th></th>
    <th></th>
    <th></th>
    <th>Tipo de acceso</th>
    <th>Distancia Km</th>
    <th>Tiempo en hrs</th>
    <th>Distancia Km</th>
    <th>Tiempo en hrs</th>
    <th>Observaciones</th>
    <th>Tipo de acceso</th>
    <th>Distancia Km</th>
    <th>Tiempo en hrs</th>
    <th>Distancia Km</th>
    <th>Tiempo en hrs</th>
    <th>Observaciones</th>
    <th>Tipo de acceso</th>
    <th>Distancia Km</th>
    <th>Tiempo en hrs</th>
    <th>Distancia Km</th>
    <th>Tiempo en hrs</th>
    <th>Observaciones</th>
    <th>Tipo de acceso</th>
    <th>Distancia Km</th>
    <th>Tiempo en hrs</th>
    <th>Distancia Km</th>
    <th>Tiempo en hrs</th>
    <th>Observaciones</th>
    <th>Tipo de acceso</th>
    <th>Distancia Km</th>
    <th>Tiempo en hrs</th>
    <th>Distancia Km</th>
    <th>Tiempo en hrs</th>
    <th>Observaciones</th>
    <th></th>
    <?php echo $cab10 ?>
    <th></th>
    <?php echo $cab10 ?>
    <th></th>
    <?php echo $cab10 ?>
    <th></th>
    <?php echo $cab10 ?>
    <th></th>
    <?php echo $cab10 ?>
    <th></th>
    <?php echo $cab10 ?>
    <th></th>
    <?php echo $cab10 ?>
    <th></th>
    <?php echo $cab10 ?>
    <th></th>
    <?php echo $cab10 ?>
    <th></th>
    <?php echo $cab10 ?>
    <th></th>
    <?php echo $cab10 ?>
    <th></th>
    <?php echo $cab10 ?>
    <th></th>
    <?php echo $cab10 ?>
    <th></th>
    <?php echo $cab10 ?>
    <th></th>
    <?php echo $cab10 ?>
    <th></th>
    <?php echo $cab10 ?>
    <th></th>
    <?php echo $cab10 ?>
    <th></th>
    <?php echo $cab10 ?>
    <th></th>
    <?php echo $cab10 ?>
    <th></th>
    <?php echo $cab10 ?>
    <th></th>
    <?php echo $cab10 ?>
    <th></th>
    <?php echo $cab10 ?>
    <th></th>
    <?php echo $cab10 ?>
    <th></th>
    <?php echo $cab10 ?>
    <th></th>
    <?php echo $cab10 ?>
    <th></th>
    <?php echo $cab10 ?>
    <th></th>
    <?php echo $cab10 ?>
    <th></th>
    <?php echo $cab10 ?>
    <th></th>
    <?php echo $cab10 ?>
    <th></th>
    <?php echo $cab10 ?>
    <th></th>
    <?php echo $cab10 ?>

</tr>
<?	
	//$consulta="SELECT * FROM st_ticket;";
	$resultado=mysql_query("
	SELECT ev.inicio, es.nombre, f.titulo, f.p01, f.p02, f.p03, f.p04, f.p05, f.p06, f.p07, f.p08, f.p09, f.p10
	FROM formulario_p001 f
	JOIN evento ev   ON f.idevento = ev.idevento
	JOIN estacion es ON ev.idestacion = es.idestacion
	WHERE ev.idcentro = ".$idcentro."
	AND ev.inicio BETWEEN '".$fechainicio."' AND '".$fechafin."';
	");

	$filas=mysql_num_rows($resultado);
	if($filas!=0){
		$i=0;
		while($dato=mysql_fetch_array($resultado)){

			$fecha = $dato['inicio'];
			$nombre = $dato['nombre'];
			$titulo = $dato['titulo'];

			$p01 = $dato['p01'];
			$p02 = $dato['p02'];
			$p03 = $dato['p03'];
			$p04 = $dato['p04'];
			$p05 = $dato['p05'];

            $html_p06 = "";
            $p06 = $dato['p06']; $arrays = explode('|', $p06);

            $arr = explode(';', $arrays[0]); for($i=0 ; $i < sizeof($arr) ; $i++){ $html_p06 .= "<td>".$arr[$i]."</td>";}
            $arr = explode(';', $arrays[1]); for($i=0 ; $i < sizeof($arr) ; $i++){ $html_p06 .= "<td>".$arr[$i]."</td>";}
            $arr = explode(';', $arrays[2]); for($i=0 ; $i < sizeof($arr) ; $i++){ $html_p06 .= "<td>".$arr[$i]."</td>";}
            $arr = explode(';', $arrays[3]); for($i=0 ; $i < sizeof($arr) ; $i++){ $html_p06 .= "<td>".$arr[$i]."</td>";}
            $arr = explode(';', $arrays[4]); for($i=0 ; $i < sizeof($arr) ; $i++){ $html_p06 .= "<td>".$arr[$i]."</td>";}

            $html_p07 = "";
            $p07 = $dato['p07']; $arrays = explode('|', $p07);

            $arr = explode(';', $arrays[0]); $html_p07 .= "<td>".$arr[0]."</td>";
            for($i=1 ; $i < sizeof($arr) ; $i++){ $valor = ($arr[$i] != '') ? 'X' : ''; $html_p07 .= "<td>".$valor."</td>";}

            $arr = explode(';', $arrays[1]); $html_p07 .= "<td>".$arr[0]."</td>";
            for($i=1 ; $i < sizeof($arr) ; $i++){ $valor = ($arr[$i] != '') ? 'X' : ''; $html_p07 .= "<td>".$valor."</td>";}

            $html_p08 = "";
            $p08 = $dato['p08']; $arrays = explode('|', $p08);

            $arr = explode(';', $arrays[0]); $html_p08 .= "<td>".$arr[0]."</td>";
            for($i=1 ; $i < sizeof($arr) ; $i++){ $valor = ($arr[$i] != '') ? 'X' : ''; $html_p08 .= "<td>".$valor."</td>";}

            $arr = explode(';', $arrays[1]); $html_p08 .= "<td>".$arr[0]."</td>";
            for($i=1 ; $i < sizeof($arr) ; $i++){ $valor = ($arr[$i] != '') ? 'X' : ''; $html_p08 .= "<td>".$valor."</td>";}

            $arr = explode(';', $arrays[2]); $html_p08 .= "<td>".$arr[0]."</td>";
            for($i=1 ; $i < sizeof($arr) ; $i++){ $valor = ($arr[$i] != '') ? 'X' : ''; $html_p08 .= "<td>".$valor."</td>";}

            $arr = explode(';', $arrays[3]); $html_p08 .= "<td>".$arr[0]."</td>";
            for($i=1 ; $i < sizeof($arr) ; $i++){ $valor = ($arr[$i] != '') ? 'X' : ''; $html_p08 .= "<td>".$valor."</td>";}

            $arr = explode(';', $arrays[4]); $html_p08 .= "<td>".$arr[0]."</td>";
            for($i=1 ; $i < sizeof($arr) ; $i++){ $valor = ($arr[$i] != '') ? 'X' : ''; $html_p08 .= "<td>".$valor."</td>";}

            $arr = explode(';', $arrays[5]); $html_p08 .= "<td>".$arr[0]."</td>";
            for($i=1 ; $i < sizeof($arr) ; $i++){ $valor = ($arr[$i] != '') ? 'X' : ''; $html_p08 .= "<td>".$valor."</td>";}

            $arr = explode(';', $arrays[6]); $html_p08 .= "<td>".$arr[0]."</td>";
            for($i=1 ; $i < sizeof($arr) ; $i++){ $valor = ($arr[$i] != '') ? 'X' : ''; $html_p08 .= "<td>".$valor."</td>";}

            $arr = explode(';', $arrays[7]); $html_p08 .= "<td>".$arr[0]."</td>";
            for($i=1 ; $i < sizeof($arr) ; $i++){ $valor = ($arr[$i] != '') ? 'X' : ''; $html_p08 .= "<td>".$valor."</td>";}

            $arr = explode(';', $arrays[8]); $html_p08 .= "<td>".$arr[0]."</td>";
            for($i=1 ; $i < sizeof($arr) ; $i++){ $valor = ($arr[$i] != '') ? 'X' : ''; $html_p08 .= "<td>".$valor."</td>";}

            $arr = explode(';', $arrays[9]); $html_p08 .= "<td>".$arr[0]."</td>";
            for($i=1 ; $i < sizeof($arr) ; $i++){ $valor = ($arr[$i] != '') ? 'X' : ''; $html_p08 .= "<td>".$valor."</td>";}

            $arr = explode(';', $arrays[10]); $html_p08 .= "<td>".$arr[0]."</td>";
            for($i=1 ; $i < sizeof($arr) ; $i++){ $valor = ($arr[$i] != '') ? 'X' : ''; $html_p08 .= "<td>".$valor."</td>";}

            $arr = explode(';', $arrays[11]); $html_p08 .= "<td>".$arr[0]."</td>";
            for($i=1 ; $i < sizeof($arr) ; $i++){ $valor = ($arr[$i] != '') ? 'X' : ''; $html_p08 .= "<td>".$valor."</td>";}

            $arr = explode(';', $arrays[12]); $html_p08 .= "<td>".$arr[0]."</td>";
            for($i=1 ; $i < sizeof($arr) ; $i++){ $valor = ($arr[$i] != '') ? 'X' : ''; $html_p08 .= "<td>".$valor."</td>";}

            $arr = explode(';', $arrays[13]); $html_p08 .= "<td>".$arr[0]."</td>";
            for($i=1 ; $i < sizeof($arr) ; $i++){ $valor = ($arr[$i] != '') ? 'X' : ''; $html_p08 .= "<td>".$valor."</td>";}

            $arr = explode(';', $arrays[14]); $html_p08 .= "<td>".$arr[0]."</td>";
            for($i=1 ; $i < sizeof($arr) ; $i++){ $valor = ($arr[$i] != '') ? 'X' : ''; $html_p08 .= "<td>".$valor."</td>";}

            $arr = explode(';', $arrays[15]); $html_p08 .= "<td>".$arr[0]."</td>";
            for($i=1 ; $i < sizeof($arr) ; $i++){ $valor = ($arr[$i] != '') ? 'X' : ''; $html_p08 .= "<td>".$valor."</td>";}

            $html_p09 = "";
            $p09 = $dato['p09']; $arrays = explode('|', $p09);

            $arr = explode(';', $arrays[0]); $html_p09 .= "<td>".$arr[0]."</td>";
            for($i=1 ; $i < sizeof($arr) ; $i++){ $valor = ($arr[$i] != '') ? 'X' : ''; $html_p09 .= "<td>".$valor."</td>";}

            $arr = explode(';', $arrays[1]); $html_p09 .= "<td>".$arr[0]."</td>";
            for($i=1 ; $i < sizeof($arr) ; $i++){ $valor = ($arr[$i] != '') ? 'X' : ''; $html_p09 .= "<td>".$valor."</td>";}

            $arr = explode(';', $arrays[2]); $html_p09 .= "<td>".$arr[0]."</td>";
            for($i=1 ; $i < sizeof($arr) ; $i++){ $valor = ($arr[$i] != '') ? 'X' : ''; $html_p09 .= "<td>".$valor."</td>";}

            $arr = explode(';', $arrays[3]); $html_p09 .= "<td>".$arr[0]."</td>";
            for($i=1 ; $i < sizeof($arr) ; $i++){ $valor = ($arr[$i] != '') ? 'X' : ''; $html_p09 .= "<td>".$valor."</td>";}

            $html_p10 = "";
            $p10 = $dato['p10']; $arrays = explode('|', $p10);

            $arr = explode(';', $arrays[0]); $html_p10 .= "<td>".$arr[0]."</td>";
            for($i=1 ; $i < sizeof($arr) ; $i++){ $valor = ($arr[$i] != '') ? 'X' : ''; $html_p10 .= "<td>".$valor."</td>";}

            $arr = explode(';', $arrays[1]); $html_p10 .= "<td>".$arr[0]."</td>";
            for($i=1 ; $i < sizeof($arr) ; $i++){ $valor = ($arr[$i] != '') ? 'X' : ''; $html_p10 .= "<td>".$valor."</td>";}

            $arr = explode(';', $arrays[2]); $html_p10 .= "<td>".$arr[0]."</td>";
            for($i=1 ; $i < sizeof($arr) ; $i++){ $valor = ($arr[$i] != '') ? 'X' : ''; $html_p10 .= "<td>".$valor."</td>";}

            $arr = explode(';', $arrays[3]); $html_p10 .= "<td>".$arr[0]."</td>";
            for($i=1 ; $i < sizeof($arr) ; $i++){ $valor = ($arr[$i] != '') ? 'X' : ''; $html_p10 .= "<td>".$valor."</td>";}

            $arr = explode(';', $arrays[4]); $html_p10 .= "<td>".$arr[0]."</td>";
            for($i=1 ; $i < sizeof($arr) ; $i++){ $valor = ($arr[$i] != '') ? 'X' : ''; $html_p10 .= "<td>".$valor."</td>";}

            $arr = explode(';', $arrays[5]); $html_p10 .= "<td>".$arr[0]."</td>";
            for($i=1 ; $i < sizeof($arr) ; $i++){ $valor = ($arr[$i] != '') ? 'X' : ''; $html_p10 .= "<td>".$valor."</td>";}

            $arr = explode(';', $arrays[6]); $html_p10 .= "<td>".$arr[0]."</td>";
            for($i=1 ; $i < sizeof($arr) ; $i++){ $valor = ($arr[$i] != '') ? 'X' : ''; $html_p10 .= "<td>".$valor."</td>";}

            $arr = explode(';', $arrays[7]); $html_p10 .= "<td>".$arr[0]."</td>";
            for($i=1 ; $i < sizeof($arr) ; $i++){ $valor = ($arr[$i] != '') ? 'X' : ''; $html_p10 .= "<td>".$valor."</td>";}

            $arr = explode(';', $arrays[8]); $html_p10 .= "<td>".$arr[0]."</td>";
            for($i=1 ; $i < sizeof($arr) ; $i++){ $valor = ($arr[$i] != '') ? 'X' : ''; $html_p10 .= "<td>".$valor."</td>";}

			$i++;

		echo "
		<tr>
		<td>$i</td>
		<td>$fecha</td>
		<td>$nombre</td>
		<td>$titulo</td>

		<td>$p01</td>
		<td>$p02</td>
		<td>$p03</td>
		<td>$p04</td>
		<td>$p05</td>
        $html_p06
        $html_p07
        $html_p08
        $html_p09
        $html_p10
		</tr>";

		}
	 
	}
?>
</table>		  