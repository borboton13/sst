<!--<form name="amper" method="post" action="<?/*=$link_modulo_r*/?>" onSubmit=" return VerifyOne ();">-->
<form name="amper" method="post" action="<?=$link_modulo_r?>" onSubmit=" return VerifyOne ();">
<input type="hidden" name="path" value="excel_st_mtto_prev.php" />
<div align="center" class="title">Reporte de Mantenimiento Preventivo</div>
<table width="600" align="center" class="table2">
    <br />
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
        <td><select name="codigoForm" class="selectbuscar" id="codigoForm">
                <option value="0" selected class="title7"> Seleccionar... </option>
                <?php
                $resultado = mysql_query("SELECT idformulario, codigo, nombre, area FROM formulario");
                while($dato=mysql_fetch_array($resultado))
                    echo '<option value="'.$dato['codigo'].'">'.$dato['codigo'].' - '.$dato['nombre'].'</option>';
                ?>
            </select>
        </td>
    </tr>

    <tr>
        <th><span class="rojo">*</span>Fecha Inicial:</th>
        <td>
            <input name="fechainicio" type="text" id="fechainicio" size="10" class="Text_left" value="" onclick="displayCalendar(this,'yyyy-mm-dd',this,false)" readonly="yes"/>
            <img onclick="displayCalendar(document.amper.fechainicio,'yyyy-mm-dd',this,false)" src="../../img/cal.gif" alt="Seleccionar fecha" width="16" height="16">
            yyyy-mm-dd
        </td>
	</tr>
	<tr>
	    <th><span class="rojo">*</span>Fecha Final:</th>
	    <td>
            <input name="fechafin" type="text" id="fechafin" size="10" class="Text_left" value="" onclick="displayCalendar(this,'yyyy-mm-dd',this,false)" readonly="yes"/>
            <img onclick="displayCalendar(document.amper.fechafin,'yyyy-mm-dd',this,false)" src="../../img/cal.gif" alt="Seleccionar fecha" width="16" height="16">
            yyyy-mm-dd
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