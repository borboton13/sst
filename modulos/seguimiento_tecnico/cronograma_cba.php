<?php
if($nively=='1'){ $adm=1;}

if(isset($_POST["mes"])) $mes = $_POST["mes"];
else $mes=date("m");
if(isset($_POST["anio"])) $anio = $_POST["anio"];
else $anio=date("Y");

if(isset($_POST["menos"]))
{
if($mes>1) $mes--;
else { $mes=12; $anio--; } 
}

if(isset($_POST["mas"]))
{
if($mes<12) $mes++;
else { $mes=1; $anio++; } 
}

$rowt=array("#f1f1f1","#f6f7f8");

$mes = 9;
$anio = 2016;
?>

<table width="98%" align="center" class="table3">
<caption>CRONOGRAMA CENTRO DE MANTENIMIENTO COCHABAMBA</caption>
<tr><TD colspan="7">
<table>
<tr>
	<td><span class="naranja">&nbsp;Centro de Mantenimiento:&nbsp;</span> <td/>
	<td class="marco"><a class="enlaceboton" href="<? echo $link_modulo . '?path=cronograma_cba.php' ?>">&nbsp;CM COCHABAMBA&nbsp;</a></td>	
	<td>|<td/>
	<td class="marco"><a class="enlaceboton" href="<? echo $link_modulo . '?path=cronograma_villa.php' ?>">&nbsp;CM VILLA TUNARI&nbsp;</a></td>	
	<td>|<td/>
	<td class="marco"><a class="enlaceboton" href="<? echo $link_modulo . '?path=cronograma_conosur.php' ?>">&nbsp;CM CONO SUR&nbsp;</a></td>	
	<td>|<td/>
	<td class="marco"><a class="enlaceboton" href="<? echo $link_modulo . '?path=cronograma_oruro.php' ?>">&nbsp;CM ORURO&nbsp;</a></td>
	<td>|<td/>
	<td class="marco">
	<form name="amper" method="post" action="#">
	  <input name="menos" type="submit" class="BotonForm" value="&lt;">
	  <select name="mes" class="selectbuscar" disabled>
	    <option value="1" <? if($mes==1) echo"class='naranja' selected"; ?>>Enero</option>
	    <option value="2" <? if($mes==2) echo"class='naranja' selected"; ?>>Febrero</option>
	    <option value="3" <? if($mes==3) echo"class='naranja' selected"; ?>>Marzo</option>
	    <option value="4" <? if($mes==4) echo"class='naranja' selected"; ?>>Abril</option>
	    <option value="5" <? if($mes==5) echo"class='naranja' selected"; ?>>Mayo</option>
	    <option value="6" <? if($mes==6) echo"class='naranja' selected"; ?>>Junio</option>
	    <option value="7" <? if($mes==7) echo"class='naranja' selected"; ?>>Julio</option>
	    <option value="8" <? if($mes==8) echo"class='naranja' selected"; ?>>Agosto</option>
	    <option value="9" <? if($mes==9) echo"class='naranja' selected"; ?>>Septiembre</option>
	    <option value="10" <? if($mes==10) echo"class='naranja' selected"; ?>>Octubre</option>
	    <option value="11" <? if($mes==11) echo"class='naranja' selected"; ?>>Noviembre</option>
	    <option value="12" <? if($mes==12) echo"class='naranja' selected"; ?>>Diciembre</option>
	    </select>
        <select name="anio" class="selectbuscar" disabled>
          <option value="2011" <? if($anio==2011) echo"class='naranja' selected"; ?>>2011</option>
          <option value="2012" <? if($anio==2012) echo"class='naranja' selected"; ?>>2012</option>
          <option value="2013" <? if($anio==2013) echo"class='naranja' selected"; ?>>2013</option>
          <option value="2014" <? if($anio==2014) echo"class='naranja' selected"; ?>>2014</option>
          <option value="2015" <? if($anio==2015) echo"class='naranja' selected"; ?>>2015</option>
          <option value="2016" <? if($anio==2016) echo"class='naranja' selected"; ?>>2016</option>
        </select>
        <input name="mas" type="submit" class="BotonForm" value="&gt;">
        &nbsp;
        <input name="ver" type="submit" class="BotonForm" value="Ver">
	</form>
	</td>
	<td>|<td/>
	<td class="marco"><a class="enlacebotonverde" href="<? echo $link_modulo . '?path=prev_cert_cba.php' ?>">&nbsp;CERTIFICADOS Y ACTAS&nbsp;</a></td>
	
