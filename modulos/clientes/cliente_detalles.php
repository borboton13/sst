<link href="../../css/general.css" rel="stylesheet" type="text/css"><?
if (isset($_REQUEST['nro'])){
$nro = base64_decode($_REQUEST['nro']);
}

$priv=0;
if($id_user=='A01' || $id_user=='A33' || $id_user=='A19' || $id_user=='A14') { $priv=1;}

?>
<SCRIPT src="../../js/ajax_detalles.js" type=text/javascript></SCRIPT>
<? 
$consulta="SELECT c.razon_social, c.caracteristicas, c.nit, c.tcliente, c.area, c.direccion, c.pais, c.ciudad, c.nivel_cliente, CONCAT(u.nombre,' ',u.ap_pat) AS creador, c.fecha_crea, c.activo, CONCAT(uu.nombre,' ',uu.ap_pat) AS resp_mod, c.ult_fecha_mod, c.creador AS id_usuario
FROM clientes c, usuarios u, usuarios uu
WHERE u.id=c.creador AND c.resp_mod=uu.id AND
c.id='".$nro."'";
$resultado=mysql_query($consulta);
$filas=mysql_num_rows($resultado);
if($filas!=0)
{
$dato=mysql_fetch_array($resultado);
$rs = $dato[0];
$caracteristicas = nl2br($dato[1]);
$nit = $dato[2];
$tipoc = $dato[3];
$area = $dato[4];
$dir = nl2br($dato[5]);
$pais = $dato[6];
$ciudad = $dato[7];
$nivelc = $dato[8];
$creador = $dato[9];
$fechatiempo=$dato[10];
} 
?>				  
<table width="820" align="center" class="table3">
<caption>DETALLES CLIENTE</caption>
</table>
<table width="820" align="center">
<tr>
<td width="329" valign="top">


  <table width="329" border="0" class="table2">
<caption>DETALLES CLIENTE
<? if($priv==1 || $dato['id_usuario']==$id_user) {?>
<a href="clientes_r.php?path=cliente_modificar.php&id=<?=base64_encode($nro)?>" onclick="return GB_showCenter('Modificar Cliente', this.href,380, 470)" class="enlace_s_menu"><img src="../../img/change.gif" height="21" width="21" border="0" align="absmiddle"></a>	<?
	if($dato['activo']=='1')
	{
	?>
<a class="enlace_s_menu" href="clientes_r.php?path=cliente_poner_inactivo.php&id=<?=base64_encode($nro)?>" onclick="return confirm('AMPER SRL: Esta seguro que desea poner como Inactivo a <?=$dato['razon_social']?> ?');"><img src="../../img/ico_activo.gif" alt="Poner Como Inactivo" border="0"></a>
	<?
	}
	else{
	?>
<a class="enlace_s_menu" href="clientes_r.php?path=cliente_poner_activo.php&id=<?=base64_encode($nro)?>" onclick="return confirm('AMPER SRL: Esta seguro que desea poner como Inactivo a <?=$dato['razon_social']?>?');"><img src="../../img/ico_eliminado.gif" alt="Poner Como Activo" border="0"></a>
	
	<?
	}
	?>
<? } ?>	
	</caption>
<tbody>
<tr>
<th width="31%" height="20">Adicionado por:</th>
<td width="69%" height="20" ><?=$creador?></td>
</tr>
<tr>
<th width="31%" height="20">Codigo:</th>
<td width="69%" height="20" ><?=$nro?></td>
</tr>
<tr>
<th width="31%" height="20">Razon Social:</th>
<td height="20" class="resaltar"><?=$rs?></td>
</tr>	
<tr>
<th width="31%" height="20" >Nivel del Cliente:</th>
<td height="20"><img src="../../img/ico_start<?=$nivelc?>.gif" height="18" width="78" alt="Prioridad <?=$row['nivel_cliente']?> Estrellas"></td>
</tr>
<tr>
<th width="31%" height="20" >Tipo de Cliente:</th>
<td height="20"><?=$tipoc?></td>
</tr>  	
<tr>
<th width="31%" height="20" >Area:</th>
<td height="20"><?=$area?></td>
</tr>							
<tr>
<th width="31%" height="20" >Caracteristicas:</th>
<td height="20"><?=$caracteristicas?></td>
</tr>
<tr>
<th width="31%" height="20" >NIT:</th>
<td height="20"><?=$nit?></td>
</tr>
<tr>
<th width="31%" height="20" >Direcci&oacute;n:</th>
<td height="20"><?=$dir?></td>
</tr>
<tr>
<th width="31%" height="20" >Pais:</th>
<td height="20"><?=$pais?></td>
</tr>									
<tr>
<th width="31%" height="20" >Ciudad:</th>
<td height="20"><?=$ciudad?></td>
</tr>
<tr>
<th width="31%" height="20" >Fecha de creación:</th>
<td height="20"><?=$fechatiempo?></td>
</tr>
<tfoot>
<tr>
<td height="20" colspan="2">Responsable Ultima Modificación: <span class="cafe"><?=$dato['resp_mod']?></span><BR />Fecha Ultima Modificación: <span class="cafe"><?=$dato['ult_fecha_mod']?></span></td>
</tr>	
</tfoot>								
</tbody>
</table>
</td>
<td width="546" valign="top">
<table width="100%" class="table2">
<caption>CONTACTOS</caption>
<tr >
<th width="5%"  height="16">N&ordm;</th>
<th width="35%">NOMBRE</th>
<th width="16%">
<div align="center">TELEFONO</th>
<th width="41%"   >EMAIL</th>
<th width="3%"   ></th>
</tr>
    <?
