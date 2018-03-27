<?
$nro = $_GET["nro"];
if($nively=='1'){ $adm=1;}
$link_actual="trabajos_ver_correlativo.php";
include("../../funciones/class.paginado.php");

if (isset($_GET['pagina'])){
$pagina = $_GET['pagina'];
}				  

if (isset($_GET['nro_por_pagina'])) $nro_por_pagina = $_GET['nro_por_pagina'];
else $nro_por_pagina=20;

$sql="SELECT form,nro,DATE_FORMAT(p1,'%d/%m/%Y %H:%i') AS inicio,DATE_FORMAT(hora_salida,'%d/%m/%Y %H:%i') AS solucion,ubicacion,departamento,producto,caracteristicas,funcionario,personal,revision,condicion_final,postm_condicion_final,pasos,id_usuario,id_item,revision_ext,nro_ticket,idestacion FROM v_correlativo WHERE id_st_proyecto='".$nro."'";

$txt="CRITERIO DE BUSQUEDA y/o FILTRADO: ".'<a href="'.$link_modulo.'?path='.$link_actual.'&nro='.$nro.'" class="enlace_s_menu">Ver todos</a> ';
////////ubicacion
if (isset($_GET['ubicacion']) && $_GET['ubicacion']!=""){
$ubicacion = $_GET['ubicacion'];
$sql.=" AND ubicacion like '%$ubicacion%'";
$txt.=" | UBICACION -> <b>".$ubicacion."</b>";
}
///depto
if(isset($_GET['departamento']) && $_GET['departamento']!="") {
$departamento=$_GET['departamento'];
$sql.=" AND departamento='$departamento'";
$txt.="| DEPTO: <B>$departamento</B> ";
}
///producto
if(isset($_GET['producto']) && $_GET['producto']!="") {
$producto=$_GET['producto'];
$sql.=" AND producto='$producto'";
$txt.="| PROD/SERV: <B>$producto</B> ";
}
///detalles
if(isset($_GET['caracteristicas']) && $_GET['caracteristicas']!="") {
$caracteristicas=$_GET['caracteristicas'];
$sql.=" AND caracteristicas like '%$caracteristicas%'";
$txt.="| DETALLES: <B>$caracteristicas</B> ";
}
///funcionario
if(isset($_GET['funcionario']) && $_GET['funcionario']!="") {
$funcionario=$_GET['funcionario'];
$sql.=" AND funcionario LIKE '%$funcionario%'";
$txt.="| FUNCIONARIO: <B>$funcionario</B> ";
}
///tecnico
if(isset($_GET['tecnico']) && $_GET['tecnico']!="") {
$tecnico=$_GET['tecnico'];
$sql.=" AND personal='$tecnico'";
$txt.="| TECNICO: <B>$tecnico</B> ";
}
///revision
if(isset($_GET['revision']) && $_GET['revision']!="") {
$revision=$_GET['revision'];
$sql.=" AND revision='$revision'";
$txt.="| REVISION: <B>$revision</B> ";
}
///estado
if(isset($_GET['estado']) && $_GET['estado']!="") {
$estado=$_GET['estado'];

switch($estado){
case "postok": $sql.=" AND postm_condicion_final='OK+'"; break;
case "Pendiente": $sql.=" AND condicion_final='$estado' AND postm_condicion_final='0'"; break;
default: $sql.=" AND condicion_final='$estado'";
}

$txt.="| ESTADO: <B>$estado</B> ";
}
/////////ORDENAR
if (isset($_GET['ordenar_por'])){
$ordenar_por = $_GET['ordenar_por'];
$orden = $_GET['orden'];
	switch($ordenar_por){
	case 'inicio': $sql.=" ORDER BY p1 $orden"; break;
	case 'solucion': $sql.=" ORDER BY hora_salida $orden"; break;
	case 'nro': $sql.=" ORDER BY form,nro $orden"; break;
	}
$sw_ordenar=1;
$txt.=" | Ordenado por <b>".$ordenar_por."</b> en orden <b>".$orden."</b>";
}
else {
$ordenar_por = "nro";
$orden = "ASC";
$sql.=" ORDER BY form,nro ASC";
}

?>
<table width="98%" border="1" align="center" cellspacing="0" class="table3">
<caption>
EQUIPOS/SERVICIOS PARA EL SEGUIMIENTO TECNICO DEL PROYECTO POR CORRELATIVO
</caption>
	<tr>
	<td colspan="2" valign="bottom">
	<? 
	$consulta="SELECT c.razon_social,s.declaracion_proyecto,date_format(s.fecha_inicio,'%d/%m/%Y'),date_format(s.fecha_final,'%d/%m/%Y'),concat(u.nombre, ' ', u.ap_pat),s.fecha_registro,c.id 