</tr>
</table>
</TD></tr>

<tr>
<th width="6%">FECHA</th>
<th width="15%">GRUPO 1</th>			              
<th width="15%">GRUPO 2</th>
<th width="15%">GRUPO 3</th> 
<th width="15%">GRUPO 4</th>
<th width="15%">GRUPO 5</th>
<th width="15%">GRUPO 6</th>
</tr>

<tr onmouseover="setPointer(this, '#DADADA')" onmouseout="setPointer(this, '#FFFFFF')">
	<td>01/sep/2016</td>
	<td></td><!--G1-->
	<td></td><!--G2-->
	<td style="color:#0080FF">RESPALDO</td><!--G3-->
	<td></td><!--G4-->
	<td></td><!--G5-->
	<td style="color:#DF0101">EMERGENCIA</td><!--G6-->
</tr>

<tr onmouseover="setPointer(this, '#DADADA')" onmouseout="setPointer(this, '#FFFFFF')">
	<td>02/sep/2016</td>
	<td></td><!--G1-->
	<td></td><!--G2-->
	<td style="color:#0080FF">RESPALDO</td><!--G3-->
	<td></td><!--G4-->
	<td></td><!--G5-->
	<td style="color:#DF0101">EMERGENCIA</td><!--G6-->
</tr>

<tr onmouseover="setPointer(this, '#DADADA')" onmouseout="setPointer(this, '#FFFFFF')">
	<td>03/sep/2016</td>
	<td></td><!--G1-->
	<td></td><!--G2-->
	<td style="color:#0080FF">RESPALDO</td><!--G3-->
	<td></td><!--G4-->
	<td></td><!--G5-->
	<td style="color:#DF0101">EMERGENCIA</td><!--G6-->
</tr>


<tr onmouseover="setPointer(this, '#DADADA')" onmouseout="setPointer(this, '#FFFFFF')">
	<td>04/sep/2016</td>
	<td></td><!--G1-->
	<td></td><!--G2-->
	<td style="color:#0080FF">RESPALDO</td><!--G3-->
	<td></td><!--G4-->
	<td></td><!--G5-->
	<td style="color:#DF0101">EMERGENCIA</td><!--G6-->
</tr>

<tr onmouseover="setPointer(this, '#DADADA')" onmouseout="setPointer(this, '#FFFFFF')">
	<td>05/sep/2016</td>
	<td style="color:#DF0101">EMERGENCIA</td><!--G1-->
	<td></td><!--G2-->
	<td></td><!--G3-->
	<td style="color:#0080FF">RESPALDO</td><!--G4-->
	<td></td><!--G5-->
	<td></td><!--G6-->
</tr>

<tr onmouseover="setPointer(this, '#DADADA')" onmouseout="setPointer(this, '#FFFFFF')">
	<td>06/sep/2016</td>
	<td style="color:#DF0101">EMERGENCIA</td><!--G1-->
	<td>SARCOBAMBA	<a href="<? echo $link_modulo . '?path=prev_sarcobamba.php' ?>"><img src='../../img/ejecutado.gif' alt='ver' border="0"></a></td><!--G2-->
	<td>MAYORAZGO   <a href="<? echo $link_modulo . '?path=prev_mayorazgo.php' ?>"><img src='../../img/ejecutado.gif' alt='ver' border="0"></a></td><!--G3-->
	<td style="color:#0080FF">RESPALDO</td><!--G4-->
	<td>HEROINAS&nbsp;<a href="<? echo $link_modulo . '?path=prev_heroinas.php' ?>"><img src='../../img/ejecutado.gif' alt='ver' border="0"></a></td><!--G5-->
	<td>HOTEL REGINA&nbsp;<img src='../../img/pen.gif' /></td><!--G6-->
</tr>

