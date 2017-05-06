<?
session_start(); 
require("../../funciones/motor.php");
//require("../funciones/verificar_sesion.php");

$filas = $_POST['filas'];
$ticket 			= '(NULL)';
$idnodo 			= '(NULL)';
$estacion 			= '(NULL)';
$fecha_inicio_rif 	= '(NULL)';
$hora_inicio_rif 	= '(NULL)';
$fecha_fin_rif 		= '(NULL)';
$hora_fin_rif 		= '(NULL)';
$tipo 				= '(NULL)';
$problema 			= '(NULL)';
$fecha_not 			= '(NULL)';
$hora_not 			= '(NULL)';
$plan_accion 		= '(NULL)';
$trabajo_realizado 	= '(NULL)';
$personal 			= '(NULL)';
$observaciones 		= '(NULL)';

if($_POST['ticket'] != '')			  { $ticket 			= "'".$_POST['ticket']."'"; }
if($_POST['idnodo'] != '')			  { $idnodo 			= $_POST['idnodo']; }
if($_POST['estacion'] != '')		  { $estacion 			= "'".$_POST['estacion']."'"; }
if($_POST['fecha_inicio_rif'] != '')  { $fecha_inicio_rif 	= "'".$_POST['fecha_inicio_rif']."'"; }
if($_POST['hora_inicio_rif'] != '')   { $hora_inicio_rif 	= "'".$_POST['hora_inicio_rif']."'";  }
if($_POST['fecha_fin_rif'] != '') 	  { $fecha_fin_rif 		= "'".$_POST['fecha_fin_rif']."'"; }
if($_POST['hora_fin_rif'] != '') 	  { $hora_fin_rif 		= "'".$_POST['hora_fin_rif']."'"; }
if($_POST['tipo'] != '') 			  { $tipo 				= "'".$_POST['tipo']."'"; }
if($_POST['problema'] != '')		  { $problema 			= "'".$_POST['problema']."'"; }
if($_POST['fecha_not'] != '')		  { $fecha_not 			= "'".$_POST['fecha_not']."'"; }
if($_POST['hora_not'] != '')		  { $hora_not 			= "'".$_POST['hora_not']."'"; }
if($_POST['plan_accion'] != '')		  { $plan_accion 		= "'".$_POST['plan_accion']."'"; }
if($_POST['trabajo_realizado'] != '') { $trabajo_realizado 	= "'".$_POST['trabajo_realizado']."'"; }
if($_POST['personal'] != '') 		  { $personal 			= "'".$_POST['personal']."'"; }
if($_POST['observaciones'] != '')	  { $observaciones 		= "'".$_POST['observaciones']."'"; }


if($filas == 1){ // ACTUALIZAR REGISTRO
	$id_st_ticket = $_POST['id_st_ticket'];
	$sql = "UPDATE st_ticket set ticket				= $ticket," .
								"idnodo				= $idnodo," .
								"estacion			= $estacion," .
								"fecha_inicio_rif	= $fecha_inicio_rif," .
								"hora_inicio_rif	= $hora_inicio_rif," .
								"fecha_fin_rif		= $fecha_fin_rif," .
								"hora_fin_rif		= $hora_fin_rif," .
								"tipo				= $tipo," .
								"problema			= $problema," .
								"fecha_not			= $fecha_not," .
								"hora_not			= $hora_not,   " .
								"plan_accion		= $plan_accion," .
								"trabajo_realizado	= $trabajo_realizado," .
								"personal			= $personal," .
								"observaciones		= $observaciones" .
			"WHERE id_st_ticket = $id_st_ticket;";
	$resultado = mysql_query($sql);
	if($resultado) {
		header("Location: ../../usuarios/modulos/seguimiento_tecnico.php?path=tickets.php");
	}else{
		echo "ocurrio un error: ".$sql."<br>".mysql_error();
	}
	
}

if($filas == 0){	// NUEVO REGISTRO
	$sql = "INSERT INTO st_ticket (ticket,   idnodo,   estacion,   fecha_inicio_rif,   hora_inicio_rif,   fecha_fin_rif,   hora_fin_rif,   tipo,   problema,   fecha_not,   hora_not,   plan_accion,   trabajo_realizado,   personal,   observaciones) " .
	       "VALUES 				($ticket,$idnodo,$estacion,$fecha_inicio_rif,$hora_inicio_rif,$fecha_fin_rif,$hora_fin_rif,$tipo,$problema,$fecha_not,$hora_not,$plan_accion,$trabajo_realizado,$personal,$observaciones);";
	$resultado = mysql_query($sql);
	if($resultado) {
		header("Location: ../../usuarios/modulos/seguimiento_tecnico.php?path=tickets.php");
	}else{
		echo "ocurrio un error: ".$sql."<br>".mysql_error();
	}
}



//header("Location: ../../usuarios/modulos/seguimiento_tecnico.php?path=tickets.php");

?>
