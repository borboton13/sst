<?php
if($nively=='1'){ $adm=1;}
include("../../funciones/class.paginado.php");
if (isset($_GET['pagina'])){
$pagina = $_GET['pagina'];
}
?>
<? if($admin){ ?>
<div align="center"><span class="title">INDICADORES DE TIEMPO - CM COCHABAMBA</span></div>
<? } ?>
<table width="80%" class="table4" align="center">
<tr>
    <td colspan="3" class="paginado">
        <div align="left">
            <input class="btn_dark" name="estacion" type="button" value="Estadisticas" onClick="location.href='<?=$link_modulo?>?path=estadisticas.php'" />
        </div>
    </td>
    <!--<td colspan="5" class="paginado">
        <div align="right">

        </div>
    </td>-->
</tr>			        
	<tr>
	<th width="20%" height="20"><div align="center">COD</div></th>
	<th  width="60%"><div align="center">DESCRIPCION</div></th>
	<th  width="20%"><div align="center"></div></th>
	</tr>

    <tr height="25" bgcolor="#f6f7f8" onmouseover="setPointer(this, '#DADADA')" onmouseout="setPointer(this, '#f6f7f8')">
        <td><DIV ALIGN='CENTER'>001</DIV></td>
        <td align='justify'><span class='small'>INDICADOR TIEMPO DE CIERRE DE TICKETS - GENERAL</span></td>
        <td valign='top'>
            <div align='center'>
                <a class="enlaceboton" href="../../usuarios/modulos/indicador/001.htm"><img src='../../img/ver01.png' alt='ver' vspace='0' border='0' align='absbottom'></a>
            </div>
        </td>
    </tr>

    <tr height="25" bgcolor="#f6f7f8" onmouseover="setPointer(this, '#DADADA')" onmouseout="setPointer(this, '#f6f7f8')">
        <td><DIV ALIGN='CENTER'>002</DIV></td>
        <td align='justify'><span class='small'>INDICADOR TIEMPO DE CIERRE DE TICKETS - CON CORTE</span></td>
        <td valign='top'>
            <div align='center'>
                <a class="enlaceboton" href="../../usuarios/modulos/indicador/002.htm"><img src='../../img/ver01.png' alt='ver' vspace='0' border='0' align='absbottom'></a>
            </div>
        </td>
    </tr>

    <tr height="25" bgcolor="#f6f7f8" onmouseover="setPointer(this, '#DADADA')" onmouseout="setPointer(this, '#f6f7f8')">
        <td><DIV ALIGN='CENTER'>003</DIV></td>
        <td align='justify'><span class='small'>INDICADOR TIEMPO DE CIERRE DE TICKETS - SIN CORTE</span></td>
        <td valign='top'>
            <div align='center'>
                <a class="enlaceboton" href="../../usuarios/modulos/indicador/003.htm"><img src='../../img/ver01.png' alt='ver' vspace='0' border='0' align='absbottom'></a>
            </div>
        </td>
    </tr>

<tfoot>
<tr> 
<td colspan="8" class="paginado">
</td>
</tr>	
</tfoot>
</table>
