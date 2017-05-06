<?
$id_item=$_GET["id_item"];
$resultado=mysql_query("SELECT departamento,producto,marca,caracteristicas,sn,ubicacion,id_st_proyecto FROM st_trabajos WHERE id_item='".$id_item."'");
$dato=mysql_fetch_array($resultado);
$nro=$dato['id_st_proyecto'];
 
 $dato_p=mysql_fetch_array(mysql_query("SELECT descripcion FROM parametrica WHERE grupo='st_archivo' AND sub_grupo='".$dato['producto']."'"));
 $pro_key=$dato_p['descripcion'];
	 
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="../../css/general.css" rel="stylesheet" type="text/css">
<title>Actividades</title>
</head>
<body style="padding-top:5px;">

<form name="amper" method="post" action="<?=$link_modulo_r?>" onSubmit=" return VerifyOne();">		
<input type="hidden" name="path" value="trabajos_visitas_ver_adicionar_r.php" />
<table width="310" align="center" class="table2">
<caption>Inserte Nueva Actividad</caption>
<tr>
<th colspan="2"><strong class="verde">NOTIFICACION (INICIO):</strong></th>
</tr>
<tr><th width="37%"  ><span class="rojo">*</span>Fecha Not:</th>
          <td width="63%"><input name="fecha_n" type="text" class="Text_center" id="fecha_n" size="12"/>
          <img onclick=calendarb.toggle() src="../../img/cal.gif" alt="Seleccionar fecha incial" width="16" height="16"></td>
    </tr>
        <tr>
          <th width="37%"  ><span class="rojo">*</span>Hora Not:</th>
          <td width="63%"><input type=text name="hora_n" id="hora_n" onBlur="CheckTime(this)" size=5 maxlength=5 autocomplete="off">
            HH:MM</td>
        </tr>
		        <tr>
          <th width="37%"  ><span class="rojo">*</span>Detalles:</th>
          <td width="63%"><input name="detalles" type=text class="Text_left" id="detalles" size="30" maxlength="250" autocomplete="off"></td>
        </tr>	
<th colspan="2"><strong class="verde">PROGRAMACION:</strong></th>		
<tr><th width="37%"  ><span class="rojo">*</span>Fecha Prog:</th>
          <td width="63%"><input name="fecha" type="text" class="Text_center" id="fecha" size="12"/>
          <img onclick=calendar.toggle() src="../../img/cal.gif" alt="Seleccionar fecha incial" width="16" height="16"></td>
    </tr>
        <tr>
          <th width="37%"  >Hora Prog:</th>
          <td width="63%"><input type=text name="hora_p" id="hora_p" onBlur="CheckTime(this)" size=5 maxlength=5 autocomplete="off">
            HH:MM</td>
        </tr>		
		<tr>
          <th width="37%"  ><span class="rojo">*</span>Técnico:</th>
          <td width="63%"   >
		  <select name="tecnico" class="selectbuscar" id="tecnico">
		  <option value="0" selected class="title7">Eliga el Responsable...</option>
	<?
	$resultadox=mysql_query("select id,concat(nombre, ' ', ap_pat) FROM usuarios WHERE nivel='2';");
	while($datox=mysql_fetch_array($resultadox))
	 {
	  if($dato['id_usuario']==$datox[0]) echo'<option value="'.$datox[0].'" selected>'.$datox[1].'</option>';
	  else echo'<option value="'.$datox[0].'">'.$datox[1].'</option>';
	 }
	?>		  
		 </select></td></tr>
<tfoot>
<tr>
<td colspan="2" align="center"><span class="rojo">(*) Campos Requeridos</span><br />
       <input type="hidden" name="id_item" value="<?=$id_item?>"/>
			  <input type="hidden" name="pro_key" value="<?=$pro_key?>"/>
			  <input type="hidden" name="id_st_proyecto" value="<?=$nro?>"/>
            <input name="Atras" type="button" id="Atras" value="Atras" onclick="javascript:history.back(1);" />
<input type="submit" name="Submit" value="Adicionar" />
</td>
</tr>
</tfoot>	  
</table>
</form>
<br />
<table width="400" class="table2" align="center">
<caption>DATOS DEL ITEM:</caption>
	<tr><th width="25%">Departamento:</th><td width="75%" ><span class="azul"><?=$dato['departamento'];?></span></td></tr>
	<tr><th>Producto/serv:</th><td ><span class="azul"><?=$dato['producto'];?></span></td></tr>
	<tr><th>Marca:</th><td ><span class="azul"><?=$dato['marca'];?></span> <? if($dato['sn']!='') echo"<br><span class='small'>S/N: ".$dato['sn']."</span>";  ?></td></tr>	
	<tr><th>Caracteristicas:</th><td ><span class="azul"><?=$dato['caracteristicas']?></span></td></tr>
	<tr><th width="25%">Estaci&oacute;n:</th><td width="75%" ><span class="azul"><?=$dato['ubicacion']?></span></td></tr>	  
</table>
</body>
<SCRIPT src="../../js/epoch_classes.js" type=text/javascript></SCRIPT>
<LINK href="../../css/epochprime_styles.css" type=text/css rel=stylesheet>          
<SCRIPT src="../../js/validador.js" type=text/javascript></SCRIPT>
<SCRIPT type=text/javascript>
var calendar;
var calendarb;
window.onload = function() {
	calendar = new Epoch('dp_cal','popup',document.getElementById('fecha'));
	calendarb = new Epoch('dp_cal','popup',document.getElementById('fecha_n'));
}

  function VerifyOne () {
    if( isNull( document.amper.fecha_n) &&
	isNull( document.amper.hora_n) &&
	isNull( document.amper.detalles) &&
	validarSelect(document.amper.tecnico,'Seleccione el Responsable')  &&
	    isNull( document.amper.fecha) 
		)
		{
return true;
    }
else {	
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
