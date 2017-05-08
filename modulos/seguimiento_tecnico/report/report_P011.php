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
             <th colspan="6">ANTES MTTO</th><th colspan="5">DEPUES MTTO</th>
    <th></th><th colspan="6">ANTES MTTO</th><th colspan="5">DEPUES MTTO</th>
    <th></th><th colspan="6">ANTES MTTO</th><th colspan="5">DEPUES MTTO</th>
    <th></th><th colspan="6">ANTES MTTO</th><th colspan="5">DEPUES MTTO</th>
    <th colspan="2">Tiempo de arranque automático y transferencia a carga</th>
    <th colspan="2">Tiempo de retransferencia automática y parada</th>
    <th></th><th colspan="3">ANTES MTTO</th><th colspan="5">DEPUES MTTO</th>
    <th></th><th colspan="3">ANTES MTTO</th><th colspan="5">DEPUES MTTO</th>
    <th></th><th colspan="3">ANTES MTTO</th><th colspan="5">DEPUES MTTO</th>
    <th></th><th colspan="3">ANTES MTTO</th><th colspan="5">DEPUES MTTO</th>
    <th></th><th colspan="3">ANTES MTTO</th><th colspan="5">DEPUES MTTO</th>
    <th></th><th></th><th></th>
    <th colspan="2">Estado de Operación Transf Automatico (S/N)</th>
    <th colspan="2">Indicaciones de Alarmas (S/N)</th>
    <th></th><th colspan="3">ANTES MTTO</th><th colspan="3">DEPUES MTTO</th>
    <th></th><th colspan="3">ANTES MTTO</th><th colspan="3">DEPUES MTTO</th>
    <th></th><th colspan="3">ANTES MTTO</th><th colspan="3">DEPUES MTTO</th>
    <th>ANTES MTTO</th><th>DEPUES MTTO</th>
    <th>ANTES MTTO</th><th>DEPUES MTTO</th>
    <th colspan="2">Verificar,limpiar y controlar distribuidores de energía comercial AC (tableros de distribución), para prevenir sobrecargas en térmicos</th>
    <th colspan="2">Revisión de calentamiento del cableado en AC por sobrecarga</th>
    <th></th><th colspan="3">ANTES MTTO</th><th colspan="3">DEPUES MTTO</th>
    <th></th><th colspan="3">ANTES MTTO</th><th colspan="3">DEPUES MTTO</th>
    <th>ANTES MTTO</th><th>DEPUES MTTO</th>
    <th>ANTES MTTO</th><th>DEPUES MTTO</th>
    <th>ANTES MTTO</th><th>DEPUES MTTO</th>
    <th colspan="2">Verificar y controlar la distribución de AC UPS en tableros de la estación</th>
    <th colspan="2">Revisión de sobrecalentamiento del cableado en AC y DC</th>
    <th colspan="2">Indicación de Alarmas activadas</th>
    <th colspan="2">Temperatura de baterías del banco</th>
    <th>Porcentaje de carga Pu/Pn</th>
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
    <th>T arranque [s]</th>
    <th>T transferen [s]</th>
    <th>T retransfer [s]</th>
    <th>T parada [s]</th>
    <th></th><?php echo $cab11 ?>
    <th></th><?php echo $cab11 ?>
    <th></th><?php echo $cab11 ?>
    <th></th><?php echo $cab11 ?>
    <th></th><?php echo $cab11 ?>
    <th>Registro valor Voltímetro[V]</th>
    <th>Registro valor Amperímetro[A]</th>
    <th>Registro valor Frecuencimetro[Hz]</th>
    <th>Bien</th>
    <th>Mal</th>
    <th>Bien</th>
    <th>Mal</th>
    <th>Medidas eléctricas de energía comercial</th><th>Fase 1</th><th>Fase 2</th><th>Fase 3</th><th>Fase 1</th><th>Fase 2</th><th>Fase 3</th>
    <th>Medidas eléctricas de energía comercial</th><th>Fase 1</th><th>Fase 2</th><th>Fase 3</th><th>Fase 1</th><th>Fase 2</th><th>Fase 3</th>
    <th>Medidas eléctricas de energía comercial</th><th>Fase 1</th><th>Fase 2</th><th>Fase 3</th><th>Fase 1</th><th>Fase 2</th><th>Fase 3</th>
    <th>Frecuencia [Hz]</th>
    <th>Frecuencia [Hz]</th>
    <th>Lectura del medidor de energía [Kwh]</th>
    <th>Lectura del medidor de energía [Kwh]</th>
    <th>Equilibrado</th>
    <th>Desequilibrado</th>
    <th>Equilibrado</th>
    <th>Desequilibrado</th>
    <th>UPS</th><th>Fase 1</th><th>Fase 2</th><th>Fase 3</th><th>Fase 1</th><th>Fase 2</th><th>Fase 3</th>
    <th>UPS</th><th>Fase 1</th><th>Fase 2</th><th>Fase 3</th><th>Fase 1</th><th>Fase 2</th><th>Fase 3</th>
    <th>Frecuencia Entrada[Hz]</th>
    <th>Frecuencia Entrada[Hz]</th>
    <th>Voltaje DC banco baterías[V]</th>
    <th>Voltaje DC banco baterías[V]</th>
    <th>Corriente DC Salida[A]</th>
    <th>Corriente DC Salida[A]</th>
    <th>Equilibrado</th>
    <th>Desequilibrado</th>
    <th>Normal</th>
    <th>Caliente</th>
    <th>SI</th>
    <th>NO</th>
    <th>Normal</th>
    <th>Caliente</th>
    <th>[%]</th>
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

            $arr = explode(';', $arrays[0]); for($i=0 ; $i < sizeof($arr) ; $i++){ if($i==3||$i==5) $html_p02 .= "<td>".$arr[$i]."</td>"; }
            $arr = explode(';', $arrays[1]); for($i=0 ; $i < sizeof($arr) ; $i++){ if($i==3||$i==5) $html_p02 .= "<td>".$arr[$i]."</td>"; }

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

            $html_p04 = "";
            $p04 = $dato['p04']; $arrays = explode('|', $p04);

            $arr = explode(';', $arrays[0]); for($i=0 ; $i < sizeof($arr) ; $i++){ if($i==2) $html_p04 .= "<td>".$arr[$i]."</td>"; }
            $arr = explode(';', $arrays[1]); for($i=0 ; $i < sizeof($arr) ; $i++){ if($i==2) $html_p04 .= "<td>".$arr[$i]."</td>"; }
            $arr = explode(';', $arrays[2]); for($i=0 ; $i < sizeof($arr) ; $i++){ if($i==2) $html_p04 .= "<td>".$arr[$i]."</td>"; }

            $html_p05 = "";
            $p05 = $dato['p05']; $arrays = explode('|', $p05);

            $arr = explode(';', $arrays[0]); for($i=0 ; $i < sizeof($arr) ; $i++){ if($i==2||$i==4){$valor = ($arr[$i] != '') ? 'X' : ''; $html_p05 .= "<td>".$valor."</td>";}}
            $arr = explode(';', $arrays[1]); for($i=0 ; $i < sizeof($arr) ; $i++){ if($i==2||$i==4){$valor = ($arr[$i] != '') ? 'X' : ''; $html_p05 .= "<td>".$valor."</td>";}}

            $html_p06 = "";
            $p06 = $dato['p06']; $arrays = explode('|', $p06);

            $arr = explode(';', $arrays[0]); for($i=0 ; $i < sizeof($arr) ; $i++){ $html_p06 .= "<td>".$arr[$i]."</td>"; }
            $arr = explode(';', $arrays[1]); for($i=0 ; $i < sizeof($arr) ; $i++){ $html_p06 .= "<td>".$arr[$i]."</td>"; }
            $arr = explode(';', $arrays[2]); for($i=0 ; $i < sizeof($arr) ; $i++){ $html_p06 .= "<td>".$arr[$i]."</td>"; }

            $arr = explode(';', $arrays[3]); for($i=0 ; $i < sizeof($arr) ; $i++){ if($i==1||$i==4) $html_p06 .= "<td>".$arr[$i]."</td>"; }
            $arr = explode(';', $arrays[4]); for($i=0 ; $i < sizeof($arr) ; $i++){ if($i==1||$i==4) $html_p06 .= "<td>".$arr[$i]."</td>"; }

            $html_p07 = "";
            $p07 = $dato['p07']; $arrays = explode('|', $p07);

            $arr = explode(';', $arrays[0]); for($i=0 ; $i < sizeof($arr) ; $i++){ if($i==2||$i==4){$valor = ($arr[$i] != '') ? 'X' : ''; $html_p07 .= "<td>".$valor."</td>";}}
            $arr = explode(';', $arrays[1]); for($i=0 ; $i < sizeof($arr) ; $i++){ if($i==2||$i==4){$valor = ($arr[$i] != '') ? 'X' : ''; $html_p07 .= "<td>".$valor."</td>";}}

            $html_p08 = "";
            $p08 = $dato['p08']; $arrays = explode('|', $p08);

            $arr = explode(';', $arrays[0]); for($i=0 ; $i < sizeof($arr) ; $i++){ $html_p08 .= "<td>".$arr[$i]."</td>"; }
            $arr = explode(';', $arrays[1]); for($i=0 ; $i < sizeof($arr) ; $i++){ $html_p08 .= "<td>".$arr[$i]."</td>"; }

            $arr = explode(';', $arrays[2]); for($i=0 ; $i < sizeof($arr) ; $i++){ if($i==1||$i==4) $html_p08 .= "<td>".$arr[$i]."</td>"; }
            $arr = explode(';', $arrays[3]); for($i=0 ; $i < sizeof($arr) ; $i++){ if($i==1||$i==4) $html_p08 .= "<td>".$arr[$i]."</td>"; }
            $arr = explode(';', $arrays[4]); for($i=0 ; $i < sizeof($arr) ; $i++){ if($i==1||$i==4) $html_p08 .= "<td>".$arr[$i]."</td>"; }

            $html_p09 = "";
            $p09 = $dato['p09']; $arrays = explode('|', $p09);

            $arr = explode(';', $arrays[0]); for($i=0 ; $i < sizeof($arr) ; $i++){ if($i==2||$i==4){$valor = ($arr[$i] != '') ? 'X' : ''; $html_p09 .= "<td>".$valor."</td>";}}
            $arr = explode(';', $arrays[1]); for($i=0 ; $i < sizeof($arr) ; $i++){ if($i==2||$i==4){$valor = ($arr[$i] != '') ? 'X' : ''; $html_p09 .= "<td>".$valor."</td>";}}
            $arr = explode(';', $arrays[2]); for($i=0 ; $i < sizeof($arr) ; $i++){ if($i==2||$i==4){$valor = ($arr[$i] != '') ? 'X' : ''; $html_p09 .= "<td>".$valor."</td>";}}
            $arr = explode(';', $arrays[3]); for($i=0 ; $i < sizeof($arr) ; $i++){ if($i==2||$i==4){$valor = ($arr[$i] != '') ? 'X' : ''; $html_p09 .= "<td>".$valor."</td>";}}

            $arr = explode(';', $arrays[4]); for($i=0 ; $i < sizeof($arr) ; $i++){ if($i==2){$html_p09 .= "<td>".$arr[$i]."</td>";}}

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
        $html_p04
        $html_p05
        $html_p06
        $html_p07
        $html_p08
        $html_p09
		<td></td>
		
		</tr>";

		}
	 
	}
?>
</table>		  