<?
if (isset($_GET['id'])){
$id = base64_decode($_GET['id']);
}
else { exit; }
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML><HEAD>
<TITLE>Amper :: Sistema Integrado Administrativo</TITLE>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../../css/general.css" rel="stylesheet" type="text/css">
<form name="amper" method="post" action="clientes_r.php" onSubmit=" return VerifyOne ();">
<input type="hidden" name="path" value="rm_cliente.php" />
<input type="hidden" name="id" value="<?=$id?>" />
<? 
$consulta="SELECT c.razon_social, c.caracteristicas, c.nit, c.tcliente, c.area, c.direccion, c.pais, c.ciudad, c.nivel_cliente, CONCAT(u.nombre,' ',u.ap_pat) AS creador, c.fecha_crea
FROM clientes c, usuarios u
WHERE u.id=c.creador AND
c.id='".$id."'";
$resultado=mysql_query($consulta);
$filas=mysql_num_rows($resultado);
if($filas!=0)
{
$dato=mysql_fetch_array($resultado);
$rs = $dato[0];
$caracteristicas = $dato[1];
$nit = $dato[2];
$tipoc = $dato[3];
$area = $dato[4];
$dir = $dato[5];
$pais = $dato[6];
$ciudad = $dato[7];
$nivelc = $dato[8];
$creador = $dato[9];
$fechatiempo=$dato[10];
} 
?>
<table width="450" align="center" class="table2">
<caption>
MODIFICAR&nbsp;DATOS CLIENTE 
</caption>
<tr>
<th width="36%" height="20">&nbsp;&nbsp;Adicionado por:</th>
<td width="64%" height="20" class="resaltar" ><?=$creador?></td>
</tr>
<tr>
<th width="36%" height="20"><span class="title4">*</span>Nombre/Razon Social:</th>
<td height="20" class="resaltar"><?=$rs?></td>
</tr>
<tr>
<th width="36%" height="20" ><span class="title4">*</span>Nivel del Cliente :</th>
<td height="20">
<select name="nivelc" class="buscar" style="WIDTH: 277px;">
<?
$resultado=mysql_query("SELECT sub_grupo FROM parametrica WHERE grupo='nivel_estrellas' ORDER BY sub_grupo"); 
while($dato=mysql_fetch_array($resultado))
if($nivelc==substr($dato['sub_grupo'],0,1)) echo "<option class='title7' selected>".$dato['sub_grupo']."</option>";
else echo "<option>".$dato['sub_grupo']."</option>";
?>
</select></td>
</tr>
<tr>
<th width="36%" height="20" ><span class="title4">*</span>Tipo de Cliente :</th>
<td height="20">
<select name="tipoc" class="buscar" style="WIDTH: 277px;">
<?
$resultado=mysql_query("SELECT sub_grupo FROM parametrica WHERE grupo='tipo_cliente' ORDER BY sub_grupo"); 
while($dato=mysql_fetch_array($resultado))
if($tipoc==$dato['sub_grupo']) echo "<option class='title7' selected>".$dato['sub_grupo']."</option>";
else echo "<option>".$dato['sub_grupo']."</option>";
?>
</select></td>
</tr>
<tr>
<th width="36%" height="20" ><span class="title4">*</span>Area:</th>
<td height="20">
<select name="area" class="buscar" style="WIDTH: 277px;">
<?
$resultado=mysql_query("SELECT sub_grupo FROM parametrica WHERE grupo='categoria' ORDER BY sub_grupo"); 
while($dato=mysql_fetch_array($resultado))
if($area==$dato['sub_grupo']) echo "<option class='title7' selected>".$dato['sub_grupo']."</option>";
else echo "<option>".$dato['sub_grupo']."</option>";
?>
</select></td>
</tr>
<tr>
<th width="36%" height="20" >&nbsp;&nbsp;Caracteristicas/ &nbsp;&nbsp;Rubro:</th>
<td height="20"><textarea name="caracteristicas" cols="43" rows="4" class="Text_left" id="obs"><?=$caracteristicas?></textarea></td>
</tr>
<tr>
<th width="36%" height="20" >&nbsp;&nbsp;NIT:</th>
<td height="20"><input name="nit" type="text" class="Text_left" id="telf" size="43" maxlength="20" value="<?=$nit?>"></td>
</tr>
<tr>
<th width="36%" height="20" >&nbsp;&nbsp;Direcci&oacute;n:</th>
<td height="20"><textarea name="dir" cols="43" rows="4" class="Text_left" id="car"><?=$dir?></textarea></td>
</tr>
<tr>
<th width="36%" height="20" ><span class="title4">*</span>Pais:</th>
<td height="20"><input name="pais" type="text" class="Text_left" id="telf" size="43" maxlength="30" value="<?=$pais?>" ></td>
</tr>
<tr>
<th width="36%" height="20" ><span class="title4">*</span>Ciudad:</th>
<td height="20"><input name="ciudad" type="text" class="Text_left" id="telf" size="43" maxlength="30" value="<?=$ciudad?>"></td>
</tr>
<tfoot>
<tr>
<td colspan="2"><div align="center">
  <input name="modificar_cliente" type="submit" value="Modificar" />
  <input name="Submit" type="reset" value="Cancelar" />
</div></td>
</tr></tfoot>
</table>		
</form>
</HEAD>
</HTML>
<SCRIPT src="../../js/validador.js" type=text/javascript></SCRIPT>
<SCRIPT type=text/javascript>
function VerifyOne () {
    if( checkField( document.amper.rs, isName, false ) &&
		checkField( document.amper.nit, isNumber, true )  &&
		checkField( document.amper.pais, isName, false ) &&
		checkField( document.amper.ciudad, isName, false )  &&
		checkField( document.amper.cnombre, isName, false ) &&
		checkField( document.amper.ctelf, isPhoneNumber, false ) &&
		checkField( document.amper.cmail, isEmail, true )
		)
		{		
										    
					if(confirm("Las datos Son válidos!\n Acepte para Modificar los Datos"))
					{return true;}
					else {return false;}																		
    }
else {	
return false;
     }
}
</SCRIPT>