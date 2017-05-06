<?
require("../../funciones/motor.php");
$cliente = $_GET['cliente'];
$res = mysql_query("select id from clientes where razon_social='".$cliente."'") or die(mysql_error());
$filas=mysql_num_rows($res);
$error="";
if($filas!=0)
{  
$inf = mysql_fetch_array($res);
$error=$inf["id"];
}
echo $error;
?>
