<?php

$iddocumentoacta = base64_decode($_GET["iddocumentoacta"]);
$nombre    		 = base64_decode($_GET["nombre"]);
$idacta    		 = base64_decode($_GET["idacta"]);
$carpeta    	 = base64_decode($_GET["carpeta"]);

$url_volver = "$link_modulo?path=actas_ver.php&idacta=".base64_encode($idacta);

$carpeta_path  = "archivos_st/actas/".$carpeta;
$nom_file = "../../".$carpeta_path."/".$nombre;

mysql_query("DELETE FROM documentoacta WHERE iddocumentoacta = '".$iddocumentoacta."'");

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

