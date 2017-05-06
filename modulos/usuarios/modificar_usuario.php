<?
$id=$_GET['id'];

$resultado=mysql_query("SELECT id,nombre,ap_pat,ap_mat,DATE_FORMAT(fecha_nacimiento,'%d/%m/%Y') AS fecha_nacimiento,cuenta,direccion,mail,mail2,skype,msn,telf,cel,telf_oficina,interno,cargo,nro_ing,activo,sucursal,nivel,contrasena FROM usuarios WHERE id='".$id."'");
$datod=mysql_fetch_array($resultado);
?>
<form name="amper" method="post" action="<?=$link_modulo_r?>" onSubmit=" return VerifyOne ();">
<input type="hidden" name="path" value="modificar_usuario_r.php" />
<input type="hidden" name="id" value="<?=$id?>" />
<div align="center" class="title">
MODIFICAR DATOS DE USUARIO
</div>
<table width="500" align="center" class="table2">
<caption>
&nbsp;DATOS DE USUARIO 
</caption>
<tr>
<th width="31%">&nbsp;&nbsp;Modificado por:</th>
<td width="69%" class="resaltar" ><?=$nombrec?></td>
</tr>
<tr>
<td colspan="2" class="marco"><img src="../../img/ico_info.gif" alt="ADICIONAR CLIENTE" vspace="0" border="0" align="absmiddle"> <strong>DATOS PRINCIPALES:</strong></td>
</tr>
<tr>                                 
<th width="31%"><span class="title4">*</span>Nombre:</th>
<td width="69%"><input name="nombre" type="text" class="Text_left" id="nombre" size="30" maxlength="30" value="<?=$datod['nombre']?>"></td>
</tr>	
<tr>                                 
<th width="31%"><span class="title4">*</span>Apellido Paterno:</th>
<td width="69%"><input name="ap_pat" type="text" class="Text_left" id="ap_pat" size="15" maxlength="15" value="<?=$datod['ap_pat']?>"></td>
</tr>									
<tr>
<th width="31%" >&nbsp;&nbsp;Apellido Materno:</th>
<td><input name="ap_mat" type="text" class="Text_left" id="ap_mat" size="15" maxlength="15" value="<?=$datod['ap_mat']?>"></td>
</tr>
<tr>
<th width="31%" ><span class="title4">*</span>Cuenta: </th>
<td><input name="cuenta" type="text" class="Text_left" id="cuenta" size="20" maxlength="20" value="<?=$datod['cuenta']?>">
</td>
</tr>
<tr>
<th width="31%" >&nbsp;&nbsp;Contrase&ntilde;a:</th>
<td class="marco"><span class="cafe">Dejar en Blanco para Mantener Contraseña Anterior</span><br /><input name="contrasena" type="text" class="Text_left" id="contrasena" size="15" maxlength="15" value=""></td>
</tr>
<tr>
<th width="31%" ><span class="title4">*</span>Cargo:</th>
<td><input name="cargo" type="text" class="Text_left" id="cargo" size="50" maxlength="50" value="<?=$datod['cargo']?>"></td>
</tr>
<tr>
<th width="31%" ><span class="title4">*</span>Correo Principal:</th>
<td><input name="mail" type="text" class="Text_left" id="mail" size="45" maxlength="50" value="<?=$datod['mail']?>"></td>
</tr>
<tr>
<th width="31%" ><span class="title4">*</span>Nivel de Usuario:</th>
<td><select name="nivel" class="selectbuscar" id="nivel">
<?
$resultado=mysql_query("SELECT sub_grupo,descripcion FROM parametrica WHERE grupo='nivel_usuario'");
while($dato=mysql_fetch_array($resultado)){
echo '<option value="'.$dato['sub_grupo'].'" '; 
if($datod['nivel']==$dato['sub_grupo']) echo 'selected';
echo'>'.$dato['descripcion'].'</option>';
}
?>
</select></td>
</tr>																		
<tr>
<th width="31%" ><span class="title4">*</span>Ciudad de Trabajo:</th>
<td><select name="sucursal" class="selectbuscar" id="sucursal">
<?
$resultado=mysql_query("SELECT sub_grupo,descripcion FROM parametrica WHERE grupo='depto'");
while($dato=mysql_fetch_array($resultado)){
echo '<option value="'.$dato['sub_grupo'].'" '; 
if($datod['sucursal']==$dato['sub_grupo']) echo 'selected';
echo'>'.$dato['descripcion'].'</option>';
}
?>
</select></td>
</tr>
<tr>
<th width="31%" ><span class="title4">*</span>Estado del usuario:</th>
<td class="marco"><span class="cafe">El Usuario Inactivo no tendra acceso al Sistema</span><br /><label>Usuario Activo <input name="activo" type="radio" value="1"  <? if($datod['activo']=='1'){ echo 'checked="checked"'; }?>>
</label>
<label>Usuario Inactivo <input name="activo" type="radio" value="0" <? if($datod['activo']=='0'){ echo 'checked="checked"'; }?>></label></td>
</tr>
<tr>
<td colspan="2" class="marco"><img src="../../img/ico_info.gif" alt="ADICIONAR CLIENTE" vspace="0" border="0" align="absmiddle" /> <strong>DATOS SECUNDARIOS:</strong> estos datos pueden ser actualizados por el mismo usuario posteriormente. </td>
</tr>
<tr>
<th width="31%" >Fecha Nacimiento :</th>
<td><input name="fecha_nacimiento" type="text" class="Text_center" id="fecha_nacimiento" onBlur="valFecha(this)"  value="<?=$datod['fecha_nacimiento']?>" size="12" maxlength="10"> 
  dd/mm/YYYY </td>
