<?php

$rowt=array("#f1f1f1","#f6f7f8");

?>
<div align="center"><span class="title">ESTACIONES PARA SEGUIMIENTO TECNICO</span></div>
<table width="98%" align="center" class="table4">
<tr>
	<tr>
	<th width="2%">N&deg;</th>
	<th width="8%">TICKET</th>
	<th width="7%">APERTURA</th>
	<th width="7%">NOTIFICACION</th>
	<th width="7%">CIERRE</th>
	<th width="7%">DURAC_APE</th>
	<th width="7%">DURAC_NOT</th>
	<th width="5%">ID NODO</th>
	<th width="20%">ESTACION</th>
	<th width="5%">TIPO</th>
	<th width="12%">PROBLEMA</th>
	</tr>
<?php
$consulta = "SELECT * FROM estacion";
$resultado = mysql_query($consulta);
$filas	   = mysql_num_rows($resultado);

if($filas!=0){
	$i=0;
	while($dato=mysql_fetch_array($resultado)){	
		$i++;

        if($i%2==0) $rowt="#f1f1f1"; else $rowt="#f6f7f8";
						
        echo "
        <tr bgcolor='$rowt' onmouseover=\"setPointer(this, '#DADADA')\" onmouseout=\"setPointer(this, '$rowt')\">
        <td>".$i."</td>
        <td><center>".$dato['idestacion']."</center></td>
        <td><center>".$dato['codigo']."</center></td>
        <td><center>".$dato['nombre']."</center></td>
        <td><center>".$dato['idcentro']."</center></td>
        <td><center>".$dato['provicia']."</center></td>
        <td><center>".$dato['tipo_zona']."</center></td>
        <td><center>".$dato['equipos']."</center></td>
        <td><center>".$dato['tipo']."</center></td>
        <td><center>".$dato['periodicidad']."</center></td>
        <td><center>".$dato['clasificacion']."</center></td>
        </tr>";

    }
}
?>
</table>			  
    <!--<link href="../../paquetes/greybox/gb_styles.css" rel="stylesheet" type="text/css" media="all" />-->
    <script type="text/javascript">
        //var GB_ROOT_DIR = "./../../paquetes/greybox/";
    </script>    
	<!--<script type="text/javascript" src="../../paquetes/greybox/AJS.js"></script>-->
    <!--<script type="text/javascript" src="../../paquetes/greybox/AJS_fx.js"></script>-->
    <!--<script type="text/javascript" src="../../paquetes/greybox/gb_scripts_no_reload.js"></script>-->
    <!--<link type="text/css" rel="stylesheet" href="../../paquetes/calendar/dhtmlgoodies_calendar/dhtmlgoodies_calendar.css?random=20051112" media="screen" />-->
    <!--<SCRIPT type="text/javascript" src="../../paquetes/calendar/dhtmlgoodies_calendar/dhtmlgoodies_calendar.js?random=20060118"></script>-->
