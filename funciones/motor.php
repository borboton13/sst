<?php
//$conexion=mysql_connect("localhost","ariel_ampersia","ampersis");
//$conexion=mysql_connect("localhost","dimesatc_stcba","BH8JfWtt3Zdt");
$conexion=mysql_connect("localhost","root","mysql");

if (! $conexion){

echo "<h2 align='center'>ERROR: Imposible establecer conecci�n con el servidor de DIMESAT</h2>";

exit;

}
$base=mysql_select_db("dimesatc_stcb");
?>
