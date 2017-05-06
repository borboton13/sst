<?php

$idform = base64_decode($_GET['idform']);
$codigo = strtolower($_GET['codigo']);
$params = base64_decode($_GET['params']);

mysql_query("DELETE FROM formulario_".$codigo." WHERE id = " . $idform);
$url_volver = $link_modulo."?path=prev_estacion.php$params";

header("Location: ".$url_volver);

?>

