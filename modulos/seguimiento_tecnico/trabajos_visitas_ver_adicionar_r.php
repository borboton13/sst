<?php
require("../../funciones/funciones.php");
require_once ('../../paquetes/jpgraph/jpgraph.php');
require_once ('../../paquetes/jpgraph/jpgraph_canvas.php');
require_once ('../../paquetes/jpgraph/jpgraph_barcode.php');
$encoder = BarcodeFactory::Create(ENCODING_CODE39);

function convertfecha_($fecha,$separador)
{
$var = explode($separador,$fecha);
$fecha=$var[2]."-".$var[1]."-".$var[0];
return $fecha;
}
//
$detalles = $_POST["detalles"];
$id_item = $_POST["id_item"];
$pro_key = $_POST["pro_key"];
$fecha_not = convertfecha_($_POST['fecha_n'],"/")." ".$_POST["hora_n"].":00";

$fecha = convertfecha($_POST['fecha'],"/");
$hora_p = $_POST["hora_p"];
$tecnico = $_POST["tecnico"];
$id_st_proyecto = $_POST["id_st_proyecto"];


	$dato_st=mysql_fetch_array(mysql_query("SELECT id_cliente FROM st_proyecto WHERE id_st_proyecto='".$id_st_proyecto."'"));
	$id_cliente = $dato_st["id_cliente"];
	
	$dato_st=mysql_fetch_array(mysql_query("SELECT MAX(periodo) AS periodo FROM st_cronograma_informes_".$pro_key." WHERE id_item='".$id_item."'"));
    $periodo=$dato_st['periodo']+1;
	
				if($hora_p!="" && $hora_p!=NULL) mysql_query("INSERT INTO st_cronograma_informes_".$pro_key."(id_st_proyecto,id_cliente,id_usuario,detalles,id_item,fecha,hora_programada,periodo,p1) VALUES('$id_st_proyecto','$id_cliente','$tecnico','$detalles',$id_item,'$fecha','$hora_p','$periodo','$fecha_not')");
			else mysql_query("INSERT INTO st_cronograma_informes_".$pro_key."(id_st_proyecto,id_cliente,id_usuario,detalles,id_item,fecha,periodo,p1) VALUES('$id_st_proyecto','$id_cliente','$tecnico','$detalles',$id_item,'$fecha','$periodo','$fecha_not')");  
		
			$id_st=mysql_insert_id();
			mkdir ("../../archivos_st/".$id_st_proyecto."/".$pro_key."_".$id_st, 0777);
			
$e = BackendFactory::Create(BACKEND_IMAGE,$encoder);
$e ->HideText(true);
$e -> SetHeight(56);
$e->Stroke("ST".strtoupper($pro_key).str_pad($id_st, 4, "0", STR_PAD_LEFT),"../../archivos_st/".$id_st_proyecto."/".$pro_key."_".$id_st."/barcode.png");

//echo"INSERT INTO st_cronograma_informes_".$pro_key."(id_st_proyecto,id_cliente,id_usuario,detalles,id_item,fecha,periodo,p1) VALUES('$id_st_proyecto','$id_cliente','$tecnico','$detalles',$id_item,'$fecha','$periodo','$fecha_not')";
	header("location: ".$link_modulo_r."?path=trabajos_visitas_ver.php&id_item=".$id_item);
?>