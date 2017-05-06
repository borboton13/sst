<?
session_start(); 
require("../../funciones/motor.php");
require("../funciones/verificar_sesion.php");
$web=$_SESSION["web"];
$gestion=$_SESSION["gestion"];
function periodos($nro){
$dato=mysql_fetch_array(mysql_query("SELECT count(*) as contar FROM st_cronograma_informes a INNER JOIN st_trabajos b ON b.id_st_proyecto='$nro' AND a.id_item=b.id_item GROUP BY a.id_item order by contar DESC LIMIT 1"));
$periodos=$dato[0];

for($k=1;$k<=$periodos;$k++)
{
$desde=$k-1;
$hasta=$k;

	$count_exist=0;
	$count_ok=0;
	$count_postm_ok=0;	
	$count_pendiente=0;
	$count_irreparable=0;
			
	$resultadoa=mysql_query("SELECT id_item FROM st_trabajos WHERE id_st_proyecto='$nro'");
	while($datoa=mysql_fetch_array($resultadoa))
	 {
		$datob=mysql_fetch_array(mysql_query("SELECT id_item,condicion_final,postm_condicion_final FROM st_cronograma_informes WHERE id_item=".$datoa['id_item']." ORDER BY fecha ASC LIMIT $desde,$hasta;")); 
		if($datob['id_item']==$datoa['id_item'])
		{
			$count_exist+=1;
			if($datob['condicion_final']=='OK') $count_ok+=1;
			if($datob['condicion_final']=='Pendiente') $count_pendiente+=1;
			if($datob['condicion_final']=='Irreparable') $count_irreparable+=1;
			if($datob['postm_condicion_final']=='OK+') $count_postm_ok+=1;
		}
	  }
$totalok=$count_ok + $count_postm_ok;  
echo"&nbsp;&nbsp;<a href='../seguimiento_tecnico/trabajos_ver_periodos.php?periodo=$k&nro=".base64_encode($nro)."' class='enlace_s_menu'>Periodo $k:</a></span> OK = $count_ok, [Pendiente=$count_pendiente, Irreparable=$count_irreparable] -> OK+ = $count_postm_ok --> <b>Total OKs: $totalok/$count_exist</b><br>";
}
 
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
<HEAD>
<TITLE>Amper :: Sistema Integrado Administrativo</TITLE>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<SCRIPT src="../../js/general.js" type=text/javascript></SCRIPT>
<script language="JavaScript1.2" src="../../js/mensaje.js" type=text/javascript></SCRIPT>
<link href="../../css/general.css" rel="stylesheet" type="text/css">
<link href="../../css/estadisticas.css" rel="stylesheet" type="text/css">
</HEAD>
<BODY>
<? 
require("../../funciones/encabezado.php");
require("../funciones/menu.php");
menu_principal(1);
include("../../funciones/mensaje.php");
?>
<table width="100%" border="0" cellpadding="0" cellspacing="5">
<tr>
<td valign="top"  width="845">
<table width="100%" border="0">
  <tr>
    <td valign="top"><fieldset>
	<legend class="title4">Cuentas por Pagar Pendientes:</legend>
	<?
	$dato=mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM c_pagar_internas WHERE pagado = '0' AND pago = '0'"));	
	$pendiente1=$dato[0];
	$dato=mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM c_pagar_internas WHERE pagado = '0' AND pago = '1'"));	
	$pendiente2=$dato[0];	
	$dato=mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM ext_c_pagar WHERE	pagado = '0' AND pago = '0'"));	
	$pendiente3=$dato[0];	
	$dato=mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM ext_c_pagar WHERE	pagado = '0' AND pago = '1';"));	
	$pendiente4=$dato[0];	
	$dato=mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM solicitud_compra_int WHERE autorizado_por = '0' AND confirmar!='0' AND validacion='0'"));
	$pendiente5=$dato[0];
	$dato=mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM orden_compra WHERE autorizado_por='0'"));
	$pendiente6=$dato[0];		
	?>
	<a href="../cuentas_por_pagar/cxp_pendiente.php" class="enlaceboton" title="CxP al CREDITO">
	<img src="../../img/cxp_pendiente.gif" border="0" align="absbottom" > Tiene <b>(<?=$pendiente1?>)</b> Items en Cuentas Por Pagar a CREDITO.</a><br>
	<a href="../cuentas_por_pagar/cxp_pendiente_efectivo.php" class="enlaceboton" title="CxP en EFECTIVO">
	<img src="../../img/cxp_pendiente_efectivo.gif" border="0" align="absbottom" > Hay <b>(<?=$pendiente2?>)</b> Items en Cuentas Por Pagar en EFECTIVO.</a><br>	
	<a href="../cuentas_por_pagar_exterior/cxp_pendiente_credito.php" class="enlaceboton" title="CxP Exterior al CREDITO">
	<img src="../../img/cxp_pendiente.gif" border="0" align="absbottom" > Hay <b>(<?=$pendiente3?>)</b> Items en Cuentas Por Pagar al EXTERIOR a CREDITO.</a><br>	
	<a href="../cuentas_por_pagar_exterior/cxp_pendiente_efectivo.php" class="enlaceboton" title="CxP Exterior en EFECTIVO">
	<img src="../../img/cxp_pendiente_efectivo.gif" border="0" align="absbottom" > Hay <b>(<?=$pendiente4?>)</b> Items en Cuentas Por Pagar al EXTERIOR en EFECTIVO.</a>
	</fieldset>
	
	<fieldset>
	<legend class="title4">Autorizaciones Pendientes:</legend>			
	<a href="../solicitudes/ver_solicitudes.php" class="enlaceboton" title="Solicitudes de Compra">
	<img src="../../img/billete_ico.gif" border="0" align="absbottom"> Tiene <b>(<?=$pendiente5?>)</b> SOLICITUDES DE COMPRA Interno para autorización</a><br>
	<a href="../ordenesdecompra/ver_ocn.php" class="enlaceboton" title="Ordenes de Compra">
	<img src="../../img/billete_ico.gif" border="0" align="absbottom" > Tiene <b>(<?=$pendiente6?>)</b> ORDENES DE COMPRA para autorización	</a><br>
	</fieldset></td>
    <td><img src="../../estadisticas/panel_control/pendientes.php?var1=<?=$pendiente1?>&var2=<?=$pendiente2?>&var3=<?=$pendiente3?>&var4=<?=$pendiente4?>&var5=<?=$pendiente5?>&var6=<?=$pendiente6?>" alt="Tareas amper" width="420" height="200"></td>
  </tr>
</table>
<table width="100%" border="0">
<?
	$dato=mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM tareas_laboratorio WHERE estado_actual='0'"));	
	$pendiente1=$dato[0];
	$dato=mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM crm_propuesta WHERE estado='En espera'"));	
	$pendiente2=$dato[0];
	$dato=mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM crm_orden_venta WHERE estado='P'"));	
	$pendiente3=$dato[0];
?>
  <tr>
    <td><img src="../../estadisticas/panel_control/pendientes2.php?var1=<?=$pendiente1?>&var2=<?=$pendiente2?>&var3=<?=$pendiente3?>" alt="Tareas amper" width="380" height="200"></td>
    <td><fieldset>
    <legend class="title4">Pendientes Secundarios:</legend>
    <a href="../tareas_tecnicas/ver_tareas_pendientes.php" class="enlaceboton" title="Tareas Laboratorio"> <img src="../../img/tarea.gif" border="0" align="absbottom" > Hay <b>(
    <?=$pendiente1?>
    )</b> TAREAS TECNICAS pendientes y/o en curso. </a><br>
    <a href="../propuestas/ver_todos.php" class="enlaceboton" title="Propuestas"> <img src="../../img/ico_detalles.gif" border="0" align="absbottom" > Hay <b>(
    <?=$pendiente2?>
    )</b> PROPUESTAS en Espera de actualizacion de estado. </a><br>
    <a href="../ordenes_de_venta/ver_todas_ordenes_venta.php" class="enlaceboton" title="ordenes de venta"> <img src="../../img/ico_detalles.gif" border="0" align="absbottom" > Hay <b>(
    <?=$pendiente3?>
    )</b> ORDENES DE VENTA pendientes de actualización de estado. </a>
    </fieldset>
      <?
	$dato=mysql_fetch_array(mysql_query("SELECT COUNT(*)-1 FROM proyectos WHERE vigencia=0"));	
	$inf1=$dato[0];
	$dato=mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM proyectos WHERE vigencia=1"));	
	$inf2=$dato[0];
	$dato=mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM proyectos WHERE vigencia=0 AND id_user='$id_user'"));	
	$inf3=$dato[0];
	$dato=mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM proyectos WHERE vigencia=1 AND id_user='$id_user'"));	
	$inf4=$dato[0];
	?>
      <fieldset>
      <legend class="title4">Proyectos:</legend>
      <a href="../proyectos/ver_proyectos.php" class="enlaceboton" title="Tareas Laboratorio"> <img src="../../img/ico_proyecto_abierto.gif" border="0" align="absbottom" > Hay <b>(
      <?=$inf1?>
      )</b> PROYECTOS abiertos, de los cuales <b>(
      <?=$inf3?>
      )</b> estan PENDIENTES para ser cerrados por Usted</a><br>
      <a href="../proyectos/ver_proyectos_terminados.php" class="enlaceboton" title="Tareas Laboratorio"> <img src="../../img/ico_libro_cerrado.gif" border="0" align="absbottom" > Hay <b>(
      <?=$inf2?>
      )</b> PROYECTOS terminados, de los cuales <b>(
      <?=$inf4?>
      )</b> han sido TERMINADOS por Usted </a>
      </fieldset>
      <fieldset>
      <legend class="title4">Pendientes Propios:</legend>
      <?
	$dato=mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM solicitud_compra_int WHERE confirmar='0' AND solicitado_por='$id_user'"));
	$pendientes_autorizacion=$dato[0];	
	?>
      <a href="../pedidos/ver_pedidos.php" class="enlaceboton"> <img src="../../img/missolicitudes.gif" alt="MIS SOICITUDES" border="0" align="absbottom" > Tiene <b>(
      <?=$pendientes_autorizacion?>
      )</b> Solicitud de Compra Interno Suyas Pendientes de Validación y/o Autorización </a>
      </fieldset></td>
  </tr>
</table>
<fieldset>
	<legend class="title4">Proyectos Seguimiento Técnico:</legend>	
	<? 
	$resultado=mysql_query("SELECT id_st_proyecto FROM st_proyecto");
	while($proyecto=mysql_fetch_array($resultado))
	{		
	$nro=$proyecto['id_st_proyecto'];
	
	$dato=mysql_fetch_array(mysql_query("SELECT c.razon_social FROM st_proyecto s INNER JOIN clientes c ON s.id_cliente=c.id WHERE s.id_st_proyecto='$nro'"));	
	$cliente=$dato[0];
	$dato=mysql_fetch_array(mysql_query("SELECT count(*) FROM st_trabajos WHERE id_st_proyecto='$nro'"));	
	$trabajos=$dato[0];
	?>
	<a href="../seguimiento_tecnico/trabajos_ver.php?nro=<?=base64_encode($nro)?>" class='enlace_s_menu'><img src="../../img/informe_detalles.gif" border="0" align="absbottom" ><?=$nro?></a> <span class="title7"><strong><?=$cliente?> </strong></span> <span class="verde">(<?=$trabajos?> Items)</span><br>
	<?=periodos($nro);?>
	<?
	}
	?> 	
	</fieldset>	
<table width="100%" class="estadistica_table">
<caption>RESUMEN DE TAREAS PROXIMAS EN SEGUIMIENTO TECNICO (Próximos 15 días)</caption>
<tr bgcolor="#485765">
<th width="2%">N&deg;</th>
<th width="4%">DIA</th>
<th  width="7%">FECHA</th>			              
<th  width="17%">ESTADO</th> 
<th  width="48%">CLIENTE, PRODUCTO Y LUGAR</th>
</tr>
	<? 
	$fecha=date("Y-m-d");
	$consulta="SELECT dia,date_format(fecha,'%d/%m/%y') as fecha,condicion_final,razon_social,ubicacion,date_format(hora_programada,'%H:%i') as hora,departamento FROM v_st_cronograma WHERE fecha BETWEEN '$fecha' AND ADDDATE('$fecha',15) limit 20";
	$resultado=mysql_query($consulta);
	$filas=mysql_num_rows($resultado);
	if($filas!=0)
	{ $i=0;
	while($dato=mysql_fetch_array($resultado))
	 {
	 $dia=$dato['dia']; 
	 $fecha=$dato['fecha']; 
	 $condicion_final=$dato['condicion_final']; 
	 $razon_social=$dato['razon_social']; 	 
	 $ubicacion=$dato['ubicacion'];	 
	 $hora_p=$dato['hora']; 
	 $departamento=$dato['departamento']; 
	 $i++;
	 
	switch($condicion_final){
	case 'OK' : $img="<img src='../../img/semaforo_verde.gif' border=\"0\" width=\"46\" height=\"16\" align=\"absmiddle\">"; break;
	case 'Pendiente' : $img="<img src='../../img/semaforo_amarillo.gif' border=\"0\" width=\"46\" height=\"16\" align=\"absmiddle\">"; break;
	case 'Irreparable' : $img="<img src='../../img/semaforo_rojo.gif' border=\"0\" width=\"46\" height=\"16\" align=\"absmiddle\">"; break;
default: $img="Inicial <img src='../../img/ico_reloj.gif' alt='Esperando próxima fecha' border=\"0\">";
	}
	if($i%2==0) $rowt="class='odd'";
	 else $rowt="";
	 
	echo"
	<tr $rowt >
	<td>".$i."</td>
	<td><center><span class='title'>".$dia."</span></center></td>
	<td><center>".$fecha."<BR>".$hora_p."</center></td>
	<td><center><span class='title6'>".$condicion_final."</span> ".$img."</center></td>
	<td>
	<b>Cliente:</b> <span class='title7'>".$razon_social."</span><br>
	<span class='title5'><b>Departamento:</b></span> <span class='verde'><b>".$departamento."</b></span><br>
	<span class='title5'><b>Ubicacion:</b> ".$ubicacion."</span>
	</td>	
	</tr>
	";

	 }
	}
	?>
<tfoot>
        <tr>
          <td colspan="5"><a href='../seguimiento_tecnico/cronograma_ver.php' class='enlaceboton' title='SEGUIMIENTO TECNICO'><img src="../../img/ico_detalles.gif" alt="Manual" width="16" height="19" border="0" align="absbottom">Ver cronograma completo...</a></td>
        </tr>
    </tfoot>	
</table>
</td>
<td valign="top" bgcolor="#E8FAFF"><div align="center"><span class="title">NOTICIAS</span><BR>
<?
$dato=mysql_fetch_array(mysql_query("SELECT COUNT(estado) AS nro_contactos FROM contactos WHERE estado!='C' AND id_user='$id_user'"));
$nro_contactos=$dato['nro_contactos'];
//$nro_contactos=21;
$vales=floor($nro_contactos/10);	

echo"Tienes <span class='cafe'><b>".$nro_contactos."</b></span> Contactos Actuales, el Cual te hace acreedor de: <span class='verde'><b>".$vales." Bono(s) </b></span>";
if($vales!=0){

?>
<table width="167">
<tr>
<td width="167" height="62" background="../../img/vale.gif">
<div align="right" style="font-size:32px; padding-right:25px; padding-bottom:9px; color:#006600"><B><?=$vales?></B></div>
</td>
</tr>
</table><? }?>

</div>
<BR>
  <fieldset>
        <legend><span class="verde"><b>Proyectos Creados:</b></span></legend>

	<?
	$consulta="SELECT a.id,a.cod_proyecto,b.razon_social,a.proyecto,IF(DATEDIFF(NOW(),a.fecha_creacion) < 3 ,'<img src=\"../../img/newr.gif\">',CONCAT('hace ',DATEDIFF(NOW(),a.fecha_creacion),' dias')) AS estado
FROM proyectos a INNER JOIN clientes b ON a.cliente=b.id
WHERE a.fecha_creacion BETWEEN SUBDATE(NOW(), INTERVAL 7 DAY) AND NOW()
ORDER BY a.fecha_creacion DESC";
	$resultado=mysql_query($consulta);
	$filas=mysql_num_rows($resultado);
if($filas!=0)
{
	while($dato=mysql_fetch_array($resultado))
	{	
	echo '- <a class="enlaceboton" href="../modulos/proyectos.php?path=ver_informe_proyecto.php&nro='.base64_encode($dato['id']).'">'.$dato['cod_proyecto'].'</a> '.$dato['razon_social'].' <span class="title7">'.$dato['estado'].'</span><BR>&nbsp;&nbsp;<span class="title5"><b>'.$dato['proyecto'].'</b></span><BR>';

	}
}
else { echo" No hay proyectos adicionados recientemente";}	
	?>
</fieldset>
<fieldset>
<legend><span class="verde"><b>Items en Inventario Adicionados o Modificados:</b></span></legend>
	<?
	$consulta="SELECT id_item,producto,marca,almacen,IF(DATEDIFF(NOW(),ultima_modificacion) < 3 ,'<img src=\"../../img/newr.gif\">',CONCAT('hace ',DATEDIFF(NOW(),ultima_modificacion),' dias')) AS estado
FROM inventario
WHERE ultima_modificacion BETWEEN SUBDATE(NOW(), INTERVAL 7 DAY) AND NOW()
ORDER BY ultima_modificacion DESC";
	$resultado=mysql_query($consulta);
	$filas=mysql_num_rows($resultado);
if($filas!=0)
{
	while($dato=mysql_fetch_array($resultado))
	{	
	?>
	- <a href="../modulos/inventario_r.php?path=almacen.php&alm=<?=$dato['almacen']?>&sw=pc&nro_=<?=base64_encode($dato['id_item']);?>" title='<?=$dato['id_item'];?>' class="enlaceboton"><?=$dato['producto'];?></a> <?=$dato['marca'];?> <span class="title4"><?=$dato['almacen'];?></span> <span class="title7"><?=$dato['estado'];?></span><BR>
	<?
	}
}
else { echo" No hay Items adicionados recientemente en Inventario";}	
	?>
</fieldset>
<fieldset>
<legend><span class="verde"><b>Ultimas Ordenes de Venta:</b></span></legend>
	<?
	$consulta="SELECT id_orden_venta,razon_social,monto,moneda,IF(DATEDIFF(NOW(),fecha_registro) < 3 ,'<img src=\"../../img/newr.gif\">',CONCAT('hace ',DATEDIFF(NOW(),fecha_registro),' dias')) AS estado
FROM v_orden_venta
WHERE fecha_registro BETWEEN SUBDATE(NOW(), INTERVAL 7 DAY) AND NOW()
ORDER BY fecha_registro DESC";
	$resultado=mysql_query($consulta);
	$filas=mysql_num_rows($resultado);
if($filas!=0)
{
	while($dato=mysql_fetch_array($resultado))
	{	
	?>
	- <a href="../ordenes_de_venta/orden_venta_detalles.php?nro_=<?=base64_encode($dato['id_orden_venta'])?>" title="Ver detalles" class="enlace_s_menu"><?=$dato['id_orden_venta'];?></a> <?=$dato['razon_social'];?> <span class="verde"><?=$dato['moneda'];?></span> <strong> <?=number_format($dato['monto'], 2, '.', ',');?></strong> <span class="title7"><?=$dato['estado'];?></span><BR>
	<?
	}
}
else { echo" No hay Ordenes de Venta adicionados recientemente";}	
	?>
</fieldset>
<fieldset>
<legend><span class="verde"><b>Ultimos Asientos Contables:</b> (max. 10 en vista)</span></legend>
	<?
	$consulta="SELECT id_asiento,tipo_registro,DATE_FORMAT(fecha,'%d/%m/%y') AS fecha,glosa,IF(DATEDIFF(NOW(),fecha_registro) < 3 ,'<img src=\"../../img/newr.gif\">',CONCAT('hace ',DATEDIFF(NOW(),fecha_registro),' dias')) AS estado
FROM conta".$gestion."_asientos
WHERE fecha_registro BETWEEN SUBDATE(NOW(), INTERVAL 7 DAY) AND NOW()
ORDER BY fecha_registro DESC LIMIT 10";
	$resultado=mysql_query($consulta);
	$filas=mysql_num_rows($resultado);
if($filas!=0)
{
	while($dato=mysql_fetch_array($resultado))
	{	
	?>
	- <a href="../modulos/contabilidad.php?path=asientos_libro_ver.php&nro=<?=base64_encode($dato['id_asiento'])?>" class="enlace_s_menu"><b><?=substr($dato['id_asiento'],0,3)?></b><?=substr($dato['id_asiento'],3)?></a> <?=$dato['fecha'];?> <b><?=$dato['tipo_registro'];?></b>  <?=substr($dato['glosa'],0,50)?>... <span class="title7"><?=$dato['estado'];?></span><BR>
	<?
	}
}
else { echo" No hay Asientos Contables registrados ultimamente";}	
	?>
</fieldset>
  <fieldset>
        <legend><span class="verde"><b>Clientes Adicionados o Modificados Recientemente:</b></span></legend>

	<?
	$consulta="SELECT a.id,a.razon_social,CONCAT(b.nombre,' ',b.ap_pat) AS creador, IF(DATEDIFF(NOW(),a.ult_fecha_mod) < 3 ,'<img src=\"../../img/newr.gif\">',CONCAT('hace ',DATEDIFF(NOW(),a.ult_fecha_mod),' dias')) AS estado 
FROM clientes a INNER JOIN usuarios b ON a.creador=b.id
WHERE a.ult_fecha_mod BETWEEN SUBDATE(NOW(), INTERVAL 7 DAY) AND NOW()
ORDER BY a.ult_fecha_mod DESC";
	$resultado=mysql_query($consulta);
	$filas=mysql_num_rows($resultado);
if($filas!=0)
{
	while($dato=mysql_fetch_array($resultado))
	{	
	echo '- <a class="enlaceboton" href="../modulos/clientes.php?path=cliente_detalles.php&nro='.base64_encode($dato['id']).'">'.$dato['razon_social'].'</a> <span class="title5">'.$dato['creador'].'</span> <span class="title7">'.$dato['estado'].'</span><BR>';

	}
}
else { echo" No hay Clientes adicionados recientemente";}	
	?>
</fieldset>
</td>
  </tr>	
</table>
<table width="100%" border="0" cellpadding="0" cellspacing="5">
<tr>
  <td colspan="2" valign="top">	
	</td>
	<td width="36%" rowspan="2" valign="top">	
<?
$dato=mysql_fetch_array(mysql_query("SELECT tc FROM tc WHERE moneda='dolar'"));
$tc=$dato[0];	 

$dato=mysql_fetch_array(mysql_query("SELECT YEAR(mes_anterior) AS anio, MONTH(mes_anterior) AS mes FROM (SELECT DATE_SUB(NOW(),INTERVAL 1 MONTH) as mes_anterior) AS t1;"));
	$ant_anio=$dato['anio'];	 
	$ant_mes=$dato['mes'];
	
$consulta="SELECT vendedor,SUM(usd) AS monto,COUNT(vendedor) AS nro_ov FROM (
SELECT concat(v.nombre, ' ', v.ap_pat) AS vendedor,CASE a.moneda WHEN 'Bs.' THEN (a.monto/".$tc.") WHEN 'Sus.' THEN a.monto ELSE 'error' END AS usd
FROM v_orden_venta a JOIN usuarios v ON a.id_usuario=v.id WHERE a.estado<>'X' AND YEAR(a.fecha_registro)=".$ant_anio." AND MONTH(a.fecha_registro)=".$ant_mes.") AS t1 
GROUP BY vendedor ORDER BY vendedor;";

