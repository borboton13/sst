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


    <th>Se tiene equipo Radio Enlace?</th>

    <th>Equipo</th><th>Estado</th><th>Fabricante</th><th>Modelo</th><th>Radioenlace MW</th><th>ID Sitio salto radio enlace</th><th>Frecuencia Tx (Ghz)</th><th>Frecuencia Rx (Ghz)</th><th>Topología Radio MW 1+1, 1+0, 2+0, XPIC, HTBY</th><th>Azimut</th><th>Diametro antena</th><th>Altura antena</th>
    <th>Equipo</th><th>Estado</th><th>Fabricante</th><th>Modelo</th><th>Radioenlace MW</th><th>ID Sitio salto radio enlace</th><th>Frecuencia Tx (Ghz)</th><th>Frecuencia Rx (Ghz)</th><th>Topología Radio MW 1+1, 1+0, 2+0, XPIC, HTBY</th><th>Azimut</th><th>Diametro antena</th><th>Altura antena</th>
    <th>Equipo</th><th>Estado</th><th>Fabricante</th><th>Modelo</th><th>Radioenlace MW</th><th>ID Sitio salto radio enlace</th><th>Frecuencia Tx (Ghz)</th><th>Frecuencia Rx (Ghz)</th><th>Topología Radio MW 1+1, 1+0, 2+0, XPIC, HTBY</th><th>Azimut</th><th>Diametro antena</th><th>Altura antena</th>
    <th>Equipo</th><th>Estado</th><th>Fabricante</th><th>Modelo</th><th>Radioenlace MW</th><th>ID Sitio salto radio enlace</th><th>Frecuencia Tx (Ghz)</th><th>Frecuencia Rx (Ghz)</th><th>Topología Radio MW 1+1, 1+0, 2+0, XPIC, HTBY</th><th>Azimut</th><th>Diametro antena</th><th>Altura antena</th>
    <th>Equipo</th><th>Estado</th><th>Fabricante</th><th>Modelo</th><th>Radioenlace MW</th><th>ID Sitio salto radio enlace</th><th>Frecuencia Tx (Ghz)</th><th>Frecuencia Rx (Ghz)</th><th>Topología Radio MW 1+1, 1+0, 2+0, XPIC, HTBY</th><th>Azimut</th><th>Diametro antena</th><th>Altura antena</th>
    <th>Equipo</th><th>Estado</th><th>Fabricante</th><th>Modelo</th><th>Radioenlace MW</th><th>ID Sitio salto radio enlace</th><th>Frecuencia Tx (Ghz)</th><th>Frecuencia Rx (Ghz)</th><th>Topología Radio MW 1+1, 1+0, 2+0, XPIC, HTBY</th><th>Azimut</th><th>Diametro antena</th><th>Altura antena</th>
    <th>Equipo</th><th>Estado</th><th>Fabricante</th><th>Modelo</th><th>Radioenlace MW</th><th>ID Sitio salto radio enlace</th><th>Frecuencia Tx (Ghz)</th><th>Frecuencia Rx (Ghz)</th><th>Topología Radio MW 1+1, 1+0, 2+0, XPIC, HTBY</th><th>Azimut</th><th>Diametro antena</th><th>Altura antena</th>
    <th>Equipo</th><th>Estado</th><th>Fabricante</th><th>Modelo</th><th>Radioenlace MW</th><th>ID Sitio salto radio enlace</th><th>Frecuencia Tx (Ghz)</th><th>Frecuencia Rx (Ghz)</th><th>Topología Radio MW 1+1, 1+0, 2+0, XPIC, HTBY</th><th>Azimut</th><th>Diametro antena</th><th>Altura antena</th>
    <th>Equipo</th><th>Estado</th><th>Fabricante</th><th>Modelo</th><th>Radioenlace MW</th><th>ID Sitio salto radio enlace</th><th>Frecuencia Tx (Ghz)</th><th>Frecuencia Rx (Ghz)</th><th>Topología Radio MW 1+1, 1+0, 2+0, XPIC, HTBY</th><th>Azimut</th><th>Diametro antena</th><th>Altura antena</th>
    <th>Equipo</th><th>Estado</th><th>Fabricante</th><th>Modelo</th><th>Radioenlace MW</th><th>ID Sitio salto radio enlace</th><th>Frecuencia Tx (Ghz)</th><th>Frecuencia Rx (Ghz)</th><th>Topología Radio MW 1+1, 1+0, 2+0, XPIC, HTBY</th><th>Azimut</th><th>Diametro antena</th><th>Altura antena</th>
    <th>Equipo</th><th>Estado</th><th>Fabricante</th><th>Modelo</th><th>Radioenlace MW</th><th>ID Sitio salto radio enlace</th><th>Frecuencia Tx (Ghz)</th><th>Frecuencia Rx (Ghz)</th><th>Topología Radio MW 1+1, 1+0, 2+0, XPIC, HTBY</th><th>Azimut</th><th>Diametro antena</th><th>Altura antena</th>
    <th>Equipo</th><th>Estado</th><th>Fabricante</th><th>Modelo</th><th>Radioenlace MW</th><th>ID Sitio salto radio enlace</th><th>Frecuencia Tx (Ghz)</th><th>Frecuencia Rx (Ghz)</th><th>Topología Radio MW 1+1, 1+0, 2+0, XPIC, HTBY</th><th>Azimut</th><th>Diametro antena</th><th>Altura antena</th>
    <th>Equipo</th><th>Estado</th><th>Fabricante</th><th>Modelo</th><th>Radioenlace MW</th><th>ID Sitio salto radio enlace</th><th>Frecuencia Tx (Ghz)</th><th>Frecuencia Rx (Ghz)</th><th>Topología Radio MW 1+1, 1+0, 2+0, XPIC, HTBY</th><th>Azimut</th><th>Diametro antena</th><th>Altura antena</th>
    <th>Equipo</th><th>Estado</th><th>Fabricante</th><th>Modelo</th><th>Radioenlace MW</th><th>ID Sitio salto radio enlace</th><th>Frecuencia Tx (Ghz)</th><th>Frecuencia Rx (Ghz)</th><th>Topología Radio MW 1+1, 1+0, 2+0, XPIC, HTBY</th><th>Azimut</th><th>Diametro antena</th><th>Altura antena</th>
    <th>Equipo</th><th>Estado</th><th>Fabricante</th><th>Modelo</th><th>Radioenlace MW</th><th>ID Sitio salto radio enlace</th><th>Frecuencia Tx (Ghz)</th><th>Frecuencia Rx (Ghz)</th><th>Topología Radio MW 1+1, 1+0, 2+0, XPIC, HTBY</th><th>Azimut</th><th>Diametro antena</th><th>Altura antena</th>

    <th></th><th>Revisado</th>
    <th></th><th>Revisado</th>
    <th></th><th>Revisado</th>
    <th></th><th>Revisado</th>
    <th></th><th>Revisado</th>
    <th></th><th>Revisado</th>

    <th>Interface</th><th>En servicio</th><th>Libre</th>
    <th>Interface</th><th>En servicio</th><th>Libre</th>
    <th>Interface</th><th>En servicio</th><th>Libre</th>
    <th>Interface</th><th>En servicio</th><th>Libre</th>

    <th>Observaciones</th>



