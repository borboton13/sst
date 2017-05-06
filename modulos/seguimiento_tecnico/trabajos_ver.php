<?
if($nively=='1'){ $adm=1;}
$nro = base64_decode($_GET["nro"]);
?>
<table width="98%" border="1" align="center" cellspacing="0" class="table3">
<caption>
EQUIPOS/SERVICIOS PARA EL SEGUIMIENTO TECNICO DEL PROYECTO
</caption>
	<tr>
	<td valign="bottom">
	<? 
	$consulta="SELECT c.razon_social,s.declaracion_proyecto,date_format(s.fecha_inicio,'%d/%m/%Y'),date_format(s.fecha_final,'%d/%m/%Y'),concat(u.nombre, ' ', u.ap_pat),s.fecha_registro,c.id 
FROM (st_proyecto s INNER JOIN clientes c ON s.id_cliente=c.id) INNER JOIN usuarios u ON s.id_usuario=u.id WHERE s.id_st_proyecto='".$nro."'";
	$resultado=mysql_query($consulta);
	$filas=mysql_num_rows($resultado);
	if($filas!=0)
	{ 
	while($dato=mysql_fetch_array($resultado))
	 {
	 $razon_social=$dato[0]; 
	 $declaracion_proyecto=$dato[1]; 
	 $fecha_inicio=$dato[2]; 
	 $fecha_final=$dato[3]; 
	 if($fecha_final=="00/00/0000") $fecha_final="Indefinido";
	 $id_usuario=$dato[4]; 
	 $fecha_registro=$dato[5]; 
	 $id_cliente=$dato[6]; 
	 }
	}
	?>
	Nro: <span class="title"><?=$nro;?></span><br>
	Ingresado por: <span class="title6"><?=$id_usuario;?></span><br>
	Cliente:  <span class="title7"><?=$razon_social;?></span><br>
	Fecha Inicial: <span class="title6"><?=$fecha_inicio;?></span><br>
	Fecha final: <span class="title6"><?=$fecha_final;?></span><br>
	Fecha Registro: <span class="title6"><?=$fecha_registro;?> </span></td>
	<td width="300" rowspan="2" valign="top" class="marco"><form name="amper" method="post" action="" >		
	  <div align="right"><span class="rojo">*</span>Producto/Servicio:
	    <select name="producto" class="Text_left">
<option value="0" class="naranja" selected> Seleccionar Producto... </option>
<?
$resultado=mysql_query("SELECT sub_grupo FROM parametrica WHERE grupo='st_archivo'");
while($dato=mysql_fetch_array($resultado))
{ echo "<option value='".$dato['sub_grupo']."'>".$dato['sub_grupo']."</option>"; }	  
?>
</select>
<br>
	        <span class="rojo">*</span>Departamento:	    
	    <select name="departamento" id="departamento" class="buscar">
	      <option value="La Paz" selected>La Paz</option>	      
		  <option value="Oruro">Oruro</option>
		  <option value="Potosi">Potosi</option>
		  <option value="Cochabamba">Cochabamba</option>
		  <option value="Chuquisaca">Chuquisaca</option>
		  <option value="Tarija">Tarija</option>
		  <option value="Pando">Pando</option>
		  <option value="Beni">Beni</option>
		  <option value="Santa Cruz">Santa Cruz</option>
		  <option value="Otro Lugar">Otro Lugar</option>
	      </select>
	        	        <br>
	        <span class="rojo">*</span>Estacion:
	        <input name="ubicacion" type="text" class="Text_left" id="ubicacion" size="25" maxlength="100">
	    <br>
	        Marca:
	    <input name="marca" type="text" class="Text_left" id="marca" size="25" maxlength="60">			
			<br>
	        S/N:
            <input name="sn" type="text" class="Text_left" id="sn" size="20" maxlength="20"> 
			<br>
	        <span class="rojo">*</span>Detalle General:
            <input name="caracteristicas" type="text" class="Text_left" id="caracteristicas" size="25" maxlength="60">
            <br><input name="nro" type="hidden"  id="nro" value="<?=$nro;?>">
	    <input name="adicionar" type="button" id="adicionar" value="Adicionar" onClick=" return VerifyOne ();" >
	    <div id="cargando"></div>
	    </div>
	</form></td>
	</tr>
	<tr>
	  <td><table>
	    <tr>
	      <td class="marco"><a class="enlaceboton" href="../../pdf/pdf_st_listado.php?<? echo "nro=".base64_encode($nro); ?>" onclick="openNewWindowhtml( this, '800', '590' );return false;"><img src="../../img/imp.gif" alt="Ver Listado en PDF" width="20" height="20" border="0" align="absmiddle" /> Ver Listado en PDF</a></td>
	      <td class="marco"><a class="enlaceboton" href="../../excel/excel_st_listado.php?nro=<?=base64_encode($nro);?>" onclick="openNewWindowhtml( this, '800', '590' );return false;"><img src="../../img/excel_ico.gif" alt="Ver Listado en Excel" width="16" height="16" border="0" align="absmiddle" /> Ver Listado en Excel</a></td>
	      <td class="marco"><form method="post" name="periodos" id="periodos">
	        <img src="../../img/filtrar_s.gif" alt="buscar" width="24" height="20"  align="absbottom" />
              <select name="select" class='selectbuscar' onchange='document.location=this.options[this.selectedIndex].value'>
                <option value='0' value=# >
                 [Seleccione un Periodo...] 
                </option>
                <?
