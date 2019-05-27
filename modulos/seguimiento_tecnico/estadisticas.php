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
            <input class="btn_dark" name="estacion" type="button" value="Indicadores de Tiempo" onClick="location.href='<?=$link_modulo?>?path=indicadores.php'" />
        </div>
    </td>
    <td colspan="2" class="paginado">
        <div align="right">
            <!--<input class="btn_dark" type="button" value="Nuevo">-->
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

    <tr height="25" bgcolor="#f6f7f8" onmouseover="setPointer(this, '#DADADA')" onmouseout="setPointer(this, '#f6f7f8')" >
        <td><DIV ALIGN='CENTER'>042019</DIV></td>
        <td><DIV ALIGN='CENTER'>01/04/2019</DIV></td>
        <td><DIV ALIGN='CENTER'>30/04/2019</DIV></td>
        <td align='justify'><span class='small'>ESTADISTICAS DE MANTENIMIENTO ABRIL 2019</span></td>
        <td valign='top'>
            <div align='center'>
                <a title='Ver estadisticas' href='<?=$link_modulo?>?path=est_detalle_042019.php'><img src='../../img/ver01.png' alt='Editar Form' vspace='0' border='0' align='absbottom'></a>
            </div>
        </td>
    </tr>

    <tr height="25" bgcolor="#f6f7f8" onmouseover="setPointer(this, '#DADADA')" onmouseout="setPointer(this, '#f6f7f8')" >
        <td><DIV ALIGN='CENTER'>032019</DIV></td>
        <td><DIV ALIGN='CENTER'>01/03/2019</DIV></td>
        <td><DIV ALIGN='CENTER'>31/03/2019</DIV></td>
        <td align='justify'><span class='small'>ESTADISTICAS DE MANTENIMIENTO MARZO 2019</span></td>
        <td valign='top'>
            <div align='center'>
                <a title='Ver estadisticas' href='<?=$link_modulo?>?path=est_detalle_032019.php'><img src='../../img/ver01.png' alt='Editar Form' vspace='0' border='0' align='absbottom'></a>
            </div>
        </td>
    </tr>

    <tr height="25" bgcolor="#f6f7f8" onmouseover="setPointer(this, '#DADADA')" onmouseout="setPointer(this, '#f6f7f8')" >
        <td><DIV ALIGN='CENTER'>022019</DIV></td>
        <td><DIV ALIGN='CENTER'>01/02/2019</DIV></td>
        <td><DIV ALIGN='CENTER'>28/02/2019</DIV></td>
        <td align='justify'><span class='small'>ESTADISTICAS DE MANTENIMIENTO FEBRERO 2019</span></td>
        <td valign='top'>
            <div align='center'>
                <a title='Ver estadisticas' href='<?=$link_modulo?>?path=est_detalle_022019.php'><img src='../../img/ver01.png' alt='Editar Form' vspace='0' border='0' align='absbottom'></a>
            </div>
        </td>
    </tr>

    <tr height="25" bgcolor="#f6f7f8" onmouseover="setPointer(this, '#DADADA')" onmouseout="setPointer(this, '#f6f7f8')" >
        <td><DIV ALIGN='CENTER'>012019</DIV></td>
        <td><DIV ALIGN='CENTER'>01/01/2019</DIV></td>
		<td><DIV ALIGN='CENTER'>31/01/2019</DIV></td>
		<td align='justify'><span class='small'>ESTADISTICAS DE MANTENIMIENTO ENERO 2019</span></td>
		<td valign='top'>
        <div align='center'>
            <a title='Ver estadisticas' href='<?=$link_modulo?>?path=est_detalle_012019.php'><img src='../../img/ver01.png' alt='Editar Form' vspace='0' border='0' align='absbottom'></a>
        </div>
	    </td>
    </tr>

    <tr height="25" bgcolor="#f6f7f8" onmouseover="setPointer(this, '#DADADA')" onmouseout="setPointer(this, '#f6f7f8')" >
        <td><DIV ALIGN='CENTER'>122018</DIV></td>
        <td><DIV ALIGN='CENTER'>01/12/2018</DIV></td>
        <td><DIV ALIGN='CENTER'>31/12/2018</DIV></td>
        <td align='justify'><span class='small'>ESTADISTICAS DE MANTENIMIENTO DICIEMBRE 2018</span></td>
        <td valign='top'>
            <div align='center'>
                <a title='Ver estadisticas' href='<?=$link_modulo?>?path=est_detalle_122018.php'><img src='../../img/ver01.png' alt='Editar Form' vspace='0' border='0' align='absbottom'></a>
            </div>
        </td>
    </tr>

    <tr height="25" bgcolor="#f6f7f8" onmouseover="setPointer(this, '#DADADA')" onmouseout="setPointer(this, '#f6f7f8')" >
        <td><DIV ALIGN='CENTER'>112018</DIV></td>
        <td><DIV ALIGN='CENTER'>01/11/2018</DIV></td>
        <td><DIV ALIGN='CENTER'>30/11/2018</DIV></td>
        <td align='justify'><span class='small'>ESTADISTICAS DE MANTENIMIENTO NOVIEMBRE 2018</span></td>
        <td valign='top'>
            <div align='center'>
                <a title='Ver estadisticas' href='<?=$link_modulo?>?path=est_detalle_112018.php'><img src='../../img/ver01.png' alt='Editar Form' vspace='0' border='0' align='absbottom'></a>
            </div>
        </td>
    </tr>

    <tr height="25" bgcolor="#f6f7f8" onmouseover="setPointer(this, '#DADADA')" onmouseout="setPointer(this, '#f6f7f8')" >
        <td><DIV ALIGN='CENTER'>102018</DIV></td>
        <td><DIV ALIGN='CENTER'>01/10/2018</DIV></td>
        <td><DIV ALIGN='CENTER'>31/10/2018</DIV></td>
        <td align='justify'><span class='small'>ESTADISTICAS DE MANTENIMIENTO OCTUBRE 2018</span></td>
        <td valign='top'>
            <div align='center'>
                <a title='Ver estadisticas' href='<?=$link_modulo?>?path=est_detalle_102018.php'><img src='../../img/ver01.png' alt='Editar Form' vspace='0' border='0' align='absbottom'></a>
            </div>
        </td>
    </tr>

    <tr height="25" bgcolor="#f6f7f8" onmouseover="setPointer(this, '#DADADA')" onmouseout="setPointer(this, '#f6f7f8')" >
        <td><DIV ALIGN='CENTER'>092018</DIV></td>
        <td><DIV ALIGN='CENTER'>01/09/2018</DIV></td>
        <td><DIV ALIGN='CENTER'>30/09/2018</DIV></td>
        <td align='justify'><span class='small'>ESTADISTICAS DE MANTENIMIENTO SEPTIEMBRE 2018</span></td>
        <td valign='top'>
            <div align='center'>
                <a title='Ver estadisticas' href='#'><img src='../../img/ver01.png' alt='Editar Form' vspace='0' border='0' align='absbottom'></a>
            </div>
        </td>
    </tr>

    <tr height="25" bgcolor="#f6f7f8" onmouseover="setPointer(this, '#DADADA')" onmouseout="setPointer(this, '#f6f7f8')" >
        <td><DIV ALIGN='CENTER'>082018</DIV></td>
        <td><DIV ALIGN='CENTER'>01/08/2018</DIV></td>
        <td><DIV ALIGN='CENTER'>31/08/2018</DIV></td>
        <td align='justify'><span class='small'>ESTADISTICAS DE MANTENIMIENTO AGOSTO 2018</span></td>
        <td valign='top'>
            <div align='center'>
                <a title='Ver estadisticas' href='<?=$link_modulo?>?path=est_detalle_082018.php'><img src='../../img/ver01.png' alt='Editar Form' vspace='0' border='0' align='absbottom'></a>
            </div>
        </td>
    </tr>

    <tr height="25" bgcolor="#f6f7f8" onmouseover="setPointer(this, '#DADADA')" onmouseout="setPointer(this, '#f6f7f8')" >
        <td><DIV ALIGN='CENTER'>072018</DIV></td>
        <td><DIV ALIGN='CENTER'>01/07/2018</DIV></td>
        <td><DIV ALIGN='CENTER'>31/07/2018</DIV></td>
        <td align='justify'><span class='small'>ESTADISTICAS DE MANTENIMIENTO JULIO 2018</span></td>
        <td valign='top'>
            <div align='center'>
                <a title='Ver estadisticas' href='<?=$link_modulo?>?path=est_detalle_072018.php'><img src='../../img/ver01.png' alt='Editar Form' vspace='0' border='0' align='absbottom'></a>
            </div>
        </td>
    </tr>

    <tr height="25" bgcolor="#f6f7f8" onmouseover="setPointer(this, '#DADADA')" onmouseout="setPointer(this, '#f6f7f8')" >
        <td><DIV ALIGN='CENTER'>062018</DIV></td>
        <td><DIV ALIGN='CENTER'>01/06/2018</DIV></td>
        <td><DIV ALIGN='CENTER'>30/06/2018</DIV></td>
        <td align='justify'><span class='small'>ESTADISTICAS DE MANTENIMIENTO JUNIO 2018</span></td>
        <td valign='top'>
            <div align='center'>
                <a title='Ver estadisticas' href='<?=$link_modulo?>?path=est_detalle_062018.php'><img src='../../img/ver01.png' alt='Editar Form' vspace='0' border='0' align='absbottom'></a>
            </div>
        </td>
    </tr>
    <tr height="25" bgcolor="#f6f7f8" onmouseover="setPointer(this, '#DADADA')" onmouseout="setPointer(this, '#f6f7f8')" >
        <td><DIV ALIGN='CENTER'>052018</DIV></td>
        <td><DIV ALIGN='CENTER'>01/05/2018</DIV></td>
        <td><DIV ALIGN='CENTER'>31/05/2018</DIV></td>
        <td align='justify'><span class='small'>ESTADISTICAS DE MANTENIMIENTO MAYO 2018</span></td>
        <td valign='top'>
            <div align='center'>
                <a title='Ver estadisticas' href='<?=$link_modulo?>?path=est_detalle_052018.php'><img src='../../img/ver01.png' alt='Editar Form' vspace='0' border='0' align='absbottom'></a>
            </div>
        </td>
    </tr>
    <tr height="25" bgcolor="#f6f7f8" onmouseover="setPointer(this, '#DADADA')" onmouseout="setPointer(this, '#f6f7f8')" >
        <td><DIV ALIGN='CENTER'>042018</DIV></td>
        <td><DIV ALIGN='CENTER'>01/04/2018</DIV></td>
        <td><DIV ALIGN='CENTER'>30/04/2018</DIV></td>
        <td align='justify'><span class='small'>ESTADISTICAS DE MANTENIMIENTO ABRIL 2018</span></td>
        <td valign='top'>
            <div align='center'>
                <a title='Ver estadisticas' href='<?=$link_modulo?>?path=est_detalle_042018.php'><img src='../../img/ver01.png' alt='Editar Form' vspace='0' border='0' align='absbottom'></a>
            </div>
        </td>
    </tr>
    <tr height="25" bgcolor="#f6f7f8" onmouseover="setPointer(this, '#DADADA')" onmouseout="setPointer(this, '#f6f7f8')" >
        <td><DIV ALIGN='CENTER'>032018</DIV></td>
        <td><DIV ALIGN='CENTER'>01/03/2018</DIV></td>
        <td><DIV ALIGN='CENTER'>31/03/2018</DIV></td>
        <td align='justify'><span class='small'>ESTADISTICAS DE MANTENIMIENTO MARZO 2018</span></td>
        <td valign='top'>
            <div align='center'>
                <a title='Ver estadisticas' href='<?=$link_modulo?>?path=est_detalle_032018.php'><img src='../../img/ver01.png' alt='Editar Form' vspace='0' border='0' align='absbottom'></a>
            </div>
        </td>
    </tr>
    <tr height="25" bgcolor="#f6f7f8" onmouseover="setPointer(this, '#DADADA')" onmouseout="setPointer(this, '#f6f7f8')" >
        <td><DIV ALIGN='CENTER'>022018</DIV></td>
        <td><DIV ALIGN='CENTER'>01/02/2018</DIV></td>
        <td><DIV ALIGN='CENTER'>28/02/2018</DIV></td>
        <td align='justify'><span class='small'>ESTADISTICAS DE MANTENIMIENTO FEBRERO 2018</span></td>
        <td valign='top'>
            <div align='center'>
                <a title='Ver estadisticas' href='<?=$link_modulo?>?path=est_detalle_022018.php'><img src='../../img/ver01.png' alt='Editar Form' vspace='0' border='0' align='absbottom'></a>
            </div>
        </td>
    </tr>
    <tr height="25" bgcolor="#f6f7f8" onmouseover="setPointer(this, '#DADADA')" onmouseout="setPointer(this, '#f6f7f8')" >
        <td><DIV ALIGN='CENTER'>012018</DIV></td>
        <td><DIV ALIGN='CENTER'>01/01/2018</DIV></td>
        <td><DIV ALIGN='CENTER'>31/01/2018</DIV></td>
        <td align='justify'><span class='small'>ESTADISTICAS DE MANTENIMIENTO ENERO 2018</span></td>
        <td valign='top'>
            <div align='center'>
                <a title='Ver estadisticas' href='<?=$link_modulo?>?path=est_detalle_012018.php'><img src='../../img/ver01.png' alt='Editar Form' vspace='0' border='0' align='absbottom'></a>
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
