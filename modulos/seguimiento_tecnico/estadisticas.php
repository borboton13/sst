<?php
if($nively=='1'){ $adm=1;}
include("../../funciones/class.paginado.php");
if (isset($_GET['pagina'])){
$pagina = $_GET['pagina'];
}
?>
<? if($admin){ ?>
<div align="center"><span class="title">ESTADISTICAS DE MANTENIMIENTO</span></div>
<? } ?>
<table width="100%" class="table4">
<tr>
    <td colspan="3" class="paginado">
        <div align="left">
        </div>
    </td>
    <td colspan="5" class="paginado">
        <div align="right">
            <input class="btn_dark" type="button" value="Nuevo">
        </div>
    </td>
</tr>			        
	<tr>
	<th width="6%" height="20"><div align="center">COD</div></th>
	<th  width="6%"><div align="center">INICIO </div></th>
	<th  width="6%"><div align="center">FIN</div></th>
	<th  width="40%"><div align="center">DESCRIPCION</div></th>
	<th  width="4%"><div align="center"></div></th>
	</tr>					  

    <tr height="25" bgcolor="" >
        <td><DIV ALIGN='CENTER'>001</DIV></td>
        <td><DIV ALIGN='CENTER'>01/01/2019</DIV></td>
		<td><DIV ALIGN='CENTER'>31/01/2019</DIV></td>
		<td align='justify'><span class='small'>ESTADISTICAS DE MANTENIMIENTO ENERO 2019</span></td>
		<td valign='top'>
        <div align='center'>
            <a title='Ver actas' href='<?=$link_modulo?>?path=est_detalle_012019.php'><img src='../../img/ver01.png' alt='Editar Form' vspace='0' border='0' align='absbottom'></a>
        </div>
	    </td>
    </tr>

    <tr height="25" bgcolor="" >
        <td><DIV ALIGN='CENTER'>002</DIV></td>
        <td><DIV ALIGN='CENTER'>01/12/2018</DIV></td>
        <td><DIV ALIGN='CENTER'>31/12/2018</DIV></td>
        <td align='justify'><span class='small'>ESTADISTICAS DE MANTENIMIENTO DICIEMBRE 2018</span></td>
        <td valign='top'>
            <div align='center'>
                <a title='Ver actas' href='<?=$link_modulo?>?path=est_detalle_122018.php'><img src='../../img/ver01.png' alt='Editar Form' vspace='0' border='0' align='absbottom'></a>
            </div>
        </td>
    </tr>

    <tr height="25" bgcolor="" >
        <td><DIV ALIGN='CENTER'>003</DIV></td>
        <td><DIV ALIGN='CENTER'>01/11/2018</DIV></td>
        <td><DIV ALIGN='CENTER'>30/11/2018</DIV></td>
        <td align='justify'><span class='small'>ESTADISTICAS DE MANTENIMIENTO NOVIEMBRE 2018</span></td>
        <td valign='top'>
            <div align='center'>
                <a title='Ver actas' href='<?=$link_modulo?>?path=est_detalle_112018.php'><img src='../../img/ver01.png' alt='Editar Form' vspace='0' border='0' align='absbottom'></a>
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
