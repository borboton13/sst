<?php
//require("../funciones/motor.php");
//$nro = base64_decode($_GET["nro"]);

$fechainicio = $_POST["fechainicio"];
$fechafin = $_POST["fechafin"];

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
<th>Tiene Rectificador</th>
<th>Estado</th>
<th>Marca</th>
<th>Modelo</th>
<th>Serie</th>
<th>Voltaje (V)</th>
<th>Capacidad (KVA)</th>
<th>Cantidad de módulos</th>
<th>Corriente DC hacia la carga técnica de la estación [A]</th>
<th>Corriente DC hacia el banco de baterías de la estación [A]</th>
<th>Configuración de Parametros</th>
<th>Verificar y controlar la distribución de AC/DC en tableros</th>
<th>Revisión de sobrecalentamiento del cableado en AC/DC</th>
<th>Alarmas Activas</th>

	<th>Descripcion</th>
	<th>Fase 1</th>
	<th>Fase 2</th>
	<th>Fase 3</th>
	<th>Fase 1</th>
	<th>Fase 2</th>
	<th>Fase 3</th>

	<th>Descripcion</th>
	<th>Fase 1</th>
	<th>Fase 2</th>
	<th>Fase 3</th>
	<th>Fase 1</th>
	<th>Fase 2</th>
	<th>Fase 3</th>

	<th>Descripcion</th>
	<th>Fase 1</th>
	<th>Fase 2</th>
	<th>Fase 3</th>
	<th>Fase 1</th>
	<th>Fase 2</th>
	<th>Fase 3</th>

	<th>Descripcion</th>
	<th>Fase 1</th>
	<th>Fase 2</th>
	<th>Fase 3</th>
	<th>Fase 1</th>
	<th>Fase 2</th>
	<th>Fase 3</th>

</tr>
<?	
	//$consulta="SELECT * FROM st_ticket;";
	$resultado=mysql_query("
	SELECT ev.inicio, es.nombre, f.titulo, f.p01, f.p02, f.p03, f.p04, f.p05, f.p06, f.p07, f.p08, f.p09, f.p10, f.p11, f.p12, f.p13, f.p14, f.p15
	FROM formulario_p009 f
	JOIN evento ev   ON f.idevento = ev.idevento
	JOIN estacion es ON ev.idestacion = es.idestacion
	WHERE ev.inicio BETWEEN '2017-01-01' AND '2017-01-31';
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


			$arrays = explode('|', $p09);
			$arr_f1 = explode(';', $arrays[0]);
			$arr_f2 = explode(';', $arrays[1]);
			$arr_f3 = explode(';', $arrays[2]);
			$arr_f4 = explode(';', $arrays[3]);

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

		<td>$p10</td>
		<td>$p11</td>
		<td>$p12</td>
		<td>$p13</td>
		<td>$p14</td>
		<td>$p15</td>

		<td>$arr_f1[0]</td>
		<td>$arr_f1[1]</td>
		<td>$arr_f1[2]</td>
		<td>$arr_f1[3]</td>
		<td>$arr_f1[4]</td>
		<td>$arr_f1[5]</td>
		<td>$arr_f1[6]</td>

		<td>$arr_f1[0]</td>
		<td>$arr_f2[1]</td>
		<td>$arr_f2[2]</td>
		<td>$arr_f2[3]</td>
		<td>$arr_f2[4]</td>
		<td>$arr_f2[5]</td>
		<td>$arr_f2[6]</td>

		<td>$arr_f3[0]</td>
		<td>$arr_f3[1]</td>
		<td>$arr_f3[2]</td>
		<td>$arr_f3[3]</td>
		<td>$arr_f3[4]</td>
		<td>$arr_f3[5]</td>
		<td>$arr_f3[6]</td>

		<td>$arr_f4[0]</td>
		<td>$arr_f4[1]</td>
		<td>$arr_f4[2]</td>
		<td>$arr_f4[3]</td>
		<td>$arr_f4[4]</td>
		<td>$arr_f4[5]</td>
		<td>$arr_f4[6]</td>

		</tr>";

		}
	 
	}
?>
</table>		  