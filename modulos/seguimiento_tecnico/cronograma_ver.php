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

?>

<table width="98%" align="center" class="table3">
<caption>
CRONOGRAMA DE EQUIPOS/SERVICIOS PARA SEGUIMIENTO TECNICO
</caption>
<tr><TD colspan="7">
<table>
<tr>
<td class="marco">
	<form name="amper" method="post" action="#">
	  <span class="naranja">Seleccione el mes a ver:</span> 
	  <input name="menos" type="submit" class="BotonForm" value="&lt;">
	  <select name="mes" class="selectbuscar">
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
        <select name="anio" class="selectbuscar">
          <option value="2011" <? if($anio==2011) echo"class='naranja' selected"; ?>>2011</option>
          <option value="2012" <? if($anio==2012) echo"class='naranja' selected"; ?>>2012</option>
          <option value="2013" <? if($anio==2013) echo"class='naranja' selected"; ?>>2013</option>
          <option value="2014" <? if($anio==2014) echo"class='naranja' selected"; ?>>2014</option>
          <option value="2008" <? if($anio==2014) echo"class='naranja' selected"; ?>>2015</option>
          <option value="2009" <? if($anio==2015) echo"class='naranja' selected"; ?>>2016</option>
        </select>
        <input name="mas" type="submit" class="BotonForm" value="&gt;">
        &nbsp;
        <input name="ver" type="submit" class="BotonForm" value="Ver"></form>
	</td><td class="marco"> <a class="enlaceboton" href="../../pdf/pdf_st_listado_cronograma.php?mes=<?=$mes;?>&anio=<?=$anio;?>&id_user=<?=$id_user?>&adm=<?=$adm?>" onClick="openNewWindowhtml( this, '800', '590' );return false;"><img src="../../img/imp.gif" alt="Ver Listado en PDF" width="20" height="20" border="0" align="absmiddle" /> Ver Listado en PDF</a>	</td>	

	</tr>
</table>
</TD></tr>

<tr>
<th width="2%">N&deg;</th>
<th width="4%">DIA</th>
<th width="7%">FECHA</th>			              
<th width="13%">RESPONSABLE</th>
<th width="17%">ESTADO</th> 
<th width="46%">CLIENTE, PRODUCTO/SERVICIO Y LUGAR </th>
<th width="9%">SEGUIMIENTO</th>
</tr>
	<? 
	$consulta="SELECT dia,date_format(fecha,'%d/%m/%y'),responsable,condicion_final,departamento,razon_social,producto,marca,caracteristicas,ubicacion,id_item,id_st_proyecto,date_format(hora_programada,'%H:%i'),postm_condicion_final FROM v_st_cronograma WHERE MONTH(fecha)='$mes' AND YEAR(fecha)='$anio'";
	
	if($adm!=1){
	$add_sql=" AND id_usuario='".$id_user."'";
	}
	
	$consulta.=$add_sql." ORDER BY fecha";
	
	$resultado=mysql_query($consulta);
	$filas=mysql_num_rows($resultado);
	if($filas!=0)
	{ $i=0;
	while($dato=mysql_fetch_array($resultado))
	 {
	 $dia=$dato[0]; 
	 $fecha=$dato[1]; 
	 $responsable=$dato[2]; 
	 $condicion_final=$dato[3]; 
	 $departamento=$dato[4];
	 $razon_social=$dato[5]; 
	 $producto=$dato[6];
	 $marca=$dato[7];
	 $caracteristicas=$dato[8];
	 $ubicacion=$dato[9];
	 $id_item=$dato[10]; 
	 $nro=$dato[11];
	 $hora_p=$dato[12];
	 $postm_condicion_final=$dato[13];  
	 $i++;
	 
	switch($condicion_final){
	case 'OK' : $img="<img src='../../img/semaforo_verde.gif' border=\"0\" width=\"46\" height=\"16\" align=\"absmiddle\">"; break;
	case 'Pendiente' : 
	if($postm_condicion_final=="OK+") {
	$img="<img src='../../img/semaforo_azul.gif' border=\"0\" width=\"62\" height=\"16\" align=\"absmiddle\" alt='Estado: OK'>";
	$condicion_final=$postm_condicion_final;
	}		
		else $img="<img src='../../img/semaforo_amarillo.gif' border=\"0\" width=\"46\" height=\"16\" align=\"absmiddle\">"; break;
	case 'Irreparable' : 
	if($postm_condicion_final=="OK+") {
	$img="<img src='../../img/semaforo_azul.gif' border=\"0\" width=\"62\" height=\"16\" align=\"absmiddle\" alt='Estado: OK'>";
	$condicion_final=$postm_condicion_final;
	}		
		else $img="<img src='../../img/semaforo_rojo.gif' border=\"0\" width=\"46\" height=\"16\" align=\"absmiddle\">"; break;
default: $img="Sin Reporte <img src='../../img/ico_reloj.gif' alt='Esperando próxima fecha' border=\"0\">";
	}

	 
	echo"
	<tr bgcolor='".$rowt[$i%2]."' onmouseover=\"setPointer(this, '#DADADA')\" onmouseout=\"setPointer(this, '".$rowt[$i%2]."')\">
	<td>".$i."</td>
	<td><center><span class='large'><b>".$dia."</b></span></center></td>
	<td><center>".$fecha."<BR>".$hora_p."</center></td>
	<td>".$responsable."</td>
	<td><center><span class='azul'>".$condicion_final."</span> ".$img."</center></td>
	<td>
	<b>Cliente:</b> <span class='naranja'>".$razon_social."</span><br>
	<span class='small'><b>Departamento:</b></span> <span class='verde'>".$departamento."</span><br><span class='small'>
	<b>Producto: <span class='cafe'>".$producto."</span></b><br>
	<b>Marca:</b> ".$marca."<br>
	<b>Caracteristicas:</b> ".$caracteristicas."<br>
	<b>Ubicacion:</b> ".$ubicacion."</span>
	</td>
	<td><center><a href='".$link_modulo_r."?path=trabajos_visitas_ver.php&id_item=".$id_item."' onclick=\"return GB_showCenter('Ver Actividades', this.href,460, 460)\" class='enlaceboton'><img src='../../img/glyphs_info.gif' alt='Dar Informe' border=\"0\">Informe</a></center></td>
	</tr>
	";

	 }
	}
	?>
</table>			  			
<link href="../../paquetes/greybox/gb_styles.css" rel="stylesheet" type="text/css" media="all" />
    <script type="text/javascript">
        var GB_ROOT_DIR = "./../../paquetes/greybox/";
    </script>    
	<script type="text/javascript" src="../../paquetes/greybox/AJS.js"></script>
    <script type="text/javascript" src="../../paquetes/greybox/AJS_fx.js"></script>
    <script type="text/javascript" src="../../paquetes/greybox/gb_scripts_no_reload.js"></script>
</HTML>
