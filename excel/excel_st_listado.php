<?
require("../funciones/motor.php");
$nro = base64_decode($_GET["nro"]);

header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=st_listado_".date("Y-m-d").".xls");
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
    &deg; PERIODO</b><br />Nro: <?=$nro;?> | Cliente: <?=$razon_social;?></caption>
<tr>
<th>N&deg;</th>
<th>PRODUCTO/SERVICIO</th>			              
<th>ESTACION</th>
<th>MARCA y S/N</th>
<th>CARACTERISTICAS</th> 
<th>ESTADO ACTUAL</th>
<th>FECHA  </th>
<th>TRS </th>
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
 	 $dato_p=mysql_fetch_array(mysql_query("SELECT descripcion FROM parametrica WHERE grupo='st' AND sub_grupo='".$producto."'"));
	 $from=$dato_p['descripcion']; 
	 $marca=$dato[2]; 
	 $caracteristicas=$dato[3]; 
	 $sn=$dato[4];
	 $ubicacion=$dato[5]; 
	 $id_item=$dato[6]; 
	 	 	 
	 $i++;
	 if($departamento_aux!=$departamento)
	 {echo "<tr><td colspan='8'><B>$departamento</B></td></tr>";}
	 	 
	 $b=mysql_fetch_array(mysql_query("SELECT date_format(fecha_registro,'%d/%m/%y'),condicion_final,postm_condicion_final,date_format(postm_fecha,'%d/%m/%y') FROM ".$from." WHERE id_item='".$id_item."' AND condicion_final<>'' ORDER BY periodo DESC limit 1"));
 	$condicion_fecha=$b[0];
	$condicion_final=$b[1];
	$postm_condicion_final=$b[2];
	$postm_fecha=$b[3];
	if($postm_condicion_final=="OK+") {
	$condicion_final=$postm_condicion_final;
	$condicion_fecha=$postm_fecha;
	}
	if($condicion_final=="" || $condicion_final==NULL) $condicion_final="Sin Reporte";

	echo " 
	<tr>
	<td>$i</td> 
	<td>$producto</td>
	<td>$ubicacion</td>"; 
	if($sn!='') echo"<td>".$marca."<br>S/N: ".$sn."</td>";
	else echo"<td>".$marca."</td>";	
	echo"<td>$caracteristicas</td> 
	<td><center>$condicion_final</center></td><td><center>$condicion_fecha</center></td> 
	<td ".'style="mso-number-format:\'\@\';"'."><center>"; 	
	$c=mysql_fetch_array(mysql_query("SELECT count(id_item),count(condicion_final) FROM ".$from." WHERE id_item='".$id_item."'"));
		
	if($c[0]!=0)
	{
	echo $c[1]."/".$c[0];
	}
	else echo"?";
	
	echo"</center></td></tr>"; 
	
	
	 $departamento_aux=$departamento;
	 }
	 
	}
?>
</table>		  