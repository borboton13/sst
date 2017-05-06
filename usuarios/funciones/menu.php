<?php
$menu="../../paquetes/menu/";
$mclientes="../modulos/clientes.php?path=";
$musuarios="../modulos/usuarios.php?path=";
$mst="../modulos/seguimiento_tecnico.php?path=";
$repo="../modulos/repositorio.php";
if($nively=='1') $admin  = true; else $admin  = false;
if($nively=='2') $tech   = true; else $tech   = false;
if($nively=='3') $client = true; else $client = false;

?>
<link rel="stylesheet" href="<?=$menu?>cbcscbmenu.css" type="text/css" />
<table width="100%" border="0" cellpadding="0" cellspacing="0">
<tr>
<td background="../../img/menu_fill.jpg" align="center">
<ul id="ebul_cbmenu_1" class="ebul_cbmenu" style="display: none;">
<? if($admin){?>
<li><span class="ebul_imgcbmenu16x16" style="background-image: url('<?=$menu?>cbsiicbmenu_1.gif')"></span><a href="<?=$mst?>nuevo.php">Crear Nuevo Proyecto</a></li>
<? } ?>
<li><span class="ebul_imgcbmenu16x16" style="background-image: url('<?=$menu?>cbsiicbmenu_2.gif')"></span><a href="<?=$mst?>ver.php">Ver Lista de proyectos</a></li>

<li><span class="ebul_imgcbmenu16x16" style="background-image: url('<?=$menu?>cbsiicbmenu_2.gif')"></span><a href="<?=$repo?>">Mantenimiento Preventivo</a></li>
</ul>
<ul id="ebul_cbmenu_6" class="ebul_cbmenu" style="display: none;">
<li><span class="ebul_imgcbmenu16x16" style="background-image: url('<?=$menu?>cbsiicbmenu_3.gif')"></span><a href="<?=$mclientes?>nuevo_cliente.php">Nuevo Cliente y Contacto</a></li>
<li><span class="ebul_imgcbmenu16x16" style="background-image: url('<?=$menu?>cbsiicbmenu_4.gif')"></span><a href="<?=$mclientes?>ver_clientes.php">Ver Clientes</a></li>
<li><span class="ebul_imgcbmenu16x16" style="background-image: url('<?=$menu?>cbsiicbmenu_5.gif')"></span><a href="<?=$mclientes?>contacto_nuevo.php">Nuevo Contacto</a></li>
<li><span class="ebul_imgcbmenu16x16" style="background-image: url('<?=$menu?>cbsiicbmenu_6.gif')"></span><a href="<?=$mclientes?>ver_contactos.php">Ver Contactos</a></li>
</ul>
<ul id="ebul_cbmenu_7" class="ebul_cbmenu" style="display: none;">
<? if($admin){?>
<li><span class="ebul_imgcbmenu16x16" style="background-image: url('<?=$menu?>cbsiicbmenu_7.gif')"></span><a href="<?=$musuarios?>nuevo_usuario.php">Nuevo Usuario</a></li>
<? }?>
<li><span class="ebul_imgcbmenu16x16" style="background-image: url('<?=$menu?>cbsiicbmenu_8.gif')"></span><a href="<?=$musuarios?>ver_usuarios.php">Ver Usuarios</a></li>
</ul>

<ul id="cbmenuebul_table" class="cbmenuebul_menulist" style="width: 900px; height: 26px;">
  <li class="spaced_li"><a><img id="cbi_cbmenu_1" src="<?=$menu?>ebbtcbmenu1_0.gif" name="ebbcbmenu_1" width="101" height="26" style="vertical-align: bottom;" border="0" alt="Proyectos" title="" /></a></li>

  <!--
  <li class="spaced_li"><a href="<?=$mst?>cronograma_ver.php"><img id="cbi_cbmenu_2" src="<?=$menu?>ebbtcbmenu2_0.gif" name="ebbcbmenu_2" width="126" height="26" style="vertical-align: bottom;" border="0" alt="Ver Cronograma" title="" /></a></li>
  -->
  
  <li class="spaced_li"><a href="<?=$mst?>cronograma_prev.php"><img id="cbi_cbmenu_2" src="<?=$menu?>ebbtcbmenu2_0.gif" name="ebbcbmenu_2" width="126" height="26" style="vertical-align: bottom;" border="0" alt="Cronograma" title="" /></a></li>
  
  <!--<li class="spaced_li"><a href="<?=$mst?>tareas_dia.php"><img id="cbi_cbmenu_3" src="<?=$menu?>ebbtcbmenu3_0.gif" name="ebbcbmenu_3" width="136" height="26" style="vertical-align: bottom;" border="0" alt="Ver Tareas del dia" title="" /></a></li> -->  
  <li class="spaced_li"><a href="<?=$mst?>tickets.php"><img id="cbi_cbmenu_3" src="<?=$menu?>ebbtcbmenu3_0.gif" name="ebbcbmenu_3" width="136" height="26" style="vertical-align: bottom;" border="0" alt="Ver Tareas del dia" title="" /></a></li> 
   <? if($admin){?><li class="spaced_li"><a href="<?=$mst?>veedor_ver.php"><img id="cbi_cbmenu_5" src="<?=$menu?>ebbtcbmenu5_0.gif" name="ebbcbmenu_5" width="77" height="26" style="vertical-align: bottom;" border="0" alt="Acceso" title="" /></a></li>
 <? } else { ?> <li class="spaced_li"><img id="cbi_cbmenu_5" src="<?=$menu?>ebbtcbmenu5_2.gif" name="ebbcbmenu_5" width="77" height="26" style="vertical-align: bottom;" border="0" alt="Acceso" title="" /></li><? } ?>
 <? if($admin){?>
  <li class="spaced_li"><a><img id="cbi_cbmenu_6" src="<?=$menu?>ebbtcbmenu6_0.gif" name="ebbcbmenu_6" width="89" height="26" style="vertical-align: bottom;" border="0" alt="Clientes" title="" /></a></li>
  <? }  else { ?> <li class="spaced_li"><img id="cbi_cbmenu_6" src="<?=$menu?>ebbtcbmenu6_2.gif" name="ebbcbmenu_6" width="89" height="26" style="vertical-align: bottom;" border="0" alt="Clientes" title="" /></li><? } ?>
<li class="spaced_li"><a><img id="cbi_cbmenu_7" src="<?=$menu?>ebbtcbmenu7_0.gif" name="ebbcbmenu_7" width="91" height="26" style="vertical-align: bottom;" border="0" alt="Usuarios" title="" /></a></li>
  <li><a href="../../salir.php"><img id="cbi_cbmenu_8" src="<?=$menu?>ebbtcbmenu8_0.gif" name="ebbcbmenu_8" width="109" height="26" style="vertical-align: bottom;" border="0" alt="Cerrar Sesion" title="" /></a></li>
</ul>    </td>
</tr>
<!--<tr><td background="../../img/menu_fill_down.jpg" height="30"></td></tr>-->
</table>
<script type="text/javascript" src="<?=$menu?>cbjscbmenu.js"></script>