FROM (st_proyecto s INNER JOIN clientes c ON s.id_cliente=c.id) INNER JOIN usuarios u ON s.id_usuario=u.id WHERE s.id_st_proyecto='".$nro."'";
	$resultado=mysql_query($consulta);
	$filas=mysql_num_rows($resultado);
	if($filas!=0)
	{ 
	while($dato=mysql_fetch_array($resultado))
	 {
	 $razon_social=$dato[0]; 
	 $declaracion_proyecto=$dato[1]; 
	 $fecha_inicio=$dato[2]; 
	 $fecha_final=$dato[3]; 
	 if($fecha_final=="00/00/0000") $fecha_final="Indefinido";
	 $id_usuario=$dato[4]; 
	 $fecha_registro=$dato[5]; 
	 $id_cliente=$dato[6]; 
	 }
	}
	?>
	Nro: <span class="title"><?=$nro;?></span><br>
	Ingresado por: <span class="title6"><?=$id_usuario;?></span><br>
	Cliente:  <span class="title7"><?=$razon_social;?></span><br>
	Fecha Inicial: <span class="title6"><?=$fecha_inicio;?></span><br>
	Fecha final: <span class="title6"><?=$fecha_final;?></span><br>
	Fecha Registro: <span class="title6"><?=$fecha_registro;?> </span></td>
	</tr>
	<tr>
	  <td colspan="2" valign="bottom"><table>
        <tr>
          <td class="marco"><a class="enlaceboton" href="../../excel/excel_st_listado_correlativo.php?nro=<?=$nro;?>&ordenar_por=<?=$ordenar_por?>&orden=<?=$orden?>&ubicacion=<?=$ubicacion?>&producto=<?=$producto?>&departamento=<?=$departamento?>&caracteristicas=<?=$caracteristicas?>&funcionario=<?=$funcionario?>&tecnico=<?=$tecnico?>&revision=<?=$revision?>&estado=<?=$estado?>" onclick="openNewWindowhtml( this, '800', '590' );return false;"><img src="../../img/excel_ico.gif" alt="Ver Listado en Excel" width="16" height="16" border="0" align="absmiddle" /> Ver Listado en Excel</a></td>
          <td class="marco"><a class="enlaceboton" href="<?=$link_modulo?>?path=trabajos_ver.php&nro=<?=base64_encode($nro);?>"><img src="../../img/informe_detalles.gif" width="16" height="16"  border="0" align="absmiddle" /> Ver por Estacion</a></td>
          <td class="marco">
              <!--<a href="<?/*=$link_modulo_r*/?>?path=prev_select_form.php&idevento=<?/*=$idevento*/?>"
                 class="enlace_s_menu"
                 onclick="return GB_showCenter('MANTENIMIENTO PREVENTIVO', this.href,182, 700)">
                 <img src="../../img/informe_detalles.gif" width="16" height="16"  border="0" align="absmiddle" />
                  Nuevo Mantenimiento
              </a>-->
              <input class="btn_dark" onClick="location.href='<?=$mst?>nuevo_correctivo.php&nro=<?=base64_encode($nro);?>'" type="button" value="Nuevo">
          </td>
        </tr>
      </table></td>
  </tr>
  <tr>
  <td><table border="0" align="center">	
