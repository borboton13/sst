<?php
//

function rm_recursive($filepath) {
    if (is_dir($filepath) && !is_link($filepath)) {
        if ($dh = opendir($filepath)) {
            while (($sf = readdir($dh)) !== false) {  
                if ($sf == '.' || $sf == '..') {
                    continue;
                }
                if (!rm_recursive($filepath.'/'.$sf)) {
                    throw new Exception($filepath.'/'.$sf.' could not be deleted.');
                }
            }
            closedir($dh);
        }
        return rmdir($filepath);
    }
    return unlink($filepath);
}



$pro_key = base64_decode($_GET["pro_key"]);
$id_st_cronograma_informes = $_GET["id_st_cronograma_informes"];

 $dato_p=mysql_fetch_array(mysql_query("SELECT id_item,id_st_proyecto FROM st_cronograma_informes_".$pro_key." WHERE id_st_cronograma_informes_".$pro_key."='".$id_st_cronograma_informes."'"));
 $id_item=$dato_p['id_item'];
 $id_st_proyecto=$dato_p['id_st_proyecto'];
 
mysql_query("DELETE FROM st_cronograma_informes_".$pro_key." WHERE id_st_cronograma_informes_".$pro_key."='".$id_st_cronograma_informes."';"); 

rm_recursive("../../archivos_st/".$id_st_proyecto."/".$pro_key."_".$id_st_cronograma_informes);

	header("location: ".$link_modulo_r."?path=trabajos_visitas_ver.php&id_item=".$id_item);
?>