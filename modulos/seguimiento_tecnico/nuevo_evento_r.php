<?php
require("../../funciones/funciones.php");

$estacion = $_POST["estacion"];
$idcentro = $_POST["idcentro"];
$idgrupo = $_POST["idgrupo"];
$fechainicio = convertfecha($_POST["fechainicio"],"/");
$fechafin = convertfecha($_POST["fechafin"],"/");

$resultado=mysql_query("SELECT idestacion "
                     . "FROM estacion "
                     . "WHERE nombre='$estacion' ");//"AND idcentro='$idcentro';"

$filas=mysql_num_rows($resultado);
if($filas!=0){
    $dato = mysql_fetch_array($resultado);
    $idestacion = $dato['idestacion'];
}

$id = incrementar_id("evento", "idevento");

$consulta="INSERT INTO evento SET 
idevento='".$id."',
idgrupo='".$idgrupo."',    
idestacion='".$idestacion."',    
titulo='MTTO PREVENTIVO',
inicio='".$fechainicio."',
fin='".$fechafin."',
estado='PEN',
idcentro='".$idcentro."'";

$resultado=mysql_query($consulta);

if($resultado) {
	header("Location: ".$link_modulo."?path=nuevo_evento.php");
	}
	else echo "<b>Ocurrio un error, revise bien la informacion insertada!</b><br>Notrifiue de este error al administrador del Sistema: ".mysql_error()."<br><a href='javascript:history.back(1);'>[RETORNAR]</a>";  		

?>