$sql= mysql_query("SELECT nombre,telf,email,id FROM contactos WHERE id_cliente='$nro';"); //aki esta la var del sistema de JLMM 
$i=0;
while ($row=mysql_fetch_array($sql) ){ 
$i++;
$nombre_ = $row[0]; 
$telf_ = $row[1]; 
$email=$row[2];
if($email!="") $email ='<a href="mailto:'.$email.'" class="verde"><img src="../../img/ico_mail.gif" width="14" height="10" border="0" />'.$email.'</a>'; 
$id_ = $row[3]; 
	 if($i%2==0)
	{
	$rowt="#f1f1f1";
	}
	else
	{
	$rowt="#f6f7f8";
	}
?>
<tr bgcolor="<?=$rowt?>">
<td><?=$i?></td> 
<td><a href="#" class="enlaceboton" onmouseover="MostrarConsulta('<?=$id_?>','<?=$nro?>'); return false" onmouseout="limpiar('detalles');"><?=$nombre_?><img src="../../img/ico_ver_mas.gif" width="14" height="10" border="0" /></a></td> 
<td><center><?=$telf_?></center></td> 
<td><?=$email?></td>
<td>
<? if($priv==1 || $dato['id_usuario']==$id_user) {?>
<a href="clientes_r.php?path=cliente_contacto_modificar.php&id=<?=base64_encode($nro)?>&id_contact=<?=$id_?>" onclick="return GB_showCenter('Modificar Contacto de Cliente', this.href,380, 470)" class="enlace_s_menu" onmouseover="MostrarConsulta('<?=$id_?>','<?=$nro?>'); return false" onmouseout="limpiar('detalles');"><img src="../../img/change.gif" height="21" width="21" border="0" align="absmiddle"></a><a class="enlace_s_menu" href="clientes_r.php?path=cliente_contacto_eliminar.php&id=<?=base64_encode($nro)?>&id_contact=<?=$id_?>" onclick="return confirm('AMPER SRL: Esta seguro que desea eliminar al contacto: <?=$nombre_?> ?');"><img src="../../img/actionCancel.gif" alt="ELIMINAR CONTACTO" border="0"></a>
<? } ?>
</td> 
</tr>
<?
} 
?>
<? if($priv==1 || $dato['id_usuario']==$id_user) {?>
<tfoot><tr><td colspan="5" align="right"><a href="clientes_r.php?path=cliente_contacto_adicionar.php&id=<?=base64_encode($nro)?>" onclick="return GB_showCenter('Adicionar Contacto Cliente', this.href,380, 470)" class="enlace_s_menu"><b>Adicionar Contacto</b><img src="../../img/adicionar.gif" height="16" width="16" border="0" align="absmiddle"></a></td></tr></tfoot>				  
<? } ?>
</table>						  
<br>
<div id="detalles" align="center"></div>						  
</td>
</tr>
</table>
    <script type="text/javascript">
        var GB_ROOT_DIR = "./../../paquetes/greybox/";
    </script>

    <script type="text/javascript" src="../../paquetes/greybox/AJS.js"></script>
    <script type="text/javascript" src="../../paquetes/greybox/AJS_fx.js"></script>
    <script type="text/javascript" src="../../paquetes/greybox/gb_scripts.js"></script>
    <link href="../../paquetes/greybox/gb_styles.css" rel="stylesheet" type="text/css" media="all" />
