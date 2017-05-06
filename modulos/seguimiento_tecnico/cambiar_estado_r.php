<?php
require("../../funciones/funciones.php");

$idevento = $_POST["idevento"];
$params   = base64_decode($_POST['params']);
$estado   = $_POST["estado"];

$consulta  = "UPDATE evento SET estado = '$estado' WHERE idevento = '$idevento';";
$resultado = mysql_query($consulta);

if($resultado) {
	header("Location: ".$link_modulo."?path=prev_estacion.php$params");
	}
	else echo "<b>Ocurrio un error, revise bien la informacion insertada!</b><br>Notrifiue de este error al administrador del Sistema: ".mysql_error()."<br><a href='javascript:history.back(1);'>[RETORNAR]</a>";  		

?>