<tr onmouseover="setPointer(this, '#DADADA')" onmouseout="setPointer(this, '#FFFFFF')">
	<td>07/sep/2016</td>
	<td style="color:#DF0101">EMERGENCIA</td><!--G1-->
	<td>BASE AEREA&nbsp;<img src='../../img/pen.gif' /></td><!--G2-->
	<td>MAYORAZGO   <a href="<? echo $link_modulo . '?path=prev_mayorazgo.php' ?>"><img src='../../img/ejecutado.gif' alt='ver' border="0"></a></td><!--G3-->
	<td>PICO SERING&nbsp;<img src='../../img/pen.gif' /></td><!--G4-->
	<td>ANZALDO GSM&nbsp;<img src='../../img/pen.gif' /></td><!--G5-->
	<td>TORRE SOFFER&nbsp;<img src='../../img/pen.gif' /></td><!--G6-->
</tr>

<tr onmouseover="setPointer(this, '#DADADA')" onmouseout="setPointer(this, '#FFFFFF')">
	<td>08/sep/2016</td>
	<td style="color:#DF0101">EMERGENCIA</td><!--G1-->
	<td>ESTADIO CAPRILES&nbsp;<img src='../../img/pen.gif' alt='pen' border="0" /></td><!--G2-->
	<td>CLIZA&nbsp;<img src='../../img/pen.gif' alt='pen' border="0" /></td><!--G3-->
	<td style="color:#0080FF">RESPALDO</td><!--G4-->
	<td>PANAMERICANA&nbsp;<img src='../../img/pen.gif' alt='pen' border="0" /></td><!--G5-->
	<td>PI�AMI&nbsp;<img src='../../img/pen.gif' /></td><!--G6-->
</tr>

<tr onmouseover="setPointer(this, '#DADADA')" onmouseout="setPointer(this, '#FFFFFF')">
	<td>09/sep/2016</td>
	<td style="color:#DF0101">EMERGENCIA</td><!--G1-->
	<td>CALCHANI&nbsp;<img src='../../img/pen.gif' /></td><!--G2-->
	<td>ULINCATE&nbsp;<img src='../../img/pen.gif' /></td><!--G3-->
	<td style="color:#0080FF">RESPALDO</td><!--G4-->
	<td>IDIF&nbsp;<img src='../../img/pen.gif' /></td><!--G5-->
	<td>CAPINOTA CANTERA&nbsp;<img src='../../img/pen.gif' /></td><!--G6-->
</tr>

<tr onmouseover="setPointer(this, '#DADADA')" onmouseout="setPointer(this, '#FFFFFF')">
	<td>10/sep/2016</td>
	<td style="color:#DF0101">EMERGENCIA</td><!--G1-->
	<td></td><!--G2-->
	<td></td><!--G3-->
	<td style="color:#0080FF">RESPALDO</td><!--G4-->
	<td></td><!--G5-->
	<td></td><!--G6-->
</tr>

<tr onmouseover="setPointer(this, '#DADADA')" onmouseout="setPointer(this, '#FFFFFF')">
	<td>11/sep/2016</td>
	<td style="color:#DF0101">EMERGENCIA</td><!--G1-->
	<td></td><!--G2-->
	<td></td><!--G3-->
	<td style="color:#0080FF">RESPALDO</td><!--G4-->
	<td></td><!--G5-->
	<td></td><!--G6-->
</tr>

<tr onmouseover="setPointer(this, '#DADADA')" onmouseout="setPointer(this, '#FFFFFF')">
	<td>12/sep/2016</td>
	<td>PUNTITI&nbsp;<img src='../../img/pen.gif' /></td><!--G1-->
	<td style="color:#DF0101">EMERGENCIA</td><!--G2-->
	<td>AEROPUERTO&nbsp;<img src='../../img/pen.gif' /></td><!--G3-->
	<td></td><!--G4-->
	<td style="color:#0080FF">RESPALDO</td><!--G5-->
	<td>KAYARANI&nbsp;<img src='../../img/pen.gif' /></td><!--G6-->
</tr>

<tr onmouseover="setPointer(this, '#DADADA')" onmouseout="setPointer(this, '#FFFFFF')">
	<td>13/sep/2016</td>
	<td>PUNTITI&nbsp;<img src='../../img/pen.gif' /></td><!--G1-->
	<td style="color:#DF0101">EMERGENCIA</td><!--G2-->
	<td>VILLA BUSCH&nbsp;<img src='../../img/pen.gif' /></td><!--G3-->
	<td>AASANA&nbsp;<img src='../../img/pen.gif' /></td><!--G4-->
	<td style="color:#0080FF">RESPALDO</td><!--G5-->
	<td>TAMBORADA&nbsp;<img src='../../img/pen.gif' /></td><!--G6-->
