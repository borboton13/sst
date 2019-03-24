<?php
//
$id_st_cronograma_informes = $_POST["id_st_cronograma_informes"];
$id_item = $_POST["id_item"];
$pro_key="f001";

$ubicacion = $_POST["ubicacion"];

mysql_query("UPDATE st_trabajos SET ubicacion='".$ubicacion."' WHERE id_item='".$id_item."'");

$detalles = $_POST["detalles"];
$time1 = $_POST["time1"];
$time2 = $_POST["time2"];
$obs = $_POST["obs"];

$conta = $_POST["conta"];



$nro_ticket 	= $_POST["nro_ticket"]; 		if($nro_ticket == ''){$nro_ticket=0;}
$id_nodo 		= $_POST["id_nodo"];			if($id_nodo == ''){$id_nodo=0;}
$fecha_apertura = $_POST["fecha_apertura"];		if($fecha_apertura == ''){$fecha_apertura='0000-00-00 00:00';}
$fecha_cierre 	= $_POST["fecha_cierre"];		if($fecha_cierre == ''){$fecha_cierre='0000-00-00 00:00';}

$p1 = $_POST["p1"];
$p2 = $_POST["p2"];
$p3 = $_POST["p3"];
$funcionario=explode ("\n", $p3);
$p4 = $_POST["p4"];
$p5 = $_POST["p5"];
$p6 = $_POST["p6"]; if($p6=="OTROS") {$p6.=": ".$_POST["p6_otros"];}
$p7 = $_POST["p7"];
$p71 = $_POST["p71"];
$p8 = $_POST["p8"];
$p9 = $_POST["p9"];

    $sa01 = "0";
    $sa02 = "0";
    $sa03 = "0";
    $sa04 = "0";
    if(isset($_POST['sa01'])) $sa01="1";
    if(isset($_POST['sa02'])) $sa02="1";
    if(isset($_POST['sa03'])) $sa03="1";
    if(isset($_POST['sa04'])) $sa04="1";


	$consulta="UPDATE st_cronograma_informes_".$pro_key." SET 
	detalles = '".$detalles."',
	hora_llegada = '".$time1."',
	hora_salida = '".$time2."',
	funcionario = '".$funcionario[0]."',
	obs = '".$obs."',
	conta = '".$conta."',
	p1 = '".$p1."',
 	p2 = '".$p2."',
	p3 = '".$p3."',
	p4 = '".$p4."',
	p5 = '".$p5."',
	p6 = '".$p6."',
	p7 = '".$p7."',
	p71 = '".$p71."',
	p8 = '".$p8."',
	p9 = '".$p9."',
	nro_ticket = '".strtoupper($nro_ticket)."',
	id_nodo = '".$id_nodo."',
	fecha_apertura = '".$fecha_apertura."',
	fecha_cierre = '".$fecha_cierre."',
	fecha_registro=NOW(),
	pasos = '1',
	sa01 = ".  $sa01 .",
	sa02 = ".  $sa02 .",
	sa03 = ".  $sa03 .",
	sa04 = ".  $sa04 ." 
	WHERE id_st_cronograma_informes_".$pro_key."='".$id_st_cronograma_informes."'";
	$resultado=mysql_query($consulta);

	if($resultado) {
	header("location: ".$link_modulo."?path=trabajos_informar_".$pro_key."_2.php&id_st_cronograma_informes=".$id_st_cronograma_informes);	
	}
	else echo"ocurrio un error <hr>$consulta";

?>