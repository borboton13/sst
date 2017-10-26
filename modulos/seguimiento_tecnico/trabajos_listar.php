<?
function mostrar_detalles($nro){
global $link_modulo_r;
global $adm;
?>
<table width="98%" class="table4" align="center">
<tr>
<th width="2%">N&deg;</th>
<th width="15%">PRODUCTO/SERVICIO</th>			              
<th width="20%">ESTACION</th>
<th width="17%">MARCA y SN</th>
<th width="17%">DETALLES</th> 
<th width="17%">ESTADO ACTUAL</th>
<th width="7%">INFORME</th>
<th width="5%" colspan="2">VISITAS</th>
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
 	 $dato_p=mysql_fetch_array(mysql_query("SELECT descripcion FROM parametrica WHERE grupo='st_archivo' AND sub_grupo='".$producto."'"));
	 $from="st_cronograma_informes_".$dato_p['descripcion']; 
	 $marca=$dato[2]; 
	 $caracteristicas=$dato[3]; 
	 $sn=$dato[4];
	 $ubicacion=$dato[5]; 
	 $id_item=$dato[6]; 
	 $datox=mysql_fetch_array(mysql_query("SELECT observacion FROM st_items_obs WHERE id_item=$id_item ORDER BY fecha DESC LIMIT 1"));
	 if($datox[0]!="") {
	 if($datox[0]!="Ocultar")
	 $obs="<BR><SPAN CLASS='title7'><label>".$datox[0]." <a href='".$link_modulo_r."?path=trabajos_obs_ver.php&id_item=".$id_item."' onclick=\"return GB_showCenter('Ver Historial Completo', this.href,420, 290)\" title='Ver Historial Completo'><img src='../../img/ico_ver_mas.gif' border=\"0\" width=\"12\" height=\"10\"></a></label></SPAN>";
	 else $obs="<BR><a href='".$link_modulo_r."?path=trabajos_obs_ver.php&id_item=".$id_item."' onclick=\"return GB_showCenter('Ver Historial Completo', this.href,420, 290)\" title='Ver Historial Completo'><img src='../../img/ico_ver_mas.gif' border=\"0\" width=\"12\" height=\"10\"></a>";	 
	 }
	 else $obs="";
	 
	 $i++;
	 if($departamento_aux!=$departamento)
	 {echo "<tr bgcolor='#FFE3BB'><td colspan='9'><span class='title'>$departamento</span></td></tr>";}
	 
	 if($i%2==0) $rowt="#f1f1f1";
	 else $rowt="#f6f7f8";	 
	 
	 $b=mysql_fetch_array(mysql_query("SELECT date_format(fecha_registro,'%d/%m/%y'),condicion_final,postm_condicion_final,date_format(postm_fecha,'%d/%m/%y') FROM ".$from." WHERE id_item='".$id_item."' AND condicion_final<>'' ORDER BY periodo DESC limit 1"));
 	$condicion_fecha=$b[0];
	$condicion_final=$b[1];
	$postm_condicion_final=$b[2];
	$postm_fecha=$b[3];
	if($postm_condicion_final=="OK+") {
	$img="<img src='../../img/semaforo_azul.gif' border=\"0\" width=\"62\" height=\"16\" align=\"absmiddle\" alt='Estado: OK'>";
	$condicion_final=$postm_condicion_final;
	$condicion_fecha=$postm_fecha;
	}
	else {
	switch($condicion_final){
	case 'OK' : $img="<img src='../../img/semaforo_verde.gif' border=\"0\" width=\"46\" height=\"16\" align=\"absmiddle\">"; break;
	case 'Pendiente' : $img="<img src='../../img/semaforo_amarillo.gif' border=\"0\" width=\"46\" height=\"16\" align=\"absmiddle\">"; break;
	case 'Irreparable' : $img="<img src='../../img/semaforo_rojo.gif' border=\"0\" width=\"46\" height=\"16\" align=\"absmiddle\">"; break;
	default: $img='Sin Reporte';
	}
	}
	echo " 
	<tr bgcolor='$rowt' onmouseover=\"setPointer(this, '#DADADA')\" onmouseout=\"setPointer(this, '$rowt')\">
	<td>$i</td> 
	<td>$producto</td>
	<td>$ubicacion</td>"; 
	if($sn!='') echo"<td>".$marca."<br><span class='title5'>S/N: $sn</span></td>";
	else echo"<td>".$marca."</td>";	
	echo"<td>$caracteristicas</td> 
	<td><center><span class='title6'>$condicion_final</span> <span class='title5'>$condicion_fecha</span> ".$img.$obs."</center></td> 
	<td><a href='".$link_modulo_r."?path=trabajos_visitas_ver.php&id_item=".$id_item."' onclick=\"return GB_showCenter('Ver Actividades', this.href,460, 460)\" class='enlaceboton'><img src='../../img/tarea.gif' alt='Programar Actividades' border=\"0\" align=\"absmiddle\">Informe</a></td><td><center>"; 
	
	$c=mysql_fetch_array(mysql_query("SELECT count(id_item),count(condicion_final) FROM ".$from." WHERE id_item='".$id_item."'"));
		
	if($c[0]!=0)
	{
	echo "<span class='marcar'>".$c[1]."/".$c[0]."</span>";
	}
	else echo"?";
	
	echo"</td><td width='2%'>"; 
	if($adm){
	echo"<a href='#' onclick=\"Eliminar('trabajos_listar','".base64_encode($id_item)."','".base64_encode($nro)."','".$adm."')\" class='enlaceboton'><img src='../../img/actionCancel.gif' alt='Eliminar Item' border=\"0\"></a>";
	}
	echo"</td></tr>"; 
	
	
	 $departamento_aux=$departamento;
	 }
	 
	}
?>
</table>
<?
}	
?>

