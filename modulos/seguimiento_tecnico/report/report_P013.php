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
    <th>Tiene Radio Base</th>
    <th>Nombre Radio Base</th>
    <th>ID Radio Base</th>
    <th>Estado</th>
    <th>Marca</th>
    <th>Modelo</th>
    <th>Tipo de transmision</th>
    <th>Salto Anterior</th>
    <th>Interface</th>
    <th>Equipo de transmisión</th>
    <th>Energía principal</th>
    <th>Energía Respaldo</th>
    <th></th><th>Revisado</th><th>Observaciones</th>
    <th></th><th>Revisado</th><th>Observaciones</th>
    <th></th><th>Revisado</th><th>Observaciones</th>
    <th></th><th>Revisado</th><th>Observaciones</th>
    <th></th><th>Revisado</th><th>Observaciones</th>
    <th>Listar alarmas de Radio Base por LMT (1)</th><th>Causa</th><th>Solucion</th><th>Observaciones</th>
    <th>Listar alarmas de Radio Base por LMT (2)</th><th>Causa</th><th>Solucion</th><th>Observaciones</th>
    <th>Listar alarmas de Radio Base por LMT (3)</th><th>Causa</th><th>Solucion</th><th>Observaciones</th>
    <th>Listar alarmas de Radio Base por LMT (4)</th><th>Causa</th><th>Solucion</th><th>Observaciones</th>
    <th>Listar alarmas de Radio Base por LMT (5)</th><th>Causa</th><th>Solucion</th><th>Observaciones</th>
    <!--$html_p15-->
    <th>Verificar alarmas</th><th>Estado</th><th>Observaciones</th>
    <th>Verificar alarmas</th><th>Estado</th><th>Observaciones</th>
    <th>Verificar alarmas</th><th>Estado</th><th>Observaciones</th>
    <th>Verificar alarmas</th><th>Estado</th><th>Observaciones</th>
    <th>Verificar alarmas</th><th>Estado</th><th>Observaciones</th>
    <th>Verificar alarmas</th><th>Estado</th><th>Observaciones</th>
    <th>Verificar alarmas</th><th>Estado</th><th>Observaciones</th>
    <th>Verificar alarmas</th><th>Estado</th><th>Observaciones</th>
    <th>Verificar alarmas</th><th>Estado</th><th>Observaciones</th>
    <th>Verificar alarmas</th><th>Estado</th><th>Observaciones</th>
    <th>Verificar alarmas</th><th>Estado</th><th>Observaciones</th>
    <th>Verificar alarmas</th><th>Estado</th><th>Observaciones</th>
    <!--$html_p16-->
    <th>Pruebas de servicio</th><th>Numero A</th><th>Numero B</th><th>Prueba exitosa?</th><th>Fecha y hora</th><th>Observaciones</th>
    <th>Pruebas de servicio</th><th>Numero A</th><th>Numero B</th><th>Prueba exitosa?</th><th>Fecha y hora</th><th>Observaciones</th>
    <th>Pruebas de servicio</th><th>Numero A</th><th>Numero B</th><th>Prueba exitosa?</th><th>Fecha y hora</th><th>Observaciones</th>
    <th>Pruebas de servicio</th><th>Numero A</th><th>Numero B</th><th>Prueba exitosa?</th><th>Fecha y hora</th><th>Observaciones</th>
    <th>Pruebas de servicio</th><th>Numero A</th><th>Numero B</th><th>Prueba exitosa?</th><th>Fecha y hora</th><th>Observaciones</th>
    <!--$html_p17-->
    <th>Sector</th><th>ID Celda</th><th>Tipo de antena</th><th>Marca</th><th>Modelo</th><th>Azimuth</th><th>Tilt Mecanico</th><th>Tilt Electrico</th><th>Angulo apertura</th><th>Altura antena</th><th>Cant TMA/RRU</th><th>Marca TMA/RRU</th><th>Modelo TMA/RRU</th><th>Tiene RET</th>
    <th>Sector</th><th>ID Celda</th><th>Tipo de antena</th><th>Marca</th><th>Modelo</th><th>Azimuth</th><th>Tilt Mecanico</th><th>Tilt Electrico</th><th>Angulo apertura</th><th>Altura antena</th><th>Cant TMA/RRU</th><th>Marca TMA/RRU</th><th>Modelo TMA/RRU</th><th>Tiene RET</th>
    <th>Sector</th><th>ID Celda</th><th>Tipo de antena</th><th>Marca</th><th>Modelo</th><th>Azimuth</th><th>Tilt Mecanico</th><th>Tilt Electrico</th><th>Angulo apertura</th><th>Altura antena</th><th>Cant TMA/RRU</th><th>Marca TMA/RRU</th><th>Modelo TMA/RRU</th><th>Tiene RET</th>
    <th>Sector</th><th>ID Celda</th><th>Tipo de antena</th><th>Marca</th><th>Modelo</th><th>Azimuth</th><th>Tilt Mecanico</th><th>Tilt Electrico</th><th>Angulo apertura</th><th>Altura antena</th><th>Cant TMA/RRU</th><th>Marca TMA/RRU</th><th>Modelo TMA/RRU</th><th>Tiene RET</th>
    <th>Sector</th><th>ID Celda</th><th>Tipo de antena</th><th>Marca</th><th>Modelo</th><th>Azimuth</th><th>Tilt Mecanico</th><th>Tilt Electrico</th><th>Angulo apertura</th><th>Altura antena</th><th>Cant TMA/RRU</th><th>Marca TMA/RRU</th><th>Modelo TMA/RRU</th><th>Tiene RET</th>
    <th>Sector</th><th>ID Celda</th><th>Tipo de antena</th><th>Marca</th><th>Modelo</th><th>Azimuth</th><th>Tilt Mecanico</th><th>Tilt Electrico</th><th>Angulo apertura</th><th>Altura antena</th><th>Cant TMA/RRU</th><th>Marca TMA/RRU</th><th>Modelo TMA/RRU</th><th>Tiene RET</th>
    <th>Sector</th><th>ID Celda</th><th>Tipo de antena</th><th>Marca</th><th>Modelo</th><th>Azimuth</th><th>Tilt Mecanico</th><th>Tilt Electrico</th><th>Angulo apertura</th><th>Altura antena</th><th>Cant TMA/RRU</th><th>Marca TMA/RRU</th><th>Modelo TMA/RRU</th><th>Tiene RET</th>
    <th>Sector</th><th>ID Celda</th><th>Tipo de antena</th><th>Marca</th><th>Modelo</th><th>Azimuth</th><th>Tilt Mecanico</th><th>Tilt Electrico</th><th>Angulo apertura</th><th>Altura antena</th><th>Cant TMA/RRU</th><th>Marca TMA/RRU</th><th>Modelo TMA/RRU</th><th>Tiene RET</th>
    <th>Sector</th><th>ID Celda</th><th>Tipo de antena</th><th>Marca</th><th>Modelo</th><th>Azimuth</th><th>Tilt Mecanico</th><th>Tilt Electrico</th><th>Angulo apertura</th><th>Altura antena</th><th>Cant TMA/RRU</th><th>Marca TMA/RRU</th><th>Modelo TMA/RRU</th><th>Tiene RET</th>
    <th>Sector</th><th>ID Celda</th><th>Tipo de antena</th><th>Marca</th><th>Modelo</th><th>Azimuth</th><th>Tilt Mecanico</th><th>Tilt Electrico</th><th>Angulo apertura</th><th>Altura antena</th><th>Cant TMA/RRU</th><th>Marca TMA/RRU</th><th>Modelo TMA/RRU</th><th>Tiene RET</th>

    <th></th><th>Revisado</th><th>Observaciones</th>
    <th></th><th>Revisado</th><th>Observaciones</th>
    <th></th><th>Revisado</th><th>Observaciones</th>
    <th></th><th>Revisado</th><th>Observaciones</th>
    <th></th><th>Revisado</th><th>Observaciones</th>
    <th></th><th>Revisado</th><th>Observaciones</th>
    <th></th><th>Revisado</th><th>Observaciones</th>

