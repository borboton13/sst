<?php
$id_item = $_GET["id_item"];
$id_st_cronograma_informes = $_GET["id_st_cronograma_informes"];
$item = $_GET["item"];
$volver = $_GET["volver"];

$resultado=mysql_query("SELECT producto,id_st_proyecto FROM st_trabajos WHERE id_item='".$id_item."'");
$dato=mysql_fetch_array($resultado);
$producto=$dato[0];
$id_st_proyecto=$dato[1];

$dato=mysql_fetch_array(mysql_query("SELECT descripcion FROM parametrica WHERE grupo='st_archivo' AND sub_grupo='".$producto."'"));
$pro_cod=$dato[0];
$carpeta_id=$pro_cod."_".$id_st_cronograma_informes;
$link_volver = $pro_cod."_".$volver;
$url_volver=$link_modulo."?path=trabajos_informar_".$link_volver.".php&id_st_cronograma_informes=".$id_st_cronograma_informes;

$carpeta="archivos_st/".$id_st_proyecto."/".$carpeta_id;
$nom_file = "../../".$carpeta."/".base64_decode($_GET['nomfile']);

mysql_query("DELETE FROM st_cronograma_informes_".$pro_cod."_archivos WHERE id_st_cronograma_informes_".$pro_cod."='".$id_st_cronograma_informes."' AND item='".$item."'"); 

if (isset($nom_file)) {	
	if (unlink($nom_file)) {
		header("Location: ".$url_volver);
//		echo $nom_file;
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

