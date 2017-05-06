<?
require("../funciones/motor.php");
$id_st_cronograma_informes = base64_decode($_GET["id_st_cronograma_informes"]);
//$web="http://127.0.0.1/st";
$web="http://sistema.dimesat.com.bo";
$archivos = $_GET["archivos"];
$pro_key="f002";
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML><HEAD>
<TITLE>Amper :: Sistema Integrado Administrativo</TITLE>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<style type="text/css">
<!--
BODY {
	PADDING-RIGHT: 0px; PADDING-LEFT: 0px; FONT-SIZE: 11px; BACKGROUND: #FFFFFF; PADDING-BOTTOM: 0px; MARGIN: 0px; COLOR: #666666; PADDING-TOP: 10px; FONT-FAMILY: Verdana, sans-serif
}
TABLE {
	FONT: 11px Verdana, sans-serif
}
.title2 {
	FONT-WEIGHT: 700; FONT-SIZE: 12px; COLOR: #cc0000; LINE-HEIGHT: 14px
}
.Estilo2 {
	font-size: 18px;
	color: #333333;
	font-style: italic;
	font-weight: bold;
}
.Estilo3 {color: #FFFFFF}
.Estilo4 {
	color: #F0F0F0;
	font-size: 11px;
	font-weight: bold;
}

.box_msj{
font-size: 16px;
color:#000000;
border:#000000 2px solid;
padding:5px;
width:400px;
}
.title7 {
	 COLOR: #ff6600;
}

-->
/* TABLA 2 */
.table2{
	border: #CCD1D6 1px solid;
	padding: 0; width:680px;
	ho
}
.table2 caption {
	font-weight: bold;
	background: #006699 url(../img/corner.gif) no-repeat right top;
	border-bottom:3px solid #2883E6;
	color: #FFFFFF;
	padding-bottom: 1px;
}
.table2 th{
	background-color: #DEDEDE;
	text-align: left;
	padding-left: 4px;
	height:20px;
}
.table2 td{
	background-color: #F1F1F1;
	height:20px;
}
.table2 td.cuadro{
	border: #333333 1px solid;
	width:17px;
}

.table2 td.text_area{
padding-top:5px; padding-bottom:10px;
}

.table2 td.resaltar{
	font-style: italic;
	font-weight:bold;
	color: #006699;
}
.table2 td.marco{
	background-color: #FFEEBB;
	color: #666666;
	font-size: 12px;
	BORDER-RIGHT: #FF9900 1px solid;
	BORDER-TOP: #FF9900 1px solid;
	BORDER-LEFT: #FF9900 1px solid;
	BORDER-BOTTOM: #FF9900 1px solid;
	cursor: hand;
}
.table2 tfoot th, .table2 tfoot td {
	background-color:#E7E7E7;
    font-style:italic;
    border-bottom:3px solid #006699;
}
</style>
</HEAD>
<BODY>
<table width="760" border="1" align="center" cellpadding="0" cellspacing="0">
<?

$resultado=mysql_query("SELECT
id_st_proyecto,
id_item,
id_cliente,
id_usuario,
detalles,
periodo,
DATE_FORMAT(fecha,'%d/%m/%Y') AS fecha,
hora_programada AS h_prog,
hora_llegada,
hora_salida,
conta,
p1,
p2,
p3,
p4,
p6,
p7,
p8,
p9,
obs,
conclusiones,
fecha_registro,
condicion_final,
postm_fecha,
postm_descripcion,
postm_condicion_final
FROM st_cronograma_informes_".$pro_key." 
WHERE id_st_cronograma_informes_".$pro_key."='".$id_st_cronograma_informes."'");
$dato=mysql_fetch_array($resultado);

$datox=mysql_fetch_array(mysql_query("SELECT razon_social FROM clientes WHERE id='".$dato['id_cliente']."'"));
$cliente=$datox['razon_social'];
$datox=mysql_fetch_array(mysql_query("SELECT concat(nombre, ' ', ap_pat) as usuario FROM usuarios WHERE id='".$dato['id_usuario']."'"));
$tecnico=$datox['usuario'];
$datox=mysql_fetch_array(mysql_query("SELECT MAX(periodo) AS de FROM st_cronograma_informes_".$pro_key." WHERE id_item='".$dato['id_item']."'"));
$de=$datox['de'];

$dato_t=mysql_fetch_array(mysql_query("SELECT departamento,producto,marca,caracteristicas,ubicacion,sn FROM st_trabajos WHERE id_item='".$dato['id_item']."'"));

$carpeta_id=$pro_key."_".$id_st_cronograma_informes;
 
$carpeta="archivos_st/".$dato['id_st_proyecto']."/".$carpeta_id;
$dir = "../".$carpeta."/";
$dir_ext=$web."/".$carpeta."/";

$fecha=date("d/m/Y");

?>
                <tr>
                  <td width="248" rowspan="2" class="Estilo2"><img src="<?=$web?>/img/logo.jpg" width="248" height="106"></td>
                  <td height="30" colspan="2" bgcolor="#153979" ><div align="center" class="Estilo4">GERENCIA DEPARTAMENTO TECNICO  </div></td>
                </tr>
               <tr>
<td  width="319" height="35" align="right"><div align="center"><span class="Estilo2">&nbsp;INFORME EMERGENCIAS </span></div></td>
<td  width="185" align="center"><img src="<?=$dir_ext?>barcode.png" ><br> 
  INF: <b><?=strtoupper($pro_key).str_pad($id_st_cronograma_informes, 4, "0", STR_PAD_LEFT);?></b></td>
  </tr>
</table><br>
<table align="center" class="table2" style="width:760px">
<tr>
<td width="65%" height="25">Proyecto Nro:  <strong><?=$dato['id_st_proyecto'];?></strong></td>
<td  width="35%" align="right">CONTA-<?=$dato['conta']?> | <span class="title2">FORM-<?=strtoupper($pro_key)?></span> </td>
</tr>
<tr>
<td height="25">Cliente:<span class="title7">
  <?=$cliente;?>
</span></td>
<td width="35%" align="right"><strong>Intervenci&oacute;n Nro: <?=$dato['periodo'];?> de
  <?=$de?>
</strong></td>
</tr>
</table>
<br>
<table width="100%" class="table2" align="center">
<tr>
<th colspan="2">Detalles del Servico:</th>
</tr>
<tr>
<td width="58%">Detalles:
  <b><?=$dato['detalles'];?></b></td>
<td width="42%">Fecha Actual:<b>
  <?=$fecha;?>
</b></td>
</tr>
<tr>
<td>Estaci&oacute;n:
  <b><?=$dato_t['ubicacion'];?></b></td>
<td>
  Departamento:<b>
    <?=$dato_t['departamento'];?>
</b></td>
</tr>
</table>
<table width="100%" class="table2" align="center">
<tr>
<th colspan="2">Programacion:</th>
</tr>
<tr>
<td width="25%">Fecha Programada:</td>
<td><span class="azul"><?=$dato['fecha'];?></span> </td>
</tr>
<tr>
<td width="25%">Hora Programada:</td>
<td><span class="azul"><?=$dato['h_prog'];?></span> </td>
</tr>
<tr>
<td>Tecnico a Cargo:</td>
<td><span class="azul"><?=$tecnico;?></span>                              </td>
</tr>
</table>

<table width="100%" border="0" cellpadding="0" cellspacing="2" class="table2" align="center">
<tr>
<th colspan="2">ATENCION:</th>
</tr>
<tr>
<td width="49%"><div align="right">Notificaci&oacute;n: <b><?=$dato['p1']?></b></div></td>
<td width="51%"><div align="right">Ingreso al Sitio: <b><?=$dato['hora_llegada']?></b></div></td>
</tr>
<tr>
<td><div align="right">Inicio de Viaje: <b><?=$dato['p2']?></div></td>
<td><div align="right">Conclusi&oacute;n del trabajo: <b><?=$dato['hora_salida']?></b></div></td>
</tr>
</table>
<table width="100%" cellspacing="2" class="table2" align="center">
<tr>
<th colspan="2"><div align="center">RESPONSABLES DE TRABAJO</div></th>
</tr>
<tr>
<th>Autorización por Cliente </th>
<th>Personal de Dimesat srl </th>
</tr>
<tr> 
<td valign="top" width="50%" ><?=nl2br($dato['p3'])?></td>
<TD valign="top" width="50%" ><?=nl2br($dato['p4'])?></TD>
</tr>
<tr>
<th>TIPO DE EMERGENCIA </th>
<th>SERVICIO AFECTADO </th>
</tr>
<tr>
<td width="50%"><div align="right" style="padding-right:80px"><table width="200">
    <tr>
      <td><div align="right">ALARMAS EXTERNAS</div></td>
      <td <? if($dato['p6']=="ALARMAS EXTERNAS") { echo'style="background-color:#333333"';$aspa="X"; } else { $aspa="";}?> class="cuadro">&nbsp;<?=$aspa?>&nbsp;</td>
    </tr>
    <tr>
      <td><div align="right">BTS</div></td>
      <td <? if($dato['p6']=="BTS") { echo'style="background-color:#333333"';$aspa="X"; } else { $aspa="";}?> class="cuadro">&nbsp;<?=$aspa?>&nbsp;</td>
    </tr>
    <tr>
      <td><div align="right">RECTIFICADORES</div></td>
      <td <? if($dato['p6']=="RECTIFICADORES") { echo'style="background-color:#333333"';$aspa="X"; } else { $aspa="";}?> class="cuadro">&nbsp;<?=$aspa?>&nbsp;</td>
    </tr>
    <tr>
      <td><div align="right">GRUPO GENERADOR</div></td>
      <td <? if($dato['p6']=="GRUPO GENERADOR") { echo'style="background-color:#333333"';$aspa="X"; } else { $aspa="";}?> class="cuadro">&nbsp;<?=$aspa?>&nbsp;</td>
    </tr>
    <tr>
      <td><div align="right">INFRAESTRUCTURA</div></td>
      <td <? if($dato['p6']=="INFRAESTRUCTURA") { echo'style="background-color:#333333"';$aspa="X"; } else { $aspa="";}?> class="cuadro">&nbsp;<?=$aspa?>&nbsp;</td>
    </tr>
  </table></div></td>
<TD width="50%"><div align="right" style="padding-right:80px">
  <table width="200">
    <tr>
      <td><div align="right">VSAT</div></td>
      <td <? if($dato['p6']=="VSAT") { echo'style="background-color:#333333"';$aspa="X"; } else { $aspa="";}?> class="cuadro">&nbsp;<?=$aspa?>&nbsp;</td>
    </tr>
    <tr>
      <td><div align="right">BATERIAS</div></td>
      <td <? if($dato['p6']=="BATERIAS") { echo'style="background-color:#333333"';$aspa="X"; } else { $aspa="";}?> class="cuadro">&nbsp;<?=$aspa?>&nbsp;</td>
    </tr>
    <tr>
      <td><div align="right">MW</div></td>
      <td <? if($dato['p6']=="MW") { echo'style="background-color:#333333"';$aspa="X"; } else { $aspa="";}?> class="cuadro">&nbsp;<?=$aspa?>&nbsp;</td>
    </tr>
    <tr>
      <td><div align="right"><? if(substr($dato['p6'],0,5)=="OTROS") { echo $dato['p6'];} else { echo "OTROS"; } ?></div></td>
      <td <? if(substr($dato['p6'],0,5)=="OTROS") { echo'style="background-color:#333333"';$aspa="X"; } else { $aspa="";}?> class="cuadro">&nbsp;<?=$aspa?>&nbsp;</td>
    </tr>
  </table>
</div></TD>
</tr>
<tr>
<th colspan="2">DESCRIPCION GENERAL DEL TRABAJO REALIZADO</th>
</tr>
<tr>
<td colspan="2" >
<?=nl2br($dato['p7'])?></td>
</tr>
<tr>
<th colspan="2"><div align="center">REPUESTOS O INSUMOS UTILIZADOS</div></th>
</tr>
<tr>
<th>DESCRIPCION DE LA INTERVENCION</th>
<th>REPUESTOS E INSUMOS UTILIZADOS</th>
</tr>
<tr>
<td valign="top" width="50%"><?=nl2br($dato['p8'])?></td>
<TD valign="top" width="50%"><?=nl2br($dato['p9'])?></TD>
</tr>
<tr>
<th colspan="2">OBSERVACIONES</th>
</tr>
<tr>
<td colspan="2" >
<?=nl2br($dato['obs'])?></td>
</tr>
</table>

                      <br><div align="center">
                      <div class="box_msj"><span class="title7">CONDICION FINAL:</span>                         
                      <B><?=$dato['condicion_final'];?></B></div></div><br>
<?
if($dato['postm_condicion_final']!="")
{
?>                      
					  <table width="730" class="table2" align="center">
                        <tr>
                          <th height="19" colspan="2" ><div align="left">TRABAJO POST-MANTENIMIENTO</div>                            </th>
                        </tr>
                        <tr>
                          <td  width="242" valign="top">
                          Fecha de POST-MANTENIMIENTO:</td>
                          <td  width="426" valign="top"><?=$dato['postm_fecha'];?></td>
                        </tr>
                        <tr>
                          <td  valign="top">Resument Textual del Trabajo Realizado:</td>
                          <td  valign="top"><?=nl2br($dato['postm_descripcion']);?></td>
                        </tr>
                      </table>
                      <br><div align="center">
                      <div class="box_msj"><span class="title7">CONDICION FINAL POST-MANTENIMIENTO:</span>                         
                      <B><?=$dato['postm_condicion_final'];?></B></div></div>

                        <br>
<?
}
?>				
<br>	  
<?
if($archivos!="no"){
?>
<table width="730" class="table2" align="center">
<tr>
<th height="19" colspan="3"><center>ARCHIVOS ADJUNTOS</center></th>
</tr>
<tr height="16">
<th width="387">Archivos </th>
<th width="74">Tama&ntilde;o</th>
<th width="66"></th>
</tr>
<?php 
	$resultado=mysql_query("SELECT titulo,imagen,item FROM st_cronograma_informes_".$pro_key."_archivos WHERE id_st_cronograma_informes_".$pro_key."='".$id_st_cronograma_informes."' ORDER BY item ASC");
	$filas=mysql_num_rows($resultado);
	if($filas!=0)
	{ $j=0;
	while($dato_arch=mysql_fetch_array($resultado))
	 {

$nombre=$dato_arch['imagen'];
$titulo=$dato_arch['titulo'];

	$tam=filesize($dir.$nombre)/1024;
	$ext=substr(strrchr($nombre, '.'), 1);

	?>
	<tr height="25">
	<td><a href="<?=$dir_ext.$nombre;?>" target="_blank" class="enlaceboton" title="<?=$nombre?>">
	<img src="<?=$web?>/img/icons/icon_<?=$ext?>.gif" border="0" align="top"><?=$titulo?></a></td>
	<TD><div align="right"><? echo round($tam)." Kb"; ?></div></TD>
	<td><div align="center">
	<a title="VER ARCHIVO" href="<?=$dir_ext.$nombre;?>" target="_blank" class="enlaceboton"><img src="<?=$web?>/img/icons/icon_<?=$ext?>.gif" border="0" align="top"></a>
	<a title="Descargar Archivo ahora!" href="../funciones/descargar_archivo.php?download=<?=$nombre?>&directorio=<?=$carpeta?>" target="_blank" class="enlaceboton"><img border=0 src="<?=$web?>/img/download.gif" ></a>
</div></td>
	</tr>
	<?php 
	}
} 
else{
	?>
	<tr height="25">
	<td colspan="3"><div class="marcar">Sin Archivos Adjuntos</div></td>
	</tr>
	<?	
	}
?>
</table>
<?
}
?>
<!-- -->
</table>
<form name="amper" method="post" action="../usuarios/modulos/st_guardar_rev.php">
<br>
<table width="730" class="table2" align="center">
<tr>
<th height="19" colspan="3"><center>REVISION DEL CLIENTE</center></th>
</tr>
<tr height="16">
<td align="center">
	<br>
	<input type="hidden" name="id_st_cronograma_informes" value="<?=$id_st_cronograma_informes?>">
	<input type="hidden" name="pro_key" value="<?=$pro_key?>">
	<input type="hidden" name="id_st_proyecto" value="<?=$dato['id_st_proyecto']?>">
	<input type="radio" name="rev" value="1"> Encargado ENERGIA
	<input type="radio" name="rev" value="2"> Encargado TRANSMISION
	<input type="radio" name="rev" value="3"> Encargado MOVIL
	<br><br>
	Observaciones:
	<br>
	<textarea name="obs" rows="4" cols="50"></textarea>
	<br><br>
	<button type="submit" type="button">Enviar revision</button>
	<br>
</td>
</tr>
</form>
</table>
<!-- -->

<br><br>
<BR>
                      <table width="760" border="0" align="center">
          <tr>
            <td width="375"><div align="center"><br>
                      <br>
              _________________________<br>
              CLIENTE</div></td>
            <td width="375"><div align="center"><br>
                    <br>
              ____________________<br>
              POR DIMESAT
            </div></td>
          </tr>
        </table>


</BODY></HTML>