<tr>
<td class="marco"><form name="amper1" method="GET" action="<?=$link_modulo?>">
<input type="hidden" name="path" value="<?=$link_actual?>" />
<input type="hidden" name="nro" value="<?=$nro?>"/>
<input type="hidden" name="ordenar_por" value="<?=$ordenar_por?>"/>
<input type="hidden" name="orden" value="<?=$orden?>"/>
<input type="hidden" name="ubicacion" value="<?=$ubicacion?>"/>
<input type="hidden" name="departamento" value="<?=$departamento?>"/>
<input type="hidden" name="producto" value="<?=$producto?>"/>
<input type="hidden" name="caracteristicas" value="<?=$caracteristicas?>"/>
<input type="hidden" name="funcionario" value="<?=$funcionario?>"/>
<input type="hidden" name="tecnico" value="<?=$tecnico?>"/>
<input type="hidden" name="revision" value="<?=$revision?>"/>
<input type="hidden" name="estado" value="<?=$estado?>"/>
<img src="../../img/ico_left.gif" alt="buscar" width="16" height="14"  align="absmiddle"><input name="nro_por_pagina" type="text" class="Text_center" value="<?=$nro_por_pagina;?>" size="2" maxlength="3" /><img src="../../img/ico_right.gif" alt="buscar" width="16" height="14"  align="absmiddle">
</form></td>
<td class="marco">
<img src="../../img/ico_asc.gif" width="19" height="19" align="absbottom"><select name="ordenar_por" class="buscar" onChange="document.location=this.options[this.selectedIndex].value">
<option></option>
<option value="<?=$link_modulo?>?path=<?=$link_actual?>&ordenar_por=nro&orden=ASC&nro_por_pagina=<?=$nro_por_pagina?>&nro=<?=$nro?>&ubicacion=<?=$ubicacion?>&producto=<?=$producto?>&caracteristicas=<?=$caracteristicas?>&funcionario=<?=$funcionario?>&tecnico=<?=$tecnico?>&revision=<?=$revision?>&estado=<?=$estado?>" <? if($ordenar_por=="nro" && $orden=="ASC") echo "selected"; ?>>NRO INFORME</option>
<option value="<?=$link_modulo?>?path=<?=$link_actual?>&ordenar_por=inicio&orden=ASC&nro_por_pagina=<?=$nro_por_pagina?>&nro=<?=$nro?>&ubicacion=<?=$ubicacion?>&producto=<?=$producto?>&caracteristicas=<?=$caracteristicas?>&funcionario=<?=$funcionario?>&tecnico=<?=$tecnico?>&revision=<?=$revision?>&estado=<?=$estado?>" <? if($ordenar_por=="inicio" && $orden=="ASC") echo "selected"; ?>>FECHA INICIO</option>
<option value="<?=$link_modulo?>?path=<?=$link_actual?>&ordenar_por=solucion&orden=ASC&nro_por_pagina=<?=$nro_por_pagina?>&nro=<?=$nro?>&ubicacion=<?=$ubicacion?>&producto=<?=$producto?>&caracteristicas=<?=$caracteristicas?>&funcionario=<?=$funcionario?>&tecnico=<?=$tecnico?>&revision=<?=$revision?>&estado=<?=$estado?>" <? if($ordenar_por=="solucion" && $orden=="ASC") echo "selected"; ?>>FECHA SOLUCION</option>
</select></td>
<td class="marco">
<img src="../../img/ico_desc.gif" width="19" height="19" align="absbottom"><select name="ordenar_por" class="buscar" onChange="document.location=this.options[this.selectedIndex].value">
<option></option>
<option value="<?=$link_modulo?>?path=<?=$link_actual?>&ordenar_por=nro&orden=DESC&nro_por_pagina=<?=$nro_por_pagina?>&nro=<?=$nro?>&ubicacion=<?=$ubicacion?>&producto=<?=$producto?>&caracteristicas=<?=$caracteristicas?>&funcionario=<?=$funcionario?>&tecnico=<?=$tecnico?>&revision=<?=$revision?>&estado=<?=$estado?>" <? if($ordenar_por=="nro" && $orden=="DESC") echo "selected"; ?>>NRO INFORME</option>
<option value="<?=$link_modulo?>?path=<?=$link_actual?>&ordenar_por=inicio&orden=DESC&nro_por_pagina=<?=$nro_por_pagina?>&nro=<?=$nro?>&ubicacion=<?=$ubicacion?>&producto=<?=$producto?>&caracteristicas=<?=$caracteristicas?>&funcionario=<?=$funcionario?>&tecnico=<?=$tecnico?>&revision=<?=$revision?>&estado=<?=$estado?>" <? if($ordenar_por=="inicio" && $orden=="DESC") echo "selected"; ?>>FECHA INICIO</option>
<option value="<?=$link_modulo?>?path=<?=$link_actual?>&ordenar_por=solucion&orden=DESC&nro_por_pagina=<?=$nro_por_pagina?>&nro=<?=$nro?>&ubicacion=<?=$ubicacion?>&producto=<?=$producto?>&caracteristicas=<?=$caracteristicas?>&funcionario=<?=$funcionario?>&tecnico=<?=$tecnico?>&revision=<?=$revision?>&estado=<?=$estado?>" <? if($ordenar_por=="solucion" && $orden=="DESC") echo "selected"; ?>>FECHA SOLUCION</option>
</select></td>
<td class="marco">
<form name="amper2" method="GET" action="<?=$link_modulo?>">
<input type="hidden" name="path" value="<?=$link_actual?>"/>
<input type="hidden" name="nro" value="<?=$nro?>"/>
<input type="hidden" name="nro_por_pagina" value="<?=$nro_por_pagina?>"/>
<input type="hidden" name="ordenar_por" value="<?=$ordenar_por?>"/>
<input type="hidden" name="orden" value="<?=$orden?>"/>
<input type="hidden" name="departamento" value="<?=$departamento?>"/>
<input type="hidden" name="producto" value="<?=$producto?>"/>
<input type="hidden" name="caracteristicas" value="<?=$caracteristicas?>"/>
<input type="hidden" name="funcionario" value="<?=$funcionario?>"/>
<input type="hidden" name="tecnico" value="<?=$tecnico?>"/>
<input type="hidden" name="revision" value="<?=$revision?>"/>
<input type="hidden" name="estado" value="<?=$estado?>"/>
<img src="../../img/ico_buscar.gif" width="19" height="19"  align="absbottom"> 
<input name="ubicacion" type="text" class="Text_left" size="20" onFocus="if(this.value=='[Buscar Estacion]') this.value='';" onBlur="if(this.value=='') this.value='[Buscar Estacion]';" value="[Buscar Estacion]"  />
</form></td>
<td class="marco"><img src="../../img/filtrar_s.gif" alt="Filtrar NIVEL CLIENTE" border="0" align="absmiddle" />
  <select name="ubicacion" class="buscar" onchange='document.location=this.options[this.selectedIndex].value'>
    <option class="title7" value="<?=$link_modulo?>?path=<?=$link_actual?>&ordenar_por=<?=$ordenar_por?>&orden=<?=$orden?>&nro_por_pagina=<?=$nro_por_pagina?>&nro=<?=$nro?>&ubicacion=<?=$ubicacion?>&producto=<?=$producto?>&departamento=&caracteristicas=<?=$caracteristicas?>&funcionario=<?=$funcionario?>&tecnico=<?=$tecnico?>&revision=<?=$revision?>&estado=<?=$estado?>">Dpto: Todos </option>
