<?
include("../../funciones/class.paginado.php");
if (isset($_GET['pagina'])){
$pagina = $_GET['pagina'];
}
if (isset($_GET['nro_por_pagina'])) $nro_por_pagina = $_GET['nro_por_pagina'];
else $nro_por_pagina=30;

$modi=0; $vtod=0;
if($nively=='1'){ $vtod=1; }

if($vtod==1){
$consulta="SELECT e.id AS id_cliente,e.razon_social, c.nombre, c.telf, c.celular, c.email, c.fax, c.cargo, c.dpto, c.obs, DATE_FORMAT(c.fecha_registro,'%d/%m/%y') AS registro,u.cuenta,c.id FROM clientes e, contactos c, usuarios u WHERE c.id_cliente=e.id AND c.id_user=u.id";
}
else {
$consulta="SELECT e.id AS id_cliente,e.razon_social, c.nombre, c.telf, c.celular, c.email, c.fax, c.cargo, c.dpto, c.obs, DATE_FORMAT(c.fecha_registro,'%d/%m/%y') AS registro,u.cuenta,c.id FROM clientes e, contactos c, usuarios u WHERE c.id_cliente=e.id AND c.id_user=u.id AND c.id_user='".$id_user."'";
}

$txt="CRITERIO DE BUSQUEDA y/o FILTRADO: ".'<a href="clientes.php?path=ver_contactos.php" class="enlace_s_menu">Ver todos</a>';

if (isset($_GET['buscar']) && isset($_GET['campo'])){
$buscar = $_GET['buscar'];
$campo = $_GET['campo'];
$consulta.=" AND $campo like '%$buscar%'";
$txt.="| Buscar -> <b>".$buscar."</b>";
}

if (isset($_GET['id_usuario'])){
$id_usuario = $_GET['id_usuario'];
$consulta.=" AND c.id_user='".$id_usuario."'";
$txt.="| Cod. Resp. -> <b>$id_usuario</b>";
}

if(isset($_GET['ordenar_por'])) {
$ordenar_por=$_GET['ordenar_por'];
$consulta.=" ORDER BY $ordenar_por ASC";
switch($ordenar_por){
case "e.razon_social": $label="<B>CLIENTE</B>"; break; 
case "c.nombre": $label="<B>CONTACTO</B>"; break; 
case "id_cliente": $label="<B>CODIGO</B>"; break;  
}
$txt.="| Ordenar por $label ";
}
else {
$ordenar_por="e.razon_social";
$consulta.=" ORDER BY $ordenar_por ASC";
$txt.="| Ordenar por $label ";
}
?>
<table width="98%" cellspacing="1" class="table3" align="center">
<caption>VER LISTADO DE LOS CONTACTOS<br />
<table border="0" align="center">	
<tr>
<td class="marco"><form name="amper1" method="GET" action="clientes.php">
<input type="hidden" name="path" value="ver_contactos.php" />
<input type="hidden" name="ordenar_por" value="<?=$ordenar_por?>" />
<img src="../../img/ico_left.gif" alt="buscar" width="16" height="14"  align="absmiddle"><input name="nro_por_pagina" type="text" class="Text_center" value="<?=$nro_por_pagina;?>" size="2" maxlength="3" /><img src="../../img/ico_right.gif" alt="buscar" width="16" height="14"  align="absmiddle">
</form></td>
<td class="marco">
<img src="../../img/ico_asc.gif" width="19" height="19" align="absbottom"><select name="ordenar_por" class='buscar' onChange="document.location=this.options[this.selectedIndex].value" >
<option value="clientes.php?path=ver_contactos.php&id_usuario=<?=$id_usuario?>&ordenar_por=e.razon_social&nro_por_pagina=<?=$nro_por_pagina?>" <? if($ordenar_por=="e.razon_social") echo "selected"; ?>>CLIENTE</option>
<option value="clientes.php?path=ver_contactos.php&id_usuario=<?=$id_usuario?>&ordenar_por=c.nombre&nro_por_pagina=<?=$nro_por_pagina?>" <? if($ordenar_por=="c.nombre")echo "selected"; ?>>CONTACTO</option>
<option value="clientes.php?path=ver_contactos.php&id_usuario=<?=$id_usuario?>&ordenar_por=id_cliente&nro_por_pagina=<?=$nro_por_pagina?>" <? if($ordenar_por=="id_cliente")echo "selected"; ?>>CODIGO</option>
</select></td>
<td class="marco">
<form name="amper" method="GET" action="clientes.php">
<input type="hidden" name="path" value="ver_contactos.php" />
<input name="nro_por_pagina" type="hidden" value="<?=$nro_por_pagina?>" />
<input type="hidden" name="ordenar_por" value="<?=$ordenar_por?>" />
<img src="../../img/ico_buscar.gif" width="19" height="19"  align="absbottom"> 
<input name="buscar" type="text" class="Text_left" size="20" /> en 
<select name="campo" class="selectbuscar">
  <option value="e.razon_social">CLIENTE</option>
  <option value="c.nombre">CONTACTO</option>
  <option value="c.cargo">CARGO</option>
  <option value="c.dpto">DEPARTAMENTO</option>
  <option value="c.obs">OBSERVACION</option>  
