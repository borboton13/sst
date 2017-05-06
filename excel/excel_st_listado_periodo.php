<?
require("../funciones/motor.php");
$nro = base64_decode($_GET["nro"]);
$periodo = $_GET["periodo"];
$adm = $_GET["adm"];
$id_user = $_GET["id_user"];

header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=st_listado_perido_".$periodo."_".date("Y-m-d").".xls");
header("Pragma: no-cache");
header("Expires: 0");

	$consulta="SELECT c.razon_social
FROM st_proyecto s INNER JOIN clientes c ON s.id_cliente=c.id WHERE s.id_st_proyecto='".$nro."'";
	$resultado=mysql_query($consulta);
	$dato=mysql_fetch_array($resultado);

	 $razon_social=$dato[0]; 

?>
<table border="1">
<caption>
<b>Cronograma correspondiente al: <?=$periodo;?>
    &deg; PERIODO</b><br />Nro:<?=$nro;?> | Cliente:<?=$razon_social;?></caption>
<tr>
<th>N&deg;</th>
<th>PRODUCTO/SERVICIO</th>			              
<th>ESTACION</th>
<th>MARCA y S/N</th>
<th>CARACTERISTICAS</th> 
<th>ESTADO ACTUAL</th>
<th>TECNICO  </th>
<th>FECHA </th>
</tr>
<?	
$consulta="SELECT departamento,producto,marca,caracteristicas,sn,ubicacion,id_item FROM st_trabajos WHERE id_st_proyecto='".$nro."' ORDER BY departamento ASC, id_item ASC";
	$resultado=mysql_query($consulta);
	$filas=mysql_num_rows($resultado);
	if($filas!=0)
	{ 

	$i=0;
	while($dato=mysql_fetch_array($resultado))
	 {
	 
	 $departamento=$dato[0]; 
	 $producto=$dato[1]; 
	 $marca=$dato[2]; 
	 $caracteristicas=$dato[3]; 
	 $sn=$dato[4];
	 $ubicacion=$dato[5]; 
	 $id_item=$dato[6]; 
	 
	 $i++;
	 if($departamento_aux!=$departamento)
	 {echo "<tr><td colspan='8'><B>$departamento</B></td></tr>";}
	 
	$dato_st=mysql_fetch_array(mysql_query("SELECT b.descripcion FROM st_trabajos a, parametrica b  WHERE a.id_item='".$id_item."' AND b.grupo='st' AND b.sub_grupo=a.producto"));
    $st_cronograma_informes=$dato_st['descripcion'];
	
	if($adm!=1){
	$add_sql=" AND s.id_usuario='".$id_user."'";
	}
	$resultado_z=mysql_query("SELECT (case dayofweek(s.fecha) when 1 then 'DOM' when 2 then 'LUN' when 3 then 'MAR' when 4 then 'MIE' when 5 then 'JUE' when 6 then 'VIE' when 7 then 'SAB' end) as dia,date_format(s.fecha,'%d/%m/%y'),s.condicion_final,date_format(s.fecha_registro,'%d/%m/%y'),CONCAT(u.nombre,' ',u.ap_pat),date_format(s.hora_programada,'%H:%i'),postm_condicion_final FROM ".$st_cronograma_informes." s INNER JOIN usuarios u ON s.id_item='".$id_item."' AND s.id_usuario=u.id WHERE s.periodo='".$periodo."'".$add_sql);
	$filas_z=mysql_num_rows($resultado_z);
	
	if($filas_z!=0){
	$b=mysql_fetch_array($resultado_z);
 	$dia=$b[0];
	$fecha=$b[1];
	$condicion_final=$b[2];
	$condicion_fecha=$b[3];
	$tecnico=$b[4];
	$hora_p=$b[5];
	$postm_condicion_final=$b[6];
	
	if($condicion_final=="" || $condicion_final==NULL) $condicion_final="Sin Reporte";
	 
	echo " 
	<tr>
	<td>$i</td> 
	<td>$producto</td>
	<td>$ubicacion</td>"; 
	if($sn!='') echo"<td>".$marca."<br>S/N: ".$sn."</td>";
	else echo"<td>".$marca."</td>";	
	echo"<td>$caracteristicas</td> 
	<td><center><b>$condicion_final</b> $condicion_fecha</center></td> 
	<td>$tecnico</td>  	
	<td><center>"; 
	if($fecha!="") echo "<b>$dia</b>".$fecha." $hora_p";
	else echo"?";	
	echo"</center></td></tr>"; 
		
	}
	
	 $departamento_aux=$departamento;
	 }
	 
	}
?>
</table>		  