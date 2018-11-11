<?php
if($nively=='1'){ $adm=1;}
//$rowt=array("#f1f1f1","#f6f7f8");

if(isset($_GET["mes"]))  $mes  = $_GET["mes"];
if(isset($_GET["anio"])) $anio = $_GET["anio"];
if(isset($_GET["centro"])) $codCentro = $_GET["centro"];

if(isset($_POST["mes"]))  $mes  = $_POST["mes"];
if(isset($_POST["anio"])) $anio = $_POST["anio"];
if(isset($_POST["centro"])) $codCentro = $_POST["centro"];

$param_volver = base64_encode("&mes=$mes&anio=$anio&centro=$codCentro");

/** ----- **/

# definimos los valores iniciales para nuestro calendario
//$month      = date("n")-1;
$month      = $mes;
//$year       = date("Y");
$year       = $anio;
$diaActual  = date("j");

# Devuelve 0 para domingo, 6 para sabado
$diaSemana = date("w",mktime(0,0,0,$month,1,$year))+0;
# Obtenemos el ultimo dia del mes
$ultimoDiaMes = date("d",(mktime(0,0,0,$month+1,1,$year)-1));
$meses = array(1=>"Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");

$inicio = $anio."-".$mes."-"."01";
$fin    = $anio."-".$mes."-".$ultimoDiaMes;

