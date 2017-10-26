<form name="amper" method="post" action="<?=$link_modulo_r?>" onSubmit=" return VerifyOne ();">		
<input type="hidden" name="path" value="nueva_acta_r.php" />
<div align="center" class="title">CREAR NUEVA ACTA</div>
<table width="600" align="center" class="table2">
<caption>DATOS DEL PROYECTO</caption>
  <tbody>
	<tr>
	  <th width="25%">Registrado por:</th>
	  <td width="75%" class="resaltar"><?=$nombrec;?></td>
	</tr>
	<tr>
	  <th > <span class="rojo">*</span>Codigo de Acta:</th>
	  <td><span class="cafe">Introduzca un codigo de acta:</span><br />
              <input name="codigo" type="text"  class="Text_left" id="codigo" size="25" autocomplete="off">
          </td>
	</tr>
	<tr>
	  <th ><span class="rojo">*</span>Fecha Inicio:</th>
	  <td><input name="fechainicio" type="text" class="Text_center" id=fecha_ini size="12" value="<?=date("d/m/Y");?>" readonly="yes"><img onclick=calendar.toggle() src="../../img/cal.gif" alt="Seleccionar fecha incial" width="16" height="16"></td></td>
	</tr>
	<tr>
	  <th width="25%" ><span class="rojo">*</span>Fecha Fin:</th>
	  <td><input name="fechafin" type="text" class="Text_center" id=fecha_fin size="12" readonly="yes"><img onclick=calendarb.toggle() src="../../img/cal.gif" alt="Seleccionar fecha final" width="16" height="16"></td>
	</tr>
	<tr>
	  <th colspan="2" >Descripcion del acta: </th>
	</tr>																		
	<tr>
	  <td colspan="2" >
	    <textarea name="descripcion" style="width: 600px; height: 100px;" id="descripcion"></textarea><br><span class="rojo">(*) Campos requeridos</span>   </td>
	</tr>
	  </tbody>
	<tfoot>									
	<tr>
	  <td colspan="2">
          <center>
              <input name="nuevo" type="submit" value="Siguiente" class="btn_dark" />
              <input onClick="location.href='<?=$mst?>actas.php'" class="btn_dark" type="button" value="Cancelar">
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
