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
    <th>Tiene paneles solares</th>
    <th>Estado</th>
    <th>Marca</th>
    <th>Modelo</th>
    <th>Serie</th>
    <th>Capacidad (W)</th>
    <th>Voltaje (V)</th>
    <th>Cantidad</th>
    <th>Marca controlador solar</th>
    <th>Limpieza de paneles</th>
    <th>Voltaje de entrada al controlador</th>
    <th>Conexiones eléctricas en el arreglo solar</th>
    <th>Voltaje de salida al controlador</th>
    <th>Voltaje de arreglo de paneles solares</th>
    <th>Corriente de salida del controlador</th>
</tr>
<?	
	//$consulta="SELECT * FROM st_ticket;";
	$resultado=mysql_query("
	SELECT ev.inicio, es.nombre, f.titulo, f.p01, f.p02, f.p03, f.p04, f.p05, f.p06, f.p07, f.p08, f.p09, f.p10, f.p11, f.p12, f.p13, f.p14, f.p15
	FROM formulario_p008 f
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
            $p12 = $dato['p12'];
            $p13 = $dato['p13'];
            $p14 = $dato['p14'];
            $p15 = $dato['p15'];

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
		<td>$p12</td>
		<td>$p13</td>
		<td>$p14</td>
		<td>$p15</td>
		</tr>";

		}
	 
	}
?>
</table>		  