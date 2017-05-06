<?php
require("../funciones/motor.php");
$nro = base64_decode($_GET["nro"]);

header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=st_listado_ticket".date("Y-m-d").".xls");
header("Pragma: no-cache");
header("Expires: 0");

?>
<table border="1">
<tr>
<th>N&deg;</th>
<th>TICKET</th>			              
<th>NODO</th>
<th>ESTACION</th>
<th>FECHA INI RIF</th> 
<th>HORA INI RIF</th>
<th>FECHA FIN RIF</th>
<th>HORA FIN RIF</th>
<th>DURACION</th>
<th>TIPO</th>
<th>PROBLEMA</th>
<th>FECHA NOT</th>
<th>HORA NOT</th>
<th>PLAN ACCION</th>
<th>TRABAJO REALIZADO</th>
<th>PERSONAL</th>
<th>OBSERVACIONES</th>
</tr>
<?	
	$consulta="SELECT * FROM st_ticket;";
	$resultado=mysql_query($consulta);
	$filas=mysql_num_rows($resultado);
	if($filas!=0)
	{ 

	$i=0;
	while($dato=mysql_fetch_array($resultado))
	 {
	 
	 $d01 = $dato[1]; 
	 $d02 = $dato[2];
	 $d03 = $dato[3];
	 $d04 = $dato[4];
	 $d05 = $dato[5];
	 $d06 = $dato[6];
	 $d07 = $dato[7];
	 $d08 = $dato[8];
	 $d09 = $dato[9];
	 $d10 = $dato[10];
	 $d11 = $dato[11];
	 $d12 = $dato[12];
	 $d13 = $dato[13];
	 $d14 = $dato[14];
	 $d15 = $dato[15];
	 	 	 
	 $i++;
	 
	 //$dif = date("H:i", strtotime("00:00") + strtotime($d06.' '.$d07) - strtotime($d04.' '.$d05));
	 /* ------------------------------------------------------ */
		$date1 = $d06.' '.$d07;
		$date2 = $d04.' '.$d05;
		$s = $ss = strtotime($date1)-strtotime($date2);
		$d = intval($s/86400);
		$s -= $d*86400;
		$h = intval($s/3600);
		$s -= $h*3600;
		$m = intval($s/60);
		$s -= $m*60;
		
		if($dato['fecha_fin_rif']){
			$dif1 = (($d*24)+$h).hrs." ".$m."min";
		}else{
			$dif1 = '';	
		}
		/* ------------------------------------------------------ */
	 
	echo " 
	<tr>
	<td>$i</td> 
	<td>$d01</td>
	<td>$d02</td>
	<td>$d03</td>
	<td>$d04</td>
	<td>$d05</td>
	<td>$d06</td>
	<td>$d07</td>
	<td>$dif1</td>		
	<td>$d08</td>
	<td>$d09</td>
	<td>$d10</td>
	<td>$d11</td>
	<td>$d12</td>
	<td>$d13</td>
	<td>$d14</td>
	<td>$d15</td>
	</tr>"; 
	
	}
	 
	}
?>
</table>		  