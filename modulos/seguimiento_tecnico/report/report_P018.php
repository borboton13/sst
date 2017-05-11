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

    <th>HORA DE INICIO</th>
    <th>HORA DE CONCLUSION</th>

    <th>N.ITEM</th><th>DESCRIPCION DEL ITEM</th><th>ESTADO DE CONSERVACION</th><th>DESPUES DE LA INTERVENCION</th><th>OBSERVACIONES</th>
    <th>N.ITEM</th><th>DESCRIPCION DEL ITEM</th><th>ESTADO DE CONSERVACION</th><th>DESPUES DE LA INTERVENCION</th><th>OBSERVACIONES</th>

    <th>N.ITEM</th><th>DESCRIPCION DEL ITEM</th><th>ESTADO DE CONSERVACION</th><th>DESPUES DE LA INTERVENCION</th><th>OBSERVACIONES</th>
    <th>N.ITEM</th><th>DESCRIPCION DEL ITEM</th><th>ESTADO DE CONSERVACION</th><th>DESPUES DE LA INTERVENCION</th><th>OBSERVACIONES</th>
    <th>N.ITEM</th><th>DESCRIPCION DEL ITEM</th><th>ESTADO DE CONSERVACION</th><th>DESPUES DE LA INTERVENCION</th><th>OBSERVACIONES</th>
    <th>N.ITEM</th><th>DESCRIPCION DEL ITEM</th><th>ESTADO DE CONSERVACION</th><th>DESPUES DE LA INTERVENCION</th><th>OBSERVACIONES</th>
    <th>N.ITEM</th><th>DESCRIPCION DEL ITEM</th><th>ESTADO DE CONSERVACION</th><th>DESPUES DE LA INTERVENCION</th><th>OBSERVACIONES</th>
    <th>N.ITEM</th><th>DESCRIPCION DEL ITEM</th><th>ESTADO DE CONSERVACION</th><th>DESPUES DE LA INTERVENCION</th><th>OBSERVACIONES</th>
    <th>N.ITEM</th><th>DESCRIPCION DEL ITEM</th><th>ESTADO DE CONSERVACION</th><th>DESPUES DE LA INTERVENCION</th><th>OBSERVACIONES</th>

    <th>N.ITEM</th><th>DESCRIPCION DEL ITEM</th><th>ESTADO DE CONSERVACION</th><th>DESPUES DE LA INTERVENCION</th><th>OBSERVACIONES</th>
    <th>N.ITEM</th><th>DESCRIPCION DEL ITEM</th><th>ESTADO DE CONSERVACION</th><th>DESPUES DE LA INTERVENCION</th><th>OBSERVACIONES</th>
    <th>N.ITEM</th><th>DESCRIPCION DEL ITEM</th><th>ESTADO DE CONSERVACION</th><th>DESPUES DE LA INTERVENCION</th><th>OBSERVACIONES</th>
    <th>N.ITEM</th><th>DESCRIPCION DEL ITEM</th><th>ESTADO DE CONSERVACION</th><th>DESPUES DE LA INTERVENCION</th><th>OBSERVACIONES</th>
    <th>N.ITEM</th><th>DESCRIPCION DEL ITEM</th><th>ESTADO DE CONSERVACION</th><th>DESPUES DE LA INTERVENCION</th><th>OBSERVACIONES</th>
    <th>N.ITEM</th><th>DESCRIPCION DEL ITEM</th><th>ESTADO DE CONSERVACION</th><th>DESPUES DE LA INTERVENCION</th><th>OBSERVACIONES</th>

    <th>N.ITEM</th><th>DESCRIPCION</th><th>OBSERVACIONES</th>
    <th>N.ITEM</th><th>DESCRIPCION</th><th>OBSERVACIONES</th>
    <th>N.ITEM</th><th>DESCRIPCION</th><th>OBSERVACIONES</th>
    <th>N.ITEM</th><th>DESCRIPCION</th><th>OBSERVACIONES</th>

    <th>N.ITEM</th><th>DESCRIPCION</th><th>OBSERVACIONES</th>
    <th>N.ITEM</th><th>DESCRIPCION</th><th>OBSERVACIONES</th>
    <th>N.ITEM</th><th>DESCRIPCION</th><th>OBSERVACIONES</th>

    <th>CRITICIDADES</th>
    <th>TRABAJOS PENDIENTES</th>



