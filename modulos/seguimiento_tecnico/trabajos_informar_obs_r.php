<?php
//
$id_st_proyecto = $_POST["nro"];
$id_item = $_POST["id_item"];
$observacion = $_POST["observacion"];


if($_POST["ocultar"]!=1){
$dato=mysql_fetch_array(mysql_query("SELECT b.razon_social FROM st_proyecto a INNER JOIN clientes b ON a.id_cliente=b.id AND id_st_proyecto='$id_st_proyecto'"));
$cliente=$dato[0];

	$resultado=mysql_query("INSERT INTO st_items_obs(id_item,fecha,observacion,id_usuario) VALUES($id_item,NOW(),'$observacion','$id_user')");
	if($resultado) {
	$resultado=mysql_query("SELECT departamento,producto,marca,caracteristicas,ubicacion FROM st_trabajos WHERE id_item='".$id_item."'");
 $dato=mysql_fetch_array($resultado);
 $departamento=$dato[0]; 
 $producto=$dato[1]; 
 $marca=$dato[2]; 
 $caracteristicas=$dato[3]; 
 $ubicacion=$dato[4];
//////preparara destinatarios para el envio del mail
	$consultax="SELECT concat(r.nombre, ' ', r.ap_pat),r.mail,m.destinatario
	FROM usuarios r, mandar_mail m
	WHERE r.id='$id_user' AND modulo='seguimiento_tecnico_informe'";
	$resultadox=mysql_query($consultax);
	$datox=mysql_fetch_array($resultadox);
	$remitente_nombre=$datox[0];
	$remitente_mail=$datox[1];
	$destinatario=$datox[2];	
	
	$consulta="SELECT v.correo FROM st_proyecto p INNER JOIN st_personal_veedor v ON p.id_st_proyecto='$id_st_proyecto' AND p.id_cliente=v.id_cliente";
$resultado=mysql_query($consulta);
while($dato=mysql_fetch_array($resultado))
 		{
		$mails[]=$dato[0]; 
		}		
    $copia=implode(",",$mails);
		$asunto = "AMPER SRL (S.T.): [OBSERVACION EN MANTENIMIENTO] (".$id_st_proyecto.") - ".$cliente; 
		$cuerpo = '<html>
<body>
<strong>Detalles del item</strong>
<table width="300" border="1" cellpadding="0" cellspacing="2">
  <tr>
    <td width="109" height="20"><strong>Cliente:</strong></td>
    <td width="179">'.$cliente.'</td>
  </tr>
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
<strong>OBSERVACION:</strong> '.nl2br($observacion).'<br>
<strong>Registro: </strong>'.date("d/m/Y H:i").'<br>
<br>
[<a href="http://www.amperonline.com/main/cms/es/code/contents/loadContent.php?contentUid=4">Click aca para acceder al sistema de usuario y ver el informe completo</a>]<br><br>Soluciones Integrales<br>AMPER SRL.
</body>
</html>';
		
		
		$headers = "MIME-Version: 1.0\r\n"; 
		$headers .= "Content-type: text/html; charset=iso-8859-1\r\n"; 
		$headers .= "From: ".$remitente_nombre." <".$remitente_mail.">\r\n"; 
		$headers .= "Reply-To: ".$remitente_mail."\r\n"; 
		$headers .= "Return-path: ".$remitente_mail."\r\n";
		if($copia!="") 
		$headers .= "Cc: ".$copia."\r\n";
		$headers .= "Bcc: ".$remitente_mail."\r\n"; 
	    mail($destinatario,$asunto,$cuerpo,$headers);		
		?>
	<script type="text/javascript">
        	window.open('<?=$link_modulo?>?path=trabajos_ver.php&nro=<?=base64_encode($id_st_proyecto);?>','_top');
    </script> 
		<?		
	}
	else echo"ocurrio un error";
}
else {
mysql_query("INSERT INTO st_items_obs(id_item,fecha,observacion,id_usuario) VALUES($id_item,NOW(),'Ocultar','$id_user')");
		?>
	<script type="text/javascript">
        	window.open('<?=$link_modulo?>?path=trabajos_ver.php&nro=<?=base64_encode($id_st_proyecto);?>','_top');
    </script> 
		<?	
}
?>