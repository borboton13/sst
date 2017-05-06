<?php

ini_set("session.gc_maxlifetime","7200"); 
session_start();
$santox = $_POST["santo"];
$senax = $_POST["sena"];
$senax=md5(trim($senax));
//$senax=trim($senax);
require("funciones/motor.php");
$consulta="SELECT nivel,id FROM usuarios WHERE cuenta='$santox' and contrasena='$senax'";

$resultado=mysql_query($consulta);
$filas=mysql_num_rows($resultado);
if($filas!=0)
{  
$dato=mysql_fetch_array($resultado);
$sesionx = md5 (uniqid (rand(), true));
$_SESSION["santox"] = $santox;
$_SESSION["senax"] = $senax;
$_SESSION["sesionx"] = $sesionx;
$_SESSION["nivelx"] = $dato['nivel'];
$_SESSION["remitente"] = "st@dimesat.com.bo";
$_SESSION["nombre_remitente"] = "Dimesat Seguimiento Tecnico";
//$_SESSION["web"] = "http://www.dimesat.com";
// $_SESSION["web"] = "http://127.0.0.1/st/entelcb";
//$_SESSION["web"] = "http://localhost/st/entelcb";
$_SESSION["web"] = "http://localhost/sst";
//$_SESSION["web"] = "http://10.0.0.11/st/entelcb";
//$_SESSION["web"] = "http://st.dimesat.com/entelcb";

$_SESSION["gestion"] = date("Y");
$id_usuario = $dato['id'];
if (getenv("HTTP_X_FORWARDED_FOR")) {
  $ip   = getenv("HTTP_X_FORWARDED_FOR");
  //$client = gethostbyaddr($_SERVER['HTTP_X_FORWARDED_FOR']);
} else {
  $ip   = getenv("REMOTE_ADDR");
  //$client = gethostbyaddr($_SERVER['REMOTE_ADDR']);
}
$str = preg_split("/\./", $client);
$i = count($str);
$x = $i - 1;
$n = $i - 2;
$isp = $str[$n] . "." . $str[$x];

$consulta="INSERT INTO usuarios_registros (id_usuarios_registros, id_usuario, fecha, ip, isp) VALUES (NULL, '$id_usuario', NOW(), '$ip', '$isp')";
mysql_query($consulta);

$consulta="UPDATE usuarios SET nro_ing = nro_ing + 1, sesion_temp = '$sesionx' WHERE cuenta='$santox' and contrasena='$senax'";
mysql_query($consulta);
	
 header("Location: usuarios/modulos/seguimiento_tecnico.php?path=ver.php");
 }
else 
{
header("Location: index.php?sw=1");
}


?>