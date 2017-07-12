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


$idacta = base64_decode($_GET["idacta"]);
$carpeta = base64_decode($_GET["carpeta"]);

mysql_query("DELETE FROM actas WHERE idacta='".$idacta."';");
rm_recursive("../../archivos_st/actas/".$carpeta);

header("Location: ".$link_modulo."?path=actas.php");
?>