<?
$resultado=mysql_query("SELECT descripcion FROM parametrica WHERE grupo='depto'");
while($dato=mysql_fetch_array($resultado))
{ ?> <option value="<?=$link_modulo?>?path=<?=$link_actual?>&ordenar_por=<?=$ordenar_por?>&orden=<?=$orden?>&nro_por_pagina=<?=$nro_por_pagina?>&nro=<?=$nro?>&ubicacion=<?=$ubicacion?>&departamento=<?=$dato['descripcion']?>&producto=<?=$producto?>&caracteristicas=<?=$caracteristicas?>&funcionario=<?=$funcionario?>&tecnico=<?=$tecnico?>&revision=<?=$revision?>&estado=<?=$estado?>" <? if($departamento==$dato['descripcion']) echo "selected"; ?>><?=$dato['descripcion']?></option> <? }	  
?>
  </select></td>
<td class="marco"><img src="../../img/filtrar_s.gif" alt="Filtrar NIVEL CLIENTE" border="0" align="absmiddle" />
  <select name="producto" class="buscar" onchange='document.location=this.options[this.selectedIndex].value'>
    <option class="title7" value="<?=$link_modulo?>?path=<?=$link_actual?>&ordenar_por=<?=$ordenar_por?>&orden=<?=$orden?>&nro_por_pagina=<?=$nro_por_pagina?>&nro=<?=$nro?>&ubicacion=<?=$ubicacion?>&departamento=<?=$departamento?>&caracteristicas=<?=$caracteristicas?>&funcionario=<?=$funcionario?>&tecnico=<?=$tecnico?>&producto=&revision=<?=$revision?>&estado=<?=$estado?>">Prod/Serv: Todos </option>
<?
$resultado=mysql_query("SELECT sub_grupo FROM parametrica WHERE grupo='st_archivo'");
while($dato=mysql_fetch_array($resultado))
{ ?> <option value="<?=$link_modulo?>?path=<?=$link_actual?>&ordenar_por=<?=$ordenar_por?>&orden=<?=$orden?>&nro_por_pagina=<?=$nro_por_pagina?>&nro=<?=$nro?>&ubicacion=<?=$ubicacion?>&departamento=<?=$departamento?>&producto=<?=$dato['sub_grupo']?>&caracteristicas=<?=$caracteristicas?>&funcionario=<?=$funcionario?>&tecnico=<?=$tecnico?>&revision=<?=$revision?>&estado=<?=$estado?>" <? if($producto==$dato['sub_grupo']) echo "selected"; ?>><?=$dato['sub_grupo']?></option> <? }	  
?>
  </select>
</td>
</tr>
</table>
<table border="0" align="center">	
<tr>
<td class="marco">
<form name="amper3" method="GET" action="<?=$link_modulo?>">
<input type="hidden" name="path" value="<?=$link_actual?>" />
<input type="hidden" name="nro" value="<?=$nro?>"/>
<input type="hidden" name="nro_por_pagina" value="<?=$nro_por_pagina?>"/>
<input type="hidden" name="ordenar_por" value="<?=$ordenar_por?>"/>
<input type="hidden" name="orden" value="<?=$orden?>"/>
<input type="hidden" name="ubicacion" value="<?=$ubicacion?>"/>
<input type="hidden" name="departamento" value="<?=$departamento?>"/>
<input type="hidden" name="producto" value="<?=$producto?>"/>
<input type="hidden" name="funcionario" value="<?=$funcionario?>"/>
<input type="hidden" name="tecnico" value="<?=$tecnico?>"/>
<input type="hidden" name="revision" value="<?=$revision?>"/>
<input type="hidden" name="estado" value="<?=$estado?>"/>
<img src="../../img/ico_buscar.gif" width="19" height="19"  align="absbottom"> 
<input name="caracteristicas" type="text" class="Text_left" size="20" onFocus="if(this.value=='[Buscar Detalles]') this.value='';" onBlur="if(this.value=='') this.value='[Buscar Detalles]';" value="[Buscar Detalles]"  />
</form></td>
<td class="marco">
<form name="amper4" method="GET" action="<?=$link_modulo?>">
<input type="hidden" name="path" value="<?=$link_actual?>" />
<input type="hidden" name="nro" value="<?=$nro?>"/>
<input type="hidden" name="nro_por_pagina" value="<?=$nro_por_pagina?>"/>
<input type="hidden" name="ordenar_por" value="<?=$ordenar_por?>"/>
<input type="hidden" name="orden" value="<?=$orden?>"/>
<input type="hidden" name="ubicacion" value="<?=$ubicacion?>"/>
<input type="hidden" name="departamento" value="<?=$departamento?>"/>
<input type="hidden" name="producto" value="<?=$producto?>"/>
<input type="hidden" name="caracteristicas" value="<?=$caracteristicas?>"/>
<input type="hidden" name="tecnico" value="<?=$tecnico?>"/>
<input type="hidden" name="revision" value="<?=$revision?>"/>
<input type="hidden" name="estado" value="<?=$estado?>"/>
<img src="../../img/ico_buscar.gif" width="19" height="19"  align="absbottom"> 
<input name="funcionario" type="text" class="Text_left" size="20" onFocus="if(this.value=='[Buscar funcionario]') this.value='';" onBlur="if(this.value=='') this.value='[Buscar funcionario]';" value="[Buscar funcionario]"  />
</form></td>
<td class="marco"><img src="../../img/filtrar_s.gif" alt="Filtrar" border="0" align="absmiddle" />
  <select name="tecnico" class="buscar" onchange='document.location=this.options[this.selectedIndex].value'>
    <option class="title7" value="<?=$link_modulo?>?path=<?=$link_actual?>&ordenar_por=<?=$ordenar_por?>&orden=<?=$orden?>&nro_por_pagina=<?=$nro_por_pagina?>&nro=<?=$nro?>&ubicacion=<?=$ubicacion?>&producto=<?=$producto?>&departamento=<?=$departamento?>&caracteristicas=<?=$caracteristicas?>&funcionario=<?=$funcionario?>&tecnico=&revision=<?=$revision?>&estado=<?=$estado?>">Tecnico: Todos </option>
