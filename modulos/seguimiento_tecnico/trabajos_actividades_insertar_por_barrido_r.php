<?php
require("../../funciones/funciones.php");

require_once ('../../paquetes/jpgraph/jpgraph.php');
require_once ('../../paquetes/jpgraph/jpgraph_canvas.php');
require_once ('../../paquetes/jpgraph/jpgraph_barcode.php');
$encoder = BarcodeFactory::Create(ENCODING_CODE39);


$nro = $_POST["nro"];
$id_cliente = $_POST["id_cliente"];

$productos = $_POST["productos"];
$ids = $_POST["ids"];
$tecnico = $_POST["tecnico"];
$fecha = $_POST["fecha"];
$hora = $_POST["hora"];
foreach( $ids as $key => $value )
{
	if($tecnico[$key]!="0" && $fecha[$key]!="") {
	$fecha_ = convertfecha($fecha[$key],"/");
	
	$dato_st=mysql_fetch_array(mysql_query("SELECT descripcion FROM parametrica b  WHERE grupo='st' AND sub_grupo='".$productos[$key]."'"));
    $st_cronograma_informes=$dato_st['descripcion'];
	
	$dato_st=mysql_fetch_array(mysql_query("SELECT descripcion FROM parametrica b  WHERE grupo='st_archivo' AND sub_grupo='".$productos[$key]."'"));
    $st_form=$dato_st['descripcion'];
	
	$dato_st=mysql_fetch_array(mysql_query("SELECT MAX(periodo) AS periodo FROM ".$st_cronograma_informes." WHERE id_item='".$value."'"));
    $periodo=$dato_st['periodo']+1;
		 
			if($hora[$key]!="" && $hora[$key]!=NULL) mysql_query("INSERT INTO ".$st_cronograma_informes."(id_st_proyecto,id_cliente,id_usuario,id_item,fecha,hora_programada,periodo) VALUES('$nro','$id_cliente','$tecnico[$key]',$value,'$fecha_','$hora[$key]','$periodo')");
			else mysql_query("INSERT INTO ".$st_cronograma_informes."(id_st_proyecto,id_cliente,id_usuario,id_item,fecha,periodo) VALUES('$nro','$id_cliente','$tecnico[$key]',$value,'$fecha_','$periodo')");  
		
			$id_st=mysql_insert_id();
			mkdir ("../../archivos_st/".$nro."/".$st_form."_".$id_st, 0777);


$e = BackendFactory::Create(BACKEND_IMAGE,$encoder);
$e ->HideText(true);
$e -> SetHeight(56);
$e->Stroke(strtoupper($st_form).str_pad($id_st, 4, "0", STR_PAD_LEFT),"../../archivos_st/".$nro."/".$st_form."_".$id_st."/barcode.png");


	}
}
header("location: ".$link_modulo."?path=trabajos_ver.php&nro=".base64_encode($nro));
?>

