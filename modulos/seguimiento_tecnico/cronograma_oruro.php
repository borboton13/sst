<?
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
<caption>
CRONOGRAMA CENTRO DE MANTENIMIENTO ORURO
</caption>
<tr><TD colspan="7">
<table>
<tr>
<td class="marco">
	<form name="amper" method="post" action="#">
	  <span class="naranja">&nbsp;Centro de Mantenimiento:&nbsp;</span> 
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
        <input name="ver" type="submit" class="BotonForm" value="Ver"></form>
	</td>
	<td>|<td/>
	<td class="marco"><a class="enlaceboton" href="<? echo $link_modulo . '?path=cronograma_cba.php' ?>">&nbsp;CM COCHABAMBA&nbsp;</a></td>	
	<td>|<td/>
	<td class="marco"><a class="enlaceboton" href="<? echo $link_modulo . '?path=cronograma_villa.php' ?>">&nbsp;CM VILLA TUNARI&nbsp;</a></td>	
	<td>|<td/>
	<td class="marco"><a class="enlaceboton" href="<? echo $link_modulo . '?path=cronograma_conosur.php' ?>">&nbsp;CM CONO SUR&nbsp;</a></td>	
	<td>|<td/>
	<td class="marco"><a class="enlaceboton" href="<? echo $link_modulo . '?path=cronograma_oruro.php' ?>">&nbsp;CM ORURO&nbsp;</a></td>	
	

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
	<td></td><!--G3-->
	<td></td><!--G4-->
	<td></td><!--G5-->
	<td></td><!--G6-->
</tr>

<tr onmouseover="setPointer(this, '#DADADA')" onmouseout="setPointer(this, '#FFFFFF')">
	<td>02/sep/2016</td>
	<td></td><!--G1-->
	<td></td><!--G2-->
	<td></td><!--G3-->
	<td></td><!--G4-->
	<td></td><!--G5-->
	<td></td><!--G6-->
</tr>

<tr onmouseover="setPointer(this, '#DADADA')" onmouseout="setPointer(this, '#FFFFFF')">
	<td>03/sep/2016</td>
	<td></td><!--G1-->
	<td></td><!--G2-->
	<td></td><!--G3-->
	<td></td><!--G4-->
	<td></td><!--G5-->
	<td></td><!--G6-->
</tr>


<tr onmouseover="setPointer(this, '#DADADA')" onmouseout="setPointer(this, '#FFFFFF')">
	<td>04/sep/2016</td>
	<td></td><!--G1-->
	<td></td><!--G2-->
	<td></td><!--G3-->
	<td></td><!--G4-->
	<td></td><!--G5-->
	<td></td><!--G6-->
</tr>

<tr onmouseover="setPointer(this, '#DADADA')" onmouseout="setPointer(this, '#FFFFFF')">
	<td>05/sep/2016</td>
	<td style="color:#0080FF">RESPALDO</td><!--G1-->
	<td></td><!--G2-->
	<td></td><!--G3-->
	<td style="color:#DF0101">EMERGENCIA</td><!--G4-->
	<td></td><!--G5-->
	<td></td><!--G6-->
</tr>

<tr onmouseover="setPointer(this, '#DADADA')" onmouseout="setPointer(this, '#FFFFFF')">
	<td>06/sep/2016</td>
	<td style="color:#0080FF">RESPALDO</td><!--G1-->
	<td></td><!--G2-->
	<td></td><!--G3-->
	<td style="color:#DF0101">EMERGENCIA</td><!--G4-->
	<td></td><!--G5-->
	<td></td><!--G6-->
</tr>
<tr onmouseover="setPointer(this, '#DADADA')" onmouseout="setPointer(this, '#FFFFFF')">
	<td>07/sep/2016</td>
	<td style="color:#0080FF">RESPALDO</td><!--G1-->
	<td></td><!--G2-->
	<td></td><!--G3-->
	<td style="color:#DF0101">EMERGENCIA</td><!--G4-->
	<td></td><!--G5-->
	<td></td><!--G6-->
