<?
session_start(); 
require("../../funciones/motor.php");
//require("../funciones/verificar_sesion.php");


$codigo 			= '(NULL)';
$fecha_inicio_est 			= '(NULL)';
$hora_inicio_est 			= '(NULL)';
$descripcion 	= '(NULL)';

if($_POST['codigo'] != '')			  { $codigo 			= "'".$_POST['codigo']."'"; }
if($_POST['fecha_inicio_est'] != '')  { $fecha_inicio_est	= "'".$_POST['fecha_inicio_est']."'"; }
if($_POST['fecha_fin_est'] != '')	  { $fecha_fin_est		= "'".$_POST['fecha_fin_est']."'"; }
if($_POST['descripcion'] != '')  	  { $descripcion 		= "'".$_POST['descripcion']."'"; }





	$sql = "INSERT INTO estadisticas (cod,inicio,fin,descripcion) " .
	       "VALUES ($codigo,$fecha_inicio_est,$fecha_fin_est,$descripcion);";
	$resultado = mysql_query($sql);
	if($resultado) {
		header("Location: ../../usuarios/modulos/seguimiento_tecnico.php?path=estadisticas.php");
	}else{
		echo "ocurrio un error: ".$sql."<br>".mysql_error();
	}




//header("Location: ../../usuarios/modulos/seguimiento_tecnico.php?path=tickets.php");

?>
