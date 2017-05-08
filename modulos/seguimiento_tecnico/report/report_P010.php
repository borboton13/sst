<?php
$idcentro    = $_POST["idcentro"];
$formulario  = $_POST["formulario"];
$fechainicio = $_POST["fechainicio"];
$fechafin    = $_POST["fechafin"];

header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=st_reporte_mtto.xls");
header("Pragma: no-cache");
header("Expires: 0");

$cabecera = array("Malo", "Bajo", "Medio", "Alto", "Reparado", "Ajustado", "Cambiado", "Pendiente");
$cab10 = "";
foreach ($cabecera as $cab){
    $cab10 .= "<th>$cab</th>";
}

?>
<table border="1">
<tr>
    <th>No</th>
    <th>FECHA</th>
    <th>NOM_ESTACION</th>
    <th>TITULO</th>
    <th></th><th>Equipo 1</th><th>Equipo 2</th>
    <th></th><th>Equipo 1</th><th>Equipo 2</th>
    <th></th><th>Equipo 1</th><th>Equipo 2</th>
    <th></th><th>Equipo 1</th><th>Equipo 2</th>
    <th></th><th>Equipo 1</th><th>Equipo 2</th>
    <th></th><th>Equipo 1</th><th>Equipo 2</th>
    <th></th><th>Equipo 1</th><th>Equipo 2</th>
    <th></th><th>Equipo 1</th><th>Equipo 2</th>
    <th></th><?php echo $cab10 ?>
    <th></th><?php echo $cab10 ?>
    <th></th><?php echo $cab10 ?>
    <th></th><?php echo $cab10 ?>
    <th></th><?php echo $cab10 ?>
    <th></th><?php echo $cab10 ?>
    <th></th><?php echo $cab10 ?>
</tr>
<?	
	//$consulta="SELECT * FROM st_ticket;";
	$resultado=mysql_query("
	SELECT ev.inicio, es.nombre, f.titulo, f.p01, f.p02
	FROM formulario_p010 f
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

            $html_p01 = "";
            $p01 = $dato['p01']; $arrays = explode('|', $p01);

            $arr = explode(';', $arrays[0]); for($i=0 ; $i < sizeof($arr) ; $i++){ $html_p01 .= "<td>".$arr[$i]."</td>";}
            $arr = explode(';', $arrays[1]); for($i=0 ; $i < sizeof($arr) ; $i++){ $html_p01 .= "<td>".$arr[$i]."</td>";}
            $arr = explode(';', $arrays[2]); for($i=0 ; $i < sizeof($arr) ; $i++){ $html_p01 .= "<td>".$arr[$i]."</td>";}
            $arr = explode(';', $arrays[3]); for($i=0 ; $i < sizeof($arr) ; $i++){ $html_p01 .= "<td>".$arr[$i]."</td>";}
            $arr = explode(';', $arrays[4]); for($i=0 ; $i < sizeof($arr) ; $i++){ $html_p01 .= "<td>".$arr[$i]."</td>";}
            $arr = explode(';', $arrays[5]); for($i=0 ; $i < sizeof($arr) ; $i++){ $html_p01 .= "<td>".$arr[$i]."</td>";}
            $arr = explode(';', $arrays[6]); for($i=0 ; $i < sizeof($arr) ; $i++){ $html_p01 .= "<td>".$arr[$i]."</td>";}
            $arr = explode(';', $arrays[7]); for($i=0 ; $i < sizeof($arr) ; $i++){ $html_p01 .= "<td>".$arr[$i]."</td>";}

            $html_p02 = "";
            $p02 = $dato['p02']; $arrays = explode('|', $p02);

            $arr = explode(';', $arrays[0]); $html_p02 .= "<td>".$arr[0]."</td>";
            for($i=1 ; $i < sizeof($arr) ; $i++){ $valor = ($arr[$i] != '') ? 'X' : ''; $html_p02 .= "<td>".$valor."</td>";}

            $arr = explode(';', $arrays[1]); $html_p02 .= "<td>".$arr[0]."</td>";
            for($i=1 ; $i < sizeof($arr) ; $i++){ $valor = ($arr[$i] != '') ? 'X' : ''; $html_p02 .= "<td>".$valor."</td>";}

            $arr = explode(';', $arrays[2]); $html_p02 .= "<td>".$arr[0]."</td>";
            for($i=1 ; $i < sizeof($arr) ; $i++){ $valor = ($arr[$i] != '') ? 'X' : ''; $html_p02 .= "<td>".$valor."</td>";}

            $arr = explode(';', $arrays[3]); $html_p02 .= "<td>".$arr[0]."</td>";
            for($i=1 ; $i < sizeof($arr) ; $i++){ $valor = ($arr[$i] != '') ? 'X' : ''; $html_p02 .= "<td>".$valor."</td>";}

            $arr = explode(';', $arrays[4]); $html_p02 .= "<td>".$arr[0]."</td>";
            for($i=1 ; $i < sizeof($arr) ; $i++){ $valor = ($arr[$i] != '') ? 'X' : ''; $html_p02 .= "<td>".$valor."</td>";}

            $arr = explode(';', $arrays[5]); $html_p02 .= "<td>".$arr[0]."</td>";
            for($i=1 ; $i < sizeof($arr) ; $i++){ $valor = ($arr[$i] != '') ? 'X' : ''; $html_p02 .= "<td>".$valor."</td>";}

            $arr = explode(';', $arrays[6]); $html_p02 .= "<td>".$arr[0]."</td>";
            for($i=1 ; $i < sizeof($arr) ; $i++){ $valor = ($arr[$i] != '') ? 'X' : ''; $html_p02 .= "<td>".$valor."</td>";}

			$i++;

		echo "
		<tr>
		<td>$i</td>
		<td>$fecha</td>
		<td>$nombre</td>
		<td>$titulo</td>
        $html_p01
        $html_p02
		</tr>";

		}
	 
	}
?>
</table>		  