<form name="amper" method="post" action="<?=$link_modulo_r?>" onSubmit=" return VerifyOne ();">		
<input type="hidden" name="path" value="nuevo_evento_r.php" />
<div align="center" class="title">CREAR NUEVO EVENTO</div>
<table width="600" align="center" class="table2">
<caption>DATOS PARA EL CRONOGRAMA</caption>
  <tbody>
	<tr>
	  <th width="25%">Registrado por:</th>
	  <td width="75%" class="resaltar"><?=$nombrec;?></td>
	</tr>
        <tr>
            <th> <span class="rojo">*</span>Estacion:</th>
            <td><span class="cafe">Seleccione una Estacion:</span><br />
              <input name="estacion" 
                     type="text" 
                     class="Text_left" 
                     id="estacion" 
                     onKeyUp="ajax_showOptions(this,'',event,'../../paquetes/autocompletar/search_estaciones.php')" size="55" autocomplete="off" >
              <input type="hidden" id="idestacion" name="idestacion">
            </td>
	</tr>
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
        <th width="31%" ><span class="title4">*</span>Grupo de Mantenimiento:</th>
        <td><select name="idgrupo" class="selectbuscar" id="idgrupo">
        <option value="0" selected class="title7"> Seleccionar... </option>
        <?php
        $resultado=mysql_query("SELECT g.idgrupo, g.codigo, g.nombre, c.nombre as nombreCentro "
                             . "FROM grupo g JOIN centro c ON g.idcentro = c.idcentro");
        while($dato=mysql_fetch_array($resultado))
        echo '<option value="'.$dato['idgrupo'].'">'.$dato['nombre'].' ('.$dato['nombreCentro'].')</option>';
        ?>
        </select>
        </td>
        </tr>
	<tr>
	  <th ><span class="rojo">*</span>Fecha Inicial:</th>
	  <td><input name="fechainicio" type="text" class="Text_center" id="fechainicio" size="12" readonly="yes">
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
	  <td colspan="2"><center><input name="nuevo" type="submit" value="Guardar" />		 
	  </center></td>
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
