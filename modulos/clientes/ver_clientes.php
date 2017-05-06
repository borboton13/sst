<?
include("../../funciones/class.paginado.php");
if (isset($_GET['pagina'])){
$pagina = $_GET['pagina'];
}
if (isset($_GET['nro_por_pagina'])) $nro_por_pagina = $_GET['nro_por_pagina'];
else $nro_por_pagina=20;

$modi=0; $vtod=0;
if($nively=='1'){ $modi=1; $vtod=1; $priv=1; }

if($vtod==1){
$consulta="SELECT id_cliente,razon_social, caracteristicas, nivel_cliente, tcliente, area, id_usuario, cuenta, nro_contactos,activo FROM v_clientes WHERE 1=1";
}
else {
$consulta="SELECT id_cliente,razon_social, caracteristicas, nivel_cliente, tcliente, area, id_usuario, cuenta, nro_contactos,activo FROM v_clientes WHERE id_usuario='".$id_user."'";
$modi=1;
}

$txt="CRITERIO DE BUSQUEDA y/o FILTRADO: ".'<a href="clientes.php?path=ver_clientes.php" class="enlace_s_menu">Ver todos</a> ';

if(isset($_GET['activo'])) {
$activo=$_GET['activo'];
if($activo!=""){
$consulta.=" AND activo='1'";
$txt.="| Ver clientes Activos ";
}
}

if(isset($_GET['nivelc'])) {
$nivelc=$_GET['nivelc'];
if($nivelc!=""){
$consulta.=" AND nivel_cliente='$nivelc'";
$txt.="| Filtrar <B>$nivelc</B> Estrellas ";
}
}

if(isset($_GET['tcliente'])) {
$tcliente=$_GET['tcliente'];
if($tcliente!=""){
$consulta.=" AND tcliente='$tcliente'";
$txt.="| Filtrar Tipo de Cliente: <B>$tcliente</B> ";
}
}

if(isset($_GET['area'])) {
$area=$_GET['area'];
if($area!=""){
$consulta.=" AND area='$area'";
$txt.="| Filtrar <B>$area</B>";
}
}

if (isset($_GET['buscar']) && isset($_GET['campo'])){
$buscar = $_GET['buscar'];
$campo = $_GET['campo'];
$consulta.=" AND $campo like '%$buscar%'";
$txt.="| Buscar -> <b>".$buscar."</b>";
}

if(isset($_GET['ordenar_por'])) {
$ordenar_por=$_GET['ordenar_por'];
$consulta.=" ORDER BY $ordenar_por ASC";
switch($ordenar_por){
case "razon_social": $label="<B>CLIENTE</B>"; break; 
case "id_cliente": $label="<B>ID CLIENTE</B>"; break; 
}
$txt.="| Ordenar por $label ";
}
else {
$ordenar_por="razon_social";
$consulta.=" ORDER BY $ordenar_por ASC";
switch($ordenar_por){
case "razon_social": $label="<B>CLIENTE</B>"; break; 
case "id_cliente": $label="<B>ID CLIENTE</B>"; break; 
}
$txt.="| Ordenar por $label ";
}
?><table width="98%" cellspacing="1" class="table3" align="center">
<caption>VER LISTA DE CLIENTES<BR>
<table border="0" align="center">	
<tr>
<td class="marco"><form name="amper1" method="GET" action="<?=$link_modulo?>">
<input type="hidden" name="path" value="ver_clientes.php" />
<input type="hidden" name="nivelc" value="<?=$nivelc?>" />
<input type="hidden" name="area" value="<?=$area?>" />
<input type="hidden" name="ordenar_por" value="<?=$ordenar_por?>" />
<input type="hidden" name="activo" value="<?=$activo?>" />
<input type="hidden" name="tcliente" value="<?=$tcliente?>" />
<img src="../../img/ico_left.gif" alt="buscar" width="16" height="14"  align="absmiddle"><input name="nro_por_pagina" type="text" class="Text_center" value="<?=$nro_por_pagina;?>" size="2" maxlength="3" /><img src="../../img/ico_right.gif" alt="buscar" width="16" height="14"  align="absmiddle">
</form></td>
<td class="marco">
<img src="../../img/ico_asc.gif" width="19" height="19" align="absbottom"><select name="ordenar_por" class='buscar' onChange="document.location=this.options[this.selectedIndex].value" >
<option value="clientes.php?path=ver_clientes.php&ordenar_por=razon_social&nro_por_pagina=<?=$nro_por_pagina?>&nivelc=<?=$nivelc?>&activo=<?=$activo?>" <? if($ordenar_por=="razon_social") echo "selected"; ?>>CLIENTE</option>
<option value="clientes.php?path=ver_clientes.php&ordenar_por=id_cliente&nro_por_pagina=<?=$nro_por_pagina?>&nivelc=<?=$nivelc?>&activo=<?=$activo?>" <? if($ordenar_por=="id_cliente")echo "selected"; ?>>CODIGO</option>
</select></td>
<td class="marco">
<form name="amper" method="GET" action="<?=$link_modulo?>">
<input type="hidden" name="path" value="ver_clientes.php" />
<input name="nro_por_pagina" type="hidden" value="<?=$nro_por_pagina?>" />
<input type="hidden" name="nivelc" value="<?=$nivelc?>" />
<input type="hidden" name="area" value="<?=$area?>" />
<input type="hidden" name="ordenar_por" value="<?=$ordenar_por?>" />
<input type="hidden" name="activo" value="<?=$activo?>" />
<input type="hidden" name="tcliente" value="<?=$tcliente?>" />
<img src="../../img/ico_buscar.gif" width="19" height="19"  align="absbottom"> 
<input name="buscar" type="text" class="Text_left" size="20" /> en 
<select name="campo" class="selectbuscar">
  <option value="razon_social">CLIENTE</option>
  <option value="caracteristicas">CARACT.</option>
