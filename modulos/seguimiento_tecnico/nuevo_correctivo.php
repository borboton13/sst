<? if($nively=='1'){ $adm=1;}
    $nro = base64_decode($_GET["nro"]);
?>

<!--<form name="amper" method="post" action="<?/*=$link_modulo_r*/?>" onSubmit=" return VerifyOne ();">-->
<form name="amper" method="post" action="<?=$link_modulo_r?>">
<input type="hidden" name="path" value="nuevo_correctivo_r.php" />
<div align="center" class="title">Nueva Intervencion</div>
<table width="700" align="center" class="table2">
  <tbody>
	<tr>
	  <th width="25%">Registrado por:</th>
	  <td width="75%" class="resaltar"><?=$nombrec;?></td>
	</tr>


	<tr>
	    <th>
            <span class="rojo">*</span>Producto/Servicio:
        </th>
        <td>
            <select name="producto" class="Text_left">
                <option value="0" class="naranja" selected> Seleccionar Producto... </option>
                <?
                $resultado=mysql_query("SELECT sub_grupo FROM parametrica WHERE grupo='st_archivo'");
                while($dato=mysql_fetch_array($resultado))
                { echo "<option value='".$dato['sub_grupo']."'>".$dato['sub_grupo']."</option>"; }
                ?>
            </select>
        </td>
    </tr>

    <tr>
        <th>
            <span class="rojo">*</span>Area de Trabajo:
        </th>
        <td>
            <select name="idareatrabajo" class="Text_left">
                <option value="0" class="naranja" selected> Seleccionar Area... </option>
                <?
                $resultado=mysql_query("SELECT idareatrabajo, nombre FROM areatrabajo");
                while($dato=mysql_fetch_array($resultado))
                { echo "<option value='".$dato['idareatrabajo']."'>".$dato['nombre']."</option>"; }
                ?>
            </select>
        </td>
    </tr>

    <tr>
        <th>
            <span class="rojo">*</span>Departamento:
        </th>
	    <td>
            <select name="departamento" id="departamento" class="buscar">
                <option value="La Paz">La Paz</option>
                <option value="Oruro">Oruro</option>
                <option value="Potosi">Potosi</option>
                <option value="Cochabamba" selected>Cochabamba</option>
                <option value="Chuquisaca">Chuquisaca</option>
                <option value="Tarija">Tarija</option>
                <option value="Pando">Pando</option>
                <option value="Beni">Beni</option>
                <option value="Santa Cruz">Santa Cruz</option>
                <option value="Otro Lugar">Otro Lugar</option>
            </select>
        </td>
	</tr>

    <tr>
        <th>
            <span class="rojo">*</span>Estación
        </th>
        <td>
            <select name="idestacion" class="Text_left">
                <option value="0" class="naranja" selected> Seleccionar... </option>
                <?
                $resultado=mysql_query("SELECT idestacion, nombre FROM estacion order by nombre");
                while($dato=mysql_fetch_array($resultado)){
                    echo "<option value='".$dato['idestacion']."'>".$dato['nombre']."</option>";
                }
                ?>
            </select>
        </td>
    </tr>

    <tr>
        <th>
            <span class="rojo">*</span>Falla
        </th>
        <td>
            <select id="idtipofalla" name="idtipofalla" class="selectbuscar" onchange="showFalla()">
                <option value="0" selected class="title7"> Seleccionar... </option>
                <?php
                $res=mysql_query("SELECT idtipofalla, nombre FROM tipofalla");
                while($dato=mysql_fetch_array($res)){
                    $idtipofalla = $dato['idtipofalla'];
                    $nombre      = $dato['nombre'];
                    echo "<option value='".$idtipofalla."'>".$nombre."</option>";
                }
                ?>
            </select>
        </td>
    </tr>

    <tr>
        <th>
            <span class="rojo"></span>Detalle General:
        </th>
        <td>
            <input id="caracteristicas" name="caracteristicas" type="text" class="Text_left" id="caracteristicas" size="55" maxlength="100">
            <input name="nro" type="hidden"  id="nro" value="<?=$nro;?>">

            <input name="marca" type="hidden"  id="marca" value="">
            <input name="sn" type="hidden"  id="sn" value="">
            <input name="ubicacion" type="hidden"  id="ubicacion" value="">

        </td>
    </tr>



    <tr><td><span class="verde">NOTIFICACION:</span></td><td></td></tr>

    <tr><th><span class="rojo">*</span>Fecha Notificación:</th>
        <td><input name="fecha_n" type="text" class="Text_center" id="fecha_n" size="12" />
          <img onclick=calendar.toggle() src="../../img/cal.gif" alt="Seleccionar fecha incial" width="16" height="16">
        </td>
    </tr>
    <tr>
        <th><span class="rojo">*</span>Hora Not:</th>
        <td><input type=text name="hora_n" id="hora_n" onBlur="CheckTime(this)" size=5 maxlength=5 autocomplete="off"> hh:mm</td>
    </tr>

    <tr><td><span class="verde">PROGRAMACION:</span></td><td></td></tr>

    <tr><th><span class="rojo">*</span>Fecha Programada:</th>
        <td><input name="fecha" type="text" class="Text_center" id="fecha" size="12"/>
            <img onclick=calendar.toggle() src="../../img/cal.gif" alt="Seleccionar fecha incial" width="16" height="16">
        </td>
    </tr>
    <tr>
        <th><span class="rojo">*</span>Hora Programada:</th>
        <td><input type=text name="hora_p" id="hora_p" onBlur="CheckTime(this)" size=5 maxlength=5 autocomplete="off"> hh:mm</td>
    </tr>

    <tr>
        <th><span class="rojo">*</span>Técnico Responsable:</th>
        <td>
            <select name="tecnico" class="selectbuscar" id="tecnico">
                <option value="0" selected class="title7">Eliga el Responsable...</option>
                <?
                $resultadox=mysql_query("select id,concat(nombre, ' ', ap_pat, ' ', ap_mat) FROM usuarios WHERE nivel='2' order by nombre ;");
                while($datox=mysql_fetch_array($resultadox))
                {
                    if($dato['id_usuario']==$datox[0]) echo'<option value="'.$datox[0].'" selected>'.$datox[1].'</option>';
                    else echo'<option value="'.$datox[0].'">'.$datox[1].'</option>';
                }
                ?>
            </select>
        </td>
    </tr>

    </tbody>
	<tfoot>									
	<tr>
	  <td colspan="2">
          <center>
              <input name="nuevo" type="submit" value="Guardar" class="btn_dark" onClick=" return VerifyOne ();" />
              <input onClick="location.href='<?=$mst?>trabajos_ver_correlativo.php&nro=<?=$nro;?>'" class="btn_dark" type="button" value="Cancelar">
          </center>
      </td>
	</tr>
	</tfoot>

