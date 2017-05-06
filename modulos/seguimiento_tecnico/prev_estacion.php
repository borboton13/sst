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
<!--  x=x	-->
<!--<form name="amper" method="post" action="<?/*=$link_modulo_r*/?>" onSubmit=" return VerifyOne ();">
<input type="hidden" name="path" value="nuevo_r.php" />-->
<!--<div align="center" class="title">DETALLES DEL MANTENIMIENTO</div>-->
<br>
<table width="900" align="center" class="table2">
<caption>MANTENIMIENTO PREVENTIVO</caption>
    <tbody>
	<tr>
	  <th width="25%">Cliente:</th>
	  <td width="75%" class="cafe" colspan="2">ENTEL S.A.</td>
	</tr>
	
	<tr>
	  <th width="25%">Centro de Mantenimiento:</th>
	  <td width="75%" class="resaltar" colspan="2"><? echo $nombreCentro; ?></td>
	</tr>

        <tr>
	  <th width="25%">Estacion:</th>
	  <td width="75%" class="resaltar" colspan="2"><?php echo $codigoEstacion . " - " . $nombreEstacion ?></td>
	</tr>

        <tr>
	  <th width="25%">Fecha:</th>
	  <td width="75%" class="cafe" colspan="2"><?php echo $fechaInicio; if($fechaInicio != $fechaFin) echo " - " . $fechaFin; ?></td>
	</tr>

    <tr>
	  <th width="25%">Estado:</th>
	  <td width="35%" class="cafe"><?php echo $estado_res; ?></td>
	  <td width="40%" class="">
		  <? if(($admin || $tech) && ($estado == 'PEN')){?>
		  <form name="amper" method="post" action="<?=$link_modulo_r?>" onSubmit=" return VerifyOne ();">
			  <input type="hidden" name="path" value="cambiar_estado_r.php" />
			  <input type="hidden" name="params" value="<?=base64_encode($params)?>" />
			  <input type="hidden" name="idevento" value="<?=$idevento?>" />
			  <input type="hidden" name="estado" value="FIN" />
			  <input name="Finalizar" type="submit"  value="Finalizar" onclick="return confirm('DIMESAT SRL: Esta seguro de Finalizar el Mantenimiento?');" />
			  &nbsp; <img src='../../img/ico_fin.png' alt='ver'> Al finalizar ya no podra realizar cambios
		  </form>
		  <? } ?>
		  <? if($admin && $estado == 'FIN'){?>
			  <form name="amper" method="post" action="<?=$link_modulo_r?>" onSubmit=" return VerifyOne ();">
				  <input type="hidden" name="path" value="cambiar_estado_r.php" />
				  <input type="hidden" name="params" value="<?=base64_encode($params)?>" />
				  <input type="hidden" name="idevento" value="<?=$idevento?>" />
				  <input type="hidden" name="estado" value="REV" />
				  <input name="Revisado" type="submit"  value="Revisado" onclick="return confirm('DIMESAT SRL: Esta seguro de cambiar el estado del Mantenimiento a REVISADO?');" />
				  &nbsp; <img src='../../img/ico_rev.png' alt='ver'> Cambia de estado a REVISADO
			  </form>
		  <? } ?>
		  <?/* if($admin && $estado == 'REV'){*/?><!--
			  <form name="amper" method="post" action="<?/*=$link_modulo_r*/?>" onSubmit=" return VerifyOne ();">
				  <input type="hidden" name="path" value="cambiar_estado_r.php" />
				  <input type="hidden" name="params" value="<?/*=base64_encode($params)*/?>" />
				  <input type="hidden" name="idevento" value="<?/*=$idevento*/?>" />
				  <input type="hidden" name="estado" value="PEN" />
				  <input name="Revertir" type="submit"  value="Revertir" onclick="return confirm('DIMESAT SRL: Esta seguro de cambiar el estado del Mantenimiento a PENDIENTE?');" />
				  <img src='../../img/ico_pen.png' alt='ver'> Cambia de estado a PENDIENTE para modificar
			  </form>
		  --><?/* } */?>
	  </td>
	</tr>
	
	<tr>
	  <th width="25%">Grupo de trabajo:</th>
	  <td width="35%" class="cafe"><? echo $grupo; ?></td>
	  <td width="40%">
		  <? if($admin && ($estado == 'REV' || $estado == 'FIN')){?>
			  <form name="amper" method="post" action="<?=$link_modulo_r?>" onSubmit=" return VerifyOne ();">
				  <input type="hidden" name="path" value="cambiar_estado_r.php" />
				  <input type="hidden" name="params" value="<?=base64_encode($params)?>" />
				  <input type="hidden" name="idevento" value="<?=$idevento?>" />
				  <input type="hidden" name="estado" value="PEN" />
				  <input name="Revertir" type="submit"  value="Revertir" onclick="return confirm('DIMESAT SRL: Esta seguro de cambiar el estado del Mantenimiento a PENDIENTE?');" />
				  <img src='../../img/ico_pen.png' alt='ver'> Cambia de estado a PENDIENTE para modificar
			  </form>
		  <? } ?>
	  </td>
	</tr>
        
    </tbody>
