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
    <th colspan="3">ESTRUCTURA 1</th>
    <th colspan="3">ESTRUCTURA 2</th>
</tr>
<tr>
    <th>No</th>
    <th>FECHA</th>
    <th>NOM_ESTACION</th>
    <th>TITULO</th>
    <th>Estado</th>
    <th>Tipo de esctructura</th>
    <th>Altura de la estructura (m)</th>
    <th>Estado</th>
    <th>Tipo de esctructura</th>
    <th>Altura de la estructura (m)</th>
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
	SELECT ev.inicio, es.nombre, f.titulo, f.p01, f.p02, f.p03, f.p04, f.p05, f.p06, f.p07
	FROM formulario_p002 f
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

            $html_p07 = "";
            $p07 = $dato['p07']; $arrays = explode('|', $p07);

            $arr = explode(';', $arrays[0]); $html_p07 .= "<td>".$arr[0]."</td>";
            for($i=1 ; $i < sizeof($arr) ; $i++){ $valor = ($arr[$i] != '') ? 'X' : ''; $html_p07 .= "<td>".$valor."</td>";}

            $arr = explode(';', $arrays[1]); $html_p07 .= "<td>".$arr[0]."</td>";
            for($i=1 ; $i < sizeof($arr) ; $i++){ $valor = ($arr[$i] != '') ? 'X' : ''; $html_p07 .= "<td>".$valor."</td>";}

            $arr = explode(';', $arrays[2]); $html_p07 .= "<td>".$arr[0]."</td>";
            for($i=1 ; $i < sizeof($arr) ; $i++){ $valor = ($arr[$i] != '') ? 'X' : ''; $html_p07 .= "<td>".$valor."</td>";}

            $arr = explode(';', $arrays[3]); $html_p07 .= "<td>".$arr[0]."</td>";
            for($i=1 ; $i < sizeof($arr) ; $i++){ $valor = ($arr[$i] != '') ? 'X' : ''; $html_p07 .= "<td>".$valor."</td>";}


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
        $html_p07
		</tr>";

		}
	 
	}
?>
</table>		  