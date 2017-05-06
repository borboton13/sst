<?php
require("../../funciones/motor.php");
header("Expires: Tue, 03 Jul 2001 06:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache"); 
$id_st_personal_veedor = base64_decode($_GET["id_st_personal_veedor"]);
$id_cliente = base64_decode($_GET["id_cliente"]);
mysql_query("DELETE FROM st_personal_veedor WHERE id_st_personal_veedor='".$id_st_personal_veedor."';"); 

header ('Location: ../../modulos/seguimiento_tecnico/veedor_cliente_contactos.php?id_cliente='.$id_cliente);
?>

