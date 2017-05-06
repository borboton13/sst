<?
if($nively=='1'){ $adm=1;}
$nro = base64_decode($_GET["nro"]);
$periodo = $_GET["periodo"];
?>
<table width="98%" align="center" class="table3">
<caption>
Cronograma correspondiente al: <?=$periodo;?>
    &deg; PERIODO</caption>
	<tr>
	<td width="49%" valign="top">
	<? 
	$consulta="SELECT c.razon_social,s.declaracion_proyecto,date_format(s.fecha_inicio,'%d/%m/%Y'),date_format(s.fecha_final,'%d/%m/%Y'),concat(u.nombre, ' ', u.ap_pat),s.fecha_registro 
FROM (st_proyecto s INNER JOIN clientes c ON s.id_cliente=c.id) INNER JOIN usuarios u ON s.id_usuario=u.id WHERE s.id_st_proyecto='".$nro."'";
	$resultado=mysql_query($consulta);
	$dato=mysql_fetch_array($resultado);

	 $razon_social=$dato[0]; 
	 $declaracion_proyecto=$dato[1]; 
	 $fecha_inicio=$dato[2]; 
	 $fecha_final=$dato[3];
	 if($fecha_final=="00/00/0000") $fecha_final="Indefinido"; 
	 $id_usuario=$dato[4]; 
	 $fecha_registro=$dato[5]; 

	?>
	Nro: <span class="title"><?=$nro;?></span><br>
	Ingresado por: <span class="title6"><?=$id_usuario;?></span><br>
	Cliente:  <span class="title7"><?=$razon_social;?></span></td>	
	<td width="49%" valign="top" align="right">Fecha Inicial: <span class="title6">
	  <?=$fecha_inicio;?>
	</span><br>
Fecha final: <span class="title6">
<?=$fecha_final;?>
</span><br>
Fecha Registro: <span class="title6">
<?=$fecha_registro;?>
</span>		</td>
	</tr>
	<tr>
	  <td colspan="2" valign="top"><table>
	    <tr>	      
	      <td class="marco"><a class="enlaceboton" href="../../excel/excel_st_listado_periodo.php?nro=<?=base64_encode($nro);?>&periodo=<?=$periodo;?>&adm=<?=$adm;?>&id_user=<?=$id_user;?>" onClick="openNewWindowhtml( this, '800', '590' );return false;"><img src="../../img/excel_ico.gif" alt="Ver Listado en Excel" width="16" height="16" border="0" align="absmiddle" /> Ver Listado en Excel</a></td>
	      <td class="marco"><a class="enlaceboton" href="<?=$link_modulo?>?path=trabajos_ver.php&nro=<?=base64_encode($nro);?>"><img src="../../img/informe_detalles.gif" alt="Ver Listado en Excel" width="16" height="16" border="0" align="absmiddle" /> Ver Listado General</a></td>
	      <td class="marco"><form>
	        <img src="../../img/filtrar_s.gif" alt="buscar" width="24" height="20"  align="absbottom">
	        <select name="select" class='selectbuscar' onChange='document.location=this.options[this.selectedIndex].value'>
                <?
$periodos=0;
$resultado=mysql_query("SELECT descripcion FROM parametrica WHERE grupo='st'");
while($dato=mysql_fetch_array($resultado))
{
$datox=mysql_fetch_array(mysql_query("SELECT MAX(periodo) AS periodo FROM ".$dato['descripcion']." WHERE id_st_proyecto='".$nro."'"));
if($datox['periodo']>=$periodos) $periodos=$datox['periodo'];
}

for($k=1;$k<=$periodos;$k++)
{
if($periodo==$k) echo "<option value='0' selected class='rojo'>".$k."&deg; Periodo</option>";
else echo "<option value='".$link_modulo."?path=trabajos_ver_periodos.php&periodo=$k&nro=".base64_encode($nro)."' class='naranja'>".$k."&deg; Periodo</option>";
}										  
?>
              </select>
	        </form></td>
        </tr>
	    </table>	  </td>
  </tr>