$resultado=mysql_query($consulta);
$filas=mysql_num_rows($resultado);
if($filas!=0)
{ $i=1;
?>  
  <table width="100%" class="estadistica_table">
  	<caption>
    RESUMEN DE VENTAS DEL ANTERIOR MES (<? 			
			switch($ant_mes)
			  {
			  case 1: echo"ENERO";break;
			  case 2: echo"FEBRERO";break;
			  case 3: echo"MARZO";break;
			  case 4: echo"ABRIL";break;
			  case 5: echo"MAYO";break;
			  case 6: echo"JUNIO";break;
			  case 7: echo"JULIO";break;
			  case 8: echo"AGOSTO";break;
			  case 9: echo"SEPTIEMBRE";break;
			  case 10: echo"OCTUBRE";break;
			  case 11: echo"NOVIEMBRE";break;
			  case 12: echo"DICIEMBRE";break;		  	  
			  }	echo" ".$ant_anio; ?>)
    </caption>	  
  <thead>
    <tr>
      <th width="6%">N&deg;</th>
      <th width="50%">VENDEDOR</th>
      <th width="34%">MONTO</th>
      <th width="10%"># OV </th>
    </tr>
  </thead>		
    <?
while($dato=mysql_fetch_array($resultado))
 { $total+=$dato['monto'];
?><tr <? if($i%2==0) echo "class='odd'"; ?>>
			<td><DIV ALIGN="RIGHT"><?=$i?></DIV></td>
			<td><strong><?=$dato['vendedor']?></strong></td>			          
			<td><DIV ALIGN="RIGHT">USD. <b><?=number_format($dato['monto'], 2, '.', ',')?></b></DIV></td>
			<td><DIV ALIGN="RIGHT"><?=$dato['nro_ov']?></DIV></td>
			</tr>
<?
	 $i++;		 
 }
 ?>
<tfoot>
        <tr>
          <td colspan="2"><a href="../ordenes_de_venta/ver_todas_ov_resumen.php?var_estado=1" title="ordenes de venta">	<img src="../../img/scales.gif" border="0" align="absbottom" >Ver mas Detalles...
	</a>	</td>
		  <td colspan="2">Total: USD <b><?=number_format($total, 2, '.', ',')?></b></td>
        </tr>
    </tfoot>	
</table>
<?
}
?>	
<table width="100%" class="estadistica_table">
  	<caption>
    Ultimos 10 registros de kardex en Inventario:
    </caption>
