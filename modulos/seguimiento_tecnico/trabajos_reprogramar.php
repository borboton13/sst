<?
$id_st_cronograma_informes=$_GET["id_st_cronograma_informes"];
$pro_key=$_GET["pro_key"];
$resultado=mysql_query("SELECT periodo,id_usuario,date_format(fecha,'%d/%m/%Y') AS fecha,date_format(hora_programada,'%H:%i') AS hora FROM st_cronograma_informes_".$pro_key." WHERE id_st_cronograma_informes_".$pro_key." ='".$id_st_cronograma_informes."'");
$dato=mysql_fetch_array($resultado);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="../../css/general.css" rel="stylesheet" type="text/css">
<title>Reprogramar</title>
</head>

<body style="padding-top:5px;">
<form name="amper" method="post" action="<?=$link_modulo_r?>" onSubmit=" return VerifyOne();">		
<input type="hidden" name="path" value="trabajos_reprogramar_r.php" />
<table width="440" class="table2" align="center">
<caption>REPROGRAMAR ACTIVIDAD TECNICA</caption>
        <tr>
          <th width="34%" >Actividad:</th>
          <td width="66%"   ><span class="azul"><?=$dato['periodo'];?></span></td>
        </tr>
		<tr>
          <th width="34%"  >Fecha Actual:</th>
          <td width="66%"   ><span class="azul"><?=$dato['fecha'];?></span></td>
        </tr>
        <tr>
          <th width="34%"  >Nueva Fecha:</th>
          <td width="66%"   ><input name="fecha_nuevo" type="text" class="Text_center" id="fecha_nuevo" size="12" readonly="readonly" value="<?=$dato['fecha'];?>" />
          <img onclick=calendar.toggle() src="../../img/cal.gif" alt="Seleccionar fecha incial" width="16" height="16"></td>
        </tr>
        <tr>
          <th width="34%"  >Hora Programada:</th>
          <td width="66%"   ><input type=text name="hora_p_" id="hora_p_" onBlur="CheckTime(this)" size=5 maxlength=5 value="<?=$dato['hora'];?>" autocomplete="off">
          HH:MM</td>
        </tr>		
		<tr>
          <th width="34%"  >Técnico:</th>
          <td width="66%"   >
		  <select name="tecnico" class="selectbuscar" id="tecnico<?=$i?>">
	<?
	$resultadox=mysql_query("select id,concat(nombre, ' ', ap_pat) FROM usuarios WHERE nivel='2';");
	while($datox=mysql_fetch_array($resultadox))
	 {
	  if($dato['id_usuario']==$datox[0]) echo'<option value="'.$datox[0].'" selected>'.$datox[1].'</option>';
	  else echo'<option value="'.$datox[0].'">'.$datox[1].'</option>';
	 }
	?>		  
		 </select></td>
        </tr>
        <tr>
          <td  colspan="2" class="marco"><LABEL><input name="enviar_mail" type="checkbox" id="enviar_mail" value="SI" checked="checked" />
          Enviar por <strong>MAIL</strong> esta notificaci&oacute;n de cambio de horario, si no desea enviar ningun correo, desactive este checkbox:</LABEL></td>
        </tr>
<tfoot>				
        <tr>
          <td  colspan="3"><center>
			  <input type="hidden" name="id_st_cronograma_informes" value="<?=$id_st_cronograma_informes?>"/>
			  <input type="hidden" name="pro_key" value="<?=$pro_key?>"/>
            <input name="Atras" type="button" id="Atras" value="Atras" onclick="javascript:history.back(1);" />
            &nbsp;
            <input name="siguiente" type="submit" value="Reprogramar" />
          </center></td>
        </tr>
</tfoot>		
  </table>
</form>
</body>
<SCRIPT src="../../js/epoch_classes.js" type=text/javascript></SCRIPT>
<LINK href="../../css/epochprime_styles.css" type=text/css rel=stylesheet>          
<SCRIPT type=text/javascript>
var calendar;

window.onload = function() {
	calendar = new Epoch('dp_cal','popup',document.getElementById('fecha_nuevo'));
}

function VerifyOne () {
if(document.amper.fecha_nuevo.value!=""){	
	if(confirm("Las datos Son validos:\nRevisó bien la coherencia de los datos antes de continuar?")){
	return true;
	}
	else{
	return false;
	}
}
else{
alert("Registra la nueva fecha programada");	
return false;
}
}

function CheckTime(str) 
{ 
hora=str.value 
if (hora=='') {return} 
if (hora.length>5) {alert("Introdujo una cadena mayor a 5 caracteres, recuerde! el formato es HH:MM");return} 
if (hora.length!=5) {alert("Introducir HH:MM");return} 
a=hora.charAt(0) //<=2 
b=hora.charAt(1) //<4 
c=hora.charAt(2) //: 
d=hora.charAt(3) //<=5 
//e=hora.charAt(5) //:
//f=hora.charAt(6) //<=5
if ((a==2 && b>3) || (a>2)) {alert("El valor que introdujo en la Hora no corresponde, introduzca un digito entre 00 y 23");return} 
if (d>5) {alert("El valor que introdujo en los minutos no corresponde, introduzca un digito entre 00 y 59");return} 
//if (f>5) {alert("El valor que introdujo en los segundos no corresponde");return} 
if (c!=':') {alert("Introduzca el caracter ':' para separar la hora y los minutos");return} 
} 

</script>
</html>
