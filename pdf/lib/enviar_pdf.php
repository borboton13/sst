<?
//require("../../funciones/class.phpmailer.php");

$fp=fopen('cotizacion.pdf','wb');
fwrite($fp,'http://sia.ampersystem.com/pdf/pdf_propuesta.php?nro_=UDAwMTI0Mg==');
fclose($fp);
/*				
$remitente="sia@ampersystem.com";
$nombre_remitente="Sistema Integrado Amper";
$cuerpo='<h1>HOLA MARCELO</h1>';
  $mail = new PHPMailer(true);
  $mail->IsSendmail(); 
  $mail->SetFrom($remitente, $nombre_remitente);
  $mail->AddReplyTo($remitente, $nombre_remitente);
  $mail->AddAddress("drakon_marcelo@hotmail.com");
  $mail->AddAttachment('cotizacion.pdf');  	
  $mail->Subject = "Archivo adjunto";
  $mail->AltBody = 'Para ver este mensaje, vea en formato HTML!';
  $mail->MsgHTML($cuerpo);
  				

		
		if(!$mail->Send()) {
		  echo "Error en el Envio del Mensaje!<BR>No recargue la pagina!, cierre y notifique de este error al Administrador del SIA.<BR>Copiar los Detalles del error: " . $mail->ErrorInfo;
		  exit;
		} 

*/
echo "bien";
?>