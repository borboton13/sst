<?
require("../../funciones/motor.php");
if(isset($_GET["id_cliente"])) {
$id_cliente = $_GET["id_cliente"];
}
header("Expires: Tue, 03 Jul 2001 06:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache"); 

$dato=mysql_fetch_array(mysql_query("select razon_social FROM clientes WHERE id='".$id_cliente ."'"));
$razon_social=$dato[0];
?>
<table width="100%" class="table3">
<tr><td colspan="4" class="naranja"><?=$razon_social;?></td></tr>
<tr>
<th width="3%" height="16" >N&deg;</th>
<th width="52%"  >NOMBRE Y CORREO</th>			              
<th  width="36%"  >DESCRIPCION</th> 
<th  width="9%" ></th>
</tr>
	<? 
	$consulta="SELECT nombre_completo,correo,descripcion,id_st_personal_veedor FROM st_personal_veedor WHERE id_cliente='".$id_cliente."' ORDER BY nombre_completo ASC;";
	$resultado=mysql_query($consulta);
	$filas=mysql_num_rows($resultado);
	if($filas!=0)
	{ $i=0;
	while($dato=mysql_fetch_array($resultado))
	 {
	 $i++;
	 $nombre_completo=$dato[0];
	 $correo=$dato[1];
	 $descripcion=$dato[2];
	 $id_st_personal_veedor=$dato[3];
	 if($i%2==0) $rowt="#f1f1f1";
	 else $rowt="#f6f7f8";
	?>	  
      <tr bgcolor="<?=$rowt;?>" onmouseover="setPointer(this, '#DADADA')" onmouseout="setPointer(this, '<?=$rowt;?>')">
        <td><?=$i;?></td>
		<td><?=$nombre_completo;?><br /><a href="mailto:<?=$correo;?>" class="enlaceboton" title="Enviar Correo"><span class="title5"><?=$correo;?></span>
	    </a></td>
        <td><?=$descripcion;?></td>
        <td><center><? if($filas!=1) { ?><a href="#" onClick="Eliminar_cliente_contacto('ver_veedores','<?=base64_encode($id_st_personal_veedor);?>','<?=base64_encode($id_cliente);?>');" class="enlaceboton"><img src="../../img/actionCancel.gif" alt="Eliminar Usuario Admitido" border="0"></a><? }?><a class="enlaceboton" href="seguimiento_tecnico_r.php?path=ver_registros_usuario.php&id=<?=base64_encode($id_st_personal_veedor);?>" onClick="openNewWindow( this, '450', '450' );return false;"><img src="../../img/informe_detalles.gif" alt="Ver Informe de Registros" border="0"></a></center></td>
      </tr>
	 <?
	  }
	}
	 ?> 
</table>

