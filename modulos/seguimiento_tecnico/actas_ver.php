<?php
$web=$_SESSION["web"];

if (isset($_GET['idacta'])) $idacta = base64_decode($_GET["idacta"]);

$resultado = mysql_query("SELECT a.codigo, a.carpeta, a.descripcion, a.fechainicio, a.fechafin FROM actas a WHERE a.idacta = '$idacta' ");
$dato = mysql_fetch_array($resultado);
$codigo      = $dato[0];
$carpeta     = $dato[1];
$descripcion = $dato[2];
$fechainicio = $dato[3];
$fechafin    = $dato[4];


?>

<br>
<table width="900" align="center" class="table2">
<caption>ACTAS DE MANTENIMIENTO</caption>
    <tbody>
	<tr>
	  <th width="25%">C&oacute;digo:</th>
	  <td width="75%" class="cafe" colspan="2"><? echo $codigo; ?></td>
	</tr>
	
	<tr>
	  <th width="25%">Fecha Inicio:</th>
	  <td width="75%" class="resaltar" colspan="2"><? echo $fechainicio; ?></td>
	</tr>

        <tr>
	  <th width="25%">Fecha Fin:</th>
	  <td width="75%" class="resaltar" colspan="2"><?php echo $fechafin; ?></td>
	</tr>

    <tr>
	  <th width="25%">Descripci&oacute;n:</th>
	  <td width="75%" class="cafe" colspan="2"><?php echo $descripcion; ?></td>
	</tr>
        
    </tbody>
</table>

<table width="900" align="center" class="table2" cellspacing="2">
<tr>
	<td height="20" colspan="2"><strong class="verde">ACTAS:</strong></td>
	<td align="center"></td>
</tr>
<!--  x=x	-->
<form name="amper" method="post" action="<?=$link_modulo_r?>" onSubmit=" return VerifyOne ();">
<input type="hidden" name="path" value="nuevo_r.php" />
<tr height="16">
	<th width="444"></th>
	<th width="39"></th>
	<th width="95" align="center">Acciones</th>
</tr>

	<?php
    $resultado = mysql_query("SELECT d.iddocumentoacta, d.titulo, d.nombredoc FROM documentoacta d WHERE d.idacta = $idacta");
	$filas = mysql_num_rows($resultado);
	$carpeta_path = "archivos_st/actas";
	$ruta = "archivos_st/actas/".$carpeta;
	$dir        = "../../".$ruta."/";
	$dir_ext    = $web."/".$ruta."/";
	$directorio = "../../".$ruta;

	if($filas!=0){
		$j=0;
		while($dato_arch=mysql_fetch_array($resultado)){

            $iddocumentoacta = $dato_arch['iddocumentoacta'];
			$nombre = $dato_arch['nombredoc'];
			$titulo = $dato_arch['titulo'];
			$tam = filesize($dir.$nombre)/1024;
			$ext = substr(strrchr($nombre, '.'), 1);

			if($j%2==0) $rowt="#f6f7f8"; else $rowt="#f1f1f1";
			?>
			<tr height="25" onmouseover="setPointer(this, '#DADADA')" onmouseout="setPointer(this, '<?=$rowt?>')">
				<td style="background:<?=$rowt?>"><label title="<?=$nombre?>"><a href="<?=$dir_ext.$nombre;?>" target="_blank" class="enlaceboton">
							<img src="../../img/icons/icon_<?=$ext?>.gif" border="0" align="top"><?=$titulo?></a></label>
                </td>
				<td style="background:<?=$rowt?>">
                    <div align="right"><? echo round($tam)." Kb"; ?></div>
                </td>
				<td style="background:<?=$rowt?>"><div align="center">
						<a href="<?=$dir_ext.$nombre;?>" target="_blank" class="enlaceboton">
							<img src="../../img/icons/icon_<?=$ext?>.gif" border="0" align="top">
						</a>
						<a title="Descargar Archivo ahora!" href="../../funciones/descargar_archivo.php?download=<?=$nombre?>&directorio=<?=$carpeta_path?>" target="_blank" class="enlaceboton">
							<img border=0 src="../../img/download.gif" >
						</a>
						<? if($admin){?>
						<a title="Eliminar Archivo"
						   class="enlaceboton"
						   href="<?=$link_modulo_r?>?path=eliminar_archivo_acta.php&iddocumentoacta=<? echo base64_encode($iddocumentoacta) ?>&carpeta=<? echo base64_encode($carpeta) ?>&idacta=<? echo base64_encode($idacta) ?>&nombre=<? echo base64_encode($nombre) ?>">
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
    <? if($admin){?>
        <a href="<?=$link_modulo_r?>?path=adjuntar_archivo_acta.php&idacta=<?=$idacta?>&carpeta=<?=$carpeta?>" class="enlace_s_menu" onclick="return GB_showCenter('ADICIONAR ARCHIVO', this.href,182, 700)">
           <img src="../../img/file_upload.png" alt="ADICIONAR ARCHIVO" vspace="0" border="0" align="absbottom"> <B>Adjuntar archivo</B>
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
	<td><input onClick="location.href='<?=$mst?>actas.php'" class="btn_dark" type="button" value="Atras"></td>
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