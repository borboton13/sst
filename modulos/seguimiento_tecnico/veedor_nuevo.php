<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="../../css/general.css" rel="stylesheet" type="text/css">
<title>Adicionar Nuevo veedor</title>
</head>

<body>
<form name="amper" method="post" action="<?=$link_modulo_r?>" onSubmit=" return VerifyOne ();">	
<input type="hidden" name="path" value="veedor_nuevo_r.php" />	
<table width="460" align="center" class="table2">
  <tbody>
	<tr>
	  <th width="38%" height="20">Registrado por:</th>
	  <td width="62%" height="20" ><span class="azul"><?=$nombrec;?></span></td>
	</tr>
	<tr>
	  <th height="20" > <span class="title2">*</span>Cliente:</th>
	  <td height="20"><input autocomplete="off" name="cliente" type="text" class="Text_left" id="cliente" onkeyup="ajax_showOptions(this,'',event,'../../paquetes/autocompletar/search_clientes.php')" value="" size="40">
	  	    <input type="hidden" id="id_cliente" name="id_cliente">
<input type="hidden" id="sw" name="sw">	  </td>
	</tr>
	<tr>
	  <th height="20" ><span class="title4">*</span>Nombre Veedor:</th>
	  <td height="20"><input name="nombre_completo" type="text" class="Text_left" id="nombre_completo" size="40" autocomplete="off"></td>
	</tr>
	<tr>
      <th height="20" ><span class="title4">*</span>Correo Electronico: </th>
	  <td height="20"><input name="correo" type="text" class="Text_left" id="correo" size="40" autocomplete="off" /></td>
	  </tr>
	<tr>
      <th height="20" >&nbsp;&nbsp;Descripcion:</th>
	  <td height="20"><input name="descripcion" type="text" class="Text_left" id="descripcion" size="40" autocomplete="off" /></td>
	  </tr>
	<tr>
      <th height="20" ><span class="title4">*</span>Cuenta: </th>
	  <td height="20"><input name="cuenta" type="text" class="Text_left" id="cuenta" size="40" autocomplete="off" /></td>
	  </tr>
	<tr>
      <th height="20" ><span class="title4">*</span>Contrase&ntilde;a: </th>
	  <td height="20"><input name="clave" type="password" class="verde" id="clave" autocomplete="off" /></td>
	  </tr>
	<tr>
      <th height="20" ><span class="title4">*</span>Confirmar Contrase&ntilde;a: </th>
	  <td height="20"><input name="clave_confirm" type="password" class="verde" id="clave_confirm" autocomplete="off" /></td>
	  </tr>				
	    </tbody>
<tfoot>	  					
	<tr>
	  <td height="20" colspan="2"><center><input name="nuevo_veedor" type="submit" value="Asignar Nuevo Veedor" />		 
	  </center></td>
	</tr>
</tfoot>	

</table>
</form>
</body>
	<script type="text/javascript" src="../../paquetes/autocompletar/ajax.js"></script>
	<script type="text/javascript" src="../../paquetes/autocompletar/ajax-dynamic-list.js"></script>
	<link href="../../paquetes/autocompletar/ajax-dynamic-list.css" rel="stylesheet" type="text/css">
  <SCRIPT src="../../js/validador.js" type=text/javascript></SCRIPT>
  <SCRIPT src="../../paquetes/autocompletar/ajax-verify.js" type=text/javascript></SCRIPT>
  <script type="text/javascript">
  function VerifyOne () {
    if( checkField( document.amper.cliente, isName, false ) &&
	    checkField( document.amper.nombre_completo, isName, false ) &&
		checkField( document.amper.correo, isEmail, false ) &&
		checkField( document.amper.descripcion, isName, true ) &&
		checkField( document.amper.cuenta, isAlphanumeric, false ) &&
		checkField( document.amper.clave, isAlphanumeric, false ) &&
		checkField( document.amper.clave_confirm, isAlphanumeric, false )
		)
		{
var str = document.amper.cliente.value;
verify_item('../../paquetes/autocompletar/verificar_clientes.php?cliente=' + str);
var c = document.amper.id_cliente.value;
if(c!=''){
	if(document.amper.clave.value==document.amper.clave_confirm.value){

			if(confirm("Verificó bien los datos antes de continuar?"))
			{return true;}
			else {return false;}
		}
		else{
		alert("AMPER SRL: La Contraseña no coincide con la Confirmacion de la Caontraseña.");
		document.amper.clave_confirm.focus();
		return false;
		}	
}
else{
return false;
}

    }
else {	
return false;
     }
}
  </script>
</html>
