<?php
//
$id_st_cronograma_informes = $_POST["id_st_cronograma_informes"];
$id_item = $_POST["id_item"];

$para = $_POST["para"];
$cc = $_POST["cc"];
$ref = $_POST["ref"];
$antecedentes = $_POST["antecedentes"];
$trabajo_r = $_POST["trabajo_r"];
$conclusiones = $_POST["conclusiones"];

	$consulta="UPDATE st_cronograma_informes_f001 SET 
	para = '".$para."',
	cc='".$cc."',
	ref='".$ref."',
	antecedentes='".$antecedentes."',
	trabajo_r='".$trabajo_r."', 
	conclusiones='".$conclusiones."', 
	pasos = '2' 
	WHERE id_st_cronograma_informes_f001='".$id_st_cronograma_informes."'";
	$resultado=mysql_query($consulta);
	if($resultado) {
	header("location: ".$link_modulo."?path=trabajos_informar_f001_3.php&id_st_cronograma_informes=".$id_st_cronograma_informes);				
	}
	else echo "<center><b>AMPER SRL: Ocurrio un Error!</b><br><a href='javascript:history.back(1);'>[RETORNAR]</a>
	</center>";
?>