<thead>
  <tr>
    <th scope="col">PRODUCTO</th>
	<th scope="col">ALM</th>
    <th scope="col">FECHA</th>
    <th scope="col">INGRESO</th>
    <th scope="col">EGRESO</th>
  </tr>
</thead>  
	<?
	$consulta="SELECT b.producto,DATE_FORMAT(a.fecha,'%d/%m/%y') AS fecha ,a.ingreso,a.egreso,a.id_item,b.almacen FROM inventario_detalles a JOIN inventario b ON a.id_item=b.id_item ORDER BY a.id_inventario_detalles DESC LIMIT 10";
	$resultado=mysql_query($consulta);
	$i=1;
	while($dato=mysql_fetch_array($resultado))
	{
	$ingreso=$dato['ingreso']; if($ingreso==floor($ingreso)) $ingreso=floor($ingreso);
	$egreso=$dato['egreso']; if($egreso==floor($egreso)) $egreso=floor($egreso);
	if($ingreso==0) $ingreso="&nbsp;";
	if($egreso==0) $egreso="&nbsp;";	
	?>
  <tr <? if($i%2==0) echo "class='odd'"; ?>>
    <td><a href='../modulos/inventario_r.php?path=almacen.php&alm=<?=$dato['almacen']?>&sw=pc&nro_=<?=base64_encode($dato['id_item']);?>' title='<?=$dato['id_item'];?>'><?=$dato['producto'];?></a></td>
    <td><div align="center"><?=$dato['almacen'];?></div></td>
	<td><div align="center"><?=$dato['fecha'];?></div></td>
    <td><div align="right"><?=$ingreso;?></div></td>
    <td><div align="right"><?=$egreso;?></div></td>
  </tr>
	<?	
	$i++;  
	}
	?>
