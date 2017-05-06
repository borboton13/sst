<?php
require("../../funciones/motor.php");

$nro=$_POST['nro'];
$producto=$_POST['producto'];
$marca=$_POST['marca'];
$caracteristicas=$_POST['caracteristicas'];
$departamento=$_POST['departamento'];
$sn=$_POST['sn'];
$ubicacion=$_POST['ubicacion'];

$consulta="INSERT INTO st_trabajos(id_item,id_st_proyecto,departamento,producto,marca,caracteristicas,sn,ubicacion) VALUES('','$nro','$departamento','$producto','$marca','$caracteristicas','$sn','$ubicacion'); ";
mysql_query($consulta);

include('../../modulos/seguimiento_tecnico/trabajos_listar.php');
mostrar_detalles($nro);
?>