</select>
<input name="enviar" type="submit" value="Buscar" class="title5"/></form></td>
<td class="marco"><img src="../../img/filtrar_s.gif" alt="Filtrar NIVEL CLIENTE" border="0" align="absmiddle" />
  <select name="select" class="buscar" onchange='document.location=this.options[this.selectedIndex].value'>
    <option class="title7" value="clientes.php?path=ver_clientes.php&ordenar_por=<?=$ordenar_por?>&nro_por_pagina=<?=$nro_por_pagina?>&area=<?=$area?>&activo=<?=$activo?>&tcliente=<?=$tcliente?>">Nivel: Todos </option>
    <?
$resultado=mysql_query("SELECT sub_grupo FROM parametrica WHERE grupo='nivel_estrellas' ORDER BY sub_grupo"); 
while($dato=mysql_fetch_array($resultado))
{
?>
    <option value="clientes.php?path=ver_clientes.php&ordenar_por=<?=$ordenar_por?>&nro_por_pagina=<?=$nro_por_pagina?>&area=<?=$area?>&nivelc=<?=substr($dato['sub_grupo'],0,1)?>&activo=<?=$activo?>&tcliente=<?=$tcliente?>" <? if(substr($dato['sub_grupo'],0,1)==$nivelc) echo "selected"; ?>>
      Nivel: <?=$dato['sub_grupo']?>
      </option>
    <?
}
?>
  </select></td>
<td class="marco"><img src="../../img/filtrar_s.gif" alt="Filtrar NIVEL CLIENTE" border="0" align="absmiddle" /> 
  <select name="select" class="buscar" onchange='document.location=this.options[this.selectedIndex].value'>
    <option class="title7" value="clientes.php?path=ver_clientes.php&ordenar_por=<?=$ordenar_por?>&nro_por_pagina=<?=$nro_por_pagina?>&nivelc=<?=$nivelc?>&area=<?=$area?>&activo=<?=$activo?>">Tipo: Todos</option>
    <?
$resultado=mysql_query("SELECT sub_grupo FROM parametrica WHERE grupo='tipo_cliente' ORDER BY sub_grupo"); 
while($dato=mysql_fetch_array($resultado))
{
?>
    <option value="clientes.php?path=ver_clientes.php&ordenar_por=<?=$ordenar_por?>&nro_por_pagina=<?=$nro_por_pagina?>&nivelc=<?=$nivelc?>&area=<?=$area?>&activo=<?=$activo?>&tcliente=<?=$dato['sub_grupo']?>" <? if($dato['sub_grupo']==$tcliente) echo "selected"; ?>>
      Tipo: <?=$dato['sub_grupo']?>
      </option>
    <?
}
?>
  </select></td>