<tfoot>
        <tr>
          <td colspan="5"><a href='../modulos/inventario.php?path=historial_kardex.php' class='enlaceboton' title='VER HISTORIAL DE KARDEX'><img src="../../img/ico_detalles.gif" alt="Manual" width="16" height="19" border="0" align="absbottom">Ver todo el Historial...</a></td>
        </tr>
    </tfoot>
</table>

</td>
</tr>
<tr>
<td width="32%" valign="top">
	
<?
	$dato=mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM proveedor"));	
	$inf1=$dato[0];
	$dato=mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM proveedor WHERE creador='$id_user'"));	
	$inf1_=$dato[0];
	$dato=mysql_fetch_array(mysql_query("SELECT COUNT(*)-1 FROM clientes"));	
	$inf2=$dato[0];
	$dato=mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM clientes WHERE creador='$id_user'"));	
	$inf2_=$dato[0];
?>	
	<fieldset>
	<legend class="title4">Clientes/Proveedores:</legend>
	<a href="../clientes/ver_clientes.php" class="enlaceboton" title="Propuestas">
	<img src="../../img/group.gif" border="0" align="absbottom" > Existen <?=$inf2?> CLIENTES registrados en el sistema, de los cuales <b><?=$inf2_?></b> han sido registrados por Usted </a><BR>
	<a href="../proveedores/ver_proveedores.php" class="enlaceboton" title="Tareas Laboratorio">
	<img src="../../img/group.gif" border="0" align="absbottom" > Existen <?=$inf1?> PROVEEDORES registrados en el sistema, de los cuales <b><?=$inf1_?></b> han sido registrados por Usted</a>
	</fieldset>		<fieldset>
	<legend class="title4">Parametros:</legend>
	<a href="../administrar/m_parametro_aut_sci.php" class="enlaceboton" onClick="openNewWindow( this, '300', '150' );return false;"><img src="../../img/dinero.gif" alt="CUANTIA" align="absbottom" border="0">Autorizaci&oacute;n de Solicitudes de Compra Interno</a>
	</fieldset>		
	<fieldset>
	<legend class="title4">Mensajes:</legend>
	<a href="../../mensajes/mensajero.php" onClick="openNewWindow( this, '602', '402' );return false;" class="enlaceboton"><img src="../../img/email.gif" alt="MENSAJES" align="absbottom" border="0">
	<? 
	$nickUsuarioL=$_SESSION["santox"];
	$i = 1; 
	$nuevos = 0; 
	$query = mysql_query ("SELECT * FROM mensajes order by fecha DESC"); 
	while ( $row = mysql_fetch_array($query) ) { 
	if ( $row['para'] == $nickUsuarioL ) {
	if ( $row[leido] < 1 ) { 
	$nuevos = $nuevos +1; 
	} 
	if ( $row[leido] < 1 ) { 
	$mensajesnuevos .= "</B>"; 
	} 
	$tiene = "Si"; 
	$i = $i+1; 
	} 
	} 
	if ( $nuevos == 0 ) { 
	$nuevos = "Ninguno"; 
	} 
	if ( $tiene != "Si" ) { 
	echo "<font size=1 face=Tahoma>No tienes mensajes, $nickUsuarioL";//$NICK significa el valor de la sesion del usuario o la cookie.. 
	} 
	else { 
	$j = $i -1; 
	echo "Tienes <b>$j</b> mensajes. <B>($nuevos) son nuevos.</b> "; 
	if($nuevos!="Ninguno") echo "<img src=\"../../img/new.gif\" alt=\"Mensaje Nuevo\" align=\"absbottom\" border=\"0\"/>";
	} 
	?> 
	</a>
	</fieldset>	
