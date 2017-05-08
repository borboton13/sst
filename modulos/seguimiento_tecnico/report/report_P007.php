<?php
$idcentro    = $_POST["idcentro"];
$formulario  = $_POST["formulario"];
$fechainicio = $_POST["fechainicio"];
$fechafin    = $_POST["fechafin"];

header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=st_reporte_mtto.xls");
header("Pragma: no-cache");
header("Expires: 0");

$cabsP10 = array("No. Celda","Voltaje Descarga [V]","Temperatura [°C]","Densidad [Baumes]","Tpo de descarga y/o obs");
$cabP10 = "";
for($i=1 ; $i <= 31 ; $i++){
    foreach ($cabsP10 as $cab){
        $cabP10 .= "<th>$cab</th>";
    }
}

?>
<table border="1">
<tr>
    <th>No</th>
    <th>FECHA</th>
    <th>NOM_ESTACION</th>
    <th>TITULO</th>
    <th>Tiene Banco de Baterias</th>
    <th>Estado</th>
    <th>Marca</th>
    <th>Modelo</th>
    <th>Voltaje (V)</th>
    <th>Capacidad (Ah)</th>
    <th>Cantidad</th>
    <th>Autonomia Real</th>
    <th>Tiene gabinete propio</th>
    <?php echo $cabP10; ?>
    <th>Verificar conexiones en bornes (ajustados)</th>
    <th>Verificar limpieza de los Bornes</th>
    <th>Verificar nivel de Agua Destilada</th>
    <th>Porcentaje de carga Banco de Baterias en Servicio (%)</th>

