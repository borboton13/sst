<?php
$web=$_SESSION["web"];
/*
if (isset($_GET['idev'])) $idEvento     = $_GET['idev'];
if (isset($_GET['codEs'])) $codigoEstacion = $_GET['codEs'];
if (isset($_GET['nomEs'])) $nombreEstacion = $_GET['nomEs'];
if (isset($_GET['ini'])) $fechaInicio = $_GET['ini'];
if (isset($_GET['fin'])) $fechaFin = $_GET['fin'];
if (isset($_GET['centro'])) $codCentro = $_GET['centro'];
if (isset($_GET['anio'])) $anio = $_GET['anio'];

$arr = explode("-", $fechaInicio);
$mes = $arr[1];

$resultado = mysql_query("SELECT g.nombre, e.estado FROM evento e JOIN grupo g ON e.idgrupo = g.idgrupo WHERE e.idevento = '$idEvento' ");
$dato = mysql_fetch_array($resultado);
$grupo  = $dato[0];
$estado = $dato[1];
if($dato[1] == 'EJE') $estado = "Ejecutado <img src='../../img/ok4.png' alt='ver'>";
if($dato[1] == 'PEN') $estado = "Pendiente <img src='../../img/pen8.png' alt='ver'>";

$res = mysql_query("SELECT c.nombre FROM centro c WHERE c.codigo = '$codCentro' ");
$datoRes = mysql_fetch_array($res);
$nombreCentro = $datoRes['nombre'];
*/
?>
<form name="amper" method="post" action="<?=$link_modulo_r?>" onSubmit=" return VerifyOne ();">
<input type="hidden" name="path" value="nuevo_r.php" />
<div align="center" class="title">DETALLES DEL MANTENIMIENTO</div>
<table width="900" align="center" class="table2">
<caption>DATOS DE LA ESTACION</caption>
    <tbody>
	<tr>
	  <th width="25%">Cliente:</th>
	  <td width="75%" class="cafe">ENTEL S.A.</td>
	</tr>

	<tr>
	  <th width="25%">Centro de Mantenimiento:</th>
	  <td width="75%" class="resaltar"><? echo $nombreCentro; ?></td>
	</tr>

        <tr>
	  <th width="25%">Estacin:</th>
	  <td width="75%" class="resaltar"><?php echo $codigoEstacion . " - " . $nombreEstacion ?></td>
	</tr>

        <tr>
	  <th width="25%">Fecha:</th>
	  <td width="75%" class="cafe"><?php echo $fechaInicio; if($fechaInicio != $fechaFin) echo " - " . $fechaFin; ?></td>
	</tr>

        <tr>
	  <th width="25%">Estado:</th>
	  <td width="75%" class="cafe"><?php echo $estado; ?></td>
	</tr>

	<tr>
	  <th width="25%">Grupo de trabajo:</th>
	  <td width="75%" class="cafe"><? echo $grupo; ?></td>
	</tr>

    </tbody>
</table>

<table width="900" align="center" class="table2" cellspacing="2" class="table2">
<tr>
	<td height="20" colspan="2"><strong class="verde">INFORMES DE MANTENIMIENTO:</strong></td>
	<td align="center">
		<form name="amper" method="post" action="<?=$link_modulo?>?path=cronograma_prev.php">
			<!--<input name="centro" id="centro" type="hidden" value="<?/*=$codCentro*/?>">
			<input name="anio" id="anio" type="hidden" value="<?/*=$anio*/?>">
			<input name="mes" id="mes" type="hidden" value="<?/*=$mes*/?>">-->
			<input name="atras" type="submit"  value=" Nuevo " />
		</form>
	</td>
	<!--href='$link_modulo?path=prev_estacion.php&anio=$anio-->