<fieldset>
	<legend class="title4">Otros:</legend>
	<a href="../../../users/ver_usuarios_web.php?llave_de_acceso=asdfghjkl" class="enlaceboton" onClick="openNewWindow( this, '800', '600' );return false;"><img src="../../img/users.gif" alt="otros" width="16" height="16" border="0"> Administrar Usuarios Registrados en Data Center </a><a href="../../control/cambiar_contrasena.php" class="enlaceboton" onClick="openNewWindow( this, '300', '150' );return false;"></a><br>
		<a href="<?=$web?>/manuales/repositorio_amper.htm" class="enlaceboton" onClick="openNewWindow( this, '800', '600' );return false;"><img src="../../img/help.gif" alt="Manual" width="17" height="17" border="0" align="absbottom"> Guia para acceder a repositorio de Archivos Internos AMPER</a><BR>
		<a href="<?=$web?>/manuales/correo_ampersystem.html" class="enlaceboton" onClick="openNewWindow( this, '800', '600' );return false;"><img src="../../img/help.gif" alt="Manual" width="17" height="17" border="0" align="absbottom"> Guia para acceder a correo electrónico AMPERSYSTEM</a><BR>
	<a href="../../ayuda/MANUAL_DE_USUARIO_SIA.pdf" class="enlaceboton" onClick="openNewWindow( this, '800', '600' );return false;"><img src="../../img/help.gif" alt="Manual" width="17" height="17" border="0" align="absbottom"> Manual 1: Ingreso al Sistema y Pedidos Internos</a>
	</fieldset>
	</td>
