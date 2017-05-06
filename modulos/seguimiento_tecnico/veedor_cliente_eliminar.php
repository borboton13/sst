<?php
require("../../funciones/motor.php");

$id_cliente = base64_decode($_GET["id_cliente"]);
mysql_query("DELETE FROM st_personal_veedor WHERE id_cliente='".$id_cliente."';"); 

header("Location: ../../modulos/seguimiento_tecnico/veedor_ver.php");
?>

