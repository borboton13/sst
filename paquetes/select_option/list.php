<?
header("Cache-Control: no-cache, must-revalidate" ); 
header("Pragma: no-cache" );
$search = $_GET['search'];
$put = $_GET['put'];
require("../../funciones/motor.php");
$resultado=mysql_query("SELECT sub_grupo FROM parametrica WHERE grupo='".$search."'");
while($dato=mysql_fetch_array($resultado))
 {
 $texto=htmlentities ($dato['sub_grupo']);
		echo $texto."\n";
 }
?>
