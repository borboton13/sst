<?
$nro = base64_decode($_GET["nro"]);
?>
<table width="98%" align="center" class="table3">
<caption>PROGRAMAR VISITAS TECNICAS POR BARRIDO</caption>
	<tr>
	<td width="49%" valign="top">
	<? 
	$consulta="SELECT c.razon_social,s.declaracion_proyecto,date_format(s.fecha_inicio,'%d/%m/%Y'),date_format(s.fecha_final,'%d/%m/%Y'),concat(u.nombre, ' ', u.ap_pat),s.fecha_registro,s.id_cliente
FROM (st_proyecto s INNER JOIN clientes c ON s.id_cliente=c.id) INNER JOIN usuarios u ON s.id_usuario=u.id WHERE s.id_st_proyecto='".$nro."'";
	$resultado=mysql_query($consulta);
	$filas=mysql_num_rows($resultado);
	if($filas!=0)
	{ 
	while($dato=mysql_fetch_array($resultado))
	 {
	 $razon_social=$dato[0]; 
	 $declaracion_proyecto=$dato[1]; 
	 $fecha_inicio=$dato[2]; 
	 $fecha_final=$dato[3]; 
	 $id_usuario=$dato[4]; 
	 $fecha_registro=$dato[5]; 
	 $id_cliente=$dato[6];
	 }
	}
	?>
	Nro: <span class="title"><?=$nro;?></span><br>
	Ingresado por: <span class="title6"><?=$id_usuario;?></span><br>
Cliente: <span class="title7">
<?=$razon_social;?>
</span></td>	
	<td width="49%" align="right">Fecha Inicial: <span class="title6">
	  <?=$fecha_inicio;?>
	</span><br>
Fecha final: <span class="title6">
<?=$fecha_final;?>
</span><br>
Fecha Registro: <span class="title6">
<?=$fecha_registro;?>
</span>		</td>
	</tr>
	<tr><td colspan="2"><table>
	    <tr>	     
	      <td class="marco"><a class="enlaceboton" href="<?=$link_modulo?>?path=trabajos_ver.php&nro=<?=base64_encode($nro);?>"><img src="../../img/informe_detalles.gif" alt="Ver Listado en Excel" width="16" height="16" border="0" align="absmiddle" /> Ver Listado General</a></td>
	      <td class="marco"><form>
	        <img src="../../img/filtrar_s.gif" alt="buscar" width="24" height="20"  align="absbottom">
	        <select name="select" class="selectbuscar" onChange="document.location=this.options[this.selectedIndex].value">
			<option value="0" value="#" >[Seleccione un Periodo...]</option>
                <?
$periodos=0;
$resultado=mysql_query("SELECT descripcion FROM parametrica WHERE grupo='st'");
while($dato=mysql_fetch_array($resultado))
{
$datox=mysql_fetch_array(mysql_query("SELECT MAX(periodo) AS periodo FROM ".$dato['descripcion']." WHERE id_st_proyecto='".$nro."'"));
if($datox['periodo']>=$periodos) $periodos=$datox['periodo'];
}

for($k=1;$k<=$periodos;$k++)
{
echo "<option value='".$link_modulo."?path=trabajos_ver_periodos.php&periodo=$k&nro=".base64_encode($nro)."' class='naranja'>".$k."&deg; Periodo</option>";
}										  
?>
              </select>
	        </form></td>
        </tr>
	    </table></td></tr>
</table>

<form name="amper" method="post" action="<?=$link_modulo_r?>" onSubmit=" return VerifyOne ();">		
<input type="hidden" name="path" value="trabajos_actividades_insertar_por_barrido_r.php" />
<input type="hidden" name="nro" value="<?=$nro;?>"> 
<input type="hidden" name="id_cliente" value="<?=$id_cliente;?>"> 
<table width="98%" class="table3" align="center">
<tr><td colspan="7" class="paginado"><span class="cafe">Escoga el T&eacute;cnico e Inserte las fechas en el formato correspondiente</span>
  <input type="submit" name="Submit" value="Enviar Programacion de Horarios">