<?
$resultado=mysql_query("SELECT id,concat(nombre, ' ', ap_pat) AS usuario FROM usuarios WHERE nivel='2'");
while($dato=mysql_fetch_array($resultado))
{ ?> <option value="<?=$link_modulo?>?path=<?=$link_actual?>&ordenar_por=<?=$ordenar_por?>&orden=<?=$orden?>&nro_por_pagina=<?=$nro_por_pagina?>&nro=<?=$nro?>&ubicacion=<?=$ubicacion?>&departamento=<?=$departamento?>&producto=<?=$producto?>&caracteristicas=<?=$caracteristicas?>&funcionario=<?=$funcionario?>&tecnico=<?=$dato['usuario']?>&revision=<?=$revision?>&estado=<?=$estado?>" <? if($tecnico==$dato['usuario']) echo "selected"; ?>><?=$dato['usuario']?></option> <? }	  
?>
  </select></td>
<td class="marco"><img src="../../img/filtrar_s.gif" alt="Filtrar" border="0" align="absmiddle" />
  <select name="revision" class="buscar" onchange='document.location=this.options[this.selectedIndex].value'>
    <option class="title7" value="<?=$link_modulo?>?path=<?=$link_actual?>&ordenar_por=<?=$ordenar_por?>&orden=<?=$orden?>&nro_por_pagina=<?=$nro_por_pagina?>&nro=<?=$nro?>&ubicacion=<?=$ubicacion?>&producto=<?=$producto?>&departamento=<?=$departamento?>&caracteristicas=<?=$caracteristicas?>&funcionario=<?=$funcionario?>&tecnico=<?=$tecnico?>&revision=&estado=<?=$estado?>">Informe: Todos </option>
<option value="<?=$link_modulo?>?path=<?=$link_actual?>&ordenar_por=<?=$ordenar_por?>&orden=<?=$orden?>&nro_por_pagina=<?=$nro_por_pagina?>&nro=<?=$nro?>&ubicacion=<?=$ubicacion?>&producto=<?=$producto?>&departamento=<?=$departamento?>&caracteristicas=<?=$caracteristicas?>&funcionario=<?=$funcionario?>&tecnico=<?=$tecnico?>&revision=E&estado=<?=$estado?>" <? if($revision=="E") echo "selected"; ?>>Terminados y enviados</option>
<option value="<?=$link_modulo?>?path=<?=$link_actual?>&ordenar_por=<?=$ordenar_por?>&orden=<?=$orden?>&nro_por_pagina=<?=$nro_por_pagina?>&nro=<?=$nro?>&ubicacion=<?=$ubicacion?>&producto=<?=$producto?>&departamento=<?=$departamento?>&caracteristicas=<?=$caracteristicas?>&funcionario=<?=$funcionario?>&tecnico=<?=$tecnico?>&revision=R&estado=<?=$estado?>" <? if($revision=="R") echo "selected"; ?>>Pendientes de Revision</option>
<option value="<?=$link_modulo?>?path=<?=$link_actual?>&ordenar_por=<?=$ordenar_por?>&orden=<?=$orden?>&nro_por_pagina=<?=$nro_por_pagina?>&nro=<?=$nro?>&ubicacion=<?=$ubicacion?>&producto=<?=$producto?>&departamento=<?=$departamento?>&caracteristicas=<?=$caracteristicas?>&funcionario=<?=$funcionario?>&tecnico=<?=$tecnico?>&revision=0&estado=<?=$estado?>" <? if($revision=="0") echo "selected"; ?>>Informes Pendientes</option>
</select></td>
<td class="marco"><img src="../../img/filtrar_s.gif" alt="Filtrar" border="0" align="absmiddle" />
  <select name="revision" class="buscar" onchange='document.location=this.options[this.selectedIndex].value'>
    <option class="title7" value="<?=$link_modulo?>?path=<?=$link_actual?>&ordenar_por=<?=$ordenar_por?>&orden=<?=$orden?>&nro_por_pagina=<?=$nro_por_pagina?>&nro=<?=$nro?>&ubicacion=<?=$ubicacion?>&producto=<?=$producto?>&departamento=<?=$departamento?>&caracteristicas=<?=$caracteristicas?>&funcionario=<?=$funcionario?>&tecnico=<?=$tecnico?>&revision=<?=$revision?>&estado=">Estado: Todos </option>
