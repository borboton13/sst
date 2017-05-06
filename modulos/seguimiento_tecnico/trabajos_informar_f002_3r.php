<?php
require("../../funciones/class.phpmailer.php");
$pro_key="f002";
$validar=$_POST["validar"];
$id_st_cronograma_informes = $_POST["id_st_cronograma_informes"];
$id_item = $_POST["id_item"];

$notificar = $_POST["notificar"];

$remitente=$_SESSION["remitente"];
$nombre_remitente=$_SESSION["nombre_remitente"];
$web=$_SESSION["web"];

$nro=strtoupper($pro_key).str_pad($id_st_cronograma_informes, 6, "0", STR_PAD_LEFT);

	//////////extrae variables
	$resultado=mysql_query("SELECT producto,id_st_proyecto FROM st_trabajos WHERE id_item='".$id_item."'");
	$dato=mysql_fetch_array($resultado);
	$producto=$dato['producto'];
	$id_st_proyecto=$dato['id_st_proyecto'];
	
	//variables para los adjuntos	
	$carpeta_id=$pro_key."_".$id_st_cronograma_informes;
	$carpeta="archivos_st/".$id_st_proyecto."/".$carpeta_id;
	$dir = "../../".$carpeta."/";
	$dir_ext=$web."/".$carpeta."/";
	
$url=$web."/pdf/pdf_st_".$pro_key.".php?id_st_cronograma_informes=".base64_encode($id_st_cronograma_informes)."&id_item=".base64_encode($id_item);
$archivo_adjunto=$dir.$id_st_proyecto."_".$nro.".pdf";
$fp=fopen($archivo_adjunto,'wb');
$fd = file_get_contents($url);
fwrite($fp,$fd);
fclose($fp);
	
