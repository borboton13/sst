<?php
if($nively=='1'){ $adm=1;}
include("../../funciones/class.paginado.php");
if (isset($_GET['pagina'])){
$pagina = $_GET['pagina'];
}
?>
<? if($admin){ ?>
<div align="center"><span class="title">MANTENIMIENTO CORRECTIVO</span></div>
<? } ?>
<table width="100%" class="table4">
<tr>
    <td colspan="3" class="paginado">
        <div align="left">
        <?php
        $rs = new paginado($conexion);
        $rs->pagina($pagina);
        $rs->propagar("path");
        $rs->porPagina(12);
        if(!$rs->query("SELECT s.id_st_proyecto,c.razon_social,s.declaracion_proyecto,date_format(s.fecha_inicio,'%d/%m/%Y'),date_format(s.fecha_final,'%d/%m/%Y'),concat(u.nombre, ' ', u.ap_pat),s.fecha_registro FROM (st_proyecto s INNER JOIN clientes c ON s.id_cliente=c.id) INNER JOIN usuarios u ON s.id_usuario=u.id ORDER BY s.id_st_proyecto DESC"))
        {    die( $rs->error() ); }
        echo "Mostrando ".$rs->desde()." - ".$rs->hasta()." de un total de ".$rs->total()."<br>"; ?>
        </div>
    </td>
    <td colspan="5" class="paginado">
        <div align="right">
            <input class="btn_dark" onClick="location.href='<?=$mst?>nuevo.php'" type="button" value="Nuevo">
        </div>
    </td>
</tr>			        
	<tr>
	<th width="6%" height="20"><div align="center">COD</div></th>
	<th  width="17%"><div align="center">CLIENTE</div></th>
	<th  width="6%"><div align="center">INICIO </div></th>
	<th  width="6%"><div align="center">FIN</div></th>
	<th  width="40%"><div align="center">DECLARACION</div></th>
	<!--<th  width="10%"><div align="center">REGISTRO</div></th>-->
	<th  width="18%"><div align="center">VISTA</div></th>
	<th  width="2%"><div align="center"></div></th>
	</tr>					  
<?php

  $i=0; 
  while($dato = $rs->obtenerArray())
 {
     $id_st_proyecto=$dato[0];
     $razon_social=$dato[1]; 
	 $declaracion_proyecto=nl2br($dato[2]); 
	 $fecha_inicio=$dato[3]; 
	 $fecha_final=$dato[4];
	 if($fecha_final=="00/00/0000") $fecha_final="Indefinido";
	 $id_usuario=$dato[5]; 
	 $fecha_registro=$dato[6];
///////////
	 $i++;
	 if($i%2==0)
	{
	$rowt="#f6f7f8";
	}
	else
	{
	$rowt="#f1f1f1";
	}
	echo"<tr height='25' bgcolor='$rowt' onmouseover=\"setPointer(this, '#DADADA')\" onmouseout=\"setPointer(this, '$rowt')\"> 
            <td valign='top'><DIV ALIGN='CENTER' class='smallmed'>$id_st_proyecto</DIV></td>
            <td valign='top'>$razon_social</td>			          
            <td valign='top'><DIV ALIGN='CENTER'>$fecha_inicio</DIV></td>
			<td valign='top'><DIV ALIGN='CENTER'>$fecha_final</DIV></td>
			<td align='justify'><span class='small'>$declaracion_proyecto</span></td>
            <!--<td valign='top'><span class='small'><strong>$id_usuario</strong><br>$fecha_registro</span></td>-->
            <td valign='top'><a href='".$link_modulo."?path=trabajos_ver_correlativo.php&nro=".$id_st_proyecto."' class='enlaceboton'>".'<img src="../../img/ico_detalles.gif" width="16" height="19"  border="0" align="absmiddle" />'."Por Correlativo</a> <a href='".$link_modulo."?path=trabajos_ver.php&nro=".base64_encode($id_st_proyecto)."' class='enlaceboton'>".'<img src="../../img/informe_detalles.gif" width="16" height="16"  border="0" align="absmiddle" />'."Por estacion</a> </td>
			<td valign='top'>";
if($adm){
echo"<a href='".$link_modulo_r."?path=trabajo_eliminar.php&id_proyecto=".base64_encode($id_st_proyecto)."' onclick='return confirm(\"AMPER SRL: Esta seguro que desea eliminar este Proyecto, antes debe vaciar todo su contenido, este es un procedimiento que garantizara que no borre todos los registros por completo:  $id_st_proyecto ?\");'><img src='../../img/actionCancel.gif' alt='ELIMINAR PROYECTO' border=\"0\" align=\"absmiddle\"></a>";
}			
			echo"</td>";
          echo"</tr>";
 } 
?>
<tfoot>
<tr> 
<td colspan="8" class="paginado">
<?
echo $rs->anterior()." - ".$rs->nroPaginas()." - ".$rs->siguiente();
?></td>
</tr>	
</tfoot>
</table>