<option value="<?=$link_modulo?>?path=<?=$link_actual?>&ordenar_por=<?=$ordenar_por?>&orden=<?=$orden?>&nro_por_pagina=<?=$nro_por_pagina?>&nro=<?=$nro?>&ubicacion=<?=$ubicacion?>&producto=<?=$producto?>&departamento=<?=$departamento?>&caracteristicas=<?=$caracteristicas?>&funcionario=<?=$funcionario?>&tecnico=<?=$tecnico?>&revision=<?=$revision?>&estado=OK" <? if($estado=="OK") echo "selected"; ?>>Conformes (OK)</option>
<option value="<?=$link_modulo?>?path=<?=$link_actual?>&ordenar_por=<?=$ordenar_por?>&orden=<?=$orden?>&nro_por_pagina=<?=$nro_por_pagina?>&nro=<?=$nro?>&ubicacion=<?=$ubicacion?>&producto=<?=$producto?>&departamento=<?=$departamento?>&caracteristicas=<?=$caracteristicas?>&funcionario=<?=$funcionario?>&tecnico=<?=$tecnico?>&revision=<?=$revision?>&estado=Pendiente" <? if($estado=="Pendiente") echo "selected"; ?>>Pendientes</option>
<option value="<?=$link_modulo?>?path=<?=$link_actual?>&ordenar_por=<?=$ordenar_por?>&orden=<?=$orden?>&nro_por_pagina=<?=$nro_por_pagina?>&nro=<?=$nro?>&ubicacion=<?=$ubicacion?>&producto=<?=$producto?>&departamento=<?=$departamento?>&caracteristicas=<?=$caracteristicas?>&funcionario=<?=$funcionario?>&tecnico=<?=$tecnico?>&revision=<?=$revision?>&estado=Irreparable" <? if($estado=="Irreparable") echo "selected"; ?>>Irreparable</option>
<option value="<?=$link_modulo?>?path=<?=$link_actual?>&ordenar_por=<?=$ordenar_por?>&orden=<?=$orden?>&nro_por_pagina=<?=$nro_por_pagina?>&nro=<?=$nro?>&ubicacion=<?=$ubicacion?>&producto=<?=$producto?>&departamento=<?=$departamento?>&caracteristicas=<?=$caracteristicas?>&funcionario=<?=$funcionario?>&tecnico=<?=$tecnico?>&revision=<?=$revision?>&estado=postok" <? if($estado=="postok") echo "selected"; ?>>Post-OK</option>
</select></td>
</tr>
</table></td>
  </tr>
</table>
<table width="98%" cellspacing="1" class="table4" align="center">
  <tr>
    <td colspan="9" class="paginado">
        <div align="left"><?=$txt?></div>
    </td>
    <td colspan="3" class="paginado"><?
$rs = new paginado($conexion);
$rs->pagina($pagina);
$rs->porPagina($nro_por_pagina);
$rs->propagar("nro");
$rs->propagar("path");
$rs->propagar("nro_por_pagina");
$rs->propagar("ordenar_por");
$rs->propagar("orden");
$rs->propagar("ubicacion");
$rs->propagar("departamento");
$rs->propagar("producto");
$rs->propagar("caracteristicas");
$rs->propagar("funcionario");
$rs->propagar("tecnico");
$rs->propagar("revision");
$rs->propagar("estado");

if(!$rs->query($sql))
{    die( $rs->error() );
}
echo "Mostrando ".$rs->desde()." - ".$rs->hasta()." de un total de ".$rs->total()."<br>";
$i=$rs->desde();
?></td>
  </tr>
  <tr>
    <th width="2%">N&deg;</th>
    <th width="7%">Nro INF </th>
    <th width="6%">FECHA INICIO </th>
    <th width="6%">FECHA SOLUCION </th>
    <th width="12%">ESTACION</th>
    <th width="12%">PROD/SERV</th>
    <th width="11%">DETALLES</th>
    <th width="9%">FUNCIONARIO</th>
    <!--<th width="6%">PERSONAL</th>-->
    <th width="8%">TICKET</th>
    <th width="12%">INFORME</th>
    <th width="5%">ESTADO</th>
	<th width="7%">REVISION</th>
  </tr>
  <tbody>
<?


