	<script type="text/javascript" src="../../paquetes/autocompletar/ajax.js"></script>
	<script type="text/javascript" src="../../paquetes/autocompletar/ajax-dynamic-list.js"></script>
	<link href="../../paquetes/autocompletar/ajax-dynamic-list.css" rel="stylesheet" type="text/css">	
<div align="center" class="title">ADICIONAR CONTACTO</div>	
<form name="amper" method="post" action="clientes_r.php" onSubmit=" return VerifyOne ();">
<input type="hidden" name="path" value="contacto_nuevo_r.php" />
<table width="900" align="center">
<tr>
<td width="53%" height="255" valign="top"><table width="500" align="center" class="table2">
<caption>
&nbsp;DATOS DE CONTACTO 
</caption>
<tr>
<td colspan="2" class="marco"><span class="naranja"><b><img src="../../img/ico_info.gif" alt="ADICIONAR CLIENTE" vspace="0" border="0" align="absmiddle">Tome en Cuenta:</b> </span>Para Insertar un <B>NUEVO CONTACTO</B> verifique que el cliente existe, caso contrario vaya a: <a href="clientes.php?path=nuevo_cliente.php" class="enlaceboton"><img src="../../img/adicionar.gif" alt="ADICIONAR CLIENTE" align="absmiddle" border="0"> Nuevo Cliente y Contacto</a></td>
</tr>
<tr>
<th width="31%">&nbsp;&nbsp;Adicionado por:</th>
<td width="69%" class="resaltar" ><?=$nombrec?></td>
</tr><tr>                                 
<th width="31%"><span class="title4">*</span>Cliente:</th>
<td width="69%"><input name="cliente" type="text" class="Text_left" id="cliente" onKeyUp="ajax_showOptions(this,'',event,'../../paquetes/autocompletar/search_clientes.php')" size="45" autocomplete="off" ><img src="../../img/ico_info_tooltip.gif" width="38" height="17" align="top" 
onmouseover="tooltip.show('<strong>Seleccionar Cliente:</strong><br />Debe seleccionar un cliente existente, caso contrario Vaya Nuevo Cliente y Contacto');" 
onmouseout="tooltip.hide();"/>
<input type="hidden" id="cliente_hidden" name="id_cliente"></td>
</tr>	
<tr>                                 
<th width="31%"><span class="title4">*</span>Nombre Completo:</th>
<td width="69%"><input name="cnombre" type="text" class="Text_left" id="nombre" size="45" maxlength="30"><img src="../../img/ico_info_tooltip.gif" width="38" height="17" align="top" 
onmouseover="tooltip.show('<strong>Insertar Nombre Completo:</strong><br />Inserte el Nombre Com pleto del Contacto, ya que el sistema si encuentra alguna coincidencia con el nombre, no le permitirá registrar como nuevo contyacto, recordarle que cada contacto debe ir con un único correo Electronico');" 
onmouseout="tooltip.hide();"/></td>
</tr>									
<tr>
<th width="31%" ><span class="title4">*</span>Cargo:</th>
<td><input name="ccargo" type="text" class="Text_left" id="cargo" size="50" maxlength="50"></td>
</tr>
<tr>
<th width="31%" >&nbsp;&nbsp;Departamento: </th>
<td><input name="cdpto" type="text" class="Text_left" id="dpto" size="40" maxlength="20"></td>
</tr>
<tr>
<th width="31%" ><span class="title4">*</span>Telefono:</th>
<td><input name="ctelf" type="text" class="Text_center" id="telf" size="15" maxlength="12"></td>
</tr>
<tr>
<th width="31%" >&nbsp;&nbsp;Celular:</th>
<td><input name="ccel" type="text" class="Text_center" id="cel" size="15" maxlength="12"></td>
</tr>
<tr>
<th width="31%" ><span class="title4">*</span>E-Mail &Uacute;nico:</th>
<td><input name="cmail" type="text" class="Text_left" id="mail" size="45" maxlength="50"><img src="../../img/ico_info_tooltip.gif" width="38" height="17" align="top" 
onmouseover="tooltip.show('<strong>Insertar mail:</strong><br />Inserte un Mail valido, de la forma nombrecontacto@dominio.com , en caso de que exista mas correos de este contacto, por favor insertarlo en el campo OBSERVACION');" 
onmouseout="tooltip.hide();"/></td>
</tr>
<tr>
<th width="31%" >&nbsp;&nbsp;Fax:</th>
<td><input name="cfax" type="text" class="Text_center" id="cel2" size="15" maxlength="12"></td>
</tr>																		
<tr>
<th width="31%" >&nbsp;&nbsp;Observaci&oacute;n:</th>
<td><textarea name="cobs" cols="50" rows="10" class="Text_left" id="obs"></textarea></td>
</tr>
<tfoot>
<tr><td colspan="2" class="paginado"><span class="title4">(*) Campos requeridos</span><BR /><center>
<input name="adicionar_cliente" type="submit" value="Adicionar" />
<input name="Submit" type="reset" value="Cancelar" />
</center></td></tr></tfoot>
</table>
</td>
</tr>
</table>		
</form>
<SCRIPT src="../../js/validador.js" type=text/javascript></SCRIPT>
<SCRIPT type=text/javascript>
function VerifyOne () {
    if( checkField( document.amper.cliente, isName, false ) &&
		checkField( document.amper.cnombre, isName, false ) &&
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
<link href="../../paquetes/tooltip/tooltip.css" rel="stylesheet" type="text/css">
<script language=javascript type="text/javascript" src="../../paquetes/tooltip/tooltip.js"></script>