</tr>

<tr onmouseover="setPointer(this, '#DADADA')" onmouseout="setPointer(this, '#FFFFFF')">
	<td>14/sep/2016</td>
	<td>FERIADO</td><!--G1-->
	<td style="color:#DF0101">EMERGENCIA</td><!--G2-->
	<td>FERIADO</td><!--G3-->
	<td>FERIADO</td><!--G4-->
	<td style="color:#0080FF">RESPALDO</td><!--G5-->
	<td>FERIADO</td><!--G6-->
</tr>

<tr onmouseover="setPointer(this, '#DADADA')" onmouseout="setPointer(this, '#FFFFFF')">
	<td>15/sep/2016</td>
	<td>IV CENTENARIO&nbsp;<img src='../../img/pen.gif' /></td><!--G1-->
	<td style="color:#DF0101">EMERGENCIA</td><!--G2-->
	<td>PLAZA COLON&nbsp;<img src='../../img/pen.gif' /></td><!--G3-->
	<td>ZONA FLORIDA&nbsp;<img src='../../img/pen.gif' /></td><!--G4-->
	<td style="color:#0080FF">RESPALDO</td><!--G5-->
	<td>VILLA MERCEDES&nbsp;<img src='../../img/pen.gif' /></td><!--G6-->
</tr>

<tr onmouseover="setPointer(this, '#DADADA')" onmouseout="setPointer(this, '#FFFFFF')">
	<td>16/sep/2016</td>
	<td>CURAZANI&nbsp;<img src='../../img/pen.gif' /></td><!--G1-->
	<td style="color:#DF0101">EMERGENCIA</td><!--G2-->
	<td>ALTAMACHI&nbsp;<img src='../../img/pen.gif' /></td><!--G3-->
	<td>YAYANI PCC3&nbsp;<img src='../../img/pen.gif' /></td><!--G4-->
	<td>MC CANCHA&nbsp;<img src='../../img/pen.gif' /></td><!--G5-->
	<td>ESTACION&nbsp;<img src='../../img/pen.gif' /></td><!--G6-->
</tr>

<tr onmouseover="setPointer(this, '#DADADA')" onmouseout="setPointer(this, '#FFFFFF')">
	<td>17/sep/2016</td>
	<td></td><!--G1-->
	<td style="color:#DF0101">EMERGENCIA</td><!--G2-->
	<td></td><!--G3-->
	<td></td><!--G4-->
	<td style="color:#0080FF">RESPALDO</td><!--G5-->
	<td></td><!--G6-->
</tr>

<tr onmouseover="setPointer(this, '#DADADA')" onmouseout="setPointer(this, '#FFFFFF')">
	<td>18/sep/2016</td>
	<td></td><!--G1-->
	<td style="color:#DF0101">EMERGENCIA</td><!--G2-->
	<td></td><!--G3-->
	<td></td><!--G4-->
	<td style="color:#0080FF">RESPALDO</td><!--G5-->
	<td></td><!--G6-->
</tr>

<tr onmouseover="setPointer(this, '#DADADA')" onmouseout="setPointer(this, '#FFFFFF')">
	<td>19/sep/2016</td>
	<td>TICTI&nbsp;<img src='../../img/pen.gif' /></td><!--G1-->
	<td></td><!--G2-->
	<td style="color:#DF0101">EMERGENCIA</td><!--G3-->
	<td>CO. TUTI&nbsp;<img src='../../img/pen.gif' /></td><!--G4-->
	<td>TIQUIPAYA&nbsp;<img src='../../img/pen.gif' /></td><!--G5-->
	<td style="color:#0080FF">RESPALDO</td><!--G6-->
</tr>

