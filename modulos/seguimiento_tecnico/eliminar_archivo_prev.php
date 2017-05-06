<?php
/*
$iddocumento    = $_GET["iddocumento"];
$idev           = $_GET["idev"];
$codEs          = $_GET["codEs"];
$nomEs          = $_GET["nomEs"];
$ini            = $_GET["ini"];
$fin            = $_GET["fin"];
$centro         = $_GET["centro"];
$anio           = $_GET["anio"];
*/
$iddocumento    = $_GET["iddocumento"];
$ini            = $_GET["ini"];
$codEs          = $_GET["codEs"];
$centro         = $_GET["centro"];
$nombre         = $_GET["nombre"];
$params    		= base64_decode($_GET["params"]);

$arr  = explode("-", $ini);
$anio = $arr[0];
$mes  = $arr[1];

$url_volver = "$link_modulo?path=prev_estacion.php$params";
$carpeta  = "archivos_st/ST_PREV/".$anio."/".$mes."/".$centro."/".$codEs;
$nom_file = "../../".$carpeta."/".$nombre;

mysql_query("DELETE FROM documento WHERE iddocumento='".$iddocumento."'");

if (isset($nom_file)) {	
	if (unlink($nom_file)) {
		header("Location: ".$url_volver);
	}
	else {
		echo "Error al Borrar El Archivo";
		echo"<a href='".$url_volver."'>Haga Click Aqui para RETORNAR</a>";
	}
}
else {
	echo "El Archivo ya fue borrado, no existe!";
	echo"<a href='".$url_volver."'>Haga Click Aqui para RETORNAR</a>";
}

?>