if($validar=="ENVIAR A REVISION"){
	$obs_int=$_POST["obs_int"];
	$consulta="UPDATE st_cronograma_informes_".$pro_key." SET 
	fecha_registro=NOW(),
	pasos = '3',
	revision = 'R',
	obs_int='".$obs_int."' 
	WHERE id_st_cronograma_informes_".$pro_key."='".$id_st_cronograma_informes."'";
	$resultado=mysql_query($consulta);
	if($resultado) {
	//preparar correos

	$asunto = "DIMESAT - PARA REVISION: ".$producto." [".$nro."] ".$id_st_proyecto."";
	//////----- echo $asunto."<hr>";
	
	$mail = new PHPMailer(true);
	$mail->IsSendmail(); 

	//////----- echo $remitente." | ".$nombre_remitente."<hr>"; 
  	$mail->SetFrom($remitente, $nombre_remitente);
	$mail->AddReplyTo($remitente, $nombre_remitente);
  
  //correo al tecnico
	$datox=mysql_fetch_array(mysql_query("SELECT mail FROM usuarios WHERE id='".$id_user."'"));
	$bcc=$datox['mail'];
	$mail->AddAddress($bcc);
  //correo a los adm
	  if(count ($notificar )!=0) {
	  foreach($notificar  as $destino_mail){
		//////----- echo $destino_mail."<BR>";
		$mail->AddAddress($destino_mail);
		} 
	  }	

	//////----- echo $archivo_adjunto."<br>";
	$mail->AddAttachment($archivo_adjunto);
 
	$url=$web."/html/html_st_".$pro_key.".php?id_st_cronograma_informes=".base64_encode($id_st_cronograma_informes)."&id_item=".base64_encode($id_item)."&archivos=no";
 	$cuerpo = file_get_contents($url);
	$cuerpo  = eregi_replace("[\]",'',$cuerpo);
	$cuerpo  = $obs_int."<hr>".$cuerpo;
  
  $mail->Subject = $asunto;
  $mail->AltBody = 'Para ver este mensaje, vea en formato HTML!';
  $mail->MsgHTML($cuerpo);  	
  
 //////----- echo "<hr>".$cuerpo;  			

		if(!$mail->Send()) {
		  echo "Error en el Envio del Mensaje!<BR>No recargue la pagina!, cierre y notifique de este error al Administrador del SIA.<BR>Copiar los Detalles del error: " . $mail->ErrorInfo;
		  exit;
		}		

 		header("location: ".$link_modulo."?path=trabajos_ver_correlativo.php&nro=".$id_st_proyecto);	
		
	}
	else{ echo "<center><b>AMPER SRL: Ocurrio un Error!</b><br><a href='javascript:history.back(1);'>[RETORNAR]</a>
	</center>"; exit; }
	
}
if($validar=="ENVIAR INFORME"){
$condicion_final = $_POST["condicion_final"];

	$consulta="UPDATE st_cronograma_informes_".$pro_key." SET 
	condicion_final='".$condicion_final."', 
	fecha_registro=NOW(),
	revision = 'E' 
	WHERE id_st_cronograma_informes_".$pro_key."='".$id_st_cronograma_informes."'";
	$resultado=mysql_query($consulta);
	if($resultado) {
	//preparar correos
	
	$d_p = $_POST["d_p"];
	$add_copia = $_POST["copia_mail"];
	
	$asunto = "DIMESAT - INFORME [".$condicion_final."]: ".$producto." [".$nro."] ".$id_st_proyecto."";
	//////----- echo $asunto."<hr>";
	
	/////mail
	$mail = new PHPMailer(true);
	$mail->IsSendmail(); 
	//////----- echo $remitente." | ".$nombre_remitente."<hr>"; 
  $mail->SetFrom($remitente, $nombre_remitente);
  $mail->AddReplyTo($remitente, $nombre_remitente);
    //correo al tecnico
	$datox=mysql_fetch_array(mysql_query("SELECT u.mail FROM st_cronograma_informes_".$pro_key." i INNER JOIN usuarios u ON i.id_usuario=u.id WHERE i.id_st_cronograma_informes_".$pro_key."='".$id_st_cronograma_informes."'"));
	$bcc=$datox['mail'];

	$mail->AddAddress($bcc);
    //correo a los adm
	  if(count ($notificar )!=0) {
	  foreach($notificar  as $destino_mail){
		//////----- echo $destino_mail."<BR>";
		$mail->AddAddress($destino_mail);
		} 
	  }	
  //clientes
  if(count ($d_p)!=0) {
  foreach($d_p as $destino_mail){
    //////----- echo $destino_mail."<BR>";
    $mail->AddAddress($destino_mail);
    } 
  }		
  
//ademas enviar copia a?  
    if($add_copia!="") {
  $trozos=explode (",", $add_copia);
    foreach($trozos as $copia_mail){
	//////----- echo $copia_mail."<BR>";
    $mail->AddCC($copia_mail); 
    }  
  }
  
//////----- echo $archivo_adjunto."<br>";
$mail->AddAttachment($archivo_adjunto);
 
	$url=$web."/html/html_st_".$pro_key.".php?id_st_cronograma_informes=".base64_encode($id_st_cronograma_informes)."&id_item=".base64_encode($id_item)."&archivos=no";
 	$cuerpo = file_get_contents($url);
	$cuerpo  = eregi_replace("[\]",'',$cuerpo);
  
  $mail->Subject = $asunto;
  $mail->AltBody = 'Para ver este mensaje, vea en formato HTML!';
  $mail->MsgHTML($cuerpo);  	
  
//////-----  echo "<hr>".$cuerpo;  			

		if(!$mail->Send()) {
		  echo "Error en el Envio del Mensaje!<BR>No recargue la pagina!, cierre y notifique de este error al Administrador del SIA.<BR>Copiar los Detalles del error: " . $mail->ErrorInfo;
		  exit;
		}		

 		header("location: ".$link_modulo."?path=trabajos_ver_correlativo.php&nro=".$id_st_proyecto);		
	
	}
	else echo "<center><b>AMPER SRL: Ocurrio un Error!</b><br><a href='javascript:history.back(1);'>[RETORNAR]</a>
	</center>";

}
?>