</td></tr>
<tr>
<th width="1%" height="16" >N&deg;</th>
<th width="15%">PRODUCTO/SERVICIO</th>			              
<th width="17%">ESTACION</th>
<th width="15%">MARCA y S/N</th>
<th width="15%">CARACTERISTICAS</th> 
<th width="15%">ESTADO ACTUAL</th>
<th  width="22%">dd/mm/yyyy HH:MM </th>
</tr>
<?	
$consulta="SELECT departamento,producto,marca,caracteristicas,sn,ubicacion,id_item FROM st_trabajos WHERE id_st_proyecto='".$nro."' ORDER BY departamento ASC, id_item ASC";
	$resultado=mysql_query($consulta);
	$filas=mysql_num_rows($resultado);
	if($filas!=0)
	{ 
	$i=0;
	while($dato=mysql_fetch_array($resultado))
	 {	 
	 $departamento=$dato[0]; 
	 $producto=$dato[1]; 
	 $marca=$dato[2]; 
	 $caracteristicas=$dato[3]; 
	 $sn=$dato[4];
	 $ubicacion=$dato[5]; 
	 $id_item=$dato[6]; 
	 
	 $i++;
	 if($departamento_aux!=$departamento)
	 {echo "<tr bgcolor='#FFE3BB'><td colspan='8'><span class='title'>$departamento</span></td></tr>";}
	 
	 if($i%2==0) $rowt="#f1f1f1";
	 else $rowt="#f6f7f8";
	 
	 $dato_st=mysql_fetch_array(mysql_query("SELECT b.descripcion FROM st_trabajos a, parametrica b  WHERE a.id_item='".$id_item."' AND b.grupo='st' AND b.sub_grupo=a.producto"));
$st_cronograma_informes=$dato_st['descripcion'];

	 $b=mysql_fetch_array(mysql_query("SELECT date_format(fecha,'%d/%m/%y'),condicion_final FROM ".$st_cronograma_informes." WHERE id_item='".$id_item."' AND condicion_final<>'' ORDER BY fecha DESC limit 1"));
 	$condicion_fecha=$b[0];
	$condicion_final=$b[1];
	switch($condicion_final){
	case 'OK' : $img="<img src='../../img/semaforo_verde.gif' border=\"0\" width=\"46\" height=\"16\" align=\"absmiddle\">"; break;
	case 'Pendiente' : $img="<img src='../../img/semaforo_amarillo.gif' border=\"0\" width=\"46\" height=\"16\" align=\"absmiddle\">"; break;
	case 'Irreparable' : $img="<img src='../../img/semaforo_rojo.gif' border=\"0\" width=\"46\" height=\"16\" align=\"absmiddle\">"; break;
	default: $img="Inicial <img src='../../img/ico_reloj.gif' alt='Esperando próxima fecha' border=\"0\">";
	}
	
	 
	echo " 
	<tr bgcolor='$rowt' onmouseover=\"setPointer(this, '#DADADA')\" onmouseout=\"setPointer(this, '$rowt')\">
	<td>$i</td> 
	<td>$producto</td>
	<td>$ubicacion</td>"; 
	if($sn!='') echo"<td>".$marca."<br><span class='title5'>S/N: $sn</span></td>";
	else echo"<td>".$marca."</td>";	
	echo"<td>$caracteristicas</td> 
	<td><center><span class='title6'>$condicion_final</span> <span class='title5'>$condicion_fecha</span> ".$img.$obs."</center></td> 
	<td>"; 
	
	$c=mysql_fetch_array(mysql_query("SELECT count(id_".$st_cronograma_informes."),count(condicion_final) FROM ".$st_cronograma_informes." WHERE id_item='".$id_item."'"));
	?><input type="hidden" name="ids[]" value="<?=$id_item;?>"><input type="hidden" name="productos[]" value="<?=$producto;?>">
	<input type="text" size="10" name="fecha[]" onBlur="valFecha(this)" class="Text_right" maxlength="10" onclick="displayCalendar(this,'dd/mm/yyyy',this)" autocomplete="off"><input type="text" name="hora[]" onBlur="CheckTime(this)" size=5 maxlength=5 class="Text_right"><select name="tecnico[]" class="selectbuscar" id="tecnico<?=$i?>">
	
		  <option value="0" selected class="title7">Eliga el Responsable...</option>
	<?
	$resultadox=mysql_query("select id,concat(nombre, ' ', ap_pat) FROM usuarios WHERE nivel='2';");
	while($datox=mysql_fetch_array($resultadox))
	 {
	  echo'<option value="'.$datox[0].'">'.$datox[1].'</option>';
	 }
	?></select><?
	if($c[0]!=0)
	{	
	 echo "<span class='verde'>".$c[1]."/".$c[0]."</span>"; 
	 }
	 else echo"?";	
	 echo"</td></tr>"; 		
	 $departamento_aux=$departamento;
	 }	 
	}
