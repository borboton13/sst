<?
require("../../funciones/motor.php");
$prov = $_GET['prov'];
$res = mysql_query("SELECT id_oc_exterior_proveedor FROM oc_exterior_proveedor WHERE empresa='".$prov."'") or die(mysql_error());
$filas=mysql_num_rows($res);
$error="";
if($filas!=0)
{  
$inf = mysql_fetch_array($res);
$error=$inf["id_oc_exterior_proveedor"];
}
echo $error;
?>
