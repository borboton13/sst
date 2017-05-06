<?
session_start(); 
require("../../funciones/motor.php");
//require("../funciones/verificar_sesion.php");

$estado = $_POST['estado'];
$obs = $_POST['obs'];
$id_st_proyecto = $_POST['id_st_proyecto'];
$pro_key = $_POST['pro_key'];
$cuenta = $_POST['cuenta'];
$id_st_cronograma_informes = $_POST['id_st_cronograma_informes'];
$id_st_trabajos = $_POST['id_st_trabajos'];
$nombrec = $_POST['nombrec'];

$sql = "UPDATE st_cronograma_informes_".$pro_key." SET revision_ext='1' WHERE id_st_cronograma_informes_".$pro_key." = $id_st_cronograma_informes;";
$resultado = mysql_query($sql);

$sql = "INSERT INTO st_revision_cliente (id_st_proyecto,formulario,id_st_cronograma_informes,id_st_trabajos,cuenta,nombre,observaciones,fecha,estado)" .
	   "VALUES ('$id_st_proyecto','$pro_key',$id_st_cronograma_informes,'$id_st_trabajos','$cuenta','$nombrec','$obs',NOW(),'$estado');";
$resultado = mysql_query($sql);


header("Location: ../../usuarios/modulos/seguimiento_tecnico.php?path=trabajos_ver_correlativo.php&nro=$id_st_proyecto");

?>
