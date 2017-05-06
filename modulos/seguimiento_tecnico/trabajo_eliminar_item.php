<?php
session_start();
require("../../funciones/motor.php");
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

//rm_recursive("../../archivos_st/".$id_st_proyecto."/".$pro_key."_".$id_st_cronograma_informes);

$id_item = base64_decode($_GET["id_item"]);
$nro = base64_decode($_GET["nro"]);
$adm = $_GET["adm"];
mysql_query("DELETE FROM st_cronograma_informes_f001 WHERE id_item='".$id_item."';"); 
mysql_query("DELETE FROM st_cronograma_informes_f002 WHERE id_item='".$id_item."';"); 
mysql_query("DELETE FROM st_cronograma_informes_f003 WHERE id_item='".$id_item."';"); 
mysql_query("DELETE FROM st_trabajos WHERE id_item='".$id_item."';"); 

include('trabajos_listar.php');
//echo "DELETE FROM st_trabajos WHERE id_item='".$id_item."';";
mostrar_detalles($nro);
?>

