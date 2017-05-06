<?php
session_start();
require("../../funciones/motor.php");
require("../funciones/verificar_sesion.php");
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


$id_proyecto = base64_decode($_GET["id_proyecto"]);

mysql_query("DELETE FROM st_proyecto WHERE id_st_proyecto='".$id_proyecto."';"); 
//rm_recursive("../../archivos_st/".$id_proyecto);
header("Location: ".$link_modulo."?path=ver.php");
?>

