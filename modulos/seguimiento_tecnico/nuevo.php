<form name="amper" method="post" action="<?=$link_modulo_r?>" onSubmit=" return VerifyOne ();">		
<input type="hidden" name="path" value="nuevo_r.php" />
<div align="center" class="title">CREAR NUEVO PROYECTO</div>
<table width="600" align="center" class="table2">
<caption>DATOS DEL PROYECTO</caption>
  <tbody>
	<tr>
	  <th width="25%">Registrado por:</th>
	  <td width="75%" class="resaltar"><?=$nombrec;?></td>
	</tr>
	<tr>
	  <th > <span class="rojo">*</span>Cliente:</th>
	  <td><span class="cafe">Seleccione un cliente existente:</span><br />
              <input name="cliente" 
                     type="text" 
                     class="Text_left" 
                     id="cliente" 
                     onKeyUp="ajax_showOptions(this,'',event,'../../paquetes/autocompletar/search_clientes.php')" size="55" autocomplete="off" >
              <input type="hidden" id="cliente_hidden" name="id_cliente">
          </td>
	</tr>
	<tr>
	  <th ><span class="rojo">*</span>Fecha Inicial:</th>
	  <td><input name="fecha_ini" type="text" class="Text_center" id=fecha_ini size="12" value="<?=date("d/m/Y");?>" readonly="yes"><img onclick=calendar.toggle() src="../../img/cal.gif" alt="Seleccionar fecha incial" width="16" height="16"></td></td>
	</tr>
	<tr>
	  <th width="25%" ><span class="rojo">*</span>Fecha Final: </th>
	  <td><input name="fecha_fin" type="text" class="Text_center" id=fecha_fin size="12" readonly="yes"><img onclick=calendarb.toggle() src="../../img/cal.gif" alt="Seleccionar fecha final" width="16" height="16"></td>
	</tr>
	<tr>
	  <th colspan="2" >Declaracion del proyecto: </th>
	</tr>																		
	<tr>
	  <td colspan="2" >
	    <textarea name="obs" style="width: 600px; height: 100px;" id="obs"></textarea>	  <br><span class="rojo">(*) Campos requeridos</span>   </td>
	</tr>
	  </tbody>
	<tfoot>									
	<tr>
	  <td colspan="2">
          <center>
              <input name="nuevo" type="submit" value="Guardar" class="btn_dark" />
              <input onClick="location.href='<?=$mst?>ver.php'" class="btn_dark" type="button" value="Cancelar">
          </center>
      </td>
	</tr>
	</tfoot>

</table>
</form>
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
			if(confirm("Verifica bien los datos antes de continuar?"))
			{return true;}
			else {return false;}
    }
else {	
return false;
     }
}
  </script>
