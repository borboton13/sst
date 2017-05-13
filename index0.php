<?
$sw = $_GET["sw"];
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
<HEAD>
<TITLE>Dimesat: Sistema de seguimiento T&eacute;cnico</TITLE>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<LINK rev=stylesheet href="css/general.css" type=text/css rel=stylesheet>
<LINK href="favicon.ico" type=image/x-icon rel="shortcut icon">
<META http-equiv=Content-Type content="text/html; charset=iso-8859-1">
<META content="MSHTML 6.00.2900.3059" name=GENERATOR>
<META content="Sistema de Seguimiento Tecnico Dimesat" name=description>
<META content="Seguimiento T�cnico, Dimesat, Marcelo Chavez Duran" name=keywords>
<style type="text/css">
.titulo {color: #FFFFFF;
font-size: 24px;
background-color:#333333;
}
.text{
font-size:18px;
margin:5px;
}
.fondo{
background-color:#F3F3F3;
}
.b {
	BORDER: #73b35a 1px solid; BACKGROUND-COLOR: #92c97c; MARGIN: 5px 0px 0px 5px; FONT-FAMILY: "Lucida Grande", Tahoma, Arial, Verdana, sans-serif; COLOR: #e8f7df; CURSOR: pointer; FONT-WEIGHT: bold; TEXT-DECORATION: none; PADDING-TOP: 5px;
}
.b IMG {
	BORDER-BOTTOM: medium none; BORDER-LEFT: medium none; PADDING-BOTTOM: 0px; MARGIN: 0px 6px -3px 0px; PADDING-LEFT: 0px; WIDTH: 16px; PADDING-RIGHT: 0px; HEIGHT: 16px; BORDER-TOP: medium none; BORDER-RIGHT: medium none; TEXT-DECORATION: none; PADDING-TOP: 0px
}
.b:hover {
	BORDER-BOTTOM: #92c97c 1px solid; BORDER-LEFT: #92c97c 1px solid; BACKGROUND-COLOR: #e8f7df; COLOR: #31940c; BORDER-TOP: #92c97c 1px solid; BORDER-RIGHT: #92c97c 1px solid
}

</style>
</HEAD>
<BODY>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td style="background-color:#2F4076" align="center"><img src="img/header_logo.jpg" width="1206" height="102"/></td>
  </tr>
</table> 
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="676" style="background-color:#355BA9" align="center"><img src="img/login_banner.png" width="676" height="247"/></td><td style="background-color:#B6CFFF">
          <form class="form" name="form" method="post" action="v0001.php">
<table width="350" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td width="6%">&nbsp;</td>
    <td colspan="2" class="fondo"><?
if($sw==1)
{
echo"<br><span class='rojo'><img src='img/warning_2.gif' width='16' height='16' align='absmiddle' >Error! Inserte nuevamente sus Datos...</span><br>";
}
if($sw==2)
{
echo"<br><span class='rojo'><img src='img/warning_2.gif' width='16' height='16' align='absmiddle'>Error! Su sesi�n ha caducado, vuelva a ingresar al sistema</span><br>";
}

?></td>
    <td width="5%" class="fondo">&nbsp;</td>
  </tr>
<!-- -->
  <tr>
    <td height="40" class="titulo">&nbsp;</td>
    <td colspan="2" class="titulo"><strong>Login</strong></td>
    <td class="fondo">&nbsp;</td>
  </tr>

  <tr>
    <td>&nbsp;</td>
    <td width="30%" class="fondo"><div align="right"><strong>Usuario:</strong></div></td>
    <td width="59%" class="fondo"><input name="santo" type="text" class="text" id="santo" maxlength="20"></td>
    <td class="fondo">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td class="fondo"><div align="right"><strong>Contrase&ntilde;a:</strong></div></td>
    <td class="fondo"><input name="sena" type="password" class="text" id="sena" maxlength="20"></td>
    <td class="fondo">&nbsp;</td>
  </tr>

  <tr>
    <td>&nbsp;</td>
    <td class="fondo">&nbsp;</td>
    <td class="fondo"><div align="left">
      <BUTTON  class="b" name=Submit type=submit><IMG alt=Login src="img/key.png">Ingresar</BUTTON>
       <a href="#" class="enlace_oculto">Contrase&ntilde;a?</a></div></td>
    <td class="fondo">&nbsp;</td>
  </tr>
<!-- -->
  <tr>
    <td>&nbsp;</td>
    <td class="fondo">&nbsp;</td>
    <td class="fondo">&nbsp;</td>
    <td class="fondo">&nbsp;</td>
  </tr>
</table>
</form>
</td>
  </tr>
</table>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
    <TR>
          <TD width="50%" class="pie"></TD>
          <TD width="50%" class="pie">
		    <div align="right">
		    <? 
		  $dias=date("w");
	switch($dias)
	  {
	  case 1: echo"<b>LUN</b>";break;
	  case 2: echo"<b>MAR</b>";break;
	  case 3: echo"<b>MIE</b>";break;
	  case 4: echo"<b>JUE</b>";break;
	  case 5: echo"<b>VIE</b>";break;
	  case 6: echo"<b>SAB</b>";break;
	  case 0: echo"<b>DOM</b>";break;		  	  
	  }	  
		  $dia=date("d");
		  $mes=date("m");
		  echo", $dia de ";
	switch($mes)
	  {
	  case 1: echo"ENE";break;
	  case 2: echo"FEB";break;
	  case 3: echo"MAR";break;
	  case 4: echo"ABR";break;
	  case 5: echo"MAY";break;
	  case 6: echo"JUN";break;
	  case 7: echo"JUL";break;
	  case 8: echo"AGO";break;
	  case 9: echo"SEP";break;
	  case 10: echo"OCT";break;
	  case 11: echo"NOV";break;
	  case 12: echo"DIC";break;		  	  
	  }
		  ?>
		  </div></TD>
  </TR>
<tr><td class="pie" colspan="2"><br /><div align="center"><span class="pie_txt"><b>SANTA CRUZ</b> OFICINA CENTRAL: Direccio n Barrio Dr. Melchor Pinto Parada UV 71A, Manzano 3 # 1035<br />
<b>LA PAZ</b> El Alto, Zona Villa Dolores Calle Cap. Issac Arias esq Av. Arica # 2555 
 </span><br />
 � <?=date("Y")?> Todos los derechos reservados www.dimesat.com.bo 

</div><br /></td></tr>  
</table>
</BODY></HTML>
<script type="text/javascript">
document.getElementById('santo').focus();
</script>
</script>