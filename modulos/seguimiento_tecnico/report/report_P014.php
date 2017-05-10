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


    <th>Tiene Repetidor 2G/4G</th>
    <th>Estado</th>
    <th>Tipo de repetidor</th>
    <th>Marca</th>
    <th>Modelo</th>
    <th>Celda Donora</th>
    <th>ID Celda Donora</th>

    <th></th><th>Revisado</th><th>Observaciones</th>
    <th></th><th>Revisado</th><th>Observaciones</th>
    <th></th><th>Revisado</th><th>Observaciones</th>
    <th></th><th>Revisado</th><th>Observaciones</th>

    <th>Listar alarmas de Radio Base por LMT (1)</th><th>Causa</th><th>Solucion</th><th>Observaciones</th>
    <th>Listar alarmas de Radio Base por LMT (2)</th><th>Causa</th><th>Solucion</th><th>Observaciones</th>
    <th>Listar alarmas de Radio Base por LMT (3)</th><th>Causa</th><th>Solucion</th><th>Observaciones</th>
    <th>Listar alarmas de Radio Base por LMT (4)</th><th>Causa</th><th>Solucion</th><th>Observaciones</th>
    <th>Listar alarmas de Radio Base por LMT (5)</th><th>Causa</th><th>Solucion</th><th>Observaciones</th>

    <th>Pruebas de servicio (1)</th><th>Numero A</th><th>Numero B</th><th>Prueba exitosa?</th><th>Fecha y hora</th><th>Observaciones</th>
    <th>Pruebas de servicio (2)</th><th>Numero A</th><th>Numero B</th><th>Prueba exitosa?</th><th>Fecha y hora</th><th>Observaciones</th>
    <th>Pruebas de servicio (3)</th><th>Numero A</th><th>Numero B</th><th>Prueba exitosa?</th><th>Fecha y hora</th><th>Observaciones</th>
    <th>Pruebas de servicio (4)</th><th>Numero A</th><th>Numero B</th><th>Prueba exitosa?</th><th>Fecha y hora</th><th>Observaciones</th>
    <th>Pruebas de servicio (5)</th><th>Numero A</th><th>Numero B</th><th>Prueba exitosa?</th><th>Fecha y hora</th><th>Observaciones</th>


</tr>
<?	
	//$consulta="SELECT * FROM st_ticket;";
	$resultado=mysql_query("
	SELECT ev.inicio, es.nombre, f.titulo, f.p01, f.p02, f.p03, f.p04, f.p05, f.p06, f.p07, f.p08, f.p09, f.p10
	FROM formulario_p014 f
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


            $html_p08 = "";
            $p08 = $dato['p08']; $arrays = explode('|', $p08);

            $arr = explode(';', $arrays[0]); $html_p08 .= "<td>".$arr[0]."</td>";
            for($i=1 ; $i < sizeof($arr) ; $i++){ if ($i < sizeof($arr)-1) $valor = ($arr[$i] != '') ? 'X' : ''; else  $valor = $arr[$i]; $html_p08 .= "<td>".$valor."</td>"; }

            $arr = explode(';', $arrays[1]); $html_p08 .= "<td>".$arr[0]."</td>";
            for($i=1 ; $i < sizeof($arr) ; $i++){ if ($i < sizeof($arr)-1) $valor = ($arr[$i] != '') ? 'X' : ''; else  $valor = $arr[$i]; $html_p08 .= "<td>".$valor."</td>"; }

            $arr = explode(';', $arrays[2]); $html_p08 .= "<td>".$arr[0]."</td>";
            for($i=1 ; $i < sizeof($arr) ; $i++){ if ($i < sizeof($arr)-1) $valor = ($arr[$i] != '') ? 'X' : ''; else  $valor = $arr[$i]; $html_p08 .= "<td>".$valor."</td>"; }

            $arr = explode(';', $arrays[3]); $html_p08 .= "<td>".$arr[0]."</td>";
            for($i=1 ; $i < sizeof($arr) ; $i++){ if ($i < sizeof($arr)-1) $valor = ($arr[$i] != '') ? 'X' : ''; else  $valor = $arr[$i]; $html_p08 .= "<td>".$valor."</td>"; }


            $html_p09 = "";
            $p09 = $dato['p09']; $arrays = explode('|', $p09);

            $arr = explode(';', $arrays[0]); for($i=0 ; $i < sizeof($arr) ; $i++){ $html_p09 .= "<td>".$arr[$i]."</td>"; }
            $arr = explode(';', $arrays[1]); for($i=0 ; $i < sizeof($arr) ; $i++){ $html_p09 .= "<td>".$arr[$i]."</td>"; }
            $arr = explode(';', $arrays[2]); for($i=0 ; $i < sizeof($arr) ; $i++){ $html_p09 .= "<td>".$arr[$i]."</td>"; }
            $arr = explode(';', $arrays[3]); for($i=0 ; $i < sizeof($arr) ; $i++){ $html_p09 .= "<td>".$arr[$i]."</td>"; }
            $arr = explode(';', $arrays[4]); for($i=0 ; $i < sizeof($arr) ; $i++){ $html_p09 .= "<td>".$arr[$i]."</td>"; }


            $html_p10 = "";
            $p10 = $dato['p10']; $arrays = explode('|', $p10);

            $arr = explode(';', $arrays[0]); for($i=0 ; $i < sizeof($arr) ; $i++){ $html_p10 .= "<td>".$arr[$i]."</td>"; }
            $arr = explode(';', $arrays[1]); for($i=0 ; $i < sizeof($arr) ; $i++){ $html_p10 .= "<td>".$arr[$i]."</td>"; }
            $arr = explode(';', $arrays[2]); for($i=0 ; $i < sizeof($arr) ; $i++){ $html_p10 .= "<td>".$arr[$i]."</td>"; }
            $arr = explode(';', $arrays[3]); for($i=0 ; $i < sizeof($arr) ; $i++){ $html_p10 .= "<td>".$arr[$i]."</td>"; }
            $arr = explode(';', $arrays[4]); for($i=0 ; $i < sizeof($arr) ; $i++){ $html_p10 .= "<td>".$arr[$i]."</td>"; }

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
		$html_p08
		$html_p09
		$html_p10
		
		</tr>";

		}
	 
	}
?>
</table>		  