</tr>
<?	
	//$consulta="SELECT * FROM st_ticket;";
	$resultado=mysql_query("
	SELECT ev.inicio, es.nombre, f.titulo, f.p01, f.p02, f.p03, f.p04, f.p05
	FROM formulario_p015 f
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

            $html_p02 = "";
            $p02 = $dato['p02']; $arrays = explode('|', $p02);

            $arr = explode(';', $arrays[0]); for($i=0 ; $i < sizeof($arr) ; $i++){ $html_p02 .= "<td>".$arr[$i]."</td>"; }
            $arr = explode(';', $arrays[1]); for($i=0 ; $i < sizeof($arr) ; $i++){ $html_p02 .= "<td>".$arr[$i]."</td>"; }
            $arr = explode(';', $arrays[2]); for($i=0 ; $i < sizeof($arr) ; $i++){ $html_p02 .= "<td>".$arr[$i]."</td>"; }
            $arr = explode(';', $arrays[3]); for($i=0 ; $i < sizeof($arr) ; $i++){ $html_p02 .= "<td>".$arr[$i]."</td>"; }
            $arr = explode(';', $arrays[4]); for($i=0 ; $i < sizeof($arr) ; $i++){ $html_p02 .= "<td>".$arr[$i]."</td>"; }
            $arr = explode(';', $arrays[5]); for($i=0 ; $i < sizeof($arr) ; $i++){ $html_p02 .= "<td>".$arr[$i]."</td>"; }
            $arr = explode(';', $arrays[6]); for($i=0 ; $i < sizeof($arr) ; $i++){ $html_p02 .= "<td>".$arr[$i]."</td>"; }
            $arr = explode(';', $arrays[7]); for($i=0 ; $i < sizeof($arr) ; $i++){ $html_p02 .= "<td>".$arr[$i]."</td>"; }
            $arr = explode(';', $arrays[8]); for($i=0 ; $i < sizeof($arr) ; $i++){ $html_p02 .= "<td>".$arr[$i]."</td>"; }
            $arr = explode(';', $arrays[9]); for($i=0 ; $i < sizeof($arr) ; $i++){ $html_p02 .= "<td>".$arr[$i]."</td>"; }
            $arr = explode(';', $arrays[10]); for($i=0 ; $i < sizeof($arr) ; $i++){ $html_p02 .= "<td>".$arr[$i]."</td>"; }
            $arr = explode(';', $arrays[11]); for($i=0 ; $i < sizeof($arr) ; $i++){ $html_p02 .= "<td>".$arr[$i]."</td>"; }
            $arr = explode(';', $arrays[12]); for($i=0 ; $i < sizeof($arr) ; $i++){ $html_p02 .= "<td>".$arr[$i]."</td>"; }
            $arr = explode(';', $arrays[13]); for($i=0 ; $i < sizeof($arr) ; $i++){ $html_p02 .= "<td>".$arr[$i]."</td>"; }
            $arr = explode(';', $arrays[14]); for($i=0 ; $i < sizeof($arr) ; $i++){ $html_p02 .= "<td>".$arr[$i]."</td>"; }


            $html_p03 = "";
            $p03 = $dato['p03']; $arrays = explode('|', $p03);

            $arr = explode(';', $arrays[0]); $html_p03 .= "<td>".$arr[0]."</td>";
            for($i=1 ; $i < sizeof($arr) ; $i++){  $valor = ($arr[$i] != '') ? 'X' : ''; $html_p03 .= "<td>".$valor."</td>"; }

            $arr = explode(';', $arrays[1]); $html_p03 .= "<td>".$arr[0]."</td>";
            for($i=1 ; $i < sizeof($arr) ; $i++){  $valor = ($arr[$i] != '') ? 'X' : ''; $html_p03 .= "<td>".$valor."</td>"; }

            $arr = explode(';', $arrays[2]); $html_p03 .= "<td>".$arr[0]."</td>";
            for($i=1 ; $i < sizeof($arr) ; $i++){  $valor = ($arr[$i] != '') ? 'X' : ''; $html_p03 .= "<td>".$valor."</td>"; }

            $arr = explode(';', $arrays[3]); $html_p03 .= "<td>".$arr[0]."</td>";
            for($i=1 ; $i < sizeof($arr) ; $i++){  $valor = ($arr[$i] != '') ? 'X' : ''; $html_p03 .= "<td>".$valor."</td>"; }

            $arr = explode(';', $arrays[4]); $html_p03 .= "<td>".$arr[0]."</td>";
            for($i=1 ; $i < sizeof($arr) ; $i++){  $valor = ($arr[$i] != '') ? 'X' : ''; $html_p03 .= "<td>".$valor."</td>"; }

            $arr = explode(';', $arrays[5]); $html_p03 .= "<td>".$arr[0]."</td>";
            for($i=1 ; $i < sizeof($arr) ; $i++){  $valor = ($arr[$i] != '') ? 'X' : ''; $html_p03 .= "<td>".$valor."</td>"; }


            $html_p04 = "";
            $p04 = $dato['p04']; $arrays = explode('|', $p04);

            $arr = explode(';', $arrays[0]); for($i=0 ; $i < sizeof($arr)-1 ; $i++){ $html_p04 .= "<td>".$arr[$i]."</td>"; }
            $arr = explode(';', $arrays[1]); for($i=0 ; $i < sizeof($arr)-1 ; $i++){ $html_p04 .= "<td>".$arr[$i]."</td>"; }
            $arr = explode(';', $arrays[2]); for($i=0 ; $i < sizeof($arr)-1 ; $i++){ $html_p04 .= "<td>".$arr[$i]."</td>"; }
            $arr = explode(';', $arrays[3]); for($i=0 ; $i < sizeof($arr)-1 ; $i++){ $html_p04 .= "<td>".$arr[$i]."</td>"; }

            $p05 = $dato['p05'];

			$i++;

		echo "
		<tr>
		<td>$i</td>
		<td>$fecha</td>
		<td>$nombre</td>
		<td>$titulo</td>

		<td>$p01</td>
        $html_p02
        $html_p03
        $html_p04
		<td>$p05</td>


		
		</tr>";

		}
	 
	}
?>
</table>		  