while($row = $rs->obtenerArray())
{
/* ----------------------------------- */
$resultado_rev=mysql_query("SELECT DISTINCT cuenta
		                    FROM st_revision_cliente WHERE id_st_cronograma_informes = '".$row['nro']."'");
$rev_html = "<br />";
if(mysql_num_rows($resultado_rev) !=0 ){
	while($d1=mysql_fetch_array($resultado_rev)){
		$res_aux = mysql_query("SELECT cuenta, estado
				FROM st_revision_cliente
				WHERE id_st_cronograma_informes = '".$row['nro']."'
				AND cuenta = '".$d1['cuenta']."' ORDER BY `id_st_revision_cliente` DESC LIMIT 1;");
						
		while($d2 = mysql_fetch_array($res_aux)){
			if($d2['estado'] == '1'){
				$rev_html .= $d2['cuenta']."&nbsp;<img src='../../img/concluido.gif' ><br />";	
			}else{
				$rev_html .= $d2['cuenta']."&nbsp;<img src='../../img/pendiente.gif' ><br />";
				//$rev_html .= $d2['cuenta']."(".$d2['estado'].")<br />";	
			}
		}
		
	}	
}
/* ----------------------------------- */

///////////
$img='';
$cliente=$row['razon_social'];
$condicion_final=$row['condicion_final'];
$postm_condicion_final=$row['postm_condicion_final'];
$pro_key=$row['form'];
$id_st_cronograma_informes=$row['nro'];
$pasos=$row['pasos'];
if($pasos=='') $pasos=0;
$id_usuario=$row['id_usuario'];
$id_item=$row['id_item'];

if($ubicacion!="") { $row['ubicacion']=eregi_replace ($ubicacion,"<span class='marcar'>".$ubicacion."</span>",$row['ubicacion']); }
if($departamento!="") { $row['departamento']=eregi_replace ($departamento,"<span class='marcar'>".$departamento."</span>",$row['departamento']); }
if($producto!="") { $row['producto']=eregi_replace ($producto,"<span class='marcar'>".$producto."</span>",$row['producto']); }
if($caracteristicas!="") { $row['caracteristicas']=eregi_replace ($caracteristicas,"<span class='marcar'>".$caracteristicas."</span>",$row['caracteristicas']); }
if($funcionario!="") { $row['funcionario']=eregi_replace ($funcionario,"<span class='marcar'>".$funcionario."</span>",$row['funcionario']); }
if($tecnico!="") { $row['personal']=eregi_replace ($tecnico,"<span class='marcar'>".$tecnico."</span>",$row['personal']); }
	 
	 if($i%2==0)
	{
	$rowt="#f6f7f8";
	}
	else
	{
	$rowt="#f1f1f1";
	}
	$nro_inf=strtoupper($pro_key).str_pad($id_st_cronograma_informes, 4, "0", STR_PAD_LEFT);

 switch($pro_key){
					case "f001" :
					  switch($pasos)
					  {
					  case '3' : $link="f001_3"; break;
					  case '2' : $link="f001_3"; break;
					  case '1' : $link="f001_2"; break;
					  default: $link="f001_1";
					  }
					  $npasos=3;
					break;
					case "f002" : 
	  				  switch($pasos)
					  {
					  case '3' : $link="f002_3"; break;
					  case '2' : $link="f002_3"; break;
					  case '1' : $link="f002_2"; break;
					  default: $link="f002_1";
					  }
					  $npasos=3;
					break;									
					case "f003" : 
	  				  switch($pasos)
					  {
					  case '3' : $link=$pro_key."_3"; break;
					  case '2' : $link=$pro_key."_3"; break;
					  case '1' : $link=$pro_key."_2"; break;
					  default: $link=$pro_key."_1";
					  }
					  $npasos=3;
					break;														
					}
					
		  
		  $edit_p=" <a class=\"enlaceboton\" href='".$link_modulo_r."?path=trabajos_reprogramar.php&id_st_cronograma_informes=".$id_st_cronograma_informes."&pro_key=".$pro_key."' title='Reprogramar tarea' onclick=\"return GB_showCenter('Ver Actividades', this.href,460, 460)\"><img src='../../img/change.gif' border=\"0\"></a>";	
		  $link=$link_modulo."?path=trabajos_informar_".$link.".php&id_st_cronograma_informes=".$id_st_cronograma_informes;
		  
	

	
	 if($condicion_final!=NULL && $condicion_final!=""){     
	switch($condicion_final){
	case 'OK' : $img="<img src='../../img/semaforo_verde.gif' border=\"0\" width=\"46\" height=\"16\" align=\"absmiddle\" alt='Estado: OK'>"; break;
	case 'Pendiente' : 
	if($postm_condicion_final=="OK+") {
	$img="<img src='../../img/semaforo_azul.gif' border=\"0\" width=\"62\" height=\"16\" align=\"absmiddle\" alt='Estado: OK $postm_fecha'>";
	$condicion_final=$postm_condicion_final;
	}		
		else $img="<img src='../../img/semaforo_amarillo.gif' border=\"0\" width=\"46\" height=\"16\" align=\"absmiddle\" alt='Estado: Pendiente'>"; break;
	case 'Irreparable' : 
	if($postm_condicion_final=="OK+") {
	$img="<img src='../../img/semaforo_azul.gif' border=\"0\" width=\"62\" height=\"16\" align=\"absmiddle\" alt='Estado: OK $postm_fecha'>";
	$condicion_final=$postm_condicion_final;
	}		
		else $img="<img src='../../img/semaforo_rojo.gif' border=\"0\" width=\"46\" height=\"16\" align=\"absmiddle\" alt='Estado: Irreparable'>"; break;
	default: $img='&nbsp;';
	}	
	}

?>
    <tr bgcolor="<?=$rowt?>" onmouseover="setPointer(this, '#DADADA')" onmouseout="setPointer(this, '<?=$rowt?>')">
      <td class="cafe"><div align="RIGHT">
        <?=$i?>
      </div></td>
      <td><div align="CENTER">
      	  <? 
      	  if($row['nro']<90){
      	  	echo "<a class=\"enlaceboton\" href='../../archivos_st/ST00028/201401/$nro_inf.pdf' onClick=\"openNewWindowhtml( this, '800', '590' );return false;\"><img src='../../img/imp.gif' alt='Ver Informe en PDF' border=\"0\"></a>";
      	  	echo "<B class='negro'>$nro_inf</B>*";
      	  }else{
      	  ?>
      	  <? echo"<a class=\"enlaceboton\" href='../../pdf/pdf_st_".$pro_key.".php?id_st_cronograma_informes=".base64_encode($id_st_cronograma_informes)."' onClick=\"openNewWindowhtml( this, '800', '590' );return false;\"><img src='../../img/imp.gif' alt='Ver Informe en PDF' border=\"0\"></a>";?>
      	  <B class="negro"><?=$nro_inf?></B>
      	  <? } ?>
      	  </div>
      </td>
      <td class="negro"><div align="center">
        <?=$row['inicio']?>
      </div></td>
      <td><div align="center">
        <?=$row['solucion']?>
      </div></td>
        <?php

            if (is_null($row['idestacion'])){
                $estacion = $row['ubicacion'];
            }else{
                $idestacion = $row['idestacion'];
                $res  = mysql_query("SELECT nombre FROM estacion where idestacion = ".$idestacion);
                $dato = mysql_fetch_array($res);
                $estacion = $dato['nombre'];
            }


        ?>


      <td><? /*echo"<a href='".$link_modulo_r."?path=trabajos_visitas_ver.php&id_item=".$id_item."' onclick=\"return GB_showCenter('Ver Actividades', this.href,460, 460)\" class='enlace_oculto'>
	                <img src='../../img/tarea.gif' alt='Programar Actividades' border=\"0\" align=\"absmiddle\"> ".$row['ubicacion']."</a>";
	        */
            echo"<a href='".$link_modulo_r."?path=trabajos_visitas_ver.php&id_item=".$id_item."' onclick=\"return GB_showCenter('Ver Actividades', this.href,460, 460)\" class='enlace_oculto'>
	                <img src='../../img/tarea.gif' alt='Programar Actividades' border=\"0\" align=\"absmiddle\"> ".$estacion."</a>";

          ?>
      </td>
      <!--<td><?=$row['departamento']?></td>-->
      <td><div align="center">
        <?=$row['producto']?>
      </div></td>
      <td><?=$row['caracteristicas']?></td>
      <td><?=$row['funcionario']?></td>
      <!--<td><?=$row['personal']?></td>-->
      <td><?=$row['nro_ticket']?></td>
      <td align="center"><?
	switch($row['revision']){
	case 'R': 
	if($adm){
	echo"<a class=\"enlaceboton\" href='".$link."' target='_top'><img src='../../img/tarea.gif' alt='dar Informe' border=\"0\"><span class='naranja'> Pendiente de Revision</span></a>";
	}
	else{
	echo"<span class='naranja'>Pendiente de Revision</span>";
	}
	break;
	case 'E':  
	if($adm){
	echo"<img src='../../img/ejecutado.gif' border=\"0\">".'<label title="REVISADO Y ENVIADO" class="verde">Terminado</label>'; echo"<a title='EDITAR INFORME TERMINADO' class=\"listing\" href='".$link."' target='_top'><img src='../../img/change.gif' border=\"0\">Informe</a>"; 
	}
	else{
		echo"<img src='../../img/ejecutado.gif' border=\"0\"><span class='verde'>Terminado</span>";
	}
	break;
	default: if($id_user==$id_usuario || $adm==1) { 
					
				  echo"<a class=\"enlaceboton\" href='".$link."' target='_top'><img src='../../img/tarea.gif' alt='dar Informe' border=\"0\"> Llenar Informe </a>".$pasos."/".$npasos; echo $edit_p; }
				  else echo"Otro tecnico a cargo";
	}
	?></td>
      <td><?=$img?></td>
	  <td>
	  <?
		if($nively=='3' && $row['revision']=='E' && $row['revision_ext']==0){
			echo "<a class=\"naranja\" href='$link_modulo?path=html_st_".$pro_key."_r1.php&id_st_cronograma_informes=".base64_encode($id_st_cronograma_informes)."&id_item=".base64_encode($dato['id_item'])."'>Revisi&oacute;n</a>";
			
			
		}else{
			if($row['revision_ext']==1 && $nively=='3'){
				echo "<a class=\"enlacebotonverde\" href='$link_modulo?path=html_st_".$pro_key."_r1.php&id_st_cronograma_informes=".base64_encode($id_st_cronograma_informes)."&id_item=".base64_encode($dato['id_item'])."'>Revisi&oacute;n</a>";
				echo $rev_html;
			}
			if($row['revision_ext']==1 && $nively=='1'){
				echo "<a class=\"enlacebotonverde\" href='$link_modulo?path=html_st_".$pro_key."_r1.php&id_st_cronograma_informes=".base64_encode($id_st_cronograma_informes)."&id_item=".base64_encode($dato['id_item'])."'>Revisi&oacute;n</a>";
				echo $rev_html;
			}
		}
	  ?>
	  </td>
    </tr>
    <?
$i++;
 }
?>
  </tbody>
  <tfoot>
    <tr>
      <td colspan="13" class="paginado"><?
echo $rs->anterior()." - ".$rs->nroPaginas()." - ".$rs->siguiente();
?></td>
    </tr>
  </tfoot>
</table>
<table width="98%" align="center" class="table3">
  <tr>
    <td><strong class="rojo">Declaraci&oacute;n del proyecto:</strong><br>
      <span class="small">
      <?=nl2br($declaracion_proyecto);?>
    </span></td>
  </tr>
</table>
<link href="../../paquetes/greybox/gb_styles.css" rel="stylesheet" type="text/css" media="all" />
    <script type="text/javascript">
        var GB_ROOT_DIR = "./../../paquetes/greybox/";
</script>		
	<script type="text/javascript" src="../../paquetes/greybox/AJS.js"></script>
    <script type="text/javascript" src="../../paquetes/greybox/AJS_fx.js"></script>
    <script type="text/javascript" src="../../paquetes/greybox/gb_scripts_no_reload.js"></script>