$periodos=0;
$resultado=mysql_query("SELECT descripcion FROM parametrica WHERE grupo='st'");
while($dato=mysql_fetch_array($resultado))
{
$datox=mysql_fetch_array(mysql_query("SELECT MAX(periodo) AS periodo FROM ".$dato['descripcion']." WHERE id_st_proyecto='".$nro."'"));
if($datox['periodo']>=$periodos) $periodos=$datox['periodo'];
}

for($k=1;$k<=$periodos;$k++)
{
echo "<option value='".$link_modulo."?path=trabajos_ver_periodos.php&periodo=$k&nro=".base64_encode($nro)."' class='naranja'>".$k."&deg; Periodo</option>";
}										  
?>
              </select>
          </form></td>
	      <td class="marco"><a class="enlaceboton" href="<?=$link_modulo?>?path=trabajos_actividades_insertar_por_barrido.php&nro=<?=base64_encode($nro);?>"><img src="../../img/formIcon.png" width="18" height="18"  border="0" align="absmiddle" /> Programar por barrido</a></td>
<td class="marco"><a class="enlaceboton" href="<?=$link_modulo?>?path=trabajos_ver_correlativo.php&nro=<?=$nro;?>"><img src="../../img/ico_detalles.gif" width="16" height="19"  border="0" align="absmiddle" /> Ver por Correlativo</a></td>
        </tr>
	    </table>
	  </td>
  </tr>
</table>
<?
include('trabajos_listar.php');
?>
<DIV id="trabajos_listar"><?=mostrar_detalles($nro);?></DIV>				  
<br>
<table width="98%" align="center" class="table3">
  <tr>
    <td><strong class="rojo">Declaración del proyecto:</strong><br>
      <span class="small">
      <?=nl2br($declaracion_proyecto);?>
    </span></td>
  </tr>
</table>
<script src="../../js/ajax_st_detalles.js" type=text/javascript></script>
<SCRIPT src="../../js/validador.js" type=text/javascript></SCRIPT>
<link href="../../paquetes/greybox/gb_styles.css" rel="stylesheet" type="text/css" media="all" />
<script type="text/javascript">

var GB_ROOT_DIR = "./../../paquetes/greybox/";
		
function VerifyOne () {
	
   if(
    checkField( document.amper.producto, isName, false ) &&
	checkField( document.amper.marca, isName, true ) &&
	checkField( document.amper.caracteristicas, isName, false ) &&
	checkField( document.amper.sn, isName, true ) &&
	checkField( document.amper.ubicacion, isName, false )
	)
	{
	
	Enviar_datos_st('trabajos_listar'); return false;
	}
else {	
return false;
     }
}
</script>    
<script type="text/javascript" src="../../paquetes/greybox/AJS.js"></script>
<script type="text/javascript" src="../../paquetes/greybox/AJS_fx.js"></script>
<script type="text/javascript" src="../../paquetes/greybox/gb_scripts_no_reload.js"></script>
