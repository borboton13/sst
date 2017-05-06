<?php

// File and new size
$fechax = "2014-01-29 06:00:00";

//$fecha1 = explode("-", date());
//$fecha1 = explode("-", $fechax);
//$fecha2 = $fecha1[0].$fecha1[1].$fecha1[2];
$fecha = cambioFecha($fechax, "Cochabamba");
//$fecha = substr($fechax,0,10);
echo $fecha;


function cambioFecha($fechax, $departamento){ //$fecha es de este formato --> ej: 20081229 2014-01-01 06:00:00

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
