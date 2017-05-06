<?php
/*
$idform = base64_decode($_GET['idform']);
$codigo = strtolower($_GET['codigo']);
$params = base64_decode($_GET['params']);
*/
$idevento     = $_GET['idevento'];
$param_volver = base64_decode($_GET['param_volver']);

//print("....param: " . $param_volver);

mysql_query("DELETE FROM evento WHERE idevento = " . $idevento);
$url_volver = $link_modulo."?path=cronograma_prev.php$param_volver";

header("Location: ".$url_volver);

?>

