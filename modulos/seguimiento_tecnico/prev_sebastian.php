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
	  <td width="75%" class="resaltar">ORURO</td>
	</tr>
	<tr>
	  <th width="25%">Estación:</th>
	  <td width="75%" class="resaltar">SEBASTIAN PAGADOR</td>
	</tr>
	<tr>
	  <th width="25%">Fecha:</th>
	  <td width="75%" class="cafe">15/Sep/2016</td>
	</tr>
	<tr>
	  <th width="25%">Estado:</th>
	  <td width="75%" class="cafe">Ejecutado <img src='../../img/ejecutado.gif' alt='ver' border="0"></td>
	</tr>
	
	<tr>
	  <th width="25%">Personal Técnico:</th>
	  <td width="75%" class="cafe">Pedro Ajno - Cel. 72320893</td>
	</tr>
	<tr>
	  <th width="25%"></th>
	  <td width="75%" class="cafe">Samuel Aquino - Cel. 68350538</td>
	</tr>
	
	
	<tr>
	  <th colspan="2">Informes de Mantenimiento: </th>
	</tr>
	
	<tr><td colspan="2" class="cafe">Energia Sebastian Pagador.xlsx&nbsp;<a title="Descargar" href="../../funciones/descargar_archivo.php?download=Energia Sebastian Pagador.xlsx&directorio=modulos/repositorio/sebastian/" target="_blank" class="enlaceboton"><img src="../../img/download.gif" >Download</a></td></tr>
	<tr><td colspan="2" class="cafe">NodoB Sebastian Pagador.xlsx&nbsp;<a title="Descargar" href="../../funciones/descargar_archivo.php?download=NodoB Sebastian Pagador.xlsx&directorio=modulos/repositorio/sebastian/" target="_blank" class="enlaceboton"><img src="../../img/download.gif" >Download</a></td></tr>
	<tr><td colspan="2" class="cafe">O.M. Sebastian Pagador.docx&nbsp;<a title="Descargar" href="../../funciones/descargar_archivo.php?download=OM Sebastian Pagador.docx&directorio=modulos/repositorio/sebastian/" target="_blank" class="enlaceboton"><img src="../../img/download.gif" >Download</a></td></tr>
	<tr><td colspan="2" class="cafe">RBS Sebastian Pagador.xlsx&nbsp;<a title="Descargar" href="../../funciones/descargar_archivo.php?download=RBS Sebastian Pagador.xlsx&directorio=modulos/repositorio/sebastian/" target="_blank" class="enlaceboton"><img src="../../img/download.gif" >Download</a></td></tr>
	<tr><td colspan="2" class="cafe">Tx Sebastian Pagador - San Felipe Minilink.xlsx&nbsp;<a title="Descargar" href="../../funciones/descargar_archivo.php?download=Tx Sebastian Pagador - San Felipe Minilink.xlsx&directorio=modulos/repositorio/sebastian/" target="_blank" class="enlaceboton"><img src="../../img/download.gif" >Download</a></td></tr>

	
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
		<td><center><a href="<? echo $link_modulo . '?path=cronograma_oruro.php' ?>" class='enlaceboton'> <b>A T R A S</b></a></center></td>
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
