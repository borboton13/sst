<?php
$idcentro    = $_POST["idcentro"];
$formulario  = $_POST["formulario"];
$fechainicio = $_POST["fechainicio"];
$fechafin    = $_POST["fechafin"];

header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=st_reporte_mtto.xls");
header("Pragma: no-cache");
header("Expires: 0");

$cabsP07 = array("250 Hr","500 Hr","750 Hr","1000 Hr");
$cabP07 = "";
for($i=1 ; $i <= 22 ; $i++){
    $cabP07 .= "<th></th>";
    foreach ($cabsP07 as $cab){
        $cabP07 .= "<th>$cab</th>";
    }
}

$cabecera = array("No Existe", "Malo", "Bajo", "Medio", "Alto", "Bueno", "Reparado", "Ajustado", "Cambiado", "Pendiente", "Otro");
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
    <th>Marca</th>
    <th>No. Serie</th>
    <th>RED-GRUPO</th>
    <th>PANEL-GRUPO</th>
    <th>GRUPO-GRUPO</th>

    <th>MEDIDAS CON EL MOTOR EN FUNCIONAMIENTO</th>
    <th></th>
    <th>ANTES MTTO</th>
    <th>DESPUES MTTO</th>

    <th>MEDIDAS CON EL MOTOR EN FUNCIONAMIENTO</th>
    <th></th>
    <th>ANTES MTTO</th>
    <th>DESPUES MTTO</th>

    <th>MEDIDAS CON EL MOTOR EN FUNCIONAMIENTO</th>
    <th></th>
    <th>ANTES MTTO</th>
    <th>DESPUES MTTO</th>

    <th>MEDIDAS CON EL MOTOR EN FUNCIONAMIENTO</th>
    <th></th>
    <th>ANTES MTTO</th>
    <th>DESPUES MTTO</th>

    <th>MEDIDAS CON EL MOTOR EN FUNCIONAMIENTO</th>
    <th></th>
    <th>ANTES MTTO</th>
    <th>DESPUES MTTO</th>

    <th></th>
    <th></th>
    <th>Fase 1</th>
    <th>Fase 2</th>
    <th>Fase 3</th>
    <th>Fase 1</th>
    <th>Fase 2</th>
    <th>Fase 3</th>
    <th></th>
    <th></th>
    <th>ANTES MTTO</th>
    <th>DESPUES MTTO</th>

    <th></th>
    <th>Fase 1</th>
    <th>Fase 2</th>
    <th>Fase 3</th>
    <th>Fase 1</th>
    <th>Fase 2</th>
    <th>Fase 3</th>
    <th></th>
    <th>Fase 1</th>
    <th>Fase 2</th>
    <th>Fase 3</th>
    <th>Fase 1</th>
    <th>Fase 2</th>
    <th>Fase 3</th>
    <th></th>
    <th>AM</th>
    <th>DM</th>
    <th></th>
    <th>Fase 1</th>
    <th>Fase 2</th>
    <th>Fase 3</th>
    <th>Fase 1</th>
    <th>Fase 2</th>
    <th>Fase 3</th>
    <th></th>
    <th>AM</th>
    <th>DM</th>
    <th>Verificación del funcionamiento en tensión del alternador de Baja [V]</th>
    <?php echo $cabP07; ?>
    <th></th>
    <?php echo $cab10; ?>
    <th></th>
    <?php echo $cab10; ?>
    <th></th>
    <?php echo $cab10; ?>
    <th></th>
    <?php echo $cab10; ?>
    <th></th>
    <?php echo $cab10; ?>
    <th></th>
    <?php echo $cab10; ?>
    <th></th>
    <?php echo $cab10; ?>
    <th></th>
    <?php echo $cab10; ?>

    <th></th>
    <?php echo $cab10; ?>
    <th></th>
    <?php echo $cab10; ?>
    <th></th>
    <?php echo $cab10; ?>
    <th></th>
    <?php echo $cab10; ?>

    <th></th>
    <?php echo $cab10; ?>
    <th></th>
    <?php echo $cab10; ?>
    <th></th>
    <?php echo $cab10; ?>
    <th></th>
    <?php echo $cab10; ?>
    <th></th>
    <?php echo $cab10; ?>
    <th>Cant Diesel del tanque de alimentación diaria [Lt]</th>
    <th>Cant Diesel en el tanque de almacenamiento [Lt]</th>
    <th>Cant aceite lubricante existente en la estación [Lt]</th>
    <th>Cant agua destilada existente en la estación [Lt]</th>
    <th>Marca Bateria 1</th>
    <th>Marca Bateria 2</th>
    <th></th><th>Celda 1</th><th>Celda 2</th><th>Celda 3</th><th>Celda 4</th><th>Celda 5</th><th>Celda 6</th><th>Celda 1</th><th>Celda 2</th><th>Celda 3</th><th>Celda 4</th><th>Celda 5</th><th>Celda 6</th>
    <th></th><th>Celda 1</th><th>Celda 2</th><th>Celda 3</th><th>Celda 4</th><th>Celda 5</th><th>Celda 6</th><th>Celda 1</th><th>Celda 2</th><th>Celda 3</th><th>Celda 4</th><th>Celda 5</th><th>Celda 6</th>
    <th></th><th>Celda 1</th><th>Celda 2</th><th>Celda 3</th><th>Celda 4</th><th>Celda 5</th><th>Celda 6</th><th>Celda 1</th><th>Celda 2</th><th>Celda 3</th><th>Celda 4</th><th>Celda 5</th><th>Celda 6</th>
    <th>Prueba de arranque con el grupo generador</th>
    <th>Medición de corriente de carga con el grupo encendido</th>
    <th>Verificar, limpiar, asegurar terminales de las baterías de arranque</th>
