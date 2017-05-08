<?php
$idcentro    = $_POST["idcentro"];
$formulario  = $_POST["formulario"];
$fechainicio = $_POST["fechainicio"];
$fechafin    = $_POST["fechafin"];

header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=st_reporte_mtto.xls");
header("Pragma: no-cache");
header("Expires: 0");

$cabecera = array("No Existe", "Malo", "Bajo", "Medio", "Alto", "Bueno", "Reparado", "Ajustado", "Cambiado", "Pendiente", "Otro");
$cab10 = "";
foreach ($cabecera as $cab){
    $cab10 .= "<th>$cab</th>";
}

$cabs11 = array("No Existe", "Mal", "Bien", "Mal", "Bien", "Ajustado", "Pendiente", "Otro");
$cab11 = "";
foreach ($cabs11 as $cab){
    $cab11 .= "<th>$cab</th>";
}

?>
<table border="1">
<tr>
    <th></th>
    <th></th>
    <th></th>
    <th></th>
    <th>ATS ? CUBICAL DE CONTROL</th>
    <th colspan="6">ANTES MTTO</th>
    <th colspan="5">DEPUES MTTO</th>
</tr>
<tr>
    <th>No</th>
    <th>FECHA</th>
    <th>NOM_ESTACION</th>
    <th>TITULO</th>
    <th></th><?php echo $cab10 ?>
    <th></th><?php echo $cab10 ?>
    <th></th><?php echo $cab10 ?>
    <th></th><?php echo $cab10 ?>
    <th></th>
    <th>T arranque [s]</th>
    <th>T transferen [s]</th>
    <th></th>
    <th>T retransfer [s]</th>
    <th>T parada [s]</th>
    <th></th><?php echo $cab11 ?>
    <th></th><?php echo $cab11 ?>
    <th></th><?php echo $cab11 ?>
    <th></th><?php echo $cab11 ?>
    <th></th><?php echo $cab11 ?>
    <th></th>
</tr>
<?	
	//$consulta="SELECT * FROM st_ticket;";
	$resultado=mysql_query("
	SELECT ev.inicio, es.nombre, f.titulo, f.p01, f.p02, f.p03, f.p04, f.p05, f.p06, f.p07, f.p08, f.p09
	FROM formulario_p011 f
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

            $arr = explode(';', $arrays[0]); $html_p01 .= "<td>".$arr[0]."</td>";
            for($i=1 ; $i < sizeof($arr) ; $i++){ if ($i < sizeof($arr)-1) $valor = ($arr[$i] != '') ? 'X' : ''; else  $valor = $arr[$i]; $html_p01 .= "<td>".$valor."</td>"; }

            $arr = explode(';', $arrays[1]); $html_p01 .= "<td>".$arr[0]."</td>";
            for($i=1 ; $i < sizeof($arr) ; $i++){ if ($i < sizeof($arr)-1) $valor = ($arr[$i] != '') ? 'X' : ''; else  $valor = $arr[$i]; $html_p01 .= "<td>".$valor."</td>"; }

            $arr = explode(';', $arrays[2]); $html_p01 .= "<td>".$arr[0]."</td>";
            for($i=1 ; $i < sizeof($arr) ; $i++){ if ($i < sizeof($arr)-1) $valor = ($arr[$i] != '') ? 'X' : ''; else  $valor = $arr[$i]; $html_p01 .= "<td>".$valor."</td>"; }

            $arr = explode(';', $arrays[3]); $html_p01 .= "<td>".$arr[0]."</td>";
            for($i=1 ; $i < sizeof($arr) ; $i++){ if ($i < sizeof($arr)-1) $valor = ($arr[$i] != '') ? 'X' : ''; else  $valor = $arr[$i]; $html_p01 .= "<td>".$valor."</td>"; }

            $html_p02 = "";
            $p02 = $dato['p02']; $arrays = explode('|', $p02);
            /*$arr = explode(';', $arrays[0]); for($i=0 ; $i < sizeof($arr) ; $i++){ $html_p05 .= "<td>".$arr[$i]."</td>";}*/
            $arr = explode(';', $arrays[0]); for($i=0 ; $i < sizeof($arr) ; $i++){ if($i==0||$i==3||$i==5) $html_p02 .= "<td>".$arr[$i]."</td>"; }
            $arr = explode(';', $arrays[1]); for($i=0 ; $i < sizeof($arr) ; $i++){ if($i==0||$i==3||$i==5) $html_p02 .= "<td>".$arr[$i]."</td>"; }

            $html_p03 = "";
            $p03 = $dato['p03']; $arrays = explode('|', $p03);

            $arr = explode(';', $arrays[0]); $html_p03 .= "<td>".$arr[0]."</td>";
            for($i=1 ; $i < sizeof($arr) ; $i++){ if ($i < sizeof($arr)-1) $valor = ($arr[$i] != '') ? 'X' : ''; else  $valor = $arr[$i]; $html_p03 .= "<td>".$valor."</td>"; }

            $arr = explode(';', $arrays[1]); $html_p03 .= "<td>".$arr[0]."</td>";
            for($i=1 ; $i < sizeof($arr) ; $i++){ if ($i < sizeof($arr)-1) $valor = ($arr[$i] != '') ? 'X' : ''; else  $valor = $arr[$i]; $html_p03 .= "<td>".$valor."</td>"; }

            $arr = explode(';', $arrays[2]); $html_p03 .= "<td>".$arr[0]."</td>";
            for($i=1 ; $i < sizeof($arr) ; $i++){ if ($i < sizeof($arr)-1) $valor = ($arr[$i] != '') ? 'X' : ''; else  $valor = $arr[$i]; $html_p03 .= "<td>".$valor."</td>"; }

            $arr = explode(';', $arrays[3]); $html_p03 .= "<td>".$arr[0]."</td>";
            for($i=1 ; $i < sizeof($arr) ; $i++){ if ($i < sizeof($arr)-1) $valor = ($arr[$i] != '') ? 'X' : ''; else  $valor = $arr[$i]; $html_p03 .= "<td>".$valor."</td>"; }

            $arr = explode(';', $arrays[4]); $html_p03 .= "<td>".$arr[0]."</td>";
            for($i=1 ; $i < sizeof($arr) ; $i++){ if ($i < sizeof($arr)-1) $valor = ($arr[$i] != '') ? 'X' : ''; else  $valor = $arr[$i]; $html_p03 .= "<td>".$valor."</td>"; }

			$i++;

		echo "
		<tr>
		<td>$i</td>
		<td>$fecha</td>
		<td>$nombre</td>
		<td>$titulo</td>

        $html_p01
        $html_p02
        $html_p03
		<td></td>
		
		</tr>";

		}
	 
	}
?>
</table>		  