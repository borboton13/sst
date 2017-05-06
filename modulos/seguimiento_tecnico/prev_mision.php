<form name="amper" method="post" action="<?=$link_modulo_r?>" onSubmit=" return VerifyOne ();">		
<input type="hidden" name="path" value="nuevo_r.php" />
<div align="center" class="title">DETALLES DEL MANTENIMIENTO</div>
<table width="800" align="center" class="table2">
<caption>DATOS DE LA ESTACION</caption>
  <tbody>
	<tr>
	  <th width="25%">Cliente:</th>
	  <td width="75%" class="cafe">ENTEL S.A.</td>
	</tr>
	
	<tr>
	  <th width="25%">Centro de Mantenimiento:</th>
	  <td width="75%" class="resaltar">VILLA TUNARI</td>
	</tr>
	<tr>
	  <th width="25%">Estación:</th>
	  <td width="75%" class="resaltar">CB0188 LA MISION</td>
	</tr>
	<tr>
	  <th width="25%">Fecha:</th>
	  <td width="75%" class="cafe">08/Sep/2016</td>
	</tr>
	<tr>
	  <th width="25%">Estado:</th>
	  <td width="75%" class="cafe">Ejecutado <img src='../../img/ejecutado.gif' alt='ver' border="0"></td>
	</tr>
	
	<tr>
	  <th width="25%">Personal Técnico:</th>
	  <td width="75%" class="cafe">Ariel Huayhua - Cel: 67401254</td>
	</tr>
	<tr>
	  <th width="25%"></th>
	  <td width="75%" class="cafe">Nilton Bonifasio - Cel: 72235670</td>
	</tr>
	
	
	<tr>
	  <th colspan="2">Informes de Mantenimiento: </th>
	</tr>
	
	<tr><td colspan="2" class="cafe">2G-4G LA MISION.xlsx&nbsp;<a title="Descargar" href="../../funciones/descargar_archivo.php?download=2G-4G LA MISION.xlsx&directorio=modulos/repositorio/mision/" target="_blank" class="enlaceboton"><img src="../../img/download.gif" >Download</a></td></tr>
	<tr><td colspan="2" class="cafe">Energia - La Mision.xlsx&nbsp;<a title="Descargar" href="../../funciones/descargar_archivo.php?download=Energia - La Mision.xlsx&directorio=modulos/repositorio/mision/" target="_blank" class="enlaceboton"><img src="../../img/download.gif" >Download</a></td></tr>
	<tr><td colspan="2" class="cafe">VSAT LA MISION.xlsx&nbsp;<a title="Descargar" href="../../funciones/descargar_archivo.php?download=VSAT LA MISION.xlsx&directorio=modulos/repositorio/mision/" target="_blank" class="enlaceboton"><img src="../../img/download.gif" >Download</a></td></tr>
	<tr><td colspan="2" class="cafe">Reporte Fotografico - La Mision.xlsx&nbsp;<a title="Descargar" href="../../funciones/descargar_archivo.php?download=Reporte Fotografico - La Mision.xlsx&directorio=modulos/repositorio/mision/" target="_blank" class="enlaceboton"><img src="../../img/download.gif" >Download</a></td></tr>
	<tr><td colspan="2" class="cafe">REPORTE FOTOGRAFICO LA MISION.xlsx&nbsp;<a title="Descargar" href="../../funciones/descargar_archivo.php?download=REPORTE FOTOGRAFICO LA MISION.xlsx&directorio=modulos/repositorio/mision/" target="_blank" class="enlaceboton"><img src="../../img/download.gif" >Download</a></td></tr>
	<tr><td colspan="2" class="cafe">Diagrama Unifilar - La Mision.pdf&nbsp;<a title="Descargar" href="../../funciones/descargar_archivo.php?download=Diagrama Unifilar - La Mision.pdf&directorio=modulos/repositorio/mision/" target="_blank" class="enlaceboton"><img src="../../img/download.gif" >Download</a></td></tr>
	

	<tr>
	  <th colspan="2" >Observaciones del Cliente: </th>
	</tr>	
	
	<tr>
	  <td colspan="2" >
	    <textarea name="obs" style="width: 600px; height: 100px;" id="obs"></textarea>	  <br><span class="rojo">(*) Campos requeridos</span>   </td>
	</tr>
	  </tbody>
	<tfoot>									
	<tr>
		<td><center><a href="<? echo $link_modulo . '?path=cronograma_villa.php' ?>" class='enlaceboton'> <b>A T R A S</b></a></center></td>
		<td><center><input name="nuevo" type="submit" value="Guardar" /></center></td>
	</tr>
	</tfoot>

</table>
</form>
<div><div/>
<script type="text/javascript" src="../../paquetes/autocompletar/ajax.js"></script>
<script type="text/javascript" src="../../paquetes/autocompletar/ajax-dynamic-list.js"></script>
<link href="../../paquetes/autocompletar/ajax-dynamic-list.css" rel="stylesheet" type="text/css">
	
<SCRIPT src="../../js/epoch_classes.js" type=text/javascript></SCRIPT>
<LINK href="../../css/epochprime_styles.css" type=text/css rel=stylesheet>

<script src="../../paquetes/nicEdit/nicEdit.js" type="text/javascript"></script>             
<SCRIPT type=text/javascript>
bkLib.onDomLoaded(function() {
	new nicEditor({buttonList : ['removeformat','bold','italic','underline','html']}).panelInstance('obs');
});
</SCRIPT>
<SCRIPT type=text/javascript>
var calendar;
var calendarb;
window.onload = function() {
	calendar = new Epoch('dp_cal','popup',document.getElementById('fecha_ini'));
	calendarb = new Epoch('dp_cal','popup',document.getElementById('fecha_fin'));
}
</script>  

  <SCRIPT src="../../js/validador.js" type=text/javascript></SCRIPT>
  <script type="text/javascript">
  function VerifyOne () {
    if( checkField( document.amper.cliente, isName, false ) &&
	    isNull( document.amper.fecha_ini) &&
		isNull( document.amper.obs) 
		)
		{
			if(confirm("Verificó bien los datos antes de continuar?"))
			{return true;}
			else {return false;}
    }
else {	
return false;
     }
}
  </script>