</tr>
<tr onmouseover="setPointer(this, '#DADADA')" onmouseout="setPointer(this, '#FFFFFF')">
	<td>08/sep/2016</td>
	<td style="color:#0080FF">RESPALDO</td><!--G1-->
	<td></td><!--G2-->
	<td></td><!--G3-->
	<td style="color:#DF0101">EMERGENCIA</td><!--G4-->
	<td></td><!--G5-->
	<td></td><!--G6-->
</tr>
<tr onmouseover="setPointer(this, '#DADADA')" onmouseout="setPointer(this, '#FFFFFF')">
	<td>09/sep/2016</td>
	<td></td><!--G1-->
	<td></td><!--G2-->
	<td></td><!--G3-->
	<td></td><!--G4-->
	<td></td><!--G5-->
	<td></td><!--G6-->
</tr>
<tr onmouseover="setPointer(this, '#DADADA')" onmouseout="setPointer(this, '#FFFFFF')">
	<td>10/sep/2016</td>
	<td></td><!--G1-->
	<td></td><!--G2-->
	<td></td><!--G3-->
	<td></td><!--G4-->
	<td></td><!--G5-->
	<td></td><!--G6-->
</tr>
<tr onmouseover="setPointer(this, '#DADADA')" onmouseout="setPointer(this, '#FFFFFF')">
	<td>11/sep/2016</td>
	<td>CO. HUALLCANI&nbsp;<img src='../../img/pen.gif' /></td><!--G1-->
	<td></td><!--G2-->
	<td></td><!--G3-->
	<td></td><!--G4-->
	<td></td><!--G5-->
	<td></td><!--G6-->
</tr>
<tr onmouseover="setPointer(this, '#DADADA')" onmouseout="setPointer(this, '#FFFFFF')">
	<td>12/sep/2016</td>
	<td></td><!--G1-->
	<td style="color:#0080FF">RESPALDO</td><!--G2-->
	<td></td><!--G3-->
	<td></td><!--G4-->
	<td style="color:#DF0101">EMERGENCIA</td><!--G5-->
	<td></td><!--G6-->
</tr>
<tr onmouseover="setPointer(this, '#DADADA')" onmouseout="setPointer(this, '#FFFFFF')">
	<td>13/sep/2016</td>
	<td></td><!--G1-->
	<td style="color:#0080FF">RESPALDO</td><!--G2-->
	<td></td><!--G3-->
	<td></td><!--G4-->
	<td style="color:#DF0101">EMERGENCIA</td><!--G5-->
	<td></td><!--G6-->
</tr>
<tr onmouseover="setPointer(this, '#DADADA')" onmouseout="setPointer(this, '#FFFFFF')">
	<td>14/sep/2016</td>
	<td></td><!--G1-->
	<td style="color:#0080FF">RESPALDO</td><!--G2-->
	<td></td><!--G3-->
	<td></td><!--G4-->
	<td style="color:#DF0101">EMERGENCIA</td><!--G5-->
	<td></td><!--G6-->
</tr>
<tr onmouseover="setPointer(this, '#DADADA')" onmouseout="setPointer(this, '#FFFFFF')">
	<td>15/sep/2016</td>
	<td></td><!--G1-->
	<td style="color:#0080FF">RESPALDO</td><!--G2-->
	<td>SEBASTIAN PAGADOR&nbsp;<a href="<? echo $link_modulo . '?path=prev_sebastian.php' ?>"><img src='../../img/ejecutado.gif' alt='ver' border="0"></a></td><!--G3-->
	<td>NODO TERMINAL&nbsp;<img src='../../img/pen.gif' /></td><!--G4-->
	<td style="color:#DF0101">EMERGENCIA</td><!--G5-->
	<td></td><!--G6-->
</tr>
<tr onmouseover="setPointer(this, '#DADADA')" onmouseout="setPointer(this, '#FFFFFF')">
	<td>16/sep/2016</td>
	<td></td><!--G1-->
	<td></td><!--G2-->
	<td></td><!--G3-->
	<td></td><!--G4-->
	<td></td><!--G5-->
	<td></td><!--G6-->
