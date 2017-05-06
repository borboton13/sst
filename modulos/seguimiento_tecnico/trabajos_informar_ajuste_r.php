<?php
require("../../funciones/funciones.php");
require("../../funciones/class.phpmailer.php");
//
$remitente=$_SESSION["remitente"];
$nombre_remitente=$_SESSION["nombre_remitente"];
$web=$_SESSION["web"];


$id_st_cronograma_informes = $_POST["id_st_cronograma_informes"];
$id_item = $_POST["id_item"];
$informe = $_POST["informe"];
$fecha = convertfecha($_POST['fecha'],"/");
$condicion_final="OK+";

 $resultado=mysql_query("SELECT departamento,producto,marca,caracteristicas,ubicacion FROM st_trabajos WHERE id_item='".$id_item."'");
 $dato=mysql_fetch_array($resultado);
 $departamento=$dato[0]; 
 $producto=$dato[1]; 
 $marca=$dato[2]; 
 $caracteristicas=$dato[3]; 
 $ubicacion=$dato[4];
 
 $dato_p=mysql_fetch_array(mysql_query("SELECT descripcion FROM parametrica WHERE grupo='st' AND sub_grupo='".$producto."'"));
 $from=$dato_p['descripcion'];
 
	$consulta="UPDATE ".$from." SET 
	postm_descripcion = '".$informe."',
	postm_fecha='".$fecha."', 
	postm_condicion_final='".$condicion_final."'
	WHERE id_".$from."='".$id_st_cronograma_informes."'";
	$resultado=mysql_query($consulta);
	if($resultado) {

	/////mail
	$mail = new PHPMailer(true);
	$mail->IsSendmail(); 
	
	$d_p = $_POST["d_p"];
	$datox=mysql_fetch_array(mysql_query("SELECT descripcion FROM parametrica WHERE grupo='mandar_mail' AND sub_grupo='st'"));
	$d_i=$datox['descripcion'];

	$datox=mysql_fetch_array(mysql_query("SELECT mail FROM usuarios WHERE id='".$id_user."'"));
	$bcc=$datox['mail'];
	
	
		$asunto = "DIMESAT: [".$condicion_final."] Notificacion Registro de Informe (".$id_st_proyecto.") - "; 

$cuerpo = '
<html>
<body>
<strong>Detalles del item</strong>
<table width="300" border="1" cellpadding="0" cellspacing="2">
  <tr>
    <td height="20"><strong>Departamento:</strong></td>
    <td>'.$departamento.'</td>
  </tr>
  <tr>
    <td height="20"><strong>Producto:</strong></td>
    <td>'.$producto.'</td>
  </tr>
  <tr>
    <td height="20"><strong>Marca:</strong></td>
    <td>'.$marca.'</td>
  </tr>
  <tr>
    <td height="20"><strong>Caracteristicas:</strong></td>
    <td>'.$caracteristicas.'</td>
  </tr>
  <tr>
    <td height="20"><strong>Ubicaci&oacute;n:</strong></td>
    <td>'.$ubicacion.'</td>
  </tr>
</table>
<br>
<strong>Estado Final:</strong> '.$condicion_final.'<br>
<strong>Registro: </strong>'.$_POST['fecha'].'<br>
<strong>Resumen Técnico:</strong> '.$informe.'<br>
<br>
[<a href="http://www.amperonline.com/main/cms/es/code/contents/loadContent.php?contentUid=4">Click aca para acceder al sistema de usuario y ver el informe completo</a>]<br><br>Soluciones Integrales<br>AMPER SRL.
</body>
</html>';

  $mail->SetFrom($remitente, $nombre_remitente);
  $mail->AddReplyTo($remitente, $nombre_remitente);
  
  if(count ($d_p)!=0) {
  foreach($d_p as $destino_mail){
    //echo $destino_mail."<BR>";
    $mail->AddAddress($destino_mail);
    } 
  }			 	
  
  if($d_i!="") {
  $trozos=explode (",", $d_i);
    foreach($trozos as $copia_mail){
	//echo $copia_mail."<BR>";
    $mail->AddAddress($copia_mail); 
    }  
  }		
     $mail->AddBCC($bcc); 
/*
  $mail->Subject = $asunto;
  $mail->AltBody = 'Para ver este mensaje, vea en formato HTML!';
  $mail->MsgHTML($cuerpo);  				

		if(!$mail->Send()) {
		  echo "Error en el Envio del Mensaje!<BR>No recargue la pagina!, cierre y notifique de este error al Administrador del SIA.<BR>Copiar los Detalles del error: " . $mail->ErrorInfo;
		  exit;
		}		
*/		

		/*
		echo"$destinatario<hr>";
		echo"$asunto<hr>";
		echo"$cuerpo<hr>";
		echo"$headers<hr>";
		*/
	header("location: ".$link_modulo_r."?path=trabajos_visitas_ver.php&id_item=".$id_item);
	}
	else echo"ocurrio un error <hr>$consulta";
?>