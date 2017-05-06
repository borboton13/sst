<?
session_start(); 
$id_usuario = $_POST["id_usuario"];
require("../../funciones/motor.php");
require("../funciones/verificar_sesion.php");
	$dato=mysql_fetch_array(mysql_query("SELECT cuenta,contrasena,sesion_temp,nivel FROM usuarios WHERE id='".$id_usuario."'"));	
	$_SESSION["santox"] = $dato['cuenta'];
	$_SESSION["senax"] = $dato['contrasena'];
	$_SESSION["sesionx"] = $dato['sesion_temp'];
	$_SESSION["nivelx"] = $dato['nivel'];
		switch($dato['nivel'])
	{
	case '1': header("Location: ../../gerencia/panel_control/panel_control.php"); break;
	case '2': header("Location: ../../administracion/panel_control/panel_control.php"); break;
	case '3': header("Location: ../../ventas/panel_control/panel_control.php");break;
	case '4': header("Location: ../../tecnicos/panel_control/panel_control.php"); break;
	case '5': header("Location: ../../almacenes/panel_control/panel_control.php"); break;
	case '6': header("Location: ../../financiero/panel_control/panel_control.php"); break;
	case '7': header("Location: ../../laboratorio/panel_control/panel_control.php"); break;
	case '8': header("Location: ../../staff/panel_control/panel_control.php"); break;
	case '9': header("Location: ../../jefatura_proyecto/panel_control/panel_control.php"); break;
	case 'A': header("Location: ../../marketing/panel_control/panel_control.php"); break;
	case 'B': header("Location: ../../webmaster/panel_control/panel_control.php"); break;
	default: header("Location: index.php?sw=1"); 
	}
?>