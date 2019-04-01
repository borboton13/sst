<?php
$web=$_SESSION["web"];
if (isset($_GET['idev'])) $idevento     = $_GET['idev'];
if (isset($_GET['codEs'])) $codigoEstacion = $_GET['codEs'];
if (isset($_GET['nomEs'])) $nombreEstacion = $_GET['nomEs'];
if (isset($_GET['ini'])) $fechaInicio = $_GET['ini'];
if (isset($_GET['fin'])) $fechaFin = $_GET['fin'];
if (isset($_GET['codCentro'])) $codCentro = $_GET['codCentro'];
if (isset($_GET['anio'])) $anio = $_GET['anio'];

$arr = explode("-", $fechaInicio);
$mes = $arr[1];

$resultado = mysql_query("SELECT g.nombre, e.estado FROM evento e JOIN grupo g ON e.idgrupo = g.idgrupo WHERE e.idevento = '$idevento' ");
$dato = mysql_fetch_array($resultado);
$grupo  = $dato[0];
$estado = $dato[1];
//if($dato[1] == 'EJE') $estado = "Ejecutado <img src='../../img/ok4.png' alt='ver'>";
if($dato[1] == 'PEN') $estado_res = "Pendiente <img src='../../img/ico_pen.png' alt='pen'>";
if($dato[1] == 'FIN') $estado_res = "Finalizado <img src='../../img/ico_fin.png' alt='fin'>";
if($dato[1] == 'REV') $estado_res = "Revisado <img src='../../img/ico_rev.png' alt='rev'>";

$res = mysql_query("SELECT c.nombre FROM centro c WHERE c.codigo = '$codCentro' ");
$datoRes = mysql_fetch_array($res);
$nombreCentro = $datoRes['nombre'];

//$a = 'path=prev_estacion.php&anio=2016&codCentro=STCB&ini=2016-10-03&fin=2016-10-03&idev=1&codEs=CB0296&nomEs=SAN%20ANTONIO%20CB';
$params = "&anio=$anio&codCentro=$codCentro&ini=$fechaInicio&fin=$fechaFin&idev=$idevento&codEs=$codigoEstacion&nomEs=$nombreEstacion";

?>

<br>
<table width="900" align="center" class="table2">
<caption>Estadisticas de Mantenimiento</caption>

</table>

<table width="900" align="center" class="table2" cellspacing="2">
<tr>
	<td height="20" colspan="2"><strong class="verde"></strong></td>
	<td align="center">
	</td>
</tr>

<form name="amper" method="post" action="<?=$link_modulo_r?>" onSubmit=" return VerifyOne ();">
<input type="hidden" name="path" value="nuevo_r.php" />
<tr height="16">
	<th width="444">Estadisticas de Mantenimiento FEBRERO 2018</th>
	<th width="39"></th>
	<th width="95" align="center">Acciones</th>
