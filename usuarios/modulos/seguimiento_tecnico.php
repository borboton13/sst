<?
session_start(); 
require("../../funciones/motor.php");
require("../funciones/verificar_sesion.php");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/strict.dtd">
<HTML>
<HEAD>
<TITLE>Sistema de Seguimiento Tecnico Dimesat</TITLE>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<SCRIPT src="../../js/general.js" type=text/javascript></SCRIPT>
<link href="../../css/general.css" rel="stylesheet" type="text/css">
<style>

</style>
</HEAD>
<BODY>
<?php
require("../../funciones/encabezado.php");
require("../funciones/menu.php");
$modulo="seguimiento_tecnico";
$link_modulo=$modulo.".php";
$link_modulo_r=$modulo."_r.php";
if (isset($_REQUEST['path'])){
$path=$_REQUEST['path'];
include("../../modulos/".$modulo."/".$path);
}
require("../../funciones/pie.php"); ?>
</BODY>
</HTML>