</tr>
<?	
	//$consulta="SELECT * FROM st_ticket;";
	$resultado=mysql_query("
	SELECT ev.inicio, es.nombre, f.titulo, f.p01, f.p02, f.p03, f.p04, f.p05, f.p06, f.p07, f.p08, f.p09
	FROM formulario_p018 f
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

            $html_p03 = "";
            $p03 = $dato['p03']; $arrays = explode('|', $p03);

            $arr = explode(';', $arrays[0]); for($i=0 ; $i < sizeof($arr) ; $i++){ $html_p03 .= "<td>".$arr[$i]."</td>"; }
            $arr = explode(';', $arrays[0]); for($i=0 ; $i < sizeof($arr) ; $i++){ $html_p03 .= "<td>".$arr[$i]."</td>"; }

            $html_p04 = "";
            $p04 = $dato['p04']; $arrays = explode('|', $p04);

            $arr = explode(';', $arrays[0]); for($i=0 ; $i < sizeof($arr) ; $i++){ $html_p04 .= "<td>".$arr[$i]."</td>"; }
            $arr = explode(';', $arrays[0]); for($i=0 ; $i < sizeof($arr) ; $i++){ $html_p04 .= "<td>".$arr[$i]."</td>"; }
            $arr = explode(';', $arrays[0]); for($i=0 ; $i < sizeof($arr) ; $i++){ $html_p04 .= "<td>".$arr[$i]."</td>"; }
            $arr = explode(';', $arrays[0]); for($i=0 ; $i < sizeof($arr) ; $i++){ $html_p04 .= "<td>".$arr[$i]."</td>"; }
            $arr = explode(';', $arrays[0]); for($i=0 ; $i < sizeof($arr) ; $i++){ $html_p04 .= "<td>".$arr[$i]."</td>"; }
            $arr = explode(';', $arrays[0]); for($i=0 ; $i < sizeof($arr) ; $i++){ $html_p04 .= "<td>".$arr[$i]."</td>"; }
            $arr = explode(';', $arrays[0]); for($i=0 ; $i < sizeof($arr) ; $i++){ $html_p04 .= "<td>".$arr[$i]."</td>"; }

            $html_p05 = "";
            $p05 = $dato['p05']; $arrays = explode('|', $p05);

            $arr = explode(';', $arrays[0]); for($i=0 ; $i < sizeof($arr) ; $i++){ $html_p05 .= "<td>".$arr[$i]."</td>"; }
            $arr = explode(';', $arrays[1]); for($i=0 ; $i < sizeof($arr) ; $i++){ $html_p05 .= "<td>".$arr[$i]."</td>"; }
            $arr = explode(';', $arrays[2]); for($i=0 ; $i < sizeof($arr) ; $i++){ $html_p05 .= "<td>".$arr[$i]."</td>"; }
            $arr = explode(';', $arrays[3]); for($i=0 ; $i < sizeof($arr) ; $i++){ $html_p05 .= "<td>".$arr[$i]."</td>"; }
            $arr = explode(';', $arrays[4]); for($i=0 ; $i < sizeof($arr) ; $i++){ $html_p05 .= "<td>".$arr[$i]."</td>"; }
            $arr = explode(';', $arrays[5]); for($i=0 ; $i < sizeof($arr) ; $i++){ $html_p05 .= "<td>".$arr[$i]."</td>"; }

            $html_p06 = "";
            $p06 = $dato['p06']; $arrays = explode('|', $p06);

            $arr = explode(';', $arrays[0]); for($i=0 ; $i < sizeof($arr) ; $i++){ $html_p06 .= "<td>".$arr[$i]."</td>"; }
            $arr = explode(';', $arrays[1]); for($i=0 ; $i < sizeof($arr) ; $i++){ $html_p06 .= "<td>".$arr[$i]."</td>"; }
            $arr = explode(';', $arrays[2]); for($i=0 ; $i < sizeof($arr) ; $i++){ $html_p06 .= "<td>".$arr[$i]."</td>"; }
            $arr = explode(';', $arrays[3]); for($i=0 ; $i < sizeof($arr) ; $i++){ $html_p06 .= "<td>".$arr[$i]."</td>"; }

            $html_p07 = "";
            $p07 = $dato['p07']; $arrays = explode('|', $p07);

            $arr = explode(';', $arrays[0]); for($i=0 ; $i < sizeof($arr) ; $i++){ $html_p07 .= "<td>".$arr[$i]."</td>"; }
            $arr = explode(';', $arrays[1]); for($i=0 ; $i < sizeof($arr) ; $i++){ $html_p07 .= "<td>".$arr[$i]."</td>"; }
            $arr = explode(';', $arrays[2]); for($i=0 ; $i < sizeof($arr) ; $i++){ $html_p07 .= "<td>".$arr[$i]."</td>"; }

            $p08 = $dato['p08'];
            $p09 = $dato['p09'];

			$i++;

		echo "
		<tr>
		<td>$i</td>
		<td>$fecha</td>
		<td>$nombre</td>
		<td>$titulo</td>

		<td>$p01</td>
		<td>$p02</td>
		
		$html_p03
		$html_p04
		$html_p05
		$html_p06
		$html_p07
		
		<td>$p08</td>
		<td>$p09</td>
		</tr>";

		}
	 
	}
?>
</table>		  