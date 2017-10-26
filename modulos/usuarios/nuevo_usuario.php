<form name="amper" method="post" action="<?=$link_modulo_r?>" onSubmit=" return VerifyOne ();">
<input type="hidden" name="path" value="nuevo_usuario_r.php" />
<div align="center" class="title">
NUEVO USUARIO</div><table width="500" align="center" class="table2">
<caption>
&nbsp;DATOS DE USUARIO 
</caption>
<tr>
<th width="31%">&nbsp;&nbsp;Adicionado por:</th>
<td width="69%" class="resaltar" ><?=$nombrec?></td>
</tr>
<tr>
<td colspan="2" class="marco"><img src="../../img/ico_info.gif" alt="ADICIONAR CLIENTE" vspace="0" border="0" align="absmiddle"> <strong>DATOS PRINCIPALES:</strong></td>
</tr>
<tr>                                 
<th width="31%"><span class="title4">*</span>Nombre:</th>
<td width="69%"><input name="nombre" type="text" class="Text_left" id="nombre" size="30" maxlength="30"></td>
</tr>	
<tr>                                 
<th width="31%"><span class="title4">*</span>Apellido Paterno:</th>
<td width="69%"><input name="ap_pat" type="text" class="Text_left" id="ap_pat" size="15" maxlength="15"></td>
</tr>									
<tr>
<th width="31%" >&nbsp;&nbsp;Apellido Materno:</th>
<td><input name="ap_mat" type="text" class="Text_left" id="ap_mat" size="15" maxlength="15"></td>
</tr>
<tr>
<th width="31%" ><span class="title4">*</span>Cuenta: </th>
<td><input name="cuenta" type="text" class="Text_left" id="cuenta" size="20" maxlength="20">
  <img src="../../img/ico_info_tooltip.gif" width="38" height="17" align="top" 
onmouseover="tooltip.show('<strong>Cuenta:</strong><br />Inserte un cuenta que sea facil de recordar por el usuario, max de 20 digitos.');" 
onmouseout="tooltip.hide();"/></td>
</tr>
<tr>
<th width="31%" ><span class="title4">*</span>Contrase&ntilde;a Inicial:</th>
<td><input name="contrasena" type="text" class="Text_left" id="contrasena" size="15" maxlength="15"> 
  <span class="rojo">La contrase&ntilde;a sera Encriptada</span> <img src="../../img/ico_info_tooltip.gif" width="38" height="17" align="top" 
onmouseover="tooltip.show('<strong>Contraseña:</strong><br />Esta contraseña se encriptara en la Base de Datos, el Usuario creado podra cambiar su contraseña cuando el requiera.');" 
onmouseout="tooltip.hide();"/></td>
</tr>
<tr>
<th width="31%" ><span class="title4">*</span>Cargo:</th>
<td><input name="cargo" type="text" class="Text_left" id="cargo" size="50" maxlength="50"></td>
</tr>
<tr>
<th width="31%" ><span class="title4">*</span>Correo Principal:</th>
<td><input name="mail" type="text" class="Text_left" id="mail" size="45" maxlength="50"><img src="../../img/ico_info_tooltip.gif" width="38" height="17" align="top" 
onmouseover="tooltip.show('<strong>Insertar mail:</strong><br />Inserte un Mail valido, de la forma nombrecontacto@dominio.com ya que este sera el correo donde se le enviara todas las Notificaciones del Sistema');" 
onmouseout="tooltip.hide();"/></td>
</tr>
<tr>
<th width="31%" ><span class="title4">*</span>Nivel de Usuario:</th>
<td><select name="nivel" class="selectbuscar" id="ingreso_por">
<option value="0" selected class="title7"> Seleccionar... </option>
<?
$resultado=mysql_query("SELECT sub_grupo,descripcion FROM parametrica WHERE grupo='nivel_usuario'");
while($dato=mysql_fetch_array($resultado))
echo '<option value="'.$dato['sub_grupo'].'">'.$dato['descripcion'].'</option>';
?>
</select><img src="../../img/ico_info_tooltip.gif" width="38" height="17" align="top" 
onmouseover="tooltip.show('<strong>Nivel:</strong><br />El nivel de Usuario determinara los privilegios de funcionalidad en el sistema');" 
onmouseout="tooltip.hide();"/></td>
</tr>																		
<tr>
<th width="31%" ><span class="title4">*</span>Ciudad de Trabajo:</th>
<td><select name="sucursal" class="selectbuscar" id="ingreso_por">
<option value="0" selected class="title7"> Seleccionar... </option>
<?
$resultado=mysql_query("SELECT sub_grupo,descripcion FROM parametrica WHERE grupo='depto'");
while($dato=mysql_fetch_array($resultado))
echo '<option value="'.$dato['sub_grupo'].'">'.$dato['descripcion'].'</option>';
?>
</select><img src="../../img/ico_info_tooltip.gif" width="38" height="17" align="top" 
onmouseover="tooltip.show('<strong>Sucursal:</strong><br />Esta opicon dara a conocer al sistema, como debe rotular y/o poner los pies de Pagina en algunas propuestas (cotizaciones) u otros imprimibles');" 
onmouseout="tooltip.hide();"/></td>
</tr>
<tr>
<td colspan="2" class="marco"><img src="../../img/ico_info.gif" alt="ADICIONAR CLIENTE" vspace="0" border="0" align="absmiddle" /> <strong>DATOS SECUNDARIOS:</strong> estos datos pueden ser actualizados por el mismo usuario posteriormente. </td>
</tr>
<tr>
<th width="31%" >Fecha Nacimiento :</th>
<td><input name="fecha_nacimiento" type="text" class="Text_center" id="fecha_nacimiento" onBlur="valFecha(this)" size="12" maxlength="10"> 
  dd/mm/YYYY </td>
