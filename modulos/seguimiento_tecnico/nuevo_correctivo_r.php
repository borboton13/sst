<?php
require("../../funciones/motor.php");
require("../../funciones/funciones.php");

function convertfecha_($fecha,$separador){
    $var = explode($separador,$fecha);
    $fecha=$var[2]."-".$var[1]."-".$var[0];
    return $fecha;
}

$nro                = $_POST['nro'];
$producto           = $_POST['producto'];
$idareatrabajo      = $_POST['idareatrabajo'];
$marca              = $_POST['marca'];
$caracteristicas    = $_POST['caracteristicas'];
$departamento       = $_POST['departamento'];
$sn         = $_POST['sn'];
$ubicacion  = $_POST['ubicacion'];
$tecnico = $_POST["tecnico"];

$fecha_not = convertfecha_($_POST['fecha_n'],"/")." ".$_POST["hora_n"].":00";
$fecha = convertfecha($_POST['fecha'],"/");
$hora_p = $_POST["hora_p"];
$tecnico = $_POST["tecnico"];
$id_st_proyecto = $_POST["id_st_proyecto"];

$idestacion  = "NULL";
$idtipofalla = "NULL";
if (isset($_POST['idestacion']))  $idestacion  = $_POST['idestacion'];
if (isset($_POST['idtipofalla'])) $idtipofalla = $_POST['idtipofalla'];

$consulta="INSERT INTO st_trabajos(id_st_proyecto,departamento,producto,marca,caracteristicas,sn,ubicacion, idtipofalla, idestacion, idareatrabajo) 
           VALUES('$nro','$departamento','$producto','$marca','$caracteristicas','$sn','$ubicacion','$idtipofalla', '$idestacion', '$idareatrabajo'); ";
$resultado=mysql_query($consulta);
$id_item = mysql_insert_id();

$id_st_proyecto = $nro;
$detalles = $caracteristicas;

$dato_st=mysql_fetch_array(mysql_query("SELECT id_cliente FROM st_proyecto WHERE id_st_proyecto='".$id_st_proyecto."'"));
$id_cliente = $dato_st["id_cliente"];

if ($producto == "Mantenimiento correctivo"){

    mysql_query("INSERT INTO st_cronograma_informes_f001 (id_st_proyecto,id_cliente,id_usuario,detalles,id_item,fecha,hora_programada,periodo,p1)
    VALUES('$id_st_proyecto','$id_cliente','$tecnico','$detalles',$id_item,'$fecha','$hora_p', 1,'$fecha_not')");

}


if($resultado)
    header("Location: ".$link_modulo."?path=trabajos_ver_correlativo.php&nro=".$nro);
else
    echo "<b>Ocurrio un error, revise bien la información insertada!</b><br>Notifique de este error al administrador del Sistema: ".mysql_error()."<br><a href='javascript:history.back(1);'>[RETORNAR]</a>";


?>