</tr>

    <tr onmouseover="setPointer(this, '#DADADA')" onmouseout="setPointer(this, '#f6f7f8')">
        <td class="cafe">E01 - MANTENIMIENTO PREVENTIVO POR CENTRO DE MANTENIMIENTO</td><td></td>
        <td align="center">
            <a class="enlaceboton" href="../../usuarios/modulos/estadistica/022018/001.htm">VER</a>
        </td>
    </tr>

    <tr onmouseover="setPointer(this, '#DADADA')" onmouseout="setPointer(this, '#f6f7f8')">
        <td class="cafe">E02 - MANTENIMIENTO CORRECTIVO POR CENTRO DE MANTENIMIENTO</td><td></td>
        <td align="center">
            <a class="enlaceboton" href="../../usuarios/modulos/estadistica/022018/002.htm">VER</a>
        </td>
    </tr>

    <tr onmouseover="setPointer(this, '#DADADA')" onmouseout="setPointer(this, '#f6f7f8')">
        <td class="cafe">E03 - EXTRA WORK POR CENTRO DE MANTENIMIENTO</td><td></td>
        <td align="center">
            <a class="enlaceboton" href="../../usuarios/modulos/estadistica/022018/003.htm">VER</a>
        </td>
    </tr>

    <tr onmouseover="setPointer(this, '#DADADA')" onmouseout="setPointer(this, '#f6f7f8')">
        <td class="cafe">E04 - MANTENIMIENTO CORRECTIVO POR AREAS</td><td></td>
        <td align="center">
            <a class="enlaceboton" href="../../usuarios/modulos/estadistica/022018/004.htm">VER</a>
        </td>
    </tr>

    <tr onmouseover="setPointer(this, '#DADADA')" onmouseout="setPointer(this, '#f6f7f8')">
        <td class="cafe">E05 - ENERGIA CM ORU - POR SITUACIONES</td><td></td>
        <td align="center">
            <a class="enlaceboton" href="../../usuarios/modulos/estadistica/022018/005.htm">VER</a>
        </td>
    </tr>

    <tr onmouseover="setPointer(this, '#DADADA')" onmouseout="setPointer(this, '#f6f7f8')">
        <td class="cafe">E06 - TRANSMISION CM ORU - POR SITUACIONES</td><td></td>
        <td align="center">
            <a class="enlaceboton" href="../../usuarios/modulos/estadistica/022018/006.htm">VER</a>
        </td>
    </tr>

    <tr onmouseover="setPointer(this, '#DADADA')" onmouseout="setPointer(this, '#f6f7f8')">
        <td class="cafe">E07 - BTS CM ORU - POR SITUACIONES</td><td></td>
        <td align="center">
                <a class="enlaceboton" href="../../usuarios/modulos/estadistica/022018/007.htm">VER</a>
        </td>
    </tr>

    <tr onmouseover="setPointer(this, '#DADADA')" onmouseout="setPointer(this, '#f6f7f8')">
        <td class="cafe">E08 - INTERVENCION A SITIOS CM ORU</td><td></td>
        <td align="center">
            <a class="enlaceboton" href="../../usuarios/modulos/estadistica/022018/008.htm">VER</a>
        </td>
    </tr>

    <tr onmouseover="setPointer(this, '#DADADA')" onmouseout="setPointer(this, '#f6f7f8')">
        <td class="cafe">E09 - TICKET GENERADOS 2018</td><td></td>
        <td align="center">
            <a class="enlaceboton" href="../../usuarios/modulos/estadistica/022018/009.htm">VER</a>
        </td>
    </tr>

    <tr onmouseover="setPointer(this, '#DADADA')" onmouseout="setPointer(this, '#f6f7f8')">
        <td class="cafe">E10 - TICKET GENERADOS CM ORU - POR TECNOLOGIAS</td><td></td>
        <td align="center">
            <a class="enlaceboton" href="../../usuarios/modulos/estadistica/022018/010.htm">VER</a>
        </td>
    </tr>

    <tr onmouseover="setPointer(this, '#DADADA')" onmouseout="setPointer(this, '#f6f7f8')">
        <td class="cafe">E11 - TICKETS GENERADOS CM ORU - POR TIPO DE PROBLEMA</td><td></td>
        <td align="center">
            <a class="enlaceboton" href="../../usuarios/modulos/estadistica/022018/011.htm">VER</a>
        </td>
    </tr>

    <tr onmouseover="setPointer(this, '#DADADA')" onmouseout="setPointer(this, '#f6f7f8')">
        <td class="cafe">E12 - TICKETS GENERADOS CM ORU - POR TIPO DE FALLA</td><td></td>
        <td align="center">
            <a class="enlaceboton" href="../../usuarios/modulos/estadistica/022018/012.htm">VER</a>
        </td>
    </tr>


    <tr onmouseover="setPointer(this, '#DADADA')" onmouseout="setPointer(this, '#f6f7f8')">
        <td class="cafe">...</td><td></td>
        <td align="center">...</td>
    </tr>

</table>
</form>

<form name="amper" method="post" action="<?=$link_modulo?>?path=cronograma_prev.php">
<input name="centro" id="centro" type="hidden" value="<?=$codCentro?>">
<input name="anio" id="anio" type="hidden" value="<?=$anio?>">
<input name="mes" id="mes" type="hidden" value="<?=$mes?>">

<table width="900" align="center" class="table2" cellspacing="2" class="table2">
	<tr>
	<td>
        <a href='<?=$link_modulo?>?path=estadisticas.php' class="enlaceboton"> << ATRAS</a>
    </td>
	</tr>
</table>
</form>

<div><div/>
<script type="text/javascript" src="../../paquetes/autocompletar/ajax.js"></script>
<script type="text/javascript" src="../../paquetes/autocompletar/ajax-dynamic-list.js"></script>
<link href="../../paquetes/autocompletar/ajax-dynamic-list.css" rel="stylesheet" type="text/css" />
<SCRIPT src="../../js/epoch_classes.js" type=text/javascript></SCRIPT>
<LINK href="../../css/epochprime_styles.css" type=text/css rel=stylesheet />
<script src="../../paquetes/nicEdit/nicEdit.js" type="text/javascript"></script>             

<script type=text/javascript>
bkLib.onDomLoaded(function() {
	new nicEditor({buttonList : ['removeformat','bold','italic','underline','html']}).panelInstance('obs');
});
</script>
<script type=text/javascript>
var calendar;
var calendarb;
window.onload = function() {
	calendar = new Epoch('dp_cal','popup',document.getElementById('fecha_ini'));
	calendarb = new Epoch('dp_cal','popup',document.getElementById('fecha_fin'));
}
</script>  

<script type="text/javascript">var GB_ROOT_DIR = "./../../paquetes/greybox/";</script>
<script type="text/javascript" src="../../paquetes/greybox/AJS.js"></script>
<script type="text/javascript" src="../../paquetes/greybox/AJS_fx.js"></script>
<script type="text/javascript" src="../../paquetes/greybox/gb_scripts_no_reload.js"></script>
<link href="../../paquetes/greybox/gb_styles.css" rel="stylesheet" type="text/css" media="all" />
<link href="../../paquetes/tooltip/tooltip.css" rel="stylesheet" type="text/css">
<script language=javascript type="text/javascript" src="../../paquetes/tooltip/tooltip.js"></script>

<script src="../../js/validador.js" type=text/javascript></script>
<script type="text/javascript">
function VerifyOne () {
    if( checkField( document.amper.cliente, isName, false ) &&
	    isNull( document.amper.fecha_ini) &&
		isNull( document.amper.obs) 
		)
		{
			if(confirm("Verifico bien los datos antes de continuar?"))
			{return true;}
			else {return false;}
    }
else {	
return false;
     }
}
</script>