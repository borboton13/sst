<table width="880" align="center" >
<br>
	<tr>
	<td width="360" valign="top">
	<table width="100%" class="table3">
      <tr>
        <td colspan="3"><a href="<?=$link_modulo_r?>?path=veedor_nuevo.php" onClick="return GB_showCenter('Adicionar Cliente para acceso al Sistema', this.href,270, 462);" class="enlaceboton"><img src="../../img/adicionar.gif" alt="Adicionar Nuevo Veedor" border="0" align="absmiddle"> Adicionar Nuevo Veedor</a></td>
        </tr>
      <tr>
        <th width="7%"  >N&deg;</th>
        <th width="85%"  >CLIENTES</th>
        <th width="8%"  >&nbsp;</th>
      </tr>
	<? 
	$consulta="SELECT ST.id_cliente,U.razon_social FROM st_personal_veedor ST INNER JOIN clientes U ON ST.id_cliente=U.id GROUP BY ST.id_cliente ORDER BY ST.id_cliente ASC;";
	$resultado=mysql_query($consulta);
	$filas=mysql_num_rows($resultado);
	if($filas!=0)
	{ $i=0;
	while($dato=mysql_fetch_array($resultado))
	 {
	 $i++;
	 $id_cliente=$dato[0];
	 $razon_social=$dato[1];
	 if($i%2==0) $rowt="#f1f1f1";
	 else $rowt="#f6f7f8";
	?>	  
      <tr bgcolor="<?=$rowt;?>" onMouseOver="setPointer(this, '#DADADA')" onMouseOut="setPointer(this, '<?=$rowt;?>')">
        <td><div align="right"><?=$i;?></div>          </td>
        <td><a href="#" onClick="Ver_detalles('ver_veedores','<?=$id_cliente;?>');" class="enlaceboton">
          <?=$razon_social;?>
        </a></td>
        <td><a href="<?=$link_modulo_r?>?path=veedor_cliente_eliminar.php&id_cliente=<?=base64_encode($id_cliente);?>" onClick="return confirm('AMPER SRL: Esta seguro que desea eliminar: <?=$razon_social;?> ?');" class="enlaceboton"><img src="../../img/actionCancel.gif" alt="Eliminar Item" border="0"></a></td>
      </tr>
	 <?
	  }
	}
	 ?> 
    </table>
</td>	
	<td width="508" valign="top" class="table1"><span class="verde">Seleccione un cliente para ver los admitidos para ver los informes del sistema:
	  </span>
	  <div id="ver_veedores"></div>
	  <a class="enlaceboton" href="<?=$link_modulo_r?>?path=ver_historial_registros.php" onClick="openNewWindow( this, '640', '450' );return false;"><img src="../../img/informe_detalles.gif" alt="Ver Informe de Registros" border="0"> Ver historial de registros</a> | <a class="enlaceboton" href="<?=$link_modulo_r?>?path=ver_historial_registros_fallidos.php" onClick="openNewWindow( this, '620', '450' );return false;"><img src="../../img/informe_detalles.gif" alt="Ver Informe de Registros" border="0"> Ver intentos fallidos</a>
	  </td>
	</tr>
</table>
<script src="../../js/ajax_st_detalles.js" type=text/javascript></script>
<link href="../../paquetes/greybox/gb_styles.css" rel="stylesheet" type="text/css" media="all" />
    <script type="text/javascript">
        var GB_ROOT_DIR = "./../../paquetes/greybox/";
    </script>    
	<script type="text/javascript" src="../../paquetes/greybox/AJS.js"></script>
    <script type="text/javascript" src="../../paquetes/greybox/AJS_fx.js"></script>
    <script type="text/javascript" src="../../paquetes/greybox/gb_scripts_no_reload.js"></script>
</HTML>