</tr>
<tr>
<th width="31%" >Direcci&oacute;n Domicilio :</th>
<td><input name="direccion" type="text" class="Text_left" id="direccion" value="<?=$datod['direccion']?>" size="50" maxlength="250" /></td>
</tr>
<tr>
<th width="31%" >Correo Alternativo :</th>
<td><input name="mail2" type="text" class="Text_left" id="mail2" value="<?=$datod['mail2']?>" size="50" maxlength="150" /></td>
</tr>
<tr>
<th width="31%" >Cuenta Skype :</th>
<td><input name="skype" type="text" class="Text_left" id="skype" value="<?=$datod['skype']?>" size="50" maxlength="150" /></td>
</tr>
<tr>
<th width="31%" >Cuenta MSN :</th>
<td><input name="msn" type="text" class="Text_left" id="msn" value="<?=$datod['msn']?>" size="50" maxlength="150" /></td>
</tr>
<tr>
<th width="31%" >Telefono:</th>
<td><input name="telf" type="text" class="Text_left" id="telf" value="<?=$datod['telf']?>" size="30" maxlength="50" /></td>
</tr>
<tr>
<th width="31%" >Celular:</th>
<td><input name="cel" type="text" class="Text_left" id="cel" value="<?=$datod['cel']?>" size="30" maxlength="50" /></td>
</tr>
<tr>
<th width="31%" >Telf Oficina:</th>
<td><input name="telf_oficina" type="text" class="Text_left" id="telf_oficina" value="<?=$datod['telf_oficina']?>" size="30" maxlength="50" /> 
Int: 
  <input name="interno" type="text" class="Text_left" id="interno" value="<?=$datod['interno']?>" size="5" maxlength="5" /></td>
</tr>


<tfoot>
<tr><td colspan="2" class="paginado"><span class="title4">(*) Campos requeridos</span><BR /><center>
<input name="adicionar_cliente" type="submit" value="Modificar" />
<input name="Submit" type="reset" value="Reestablecer datos" />
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
		checkField( document.amper.contrasena, isName, true ) &&
		checkField( document.amper.cargo, isName, false ) &&
		checkField( document.amper.mail, isEmail, false )
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