$resultado = mysql_query("
SELECT ev.idevento, ev.estado, ev.inicio, ev.fin, es.codigo, es.nombre, g.codigo AS codigog, c.idcentro, c.codigo as codCentro
FROM evento ev
JOIN estacion es ON ev.idestacion = es.idestacion
JOIN grupo g 	 ON ev.idgrupo = g.idgrupo
JOIN centro c    ON ev.idcentro = c.idcentro
WHERE ev.inicio BETWEEN '$inicio' AND '$fin'
AND c.codigo = '$codCentro'
");

$filas	   = mysql_num_rows($resultado);

?>

<table border="0" width="100%">
    <tr>
        <td align="center" colspan="2"><br>
            <img src='../../img/ico_pen.png' alt='pen'> Pendiente (Llenado de informes)&nbsp;&nbsp;|&nbsp;
            <img src='../../img/ico_fin.png' alt='fin'> Finalizado (Informes concluidos)&nbsp;&nbsp;|&nbsp;
            <img src='../../img/ico_rev.png' alt='rev'> Revisado (Revisado por Responsable de Mtto.)&nbsp;
        </td>
    </tr>
    <tr>
        <td  align="center"><span class="naranja">&nbsp;Centro de Mantenimiento:&nbsp;</span></td>
        <td class="marco_">
            <form name="amper" method="post" action="#">
                <select name="centro" class="selectbuscar">
                    <?php
                    $res=mysql_query("SELECT idcentro, nombre, codigo FROM centro");
                    while($dato=mysql_fetch_array($res)){
                        $nombre = $dato['nombre'];
                        $codigo = $dato['codigo'];
                        $selected = '';
                        if($codCentro == $codigo) $selected = "class='naranja' selected";
                        echo"<option value='$codigo' $selected>$nombre</option>";
                    }
                    ?>
                </select>

                <select name="mes" class="selectbuscar">
                    <option value="01" <?php if($mes=='01') echo"class='naranja' selected"; ?>>Enero</option>
                    <option value="02" <?php if($mes=='02') echo"class='naranja' selected"; ?>>Febrero</option>
                    <option value="03" <?php if($mes=='03') echo"class='naranja' selected"; ?>>Marzo</option>
                    <option value="04" <?php if($mes=='04') echo"class='naranja' selected"; ?>>Abril</option>
                    <option value="05" <?php if($mes=='05') echo"class='naranja' selected"; ?>>Mayo</option>
                    <option value="06" <?php if($mes=='06') echo"class='naranja' selected"; ?>>Junio</option>
                    <option value="07" <?php if($mes=='07') echo"class='naranja' selected"; ?>>Julio</option>
                    <option value="08" <?php if($mes=='08') echo"class='naranja' selected"; ?>>Agosto</option>
                    <option value="09" <?php if($mes=='09') echo"class='naranja' selected"; ?>>Septiembre</option>
                    <option value="10" <?php if($mes=='10') echo"class='naranja' selected"; ?>>Octubre</option>
                    <option value="11" <?php if($mes=='11') echo"class='naranja' selected"; ?>>Noviembre</option>
                    <option value="12" <?php if($mes=='12') echo"class='naranja' selected"; ?>>Diciembre</option>
                </select>

                <select name="anio" class="selectbuscar">
                    <option value="2018" <? if($anio==2018) echo"class='naranja' selected"; ?>>2018</option>
                    <option value="2017" <? if($anio==2017) echo"class='naranja' selected"; ?>>2017</option>
                    <option value="2016" <? if($anio==2016) echo"class='naranja' selected"; ?>>2016</option>
                </select>&nbsp;
                <input class="btn_dark" name="ver" type="submit"  value=" Ver " /> &nbsp;
                <? if($admin || $tech){?>
                    <input class="btn_dark" name="nuevoE" type="button" value="Nuevo Evento" onClick="location.href='<?=$link_modulo?>?path=nuevo_evento.php'" />
                <?php } ?>
            </form>
        </td>
        <!--<td>|<td/>-->
        <!--<td class="marco"><a class="enlacebotonverde" href="<?/* echo $link_modulo . '?path=prev_cert_cba.php' */?>">&nbsp;CERTIFICADOS Y ACTAS&nbsp;</a></td>-->
        <!--<input name="report" type="button" value="Reporte Mtto" onClick="location.href='<?/*=$link_modulo*/?>?path=reporte_mtto_prev.php'" />-->
        <? if($admin || $client){?>
        <td class="" align="center"><a class="enlacebtn" href="<? echo $link_modulo . '?path=reporte_mtto_prev.php' ?>">&nbsp;Reportes x Formulario&nbsp;</a></td>
        <!--<td class="" align="center"><a class="enlacebotonverde" href="<?/* echo $link_modulo . '?path=reporte_mtto_prev.php' */?>">&nbsp;Reportes x Formulario&nbsp;</a></td>-->
        <?php } ?>
    </tr>
</table>

<table width="100%" align="center" class="table4">
<!--<caption>CRONOGRAMA CENTRO DE MANTENIMIENTO</caption>-->
    <tr>
        <th width="1%">Fecha</th>
        <th width="10%">GRUPO 1</th>
        <th width="10%">GRUPO 2</th>
        <th width="10%">GRUPO 3</th>
        <th width="10%">GRUPO 4</th>
        <th width="10%">GRUPO 5</th>
        <th width="10%">GRUPO 6</th>
        <th width="10%">GRUPO 7</th>
        <th width="10%">GRUPO 8</th>
        <th width="10%">GRUPO 9</th>
        <th width="9%">GRUPO 10</th>
    </tr>

<?php 
// Columnas (Grupos)
for ($c=1; $c<=11; $c++){
	$a[0][$c]= $c;
}
// Filas (Fechas)
for ($f=0; $f<=$ultimoDiaMes; $f++){
	$a[$f][0] = $f; 
}

// Cargando estaciones y datos a la matriz
while($dato=mysql_fetch_array($resultado)){
    $idevento       = $dato['idevento'];
    $codigoEstacion = $dato['codigo'];
    $nombreEstacion = $dato['nombre'];
    $grupo          = $dato['codigog'];
    $fechaInicio    = $dato['inicio'];
    $fechaFin       = $dato['fin'];
    
    $fecha = explode("-", $dato['inicio']);
    $estado = "";
    if($dato['estado'] == "PEN") $estado = "&nbsp;<img src='../../img/ico_pen.png' />";
    //if($dato['estado'] == "EJE") $estado = "&nbsp;<img src='../../img/ok4.png' alt='ver' border='0' />";
    if($dato['estado'] == "FIN") $estado = "&nbsp;<img src='../../img/ico_fin.png' alt='ver' border='0' />";
    if($dato['estado'] == "REV") $estado = "&nbsp;<img src='../../img/ico_rev.png' alt='ver' border='0' />";
    $f = intval($fecha[2]);
    $c = $dato['codigog'];


    /** **/
    $res_forms = mysql_query("SELECT * FROM formulario_mtto f WHERE f.idevento = $idevento");
    $res_docs = mysql_query("SELECT * FROM documento d WHERE d.idevento = $idevento");

    $num_forms = mysql_num_rows($res_forms);
    $num_docs = mysql_num_rows($res_docs);

    //$msg = "DIMESAT: Esta seguro que desea eliminar el Evento $nombreEstacion ?";

    $a[$f][$c] .= "<a class='enlaceboton'
                      href='$link_modulo?path=prev_estacion.php&anio=$anio&codCentro=$codCentro&ini=$fechaInicio&fin=$fechaFin&idev=$idevento&codEs=$codigoEstacion&nomEs=$nombreEstacion'>" .
                      $dato['nombre'] . "<a/>" . $estado;
    if($num_forms == 0 && $num_docs == 0 && $admin){
        $a[$f][$c] .= "<a title='Eliminar evento' href='$link_modulo_r?path=eliminar_evento.php&idevento=$idevento&param_volver=$param_volver'>".
                       '<img src="../../img/ico_del.png" border="0" onclick="return confirm(\'DIMESAT: Esta seguro que desea eliminar el Evento\');"></a>';
    }
    $a[$f][$c] .= "<br />";
}

// Mostrando matriz con datos pcargados previamente
$html_tr = "";
for ($i=1;$i<=$ultimoDiaMes;$i++){
    //print("<tr>");
    $html_tr .= '<tr onmouseover="setPointer(this, \'#DADADA\')" onmouseout="setPointer(this, \'#FFFFFF\')">';
    for($j=0;$j<11;$j++) {
	    //print("<td>".$a[$i][$j]."</td>");
        $html_tr .= "<td>".$a[$i][$j]."</td>";
    }
}
print $html_tr;
?>

    <tr>
        <th width="1%">Fecha</th>
        <th width="10%">GRUPO 1</th>
        <th width="10%">GRUPO 2</th>
        <th width="10%">GRUPO 3</th>
        <th width="10%">GRUPO 4</th>
        <th width="10%">GRUPO 5</th>
        <th width="10%">GRUPO 6</th>
        <th width="10%">GRUPO 7</th>
        <th width="10%">GRUPO 8</th>
        <th width="10%">GRUPO 9</th>
        <th width="9%">GRUPO 10</th>
    </tr>

</table>

<link href="../../paquetes/greybox/gb_styles.css" rel="stylesheet" type="text/css" media="all" />
<script type="text/javascript">var GB_ROOT_DIR = "./../../paquetes/greybox/";</script>
<script type="text/javascript" src="../../paquetes/greybox/AJS.js"></script>
<script type="text/javascript" src="../../paquetes/greybox/AJS_fx.js"></script>
<script type="text/javascript" src="../../paquetes/greybox/gb_scripts_no_reload.js"></script>