</tr>
<?	
	//$consulta="SELECT * FROM st_ticket;";
	$resultado=mysql_query("
	SELECT ev.inicio, es.nombre, f.titulo, f.p01, f.p02, f.p03, f.p04, f.p05, f.p06, f.p07, f.p08, f.p09, f.p10, f.p11, f.p12, f.p13, f.p14
	FROM formulario_p007 f
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

            $html_p10 = "";
            $p10 = $dato['p10']; $arrays = explode('|', $p10);

            $arr = explode(';', $arrays[0]); for($i=0 ; $i < sizeof($arr) ; $i++){ $html_p10 .= "<td>".$arr[$i]."</td>";}
            $arr = explode(';', $arrays[1]); for($i=0 ; $i < sizeof($arr) ; $i++){ $html_p10 .= "<td>".$arr[$i]."</td>";}
            $arr = explode(';', $arrays[2]); for($i=0 ; $i < sizeof($arr) ; $i++){ $html_p10 .= "<td>".$arr[$i]."</td>";}
            $arr = explode(';', $arrays[3]); for($i=0 ; $i < sizeof($arr) ; $i++){ $html_p10 .= "<td>".$arr[$i]."</td>";}
            $arr = explode(';', $arrays[4]); for($i=0 ; $i < sizeof($arr) ; $i++){ $html_p10 .= "<td>".$arr[$i]."</td>";}
            $arr = explode(';', $arrays[5]); for($i=0 ; $i < sizeof($arr) ; $i++){ $html_p10 .= "<td>".$arr[$i]."</td>";}
            $arr = explode(';', $arrays[6]); for($i=0 ; $i < sizeof($arr) ; $i++){ $html_p10 .= "<td>".$arr[$i]."</td>";}
            $arr = explode(';', $arrays[7]); for($i=0 ; $i < sizeof($arr) ; $i++){ $html_p10 .= "<td>".$arr[$i]."</td>";}
            $arr = explode(';', $arrays[8]); for($i=0 ; $i < sizeof($arr) ; $i++){ $html_p10 .= "<td>".$arr[$i]."</td>";}
            $arr = explode(';', $arrays[9]); for($i=0 ; $i < sizeof($arr) ; $i++){ $html_p10 .= "<td>".$arr[$i]."</td>";}
            $arr = explode(';', $arrays[10]); for($i=0 ; $i < sizeof($arr) ; $i++){ $html_p10 .= "<td>".$arr[$i]."</td>";}
            $arr = explode(';', $arrays[11]); for($i=0 ; $i < sizeof($arr) ; $i++){ $html_p10 .= "<td>".$arr[$i]."</td>";}
            $arr = explode(';', $arrays[12]); for($i=0 ; $i < sizeof($arr) ; $i++){ $html_p10 .= "<td>".$arr[$i]."</td>";}
            $arr = explode(';', $arrays[13]); for($i=0 ; $i < sizeof($arr) ; $i++){ $html_p10 .= "<td>".$arr[$i]."</td>";}
            $arr = explode(';', $arrays[14]); for($i=0 ; $i < sizeof($arr) ; $i++){ $html_p10 .= "<td>".$arr[$i]."</td>";}
            $arr = explode(';', $arrays[15]); for($i=0 ; $i < sizeof($arr) ; $i++){ $html_p10 .= "<td>".$arr[$i]."</td>";}
            $arr = explode(';', $arrays[16]); for($i=0 ; $i < sizeof($arr) ; $i++){ $html_p10 .= "<td>".$arr[$i]."</td>";}
            $arr = explode(';', $arrays[17]); for($i=0 ; $i < sizeof($arr) ; $i++){ $html_p10 .= "<td>".$arr[$i]."</td>";}
            $arr = explode(';', $arrays[18]); for($i=0 ; $i < sizeof($arr) ; $i++){ $html_p10 .= "<td>".$arr[$i]."</td>";}
            $arr = explode(';', $arrays[19]); for($i=0 ; $i < sizeof($arr) ; $i++){ $html_p10 .= "<td>".$arr[$i]."</td>";}
            $arr = explode(';', $arrays[20]); for($i=0 ; $i < sizeof($arr) ; $i++){ $html_p10 .= "<td>".$arr[$i]."</td>";}
            $arr = explode(';', $arrays[21]); for($i=0 ; $i < sizeof($arr) ; $i++){ $html_p10 .= "<td>".$arr[$i]."</td>";}
            $arr = explode(';', $arrays[22]); for($i=0 ; $i < sizeof($arr) ; $i++){ $html_p10 .= "<td>".$arr[$i]."</td>";}
            $arr = explode(';', $arrays[23]); for($i=0 ; $i < sizeof($arr) ; $i++){ $html_p10 .= "<td>".$arr[$i]."</td>";}
            $arr = explode(';', $arrays[24]); for($i=0 ; $i < sizeof($arr) ; $i++){ $html_p10 .= "<td>".$arr[$i]."</td>";}
            $arr = explode(';', $arrays[25]); for($i=0 ; $i < sizeof($arr) ; $i++){ $html_p10 .= "<td>".$arr[$i]."</td>";}
            $arr = explode(';', $arrays[26]); for($i=0 ; $i < sizeof($arr) ; $i++){ $html_p10 .= "<td>".$arr[$i]."</td>";}
            $arr = explode(';', $arrays[27]); for($i=0 ; $i < sizeof($arr) ; $i++){ $html_p10 .= "<td>".$arr[$i]."</td>";}
            $arr = explode(';', $arrays[28]); for($i=0 ; $i < sizeof($arr) ; $i++){ $html_p10 .= "<td>".$arr[$i]."</td>";}
            $arr = explode(';', $arrays[29]); for($i=0 ; $i < sizeof($arr) ; $i++){ $html_p10 .= "<td>".$arr[$i]."</td>";}
            $arr = explode(';', $arrays[30]); for($i=0 ; $i < sizeof($arr) ; $i++){ $html_p10 .= "<td>".$arr[$i]."</td>";}

            $p11 = $dato['p11'];
            $p12 = $dato['p12'];
            $p13 = $dato['p13'];
            $p14 = $dato['p14'];

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
		$html_p10
		<td>$p11</td>
		<td>$p12</td>
		<td>$p13</td>
		<td>$p14</td>
		</tr>";

		}
	 
	}
?>
</table>		  