</table>

<table width="900" align="center" class="table2" cellspacing="2">
<tr>
	<td height="20" colspan="2"><strong class="verde">INFORMES DE MANTENIMIENTO</strong></td>
	<td align="center">
		<? if(($admin || $tech) && ($estado == 'PEN')){?>
		<a href="<?=$link_modulo_r?>?path=prev_select_form.php&idevento=<?=$idevento?>" class="enlace_s_menu" onclick="return GB_showCenter('MANTENIMIENTO PREVENTIVO', this.href,182, 700)">
			<b>Nuevo Informe</b>
		</a>
		<? } ?>
	</td>
</tr>
<!--  x=x	-->
<form name="amper" method="post" action="<?=$link_modulo_r?>" onSubmit=" return VerifyOne ();">
<input type="hidden" name="path" value="nuevo_r.php" />
<tr height="16">
	<th width="444"></th>
	<th width="39"></th>
	<th width="95" align="center">Acciones</th>
</tr>

<?
	$resultado = mysql_query("
	SELECT f.id, f.codigo, f.nombre, f.titulo
	FROM formulario_mtto f
	WHERE f.idevento = $idevento ORDER BY f.codigo");

	$filas = mysql_num_rows($resultado);

	if($filas != 0) {
		$j = 0;
		while ($arr = mysql_fetch_array($resultado)) {
			$idformtto 	= $arr['id'];
			$codigo	   	= $arr['codigo'];
			$nombre 	= $arr['nombre'];
			$titulo 	= $arr['titulo'];

			if($j%2==0) $rowt="#f6f7f8"; else $rowt="#f1f1f1";
			?>
			<tr onmouseover="setPointer(this, '#DADADA')" onmouseout="setPointer(this, '<?=$rowt?>')">
				<td style="background:<?=$rowt?>" class="cafe"><? echo $codigo . " - " . $titulo?></td>
				<td style="background:<?=$rowt?>"></td>
				<td style="background:<?=$rowt?>">
					<div align="center">

						<!--<a href="#" target="_blank" class="enlaceboton">
							<img src="../../img/icons/icon_pdf.gif" border="0" align="top">
						</a>-->
						<?php if($codigo=='P001' || $codigo=='P002' ||
								 $codigo=='P003' || $codigo=='P004' ||
								 $codigo=='P005' || $codigo=='P006' ||
								 $codigo=='P007' || $codigo=='P008' ||
								 $codigo=='P009' || $codigo=='P010' ||
								 $codigo=='P011' ||	$codigo=='P012' ||
								 $codigo=='P013' || $codigo=='P014' ||
								 $codigo=='P015' || $codigo=='P016' ||
								 $codigo=='P017' || $codigo=='P018'

						) 	{ ?>
						<a class="enlaceboton"
						   href="../../pdf/pdf_st_<?=$codigo?>.php?cod=<?=base64_encode($codigo)?>&idformtto=<?=base64_encode($idformtto)?>"
						   onClick="openNewWindowhtml( this, '800', '590' );return false;">
							<img src='../../img/icons/icon_pdf.gif' alt='Ver Informe en PDF' border="0">
						</a>
						<?php } ?>
						<!--<a class="enlaceboton" href="../../pdf/pdf_st_prev_dom.php">
							<img src='../../img/icons/icon_pdf.gif' alt='Ver Informe en PDF' border="0">
						</a>-->

						<!-- Editar Formulario Mtto -->
						<? if(($client) || ($estado == 'PEN')){?>
						<a title="Ver/Editar Formulario" class="enlace_s_menu"
						   href="<?=$link_modulo?>?path=prev_editar_form_<?=$codigo?>.php&
						   							idformtto=<?=$idformtto?>&
						   							idevento=<?=$idevento?>&
													params=<?=base64_encode($params)?>">
							<img src="../../img/change.gif" alt="Editar Form" vspace="0" border="0" align="absbottom">
						</a>
						<? } ?>
						<!-- Eliminar Formulario Mtto -->
						<? if(($admin || $tech) && ($estado == 'PEN')){?>
						<a title="Eliminar Formulario"
						   class="enlaceboton"
						   href="<?=$link_modulo_r?>?path=eliminar_formulario_mtto.php&idform=<?=base64_encode($idformtto)?>&codigo=<?=$codigo?>&params=<?=base64_encode($params)?>">
							<img src="../../img/ico_cancel.gif" border="0" onclick="return confirm('DIMESAT SRL: Esta seguro que desea eliminar el FORMULARIO:  <?=$titulo?> ?');">
						</a>
						<? } ?>
					</div>
				</td>
			</tr>
			<?	$j++;
		}
	}

?>

	<tr height="16">
		<th colspan="3">Otros Informes y archivos</th>
	</tr>
	<?php
	$resultado = mysql_query("
SELECT d.iddocumento, d.titulo, d.nombre
FROM documento d
WHERE d.idevento = $idevento");
	$filas = mysql_num_rows($resultado);
	$carpeta    = "archivos_st/ST_PREV/$anio/$mes/$codCentro/$codigoEstacion";
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

			if($j%2==0) $rowt="#f6f7f8"; else $rowt="#f1f1f1";
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
						<? if(($admin || $tech) && ($estado == 'PEN')){?>
						<a title="Eliminar Archivo"
						   class="enlaceboton"
						   href="<?=$link_modulo_r?>?path=eliminar_archivo_prev.php&
                                    iddocumento=<?=$dato_arch['iddocumento']?>&
                                    ini=<?=$fechaInicio?>&
                                    codEs=<?=$codigoEstacion?>&
                                    nombre=<?=$nombre?>&
                                    centro=<?=$codCentro?>&
                                    params=<?=base64_encode($params)?>">
							<img src="../../img/ico_cancel.gif" border="0" onclick="return confirm('DIMESAT SRL: Esta seguro que desea eliminar el Archivo:  <?=$nombre?> ?');">
						</a>
						<?}?>
					</div>
				</td>
			</tr>
			<?php
			$j++;
		}
	}
?>

<tr>
<td height="23" colspan="3">
<div align="right">
<? if(($admin || $tech) && ($estado == 'PEN')){?>
<a href="<?=$link_modulo_r?>?path=adjuntar_archivo_prev.php&idEvento=<?=$idevento?>&anio=<?=$anio?>&codCentro=<?=$codCentro?>&ini=<?=$fechaInicio?>&fin=<?=$fechaFin?>&codEs=<?=$codigoEstacion?>&nomEs=<?=$nombreEstacion?>"
   class="enlace_s_menu" 
   onclick="return GB_showCenter('ADICIONAR ARCHIVO', this.href,182, 700)">
   <img src="../../img/add_archivos.gif" alt="ADICIONAR ARCHIVO" vspace="0" border="0" align="absbottom"> <B>Adjuntar archivo</B>
</a>
<? } ?>
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