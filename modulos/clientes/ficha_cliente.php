<?
require("../../funciones/motor.php");
$id1 = $_GET['id1'];
$id2 = $_GET['id2'];
$sql="SELECT nombre,cargo,dpto,telf,celular,email,fax,obs,fecha_registro,id_user FROM contactos WHERE id=".$id1." AND id_cliente='".$id2."'";
$resultado=mysql_query($sql);
$dato=mysql_fetch_array($resultado);
$nombre=$dato[0];
$cargo=utf8_encode($dato[1]);
$dpto=utf8_encode($dato[2]);
$telf=$dato[3];
$celular=$dato[4]; 
$email=$dato[5];
$fax=$dato[6];
$obs=utf8_encode(nl2br($dato[7]));
?>	
	
	<table width="350" class="table2">
	<tbody>
	<tr>
	<th colspan="2" height="20"><img src="../../img/user.gif" width="16" height="16" border="0" align="absbottom" /> CONTACTO:
	<?=$nombre?></th>
	</tr>
	<tr>
	<th width="110" height="20">Cargo:</th>
	<td width="237" height="20"><?=$cargo?></td>
	</tr>
	<tr>
	<th height="20">Departamento:</th>
	<td height="20"><?=$dpto?></td>
	</tr>
	<tr>
	<th height="20">Telefono:</th>
	<td height="20"><?=$telf?></td>
	</tr>
	<tr>
	<th height="20">Celular:</th>
	<td height="20"><?=$celular?></td>
	</tr>
	<tr>
	<th height="20">Email:</th>
	<td height="20"><?=$email?></td>
	</tr>
	<tr>
	<th height="20">Fax:</th>
	<td height="20"><?=$fax?></td>
	</tr>
	<tr>
	<th height="20">Observaci&oacute;n:</th>
	<td height="20"><?=$obs?></td>
	</tr>
	<tr>
	<th height="20">Modificado:</th>
	<td height="20">[<?=$dato['id_user']?>] <?=$dato['fecha_registro']?></td>
	</tr>
	</tbody>
	</table>