</tr>
<?	
	//$consulta="SELECT * FROM st_ticket;";
	$resultado=mysql_query("
	SELECT ev.inicio, es.nombre, f.titulo, f.p01, f.p02, f.p03, f.p04, f.p05, f.p06, f.p07, f.p08, f.p09, f.p10, f.p11, f.p12, f.p13, f.p14, f.p15
	FROM formulario_p006 f
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
            $p03 = $dato['p03']; $arr = explode(';', $p03);
            for($i=1 ; $i < sizeof($arr) ; $i++){ $valor = ($arr[$i] != '') ? 'X' : ''; $html_p03 .= "<td>".$valor."</td>";}


            $html_p04 = "";
            $p04 = $dato['p04']; $arrays = explode('|', $p04);
            $arr = explode(';', $arrays[0]); for($i=0 ; $i < sizeof($arr) ; $i++){ $html_p04 .= "<td>".$arr[$i]."</td>";}
            $arr = explode(';', $arrays[1]); for($i=0 ; $i < sizeof($arr) ; $i++){ $html_p04 .= "<td>".$arr[$i]."</td>";}
            $arr = explode(';', $arrays[2]); for($i=0 ; $i < sizeof($arr) ; $i++){ $html_p04 .= "<td>".$arr[$i]."</td>";}
            $arr = explode(';', $arrays[3]); for($i=0 ; $i < sizeof($arr) ; $i++){ $html_p04 .= "<td>".$arr[$i]."</td>";}
            $arr = explode(';', $arrays[4]); for($i=0 ; $i < sizeof($arr) ; $i++){ $html_p04 .= "<td>".$arr[$i]."</td>";}


            $html_p05 = "";
            $p05 = $dato['p05']; $arrays = explode('|', $p05);
            $arr = explode(';', $arrays[0]); for($i=0 ; $i < sizeof($arr) ; $i++){ $html_p05 .= "<td>".$arr[$i]."</td>";}
            $arr = explode(';', $arrays[1]); for($i=0 ; $i < sizeof($arr) ; $i++){ if($i==0||$i==1||$i==2||$i==5) $html_p05 .= "<td>".$arr[$i]."</td>"; }

            $html_p06 = "";
            $p06 = $dato['p06']; $arrays = explode('|', $p06);
            $arr = explode(';', $arrays[0]); for($i=0 ; $i < sizeof($arr) ; $i++){ $html_p06 .= "<td>".$arr[$i]."</td>";}
            $arr = explode(';', $arrays[1]); for($i=0 ; $i < sizeof($arr) ; $i++){ $html_p06 .= "<td>".$arr[$i]."</td>";}
            $arr = explode(';', $arrays[2]); for($i=0 ; $i < sizeof($arr) ; $i++){ if($i==0||$i==1||$i==4) $html_p06 .= "<td>".$arr[$i]."</td>"; }
            $arr = explode(';', $arrays[3]); for($i=0 ; $i < sizeof($arr) ; $i++){ $html_p06 .= "<td>".$arr[$i]."</td>";}
            $arr = explode(';', $arrays[4]); for($i=0 ; $i < sizeof($arr) ; $i++){ if($i==0||$i==1||$i==4) $html_p06 .= "<td>".$arr[$i]."</td>"; }

            $p06_1 = $dato['p06_1'];

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

            $arr = explode(';', $arrays[4]); $html_p07 .= "<td>".$arr[0]."</td>";
            for($i=1 ; $i < sizeof($arr) ; $i++){ $valor = ($arr[$i] != '') ? 'X' : ''; $html_p07 .= "<td>".$valor."</td>";}

            $arr = explode(';', $arrays[5]); $html_p07 .= "<td>".$arr[0]."</td>";
            for($i=1 ; $i < sizeof($arr) ; $i++){ $valor = ($arr[$i] != '') ? 'X' : ''; $html_p07 .= "<td>".$valor."</td>";}

            $arr = explode(';', $arrays[6]); $html_p07 .= "<td>".$arr[0]."</td>";
            for($i=1 ; $i < sizeof($arr) ; $i++){ $valor = ($arr[$i] != '') ? 'X' : ''; $html_p07 .= "<td>".$valor."</td>";}

            $arr = explode(';', $arrays[7]); $html_p07 .= "<td>".$arr[0]."</td>";
            for($i=1 ; $i < sizeof($arr) ; $i++){ $valor = ($arr[$i] != '') ? 'X' : ''; $html_p07 .= "<td>".$valor."</td>";}

            $arr = explode(';', $arrays[8]); $html_p07 .= "<td>".$arr[0]."</td>";
            for($i=1 ; $i < sizeof($arr) ; $i++){ $valor = ($arr[$i] != '') ? 'X' : ''; $html_p07 .= "<td>".$valor."</td>";}

            $arr = explode(';', $arrays[9]); $html_p07 .= "<td>".$arr[0]."</td>";
            for($i=1 ; $i < sizeof($arr) ; $i++){ $valor = ($arr[$i] != '') ? 'X' : ''; $html_p07 .= "<td>".$valor."</td>";}

            $arr = explode(';', $arrays[10]); $html_p07 .= "<td>".$arr[0]."</td>";
            for($i=1 ; $i < sizeof($arr) ; $i++){ $valor = ($arr[$i] != '') ? 'X' : ''; $html_p07 .= "<td>".$valor."</td>";}

            $arr = explode(';', $arrays[11]); $html_p07 .= "<td>".$arr[0]."</td>";
            for($i=1 ; $i < sizeof($arr) ; $i++){ $valor = ($arr[$i] != '') ? 'X' : ''; $html_p07 .= "<td>".$valor."</td>";}

            $arr = explode(';', $arrays[12]); $html_p07 .= "<td>".$arr[0]."</td>";
            for($i=1 ; $i < sizeof($arr) ; $i++){ $valor = ($arr[$i] != '') ? 'X' : ''; $html_p07 .= "<td>".$valor."</td>";}

            $arr = explode(';', $arrays[13]); $html_p07 .= "<td>".$arr[0]."</td>";
            for($i=1 ; $i < sizeof($arr) ; $i++){ $valor = ($arr[$i] != '') ? 'X' : ''; $html_p07 .= "<td>".$valor."</td>";}

            $arr = explode(';', $arrays[14]); $html_p07 .= "<td>".$arr[0]."</td>";
            for($i=1 ; $i < sizeof($arr) ; $i++){ $valor = ($arr[$i] != '') ? 'X' : ''; $html_p07 .= "<td>".$valor."</td>";}

            $arr = explode(';', $arrays[15]); $html_p07 .= "<td>".$arr[0]."</td>";
            for($i=1 ; $i < sizeof($arr) ; $i++){ $valor = ($arr[$i] != '') ? 'X' : ''; $html_p07 .= "<td>".$valor."</td>";}

            $arr = explode(';', $arrays[16]); $html_p07 .= "<td>".$arr[0]."</td>";
            for($i=1 ; $i < sizeof($arr) ; $i++){ $valor = ($arr[$i] != '') ? 'X' : ''; $html_p07 .= "<td>".$valor."</td>";}

            $arr = explode(';', $arrays[17]); $html_p07 .= "<td>".$arr[0]."</td>";
            for($i=1 ; $i < sizeof($arr) ; $i++){ $valor = ($arr[$i] != '') ? 'X' : ''; $html_p07 .= "<td>".$valor."</td>";}

            $arr = explode(';', $arrays[18]); $html_p07 .= "<td>".$arr[0]."</td>";
            for($i=1 ; $i < sizeof($arr) ; $i++){ $valor = ($arr[$i] != '') ? 'X' : ''; $html_p07 .= "<td>".$valor."</td>";}

            $arr = explode(';', $arrays[19]); $html_p07 .= "<td>".$arr[0]."</td>";
            for($i=1 ; $i < sizeof($arr) ; $i++){ $valor = ($arr[$i] != '') ? 'X' : ''; $html_p07 .= "<td>".$valor."</td>";}

            $arr = explode(';', $arrays[20]); $html_p07 .= "<td>".$arr[0]."</td>";
            for($i=1 ; $i < sizeof($arr) ; $i++){ $valor = ($arr[$i] != '') ? 'X' : ''; $html_p07 .= "<td>".$valor."</td>";}

            $arr = explode(';', $arrays[21]); $html_p07 .= "<td>".$arr[0]."</td>";
            for($i=1 ; $i < sizeof($arr) ; $i++){ $valor = ($arr[$i] != '') ? 'X' : ''; $html_p07 .= "<td>".$valor."</td>";}

            //$p08 = $dato['p08'];
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

            $arr = explode(';', $arrays[4]); $html_p08 .= "<td>".$arr[0]."</td>";
            for($i=1 ; $i < sizeof($arr) ; $i++){ if ($i < sizeof($arr)-1) $valor = ($arr[$i] != '') ? 'X' : ''; else  $valor = $arr[$i]; $html_p08 .= "<td>".$valor."</td>"; }

            $arr = explode(';', $arrays[5]); $html_p08 .= "<td>".$arr[0]."</td>";
            for($i=1 ; $i < sizeof($arr) ; $i++){ if ($i < sizeof($arr)-1) $valor = ($arr[$i] != '') ? 'X' : ''; else  $valor = $arr[$i]; $html_p08 .= "<td>".$valor."</td>"; }

            $arr = explode(';', $arrays[6]); $html_p08 .= "<td>".$arr[0]."</td>";
            for($i=1 ; $i < sizeof($arr) ; $i++){ if ($i < sizeof($arr)-1) $valor = ($arr[$i] != '') ? 'X' : ''; else  $valor = $arr[$i]; $html_p08 .= "<td>".$valor."</td>"; }

            $arr = explode(';', $arrays[7]); $html_p08 .= "<td>".$arr[0]."</td>";
            for($i=1 ; $i < sizeof($arr) ; $i++){ if ($i < sizeof($arr)-1) $valor = ($arr[$i] != '') ? 'X' : ''; else  $valor = $arr[$i]; $html_p08 .= "<td>".$valor."</td>"; }

            $html_p09 = "";
            $p09 = $dato['p09']; $arrays = explode('|', $p09);

            $arr = explode(';', $arrays[0]); $html_p09 .= "<td>".$arr[0]."</td>";
            for($i=1 ; $i < sizeof($arr) ; $i++){ if ($i < sizeof($arr)-1) $valor = ($arr[$i] != '') ? 'X' : ''; else  $valor = $arr[$i]; $html_p09 .= "<td>".$valor."</td>"; }

            $arr = explode(';', $arrays[1]); $html_p09 .= "<td>".$arr[0]."</td>";
            for($i=1 ; $i < sizeof($arr) ; $i++){ if ($i < sizeof($arr)-1) $valor = ($arr[$i] != '') ? 'X' : ''; else  $valor = $arr[$i]; $html_p09 .= "<td>".$valor."</td>"; }

            $arr = explode(';', $arrays[2]); $html_p09 .= "<td>".$arr[0]."</td>";
            for($i=1 ; $i < sizeof($arr) ; $i++){ if ($i < sizeof($arr)-1) $valor = ($arr[$i] != '') ? 'X' : ''; else  $valor = $arr[$i]; $html_p09 .= "<td>".$valor."</td>"; }

            $arr = explode(';', $arrays[3]); $html_p09 .= "<td>".$arr[0]."</td>";
            for($i=1 ; $i < sizeof($arr) ; $i++){ if ($i < sizeof($arr)-1) $valor = ($arr[$i] != '') ? 'X' : ''; else  $valor = $arr[$i]; $html_p09 .= "<td>".$valor."</td>"; }

            $html_p10 = "";
            $p10 = $dato['p10']; $arrays = explode('|', $p10);

            $arr = explode(';', $arrays[0]); $html_p10 .= "<td>".$arr[0]."</td>";
            for($i=1 ; $i < sizeof($arr) ; $i++){ if ($i < sizeof($arr)-1) $valor = ($arr[$i] != '') ? 'X' : ''; else  $valor = $arr[$i]; $html_p10 .= "<td>".$valor."</td>"; }

            $arr = explode(';', $arrays[1]); $html_p10 .= "<td>".$arr[0]."</td>";
            for($i=1 ; $i < sizeof($arr) ; $i++){ if ($i < sizeof($arr)-1) $valor = ($arr[$i] != '') ? 'X' : ''; else  $valor = $arr[$i]; $html_p10 .= "<td>".$valor."</td>"; }

            $arr = explode(';', $arrays[2]); $html_p10 .= "<td>".$arr[0]."</td>";
            for($i=1 ; $i < sizeof($arr) ; $i++){ if ($i < sizeof($arr)-1) $valor = ($arr[$i] != '') ? 'X' : ''; else  $valor = $arr[$i]; $html_p10 .= "<td>".$valor."</td>"; }

            $arr = explode(';', $arrays[3]); $html_p10 .= "<td>".$arr[0]."</td>";
            for($i=1 ; $i < sizeof($arr) ; $i++){ if ($i < sizeof($arr)-1) $valor = ($arr[$i] != '') ? 'X' : ''; else  $valor = $arr[$i]; $html_p10 .= "<td>".$valor."</td>"; }

            $arr = explode(';', $arrays[4]); $html_p10 .= "<td>".$arr[0]."</td>";
            for($i=1 ; $i < sizeof($arr) ; $i++){ if ($i < sizeof($arr)-1) $valor = ($arr[$i] != '') ? 'X' : ''; else  $valor = $arr[$i]; $html_p10 .= "<td>".$valor."</td>"; }


            $html_p11 = "";
            $p11 = $dato['p11']; $arrays = explode('|', $p11);
            $arr = explode(';', $arrays[0]); for($i=0 ; $i < sizeof($arr) ; $i++){ if ($i==1 || $i==3) $html_p11 .= "<td>".$arr[$i]."</td>";}
            $arr = explode(';', $arrays[1]); for($i=0 ; $i < sizeof($arr) ; $i++){ if ($i==1 || $i==3) $html_p11 .= "<td>".$arr[$i]."</td>";}

            $p12 = $dato['p12'];
            $p13 = $dato['p13'];

            $html_p14 = "";
            $p14 = $dato['p14']; $arrays = explode('|', $p14);
            $arr = explode(';', $arrays[0]); for($i=0 ; $i < sizeof($arr) ; $i++){ $html_p14 .= "<td>".$arr[$i]."</td>";}
            $arr = explode(';', $arrays[1]); for($i=0 ; $i < sizeof($arr) ; $i++){ $html_p14 .= "<td>".$arr[$i]."</td>";}
            $arr = explode(';', $arrays[2]); for($i=0 ; $i < sizeof($arr) ; $i++){ $html_p14 .= "<td>".$arr[$i]."</td>";}

            $html_p15 = "";
            $p15 = $dato['p15']; $arrays = explode('|', $p15);
            $arr = explode(';', $arrays[0]); for($i=0 ; $i < sizeof($arr) ; $i++){ if ($i==1){$valor = ($arr[$i] != '') ? 'X' : '';$html_p15 .= "<td>".$valor."</td>";  } }
            $arr = explode(';', $arrays[1]); for($i=0 ; $i < sizeof($arr) ; $i++){ if ($i==1){$valor = ($arr[$i] != '') ? 'X' : '';$html_p15 .= "<td>".$valor."</td>";  } }
            $arr = explode(';', $arrays[2]); for($i=0 ; $i < sizeof($arr) ; $i++){ if ($i==1){$valor = ($arr[$i] != '') ? 'X' : '';$html_p15 .= "<td>".$valor."</td>";  } }



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
	    <td>$p06_1</td>
	    $html_p07
	    $html_p08
	    $html_p09
	    $html_p10
	    $html_p11
	    <td>$p12</td>
	    <td>$p13</td>
	    $html_p14
	    $html_p15
		</tr>";

		}
	 
	}
?>
</table>		  