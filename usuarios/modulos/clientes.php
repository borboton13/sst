<?
session_start(); 
require("../../funciones/motor.php");
require("../funciones/verificar_sesion.php");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/strict.dtd">
<HTML><HEAD>
<TITLE>Sistema de Seguimiento Tecnico Dimesat</TITLE>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<SCRIPT src="../../js/general.js" type=text/javascript></SCRIPT>
<link href="../../css/general.css" rel="stylesheet" type="text/css">

<link href="../../css/menu3.css" rel="stylesheet" type="text/css">
<link href="../../css/base.css" rel="stylesheet" type="text/css">

</HEAD>
<BODY>
<?
//require("../../funciones/encabezado.php");
//require("../funciones/menu.php");
require("../funciones/menu3.php");
$modulo="clientes";
$link_modulo=$modulo.".php";
$link_modulo_r=$modulo."_r.php";
?>
<div id="wrapper"><div id="main"><div class="content">
<?php
if (isset($_REQUEST['path'])){
$path=$_REQUEST['path'];
include("../../modulos/clientes/".$path);
}
?>
</div></div></div>
<?php require("../../funciones/footer.php"); ?>
</BODY></HTML>
