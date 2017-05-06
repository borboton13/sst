<?
session_start(); 
require("../../funciones/motor.php");
require("../funciones/verificar_sesion.php");

if (isset($_REQUEST['path'])){
$path=$_REQUEST['path'];
include("../../modulos/clientes/".$path);
}
?>
