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

    <th>Se tiene modems?</th>
    <th>Estado</th>
    <th>Marca</th>
    <th>Modelo</th>
    <th>Salto anterior</th>

    <th></th><th>Revisado</th><th>Observaciones</th>
    <th></th><th>Revisado</th><th>Observaciones</th>
    <th></th><th>Revisado</th><th>Observaciones</th>
    <th></th><th>Revisado</th><th>Observaciones</th>

    <th>Listar alarmas de Radio Base por LMT (1)</th><th>Causa</th><th>Solucion</th><th>Observaciones</th>
    <th>Listar alarmas de Radio Base por LMT (2)</th><th>Causa</th><th>Solucion</th><th>Observaciones</th>
    <th>Listar alarmas de Radio Base por LMT (3)</th><th>Causa</th><th>Solucion</th><th>Observaciones</th>
    <th>Listar alarmas de Radio Base por LMT (4)</th><th>Causa</th><th>Solucion</th><th>Observaciones</th>
    <th>Listar alarmas de Radio Base por LMT (5)</th><th>Causa</th><th>Solucion</th><th>Observaciones</th>



</tr>
<?	
	//$consulta="SELECT * FROM st_ticket;";
	$resultado=mysql_query("
	SELECT ev.inicio, es.nombre, f.titulo, f.p01, f.p02, f.p03, f.p04, f.p05, f.p06, f.p07
	FROM formulario_p017 f
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

            $arr = explode(';', $arrays[0]); $html_p06 .= "<td>".$arr[0]."</td>";
            for($i=1 ; $i < sizeof($arr) ; $i++){ if ($i < sizeof($arr)-1) $valor = ($arr[$i] != '') ? 'X' : ''; else  $valor = $arr[$i]; $html_p06 .= "<td>".$valor."</td>"; }

            $arr = explode(';', $arrays[1]); $html_p06 .= "<td>".$arr[0]."</td>";
            for($i=1 ; $i < sizeof($arr) ; $i++){ if ($i < sizeof($arr)-1) $valor = ($arr[$i] != '') ? 'X' : ''; else  $valor = $arr[$i]; $html_p06 .= "<td>".$valor."</td>"; }

            $arr = explode(';', $arrays[2]); $html_p06 .= "<td>".$arr[0]."</td>";
            for($i=1 ; $i < sizeof($arr) ; $i++){ if ($i < sizeof($arr)-1) $valor = ($arr[$i] != '') ? 'X' : ''; else  $valor = $arr[$i]; $html_p06 .= "<td>".$valor."</td>"; }

            $arr = explode(';', $arrays[3]); $html_p06 .= "<td>".$arr[0]."</td>";
            for($i=1 ; $i < sizeof($arr) ; $i++){ if ($i < sizeof($arr)-1) $valor = ($arr[$i] != '') ? 'X' : ''; else  $valor = $arr[$i]; $html_p06 .= "<td>".$valor."</td>"; }


            $html_p07 = "";
            $p07 = $dato['p07']; $arrays = explode('|', $p07);

            $arr = explode(';', $arrays[0]); for($i=0 ; $i < sizeof($arr) ; $i++){ $html_p07 .= "<td>".$arr[$i]."</td>"; }
            $arr = explode(';', $arrays[1]); for($i=0 ; $i < sizeof($arr) ; $i++){ $html_p07 .= "<td>".$arr[$i]."</td>"; }
            $arr = explode(';', $arrays[2]); for($i=0 ; $i < sizeof($arr) ; $i++){ $html_p07 .= "<td>".$arr[$i]."</td>"; }
            $arr = explode(';', $arrays[3]); for($i=0 ; $i < sizeof($arr) ; $i++){ $html_p07 .= "<td>".$arr[$i]."</td>"; }
            $arr = explode(';', $arrays[4]); for($i=0 ; $i < sizeof($arr) ; $i++){ $html_p07 .= "<td>".$arr[$i]."</td>"; }

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
		</tr>";

		}
	 
	}
?>
</table>		  