<td width="32%" valign="top">	
<table width="100%" class="estadistica_table">
  	<caption>
    Ultimos 10 registros del personal Amper en el sistema:
    </caption>
<thead>
  <tr>
    <th scope="col">FECHA</th>
    <th scope="col">INGRESO</th>
    <th scope="col">IP</th>
  </tr>
</thead>  
	<?
	$consulta="SELECT CONCAT(U.nombre,'',U.ap_pat) AS nombre,date_format(R.fecha, '%d/%m/%y %H:%i:%s') AS fecha,R.ip FROM usuarios_registros R, usuarios U 
WHERE R.id_usuario = U.id ORDER BY R.fecha DESC LIMIT 10";
	$resultado=mysql_query($consulta);
	$i=1;
	while($dato=mysql_fetch_array($resultado))
	{	
	?>
  <tr <? if($i%2==0) echo "class='odd'"; ?>>
    <td><div align="right"><?=$dato['fecha'];?></div></td>
    <td><div align="right"><?=$dato['nombre'];?></div></td>
	<td><div align="right"><?=$dato['ip'];?></div></td>
  </tr>
	<?	
	$i++;  
	}
	?>
<tfoot>
        <tr>
          <td colspan="3"><a class="enlaceboton" href="../administrar/ver_historial_registros.php" onClick="openNewWindow( this, '640', '450' );return false;"><img src="../../img/informe_detalles.gif" alt="Ver Informe de Registros" border="0"> Ver Todo el historial y mas detalles</a></td>
        </tr>
    </tfoot>
