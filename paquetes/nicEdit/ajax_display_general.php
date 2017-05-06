<?php
session_start(); 
header("Cache-Control: no-cache, must-revalidate" ); 
header("Pragma: no-cache" );
require("../../funciones/motor.php");
require("../../funciones/verificar_sesion.php");
$carta_id = $_GET['carta_id'];
$grupo = $_GET['grupo'];

function translate($html){			
$html = utf8_encode ($html);
$html = str_replace ("-", "&ndash;", $html);
return $html;
}

$dato=mysql_fetch_array(mysql_query("SELECT descripcion FROM parametrica WHERE grupo='".$grupo."' AND sub_grupo='".$carta_id."' LIMIT 1"));
$carta=$dato['descripcion'];

echo translate($carta);
?>