</tr>
<tr>
<th width="31%" >Direcci&oacute;n Domicilio :</th>
<td><input name="direccion" type="text" class="Text_left" id="direccion" value="" size="50" maxlength="250" /></td>
</tr>
<tr>
<th width="31%" >Correo Alternativo :</th>
<td><input name="mail2" type="text" class="Text_left" id="mail2" value="" size="50" maxlength="150" /></td>
</tr>
<tr>
<th width="31%" >Cuenta Skype :</th>
<td><input name="skype" type="text" class="Text_left" id="skype" value="" size="50" maxlength="150" /></td>
</tr>
<tr>
<th width="31%" >Cuenta MSN :</th>
<td><input name="msn" type="text" class="Text_left" id="msn" value="" size="50" maxlength="150" /></td>
</tr>
<tr>
<th width="31%" >Telefono:</th>
<td><input name="telf" type="text" class="Text_left" id="telf" value="" size="30" maxlength="50" /></td>
</tr>
<tr>
<th width="31%" >Celular:</th>
<td><input name="cel" type="text" class="Text_left" id="cel" value="" size="30" maxlength="50" /></td>
</tr>
<tr>
<th width="31%" >Telf Oficina:</th>
<td><input name="telf_oficina" type="text" class="Text_left" id="telf_oficina" value="" size="30" maxlength="50" /> 
Int: 
  <input name="interno" type="text" class="Text_left" id="cobs" value="" size="5" maxlength="5" /></td>
</tr>


<tfoot>
<tr><td colspan="2" class="paginado"><span class="rojo">(*) Campos requeridos</span><BR /><center>
<input name="adicionar_cliente" type="submit" value="Adicionar" />
<!--<input name="Submit" type="reset" value="Cancelar" />-->
<input onClick="location.href='<?=$musuarios?>ver_usuarios.php'" type="button" value="Cancelar">
</center></td></tr></tfoot>
</table>		
</form>

<SCRIPT src="../../js/validador.js" type=text/javascript></SCRIPT>
<SCRIPT type=text/javascript>
function VerifyOne () {
    if( checkField( document.amper.nombre, isName, false ) &&
		checkField( document.amper.ap_pat, isName, false ) &&
		checkField( document.amper.ap_mat, isName, true ) &&
		checkField( document.amper.cuenta, isName, false ) &&
		checkField( document.amper.contrasena, isName, false ) &&
		checkField( document.amper.cargo, isName, false ) &&
		checkField( document.amper.mail, isEmail, false ) &&
		validarSelect(document.amper.nivel,'Seleccione el Nivel de Usuario') &&	
		validarSelect(document.amper.sucursal,'Seleccione la ciudad de trabajo del usuario o sucursal de trabajo') &&	
		checkField( document.amper.msn, isEmail, true ) &&
		checkField( document.amper.telf, isPhoneNumber, true ) &&
		checkField( document.amper.cel, isPhoneNumber, true ) &&
		checkField( document.amper.telf_oficina, isPhoneNumber, true )
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

function valDia(oTxt){
var bOk = false;
var nDia = parseInt(oTxt.value.substr(0, 2), 10);
bOk = bOk || ((nDia >= 1) && (nDia <= finMes(oTxt)));
return bOk;
}
function valMes(oTxt){
var bOk = false;
var nMes = parseInt(oTxt.value.substr(3, 2), 10);
bOk = bOk || ((nMes >= 1) && (nMes <= 12));
return bOk;
}
function valAno(oTxt){
var bOk = true;
var nAno = oTxt.value.substr(6);
bOk = bOk && ((nAno.length == 4));
if (bOk){
for (var i = 0; i < nAno.length; i++){
bOk = bOk && esDigito(nAno.charAt(i));
}
}
return bOk;
}

function valFecha(oTxt){
var bOk = true;
if (oTxt.value != ""){
bOk = bOk && (valAno(oTxt));
bOk = bOk && (valMes(oTxt));
bOk = bOk && (valDia(oTxt));
bOk = bOk && (valSep(oTxt));
if (!bOk){
alert("Fecha inválida");
oTxt.value = "";
oTxt.focus();
}
}
}
</SCRIPT>
<link href="../../paquetes/tooltip/tooltip.css" rel="stylesheet" type="text/css">
<script language=javascript type="text/javascript" src="../../paquetes/tooltip/tooltip.js"></script>