</select>
<input name="enviar" type="submit" value="Buscar" class="title5"/></form></td>
<? if($vtod==1){ ?>
<td class="marco">
<img src="../../img/filtrar_s.gif" alt="filtrar" align="absbottom">
<select name="id_usuario" class="selectbuscar" id="id_usuario" onChange="document.location=this.options[this.selectedIndex].value">
<option value=# > [Filtrar Responsable] </option>
<?
$resultado=mysql_query("SELECT concat(nombre, ' ', ap_pat) as nombrec,id FROM usuarios ORDER BY nombre ASC;");
while($dato=mysql_fetch_array($resultado))
 {
?>
<option value="clientes.php?path=ver_contactos.php&id_usuario=<?=$dato['id']?>&ordenar_por=c.nombre&nro_por_pagina=<?=$nro_por_pagina?>" <? if($id_usuario==$dato['id']) echo "selected class='naranja'"; ?>><?=$dato['nombrec']?></option>
<?
 }
?>
</select>										  
</td>
<td class="marco"><a class="enlace_s_menu" href="../../html/html_listar_clientes.php" onClick="openNewWindowhtml( this, '800', '590' );return false;"><img src="../../img/c_html.gif" alt="Ver Listado en PDF" border="0" align="absmiddle" /> Listado Completo en HTML</a></td>

<? } ?>
</tr>
</table>
</caption>
<tr>
<td colspan="7" class="paginado"><div align="left"> 
<?=$txt?></div></td>
<td colspan="12" class="paginado">
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
if($area!=NULL)
{
$rs->propagar("area");
}
if($buscar!=NULL)
{
$rs->propagar("buscar");
$rs->propagar("campo");
}
if($id_usuario!=NULL)
{
$rs->propagar("id_usuario");
}
if($estado!=NULL)
{
$rs->propagar("estado");
}
if(!$rs->query($consulta))
{    die( $rs->error() );
}
echo "Mostrando ".$rs->desde()." - ".$rs->hasta()." de un total de ".$rs->total()."<br>";
$i=$rs->desde();
$hasta=$i-1; 
?></td>
</tr>
<tr>
<th width="2%">N&deg;</th>
<th width="4%">ID</th>
<th width="16%">CLIENTE</th>			              
<th width="12%">CONTACTO</th>
<th width="6%">TELF</th> 
<th width="6%">CELULAR</th>
<th width="16%">EMAIL</th>
<th width="5%">FAX</th>	
<th width="14%">CARGO</th>
<th width="6%">DPTO</th>
<th width="6%">OBS</th>
<th width="5%">REG</th>	
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
case 'e.razon_social':
$cliente=eregi_replace ($buscar,"<span class='marcar'>".$buscar."</span>",$row['razon_social']); break;
case 'c.nombre':
$row['nombre']=eregi_replace ($buscar,"<span class='marcar'>".$buscar."</span>",$row['nombre']); break;
case 'c.cargo':
$row['cargo']=eregi_replace ($buscar,"<span class='marcar'>".$buscar."</span>",$row['cargo']); break;
case 'c.dpto':
$row['dpto']=eregi_replace ($buscar,"<span class='marcar'>".$buscar."</span>",$row['dpto']); break;
case 'c.obs':
$row['obs']=eregi_replace ($buscar,"<span class='marcar'>".$buscar."</span>",$row['obs']); break;
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
	<td><DIV ALIGN="CENTER"><a href="clientes.php?path=cliente_detalles.php&nro=<?=base64_encode($row['id_cliente'])?>" class="enlace_s_menu"><?=$row['id_cliente']?></a></DIV></td>
    <td><?=$cliente?></td>			
    <td class="negro"><?=$row['nombre']?></td>            
    <td><DIV ALIGN="center"><?=$row['telf']?></DIV></td>
	<td><DIV ALIGN="center"><?=$row['celular']?></DIV></td>
	<td><a href="mailto:<?=$row['email']?>" class='enlacemail'><?=$row['email']?></a></td>
	<td><div align="center" class="cafe"><?=$row['fax']?></div></td>
	<td><?=$row['cargo']?></td>
	<td><?=$row['dpto']?></td>
	<td><?=$row['obs']?></td>	
	<td><div class="title5" align="center"><span class="naranja"><?=substr($row['cuenta'],0,10)?></span><BR /><?=$row['registro']?></div></td>	
<tr>	
<?
$i++;
 }
?>
</tbody>
<tfoot>
<tr> 
<td colspan="18" class="paginado">
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