</tr><tr onmouseover="setPointer(this, '#DADADA')" onmouseout="setPointer(this, '#FFFFFF')">
	<td>17/sep/2016</td>
	<td></td><!--G1-->
	<td></td><!--G2-->
	<td></td><!--G3-->
	<td></td><!--G4-->
	<td></td><!--G5-->
	<td></td><!--G6-->
</tr><tr onmouseover="setPointer(this, '#DADADA')" onmouseout="setPointer(this, '#FFFFFF')">
	<td>18/sep/2016</td>
	<td></td><!--G1-->
	<td></td><!--G2-->
	<td></td><!--G3-->
	<td></td><!--G4-->
	<td></td><!--G5-->
	<td></td><!--G6-->
</tr>
<tr onmouseover="setPointer(this, '#DADADA')" onmouseout="setPointer(this, '#FFFFFF')">
	<td>19/sep/2016</td>
	<td style="color:#DF0101">EMERGENCIA</td><!--G1-->
	<td>ENTEL ORURO&nbsp;<img src='../../img/pen.gif' /></td><!--G2-->
	<td style="color:#0080FF">RESPALDO</td><!--G3-->
	<td>NODO AEROPUERTO&nbsp;<img src='../../img/pen.gif' /></td><!--G4-->
	<td>PAMPA AULLAGAS&nbsp;<img src='../../img/pen.gif' /></td><!--G5-->
	<td></td><!--G6-->
</tr>
<tr onmouseover="setPointer(this, '#DADADA')" onmouseout="setPointer(this, '#FFFFFF')">
	<td>20/sep/2016</td>
	<td style="color:#DF0101">EMERGENCIA</td><!--G1-->
	<td>RUMMY CAMPANA&nbsp;<img src='../../img/pen.gif' /></td><!--G2-->
	<td style="color:#0080FF">RESPALDO</td><!--G3-->
	<td>CO. HUALLCANI&nbsp;<img src='../../img/pen.gif' /></td><!--G4-->
	<td>SANTA ROSA&nbsp;<img src='../../img/pen.gif' /></td><!--G5-->
	<td></td><!--G6-->
</tr><tr onmouseover="setPointer(this, '#DADADA')" onmouseout="setPointer(this, '#FFFFFF')">
	<td>21/sep/2016</td>
	<td style="color:#DF0101">EMERGENCIA</td><!--G1-->
	<td>JULO _TCT&nbsp;<img src='../../img/pen.gif' /></td><!--G2-->
	<td style="color:#0080FF">RESPALDO</td><!--G3-->
	<td>PARQUE DE LA UNION&nbsp;<img src='../../img/pen.gif' /></td><!--G4-->
	<td>EXPOTECO&nbsp;<img src='../../img/pen.gif' /></td><!--G5-->
	<td></td><!--G6-->
</tr><tr onmouseover="setPointer(this, '#DADADA')" onmouseout="setPointer(this, '#FFFFFF')">
	<td>22/sep/2016</td>
	<td style="color:#DF0101">EMERGENCIA</td><!--G1-->
	<td>TAGARETE&nbsp;<img src='../../img/pen.gif' /></td><!--G2-->
	<td style="color:#0080FF">RESPALDO</td><!--G3-->
	<td>COIPASA&nbsp;<img src='../../img/pen.gif' /></td><!--G4-->
	<td></td><!--G5-->
	<td></td><!--G6-->
</tr><tr onmouseover="setPointer(this, '#DADADA')" onmouseout="setPointer(this, '#FFFFFF')">
	<td>23/sep/2016</td>
	<td></td><!--G1-->
	<td></td><!--G2-->
	<td></td><!--G3-->
	<td></td><!--G4-->
	<td></td><!--G5-->
	<td></td><!--G6-->
</tr><tr onmouseover="setPointer(this, '#DADADA')" onmouseout="setPointer(this, '#FFFFFF')">
	<td>24/sep/2016</td>
	<td></td><!--G1-->
	<td></td><!--G2-->
	<td></td><!--G3-->
	<td></td><!--G4-->
	<td></td><!--G5-->
	<td></td><!--G6-->