<td class="marco"><img src="../../img/filtrar_s.gif" alt="Filtrar Area" border="0" align="absmiddle" />
  <select name="area" class="buscar" onChange='document.location=this.options[this.selectedIndex].value'>
<option class="title7" value="clientes.php?path=ver_clientes.php&ordenar_por=<?=$ordenar_por?>&nro_por_pagina=<?=$nro_por_pagina?>&activo=<?=$activo?>&nivelc=<?=$nivelc?>&tcliente=<?=$tcliente?>">Area: Todos </option>
<?
$resultado=mysql_query("SELECT sub_grupo FROM parametrica WHERE grupo='categoria' ORDER BY sub_grupo"); 
while($dato=mysql_fetch_array($resultado))
{
?>
<option value="clientes.php?path=ver_clientes.php&ordenar_por=<?=$ordenar_por?>&nro_por_pagina=<?=$nro_por_pagina?>&area=<?=$dato['sub_grupo']?>&nivelc=<?=$nivelc?>&activo=<?=$activo?>&tcliente=<?=$tcliente?>" <? if($dato['sub_grupo']==$area) echo "selected"; ?>>Area: <?=$dato['sub_grupo']?></option>
<?
}
?>
</select></td>
<td class="marco">
<? 
if($activo!='1')
{
?>
<a class="enlace_s_menu" href="clientes.php?path=ver_clientes.php&activo=1"><img src="../../img/filtrar_s.gif" alt="Filtrar solo Clientes Activos" border="0" align="absmiddle" /> Activos</a>
<?
}
else{
?>
<a class="enlace_s_menu" href="clientes.php?path=ver_clientes.php"><img src="../../img/filtrar_s.gif" alt="Ver Activos e Inactivos" border="0" align="absmiddle" />  Activos e Inactivos</a>
<?
}
?></td>

