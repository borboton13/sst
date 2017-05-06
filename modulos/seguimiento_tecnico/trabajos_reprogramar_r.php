<?php
require("../../funciones/funciones.php");
//
$id_st_cronograma_informes = $_POST["id_st_cronograma_informes"];
$pro_key = $_POST["pro_key"];
$fecha_nuevo = convertfecha($_POST['fecha_nuevo'],"/");
$hora_p_ = $_POST["hora_p_"];
$tecnico = $_POST["tecnico"];
$enviar_mail = $_POST["enviar_mail"];

	$dato=mysql_fetch_array(mysql_query("select id_st_proyecto,id_item,id_usuario,date_format(fecha,'%d/%m/%Y') AS fecha FROM st_cronograma_informes_".$pro_key." WHERE id_st_cronograma_informes_".$pro_key."='".$id_st_cronograma_informes."'"));

	$nro=$dato['id_st_proyecto'];
	$id_item=$dato['id_item'];
	$tecnico_anterior=$dato['id_usuario'];
	$fecha=$dato['fecha'];
	
	$consulta="UPDATE st_cronograma_informes_".$pro_key." SET 
	id_usuario='".$tecnico."',
	fecha='".$fecha_nuevo."' ";
	if($hora_p_!="") $consulta.=",hora_programada='".$hora_p_."' ";
	else $consulta.=",hora_programada=NULL ";
	$consulta.="WHERE id_st_cronograma_informes_".$pro_key."='".$id_st_cronograma_informes."';";
	$resultado=mysql_query($consulta);
	if($resultado) {	
	if($enviar_mail=="SI") {

	$resultado=mysql_query("SELECT departamento,producto,marca,caracteristicas,ubicacion FROM st_trabajos WHERE id_item='".$id_item."'");
$dato=mysql_fetch_array($resultado);
 $departamento=$dato[0];
 $producto=$dato[1];
 $marca=$dato[2];
 $caracteristicas=$dato[3];
 $ubicacion=$dato[4];
 
	$dato=mysql_fetch_array(mysql_query("SELECT f.mail as m1,CONCAT(f.nombre,' ',f.ap_pat) as n1, s.mail as m2, CONCAT(s.nombre,' ',s.ap_pat) as n2, t.mail as m3 FROM usuarios f, usuarios s, usuarios t WHERE f.id='".$tecnico."' AND s.id='".$tecnico_anterior."' AND t.id='".$id_user."'"));
	$mail_tecnico=$dato[0];
	$name_tecnico=$dato[1];
	$mail_tecnico_anterior=$dato[2];
	$name_tecnico_anterior=$dato[3];
	$remitente=$dato[4];
	////////envia mail al anterior tecnico y al nuevo
	
	 
    $asunto = "SEGUIMIENTO TECNICO: CAMBIO DE FECHA (".$nro.")";

	$headers = "MIME-Version: 1.0\r\n"; 
	$headers .= "Content-type: text/html; charset=iso-8859-1\r\n"; 
	$headers .= "From: ".$nombrec." <".$remitente.">\r\n"; 
	$headers .= "Reply-To: ".$remitente."\r\n"; 
	$headers .= "Return-path: ".$remitente."\r\n";
	$headers .= "Bcc: ".$remitente."\r\n"; 
	
	$cuerpo="DEPARTAMENTO: ".$departamento."<br>";
	$cuerpo.="PRODUCTO: ".$producto."<br>";
	$cuerpo.="MARCA: ".$marca."<br>";
	$cuerpo.="CARACTERISTICAS: ".$caracteristicas."<br>";
	$cuerpo.="ESTACION: ".$ubicacion."<HR>";
	$cuerpo.="Sin Otro particular, Saludos!<br> Enviado:".date("d/m/Y H:i");
	
	if($tecnico==$tecnico_anterior){
	$cuerpo_send="Sr. ".$name_tecnico." se le ha reformulado la fecha de la visita técnica del ".$fecha." al ".$_POST['fecha_nuevo']." <HR>".$cuerpo; 
	mail($mail_tecnico,$asunto,$cuerpo_send,$headers);	
	}
	else{
	$cuerpo_send="Sr. ".$name_tecnico_anterior." se le ha liberado de la visita tecnica del ".$fecha." <HR>".$cuerpo;
	mail($mail_tecnico_anterior,$asunto,$cuerpo_send,$headers);
	$cuerpo_send="Sr. ".$name_tecnico." se le ha asignado la siguiente visita técnica el ".$_POST['fecha_nuevo']." <HR>".$cuerpo;
	mail($mail_tecnico,$asunto,$cuerpo_send,$headers);	
	}			
	}
	header("location: ".$link_modulo_r."?path=trabajos_visitas_ver.php&id_item=".$id_item);
	
	}
	else echo"ocurrio un error";
?>