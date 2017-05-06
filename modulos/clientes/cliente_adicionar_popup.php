<?
session_start(); 
require("../../funciones/motor.php");
require("../../funciones/verificar_sesion.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="../../css/general.css" rel="stylesheet" type="text/css">
<title>Adicionar Cliente</title>
</head>

<body>
<form name="amper" method="post" action="cliente_adicionar_popup_r.php" onSubmit=" return VerifyOne ();">
<table width="900" align="center" class="table3">
<caption>
ADICIONAR CLIENTE Y CONTACTO 
</caption>
</table>
<table width="900" align="center">
<tr>
<td width="53%" height="255" valign="top"><table width="450" align="center" class="table2">
<caption>
&nbsp;DATOS CLIENTE 
</caption>
<tr>
<th width="35%" height="20">&nbsp;&nbsp;Adicionado por:</th>
<td width="65%" height="20" class="resaltar" ><?=$nombrec?></td>
</tr>
<tr>
<? $cliente = trim($_GET["cliente"]); ?>
<th width="35%" height="20"><span class="title4">*</span>Nombre/Razon Social :</th>
<td height="20"><input name="rs" type="text" class="Text_left" size="43" maxlength="60" value="<? echo $cliente; ?>"></td>
</tr>
<tr>
<th width="35%" height="20" ><span class="title4">*</span>Nivel del Cliente :</th>
<td height="20">
<select name="nivelc" class="buscar" style="WIDTH: 277px;">
<option value="0" class="title7" selected> Seleccionar </option>
<?
$resultado=mysql_query("SELECT sub_grupo FROM parametrica WHERE grupo='nivel_estrellas' ORDER BY sub_grupo"); 
while($dato=mysql_fetch_array($resultado))
echo "<option>".$dato['sub_grupo']."</option>";
?>
</select></td>
</tr>
<tr>
<th width="35%" height="20" ><span class="title4">*</span>Tipo de Cliente :</th>
<td height="20">
<select name="tipoc" class="buscar" style="WIDTH: 277px;">
<option value="0" class="title7" selected> Seleccionar </option>
<?
$resultado=mysql_query("SELECT sub_grupo FROM parametrica WHERE grupo='tipo_cliente' ORDER BY sub_grupo"); 
while($dato=mysql_fetch_array($resultado))
echo "<option>".$dato['sub_grupo']."</option>";
?>
</select></td>
</tr>
<tr>
<th width="35%" height="20" ><span class="title4">*</span>Area:</th>
<td height="20">
<select name="area" class="buscar" style="WIDTH: 277px;">
<option value="0" class="title7" selected> Seleccionar </option>
<?
$resultado=mysql_query("SELECT sub_grupo FROM parametrica WHERE grupo='categoria' ORDER BY sub_grupo"); 
while($dato=mysql_fetch_array($resultado))
echo "<option>".$dato['sub_grupo']."</option>";
?>
</select></td>
</tr>
<tr>
<th width="35%" height="20" >&nbsp;&nbsp;Caracteristicas/ &nbsp;&nbsp;Rubro:</th>
<td height="20"><textarea name="caracteristicas" cols="43" rows="4" class="Text_left" id="obs"></textarea></td>
</tr>
<tr>
<th width="35%" height="20" >&nbsp;&nbsp;NIT:</th>
<td height="20"><input name="nit" type="text" class="Text_left" id="telf" size="43" maxlength="20" ></td>
</tr>
<tr>
<th width="35%" height="20" >&nbsp;&nbsp;Direcci&oacute;n:</th>
<td height="20"><textarea name="dir" cols="43" rows="4" class="Text_left" id="car"></textarea></td>
</tr>
<tr>
<th width="35%" height="20" ><span class="title4">*</span>Pais:</th>
<td height="20"><input name="pais" type="text" class="Text_left" id="telf" value="Bolivia" size="43" maxlength="30" ></td>
</tr>
<tr>
<th width="35%" height="20" ><span class="title4">*</span>Ciudad:</th>
<td height="20"><input name="ciudad" type="text" class="Text_left" id="telf" size="43" maxlength="30" ></td>
</tr>
</table></td>
<td width="47%" valign="top">
  <table width="400" align="center" class="table2">
<caption>&nbsp;DATOS CONTACTO</caption>
<tr>                                 
<th width="31%" height="20"><span class="title4">*</span>Nombre:</th>
<td width="69%" height="20"><input name="cnombre" type="text" class="Text_left" id="nombre" size="40" maxlength="30"></td>
</tr>									
<tr>
<th width="31%" height="20" >&nbsp;&nbsp;Cargo:</th>
<td height="20"><input name="ccargo" type="text" class="Text_left" id="cargo" size="40" maxlength="50"></td>
</tr>
<tr>
<th width="31%" height="20" >&nbsp;&nbsp;Departamento: </th>
<td height="20"><input name="cdpto" type="text" class="Text_left" id="dpto" size="40" maxlength="20"></td>
</tr>
<tr>
<th width="31%" height="20" ><span class="title4">*</span>Telefono:</th>
<td height="20"><input name="ctelf" type="text" class="Text_center" id="telf" size="15" maxlength="12"></td>
</tr>
<tr>
<th width="31%" height="20" >&nbsp;&nbsp;Celular:</th>
<td height="20"><input name="ccel" type="text" class="Text_center" id="cel" size="15" maxlength="12"></td>
</tr>
<tr>
<th width="31%" height="20" >&nbsp;&nbsp;E-Mail:</th>
<td height="20"><input name="cmail" type="text" class="Text_left" id="mail" size="40" maxlength="50"></td>
</tr>
<tr>
<th width="31%" height="20" >&nbsp;&nbsp;Fax:</th>
<td height="20"><input name="cfax" type="text" class="Text_center" id="cel2" size="15" maxlength="12"></td>
</tr>																		
<tr>
<th width="31%" height="20" >&nbsp;&nbsp;Observaci&oacute;n:</th>
<td height="20"><textarea name="cobs" cols="40" rows="10" class="Text_left" id="obs"></textarea></td>
</tr>
</table>
</td>
</tr>
</table>
<table width="900" align="center" class="table3">
<tfoot>
<tr><td colspan="2" class="paginado"><center>
<input name="adicionar_cliente" type="submit" value="Adicionar" />
<input name="Submit" type="reset" value="Cancelar" />
</center></td></tr></tfoot>
</table>		
</form>
</body>
</html>
<SCRIPT src="../../js/validador.js" type=text/javascript></SCRIPT>
<SCRIPT type=text/javascript>
function VerifyOne () {
var s1 = document.amper.nivelc.selectedIndex;
var s2 = document.amper.tipoc.selectedIndex;
var s3 = document.amper.area.selectedIndex;
    if( checkField( document.amper.rs, isName, false ) &&
		checkField( document.amper.nit, isNumber, true )  &&
		checkField( document.amper.pais, isName, false ) &&
		checkField( document.amper.ciudad, isName, false )  &&
		checkField( document.amper.cnombre, isName, false ) &&
		checkField( document.amper.ctelf, isPhoneNumber, false ) &&
		checkField( document.amper.cmail, isEmail, true )
		)
		{		
		if(s1!='0')
		{			
			 if(s2!='0')
			 {											    
					if(s3!='0')
				{											    
					if(confirm("Las datos Son válidos!\n Continuar el Registro con estos Datos?"))
					{return true;}
					else {return false;}															
				}										
				else { 
				alert("AMPER SRL: \n ERROR: Seleccionar el AREA del Cliente");
				document.amper.area.focus();
				return false; }															
			 }										
			 else { 
			 alert("AMPER SRL: \n ERROR: Seleccionar el TIPO de Cliente");
			 document.amper.tipoc.focus();
			 return false; }

		}
		else { 
		alert("AMPER SRL: \n ERROR: Seleccionar el NIVEL del Cliente.");
		document.amper.nivelc.focus();
		return false; }
    }
else {	
return false;
     }
}
</SCRIPT>