<tr onmouseover="setPointer(this, '#DADADA')" onmouseout="setPointer(this, '#FFFFFF')">
	<td>20/sep/2016</td>
	<td>TICTI&nbsp;<img src='../../img/pen.gif' /></td><!--G1-->
	<td>CALICANTO&nbsp;<img src='../../img/pen.gif' /></td><!--G2-->
	<td style="color:#DF0101">EMERGENCIA</td><!--G3-->
	<td>CO. TUTI&nbsp;<img src='../../img/pen.gif' /></td><!--G4-->
	<td>TIQUIPAYA&nbsp;<img src='../../img/pen.gif' /></td><!--G5-->
	<td style="color:#0080FF">RESPALDO</td><!--G6-->
</tr>

<tr onmouseover="setPointer(this, '#DADADA')" onmouseout="setPointer(this, '#FFFFFF')">
	<td>21/sep/2016</td>
	<td>TRES CRUCES&nbsp;<img src='../../img/pen.gif' /></td><!--G1-->
	<td>CANDELARIA&nbsp;<img src='../../img/pen.gif' /></td><!--G2-->
	<td style="color:#DF0101">EMERGENCIA</td><!--G3-->
	<td>MARTIN CARDENAS&nbsp;<img src='../../img/pen.gif' /></td><!--G4-->
	<td>MALLCO RANCHO&nbsp;<img src='../../img/pen.gif' /></td><!--G5-->
	<td>PIL CB&nbsp;<img src='../../img/pen.gif' /></td><!--G6-->
</tr>

<tr onmouseover="setPointer(this, '#DADADA')" onmouseout="setPointer(this, '#FFFFFF')">
	<td>22/sep/2016</td>
	<td>CHULLA&nbsp;<img src='../../img/pen.gif' /></td><!--G1-->
	<td>LAS CUADRAS&nbsp;<img src='../../img/pen.gif' /></td><!--G2-->
	<td style="color:#DF0101">EMERGENCIA</td><!--G3-->
	<td>PLAZA BOLIVAR&nbsp;<img src='../../img/pen.gif' /></td><!--G4-->
	<td>ANZALDO PUEBLO&nbsp;<img src='../../img/pen.gif' /></td><!--G5-->
	<td style="color:#0080FF">RESPALDO</td><!--G6-->
</tr>

<tr onmouseover="setPointer(this, '#DADADA')" onmouseout="setPointer(this, '#FFFFFF')">
	<td>23/sep/2016</td>
	<td>SAN CARLOS&nbsp;<img src='../../img/pen.gif' /></td><!--G1-->
	<td>BOLIVAR CBBA&nbsp;<img src='../../img/pen.gif' /></td><!--G2-->
	<td style="color:#DF0101">EMERGENCIA</td><!--G3-->
	<td>QUILLACOLLO&nbsp;<img src='../../img/pen.gif' /></td><!--G4-->
	<td>AROMA URBANA&nbsp;<img src='../../img/pen.gif' /></td><!--G5-->
	<td style="color:#0080FF">RESPALDO</td><!--G6-->
</tr>

<tr onmouseover="setPointer(this, '#DADADA')" onmouseout="setPointer(this, '#FFFFFF')">
	<td>24/sep/2016</td>
	<td></td><!--G1-->
	<td></td><!--G2-->
	<td style="color:#DF0101">EMERGENCIA</td><!--G3-->
	<td></td><!--G4-->
	<td></td><!--G5-->
	<td style="color:#0080FF">RESPALDO</td><!--G6-->
</tr>

<tr onmouseover="setPointer(this, '#DADADA')" onmouseout="setPointer(this, '#FFFFFF')">
	<td>25/sep/2016</td>
	<td></td><!--G1-->
	<td></td><!--G2-->
	<td style="color:#DF0101">EMERGENCIA</td><!--G3-->
	<td></td><!--G4-->
	<td></td><!--G5-->
	<td style="color:#0080FF">RESPALDO</td><!--G6-->
</tr>

<tr onmouseover="setPointer(this, '#DADADA')" onmouseout="setPointer(this, '#FFFFFF')">
	<td>26/sep/2016</td>
	<td style="color:#0080FF">RESPALDO</td><!--G1-->
	<td>VARGAS LINDE&nbsp;<img src='../../img/pen.gif' /></td><!--G2-->
	<td>TORO TORO&nbsp;<img src='../../img/pen.gif' /></td><!--G3-->
	<td style="color:#DF0101">EMERGENCIA</td><!--G4-->
	<td></td><!--G5-->
	<td></td><!--G6-->