</table>
<table width="98%" class="table3" align="center">
<tr>
<th width="1%" height="16" >N&deg;</th>
<th width="15%">PRODUCTO/SERVICIO</th>			              
<th width="17%">ESTACION</th>
<th width="14%">MARCA y S/N</th>
<th width="14%">CARACTERISTICAS</th> 
<th width="14%">ESTADO ACTUAL</th>
<th width="11%">TECNICO  </th>
<th width="6%">INFORME</th>
<th width="8%">FECHA </th>
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
	 {echo "<tr bgcolor='#FFE3BB'><td colspan='9'><span class='title'>$departamento</span></td></tr>";}
	 
	 if($i%2==0) $rowt="#f1f1f1";
	 else $rowt="#f6f7f8";
	 
	$dato_st=mysql_fetch_array(mysql_query("SELECT b.descripcion FROM st_trabajos a, parametrica b  WHERE a.id_item='".    $id_item."' AND b.grupo='st' AND b.sub_grupo=a.producto"));
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
	
	switch($condicion_final){
	case 'OK' : $img="<img src='../../img/semaforo_verde.gif' border=\"0\" width=\"46\" height=\"16\" align=\"absmiddle\" alt='Estado: OK'>"; break;
	case 'Pendiente' : 
	if($postm_condicion_final=="OK+") {
	$img="<img src='../../img/semaforo_azul.gif' border=\"0\" width=\"62\" height=\"16\" align=\"absmiddle\" alt='Estado: OK'>";
	$condicion_final=$postm_condicion_final;
	}		
		else $img="<img src='../../img/semaforo_amarillo.gif' border=\"0\" width=\"46\" height=\"16\" align=\"absmiddle\" alt='Estado: Pendiente'>"; break;
	case 'Irreparable' : 
	if($postm_condicion_final=="OK+") {
	$img="<img src='../../img/semaforo_azul.gif' border=\"0\" width=\"62\" height=\"16\" align=\"absmiddle\" alt='Estado: OK'>";
	$condicion_final=$postm_condicion_final;
	}		
		else $img="<img src='../../img/semaforo_rojo.gif' border=\"0\" width=\"46\" height=\"16\" align=\"absmiddle\" alt='Estado: Irreparable'>"; break;
	default: $img='Sin Reporte';
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
	<td>$tecnico</td>  	
	<td><a href='".$link_modulo_r."?path=trabajos_visitas_ver.php&id_item=".$id_item."' onclick=\"return GB_showCenter('Ver Actividades', this.href,460, 460)\" class='enlaceboton'><img src='../../img/tarea.gif' alt='Programar Actividades' border=\"0\" align=\"absmiddle\">Informe</a></td>	
	<td><center>"; 
	if($fecha!="")
	{
	echo "<b>$dia</b> <span class='title2'>".$fecha."</span> $hora_p";
	}
	else echo"?";	
	echo"</center></td></tr>"; 
		
	}
	
	 $departamento_aux=$departamento;
	 }
	 
	}
?>
</table>		  

<SCRIPT src="../../js/general.js" type=text/javascript></SCRIPT>
<link href="../../paquetes/greybox/gb_styles.css" rel="stylesheet" type="text/css" media="all" />
    <script type="text/javascript">
        var GB_ROOT_DIR = "./../../paquetes/greybox/";
		
function VerifyOne () {
   if( 
    checkField( document.amper.producto, isName, false ) &&
	checkField( document.amper.marca, isName, false ) &&
	checkField( document.amper.caracteristicas, isName, false ) &&
	checkField( document.amper.sn, isName, true ) &&
	checkField( document.amper.ubicacion, isName, false )
	)
	{
	Enviar_datos_st('trabajos_listar'); return false;
	}
else {	
return false;
     }
}
    </script>    
	<script type="text/javascript" src="../../paquetes/greybox/AJS.js"></script>
    <script type="text/javascript" src="../../paquetes/greybox/AJS_fx.js"></script>
    <script type="text/javascript" src="../../paquetes/greybox/gb_scripts_no_reload.js"></script>
