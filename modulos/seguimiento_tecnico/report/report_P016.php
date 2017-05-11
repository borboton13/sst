<?php
$idcentro    = $_POST["idcentro"];
$formulario  = $_POST["formulario"];
$fechainicio = $_POST["fechainicio"];
$fechafin    = $_POST["fechafin"];

header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=st_reporte_mtto.xls");
header("Pragma: no-cache");
header("Expires: 0");

?>
<table border="1">
<tr>
    <th>No</th>
    <th>FECHA</th>
    <th>NOM_ESTACION</th>
    <th>TITULO</th>

    <th>Se tiene equipo satelital?</th>
    <th>Estado</th>
    <th>Marca</th>
    <th>Modelo</th>
    <th>Rx Signal(Eb/No) dB</th>
    <th>Nivel enlace (Downstream) dB</th>
    <th>Nivel enlace (UPsstream) dB</th>
    <th>Capacidad</th>
    <th>Ancho de banda utilizado (Kbps)</th>
    <th>Frecuencia de trabajo</th>
    <th>Configuración</th>

    <th></th><th>Revisado</th><th>Observaciones</th>
    <th></th><th>Revisado</th><th>Observaciones</th>
    <th></th><th>Revisado</th><th>Observaciones</th>
    <th></th><th>Revisado</th><th>Observaciones</th>

    <th>Ping</th><th>Estado</th><th>IP</th><th>Observaciones</th>
    <th>Ping</th><th>Estado</th><th>IP</th><th>Observaciones</th>
    <th>Ping</th><th>Estado</th><th>IP</th><th>Observaciones</th>
    <th>Ping</th><th>Estado</th><th>IP</th><th>Observaciones</th>
    <th>Ping</th><th>Estado</th><th>IP</th><th>Observaciones</th>


</tr>
<?	
	//$consulta="SELECT * FROM st_ticket;";
	$resultado=mysql_query("
	SELECT ev.inicio, es.nombre, f.titulo, f.p01, f.p02, f.p03, f.p04, f.p05, f.p06, f.p07, f.p08, f.p09, f.p10, f.p11, f.p12, f.p13
	FROM formulario_p016 f
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
            $p06 = $dato['p06'];
            $p07 = $dato['p07'];
            $p08 = $dato['p08'];
            $p09 = $dato['p09'];
            $p10 = $dato['p10'];
            $p11 = $dato['p11'];

            $html_p12 = "";
            $p12 = $dato['p12']; $arrays = explode('|', $p12);

            $arr = explode(';', $arrays[0]); $html_p12 .= "<td>".$arr[0]."</td>";
            for($i=1 ; $i < sizeof($arr) ; $i++){ if ($i < sizeof($arr)-1) $valor = ($arr[$i] != '') ? 'X' : ''; else  $valor = $arr[$i]; $html_p12 .= "<td>".$valor."</td>"; }

            $arr = explode(';', $arrays[1]); $html_p12 .= "<td>".$arr[0]."</td>";
            for($i=1 ; $i < sizeof($arr) ; $i++){ if ($i < sizeof($arr)-1) $valor = ($arr[$i] != '') ? 'X' : ''; else  $valor = $arr[$i]; $html_p12 .= "<td>".$valor."</td>"; }

            $arr = explode(';', $arrays[2]); $html_p12 .= "<td>".$arr[0]."</td>";
            for($i=1 ; $i < sizeof($arr) ; $i++){ if ($i < sizeof($arr)-1) $valor = ($arr[$i] != '') ? 'X' : ''; else  $valor = $arr[$i]; $html_p12 .= "<td>".$valor."</td>"; }

            $arr = explode(';', $arrays[3]); $html_p12 .= "<td>".$arr[0]."</td>";
            for($i=1 ; $i < sizeof($arr) ; $i++){ if ($i < sizeof($arr)-1) $valor = ($arr[$i] != '') ? 'X' : ''; else  $valor = $arr[$i]; $html_p12 .= "<td>".$valor."</td>"; }

            $html_p13 = "";
            $p13 = $dato['p13']; $arrays = explode('|', $p13);

            $arr = explode(';', $arrays[0]); for($i=0 ; $i < sizeof($arr) ; $i++){ $html_p13 .= "<td>".$arr[$i]."</td>"; }
            $arr = explode(';', $arrays[1]); for($i=0 ; $i < sizeof($arr) ; $i++){ $html_p13 .= "<td>".$arr[$i]."</td>"; }
            $arr = explode(';', $arrays[2]); for($i=0 ; $i < sizeof($arr) ; $i++){ $html_p13 .= "<td>".$arr[$i]."</td>"; }
            $arr = explode(';', $arrays[3]); for($i=0 ; $i < sizeof($arr) ; $i++){ $html_p13 .= "<td>".$arr[$i]."</td>"; }
            $arr = explode(';', $arrays[4]); for($i=0 ; $i < sizeof($arr) ; $i++){ $html_p13 .= "<td>".$arr[$i]."</td>"; }

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
		<td>$p06</td>
		<td>$p07</td>
		<td>$p08</td>
		<td>$p09</td>
		<td>$p10</td>
		<td>$p11</td>
		$html_p12
		$html_p13
		</tr>";

		}
	 
	}
?>
</table>		  