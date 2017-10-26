<?php
if($nively=='1'){ $adm=1;}
include("../../funciones/class.paginado.php");
if (isset($_GET['pagina'])){
$pagina = $_GET['pagina'];
}
?>
<? if($admin){ ?>
<div align="center"><span class="title">ACTAS DE MANTENIMIENTO</span></div>
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
        if(!$rs->query("SELECT a.idacta, a.codigo, a.carpeta, date_format(a.fechainicio,'%d/%m/%Y'), date_format(a.fechafin,'%d/%m/%Y'), a.descripcion FROM actas a ORDER BY a.fechainicio DESC"))
        {    die( $rs->error() ); }
        echo "Mostrando ".$rs->desde()." - ".$rs->hasta()." de un total de ".$rs->total()."<br>"; ?>
        </div>
    </td>
    <td colspan="5" class="paginado">
        <? if($admin){ ?>
        <div align="right">
            <input class="btn_dark" onClick="location.href='<?=$mst?>nueva_acta.php'" type="button" value="Nuevo">
        </div>
        <? } ?>
    </td>
</tr>			        
	<tr>
	<th width="6%" height="20"><div align="center">COD</div></th>
	<th  width="6%"><div align="center">INICIO </div></th>
	<th  width="6%"><div align="center">FIN</div></th>
	<th  width="40%"><div align="center">DESCRIPCION</div></th>
	<th  width="4%"><div align="center"></div></th>
	</tr>					  
<?php

  $i=0; 
  while($dato = $rs->obtenerArray()) {
     $idacta        = $dato[0];
     $codigo        = $dato[1];
     $carpeta       = $dato[2];
	 $fechainicio   = $dato[3];
	 $fechafin      = $dato[4];
	 $descripcion   = $dato[5];

     $idacta_base64 = base64_encode($idacta);

     $num = mysql_num_rows(mysql_query("SELECT * FROM documentoacta d WHERE d.idacta = $idacta"));

	 $i++;
	 if($i%2==0) {
	    $rowt="#f6f7f8";
     }else{
	    $rowt="#f1f1f1";
	 }
	echo"<tr height='25' bgcolor='$rowt' onmouseover=\"setPointer(this, '#DADADA')\" onmouseout=\"setPointer(this, '$rowt')\"> 
            <td><DIV ALIGN='CENTER'>$codigo</DIV></td>          
            <td><DIV ALIGN='CENTER'>$fechainicio</DIV></td>
			<td><DIV ALIGN='CENTER'>$fechafin</DIV></td>
			<td align='justify'><span class='small'>$descripcion</span></td>
			<td valign='top'>";
        echo "<div align='center'>";
	    echo "<a title='Ver actas' href='$link_modulo?path=actas_ver.php&idacta=$idacta_base64'><img src='../../img/ver01.png' alt='Editar Form' vspace='0' border='0' align='absbottom'></a>";
	    if($adm && $num == 0){
            echo"<a href='".$link_modulo_r."?path=actas_eliminar.php&idacta=".base64_encode($idacta)."&carpeta=".base64_encode($carpeta)."' onclick='return confirm(\"SST: Esta seguro que desea ELIMINAR el acta  $codigo ?\");'><img src='../../img/actionCancel.gif' alt='ELIMINAR ACTA' border=\"0\" align=\"absmiddle\"></a>";
        }
        echo "</div>";
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