</tr>
<?	
	//$consulta="SELECT * FROM st_ticket;";
	$resultado=mysql_query("
	SELECT ev.inicio, es.nombre, f.titulo, f.p01, f.p02, f.p03, f.p04, f.p05, f.p06, f.p07, f.p08, f.p09, f.p10, f.p11, f.p12, f.p13, f.p14, f.p15, f.p16, f.p17, f.p18
	FROM formulario_p013 f
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

            $html_p13 = "";
            $p13 = $dato['p13']; $arrays = explode('|', $p13);

            $arr = explode(';', $arrays[0]); $html_p13 .= "<td>".$arr[0]."</td>";
            for($i=1 ; $i < sizeof($arr) ; $i++){ if ($i < sizeof($arr)-1) $valor = ($arr[$i] != '') ? 'X' : ''; else  $valor = $arr[$i]; $html_p13 .= "<td>".$valor."</td>"; }

            $arr = explode(';', $arrays[1]); $html_p13 .= "<td>".$arr[0]."</td>";
            for($i=1 ; $i < sizeof($arr) ; $i++){ if ($i < sizeof($arr)-1) $valor = ($arr[$i] != '') ? 'X' : ''; else  $valor = $arr[$i]; $html_p13 .= "<td>".$valor."</td>"; }

            $arr = explode(';', $arrays[2]); $html_p13 .= "<td>".$arr[0]."</td>";
            for($i=1 ; $i < sizeof($arr) ; $i++){ if ($i < sizeof($arr)-1) $valor = ($arr[$i] != '') ? 'X' : ''; else  $valor = $arr[$i]; $html_p13 .= "<td>".$valor."</td>"; }

            $arr = explode(';', $arrays[3]); $html_p13 .= "<td>".$arr[0]."</td>";
            for($i=1 ; $i < sizeof($arr) ; $i++){ if ($i < sizeof($arr)-1) $valor = ($arr[$i] != '') ? 'X' : ''; else  $valor = $arr[$i]; $html_p13 .= "<td>".$valor."</td>"; }

            $arr = explode(';', $arrays[4]); $html_p13 .= "<td>".$arr[0]."</td>";
            for($i=1 ; $i < sizeof($arr) ; $i++){ if ($i < sizeof($arr)-1) $valor = ($arr[$i] != '') ? 'X' : ''; else  $valor = $arr[$i]; $html_p13 .= "<td>".$valor."</td>"; }

            $html_p14 = "";
            $p14 = $dato['p14']; $arrays = explode('|', $p14);

            $arr = explode(';', $arrays[0]); for($i=0 ; $i < sizeof($arr) ; $i++){ $html_p13 .= "<td>".$arr[$i]."</td>"; }
            $arr = explode(';', $arrays[1]); for($i=0 ; $i < sizeof($arr) ; $i++){ $html_p13 .= "<td>".$arr[$i]."</td>"; }
            $arr = explode(';', $arrays[2]); for($i=0 ; $i < sizeof($arr) ; $i++){ $html_p13 .= "<td>".$arr[$i]."</td>"; }
            $arr = explode(';', $arrays[3]); for($i=0 ; $i < sizeof($arr) ; $i++){ $html_p13 .= "<td>".$arr[$i]."</td>"; }
            $arr = explode(';', $arrays[4]); for($i=0 ; $i < sizeof($arr) ; $i++){ $html_p13 .= "<td>".$arr[$i]."</td>"; }

            $html_p15 = "";
            $p15 = $dato['p15']; $arrays = explode('|', $p15);

            $arr = explode(';', $arrays[0]); for($i=0 ; $i < sizeof($arr) ; $i++){ $html_p15 .= "<td>".$arr[$i]."</td>"; }
            $arr = explode(';', $arrays[1]); for($i=0 ; $i < sizeof($arr) ; $i++){ $html_p15 .= "<td>".$arr[$i]."</td>"; }
            $arr = explode(';', $arrays[2]); for($i=0 ; $i < sizeof($arr) ; $i++){ $html_p15 .= "<td>".$arr[$i]."</td>"; }
            $arr = explode(';', $arrays[3]); for($i=0 ; $i < sizeof($arr) ; $i++){ $html_p15 .= "<td>".$arr[$i]."</td>"; }
            $arr = explode(';', $arrays[4]); for($i=0 ; $i < sizeof($arr) ; $i++){ $html_p15 .= "<td>".$arr[$i]."</td>"; }
            $arr = explode(';', $arrays[5]); for($i=0 ; $i < sizeof($arr) ; $i++){ $html_p15 .= "<td>".$arr[$i]."</td>"; }
            $arr = explode(';', $arrays[6]); for($i=0 ; $i < sizeof($arr) ; $i++){ $html_p15 .= "<td>".$arr[$i]."</td>"; }
            $arr = explode(';', $arrays[7]); for($i=0 ; $i < sizeof($arr) ; $i++){ $html_p15 .= "<td>".$arr[$i]."</td>"; }
            $arr = explode(';', $arrays[8]); for($i=0 ; $i < sizeof($arr) ; $i++){ $html_p15 .= "<td>".$arr[$i]."</td>"; }
            $arr = explode(';', $arrays[9]); for($i=0 ; $i < sizeof($arr) ; $i++){ $html_p15 .= "<td>".$arr[$i]."</td>"; }
            $arr = explode(';', $arrays[10]); for($i=0 ; $i < sizeof($arr) ; $i++){ $html_p15 .= "<td>".$arr[$i]."</td>"; }
            $arr = explode(';', $arrays[11]); for($i=0 ; $i < sizeof($arr) ; $i++){ $html_p15 .= "<td>".$arr[$i]."</td>"; }

            $html_p16 = "";
            $p16 = $dato['p16']; $arrays = explode('|', $p16);

            $arr = explode(';', $arrays[0]); for($i=0 ; $i < sizeof($arr) ; $i++){ $html_p16 .= "<td>".$arr[$i]."</td>"; }
            $arr = explode(';', $arrays[1]); for($i=0 ; $i < sizeof($arr) ; $i++){ $html_p16 .= "<td>".$arr[$i]."</td>"; }
            $arr = explode(';', $arrays[2]); for($i=0 ; $i < sizeof($arr) ; $i++){ $html_p16 .= "<td>".$arr[$i]."</td>"; }
            $arr = explode(';', $arrays[3]); for($i=0 ; $i < sizeof($arr) ; $i++){ $html_p16 .= "<td>".$arr[$i]."</td>"; }
            $arr = explode(';', $arrays[4]); for($i=0 ; $i < sizeof($arr) ; $i++){ $html_p16 .= "<td>".$arr[$i]."</td>"; }

            $html_p17 = "";
            $p17 = $dato['p17']; $arrays = explode('|', $p17);

            $arr = explode(';', $arrays[0]); for($i=0 ; $i < sizeof($arr) ; $i++){ $html_p17 .= "<td>".$arr[$i]."</td>"; }
            $arr = explode(';', $arrays[0]); for($i=0 ; $i < sizeof($arr) ; $i++){ $html_p17 .= "<td>".$arr[$i]."</td>"; }
            $arr = explode(';', $arrays[0]); for($i=0 ; $i < sizeof($arr) ; $i++){ $html_p17 .= "<td>".$arr[$i]."</td>"; }
            $arr = explode(';', $arrays[0]); for($i=0 ; $i < sizeof($arr) ; $i++){ $html_p17 .= "<td>".$arr[$i]."</td>"; }
            $arr = explode(';', $arrays[0]); for($i=0 ; $i < sizeof($arr) ; $i++){ $html_p17 .= "<td>".$arr[$i]."</td>"; }
            $arr = explode(';', $arrays[0]); for($i=0 ; $i < sizeof($arr) ; $i++){ $html_p17 .= "<td>".$arr[$i]."</td>"; }
            $arr = explode(';', $arrays[0]); for($i=0 ; $i < sizeof($arr) ; $i++){ $html_p17 .= "<td>".$arr[$i]."</td>"; }
            $arr = explode(';', $arrays[0]); for($i=0 ; $i < sizeof($arr) ; $i++){ $html_p17 .= "<td>".$arr[$i]."</td>"; }
            $arr = explode(';', $arrays[0]); for($i=0 ; $i < sizeof($arr) ; $i++){ $html_p17 .= "<td>".$arr[$i]."</td>"; }
            $arr = explode(';', $arrays[0]); for($i=0 ; $i < sizeof($arr) ; $i++){ $html_p17 .= "<td>".$arr[$i]."</td>"; }

            $html_p18 = "";
            $p18 = $dato['p18']; $arrays = explode('|', $p18);

            $arr = explode(';', $arrays[0]); $html_p18 .= "<td>".$arr[0]."</td>";
            for($i=1 ; $i < sizeof($arr) ; $i++){ if ($i < sizeof($arr)-1) $valor = ($arr[$i] != '') ? 'X' : ''; else  $valor = $arr[$i]; $html_p18 .= "<td>".$valor."</td>"; }

            $arr = explode(';', $arrays[1]); $html_p18 .= "<td>".$arr[0]."</td>";
            for($i=1 ; $i < sizeof($arr) ; $i++){ if ($i < sizeof($arr)-1) $valor = ($arr[$i] != '') ? 'X' : ''; else  $valor = $arr[$i]; $html_p18 .= "<td>".$valor."</td>"; }

            $arr = explode(';', $arrays[2]); $html_p18 .= "<td>".$arr[0]."</td>";
            for($i=1 ; $i < sizeof($arr) ; $i++){ if ($i < sizeof($arr)-1) $valor = ($arr[$i] != '') ? 'X' : ''; else  $valor = $arr[$i]; $html_p18 .= "<td>".$valor."</td>"; }

            $arr = explode(';', $arrays[3]); $html_p18 .= "<td>".$arr[0]."</td>";
            for($i=1 ; $i < sizeof($arr) ; $i++){ if ($i < sizeof($arr)-1) $valor = ($arr[$i] != '') ? 'X' : ''; else  $valor = $arr[$i]; $html_p18 .= "<td>".$valor."</td>"; }

            $arr = explode(';', $arrays[4]); $html_p18 .= "<td>".$arr[0]."</td>";
            for($i=1 ; $i < sizeof($arr) ; $i++){ if ($i < sizeof($arr)-1) $valor = ($arr[$i] != '') ? 'X' : ''; else  $valor = $arr[$i]; $html_p18 .= "<td>".$valor."</td>"; }

            $arr = explode(';', $arrays[5]); $html_p18 .= "<td>".$arr[0]."</td>";
            for($i=1 ; $i < sizeof($arr) ; $i++){ if ($i < sizeof($arr)-1) $valor = ($arr[$i] != '') ? 'X' : ''; else  $valor = $arr[$i]; $html_p18 .= "<td>".$valor."</td>"; }

            $arr = explode(';', $arrays[6]); $html_p18 .= "<td>".$arr[0]."</td>";
            for($i=1 ; $i < sizeof($arr) ; $i++){ if ($i < sizeof($arr)-1) $valor = ($arr[$i] != '') ? 'X' : ''; else  $valor = $arr[$i]; $html_p18 .= "<td>".$valor."</td>"; }

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
		$html_p13
		$html_p14
		$html_p15
		$html_p16
		$html_p17
		$html_p18
		</tr>";

		}
	 
	}
?>
</table>		  