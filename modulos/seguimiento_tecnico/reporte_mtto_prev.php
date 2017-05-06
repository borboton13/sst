<!--<form name="amper" method="post" action="<?/*=$link_modulo_r*/?>" onSubmit=" return VerifyOne ();">-->
<form name="amper" method="post" action="<?=$link_modulo_r?>" onSubmit=" return VerifyOne ();">
<input type="hidden" name="path" value="excel_st_mtto_prev.php" />
<div align="center" class="title">Reporte de Mantenimiento Preventivo</div>
<table width="600" align="center" class="table2">
<caption>Datos para el Reporte</caption>
  <tbody>
    <tr>
        <th width="31%" ><span class="title4">*</span>Centro de Mantenimiento:</th>
        <td><select name="idcentro" class="selectbuscar" id="ingreso_por">
        <option value="0" selected class="title7"> Seleccionar... </option>
        <?php
        $resultado=mysql_query("SELECT idcentro, nombre, codigo FROM centro");
        while($dato=mysql_fetch_array($resultado))
        echo '<option value="'.$dato['idcentro'].'">'.$dato['nombre'].'</option>';
        ?>
        </select>
        </td>
    </tr>
    <tr>
        <th>Formulario:</th>
        <td><select name="formulario" class="selectbuscar" id="formulario">
                <option value="0" selected class="title7"> Seleccionar... </option>
                <?php
                $resultado = mysql_query("SELECT idformulario, codigo, nombre, area FROM formulario");
                while($dato=mysql_fetch_array($resultado))
                    echo '<option value="'.$dato['idformulario'].'-'.$dato['codigo'].'-'.$dato['nombre'].'">'.$dato['codigo'].' - '.$dato['nombre'].'</option>';
                ?>
            </select>
        </td>
    </tr>
    <!--<tr>
	  <th ><span class="rojo">*</span>Fecha Inicial:</th>
	  <td><input name="fechainicio" type="text" class="Text_center" id="fechainicio" size="12" readonly="yes">
              <img onclick=calendar.toggle() src="../../img/cal.gif" alt="Seleccionar fecha incial" width="16" height="16">
          </td>
	</tr>-->
    <tr>
	  <th ><span class="rojo">*</span>Fecha Inicial:</th>
	  <td>
          <input name="fechainicio" type="text" onclick="displayCalendar(this,'yyyy-mm-dd',this)" id="fecha" readonly="yes">
          <img onclick=calendar.toggle() src="../../img/cal.gif" alt="Seleccionar fecha incial" width="16" height="16">
      </td>
	</tr>
	<tr>
	  <th width="25%" ><span class="rojo">*</span>Fecha Final: </th>
	  <td><input name="fechafin" type="text" class="Text_center" id="fechafin" size="12" readonly="yes">
              <img onclick=calendarb.toggle() src="../../img/cal.gif" alt="Seleccionar fecha final" width="16" height="16">
          </td>
	</tr>
        
	</tbody>
	<tfoot>									
	<tr>
	  <td colspan="2"><center><input name="nuevo" type="submit" value="Generar Reporte" /></center></td>
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
	calendar = new Epoch('dp_cal','popup',document.getElementById('fechainicio'));
	calendarb = new Epoch('dp_cal','popup',document.getElementById('fechafin'));
}
</script>  

  <SCRIPT src="../../js/validador.js" type=text/javascript></SCRIPT>
  <script type="text/javascript">
  function VerifyOne () {
    if( checkField( document.amper.cliente, isName, false ) &&
	    isNull( document.amper.fechainicio) &&
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

<link type="text/css" rel="stylesheet" href="../../paquetes/calendar/dhtmlgoodies_calendar/dhtmlgoodies_calendar.css?random=20051112" media="screen"></LINK>
<SCRIPT type="text/javascript" src="../../paquetes/calendar/dhtmlgoodies_calendar/dhtmlgoodies_calendar.js?random=20060118"></script>