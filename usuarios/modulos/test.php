<?php
require("../../funciones/motor.php");

$resultado=mysql_query("SELECT valor FROM secuencias WHERE id_secuencia='seguimiento_tecnico';");
$dato=mysql_fetch_array($resultado);
$str = $dato[0];
echo $str;
echo "<br>";
echo strlen($str);
echo "<br>";
echo substr($str, 2);
$num = (int)substr($str, 2);
echo "<br>";
echo $num*100;
echo "<br>";echo "<br>";

echo incrementar_nro(3, 'usuarios');

function incrementar_nro($n, $text){

	$nro = '0000100';
	if($n == 1){ //clientes: C00000
		$resultado=mysql_query("SELECT valor FROM secuencias WHERE id_secuencia='$text';");
		$dato=mysql_fetch_array($resultado);
		$str = $dato[0];
		$nro = ++$str;
		
		//$sqlUpdate = mysql_query("UPDATE secuencias SET valor = '$nro' WHERE id_secuencia='$text';");
	}
	
	if($n == 2){
		$resultado=mysql_query("SELECT valor FROM secuencias WHERE id_secuencia='$text';");
		$dato=mysql_fetch_array($resultado);
		$str = $dato[0];
		$nro = ++$str;
		
		//$sqlUpdate = mysql_query("UPDATE secuencias SET valor = '$nro' WHERE id_secuencia='$text';");
	}
	
	if($n == 3){
		$resultado=mysql_query("SELECT valor FROM secuencias WHERE id_secuencia='$text';");
		$dato=mysql_fetch_array($resultado);
		$str = $dato[0];
		$nro = ++$str;
		
		//$sqlUpdate = mysql_query("UPDATE secuencias SET valor = '$nro' WHERE id_secuencia='$text';");
	}
	
	return $nro;
}

?>