</tr>

<tr onmouseover="setPointer(this, '#DADADA')" onmouseout="setPointer(this, '#FFFFFF')">
	<td>27/sep/2016</td>
	<td>BOLIVIANA CIACRUZ&nbsp;<img src='../../img/pen.gif' /></td><!--G1-->
	<td>BELLO HORIZONTE&nbsp;<img src='../../img/pen.gif' /></td><!--G2-->
	<td>TORO TORO&nbsp;<img src='../../img/pen.gif' /></td><!--G3-->
	<td style="color:#DF0101">EMERGENCIA</td><!--G4-->
	<td></td><!--G5-->
	<td></td><!--G6-->
</tr>

<tr onmouseover="setPointer(this, '#DADADA')" onmouseout="setPointer(this, '#FFFFFF')">
	<td>28/sep/2016</td>
	<td style="color:#0080FF">RESPALDO</td><!--G1-->
	<td>TORRE NORTE&nbsp;<img src='../../img/pen.gif' /></td><!--G2-->
	<td>ACASIO&nbsp;<img src='../../img/pen.gif' /></td><!--G3-->
	<td style="color:#DF0101">EMERGENCIA</td><!--G4-->
	<td></td><!--G5-->
	<td></td><!--G6-->
</tr>

<tr onmouseover="setPointer(this, '#DADADA')" onmouseout="setPointer(this, '#FFFFFF')">
	<td>29/sep/2016</td>
	<td style="color:#0080FF">RESPALDO</td><!--G1-->
	<td>ATB CBBA&nbsp;<img src='../../img/pen.gif' /></td><!--G2-->
	<td>SAN PEDRO DE BUENA V&nbsp;<img src='../../img/pen.gif' /></td><!--G3-->
	<td style="color:#DF0101">EMERGENCIA</td><!--G4-->
	<td></td><!--G5-->
	<td></td><!--G6-->
</tr>

<tr onmouseover="setPointer(this, '#DADADA')" onmouseout="setPointer(this, '#FFFFFF')">
	<td>30/sep/2016</td>
	<td style="color:#0080FF">RESPALDO</td><!--G1-->
	<td>FALSURI TCT&nbsp;<img src='../../img/pen.gif' /></td><!--G2-->
	<td></td><!--G3-->
	<td style="color:#DF0101">EMERGENCIA</td><!--G4-->
	<td></td><!--G5-->
	<td></td><!--G6-->
</tr>
<tr>
<th width="6%"></th>
<th width="15%">GRUPO 1</th>			              
<th width="15%">GRUPO 2</th>
<th width="15%">GRUPO 3</th> 
<th width="15%">GRUPO 4</th>
<th width="15%">GRUPO 5</th>
<th width="15%">GRUPO 6</th>
</tr>

<tr onmouseover="setPointer(this, '#DADADA')" onmouseout="setPointer(this, '#FFFFFF')">
	<td></td>
	<td>Alvaro Guzman - Cel: 67402431	<br/>Ronal Magari�o - Cel: 67401344</td><!--G1-->
	<td>Miguel Rojas - Cel: 67400285	<br/>Marcos Huanca - Cel: 67401356</td><!--G2-->
	<td>Jorge Zambrana - Cel: 67599031	<br/>Victor Autario - Cel: 72237603</td><!--G3-->
	<td>Liberato Coarite - Cel: 71548359<br/>Carlos Tola - Cel: 67402422</td><!--G4-->
	<td>Hugo Quispe - Cel: 67401230		<br/>Joseph Huanqui - Cel: 67599021</td><!--G5-->
	<td>Benjamin Perales - Cel: 72234656<br/>Luis Zapana - Cel: 67401237</td><!--G6-->
</tr>
	
</table>			  			
<link href="../../paquetes/greybox/gb_styles.css" rel="stylesheet" type="text/css" media="all" />
    <script type="text/javascript">
        var GB_ROOT_DIR = "./../../paquetes/greybox/";
    </script>    
	<script type="text/javascript" src="../../paquetes/greybox/AJS.js"></script>
    <script type="text/javascript" src="../../paquetes/greybox/AJS_fx.js"></script>
    <script type="text/javascript" src="../../paquetes/greybox/gb_scripts_no_reload.js"></script>
</HTML>
