<?
$id_st_cronograma_informes=base64_decode($_GET["id_st_cronograma_informes"]);
$id_item=base64_decode($_GET["id_item"]);


$dato=mysql_fetch_array(mysql_query("SELECT producto,id_st_proyecto FROM st_trabajos WHERE id_item='".$id_item."'"));
 $dato_p=mysql_fetch_array(mysql_query("SELECT descripcion FROM parametrica WHERE grupo='st' AND sub_grupo='".$dato['producto']."'"));
 $from=$dato_p['descripcion'];  
 $consulta="SELECT date_format(st.fecha,'%d/%m/%Y') AS fecha,st.condicion_final,st.id_usuario,CONCAT(u.nombre,' ',u.ap_pat) AS responsable,st.periodo
FROM ".$from." st, usuarios u
WHERE st.id_item='".$id_item."' AND st.id_usuario=u.id";
$dato_i=mysql_fetch_array(mysql_query($consulta))
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="../../css/general.css" rel="stylesheet" type="text/css">
<title>Ajuste</title>
<style>	
	div.grippie {
		background:#EEEEEE url(../../paquetes/textarea/grippie.png) no-repeat scroll center 2px;
		border-color:#DDDDDD;
		border-style:solid;
		border-width:0pt 1px 1px;
		cursor:s-resize;
		height:9px;
		overflow:hidden;
	}
</style>
</head>

<body>
<table width="295" class="table2" align="center">
<caption>
DATOS DEL INFORME:
</caption>
	<tr><th>Producto/serv:</th><td ><span class="azul"><?=$dato['producto'];?></span></td></tr>
	<tr>
	  <th width="25%">Actividad Nro:</th><td width="75%" ><span class="azul"><?=$dato_i['periodo'];?></span></td></tr>
	<tr>
	  <th>Fecha:</th>
	  <td ><span class="azul"><?=$dato_i['fecha'];?></span></td></tr>	
	<tr>
	  <th>Responsable:</th>
	  <td ><span class="azul"><?=$dato_i['responsable']?></span></td></tr>	  
</table>
<form name="amper" method="post" action="<?=$link_modulo_r?>" onSubmit=" return validaForm();">		
<input type="hidden" name="path" value="trabajos_informar_ajuste_r.php" />
<table width="295" align="center" class="table2">
<caption>ACTUALIZACION POST INFORME TECNICO</caption>
        <tr>
          <td>Fecha del Ajuste: <input name="fecha" type="text" class="Text_center" id="fecha"  readonly="readonly" size="10" /><img onclick=calendar.toggle() src="../../img/cal.gif" alt="Seleccionar fecha incial" width="16" height="16"></td>
        </tr>
        <tr>
          <td><div align="center"><strong>Resumen Textual</strong></div></td>
        </tr>
		<tr>
          <td><textarea name="informe" class="resizable" style="width: 280px; height: 80px;" id="informe"></textarea></td>
        </tr>
		        <tr><td>
          <div align="center">Usted esta actualizando la condici&oacute;n final a: <span class="verde"><strong>OK+ </strong></span>(Correcto Funcionmiento).</div></td>
        </tr>
		<tr>
<td><span class="title6">Destinatarios Cliente:</span>
		  <?
	$consulta="SELECT v.correo FROM st_proyecto p INNER JOIN st_personal_veedor v ON p.id_st_proyecto='".$dato['id_st_proyecto']."' AND p.id_cliente=v.id_cliente";
$resultado=mysql_query($consulta);
$k=1;
	$filas=mysql_num_rows($resultado);
	if($filas!=0)
	{  
while($datoc=mysql_fetch_array($resultado))
 		{
		?>
		<BR /><label id="label<?=$k?>" class="marcar_check"><input name="d_p[]" type="checkbox" value="<?=$datoc['correo']?>" id="check_<?=$k?>" onclick="marcar_check(this,'label<?=$k?>')" checked="checked"/>
<?=$datoc['correo']?> </label>
		<?
		$k++;
		}				
	}
		?>
		   </td>		
		</tr>		
<tfoot>		
        <tr>
          <td><center>
			  <input type="hidden" name="id_item" value="<?=$id_item?>"/>
			  <input type="hidden" name="id_st_cronograma_informes" value="<?=$id_st_cronograma_informes?>"/>
              <input type="button" name="Submit" value="volver" onclick="javascript:history.back(1)" />
              <input name="actualizar" type="submit" value="Actualizar Ajuste" />
          </center></td>
        </tr>
</tfoot>
  </table>
</form>

</body>
<script type="text/javascript" src="../../paquetes/textarea/jquery-latest.js"></script>
<script type="text/javascript" src="../../paquetes/textarea/jquery.textarearesizer.compressed.js"></script>
<script type="text/javascript">
	/* jQuery textarea resizer plugin usage */
	$(document).ready(function() {
		$('textarea.resizable:not(.processed)').TextAreaResizer();
	});
</script>
<LINK href="../../css/epochprime_styles.css" type=text/css rel=stylesheet>
<SCRIPT src="../../js/epoch_classes.js" type=text/javascript></SCRIPT>
<script type="text/javascript">
window.onload = function() {
calendar = new Epoch('dp_cal','popup',document.getElementById('fecha'));
}
function validaForm()
{
	if(document.amper.fecha.value!='' && document.amper.informe.value!='')
	{
if(confirm("Las datos Son validos:\nRevisó bien los datos antes de continuar?"))
								{return true;}
								else {return false;}
	}
	else { alert("AMPER SRL: Inserte la FECHA y/o RESUMEN porfavor! ");
			return false; }							
								
}
function marcar_check(check,value){
label = document.getElementById(value)
if (check.checked == true)
		{		
		label.className = 'marcar_check';
        }
		else{
		label.className = 'adjunto';
		}
		

}
</script>

</html>
