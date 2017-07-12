<?php
require("../../funciones/funciones.php");

	$codigo 		= $_POST["codigo"];
	$fechainicio 	= convertfecha($_POST["fechainicio"],"/");
	$fechafin 		= convertfecha($_POST["fechafin"],"/");
	$descripcion 	= $_POST["descripcion"];

	$id 	 = incrementar_id("actas", "idacta");
	$carpeta = incrementar_nro(2, 'actas_path');

	$consulta="INSERT INTO actas SET 
	idacta		='".$id."',
	codigo		='".$codigo."',
	carpeta		='".$carpeta."',
	descripcion ='".$descripcion."',
	fechainicio ='".$fechainicio."',
	fechafin 	='".$fechafin."',
	fecharegistro = NOW()";

	$resultado = mysql_query($consulta);

	if($resultado) {

        $carpeta_path = '../../archivos_st/actas/';
        if (!file_exists($carpeta_path)) {
            mkdir($carpeta_path, 0777, true);
        }

		mkdir ("../../archivos_st/actas/".$carpeta, 0777);
		//header("Location: ".$link_modulo."?path=actas.php&nro=".base64_encode($nro));
		header("Location: ".$link_modulo."?path=actas.php");
	} else echo "<b>Ocurrio un error, revise bien la información insertada!</b><br>Notifique de este error al administrador del Sistema: ".mysql_error()."<br><a href='javascript:history.back(1);'>[RETORNAR]</a>";

?>

