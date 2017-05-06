<?php
function quitar($mensaje)
{
$nopermitidos = array("'",'\\','<','>',"\"");
$mensaje = str_replace($nopermitidos, "", $mensaje);
return $mensaje;
} 
function convertfecha($fecha,$separador)
{
$var = explode($separador,$fecha);
$fecha=$var[2].$var[1].$var[0];
return $fecha;
}
function sql_quote($value){
        if(get_magic_quotes_gpc()) $value = stripslashes($value);
		        //check if this function exists
        if(function_exists("mysql_real_escape_string"))
                $value = mysql_real_escape_string( $value );
            else//for PHP version <4.3.0 use addslashes
                $value = addslashes( $value );
        return $value;
}
function quitar_etiquetas($text){
$text = str_replace ("\r\n","",$text);
$text = str_replace ("</P>","<BR>",$text);
$text = strip_tags ($text,'<I></I><B></B><U></U><BR><BR /><STRONG></STRONG><EM></EM>');
$text = sql_quote($text);
return $text;
}

function incrementar_nro($n, $text){
	$nro = '0000100';
	if($n == 1){ //clientes: C00000
		$resultado=mysql_query("SELECT valor FROM secuencias WHERE id_secuencia='$text';");
		$dato=mysql_fetch_array($resultado);
		$str = $dato[0];
		$nro = ++$str;
		
		$sqlUpdate = mysql_query("UPDATE secuencias SET valor = '$nro' WHERE id_secuencia='$text';");
	}	
	if($n == 2){ //seguimiento_tecnico
		$resultado=mysql_query("SELECT valor FROM secuencias WHERE id_secuencia='$text';");
		$dato=mysql_fetch_array($resultado);
		$str = $dato[0];
		$nro = ++$str;
		
		$sqlUpdate = mysql_query("UPDATE secuencias SET valor = '$nro' WHERE id_secuencia='$text';");
	}
	if($n == 3){ //usuarios
		$resultado=mysql_query("SELECT valor FROM secuencias WHERE id_secuencia='$text';");
		$dato=mysql_fetch_array($resultado);
		$str = $dato[0];
		$nro = ++$str;
		
		$sqlUpdate = mysql_query("UPDATE secuencias SET valor = '$nro' WHERE id_secuencia='$text';");
	}
	return $nro;
}

function incrementar_id($tabla, $nombreID){
    $resultado=mysql_query("SELECT valor FROM secuencias WHERE id_secuencia = '$tabla';");
    $dato=mysql_fetch_array($resultado);
    $id = $dato[0];
    $nro = ++$id;
    $sqlUpdate = mysql_query("UPDATE secuencias SET valor = '$nro' WHERE id_secuencia='$tabla';");
    
    return $nro;
}

function fecha_label($fechax, $departamento){ //$fecha es de este formato --> ej: 20081229 2014-01-01 06:00:00

	$fecha = substr($fechax,0,10);
	$fecha = explode("-", $fecha);
	$fecha = $fecha[0].$fecha[1].$fecha[2];
	$tieneCeroDiaMes = substr($fecha,6,1);
	
	if ($tieneCeroDiaMes == 0) {
	    $diaMes = substr($fecha,7,1);
	} else {
	    $diaMes = substr($fecha,6,2);
	}
	
	$Mes = substr($fecha,4,2);
	$Mes = str_replace("01","Enero",$Mes);
	$Mes = str_replace("02","Febrero",$Mes);
	$Mes = str_replace("03","Marzo",$Mes);
	$Mes = str_replace("04","Abril",$Mes);
	$Mes = str_replace("05","Mayo",$Mes);
	$Mes = str_replace("06","Junio",$Mes);
	$Mes = str_replace("07","Julio",$Mes);
	$Mes = str_replace("08","Agosto",$Mes);
	$Mes = str_replace("09","Septiembre",$Mes);
	$Mes = str_replace("10","Octubre",$Mes);
	$Mes = str_replace("11","Noviembre",$Mes);
	$Mes = str_replace("12","Diciembre",$Mes);
	
	$Anio = substr($fecha,0,4);
	
	return $departamento.", ".$diaMes." de ".$Mes." de ".$Anio."";
} 

?>