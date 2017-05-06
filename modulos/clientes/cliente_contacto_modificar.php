<?
$id = base64_decode($_GET['id']);
$id_contact = $_GET['id_contact'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="../../css/general.css" rel="stylesheet" type="text/css">
<SCRIPT src="../../js/validador.js" type=text/javascript></SCRIPT>
<SCRIPT type=text/javascript>
function VerifyOne () {
    if( checkField( document.amper.cnombre, isName, false ) &&
		checkField( document.amper.ccargo, isName, false ) &&
		checkField( document.amper.ctelf, isPhoneNumber, false ) &&
		checkField( document.amper.cmail, isEmail, false )
		)
		{		
										    
					if(confirm("Las datos Son válidos!\n Continuar el Registro con estos Datos?"))
					{return true;}
					else {return false;}															

    }
else {	
return false;
     }
}
</SCRIPT>
<title>Adicionar Proveedor</title>
</head>
<BR />
<body>
<form name="amper" method="post" action="clientes_r.php" onSubmit=" return VerifyOne ();">
<input type="hidden" name="path" value="cliente_contacto_modificar_r.php" />
<input type="hidden" name="id" value="<?=$id?>" />
<input type="hidden" name="id_contact" value="<?=$id_contact?>" />
<? 
$sql="SELECT nombre,cargo,dpto,telf,celular,email,fax,obs FROM contactos WHERE id=".$id_contact." AND id_cliente='".$id."'";
$resultado=mysql_query($sql);
$dato=mysql_fetch_array($resultado);
?>	
<table width="445" height="325" align="center" cellspacing="1" class="table2">
<caption>
MODIFICAR DATOS CONTACTO
</caption>
<tbody>

<tr>                                 
<th width="25%" height="20"><span class="title4">*</span>Nombre:</th>
<td width="75%" height="20" class="resaltar"><b><?=$dato['nombre']?></b></td>
</tr>									
<tr>
<th width="25%" height="20" ><span class="title4">*</span>Cargo:</th>
<td height="20"><input name="ccargo" type="text" class="Text_left" id="cargo" size="50" maxlength="100" value="<?=$dato['cargo']?>" autocomplete="off"></td>
</tr>
<tr>
<th width="25%" height="20" >&nbsp;&nbsp;Departamento: </th>
<td height="20"><input name="cdpto" type="text" class="Text_left" id="dpto" size="50" maxlength="100" value="<?=$dato['dpto']?>" autocomplete="off"></td>
</tr>
<tr>
<th width="25%" height="20" ><span class="title4">*</span>Telefono:</th>
<td height="20"><input name="ctelf" type="text" class="Text_center" id="telf" size="15" maxlength="12" value="<?=$dato['telf']?>" autocomplete="off"></td>
</tr>
<tr>
<th width="25%" height="20" >&nbsp;&nbsp;Celular:</th>
<td height="20"><input name="ccel" type="text" class="Text_center" id="cel" size="15" maxlength="12" value="<?=$dato['celular']?>" autocomplete="off"></td>
</tr>
<tr>
<th width="25%" height="20" ><span class="title4">*</span>E-Mail:</th>
<td height="20"><input name="cmail" type="text" class="Text_left" id="mail" size="50" maxlength="50" value="<?=$dato['email']?>" autocomplete="off"></td>
</tr>
<tr>
<th width="25%" height="20" >&nbsp;&nbsp;Fax:</th>
<td height="20"><input name="cfax" type="text" class="Text_center" id="cel2" size="15" maxlength="12" value="<?=$dato['fax']?>" autocomplete="off"></td>
</tr>																		
<tr>
<th width="25%" height="20" >&nbsp;&nbsp;Observaci&oacute;n:</th>
<td height="20"><textarea name="cobs" cols="50" rows="6" class="Text_left" id="obs"><?=$dato['obs']?></textarea></td>
</tr> </tbody>
<tfoot>									
<tr><td colspan="2" height="30"><center>
<input name="cliente_contacto_modificar" type="submit" value="Modificar" />

<input name="Submit" type="reset" value="Cancelar" />

</center></td></tr>									
</tfoot>
</table>
</form>

</body>
</html>