</tr>
</table>
</caption>
<tr>
<td colspan="6" class="paginado"><div align="left"> 
<?=$txt?></div></td>
<td colspan="6" class="paginado">
<?
$rs = new paginado($conexion);
$rs->pagina($pagina);
$rs->porPagina($nro_por_pagina);
$rs->propagar("path");
$rs->propagar("nro_por_pagina");
$rs->propagar("activo");
$rs->propagar("ordenar_por");
if($nivelc!=NULL)
{
$rs->propagar("nivelc");
}
if($tcliente!=NULL)
{
$rs->propagar("tcliente");
}
if($area!=NULL)
{
$rs->propagar("area");
}
if($buscar!=NULL)
{
$rs->propagar("buscar");
$rs->propagar("campo");
}
if(!$rs->query($consulta))
{    die( $rs->error() );
}
echo "Mostrando ".$rs->desde()." - ".$rs->hasta()." de un total de ".$rs->total()."<br>";
$i=$rs->desde();
?></td>
</tr>
<tr>
<th width="2%">N&deg;</th>
<th width="4%">ID</th>
<th width="30%">CLIENTE</th>			              
<th width="22%">CARACTERISTICAS</th>
<th width="8%">NIVEL</th> 
<th width="8%">TIPO</th>
<th width="10%">AREA</th>
<th width="2%"><img src="../../img/user.gif" width="16" height="16" ALT="Nro de Contactos"/></th>	
<th width="2%"></th>
<th width="2%"></th>
<th width="6%">RESP</th>
<th width="2%">&nbsp;</th>	
</tr>
<tbody>
<?
  while($row = $rs->obtenerArray())
 {
///////////
$cliente=$row['razon_social'];
if($buscar!=NULL)
switch($campo)
{
case 'razon_social':
$cliente=eregi_replace ($buscar,"<span class='marcar'>".$buscar."</span>",$row['razon_social']); break;
case 'caracteristicas':
$row['caracteristicas']=eregi_replace ($buscar,"<span class='marcar'>".$buscar."</span>",$row['caracteristicas']); break;
}
	 
	 if($i%2==0)
	{
	$rowt="#f6f7f8";
	}
	else
	{
	$rowt="#f1f1f1";
	}
?>
<tr bgcolor="<?=$rowt?>" onmouseover="setPointer(this, '#DADADA')" onmouseout="setPointer(this, '<?=$rowt?>')">
	<td><DIV ALIGN="RIGHT"><?=$i?></DIV></td>
	<td><DIV ALIGN="CENTER"><a href="<?=$link_modulo?>?path=cliente_detalles.php&nro=<?=base64_encode($row['id_cliente'])?>" class="enlace_s_menu"><?=$row['id_cliente']?></a></DIV></td>
    <td class="negro"><?=$cliente?></td>			
    <td><?=$row['caracteristicas']?></td>            
    <td><DIV ALIGN="center"><img src="../../img/ico_start<?=$row['nivel_cliente']?>.gif" height="18" width="78" alt="Prioridad <?=$row['nivel_cliente']?> Estrellas"></DIV></td>
	<td><DIV ALIGN="center"><?=$row['tcliente']?></DIV></td>
	<td><DIV ALIGN="center"><?=$row['area']?></DIV></td>
	<td><div align="center" class="cafe"><B><?=$row['nro_contactos']?></B></div></td>
	<td>	
	<a <? if($modi==1) {?> href="<?=$link_modulo_r?>?path=cliente_modificar.php&id=<?=base64_encode($row['id_cliente'])?>" onclick="return GB_showCenter('Modificar Cliente', this.href,380, 470)" <? } else { echo" href=# onclick=\"alert('Usted No tiene Privilegios para Modificar');\" ";}?> class="enlace_s_menu"><img src="../../img/change.gif" height="21" width="21" border="0" align="absmiddle"></a></td><td><a class="enlace_s_menu" href='<?=$link_modulo_r?>?path=cliente_detalles.php&nro=<?=base64_encode($row['id_cliente'])?>' onClick="openNewWindowhtml( this, '860', '420' );return false;"><img src='../../img/popup.gif' alt='Ver Detalles de Cliente en ventana externa' width="20" height="18" border="0" align="absmiddle"></a></td>
	<td><?=substr($row['cuenta'],0,10)?></td>
	<?
	if($vtod==1) $url_ov="ver_todas_ordenes_venta_buscar";
	else $url_ov="ver_ordenes_venta_buscar";
	?>		
	<td>
	<?
	if($row['activo']=='1')
	{
	?>
<a class="enlace_s_menu" <? if($modi==1) {?> href="<?=$link_modulo_r?>?path=cliente_poner_inactivo.php&id=<?=base64_encode($row['id_cliente'])?>" title="Poner Como Inactivo" onclick="return confirm('AMPER SRL: Esta seguro que desea poner como Inactivo a <?=$row['razon_social']?> ?');" <? } ?>><img src="../../img/ico_activo.gif"  border="0"></a>
	<?
	}
	else{
	?>
<a class="enlace_s_menu" <? if($modi==1) {?> href="<?=$link_modulo_r?>?path=cliente_poner_activo.php&id=<?=base64_encode($row['id_cliente'])?>" title="Poner Como Activo" onclick="return confirm('AMPER SRL: Esta seguro que desea poner como Inactivo a <?=$row['razon_social']?>?');" <? }?>><img src="../../img/ico_eliminado.gif" border="0"></a>
	
	<?
	}
	?>	</td>
</tr>	
<?
$i++;
 }
?>
</tbody>
<tfoot>
<tr> 
<td colspan="12" class="paginado">
<?
echo $rs->anterior()." - ".$rs->nroPaginas()." - ".$rs->siguiente();
?></td>
</tr>
</tfoot>
</table>
    <script type="text/javascript">
        var GB_ROOT_DIR = "./../../paquetes/greybox/";
    </script>

    <script type="text/javascript" src="../../paquetes/greybox/AJS.js"></script>
    <script type="text/javascript" src="../../paquetes/greybox/AJS_fx.js"></script>
    <script type="text/javascript" src="../../paquetes/greybox/gb_scripts.js"></script>
    <link href="../../paquetes/greybox/gb_styles.css" rel="stylesheet" type="text/css" media="all" />