</tr><tr onmouseover="setPointer(this, '#DADADA')" onmouseout="setPointer(this, '#FFFFFF')">
	<td>25/sep/2016</td>
	<td></td><!--G1-->
	<td></td><!--G2-->
	<td></td><!--G3-->
	<td></td><!--G4-->
	<td></td><!--G5-->
	<td></td><!--G6-->
</tr>

<tr onmouseover="setPointer(this, '#DADADA')" onmouseout="setPointer(this, '#FFFFFF')">
	<td>26/sep/2016</td>
	<td>YPFB NORTE&nbsp;<img src='../../img/pen.gif' /></td><!--G1-->
	<td style="color:#DF0101">EMERGENCIA</td><!--G2-->
	<td>ANCACATO&nbsp;<img src='../../img/pen.gif' /></td><!--G3-->
	<td style="color:#0080FF">RESPALDO</td><!--G4-->
	<td>PUQUI&nbsp;<img src='../../img/pen.gif' /></td><!--G5-->
	<td></td><!--G6-->
</tr>
<tr onmouseover="setPointer(this, '#DADADA')" onmouseout="setPointer(this, '#FFFFFF')">
	<td>27/sep/2016</td>
	<td>SAN PEDRO DE TOTORA&nbsp;<img src='../../img/pen.gif' /></td><!--G1-->
	<td style="color:#DF0101">EMERGENCIA</td><!--G2-->
	<td>LOS PINOS&nbsp;<img src='../../img/pen.gif' /></td><!--G3-->
	<td style="color:#0080FF">RESPALDO</td><!--G4-->
	<td>ICHALULA&nbsp;<img src='../../img/pen.gif' /></td><!--G5-->
	<td></td><!--G6-->
</tr>
<tr onmouseover="setPointer(this, '#DADADA')" onmouseout="setPointer(this, '#FFFFFF')">
	<td>28/sep/2016</td>
	<td>CAQUENA&nbsp;<img src='../../img/pen.gif' /></td><!--G1-->
	<td style="color:#DF0101">EMERGENCIA</td><!--G2-->
	<td>KORICHACA&nbsp;<img src='../../img/pen.gif' /></td><!--G3-->
	<td style="color:#0080FF">RESPALDO</td><!--G4-->
	<td>FERROCARRILES&nbsp;<img src='../../img/pen.gif' /></td><!--G5-->
	<td></td><!--G6-->
</tr>
<tr onmouseover="setPointer(this, '#DADADA')" onmouseout="setPointer(this, '#FFFFFF')">
	<td>29/sep/2016</td>
	<td>ZONA ESTE&nbsp;<img src='../../img/pen.gif' /></td><!--G1-->
	<td style="color:#DF0101">EMERGENCIA</td><!--G2-->
	<td>CO. HUALLCANI&nbsp;<img src='../../img/pen.gif' /></td><!--G3-->
	<td style="color:#0080FF">RESPALDO</td><!--G4-->
	<td></td><!--G5-->
	<td></td><!--G6-->
</tr>
<tr onmouseover="setPointer(this, '#DADADA')" onmouseout="setPointer(this, '#FFFFFF')">
	<td>30/sep/2016</td>
	<td></td><!--G1-->
	<td></td><!--G2-->
	<td></td><!--G3-->
	<td></td><!--G4-->
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
	<td>Gustavo Nuñez - Cel.  68350545<br/>Jose Adrian - Cel. 67200876</td><!--G1-->
	<td>Edwin Cruz - Cel. 68350747<br/>Cristobal Gonzales - Cel. 67200699</td><!--G2-->
	<td>Pedro Ajno - Cel. 72320893<br/>Samuel Aquino - Cel. 68350538</td><!--G3-->
	<td>Pablo Goytia - Cel.  68350722<br/>Alex Choque - Cel. 71840259</td><!--G4-->
	<td>Jose V. Zaconeta - Cel. 71840246<br/>Miguel Quispe - Cel. 68350602</td><!--G5-->
	<td><br/></td><!--G6-->
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
