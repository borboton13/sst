<?php
require("../../funciones/funciones.php");
//
$cliente = $_POST["cliente"];
$fecha_ini = convertfecha($_POST["fecha_ini"],"/");
$fecha_fin = convertfecha($_POST["fecha_fin"],"/");
$obs = $_POST["obs"];


	$resultado=mysql_query("SELECT id FROM clientes WHERE razon_social='$cliente';");
	$filas=mysql_num_rows($resultado);
	if($filas!=0)
	{
	$dato=mysql_fetch_array($resultado);
	$id_cliente=$dato['id'];

		/*
		$dato=mysql_fetch_array(mysql_query("SELECT incrementar_nro(2,'seguimiento_tecnico')"));
		$nro=$dato[0];
		*/
		$nro = incrementar_nro(2, 'seguimiento_tecnico');
		
$consulta="INSERT INTO st_proyecto SET 
id_st_proyecto='".$nro."',
id_cliente='".$id_cliente."',
declaracion_proyecto='".$obs."',
fecha_inicio='".$fecha_ini."',
fecha_final='".$fecha_fin."',
id_usuario='".$id_user."',
fecha_registro=NOW()
";		
$resultado=mysql_query($consulta);

if($resultado) {
	//mkdir ("../../archivos_st/".$dato[0], 0777);
	mkdir ("../../archivos_st/".$nro, 0777);
	header("Location: ".$link_modulo."?path=trabajos_ver.php&nro=".base64_encode($nro));
	}
	else echo "<b>Ocurrio un error, revise bien la información insertada!</b><br>Notrifiue de este error al administrador del Sistema: ".mysql_error()."<br><a href='javascript:history.back(1);'>[RETORNAR]</a>";  
		
	}
	else
	{ echo "MENSAJE: El CLIENTE: <b>".$cliente."</b> no exite <a href='javascript:history.back(1);'>Haga Click Aqui para RETORNAR</a>";
	}
?>