</table>
<fieldset>
	<legend class="title4">Mi cuenta:</legend>
	<a href="../../control/cambiar_contrasena.php" class="enlaceboton" onClick="openNewWindow( this, '300', '150' );return false;"> <img src="../../img/key.gif" alt="CAMBIAR CONTRASENA" border="0" align="absbottom"> Cambiar mi Contrase&ntilde;a</a><br>
	<a href="../../control/actualizar_datos.php" class="enlaceboton" onClick="openNewWindow( this, '420', '425' );return false;"> <img src="../../img/user.gif" alt="CAMBIAR CONTRASENA" border="0" align="absbottom"> Actualizar mis Datos </a><BR>
	<a href="../modulos/usuarios.php?path=ver_usuarios.php" class="enlaceboton"> <img src="../../img/users.gif" width="16" height="16" alt="VER TODOS LOS CONTACTOS" border="0" align="absbottom"> Ver Contactos Internos AMPER</a>
	</fieldset>
<fieldset>
<legend class="title2">Ingresar como otro usuario:</legend>
<FORM action="entrar_como.php" method="post">
  <select name='id_usuario' class='selectbuscar' id="id_usuario">
<option value='0' value="#" >[Entrar como...]</option>
<?
$consulta="SELECT concat(nombre, ' ', ap_pat) as usuario,id FROM usuarios ORDER BY nombre ASC;";
$resultado=mysql_query($consulta);
$filas=mysql_num_rows($resultado);
if($filas!=0)
{ 
while($dato=mysql_fetch_array($resultado))
 {$nombre=$dato['usuario'];
  $id=$dato['id'];
  echo "<option value='$id'>$nombre</option>";
 }
}	            	  
		  ?>
        </select>
<input type="submit" class="BotonForm" value="Entrar">		
</FORM>
</fieldset>					
	</td>
</tr>
</table>
<? require("../../funciones/pie.php"); ?>
</BODY></HTML>