</table>
</form>
<script type="text/javascript" src="../../paquetes/autocompletar/ajax.js"></script>
<script type="text/javascript" src="../../paquetes/autocompletar/ajax-dynamic-list.js"></script>
<link href="../../paquetes/autocompletar/ajax-dynamic-list.css" rel="stylesheet" type="text/css">


<script src="../../js/epoch_classes.js" type=text/javascript></script>
<LINK href="../../css/epochprime_styles.css" type=text/css rel=stylesheet>
<script src="../../paquetes/nicEdit/nicEdit.js" type="text/javascript"></script>

<SCRIPT type=text/javascript>
var calendar;
var calendarb;
window.onload = function() {
	calendar = new Epoch('dp_cal','popup',document.getElementById('fecha_n'));
	calendarb = new Epoch('dp_cal','popup',document.getElementById('fecha'));
}

</script>  

  <SCRIPT src="../../js/validador.js" type=text/javascript></SCRIPT>
  <script type="text/javascript">
  function VerifyOne () {

      if(
          validarSelect( document.amper.producto, "Seleccionar Producto!!!") &&
          validarSelect( document.amper.idareatrabajo, "Seleccionar Area!!!") &&
          validarSelect( document.amper.idestacion, "Seleccionar Estacion!!!") &&
          validarSelect( document.amper.idtipofalla, "Seleccionar Falla!!!") &&
          isNull( document.amper.fecha_n) &&
          isNull( document.amper.hora_n) &&
          isNull( document.amper.fecha) &&
          isNull( document.amper.hora_p) &&
          validarSelect( document.amper.tecnico, "Seleccionar Técnico Responsable!!!")
      ){
			if(confirm("Verifica bien los datos antes de continuar?")){
			    return true;
			}else {
			    return false;
			}
      }else {
            return false;
      }
}


    function showFalla(){

        var falla = document.getElementById("idtipofalla");
        var texto = falla.options[falla.selectedIndex].text;
        document.getElementById('caracteristicas').value = texto;

    }

  </script>