</tr>
<tr height="16">
<th width="414">Archivos </th>
<th width="79">Tama&ntilde;o</th>
<th width="95"></th>
</tr>
<?php
$resultado = mysql_query("
SELECT d.iddocumento, d.titulo, d.nombre
FROM documento d
WHERE d.idevento = $idEvento");
$filas=mysql_num_rows($resultado);

//$carpeta_id = $pro_key."_".$id_st_cronograma_informes;


$carpeta    = "archivos_st/ST_PREV/$anio/$mes/$codCentro/$codigoEstacion";
//$dir        = "../../".$carpeta."/";
//$dir_ext    = $web."/".$carpeta."/";

$ruta = "archivos_st/ST_PREV/$anio/$mes/$codCentro/$codigoEstacion";
$dir        = "../../".$ruta."/";
$dir_ext    = $web."/".$ruta."/";
$directorio = "../../".$ruta;

if($filas!=0){
    $j=0;
    while($dato_arch=mysql_fetch_array($resultado)){

        $nombre = $dato_arch['nombre'];
        $titulo = $dato_arch['titulo'];

		$tam = filesize($dir.$nombre)/1024;
		$ext = substr(strrchr($nombre, '.'), 1);

		if($j%2==0){
				$rowt="#f6f7f8";
		}else{
				$rowt="#f1f1f1";
		}

	?>
	<tr height="25" onmouseover="setPointer(this, '#DADADA')" onmouseout="setPointer(this, '<?=$rowt?>')">
	<td style="background:<?=$rowt?>"><label title="<?=$nombre?>"><a href="<?=$dir_ext.$nombre;?>" target="_blank" class="enlaceboton">
	<img src="../../img/icons/icon_<?=$ext?>.gif" border="0" align="top"><?=$titulo?></a></label></td>
	<TD style="background:<?=$rowt?>"><div align="right"><? echo round($tam)." Kb"; ?></div></TD>
	<td style="background:<?=$rowt?>"><div align="center">
	<a href="<?=$dir_ext.$nombre;?>" target="_blank" class="enlaceboton">
            <img src="../../img/icons/icon_<?=$ext?>.gif" border="0" align="top">
        </a>
        <a title="Descargar Archivo ahora!" href="../../funciones/descargar_archivo.php?download=<?=$nombre?>&directorio=<?=$carpeta?>" target="_blank" class="enlaceboton">
            <img border=0 src="../../img/download.gif" >
        </a>
		<!--
        <a title="Eliminar Archivo"
           class="enlaceboton"
           href="<?=$link_modulo_r?>?path=eliminar_archivo_prev.php&
                                    iddocumento=<?=$dato_arch['iddocumento']?>&
                                    idev=<?=$idEvento?>&
                                    codEs=<?=$codigoEstacion?>&
                                    nomEs=<?=$nombreEstacion?>&
                                    ini=<?=$fechaInicio?>&
                                    fin=<?=$fechaFin?>&
                                    centro=<?=$codCentro?>&
                                    anio=<?=$anio?>&
                                    nomfile=<?=base64_encode($nombre)?>">
            <img src="../../img/ico_cancel.gif" border="0" onclick="return confirm('DIMESAT SRL: Esta seguro que desea eliminar el Archivo:  <?=$nombre?> ?');">
        </a>
        <a href="<?=$link_modulo_r?>?path=adjuntar_archivo_editar.php&id_st_cronograma_informes=<?=$id_st_cronograma_informes?>&item=<?=$dato_arch['item']?>&pro_key=<?=$pro_key?>&volver=3" class="enlace_s_menu" onclick="return GB_showCenter('ADICIONAR ARCHIVO', this.href,182, 700)">
            <img src="../../img/change.gif" alt="ADICIONAR ARCHIVO" vspace="0" border="0" align="absbottom">
        </a>
		-->
		</div>
        </td>
	</tr>
	<?php
	$j++;
	}
}
else{
	?>
	<tr height="25">
	<td colspan="3"><div class="marcar">Sin Archivos</div></td>
	</tr>
	<?}?>
<tr><?php /*print($link_modulo_r);*/ ?>
<td height="23" colspan="3">
<div align="right">
<?php if($nively == 1){  ?>
<a href="<?=$link_modulo_r?>?path=adjuntar_archivo_prev.php&idEvento=<?=$idEvento?>&anio=<?=$anio?>&codCentro=<?=$codCentro?>&ini=<?=$fechaInicio?>&fin=<?=$fechaFin?>&codEs=<?=$codigoEstacion?>&nomEs=<?=$nombreEstacion?>"
   class="enlace_s_menu"
   onclick="return GB_showCenter('ADICIONAR ARCHIVO', this.href,182, 700)">
   <img src="../../img/add_archivos.gif" alt="ADICIONAR ARCHIVO" vspace="0" border="0" align="absbottom"> <B>Adjuntar Informe</B>
</a>
<?php } ?>
</div>
</td>
</tr>
</table>
</form>

<form name="amper" method="post" action="<?=$link_modulo?>?path=cronograma_prev.php">
<input name="centro" id="centro" type="hidden" value="<?=$codCentro?>">
<input name="anio" id="anio" type="hidden" value="<?=$anio?>">
<input name="mes" id="mes" type="hidden" value="<?=$mes?>">

<table width="900" align="center" class="table2" cellspacing="2" class="table2">
	<tr>
	<td><input name="atras" type="submit"  value="<< Atras" /></td>
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