?>
<tr>
<td colspan="7" class="paginado"><span class="cafe">Escoga el T&eacute;cnico e Inserte las fechas en el formato correspondiente</span>
   
  <input type="submit" name="Submit" value="Enviar Programacion de Horarios">
</td></tr>
</table>		  
</form>
<br>
<table width="98%" align="center" class="table3">
  <tr>
    <td><strong class="rojo">Declaración del proyecto:</strong><br>
      <span class="small">
      <?=nl2br($declaracion_proyecto);?>
    </span></td>
  </tr>
</table>
<link type="text/css" rel="stylesheet" href="../../paquetes/calendar/dhtmlgoodies_calendar/dhtmlgoodies_calendar.css?random=20051112" media="screen"></LINK>
<SCRIPT type="text/javascript" src="../../paquetes/calendar/dhtmlgoodies_calendar/dhtmlgoodies_calendar.js?random=20060118"></script>
	
<script language="JavaScript">
function esDigito(sChr){
var sCod = sChr.charCodeAt(0);
return ((sCod > 47) && (sCod < 58));
}
function valSep(oTxt){
var bOk = false;
bOk = bOk || ((oTxt.value.charAt(2) == "/") && (oTxt.value.charAt(5) == "/"));
return bOk;
}
function finMes(oTxt){
var nMes = parseInt(oTxt.value.substr(3, 2), 10);
var nRes = 0;
switch (nMes){
case 1: nRes = 31; break;
case 2: nRes = 29; break;
case 3: nRes = 31; break;
case 4: nRes = 30; break;
case 5: nRes = 31; break;
case 6: nRes = 30; break;
case 7: nRes = 31; break;
case 8: nRes = 31; break;
case 9: nRes = 30; break;
case 10: nRes = 31; break;
case 11: nRes = 30; break;
case 12: nRes = 31; break;
}
return nRes;
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
function CheckTime(str) 
{ 
hora=str.value 
if (hora=='') {return} 
if (hora.length>5) {alert("Introdujo una cadena mayor a 5 caracteres, recuerde! el formato es HH:MM");str.value="";str.focus();return} 
if (hora.length!=5) {alert("Introducir HH:MM");str.value="";str.focus();return} 
a=hora.charAt(0) //<=2 
b=hora.charAt(1) //<4 
c=hora.charAt(2) //: 
d=hora.charAt(3) //<=5 
//e=hora.charAt(5) //:
//f=hora.charAt(6) //<=5
if ((a==2 && b>3) || (a>2)) {alert("El valor que introdujo en la Hora no corresponde, introduzca un digito entre 00 y 23");str.value="";str.focus();return} 
if (d>5) {alert("El valor que introdujo en los minutos no corresponde, introduzca un digito entre 00 y 59");str.value="";str.focus();return} 
//if (f>5) {alert("El valor que introdujo en los segundos no corresponde");return} 
if (c!=':') {alert("Introduzca el caracter ':' para separar la hora y los minutos");str.value="";str.focus();return} 
} 

function VerifyOne () {
	if(confirm("ATENCION!\nSi en alguna fila no lleno el técnico o la fecha, esta fila no sera tomado en cuenta.\nRevisó bien los datos antes de continuar?")){
	return true;
	}
	else{
	return false;
	}
}
</script>    
