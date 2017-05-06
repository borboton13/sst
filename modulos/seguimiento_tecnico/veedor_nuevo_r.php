<?php
$id_cliente = $_POST["id_cliente"];
$nombre_completo = $_POST["nombre_completo"];
$correo = $_POST["correo"];
$descripcion = $_POST["descripcion"];
$cuenta = $_POST["cuenta"];
$clave = md5($_POST["clave"]);

$resultado=mysql_query("INSERT INTO st_personal_veedor(id_st_personal_veedor,id_cliente,nombre_completo,cuenta,clave,correo,descripcion) VALUES('','$id_cliente','$nombre_completo','$cuenta','$clave','$correo','$descripcion');");		
		if($resultado)	{
		
		$dato=mysql_fetch_array(mysql_query("SELECT mail FROM usuarios WHERE id='$id_user'"));
		$remitente=$dato[0];

		$dato=mysql_fetch_array(mysql_query("SELECT razon_social FROM clientes WHERE id='$id_cliente'"));
	    $razon_social=$dato[0];
		
		$fecha=date("d/m/Y");
		
		$web="<a href='http://www.dimesat.com.bo/servicios/'>http://www.dimesat.com.bo/servicios/</a>";
		$asunto = "[Cuenta de Acceso] Sr(a): ".$nombre_completo." (".$razon_social.")"; 
		$cuerpo = '<HTML>
<BODY>
<TABLE width="100%" 
border=0 align=center cellpadding="0" cellspacing="0">
  <TBODY>
  <TR>
    <TD>
            <TABLE cellSpacing=0 cellPadding=0 width="100%" border=0>
        <TBODY>
        <TR>
          <TD bgcolor="#5B72A7"><div align="right"><a href="http://www.dimesat.com.bo">www.dimesat.com.bo
            </a></div></TD>
</TR>
        <TR>
          <TD vAlign=top>         
            <table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td height="40" colspan="3" bgcolor="#B2D563"><font size="4">&nbsp;&nbsp;&nbsp;<strong><font color="#3A3A3A" size="3">CUENTA DE ACCESO AL SISTEMA DE SEGUIMIENTO TECNICO DIMESAT </font></strong></font></td>
			    </tr>
              <tr>
                <td width="4%">&nbsp;</td>
                <td width="93%"><TABLE cellSpacing="0" cellPadding="0" width="100%" border="0">
                  <TBODY>
                    <TR>
                      <TD vAlign="top" width="54%"></TD>
                    </TR>
                    
                    <TR>
                      <TD colspan="2" vAlign="top"><p><strong>Sr(a).: </strong>'.$nombre_completo.'<br>
                        <font color="#006699"><strong>'.$razon_social.'</strong></font><br>
                        <u>Presente.-</u><br>
                        <br>
                        DIMESAT, quiere darle la Bienvenida a nuestro M&oacute;dulo de Sistema: SEGUIMIENTO TECNICO mediante el cual usted podr&aacute; realizar un seguimiento t&eacute;cnico de los servicio prestados a su Empresa.</p>
                        <p>Sus datos de acceso son:<br>
                          <br>
                          <strong>Cuenta:</strong> '.$cuenta.'<br>
                          <strong>Contrase&ntilde;a:</strong> '.$_POST["clave"].'<br>
                          <br>
                          Ingrese a nuestra direcci&oacute;n web <a href="http://www.dimesat.com.bo">www.dimesat.com.bo                        </a>y en la seccion de SERVICIOS encontrara el formulario de acceso. <br>
                          <strong>Enlace Directo :</strong> '.$web.'<br>
                          <br>
                          Saludos Cordiales!, atte:</p>                        </TD>
					      </TR>
                    </TBODY>
                  </TABLE></td>
                <td width="3%">&nbsp;</td>
              </tr>		
              </table>            <div align="left">'.$nombrec.'<br>
              <font color="#FC142A" size="4"><strong>'.$cargo.'</strong></font></div></TD>
          </TR>
		
        <TR>

          <TD bgcolor="#ABC6FF"><div align="right">'.$fecha.'(  <a href="mailto:'.$remitente.'">'.$remitente.'</a> ) </div></TD>
</TR>
        <TR>
          <TD bgcolor="#DDDDDD"><DIV align="center"><strong>SANTA CRUZ</strong> OFICINA CENTRAL:   Direcci&oacute;n Barrio Dr. Melchor Pinto Parada UV 71A, Manzano 3 # 1035<BR>
                <strong>LA   PAZ</strong> El Alto, Zona Villa Dolores Calle Cap. Issac Arias esq Av. Arica # 2555 <BR>
            &copy; 2012 Todos los derechos reservados www.dimesat.com.bo </DIV>
            </TD>
        </TR>
        </TBODY></TABLE></TD></TR></TBODY></TABLE>
</BODY></HTML>
';				
		
		$destinatario=$correo;	
		$headers = "MIME-Version: 1.0\r\n"; 
		$headers .= "Content-type: text/html; charset=iso-8859-1\r\n"; 
		$headers .= "From: ".$nombrec." <".$remitente.">\r\n"; 
		$headers .= "Reply-To: ".$remitente."\r\n"; 
		$headers .= "Return-path: ".$remitente."\r\n"; 
		$headers .= "Bcc: ".$remitente."\r\n"; 
		//mail($destinatario,$asunto,$cuerpo,$headers);		
		
		echo"$destinatario<hr>";
		echo"$asunto<hr>";
		echo"$cuerpo<hr>";
		echo"$headers<hr>";		
		
		
		?>
	<script type="text/javascript">
        	//window.open('<?=$link_modulo?>?path=veedor_ver.php','_top');
    </script> 
		<?
		}
		else echo "<center><b>AMPER SRL: Ocurrio un Error en el llenado de Datos!</b><br><a href='javascript:history.back(1);'>ATRAS</a>";
?>

