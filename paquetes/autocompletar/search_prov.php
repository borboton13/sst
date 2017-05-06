<?

require("../../funciones/motor.php");
//isset($_GET['getCountriesByLetters']) && 
if(isset($_GET['letters'])){
	$letters = $_GET['letters'];
	$letters = preg_replace("/[^a-z0-9 ]/si","",$letters);
	$res = mysql_query("SELECT id,empresa FROM proveedor WHERE empresa LIKE '".$letters."%'") or die(mysql_error());
	while($inf = mysql_fetch_array($res)){
		echo $inf["id"]."###".htmlentities ($inf["empresa"])."|";
	}	
}
?>
